<?php

namespace BG\HackatonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaseComments
 *
 * @ORM\Table(name="case_comments", indexes={@ORM\Index(name="fk_case_comments_crime_case1_idx", columns={"crime_case_id"})})
 * @ORM\Entity
 */
class CaseComments
{
    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=false)
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

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
     *   @ORM\JoinColumn(name="crime_case_id", referencedColumnName="id")
     * })
     */
    private $crimeCase;



    /**
     * Set comment
     *
     * @param string $comment
     * @return CaseComments
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return CaseComments
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * Set crimeCase
     *
     * @param \BG\HackatonBundle\Entity\CrimeCases $crimeCase
     * @return CaseComments
     */
    public function setCrimeCase(\BG\HackatonBundle\Entity\CrimeCases $crimeCase = null)
    {
        $this->crimeCase = $crimeCase;

        return $this;
    }

    /**
     * Get crimeCase
     *
     * @return \BG\HackatonBundle\Entity\CrimeCases 
     */
    public function getCrimeCase()
    {
        return $this->crimeCase;
    }
}
