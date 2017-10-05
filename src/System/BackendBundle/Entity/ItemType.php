<?php

namespace System\BackendBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ItemType
 *
 * @ORM\Table(name="item_type")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\ItemTypeRepository")
 */
class ItemType
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
     * @ORM\OneToMany(targetEntity="Item", mappedBy="itemtype")
     **/
    private $items;

//    /**
//     * @ORM\OneToMany(targetEntity="Category", mappedBy="itemtype")
//     **/
//    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="ServiceType", mappedBy="itemtype")
     **/
    private $services_types;

    /**
     * @ORM\ManyToOne(targetEntity="SubCategory", inversedBy="items_types")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     **/
    private $subcategory;

    public function __construct() {
        $this->features = new ArrayCollection();
        $this->items = new ArrayCollection();
//        $this->categories = new ArrayCollection();
        $this->services_types = new ArrayCollection();
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
     * @return ItemType
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
     * Add items
     *
     * @param \System\BackendBundle\Entity\Item $items
     * @return ItemType
     */
    public function addItem(\System\BackendBundle\Entity\Item $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \System\BackendBundle\Entity\Item $items
     */
    public function removeItem(\System\BackendBundle\Entity\Item $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }

//    /**
//     * Add categories
//     *
//     * @param \System\BackendBundle\Entity\Category $categories
//     * @return ItemType
//     */
//    public function addCategory(\System\BackendBundle\Entity\Category $categories)
//    {
//        $this->categories[] = $categories;
//
//        return $this;
//    }
//
//    /**
//     * Remove categories
//     *
//     * @param \System\BackendBundle\Entity\Category $categories
//     */
//    public function removeCategory(\System\BackendBundle\Entity\Category $categories)
//    {
//        $this->categories->removeElement($categories);
//    }
//
//    /**
//     * Get categories
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getCategories()
//    {
//        return $this->categories;
//    }

    /**
     * Add services_types
     *
     * @param \System\BackendBundle\Entity\ServiceType $servicesTypes
     * @return ItemType
     */
    public function addServicesType(\System\BackendBundle\Entity\ServiceType $servicesTypes)
    {
        $this->services_types[] = $servicesTypes;

        return $this;
    }

    /**
     * Remove services_types
     *
     * @param \System\BackendBundle\Entity\ServiceType $servicesTypes
     */
    public function removeServicesType(\System\BackendBundle\Entity\ServiceType $servicesTypes)
    {
        $this->services_types->removeElement($servicesTypes);
    }

    /**
     * Get services_types
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServicesTypes()
    {
        return $this->services_types;
    }

    /**
     * Set subcategory
     *
     * @param \System\BackendBundle\Entity\SubCategory $subcategory
     * @return ItemType
     */
    public function setSubcategory(\System\BackendBundle\Entity\SubCategory $subcategory = null)
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
     * Get subcategory
     *
     * @return \System\BackendBundle\Entity\SubCategory 
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
