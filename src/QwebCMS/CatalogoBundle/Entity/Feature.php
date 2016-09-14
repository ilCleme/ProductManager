<?php

namespace QwebCMS\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feature
 *
 * @ORM\Table(name="feature")
 * @ORM\Entity(repositoryClass="QwebCMS\CatalogoBundle\Entity\FeatureRepository")
 */
class Feature
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
     * @ORM\Column(name="type_input", type="string", length=255, nullable=false)
     */
    private $typeInput;

    /**
     * @var boolean
     *
     * @ORM\Column(name="compulsory", type="integer", nullable=false)
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
     *
     * @ORM\OneToOne(targetEntity="QwebCMS\CatalogoBundle\Entity\Feature")
     * @ORM\JoinColumn(name="inherit_from", referencedColumnName="id")
     *
     */
    private $inheritFrom;

    /**
     * @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\Featurevalue", mappedBy="features")
     **/
    private $featurevalues;

    /**
     * @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\Category", mappedBy="features")
     **/
    private $categories;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->featurevalues = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Feature
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
     * @return Feature
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
     * @return Feature
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
     * @return Feature
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
     * @param integer $compulsory
     * @return Feature
     */
    public function setCompulsory($compulsory)
    {
        $this->compulsory = $compulsory;

        return $this;
    }

    /**
     * Get compulsory
     *
     * @return integer 
     */
    public function getCompulsory()
    {
        return $this->compulsory;
    }

    /**
     * Set display
     *
     * @param string $display
     * @return Feature
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
     * @return Feature
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
     * Set inheritFrom
     *
     * @param \QwebCMS\CatalogoBundle\Entity\Feature $inheritFrom
     * @return Feature
     */
    public function setInheritFrom(\QwebCMS\CatalogoBundle\Entity\Feature $inheritFrom = null)
    {
        $this->inheritFrom = $inheritFrom;

        return $this;
    }

    /**
     * Get inheritFrom
     *
     * @return \QwebCMS\CatalogoBundle\Entity\Feature 
     */
    public function getInheritFrom()
    {
        return $this->inheritFrom;
    }

    /**
     * Add featurevalues
     *
     * @param \QwebCMS\CatalogoBundle\Entity\Featurevalue $featurevalues
     * @return Feature
     */
    public function addFeaturevalue(\QwebCMS\CatalogoBundle\Entity\Featurevalue $featurevalues)
    {
        $this->featurevalues[] = $featurevalues;

        return $this;
    }

    /**
     * Remove featurevalues
     *
     * @param \QwebCMS\CatalogoBundle\Entity\Featurevalue $featurevalues
     */
    public function removeFeaturevalue(\QwebCMS\CatalogoBundle\Entity\Featurevalue $featurevalues)
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
     * Add categories
     *
     * @param \QwebCMS\CatalogoBundle\Entity\Category $categories
     * @return Feature
     */
    public function addCategory(\QwebCMS\CatalogoBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \QwebCMS\CatalogoBundle\Entity\Category $categories
     */
    public function removeCategory(\QwebCMS\CatalogoBundle\Entity\Category $categories)
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
}
