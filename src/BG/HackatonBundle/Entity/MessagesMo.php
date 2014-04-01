<?php

namespace BG\HackatonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MessagesMo
 *
 * @ORM\Table(name="messages_mo")
 * @ORM\Entity
 */
class MessagesMo
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
     * @ORM\Column(name="source_address", type="string", length=45, nullable=false)
     */
    private $sourceAddress;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="received_time", type="datetime", nullable=true)
     */
    private $receivedTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set message
     *
     * @param string $message
     * @return MessagesMo
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
     * Set sourceAddress
     *
     * @param string $sourceAddress
     * @return MessagesMo
     */
    public function setSourceAddress($sourceAddress)
    {
        $this->sourceAddress = $sourceAddress;

        return $this;
    }

    /**
     * Get sourceAddress
     *
     * @return string 
     */
    public function getSourceAddress()
    {
        return $this->sourceAddress;
    }

    /**
     * Set receivedTime
     *
     * @param \DateTime $receivedTime
     * @return MessagesMo
     */
    public function setReceivedTime($receivedTime)
    {
        $this->receivedTime = $receivedTime;

        return $this;
    }

    /**
     * Get receivedTime
     *
     * @return \DateTime 
     */
    public function getReceivedTime()
    {
        return $this->receivedTime;
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
}
