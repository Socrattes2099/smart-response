<?php

namespace BG\HackatonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrimeQuestions
 *
 * @ORM\Table(name="crime_questions", indexes={@ORM\Index(name="fk_category_question_crime_category_idx", columns={"crime_category_id"})})
 * @ORM\Entity
 */
class CrimeQuestions
{
    const TYPE_OPEN = "OPEN";
    const TYPE_LIST = "LIST";

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255, nullable=false)
     */
    private $question;

    /**
     * @var integer
     *
     * @ORM\Column(name="question_number", type="integer", nullable=false)
     */
    private $questionNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \BG\HackatonBundle\Entity\CrimeCategories
     *
     * @ORM\ManyToOne(targetEntity="BG\HackatonBundle\Entity\CrimeCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crime_category_id", referencedColumnName="id")
     * })
     */
    private $crimeCategory;


    /**
     * @ORM\OneToMany(targetEntity="BG\HackatonBundle\Entity\CrimeQuestionOptions", mappedBy="crimeQuestions")
     */
    private $questionOptions;

    /**
     * Set question
     *
     * @param string $question
     * @return CrimeQuestions
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
     * @return CrimeQuestions
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
     * @return CrimeQuestions
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
     * Set crimeCategory
     *
     * @param \BG\HackatonBundle\Entity\CrimeCategories $crimeCategory
     * @return CrimeQuestions
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

    public function __toString(){
        return $this->getCrimeCategory() .' - '. $this->getQuestion();
    }

    /**
     * @return CrimeQuestionOptions[]
     */
    public function getQuestionOptions(){
        return $this->questionOptions;
    }
}
