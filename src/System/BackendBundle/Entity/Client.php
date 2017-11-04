<?php

namespace System\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\ClientRepository")
 */
class Client
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
     * @ORM\ManyToOne(targetEntity="System\BackendBundle\Entity\Incidence", inversedBy="clients")
     * @ORM\JoinColumn(name="incidence_id", referencedColumnName="id")
     **/
    private $incidence;

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
     * @return Client
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
     * Set incidence
     *
     * @param \System\BackendBundle\Entity\Incidence $incidence
     * @return Client
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
