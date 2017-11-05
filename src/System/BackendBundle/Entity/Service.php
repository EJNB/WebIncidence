<?php

namespace System\BackendBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\ServiceRepository")
 */
class Service
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="service_type", type="string", length=255)
     */
    private $serviceType;

    /**
     * @var string
     *
     * @ORM\Column(name="tourplan_code", type="string", length=255)
     */
    private $tourplanCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="tourplan_id", type="integer")
     */
    private $tourplanId;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity="Incidence", mappedBy="service")
     **/
    private $incidences;

    /**
     * @ORM\ManyToOne(targetEntity="Supplier", inversedBy="services")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id")
     **/
    private $supplier;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="service")
     **/
    private $items;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->incidences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Service
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
     * Set serviceType
     *
     * @param string $serviceType
     * @return Service
     */
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;

        return $this;
    }

    /**
     * Get serviceType
     *
     * @return string 
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * Set tourplanCode
     *
     * @param string $tourplanCode
     * @return Service
     */
    public function setTourplanCode($tourplanCode)
    {
        $this->tourplanCode = $tourplanCode;

        return $this;
    }

    /**
     * Get tourplanCode
     *
     * @return string 
     */
    public function getTourplanCode()
    {
        return $this->tourplanCode;
    }

    /**
     * Set tourplanId
     *
     * @param integer $tourplanId
     * @return Service
     */
    public function setTourplanId($tourplanId)
    {
        $this->tourplanId = $tourplanId;

        return $this;
    }

    /**
     * Get tourplanId
     *
     * @return integer 
     */
    public function getTourplanId()
    {
        return $this->tourplanId;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Service
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Add incidences
     *
     * @param \System\BackendBundle\Entity\Incidence $incidences
     * @return Service
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
     * Set supplier
     *
     * @param \System\BackendBundle\Entity\Supplier $supplier
     * @return Service
     */
    public function setSupplier(\System\BackendBundle\Entity\Supplier $supplier = null)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return \System\BackendBundle\Entity\Supplier 
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * Add items
     *
     * @param \System\BackendBundle\Entity\Item $items
     * @return Service
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

    public function __toString()
    {
        return $this->getName();
    }
}
