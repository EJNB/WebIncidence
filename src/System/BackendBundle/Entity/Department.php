<?php

namespace System\BackendBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table(name="department")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\DepartmentRepository")
 */
class Department
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Incidence", mappedBy="department")
     **/
    private $incidences;

    public function __construct() {
        $this->features = new ArrayCollection();
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
     * @return Department
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
     * @return Department
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
}
