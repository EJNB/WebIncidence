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

    /**
     * Set item
     *
     * @param \System\BackendBundle\Entity\Item $item
     * @return SolDevPro
     */
    public function setItem(\System\BackendBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \System\BackendBundle\Entity\Item 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Add reminders
     *
     * @param \System\BackendBundle\Entity\Reminder $reminders
     * @return SolDevPro
     */
    public function addReminder(\System\BackendBundle\Entity\Reminder $reminders)
    {
        $this->reminders[] = $reminders;

        return $this;
    }

    /**
     * Remove reminders
     *
     * @param \System\BackendBundle\Entity\Reminder $reminders
     */
    public function removeReminder(\System\BackendBundle\Entity\Reminder $reminders)
    {
        $this->reminders->removeElement($reminders);
    }

    /**
     * Get reminders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReminders()
    {
        return $this->reminders;
    }
}
