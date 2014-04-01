<?php

namespace BG\HackatonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrimeCases
 *
 * @ORM\Table(name="crime_cases", indexes={@ORM\Index(name="fk_crime_case_message_mo1_idx", columns={"message_mo_id"})})
 * @ORM\Entity
 */
class CrimeCases
{
    const STATUS_OPEN = "open";
    const STATUS_NEW = "new";
    const STATUS_CLOSED = "closed";
    const STATUS_UNCOMPLETED = "uncompleted";

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \BG\HackatonBundle\Entity\MessagesMo
     *
     * @ORM\ManyToOne(targetEntity="BG\HackatonBundle\Entity\MessagesMo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="message_mo_id", referencedColumnName="id")
     * })
     */
    private $messageMo;


    /**
     * @var \BG\HackatonBundle\Entity\CrimeCategories
     *
     * @ORM\ManyToOne(targetEntity="BG\HackatonBundle\Entity\CrimeCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crime_category_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $crimeCategory;

    /**
     * @var \BG\HackatonBundle\Entity\SentQuestions[]
     * @ORM\OneToMany(targetEntity="BG\HackatonBundle\Entity\SentQuestions", mappedBy="crimeCases")
     */
    private $sentQuestions;

    /**
     * Set status
     *
     * @param string $status
     * @return CrimeCases
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return CrimeCases
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set messageMo
     *
     * @param \BG\HackatonBundle\Entity\MessagesMo $messageMo
     * @return CrimeCases
     */
    public function setMessageMo(\BG\HackatonBundle\Entity\MessagesMo $messageMo = null)
    {
        $this->messageMo = $messageMo;

        return $this;
    }

    /**
     * Get messageMo
     *
     * @return \BG\HackatonBundle\Entity\MessagesMo 
     */
    public function getMessageMo()
    {
        return $this->messageMo;
    }

    /**
     * Set crimeCategory
     *
     * @param \BG\HackatonBundle\Entity\CrimeCategories $crimeCategory
     * @return CrimeCases
     */
    public function setCrimeCategory(\BG\HackatonBundle\Entity\CrimeCategories $crimeCategory = null)
    {
        $this->crimeCategory = $crimeCategory;

        return $this;
    }

    /**
     * Get crimeCategory
     *
     * @return \BG\HackatonBundle\Entity\CrimeCategories 
     */
    public function getCrimeCategory()
    {
        return $this->crimeCategory;
    }

    public function getSentQuestions(){
        return $this->sentQuestions;
    }


    public function getAnswers(){
        $answers = array();
        $questions = $this->getSentQuestions();
        foreach($questions as $sent_question){
            $the_question = $sent_question->getCrimeQuestions();
            $answer_text = $the_question->getQuestion().": ";

            foreach($sent_question->getAnswers() as $answer){
                if ($the_question->getType() == CrimeQuestions::TYPE_LIST){
                    $options = $the_question->getQuestionOptions();
                    foreach ($options as $the_option){
                        if ($the_option->getOptionNumber() == intval($answer->getAnswer())){
                            $answer_text .= $the_option->getOption();
                            break;
                        }
                    }

                } else {
                    $answer_text .= $answer->getAnswer();
                }
            }

            $answers[] = $answer_text;
        }

        return $answers;
    }
}
