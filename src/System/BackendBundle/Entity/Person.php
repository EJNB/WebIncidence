<?php

namespace System\BackendBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\PersonRepository")
 */
class Person
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
     * @ORM\Column(name="consultant", type="string", length=255)
     */
    private $consultant;

    /**
     * @ORM\OneToMany(targetEntity="Incidence_Person", mappedBy="person")
     **/
    private $persons_incidences;

    /**
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="persons")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     */
    private $department;

    public function __construct()
    {
        $this->persons_incidences = new ArrayCollection();
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
     * @return Person
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
     * Set consultant
     *
     * @param string $consultant
     * @return Person
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
     * Add incidences_persons
     *
     * @param \System\BackendBundle\Entity\Incidence_Person $incidencesPersons
     * @return Person
     */
    public function addIncidencesPerson(\System\BackendBundle\Entity\Incidence_Person $incidencesPersons)
    {
        $this->incidences_persons[] = $incidencesPersons;

        return $this;
    }

    /**
     * Remove incidences_persons
     *
     * @param \System\BackendBundle\Entity\Incidence_Person $incidencesPersons
     */
    public function removeIncidencesPerson(\System\BackendBundle\Entity\Incidence_Person $incidencesPersons)
    {
        $this->incidences_persons->removeElement($incidencesPersons);
    }

    /**
     * Get incidences_persons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIncidencesPersons()
    {
        return $this->incidences_persons;
    }

    /**
     * Set department
     *
     * @param \System\BackendBundle\Entity\Department $department
     * @return Person
     */
    public function setDepartment(\System\BackendBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \System\BackendBundle\Entity\Department 
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Add persons_incidences
     *
     * @param \System\BackendBundle\Entity\Incidence_Person $personsIncidences
     * @return Person
     */
    public function addPersonsIncidence(\System\BackendBundle\Entity\Incidence_Person $personsIncidences)
    {
        $this->persons_incidences[] = $personsIncidences;

        return $this;
    }

    /**
     * Remove persons_incidences
     *
     * @param \System\BackendBundle\Entity\Incidence_Person $personsIncidences
     */
    public function removePersonsIncidence(\System\BackendBundle\Entity\Incidence_Person $personsIncidences)
    {
        $this->persons_incidences->removeElement($personsIncidences);
    }

    /**
     * Get persons_incidences
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersonsIncidences()
    {
        return $this->persons_incidences;
    }
}
