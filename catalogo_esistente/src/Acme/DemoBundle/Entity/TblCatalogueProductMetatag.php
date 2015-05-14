<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblCatalogueProductMetatag
 *
 * @ORM\Table(name="tbl_catalogue_product_metatag", uniqueConstraints={@ORM\UniqueConstraint(name="id_tbl_cataloguefip_product", columns={"id_tbl_catalogue_product", "id_tbl_lingua"})})
 * @ORM\Entity
 */
class TblCatalogueProductMetatag
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tbl_catalogue_product", type="bigint", nullable=false)
     */
    private $idTblCatalogueProduct;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tbl_lingua", type="integer", nullable=true)
     */
    private $idTblLingua;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_tag_title", type="string", length=100, nullable=true)
     */
    private $metaTagTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_tag_charset", type="string", length=30, nullable=true)
     */
    private $metaTagCharset;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_tag_generator", type="string", length=100, nullable=true)
     */
    private $metaTagGenerator;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_tag_author", type="string", length=100, nullable=true)
     */
    private $metaTagAuthor;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_tag_description", type="string", length=255, nullable=true)
     */
    private $metaTagDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_tag_keywords", type="string", length=255, nullable=true)
     */
    private $metaTagKeywords;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set idTblCatalogueProduct
     *
     * @param integer $idTblCatalogueProduct
     * @return TblCatalogueProductMetatag
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
     * @param integer $idTblLingua
     * @return TblCatalogueProductMetatag
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
     * Set metaTagTitle
     *
     * @param string $metaTagTitle
     * @return TblCatalogueProductMetatag
     */
    public function setMetaTagTitle($metaTagTitle)
    {
        $this->metaTagTitle = $metaTagTitle;

        return $this;
    }

    /**
     * Get metaTagTitle
     *
     * @return string 
     */
    public function getMetaTagTitle()
    {
        return $this->metaTagTitle;
    }

    /**
     * Set metaTagCharset
     *
     * @param string $metaTagCharset
     * @return TblCatalogueProductMetatag
     */
    public function setMetaTagCharset($metaTagCharset)
    {
        $this->metaTagCharset = $metaTagCharset;

        return $this;
    }

    /**
     * Get metaTagCharset
     *
     * @return string 
     */
    public function getMetaTagCharset()
    {
        return $this->metaTagCharset;
    }

    /**
     * Set metaTagGenerator
     *
     * @param string $metaTagGenerator
     * @return TblCatalogueProductMetatag
     */
    public function setMetaTagGenerator($metaTagGenerator)
    {
        $this->metaTagGenerator = $metaTagGenerator;

        return $this;
    }

    /**
     * Get metaTagGenerator
     *
     * @return string 
     */
    public function getMetaTagGenerator()
    {
        return $this->metaTagGenerator;
    }

    /**
     * Set metaTagAuthor
     *
     * @param string $metaTagAuthor
     * @return TblCatalogueProductMetatag
     */
    public function setMetaTagAuthor($metaTagAuthor)
    {
        $this->metaTagAuthor = $metaTagAuthor;

        return $this;
    }

    /**
     * Get metaTagAuthor
     *
     * @return string 
     */
    public function getMetaTagAuthor()
    {
        return $this->metaTagAuthor;
    }

    /**
     * Set metaTagDescription
     *
     * @param string $metaTagDescription
     * @return TblCatalogueProductMetatag
     */
    public function setMetaTagDescription($metaTagDescription)
    {
        $this->metaTagDescription = $metaTagDescription;

        return $this;
    }

    /**
     * Get metaTagDescription
     *
     * @return string 
     */
    public function getMetaTagDescription()
    {
        return $this->metaTagDescription;
    }

    /**
     * Set metaTagKeywords
     *
     * @param string $metaTagKeywords
     * @return TblCatalogueProductMetatag
     */
    public function setMetaTagKeywords($metaTagKeywords)
    {
        $this->metaTagKeywords = $metaTagKeywords;

        return $this;
    }

    /**
     * Get metaTagKeywords
     *
     * @return string 
     */
    public function getMetaTagKeywords()
    {
        return $this->metaTagKeywords;
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
}
