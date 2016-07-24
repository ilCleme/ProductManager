<?php

namespace QwebCMS\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="tbl_catalogue_category")
 * @ORM\Entity
 */
class Categoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tbl_catalogue_category", type="bigint", nullable=false)
     */
    private $idTblCatalogueCategory = 0;

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
     * @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct", mappedBy="categories")
     **/
    private $products;
    
    /**
     * @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\Categoria", mappedBy="categoriesParent")
     **/
    protected $parentOfCategories;

    /**
     * @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\Categoria", inversedBy="parentOfCategories")
     * @ORM\JoinTable(name="cross_tbl_catalogue_category_x_tbl_catalogue_category",
     *      joinColumns={@ORM\JoinColumn(name="id_item", referencedColumnName="id_tbl_catalogue_category")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_parent", referencedColumnName="id_tbl_catalogue_category")}
     *      )
     **/
    protected $categoriesParent;

    /**
     * @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature", inversedBy="categories")
     * @ORM\JoinTable(name="cross_tbl_catalogue_category_x_tbl_catalogue_feature",
     *      joinColumns={@ORM\JoinColumn(name="id_parent", referencedColumnName="id_tbl_catalogue_category")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_item", referencedColumnName="id_tbl_catalogue_feature")}
     *      )
     **/
    protected $features;
    
    
    public function __construct() {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parentOfCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categoriesParent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->features = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set idTblCatalogueCategory
     *
     * @param integer $idTblCatalogueCategory
     * @return Categoria
     */
    public function setIdTblCatalogueCategory($idTblCatalogueCategory)
    {
        $this->idTblCatalogueCategory = $idTblCatalogueCategory;

        return $this;
    }

    /**
     * Get idTblCatalogueCategory
     *
     * @return integer 
     */
    public function getIdTblCatalogueCategory()
    {
        return $this->idTblCatalogueCategory;
    }

    /**
     * Set idTblLingua
     *
     * @param boolean $idTblLingua
     * @return Categoria
     */
    public function setIdTblLingua($idTblLingua)
    {
        $this->idTblLingua = $idTblLingua;

        return $this;
    }

    /**
     * Get idTblLingua
     *
     * @return boolean 
     */
    public function getIdTblLingua()
    {
        return $this->idTblLingua;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Categoria
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
     * @return Categoria
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
     * Set position
     *
     * @param integer $position
     * @return Categoria
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add products
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct $products
     * @return Categoria
     */
    public function addProduct(\QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct $products
     */
    public function removeProduct(\QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct $products)
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
     * @param \QwebCMS\CatalogoBundle\Entity\Categoria $parentOfCategories
     * @return Categoria
     */
    public function addParentOfCategory(\QwebCMS\CatalogoBundle\Entity\Categoria $parentOfCategories)
    {
        $this->parentOfCategories[] = $parentOfCategories;

        return $this;
    }

    /**
     * Remove parentOfCategories
     *
     * @param \QwebCMS\CatalogoBundle\Entity\Categoria $parentOfCategories
     */
    public function removeParentOfCategory(\QwebCMS\CatalogoBundle\Entity\Categoria $parentOfCategories)
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
     * @param \QwebCMS\CatalogoBundle\Entity\Categoria $categoriesParent
     * @return Categoria
     */
    public function addCategoriesParent(\QwebCMS\CatalogoBundle\Entity\Categoria $categoriesParent)
    {
        $this->categoriesParent[] = $categoriesParent;

        return $this;
    }

    /**
     * Remove categoriesParent
     *
     * @param \QwebCMS\CatalogoBundle\Entity\Categoria $categoriesParent
     */
    public function removeCategoriesParent(\QwebCMS\CatalogoBundle\Entity\Categoria $categoriesParent)
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
     * Set img
     *
     * @param string $img
     * @return Categoria
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
     * Set pub
     *
     * @param boolean $pub
     * @return Categoria
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
     * Add features
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature $features
     * @return Categoria
     */
    public function addFeature(\QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature $features)
    {
        $this->features[] = $features;

        return $this;
    }

    /**
     * Remove features
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature $features
     */
    public function removeFeature(\QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature $features)
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
}
