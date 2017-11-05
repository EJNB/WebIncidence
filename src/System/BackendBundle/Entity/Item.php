<?php

namespace System\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\ItemRepository")
 */
class Item
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
     * @ORM\ManyToOne(targetEntity="Claim", inversedBy="items")
     * @ORM\JoinColumn(name="claim_id", referencedColumnName="id")
     **/
    private $claim;

    /**
     * @ORM\ManyToOne(targetEntity="ItemType", inversedBy="items")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     **/
    private $itemtype;

    /**
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="items")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     **/
    private $service;

    /**
     * @ORM\Column(name="date_request", type="date")
     */
    private $date_request;

    /**
     * @ORM\Column(name="request_amount", type="integer")
     */
    private $request_amount;

    /**
     * @ORM\Column(name="refound", type="integer")
     */
    private $refound;

    /**
     * @ORM\OneToMany(targetEntity="Reminder", mappedBy="item")
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
     * Set claim
     *
     * @param \System\BackendBundle\Entity\Claim $claim
     * @return Item
     */
    public function setClaim(\System\BackendBundle\Entity\Claim $claim = null)
    {
        $this->claim = $claim;

        return $this;
    }

    /**
     * Get claim
     *
     * @return \System\BackendBundle\Entity\Claim 
     */
    public function getClaim()
    {
        return $this->claim;
    }

    /**
     * Set itemtype
     *
     * @param \System\BackendBundle\Entity\ItemType $itemtype
     * @return Item
     */
    public function setItemtype(\System\BackendBundle\Entity\ItemType $itemtype = null)
    {
        $this->itemtype = $itemtype;

        return $this;
    }

    /**
     * Get itemtype
     *
     * @return \System\BackendBundle\Entity\ItemType 
     */
    public function getItemtype()
    {
        return $this->itemtype;
    }

    /**
     * Set service
     *
     * @param \System\BackendBundle\Entity\Service $service
     * @return Item
     */
    public function setService(\System\BackendBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \System\BackendBundle\Entity\Service 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set date_request
     *
     * @param \DateTime $dateRequest
     * @return Item
     */
    public function setDateRequest($dateRequest)
    {
        $this->date_request = $dateRequest;

        return $this;
    }

    /**
     * Get date_request
     *
     * @return \DateTime 
     */
    public function getDateRequest()
    {
        return $this->date_request;
    }

    /**
     * Set request_amount
     *
     * @param integer $requestAmount
     * @return Item
     */
    public function setRequestAmount($requestAmount)
    {
        $this->request_amount = $requestAmount;

        return $this;
    }

    /**
     * Get request_amount
     *
     * @return integer 
     */
    public function getRequestAmount()
    {
        return $this->request_amount;
    }

    /**
     * Set refound
     *
     * @param integer $refound
     * @return Item
     */
    public function setRefound($refound)
    {
        $this->refound = $refound;

        return $this;
    }

    /**
     * Get refound
     *
     * @return integer 
     */
    public function getRefound()
    {
        return $this->refound;
    }

    /**
     * Add reminders
     *
     * @param \System\BackendBundle\Entity\Reminder $reminders
     * @return Item
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
