<?php

namespace QwebCMS\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblCatalogueFieldsearch
 *
 * @ORM\Table(name="tbl_catalogue_fieldsearch", indexes={@ORM\Index(name="getname", columns={"getname"})})
 * @ORM\Entity
 */
class TblCatalogueFieldsearch
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tbl_catalogue_fieldsearch", type="bigint", nullable=false)
     */
    private $idTblCatalogueFieldsearch;

    /**
     * @var boolean
     *
     * @ORM\Column(name="id_tbl_lingua", type="boolean", nullable=false)
     */
    private $idTblLingua;

    /**
     * @var string
     *
     * @ORM\Column(name="id_tbl_catalogue_category", type="string", length=255, nullable=true)
     */
    private $idTblCatalogueCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="getname", type="string", length=255, nullable=false)
     */
    private $getname;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="typeinput", type="string", length=255, nullable=false)
     */
    private $typeinput;

    /**
     * @var boolean
     *
     * @ORM\Column(name="compulsory", type="boolean", nullable=false)
     */
    private $compulsory;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showOnlyValued", type="boolean", nullable=false)
     */
    private $showonlyvalued;

    /**
     * @var string
     *
     * @ORM\Column(name="typesearch", type="string", length=255, nullable=false)
     */
    private $typesearch;

    /**
     * @var string
     *
     * @ORM\Column(name="tablerif", type="string", length=255, nullable=false)
     */
    private $tablerif;

    /**
     * @var string
     *
     * @ORM\Column(name="elementrif", type="string", length=255, nullable=false)
     */
    private $elementrif;

    /**
     * @var string
     *
     * @ORM\Column(name="findin", type="string", length=255, nullable=false)
     */
    private $findin;

    /**
     * @var string
     *
     * @ORM\Column(name="conditionBetweenField", type="string", length=255, nullable=false)
     */
    private $conditionbetweenfield;

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
     * Set idTblCatalogueFieldsearch
     *
     * @param integer $idTblCatalogueFieldsearch
     * @return TblCatalogueFieldsearch
     */
    public function setIdTblCatalogueFieldsearch($idTblCatalogueFieldsearch)
    {
        $this->idTblCatalogueFieldsearch = $idTblCatalogueFieldsearch;

        return $this;
    }

    /**
     * Get idTblCatalogueFieldsearch
     *
     * @return integer 
     */
    public function getIdTblCatalogueFieldsearch()
    {
        return $this->idTblCatalogueFieldsearch;
    }

    /**
     * Set idTblLingua
     *
     * @param boolean $idTblLingua
     * @return TblCatalogueFieldsearch
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
     * Set idTblCatalogueCategory
     *
     * @param string $idTblCatalogueCategory
     * @return TblCatalogueFieldsearch
     */
    public function setIdTblCatalogueCategory($idTblCatalogueCategory)
    {
        $this->idTblCatalogueCategory = $idTblCatalogueCategory;

        return $this;
    }

    /**
     * Get idTblCatalogueCategory
     *
     * @return string 
     */
    public function getIdTblCatalogueCategory()
    {
        return $this->idTblCatalogueCategory;
    }

    /**
     * Set getname
     *
     * @param string $getname
     * @return TblCatalogueFieldsearch
     */
    public function setGetname($getname)
    {
        $this->getname = $getname;

        return $this;
    }

    /**
     * Get getname
     *
     * @return string 
     */
    public function getGetname()
    {
        return $this->getname;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return TblCatalogueFieldsearch
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
     * Set typeinput
     *
     * @param string $typeinput
     * @return TblCatalogueFieldsearch
     */
    public function setTypeinput($typeinput)
    {
        $this->typeinput = $typeinput;

        return $this;
    }

    /**
     * Get typeinput
     *
     * @return string 
     */
    public function getTypeinput()
    {
        return $this->typeinput;
    }

    /**
     * Set compulsory
     *
     * @param boolean $compulsory
     * @return TblCatalogueFieldsearch
     */
    public function setCompulsory($compulsory)
    {
        $this->compulsory = $compulsory;

        return $this;
    }

    /**
     * Get compulsory
     *
     * @return boolean 
     */
    public function getCompulsory()
    {
        return $this->compulsory;
    }

    /**
     * Set showonlyvalued
     *
     * @param boolean $showonlyvalued
     * @return TblCatalogueFieldsearch
     */
    public function setShowonlyvalued($showonlyvalued)
    {
        $this->showonlyvalued = $showonlyvalued;

        return $this;
    }

    /**
     * Get showonlyvalued
     *
     * @return boolean 
     */
    public function getShowonlyvalued()
    {
        return $this->showonlyvalued;
    }

    /**
     * Set typesearch
     *
     * @param string $typesearch
     * @return TblCatalogueFieldsearch
     */
    public function setTypesearch($typesearch)
    {
        $this->typesearch = $typesearch;

        return $this;
    }

    /**
     * Get typesearch
     *
     * @return string 
     */
    public function getTypesearch()
    {
        return $this->typesearch;
    }

    /**
     * Set tablerif
     *
     * @param string $tablerif
     * @return TblCatalogueFieldsearch
     */
    public function setTablerif($tablerif)
    {
        $this->tablerif = $tablerif;

        return $this;
    }

    /**
     * Get tablerif
     *
     * @return string 
     */
    public function getTablerif()
    {
        return $this->tablerif;
    }

    /**
     * Set elementrif
     *
     * @param string $elementrif
     * @return TblCatalogueFieldsearch
     */
    public function setElementrif($elementrif)
    {
        $this->elementrif = $elementrif;

        return $this;
    }

    /**
     * Get elementrif
     *
     * @return string 
     */
    public function getElementrif()
    {
        return $this->elementrif;
    }

    /**
     * Set findin
     *
     * @param string $findin
     * @return TblCatalogueFieldsearch
     */
    public function setFindin($findin)
    {
        $this->findin = $findin;

        return $this;
    }

    /**
     * Get findin
     *
     * @return string 
     */
    public function getFindin()
    {
        return $this->findin;
    }

    /**
     * Set conditionbetweenfield
     *
     * @param string $conditionbetweenfield
     * @return TblCatalogueFieldsearch
     */
    public function setConditionbetweenfield($conditionbetweenfield)
    {
        $this->conditionbetweenfield = $conditionbetweenfield;

        return $this;
    }

    /**
     * Get conditionbetweenfield
     *
     * @return string 
     */
    public function getConditionbetweenfield()
    {
        return $this->conditionbetweenfield;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return TblCatalogueFieldsearch
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
}
