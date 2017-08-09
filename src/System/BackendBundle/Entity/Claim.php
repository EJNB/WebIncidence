<?php

namespace System\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Claim
 *
 * @ORM\Table(name="claim")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\ClaimRepository")
 */
class Claim
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="claim_date", type="date")
     */
    private $claimDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="closing_date", type="date")
     */
    private $closingDate;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="request_amount", type="string", length=255)
     */
    private $requestAmount;

    /**
     * @var int
     *
     * @ORM\Column(name="request_returned", type="integer")
     */
    private $requestReturned;

    /**
     * @var int
     *
     * @ORM\Column(name="persons_amount", type="integer")
     */
    private $personsAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;


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
     * Set claimDate
     *
     * @param \DateTime $claimDate
     * @return Claim
     */
    public function setClaimDate($claimDate)
    {
        $this->claimDate = $claimDate;

        return $this;
    }

    /**
     * Get claimDate
     *
     * @return \DateTime 
     */
    public function getClaimDate()
    {
        return $this->claimDate;
    }

    /**
     * Set closingDate
     *
     * @param \DateTime $closingDate
     * @return Claim
     */
    public function setClosingDate($closingDate)
    {
        $this->closingDate = $closingDate;

        return $this;
    }

    /**
     * Get closingDate
     *
     * @return \DateTime 
     */
    public function getClosingDate()
    {
        return $this->closingDate;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Claim
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set requestAmount
     *
     * @param string $requestAmount
     * @return Claim
     */
    public function setRequestAmount($requestAmount)
    {
        $this->requestAmount = $requestAmount;

        return $this;
    }

    /**
     * Get requestAmount
     *
     * @return string 
     */
    public function getRequestAmount()
    {
        return $this->requestAmount;
    }

    /**
     * Set requestReturned
     *
     * @param integer $requestReturned
     * @return Claim
     */
    public function setRequestReturned($requestReturned)
    {
        $this->requestReturned = $requestReturned;

        return $this;
    }

    /**
     * Get requestReturned
     *
     * @return integer 
     */
    public function getRequestReturned()
    {
        return $this->requestReturned;
    }

    /**
     * Set personsAmount
     *
     * @param integer $personsAmount
     * @return Claim
     */
    public function setPersonsAmount($personsAmount)
    {
        $this->personsAmount = $personsAmount;

        return $this;
    }

    /**
     * Get personsAmount
     *
     * @return integer 
     */
    public function getPersonsAmount()
    {
        return $this->personsAmount;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Claim
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }
}
