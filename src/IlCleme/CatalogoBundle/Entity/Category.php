<?php

namespace IlCleme\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var UUID
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tbl_lingua", type="bigint", nullable=false)
     */
    private $idTblLingua = 4;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pub", type="boolean", nullable=false)
     */
    private $pub;

    /**
     * @ORM\ManyToMany(targetEntity="IlCleme\CatalogoBundle\Entity\Product", mappedBy="categories")
     **/
    private $products;
    
    /**
     * @ORM\ManyToMany(targetEntity="IlCleme\CatalogoBundle\Entity\Category", mappedBy="categoriesParent")
     **/
    protected $parentOfCategories;

    /**
     * @ORM\ManyToMany(targetEntity="IlCleme\CatalogoBundle\Entity\Category", inversedBy="parentOfCategories")
     **/
    protected $categoriesParent;

    /**
     * @ORM\ManyToMany(targetEntity="IlCleme\CatalogoBundle\Entity\Feature", inversedBy="categories")
     * @ORM\JoinTable(name="categories_features")
     **/
    protected $features;
    
    
    public function __construct() {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parentOfCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categoriesParent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->features = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get features for a specific Language
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeaturesByLanguage($id_language)
    {
        $features = $this->features;
        $arrayFeature = new \Doctrine\Common\Collections\ArrayCollection();
        foreach($features as $feature){
            if ($feature->getIdTblLingua() == $id_language){
                $arrayFeature->add($feature);
            }
        }

        return $arrayFeature;
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
     * Set idTblLingua
     *
     * @param integer $idTblLingua
     * @return Category
     */
    public function setIdTblLingua($idTblLingua)
    {
        $this->idTblLingua = $idTblLingua;

        return $this;
    }

    /**
     * Get idTblLingua
     *
     * @return integer 
     */
    public function getIdTblLingua()
    {
        return $this->idTblLingua;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return Category
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Category
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set pub
     *
     * @param boolean $pub
     * @return Category
     */
    public function setPub($pub)
    {
        $this->pub = $pub;

        return $this;
    }

    /**
     * Get pub
     *
     * @return boolean 
     */
    public function getPub()
    {
        return $this->pub;
    }

    /**
     * Add products
     *
     * @param \IlCleme\CatalogoBundle\Entity\Product $products
     * @return Category
     */
    public function addProduct(\IlCleme\CatalogoBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \IlCleme\CatalogoBundle\Entity\Product $products
     */
    public function removeProduct(\IlCleme\CatalogoBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add parentOfCategories
     *
     * @param \IlCleme\CatalogoBundle\Entity\Category $parentOfCategories
     * @return Category
     */
    public function addParentOfCategory(\IlCleme\CatalogoBundle\Entity\Category $parentOfCategories)
    {
        $this->parentOfCategories[] = $parentOfCategories;

        return $this;
    }

    /**
     * Remove parentOfCategories
     *
     * @param \IlCleme\CatalogoBundle\Entity\Category $parentOfCategories
     */
    public function removeParentOfCategory(\IlCleme\CatalogoBundle\Entity\Category $parentOfCategories)
    {
        $this->parentOfCategories->removeElement($parentOfCategories);
    }

    /**
     * Get parentOfCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParentOfCategories()
    {
        return $this->parentOfCategories;
    }

    /**
     * Add categoriesParent
     *
     * @param \IlCleme\CatalogoBundle\Entity\Category $categoriesParent
     * @return Category
     */
    public function addCategoriesParent(\IlCleme\CatalogoBundle\Entity\Category $categoriesParent)
    {
        $this->categoriesParent[] = $categoriesParent;

        return $this;
    }

    /**
     * Remove categoriesParent
     *
     * @param \IlCleme\CatalogoBundle\Entity\Category $categoriesParent
     */
    public function removeCategoriesParent(\IlCleme\CatalogoBundle\Entity\Category $categoriesParent)
    {
        $this->categoriesParent->removeElement($categoriesParent);
    }

    /**
     * Get categoriesParent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategoriesParent()
    {
        return $this->categoriesParent;
    }

    /**
     * Add features
     *
     * @param \IlCleme\CatalogoBundle\Entity\Feature $features
     * @return Category
     */
    public function addFeature(\IlCleme\CatalogoBundle\Entity\Feature $features)
    {
        $this->features[] = $features;

        return $this;
    }

    /**
     * Remove features
     *
     * @param \IlCleme\CatalogoBundle\Entity\Feature $features
     */
    public function removeFeature(\IlCleme\CatalogoBundle\Entity\Feature $features)
    {
        $this->features->removeElement($features);
    }

    /**
     * Get features
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFeatures()
    {
        return $this->features;
    }
}
