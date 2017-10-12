<?php

namespace System\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IncidenceType
 *
 * @ORM\Table(name="incidence_type")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\IncidenceTypeRepository")
 */
class IncidenceType
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
     * @ORM\OneToMany(targetEntity="System\BackendBundle\Entity\Incidence", mappedBy="incidenceType")
     **/
    private $incidences;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->incidences = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return IncidenceType
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
     * Add incidences
     *
     * @param \System\BackendBundle\Entity\Incidence $incidences
     * @return IncidenceType
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

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getName();
    }
}
