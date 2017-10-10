<?php

namespace System\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reminder
 *
 * @ORM\Table(name="reminder")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\ReminderRepository")
 */
class Reminder
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
     * @var \DateTime
     *
     * @ORM\Column(name="reminder_date", type="date")
     */
    private $reminderDate;

    /**
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="reminders")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     **/
    private $item;

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
     * Set reminderDate
     *
     * @param \DateTime $reminderDate
     * @return Reminder
     */
    public function setReminderDate($reminderDate)
    {
        $this->reminderDate = $reminderDate;

        return $this;
    }

    /**
     * Get reminderDate
     *
     * @return \DateTime 
     */
    public function getReminderDate()
    {
        return $this->reminderDate;
    }

    /**
     * Set item
     *
     * @param \System\BackendBundle\Entity\Item $item
     * @return Reminder
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
}
