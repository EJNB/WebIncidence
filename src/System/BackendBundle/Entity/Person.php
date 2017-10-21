<?php

namespace System\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\PersonRepository")
 */
class Person implements AdvancedUserInterface, \Serializable
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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=256)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $occupation;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * Many Users have Many Roles.
//     * @Assert\NotNull()
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="persons")
     * @ORM\JoinTable(name="persons_roles")
     */
    private $roles;

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
        $this->movements = new ArrayCollection();
        $this->isActive = true;
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }
    /** @see \Serializable::serialize() */
    public function serialize(){
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            // see section on salt below
            // $this->salt,
        ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
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

    public function __toString()
    {
        return $this->getName();
        // TODO: Implement __toString() method.
    }

    public function isAccountNonExpired()
    {
        return true;
    }
    public function isAccountNonLocked()
    {
        return true;
    }
    public function isCredentialsNonExpired()
    {
        return true;
    }
    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set occupation
     *
     * @param string $occupation
     * @return Person
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }

    /**
     * Get occupation
     *
     * @return string 
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Add roles
     *
     * @param \System\BackendBundle\Entity\Role $roles
     * @return Person
     */
    public function addRole(\System\BackendBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \System\BackendBundle\Entity\Role $roles
     */
    public function removeRole(\System\BackendBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }
}
