<?php

namespace QwebCMS\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblCatalogueFeature
 *
 * @ORM\Table(name="tbl_catalogue_feature")
 * @ORM\Entity
 */
class TblCatalogueFeature
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tbl_catalogue_feature", type="bigint", nullable=false)
     */
    private $idTblCatalogueFeature = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="id_tbl_lingua", type="boolean", nullable=false)
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
     * @ORM\Column(name="type_input", type="string", length=255, nullable=false)
     */
    private $typeInput;

    /**
     * @var boolean
     *
     * @ORM\Column(name="compulsory", type="boolean", nullable=false)
     */
    private $compulsory;

    /**
     * @var string
     *
     * @ORM\Column(name="display", type="string", length=255, nullable=false)
     */
    private $display;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="inherit_from", type="integer", nullable=false)
     */
    private $inheritFrom = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue", mappedBy="features")
     **/
    private $featurevalues;


    /**
     * Set idTblCatalogueFeature
     *
     * @param integer $idTblCatalogueFeature
     * @return TblCatalogueFeature
     */
    public function setIdTblCatalogueFeature($idTblCatalogueFeature)
    {
        $this->idTblCatalogueFeature = $idTblCatalogueFeature;

        return $this;
    }

    /**
     * Get idTblCatalogueFeature
     *
     * @return integer 
     */
    public function getIdTblCatalogueFeature()
    {
        return $this->idTblCatalogueFeature;
    }

    /**
     * Set idTblLingua
     *
     * @param boolean $idTblLingua
     * @return TblCatalogueFeature
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
     * @return TblCatalogueFeature
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
     * @return TblCatalogueFeature
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
     * Set typeInput
     *
     * @param string $typeInput
     * @return TblCatalogueFeature
     */
    public function setTypeInput($typeInput)
    {
        $this->typeInput = $typeInput;

        return $this;
    }

    /**
     * Get typeInput
     *
     * @return string 
     */
    public function getTypeInput()
    {
        return $this->typeInput;
    }

    /**
     * Set compulsory
     *
     * @param boolean $compulsory
     * @return TblCatalogueFeature
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
     * Set display
     *
     * @param string $display
     * @return TblCatalogueFeature
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Get display
     *
     * @return string 
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return TblCatalogueFeature
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
        $this->featurevalues = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add featurevalues
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue $featurevalues
     * @return TblCatalogueFeature
     */
    public function addFeaturevalue(\QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue $featurevalues)
    {
        $this->featurevalues[] = $featurevalues;

        return $this;
    }

    /**
     * Remove featurevalues
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue $featurevalues
     */
    public function removeFeaturevalue(\QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue $featurevalues)
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
     * Set inheritFrom
     *
     * @param integer $inheritFrom
     * @return TblCatalogueFeature
     */
    public function setInheritFrom($inheritFrom)
    {
        $this->inheritFrom = $inheritFrom;

        return $this;
    }

    /**
     * Get inheritFrom
     *
     * @return integer 
     */
    public function getInheritFrom()
    {
        return $this->inheritFrom;
    }
}
