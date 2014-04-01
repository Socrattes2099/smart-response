<?php

namespace BG\HackatonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrimeQuestionAnswers
 *
 * @ORM\Table(name="crime_question_answers", indexes={@ORM\Index(name="fk_crime_answers_sent_questions1_idx", columns={"sent_questions_id"})})
 * @ORM\Entity
 */
class CrimeQuestionAnswers
{
    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=255, nullable=false)
     */
    private $answer;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \BG\HackatonBundle\Entity\SentQuestions
     *
     * @ORM\ManyToOne(targetEntity="BG\HackatonBundle\Entity\SentQuestions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sent_questions_id", referencedColumnName="id")
     * })
     */
    private $sentQuestions;



    /**
     * Set answer
     *
     * @param string $answer
     * @return CrimeQuestionAnswers
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
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
     * Set sentQuestions
     *
     * @param \BG\HackatonBundle\Entity\SentQuestions $sentQuestions
     * @return CrimeQuestionAnswers
     */
    public function setSentQuestions(\BG\HackatonBundle\Entity\SentQuestions $sentQuestions = null)
    {
        $this->sentQuestions = $sentQuestions;

        return $this;
    }

    /**
     * Get sentQuestions
     *
     * @return \BG\HackatonBundle\Entity\SentQuestions 
     */
    public function getSentQuestions()
    {
        return $this->sentQuestions;
    }
}
