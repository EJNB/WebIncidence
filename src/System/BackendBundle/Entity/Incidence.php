<?php

namespace System\BackendBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Incidence
 *
 * @ORM\Table(name="incidence")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\IncidenceRepository")
 */
class Incidence
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
     * @var int
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="incidence_date", type="date")
     */
    private $incidenceDate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="document", type="string", length=255)
     */
    private $document;

    /**
     * @ORM\OneToMany(targetEntity="IncidenceType", mappedBy="incidence")
     **/
    private $incidencetypes;

    /**
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="incidences")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     **/
    private $department;

    /**
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="incidences")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     **/
    private $service;

    public function __construct() {
        $this->incidencetypes = new ArrayCollection();
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
     * @return Incidence
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
     * Set incidenceDate
     *
     * @param \DateTime $incidenceDate
     * @return Incidence
     */
    public function setIncidenceDate($incidenceDate)
    {
        $this->incidenceDate = $incidenceDate;

        return $this;
    }

    /**
     * Get incidenceDate
     *
     * @return \DateTime 
     */
    public function getIncidenceDate()
    {
        return $this->incidenceDate;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Incidence
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set document
     *
     * @param string $document
     * @return Incidence
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return string 
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Add incidencetypes
     *
     * @param \System\BackendBundle\Entity\IncidenceType $incidencetypes
     * @return Incidence
     */
    public function addIncidencetype(\System\BackendBundle\Entity\IncidenceType $incidencetypes)
    {
        $this->incidencetypes[] = $incidencetypes;

        return $this;
    }

    /**
     * Remove incidencetypes
     *
     * @param \System\BackendBundle\Entity\IncidenceType $incidencetypes
     */
    public function removeIncidencetype(\System\BackendBundle\Entity\IncidenceType $incidencetypes)
    {
        $this->incidencetypes->removeElement($incidencetypes);
    }

    /**
     * Get incidencetypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIncidencetypes()
    {
        return $this->incidencetypes;
    }
}
