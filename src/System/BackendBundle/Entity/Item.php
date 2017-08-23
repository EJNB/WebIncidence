<?php

namespace System\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToOne(targetEntity="SolDevPro", mappedBy="item")
     **/
    private $soldevpro;

    /**
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="items")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     **/
    private $service;

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
     * Set soldevpro
     *
     * @param \System\BackendBundle\Entity\SolDevPro $soldevpro
     * @return Item
     */
    public function setSoldevpro(\System\BackendBundle\Entity\SolDevPro $soldevpro = null)
    {
        $this->soldevpro = $soldevpro;

        return $this;
    }

    /**
     * Get soldevpro
     *
     * @return \System\BackendBundle\Entity\SolDevPro 
     */
    public function getSoldevpro()
    {
        return $this->soldevpro;
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
}
