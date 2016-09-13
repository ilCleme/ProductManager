<?php

namespace QwebCMS\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="QwebCMS\CatalogoBundle\Entity\ProductRepository")
 * @Vich\Uploadable
 */
class Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
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
     * @ORM\ManyToMany(targetEntity="Allegato", cascade={"persist"})
     * @ORM\JoinTable(name="prodotto_allegato",
     *      joinColumns={@ORM\JoinColumn(name="prodotto_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="allegato_id", referencedColumnName="id")}
     *      )
     */
    private $allegatiProgetto;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

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
     * @var boolean
     *
     * @ORM\Column(name="pub", type="boolean", nullable=false)
     */
    private $pub;

    /**
     * @var boolean
     *
     * @ORM\Column(name="featured", type="boolean", nullable=false)
     */
    private $featured;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="allegati", fileNameProperty="logoPath")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $logoPath;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;
    
    /**
     *  @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\Category", inversedBy="products")
     *  @ORM\JoinTable(name="categories_products")
     */
    private $categories;
    
    /**
     *  @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\Featurevalue", inversedBy="productsWithFeaturevalue")
     *  @ORM\JoinTable(name="products_featurevalues")
     */
    private $featurevalues;
    
    public function __construct() {
        $this->categories = new ArrayCollection();
        $this->featurevalues = new ArrayCollection();
        $this->allegatiProgetto = new ArrayCollection();
        $this->setIdTblLingua(4);
    }

    /**
     * Get categories for a specific Language
     *
     * @param $id_language
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoriesByLanguage($id_language)
    {
        $categories = $this->getCategories();
        $arrayCategories = new ArrayCollection();
        foreach($categories as $category){
            if ($category->getIdTblLingua() == $id_language){
                $arrayCategories->add($category);
            }
        }

        return $arrayCategories;
    }

    public function addAllegatiProgetto(Allegato $allegato)
    {
        $allegato->setIdTblLingua(4);
        $this->allegatiProgetto->add($allegato);
    }

    public function removeAllegatiProgetto(Allegato $allegato)
    {
        $this->allegatiProgetto->removeElement($allegato);
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Set cod
     *
     * @param string $cod
     * @return Product
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
     * Set idTblPhotoCat
     *
     * @param integer $idTblPhotoCat
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Set logoPath
     *
     * @param string $logoPath
     * @return Product
     */
    public function setLogoPath($logoPath)
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    /**
     * Get logoPath
     *
     * @return string 
     */
    public function getLogoPath()
    {
        return $this->logoPath;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Product
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
     * Get allegatiProgetto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAllegatiProgetto()
    {
        return $this->allegatiProgetto;
    }

    /**
     * Add categories
     *
     * @param \QwebCMS\CatalogoBundle\Entity\Category $categories
     * @return Product
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

    /**
     * Add featurevalues
     *
     * @param \QwebCMS\CatalogoBundle\Entity\Featurevalue $featurevalues
     * @return Product
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
}
