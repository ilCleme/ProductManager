<?php

namespace QwebCMS\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TblCatalogueProduct
 *
 * @ORM\Table(name="tbl_catalogue_product")
 * @ORM\Entity(repositoryClass="QwebCMS\CatalogoBundle\Entity\TblCatalogueProductRepository")
 */
class TblCatalogueProduct
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
     * @ORM\Column(name="id_tbl_catalogue_product", type="bigint", nullable=false)
     */
    private $idTblCatalogueProduct;

    /**
     * @var boolean
     *
     * @ORM\Column(name="id_tbl_lingua", type="boolean", nullable=false)
     */
    private $idTblLingua;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="description_notag", type="text", nullable=true)
     */
    private $descriptionNotag;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=255, nullable=true)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="cod", type="string", length=255, nullable=true)
     */
    private $cod;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tbl_photo_cat", type="integer", nullable=false)
     */
    private $idTblPhotoCat;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=255, nullable=true)
     */
    private $template;

    /**
     * @var string
     *
     * @ORM\Column(name="coordinate", type="string", length=255, nullable=true)
     */
    private $coordinate;

    /**
     * @var string
     *
     * @ORM\Column(name="indirizzo", type="string", length=255, nullable=true)
     */
    private $indirizzo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pub", type="boolean", nullable=false)
     */
    private $pub;

    /**
     * @var boolean
     *
     * @ORM\Column(name="featured", type="boolean", nullable=true)
     */
    private $featured = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;
    
    /**
     *  @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory", inversedBy="products")
     *  @ORM\JoinTable(name="cross_tbl_catalogue_category_x_tbl_catalogue_product",
     *      joinColumns={@ORM\JoinColumn(name="id_item", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_parent", referencedColumnName="id")})
     */
    private $categories;
    
    /**
     *  @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue", inversedBy="productsWithFeaturevalue")
     *  @ORM\JoinTable(name="cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue",
     *      joinColumns={@ORM\JoinColumn(name="id_parent", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_item", referencedColumnName="id")})
     */
    private $featurevalues;
    
    public function __construct() {
        $this->categories = new ArrayCollection();
        $this->featurevalues = new ArrayCollection();
        $this->setIdTblLingua(4);
    }


    /**
     * Set idTblCatalogueProduct
     *
     * @param integer $idTblCatalogueProduct
     * @return TblCatalogueProduct
     */
    public function setIdTblCatalogueProduct($idTblCatalogueProduct)
    {
        $this->idTblCatalogueProduct = $idTblCatalogueProduct;

        return $this;
    }

    /**
     * Get idTblCatalogueProduct
     *
     * @return integer 
     */
    public function getIdTblCatalogueProduct()
    {
        return $this->idTblCatalogueProduct;
    }

    /**
     * Set idTblLingua
     *
     * @param boolean $idTblLingua
     * @return TblCatalogueProduct
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
     * @return TblCatalogueProduct
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
     * @return TblCatalogueProduct
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
     * Set descriptionNotag
     *
     * @param string $descriptionNotag
     * @return TblCatalogueProduct
     */
    public function setDescriptionNotag($descriptionNotag)
    {
        $this->descriptionNotag = $descriptionNotag;

        return $this;
    }

    /**
     * Get descriptionNotag
     *
     * @return string 
     */
    public function getDescriptionNotag()
    {
        return $this->descriptionNotag;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return TblCatalogueProduct
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return TblCatalogueProduct
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
     * Set idTblPhotoCat
     *
     * @param integer $idTblPhotoCat
     * @return TblCatalogueProduct
     */
    public function setIdTblPhotoCat($idTblPhotoCat)
    {
        $this->idTblPhotoCat = $idTblPhotoCat;

        return $this;
    }

    /**
     * Get idTblPhotoCat
     *
     * @return integer 
     */
    public function getIdTblPhotoCat()
    {
        return $this->idTblPhotoCat;
    }

    /**
     * Set template
     *
     * @param string $template
     * @return TblCatalogueProduct
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string 
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set pub
     *
     * @param boolean $pub
     * @return TblCatalogueProduct
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
     * Set position
     *
     * @param integer $position
     * @return TblCatalogueProduct
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
     * Add categories
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory $categories
     * @return TblCatalogueProduct
     */
    public function addCategory(\QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory $categories
     */
    public function removeCategory(\QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add featurevalues
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory $featurevalues
     * @return TblCatalogueProduct
     */
    public function addFeaturevalue(\QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory $featurevalues)
    {
        $this->featurevalues[] = $featurevalues;

        return $this;
    }

    /**
     * Remove featurevalues
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory $featurevalues
     */
    public function removeFeaturevalue(\QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory $featurevalues)
    {
        $this->featurevalues->removeElement($featurevalues);
    }

    /**
     * Get featurevalues
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFeaturevalues()
    {
        return $this->featurevalues;
    }
    

    /**
     * Set cod
     *
     * @param string $cod
     * @return TblCatalogueProduct
     */
    public function setCod($cod)
    {
        $this->cod = $cod;

        return $this;
    }

    /**
     * Get cod
     *
     * @return string 
     */
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * Set featured
     *
     * @param boolean $featured
     * @return TblCatalogueProduct
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return boolean 
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set coordinate
     *
     * @param string $coordinate
     * @return TblCatalogueProduct
     */
    public function setCoordinate($coordinate)
    {
        $this->coordinate = $coordinate;

        return $this;
    }

    /**
     * Get coordinate
     *
     * @return string 
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * Set indirizzo
     *
     * @param string $indirizzo
     * @return TblCatalogueProduct
     */
    public function setIndirizzo($indirizzo)
    {
        $this->indirizzo = $indirizzo;

        return $this;
    }

    /**
     * Get indirizzo
     *
     * @return string 
     */
    public function getIndirizzo()
    {
        return $this->indirizzo;
    }
}
