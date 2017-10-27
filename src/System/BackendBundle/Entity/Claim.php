<?php

namespace System\BackendBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
//
//    /**
//     * @ORM\OneToMany(targetEntity="Incidence", mappedBy="claim")
//     **/
//    private $incidences;

    /**
     * @ORM\ManyToOne(targetEntity="Booking", inversedBy="claims")
     * @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
     **/
    private $booking;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="claim")
     **/
    private $items;

    public function __construct() {
//        $this->incidences = new ArrayCollection();
        $this->items = new ArrayCollection();
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

//    /**
//     * Add incidences
//     *
//     * @param \System\BackendBundle\Entity\Incidence $incidences
//     * @return Claim
//     */
//    public function addIncidence(\System\BackendBundle\Entity\Incidence $incidences)
//    {
//        $this->incidences[] = $incidences;
//
//        return $this;
//    }
//
//    /**
//     * Remove incidences
//     *
//     * @param \System\BackendBundle\Entity\Incidence $incidences
//     */
//    public function removeIncidence(\System\BackendBundle\Entity\Incidence $incidences)
//    {
//        $this->incidences->removeElement($incidences);
//    }
//
//    /**
//     * Get incidences
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getIncidences()
//    {
//        return $this->incidences;
//    }

    /**
     * Set booking
     *
     * @param \System\BackendBundle\Entity\Booking $booking
     * @return Claim
     */
    public function setBooking(\System\BackendBundle\Entity\Booking $booking = null)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking
     *
     * @return \System\BackendBundle\Entity\Booking 
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * Add items
     *
     * @param \System\BackendBundle\Entity\Item $items
     * @return Claim
     */
    public function addItem(\System\BackendBundle\Entity\Item $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \System\BackendBundle\Entity\Item $items
     */
    public function removeItem(\System\BackendBundle\Entity\Item $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }
}
