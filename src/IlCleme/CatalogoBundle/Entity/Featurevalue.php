<?php

namespace IlCleme\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Featurevalue
 *
 * @ORM\Table(name="featurevalue")
 * @ORM\Entity(repositoryClass="IlCleme\CatalogoBundle\Entity\FeaturevalueRepository")
 * @Vich\Uploadable
 */
class Featurevalue
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="featurevalues_image", fileNameProperty="img")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = 0;

    
    /**
     * @ORM\ManyToMany(targetEntity="IlCleme\CatalogoBundle\Entity\Product", mappedBy="featurevalues")
     **/
    private $productsWithFeaturevalue;
    
    /**
     *  @ORM\ManyToMany(targetEntity="IlCleme\CatalogoBundle\Entity\Feature", inversedBy="featurevalues")
     *  @ORM\JoinTable(name="features_featurevalues")
     */
    private $features;

    /**
     * @ORM\ManyToMany(targetEntity="IlCleme\CatalogoBundle\Entity\Featurevalue")
     * @ORM\JoinTable(name="featurevalue_inherit")
     **/
    private $featurevalue_inherit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productsWithFeaturevalue = new \Doctrine\Common\Collections\ArrayCollection();
        $this->featurevalue_inherit = new \Doctrine\Common\Collections\ArrayCollection();
        $this->updatedAt = new \DateTime('now');
    }

    public function getFeatureTitle()
    {
        $feature = $this->getFeatures()->current();
        if ($feature && ($title = $feature->getTitle())){
            return $title;
        }
        return null;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
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
     * @return Featurevalue
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
     * @return Featurevalue
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
     * @return Featurevalue
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
     * @return Featurevalue
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Featurevalue
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Featurevalue
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
     * Add productsWithFeaturevalue
     *
     * @param \IlCleme\CatalogoBundle\Entity\Product $productsWithFeaturevalue
     * @return Featurevalue
     */
    public function addProductsWithFeaturevalue(\IlCleme\CatalogoBundle\Entity\Product $productsWithFeaturevalue)
    {
        $this->productsWithFeaturevalue[] = $productsWithFeaturevalue;

        return $this;
    }

    /**
     * Remove productsWithFeaturevalue
     *
     * @param \IlCleme\CatalogoBundle\Entity\Product $productsWithFeaturevalue
     */
    public function removeProductsWithFeaturevalue(\IlCleme\CatalogoBundle\Entity\Product $productsWithFeaturevalue)
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
     * @param \IlCleme\CatalogoBundle\Entity\Feature $features
     * @return Featurevalue
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

    /**
     * Add featurevalue_inherit
     *
     * @param \IlCleme\CatalogoBundle\Entity\Featurevalue $featurevalueInherit
     * @return Featurevalue
     */
    public function addFeaturevalueInherit(\IlCleme\CatalogoBundle\Entity\Featurevalue $featurevalueInherit)
    {
        $this->featurevalue_inherit[] = $featurevalueInherit;

        return $this;
    }

    /**
     * Remove featurevalue_inherit
     *
     * @param \IlCleme\CatalogoBundle\Entity\Featurevalue $featurevalueInherit
     */
    public function removeFeaturevalueInherit(\IlCleme\CatalogoBundle\Entity\Featurevalue $featurevalueInherit)
    {
        $this->featurevalue_inherit->removeElement($featurevalueInherit);
    }

    /**
     * Get featurevalue_inherit
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFeaturevalueInherit()
    {
        return $this->featurevalue_inherit;
    }
}
