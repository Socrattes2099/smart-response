<?php

namespace BG\HackatonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaseMtResponses
 *
 * @ORM\Table(name="case_mt_responses", indexes={@ORM\Index(name="fk_case_mt_responses_crime_cases1_idx", columns={"crime_cases_id"})})
 * @ORM\Entity
 */
class CaseMtResponses
{
    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="dest_address", type="string", length=45, nullable=false)
     */
    private $destAddress;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sent_time", type="datetime", nullable=false)
     */
    private $sentTime;

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
     * Set message
     *
     * @param string $message
     * @return CaseMtResponses
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set destAddress
     *
     * @param string $destAddress
     * @return CaseMtResponses
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
     * @return CaseMtResponses
     */
    public function setSentTime($sentTime)
    {
        $this->sentTime = $sentTime;

        return $this;
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
     * @return CaseMtResponses
     */
    public function setCrimeCases(\BG\HackatonBundle\Entity\CrimeCases $crimeCases = null)
    {
        $this->crimeCases = $crimeCases;

        return $this;
    }

    /**
     * Get crimeCases
     *
     * @return \BG\HackatonBundle\Entity\CrimeCases 
     */
    public function getCrimeCases()
    {
        return $this->crimeCases;
    }
}
