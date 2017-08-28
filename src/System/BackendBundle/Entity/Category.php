<?php

namespace System\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="System\BackendBundle\Repository\CategoryRepository")
 */
class Category
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

//    /**
//     * @ORM\ManyToOne(targetEntity="ItemType", inversedBy="categories")
//     * @ORM\JoinColumn(name="itemtype_id", referencedColumnName="id")
//     **/
//    private $itemtype;

    /**
     * @ORM\OneToMany(targetEntity="SubCategory", mappedBy="category")
     **/
    private $subcategories;

    public function __construct() {
//        $this->categories = new ArrayCollection();
        $this->subcategories = new ArrayCollection();
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
     * @return Category
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

//    /**
//     * Set itemtype
//     *
//     * @param \System\BackendBundle\Entity\ItemType $itemtype
//     * @return Category
//     */
//    public function setItemtype(\System\BackendBundle\Entity\ItemType $itemtype = null)
//    {
//        $this->itemtype = $itemtype;
//
//        return $this;
//    }
//
//    /**
//     * Get itemtype
//     *
//     * @return \System\BackendBundle\Entity\ItemType
//     */
//    public function getItemtype()
//    {
//        return $this->itemtype;
//    }

    /**
     * Add subcategories
     *
     * @param \System\BackendBundle\Entity\SubCategory $subcategories
     * @return Category
     */
    public function addSubcategory(\System\BackendBundle\Entity\SubCategory $subcategories)
    {
        $this->subcategories[] = $subcategories;

        return $this;
    }

    /**
     * Remove subcategories
     *
     * @param \System\BackendBundle\Entity\SubCategory $subcategories
     */
    public function removeSubcategory(\System\BackendBundle\Entity\SubCategory $subcategories)
    {
        $this->subcategories->removeElement($subcategories);
    }

    /**
     * Get subcategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }
}
