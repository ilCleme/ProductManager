<?php

namespace QwebCMS\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblCatalogueFeaturevalue
 *
 * @ORM\Table(name="tbl_catalogue_featurevalue")
 * @ORM\Entity
 */
class TblCatalogueFeaturevalue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tbl_catalogue_featurevalue", type="bigint", nullable=false)
     */
    private $idTblCatalogueFeaturevalue;

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
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="link2", type="string", length=255, nullable=true)
     */
    private $link2;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct", mappedBy="featurevalues")
     **/
    private $productsWithFeaturevalue;
    
    /**
     *  @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature", inversedBy="featurevalues")
     *  @ORM\JoinTable(name="cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue",
     *      joinColumns={@ORM\JoinColumn(name="id_item", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_parent", referencedColumnName="id")})
     */
    private $features;


    /**
     * Set idTblCatalogueFeaturevalue
     *
     * @param integer $idTblCatalogueFeaturevalue
     * @return TblCatalogueFeaturevalue
     */
    public function setIdTblCatalogueFeaturevalue($idTblCatalogueFeaturevalue)
    {
        $this->idTblCatalogueFeaturevalue = $idTblCatalogueFeaturevalue;

        return $this;
    }

    /**
     * Get idTblCatalogueFeaturevalue
     *
     * @return integer 
     */
    public function getIdTblCatalogueFeaturevalue()
    {
        return $this->idTblCatalogueFeaturevalue;
    }

    /**
     * Set idTblLingua
     *
     * @param boolean $idTblLingua
     * @return TblCatalogueFeaturevalue
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
     * @return TblCatalogueFeaturevalue
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
     * Set img
     *
     * @param string $img
     * @return TblCatalogueFeaturevalue
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
     * Set link
     *
     * @param string $link
     * @return TblCatalogueFeaturevalue
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set link2
     *
     * @param string $link2
     * @return TblCatalogueFeaturevalue
     */
    public function setLink2($link2)
    {
        $this->link2 = $link2;

        return $this;
    }

    /**
     * Get link2
     *
     * @return string 
     */
    public function getLink2()
    {
        return $this->link2;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return TblCatalogueFeaturevalue
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
     * Constructor
     */
    public function __construct()
    {
        $this->productsWithFeaturevalue = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add productsWithFeaturevalue
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct $productsWithFeaturevalue
     * @return TblCatalogueFeaturevalue
     */
    public function addProductsWithFeaturevalue(\QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct $productsWithFeaturevalue)
    {
        $this->productsWithFeaturevalue[] = $productsWithFeaturevalue;

        return $this;
    }

    /**
     * Remove productsWithFeaturevalue
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct $productsWithFeaturevalue
     */
    public function removeProductsWithFeaturevalue(\QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct $productsWithFeaturevalue)
    {
        $this->productsWithFeaturevalue->removeElement($productsWithFeaturevalue);
    }

    /**
     * Get productsWithFeaturevalue
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductsWithFeaturevalue()
    {
        return $this->productsWithFeaturevalue;
    }

    /**
     * Add features
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature $features
     * @return TblCatalogueFeaturevalue
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
}
