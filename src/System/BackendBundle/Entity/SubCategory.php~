<?php

namespace System\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubCategory
 *
 * @ORM\Table(name="sub_category")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\SubCategoryRepository")
 */
class SubCategory
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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="subcategories")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     **/
    private $category;

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
     * @return SubCategory
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
     * Set category
     *
     * @param \System\BackendBundle\Entity\Category $category
     * @return SubCategory
     */
    public function setCategory(\System\BackendBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \System\BackendBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
//    /**
//     * Constructor
//     */
//    public function __construct()
//    {
//        $this->items_types = new \Doctrine\Common\Collections\ArrayCollection();
//    }
//
//    /**
//     * Add items_types
//     *
//     * @param \System\BackendBundle\Entity\ItemType $itemsTypes
//     * @return SubCategory
//     */
//    public function addItemsType(\System\BackendBundle\Entity\ItemType $itemsTypes)
//    {
//        $this->items_types[] = $itemsTypes;
//
//        return $this;
//    }
//
//    /**
//     * Remove items_types
//     *
//     * @param \System\BackendBundle\Entity\ItemType $itemsTypes
//     */
//    public function removeItemsType(\System\BackendBundle\Entity\ItemType $itemsTypes)
//    {
//        $this->items_types->removeElement($itemsTypes);
//    }
//
//    /**
//     * Get items_types
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getItemsTypes()
//    {
//        return $this->items_types;
//    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getName();
    }
}
