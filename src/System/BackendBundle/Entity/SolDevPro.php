<?php

namespace System\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SolDevPro
 *
 * @ORM\Table(name="sol_dev_pro")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\SolDevProRepository")
 */
class SolDevPro
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
     * @ORM\OneToOne(targetEntity="Item", inversedBy="soldevpro")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     **/
    private $item;

    /**
     * @ORM\OneToMany(targetEntity="Reminder", mappedBy="soldevpro")
     **/
    private $reminders;

    public function __construct() {
        $this->reminders = new ArrayCollection();
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
}
