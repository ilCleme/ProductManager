<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TblCatalogueProduct
 *
 * @ORM\Table(name="tbl_catalogue_product")
 * @ORM\Entity(repositoryClass="Acme\DemoBundle\Entity\TblCatalogueProductRepository")
 */
class TblCatalogueProduct
{
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
     * @ORM\Column(name="short_description", type="text", nullable=true)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="cod", type="string", length=255, nullable=false)
     */
    private $cod;

    /**
     * @var string
     *
     * @ORM\Column(name="img_thumb", type="string", length=255, nullable=true)
     */
    private $imgThumb;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="img_finiture1", type="string", length=255, nullable=true)
     */
    private $imgFiniture1;

    /**
     * @var string
     *
     * @ORM\Column(name="img_finiture2", type="string", length=255, nullable=true)
     */
    private $imgFiniture2;

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
    private $featured;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_old", type="bigint", nullable=false)
     */
    private $idOld;

    /**
     * @var float
     *
     * @ORM\Column(name="price_list", type="float", precision=10, scale=0, nullable=false)
     */
    private $priceList;

    /**
     * @var float
     *
     * @ORM\Column(name="price_sale", type="float", precision=10, scale=0, nullable=false)
     */
    private $priceSale;

    /**
     * @var float
     *
     * @ORM\Column(name="price_offer", type="float", precision=10, scale=0, nullable=false)
     */
    private $priceOffer;

    /**
     * @var string
     *
     * @ORM\Column(name="punto_vendita", type="string", length=255, nullable=true)
     */
    private $puntoVendita;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *  @ORM\ManyToMany(targetEntity="Acme\DemoBundle\Entity\TblCatalogueCategory", inversedBy="products")
     *  @ORM\JoinTable(name="cross_tbl_catalogue_category_x_tbl_catalogue_product",
     *      joinColumns={@ORM\JoinColumn(name="id_item", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_parent", referencedColumnName="id")})
     */
    private $categories;
    
    /**
     *  @ORM\ManyToMany(targetEntity="Acme\DemoBundle\Entity\TblCatalogueFeaturevalue", inversedBy="productsWithFeaturevalue")
     *  @ORM\JoinTable(name="cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue",
     *      joinColumns={@ORM\JoinColumn(name="id_item", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_parent", referencedColumnName="id")})
     */
    private $featurevalues;
    
    public function __construct() {
        $this->categories = new ArrayCollection();
        $this->featurevalues = new ArrayCollection();
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
     * Set imgThumb
     *
     * @param string $imgThumb
     * @return TblCatalogueProduct
     */
    public function setImgThumb($imgThumb)
    {
        $this->imgThumb = $imgThumb;

        return $this;
    }

    /**
     * Get imgThumb
     *
     * @return string 
     */
    public function getImgThumb()
    {
        return $this->imgThumb;
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
     * Set imgFiniture1
     *
     * @param string $imgFiniture1
     * @return TblCatalogueProduct
     */
    public function setImgFiniture1($imgFiniture1)
    {
        $this->imgFiniture1 = $imgFiniture1;

        return $this;
    }

    /**
     * Get imgFiniture1
     *
     * @return string 
     */
    public function getImgFiniture1()
    {
        return $this->imgFiniture1;
    }

    /**
     * Set imgFiniture2
     *
     * @param string $imgFiniture2
     * @return TblCatalogueProduct
     */
    public function setImgFiniture2($imgFiniture2)
    {
        $this->imgFiniture2 = $imgFiniture2;

        return $this;
    }

    /**
     * Get imgFiniture2
     *
     * @return string 
     */
    public function getImgFiniture2()
    {
        return $this->imgFiniture2;
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
     * Set idOld
     *
     * @param integer $idOld
     * @return TblCatalogueProduct
     */
    public function setIdOld($idOld)
    {
        $this->idOld = $idOld;

        return $this;
    }

    /**
     * Get idOld
     *
     * @return integer 
     */
    public function getIdOld()
    {
        return $this->idOld;
    }

    /**
     * Set priceList
     *
     * @param float $priceList
     * @return TblCatalogueProduct
     */
    public function setPriceList($priceList)
    {
        $this->priceList = $priceList;

        return $this;
    }

    /**
     * Get priceList
     *
     * @return float 
     */
    public function getPriceList()
    {
        return $this->priceList;
    }

    /**
     * Set priceSale
     *
     * @param float $priceSale
     * @return TblCatalogueProduct
     */
    public function setPriceSale($priceSale)
    {
        $this->priceSale = $priceSale;

        return $this;
    }

    /**
     * Get priceSale
     *
     * @return float 
     */
    public function getPriceSale()
    {
        return $this->priceSale;
    }

    /**
     * Set priceOffer
     *
     * @param float $priceOffer
     * @return TblCatalogueProduct
     */
    public function setPriceOffer($priceOffer)
    {
        $this->priceOffer = $priceOffer;

        return $this;
    }

    /**
     * Get priceOffer
     *
     * @return float 
     */
    public function getPriceOffer()
    {
        return $this->priceOffer;
    }

    /**
     * Set puntoVendita
     *
     * @param string $puntoVendita
     * @return TblCatalogueProduct
     */
    public function setPuntoVendita($puntoVendita)
    {
        $this->puntoVendita = $puntoVendita;

        return $this;
    }

    /**
     * Get puntoVendita
     *
     * @return string 
     */
    public function getPuntoVendita()
    {
        return $this->puntoVendita;
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
     * @param \Acme\DemoBundle\Entity\TblCatalogueCategory $categories
     * @return TblCatalogueProduct
     */
    public function addCategory(\Acme\DemoBundle\Entity\TblCatalogueCategory $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Acme\DemoBundle\Entity\TblCatalogueCategory $categories
     */
    public function removeCategory(\Acme\DemoBundle\Entity\TblCatalogueCategory $categories)
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
     * @param \Acme\DemoBundle\Entity\TblCatalogueCategory $featurevalues
     * @return TblCatalogueProduct
     */
    public function addFeaturevalue(\Acme\DemoBundle\Entity\TblCatalogueCategory $featurevalues)
    {
        $this->featurevalues[] = $featurevalues;

        return $this;
    }

    /**
     * Remove featurevalues
     *
     * @param \Acme\DemoBundle\Entity\TblCatalogueCategory $featurevalues
     */
    public function removeFeaturevalue(\Acme\DemoBundle\Entity\TblCatalogueCategory $featurevalues)
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
}
