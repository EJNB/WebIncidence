<?php

namespace System\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Incidence_Person
 *
 * @ORM\Table(name="incidence__person")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\Incidence_PersonRepository")
 */
class Incidence_Person
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
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="persons_incidences")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     **/
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="Incidence", inversedBy="incidences_persons")
     * @ORM\JoinColumn(name="incidence_id", referencedColumnName="id")
     **/
    private $incidence;

    /**
     * @var string
     *
     * @ORM\Column(name="rol", type="string", length=255)
     */
    private $rol;

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
     * Set rol
     *
     * @param string $rol
     * @return Incidence_Person
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return string 
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set person
     *
     * @param \System\BackendBundle\Entity\Person $person
     * @return Incidence_Person
     */
    public function setPerson(\System\BackendBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \System\BackendBundle\Entity\Person 
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set incidence
     *
     * @param \System\BackendBundle\Entity\Incidence $incidence
     * @return Incidence_Person
     */
    public function setIncidence(\System\BackendBundle\Entity\Incidence $incidence = null)
    {
        $this->incidence = $incidence;

        return $this;
    }

    /**
     * Get incidence
     *
     * @return \System\BackendBundle\Entity\Incidence 
     */
    public function getIncidence()
    {
        return $this->incidence;
    }
}
