<?php


namespace BG\HackatonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrimeQuestionOptions
 *
 * @ORM\Table(name="crime_question_options", uniqueConstraints={@ORM\UniqueConstraint(name="unique_question_number", columns={"option_number", "crime_questions_id"})}, indexes={@ORM\Index(name="fk_crime_question_options_crime_questions1_idx", columns={"crime_questions_id"})})
 * @ORM\Entity
 */
class CrimeQuestionOptions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="option", type="string", length=255, nullable=false)
     */
    private $option;

    /**
     * @var integer
     *
     * @ORM\Column(name="option_number", type="integer", nullable=false)
     */
    private $optionNumber;

    /**
     * @var \CrimeQuestions
     *
     * @ORM\ManyToOne(targetEntity="CrimeQuestions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crime_questions_id", referencedColumnName="id")
     * })
     */
    private $crimeQuestions;


    /**
     * Set option
     *
     * @param string $option
     * @return CrimeQuestionOptions
     */
    public function setOption($option)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * Get option
     *
     * @return string 
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * Set optionNumber
     *
     * @param integer $optionNumber
     * @return CrimeQuestionOptions
     */
    public function setOptionNumber($optionNumber)
    {
        $this->optionNumber = $optionNumber;

        return $this;
    }

    /**
     * Get optionNumber
     *
     * @return integer 
     */
    public function getOptionNumber()
    {
        return $this->optionNumber;
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
     * Set crimeQuestions
     *
     * @param \BG\HackatonBundle\Entity\CrimeQuestions $crimeQuestions
     * @return CrimeQuestionOptions
     */
    public function setCrimeQuestions(\BG\HackatonBundle\Entity\CrimeQuestions $crimeQuestions = null)
    {
        $this->crimeQuestions = $crimeQuestions;

        return $this;
    }

    /**
     * Get crimeQuestions
     *
     * @return \BG\HackatonBundle\Entity\CrimeQuestions 
     */
    public function getCrimeQuestions()
    {
        return $this->crimeQuestions;
    }
}
