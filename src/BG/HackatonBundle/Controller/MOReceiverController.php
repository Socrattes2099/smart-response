<?php
/**
 * Created by PhpStorm.
 * User: bguevara
 * Date: 3/29/14
 * Time: 3:58 PM
 */

namespace BG\HackatonBundle\Controller;


use BG\HackatonBundle\Entity\CrimeCases;
use BG\HackatonBundle\Entity\CrimeCategories;
use BG\HackatonBundle\Entity\CrimeQuestionAnswers;
use BG\HackatonBundle\Entity\CrimeQuestions;
use BG\HackatonBundle\Entity\MessagesMo;
use BG\HackatonBundle\Entity\SentQuestions;
use BG\HackatonBundle\Libs\SMSSender;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MOReceiverController extends Controller {

    const NO_SERVICE_MESSAGE = "Este servicio no existe. Envie DENUNCIA para reportar un crimen.";
    const INVALID_ANSWER_MESSAGE = "Su respuesta no es valida. Favor ingrese una opcion correcta.";
    const FINISHED_MESSAGE = "Graciar por completar su denuncia. En breve nos comunicaremos con usted.";

    public function receiveMessageAction(Request $request){
        $manager = $this->container->get('doctrine')->getEntityManager();
        $message = $request->query->get('Content');
        $phone_number = $request->query->get('SA');
        $raw_time = $request->query->get('time');
        $sent_time = new \DateTime();
        $sent_time->createFromFormat("YYYY-MM-DD HH:MM", $raw_time);
        //$sent_time->setTimestamp($request->query->get('time'));

        $messageMO = new MessagesMo();
        $messageMO->setMessage($message);
        $messageMO->setSourceAddress($phone_number);
        $messageMO->setReceivedTime($sent_time);

        $manager->persist($messageMO);
        $manager->flush();

        $message = strtolower( trim($message) );
        if ( $message == "denuncia" ){ // Create CrimeCase
            $case = new CrimeCases();
            $case->setMessageMo($messageMO);
            $case->setStatus(CrimeCases::STATUS_UNCOMPLETED);
            $manager->persist($case);
            $manager->flush();

            $mt_message = $this->getCategoriesListMessage();
            // Response with category list
            $this->sendMTMessage($mt_message, $phone_number);
        } else {
            // Search existing case
            $case = $this->getUncompleteCaseForPhone($phone_number);
            if ($case === null)
                $this->sendMTMessage(self::NO_SERVICE_MESSAGE, $phone_number); // No Service

            else { // Process Answer and Sent Next Question
                if ($this->checkAndRegisterAnswer($case, $message)){ // Answer is OK, so send next question
                    $question = $this->getNextQuestion($case);

                    if ($question === null) // We have reached poll end
                        $this->completeAndProcessCase($case, $phone_number);
                    else
                        $this->registerAndSendMessage($question, $case, $phone_number);

                } else { // Answer is Wrong, send error message
                    $this->sendMTMessage(self::INVALID_ANSWER_MESSAGE, $phone_number);
                }
            }
        }


        return new Response('OK');
    }


    private function checkAndRegisterAnswer(CrimeCases $case, $answer){
        $manager = $this->container->get('doctrine')->getEntityManager();

        $sentQuestion = $this->getLastAskedQuestion($case);
        if ($sentQuestion === null){
            if ($case->getStatus() == CrimeCases::STATUS_UNCOMPLETED){ //Uncompleted case, so first question was category selection
                $category = $this->checkAndReturnCategoryAnswer($answer);
                if ($category === null)
                    return false;

                $case->setCrimeCategory($category);
                $manager->persist($case);
                $manager->flush();

                return true;
            }

            return false;
        }

        $question = $sentQuestion->getCrimeQuestions();
        switch ($question->getType()){
            case CrimeQuestions::TYPE_OPEN:
                $this->storeAnswer($sentQuestion, $answer);
                break;

            case CrimeQuestions::TYPE_LIST:
                if (!$this->checkOptionAnswer($question, $answer))
                    return false;

                $this->storeAnswer($sentQuestion, $answer);
                break;
        }


        return true;
    }

    /**
     * @param $answer
     * @return CrimeCategories
     */
    private function checkAndReturnCategoryAnswer($answer){
        // Check if answer is numeric
        if (!is_numeric($answer))
            return null;

        $answer_number = intval($answer) - 1; // Substract 1 for array index
        $repo = $this->container->get('doctrine')->getRepository('BGHackatonBundle:CrimeCategories');
        $categories = $repo->findAll();

        // Check if answer is between ranges
        if (!isset($categories[$answer_number]))
            return null;

        return $categories[$answer_number];
    }

    private function checkOptionAnswer(CrimeQuestions $question, $answer){
        // Check if answer is numeric
        if (!is_numeric($answer))
            return false;

        $answer_number = intval($answer);
        $repo = $this->container->get('doctrine')->getRepository('BGHackatonBundle:CrimeQuestionOptions');
        $qb = $repo->createQueryBuilder('op')
                   //->select('COUNT(op)')
                   ->where('op.crimeQuestions = :question')
                   ->andWhere('op.optionNumber = :number')
                   ->setParameter('question', $question)
                   ->setParameter('number', $answer_number);

        /*
        $num_options = $qb->getQuery()->getSingleScalarResult();
        // Check if answer is between ranges
        if ($answer_number < 1 || $answer_number > $num_options)
            return false;
        */
        $option = $qb->getQuery()->getResult();
        if (empty($option))
            return false;

        return true;
    }

    private function storeAnswer(SentQuestions $question, $answer_text){
        $manager = $this->container->get('doctrine')->getEntityManager();
        // Store Answer
        $answer = new CrimeQuestionAnswers();
        $answer->setAnswer($answer_text);
        $answer->setSentQuestions($question);
        $manager->persist($answer);
        $manager->flush();
    }

    private function registerAndSendMessage(CrimeQuestions $question, CrimeCases $case, $destination){
        $manager = $this->container->get('doctrine')->getEntityManager();
        // Store envio
        $sent_question = new SentQuestions();
        $sent_question->setCrimeCases($case);
        $sent_question->setCrimeQuestions($question);
        $sent_question->setDestAddress($destination);
        $sent_question->setSentTime( new \DateTime() );
        $manager->persist($sent_question);
        $manager->flush();

        // Send Question
        $message_mt = $question->getQuestion().':';
        if ($question->getType() == CrimeQuestions::TYPE_LIST){
            $message_mt .= "\n";
            $repo = $this->container->get('doctrine')->getRepository('BGHackatonBundle:CrimeQuestionOptions');
            $repo->createQueryBuilder('op')
                ->where('op.crimeQuestions = :question')
                ->orderBy('op.optionNumber', 'ASC')
                ->setParameter('question', $question);

            foreach($question->getQuestionOptions() as $option){
                $message_mt .= "{$option->getOptionNumber()}. {$option->getOption()}\n";
            }
        }

        $this->sendMTMessage($message_mt , $destination);
    }

    private function sendMTMessage($message, $destination){
        $envio = new SMSSender($message, $destination);
        $envio->sendMessage();
    }

    private function getCategoriesListMessage(){
        $repo = $this->container->get('doctrine')->getRepository('BGHackatonBundle:CrimeCategories');
        $categories = $repo->findAll();
        $message = "";
        foreach ($categories as $i => $category){
            $question_number = $i + 1;
            $category_name = $category->getName();
            $message .= "{$question_number}. $category_name\n";
        }

        return $message;
    }


    /**
     * @param $phone_number
     * @return CrimeCases
     */
    private function getUncompleteCaseForPhone($phone_number){
        $repo = $this->container->get('doctrine')->getRepository('BGHackatonBundle:CrimeCases');
        $qb = $repo->createQueryBuilder('c')
            ->join('c.messageMo', 'mo')
            ->where('mo.sourceAddress = :phone')
            ->andWhere('c.status = :status')
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(1)
            ->setParameter('phone', $phone_number)
            ->setParameter('status', CrimeCases::STATUS_UNCOMPLETED);

        $cases = $qb->getQuery()->getResult();
        if (empty($cases))
            return null;

        return $cases[0];
    }

    /**
     * @param CrimeCases $case
     * @return CrimeQuestions
     */
    private function getNextQuestion(CrimeCases $case){
        $last_question = $this->getLastAskedQuestion($case);

        $question_number = 1;
        if ($last_question !== null)
            $question_number = $last_question->getCrimeQuestions()->getQuestionNumber() + 1;


        $repo = $this->container->get('doctrine')->getRepository('BGHackatonBundle:CrimeQuestions');
        $next_question = $repo->createQueryBuilder('q')
            ->where('q.questionNumber = :number')
            ->andWhere('q.crimeCategory = :category')
            ->setParameter('number', $question_number)
            ->setParameter('category', $case->getCrimeCategory())
            ->orderBy('q.questionNumber', 'ASC')
            ->getQuery()->getResult();


        if (empty($next_question))
            return null;

        return $next_question[0];
    }

    /**
     * @param CrimeCases $case
     * @return SentQuestions
     */
    private function getLastAskedQuestion(CrimeCases $case){
        $repo = $this->container->get('doctrine')->getRepository('BGHackatonBundle:SentQuestions');
        $qb = $repo->createQueryBuilder('q')
                   ->where('q.crimeCases = :case')
                   ->orderBy('q.sentTime', 'DESC')
                   ->setParameter('case', $case)
                   ->setMaxResults(1);
        $question = $qb->getQuery()->getResult();

        if (empty($question))
            return null;
        else
            return $question[0];

    }

    /**
     * @param CrimeCases $case
     * @param string $dest_addr
     */
    private function completeAndProcessCase(CrimeCases $case, $dest_addr)
    {
        // Change status to NEW
        $manager = $this->container->get('doctrine')->getEntityManager();
        $case->setStatus(CrimeCases::STATUS_NEW);
        $manager->persist($case);
        $manager->flush();

        // Sent final message
        $this->sendMTMessage(self::FINISHED_MESSAGE, $dest_addr);

        // Sent broadcast
        $repo = $this->container->get('doctrine')->getRepository('BGHackatonBundle:BroadcastNumbers');
        $numbers = $repo->findAll();

        $message = $case->getCrimeCategory()->getName().'. '.implode( '.- ', $case->getAnswers() );
        foreach($numbers as $number){
            $this->sendMTMessage($message, $number->getPhoneNumber());
        }
    }


} 