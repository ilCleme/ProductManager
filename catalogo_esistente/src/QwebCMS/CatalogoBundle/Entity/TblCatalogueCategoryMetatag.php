<?php

namespace QwebCMS\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblCatalogueCategoryMetatag
 *
 * @ORM\Table(name="tbl_catalogue_category_metatag", uniqueConstraints={@ORM\UniqueConstraint(name="id_tbl_cataloguefip_category", columns={"id_tbl_catalogue_category", "id_tbl_lingua"})})
 * @ORM\Entity
 */
class TblCatalogueCategoryMetatag
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tbl_catalogue_category", type="bigint", nullable=true)
     */
    private $idTblCatalogueCategory;

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
     * Set idTblCatalogueCategory
     *
     * @param integer $idTblCatalogueCategory
     * @return TblCatalogueCategoryMetatag
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
     * @param integer $idTblLingua
     * @return TblCatalogueCategoryMetatag
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
     * @return TblCatalogueCategoryMetatag
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
     * @return TblCatalogueCategoryMetatag
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
     * @return TblCatalogueCategoryMetatag
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
     * @return TblCatalogueCategoryMetatag
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
     * @return TblCatalogueCategoryMetatag
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
     * @return TblCatalogueCategoryMetatag
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
