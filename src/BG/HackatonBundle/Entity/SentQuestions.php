<?php

namespace BG\HackatonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrimeQuestionAnswers
 *
 * @ORM\Table(name="sent_questions", indexes={@ORM\Index(name="fk_crime_answers_crime_questions1_idx", columns={"crime_questions_id"}), @ORM\Index(name="fk_crime_answers_crime_cases1_idx", columns={"crime_cases_id"})})
 * @ORM\Entity
 */
class SentQuestions
{
    /**
     * @var string
     *
     * @ORM\Column(name="dest_address", type="string", length=45, nullable=false)
     */
    private $destAddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \BG\HackatonBundle\Entity\CrimeCases
     *
     * @ORM\ManyToOne(targetEntity="BG\HackatonBundle\Entity\CrimeCases")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crime_cases_id", referencedColumnName="id")
     * })
     */
    private $crimeCases;

    /**
     * @var \BG\HackatonBundle\Entity\CrimeQuestions
     *
     * @ORM\ManyToOne(targetEntity="BG\HackatonBundle\Entity\CrimeQuestions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crime_questions_id", referencedColumnName="id")
     * })
     */
    private $crimeQuestions;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sent_time", type="datetime", nullable=false)
     */
    private $sentTime;

    /**
     * @var \BG\HackatonBundle\Entity\CrimeQuestionAnswers[]
     * @ORM\OneToMany(targetEntity="BG\HackatonBundle\Entity\CrimeQuestionAnswers", mappedBy="sentQuestions")
     */
    private $answers;

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
     * Set crimeCases
     *
     * @param \BG\HackatonBundle\Entity\CrimeCases $crimeCases
     * @return CrimeQuestionAnswers
     */
    public function setCrimeCases(\BG\HackatonBundle\Entity\CrimeCases $crimeCases = null)
    {
        $this->crimeCases = $crimeCases;

        return $this;
    }

    /**
     * Get crimeCasesphp app/console generate:doctrine:crud --entity=BGHackatonBundle:CrimeQuestions --with-write --format=annotation
     *
     * @return \BG\HackatonBundle\Entity\CrimeCases
     */
    public function getCrimeCases()
    {
        return $this->crimeCases;
    }

    /**
     * Set crimeQuestions
     *
     * @param \BG\HackatonBundle\Entity\CrimeQuestions $crimeQuestions
     * @return CrimeQuestionAnswers
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

    /**
     * Set destAddress
     *
     * @param string $destAddress
     * @return SentQuestions
     */
    public function setDestAddress($destAddress)
    {
        $this->destAddress = $destAddress;

        return $this;
    }

    /**
     * Get destAddress
     *
     * @return string 
     */
    public function getDestAddress()
    {
        return $this->destAddress;
    }

    /**
     * Set sentTime
     *
     * @param \DateTime $sentTime
     * @return SentQuestions
     */
    public function setSentTime($sentTime)
    {
        $this->sentTime = $sentTime;

        return $this;
    }

    public function getAnswers(){
        return $this->answers;
    }

    /**
     * Get sentTime
     *
     * @return \DateTime 
     */
    public function getSentTime()
    {
        return $this->sentTime;
    }
}
