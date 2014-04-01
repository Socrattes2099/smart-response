<?php

namespace BG\HackatonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeneralQuestion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class GeneralQuestion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var integer
     *
     * @ORM\Column(name="question_number", type="integer")
     */
    private $questionNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;


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
     * Set question
     *
     * @param string $question
     * @return GeneralQuestion
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set questionNumber
     *
     * @param integer $questionNumber
     * @return GeneralQuestion
     */
    public function setQuestionNumber($questionNumber)
    {
        $this->questionNumber = $questionNumber;

        return $this;
    }

    /**
     * Get questionNumber
     *
     * @return integer 
     */
    public function getQuestionNumber()
    {
        return $this->questionNumber;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return GeneralQuestion
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
}
