<?php

namespace System\BackendBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\BookingRepository")
 */
class Booking
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=12)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="agent", type="string", length=255)
     */
    private $agent;

    /**
     * @var string
     *
     * @ORM\Column(name="consultant", type="string", length=255)
     */
    private $consultant;

    /**
     * @var string
     *
     * @ORM\Column(name="pax", type="string", length=255, nullable=true)
     */
    private $pax;

    /**
     * @ORM\OneToMany(targetEntity="Incidence", mappedBy="booking")
     **/
    private $incidences;

    /**
     * @ORM\OneToMany(targetEntity="Claim", mappedBy="booking")
     **/
    private $claims;

    /**
     * @ORM\OneToMany(targetEntity="Client", mappedBy="booking")
     **/
    private $clients;

    public function __construct() {
        $this->incidences = new ArrayCollection();
        $this->claims = new ArrayCollection();
        $this->clients = new ArrayCollection();
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
     * Set code
     *
     * @param integer $code
     * @return Booking
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Booking
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set agent
     *
     * @param string $agent
     * @return Booking
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get agent
     *
     * @return string 
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set consultant
     *
     * @param string $consultant
     * @return Booking
     */
    public function setConsultant($consultant)
    {
        $this->consultant = $consultant;

        return $this;
    }

    /**
     * Get consultant
     *
     * @return string 
     */
    public function getConsultant()
    {
        return $this->consultant;
    }

    /**
     * Set pax
     *
     * @param string $pax
     * @return Booking
     */
    public function setPax($pax)
    {
        $this->pax = $pax;

        return $this;
    }

    /**
     * Get pax
     *
     * @return string 
     */
    public function getPax()
    {
        return $this->pax;
    }

    /**
     * Add incidences
     *
     * @param \System\BackendBundle\Entity\Incidence $incidences
     * @return Booking
     */
    public function addIncidence(\System\BackendBundle\Entity\Incidence $incidences)
    {
        $this->incidences[] = $incidences;

        return $this;
    }

    /**
     * Remove incidences
     *
     * @param \System\BackendBundle\Entity\Incidence $incidences
     */
    public function removeIncidence(\System\BackendBundle\Entity\Incidence $incidences)
    {
        $this->incidences->removeElement($incidences);
    }

    /**
     * Get incidences
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIncidences()
    {
        return $this->incidences;
    }

    /**
     * Add claims
     *
     * @param \System\BackendBundle\Entity\Claim $claims
     * @return Booking
     */
    public function addClaim(\System\BackendBundle\Entity\Claim $claims)
    {
        $this->claims[] = $claims;

        return $this;
    }

    /**
     * Remove claims
     *
     * @param \System\BackendBundle\Entity\Claim $claims
     */
    public function removeClaim(\System\BackendBundle\Entity\Claim $claims)
    {
        $this->claims->removeElement($claims);
    }

    /**
     * Get claims
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClaims()
    {
        return $this->claims;
    }

    /**
     * Add clients
     *
     * @param \System\BackendBundle\Entity\Client $clients
     * @return Booking
     */
    public function addClient(\System\BackendBundle\Entity\Client $clients)
    {
        $this->clients[] = $clients;

        return $this;
    }

    /**
     * Remove clients
     *
     * @param \System\BackendBundle\Entity\Client $clients
     */
    public function removeClient(\System\BackendBundle\Entity\Client $clients)
    {
        $this->clients->removeElement($clients);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClients()
    {
        return $this->clients;
    }
}
