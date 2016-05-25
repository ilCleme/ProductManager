<?php

namespace QwebCMS\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * TblCatalogueProduct
 *
 * @ORM\Table(name="tbl_catalogue_product")
 * @ORM\Entity(repositoryClass="QwebCMS\CatalogoBundle\Entity\TblCatalogueProductRepository")
 * @Vich\Uploadable
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
     * @ORM\Column(name="costo_totale", type="float", nullable=true)
     */
    private $costoTotale;

    /**
     * @var string
     *
     * @ORM\Column(name="contributo", type="float", nullable=true)
     */
    private $contributo;

    /**
     * @var string
     *
     * @ORM\Column(name="responsabile_progetto", type="string", length=255, nullable=true)
     */
    private $responsabileProgetto;

    /**
     * @var string
     *
     * @ORM\Column(name="email_riferimento", type="string", length=255, nullable=true)
     */
    private $emailRiferimento;

    /**
     * @var string
     *
     * @ORM\Column(name="partner", type="string", length=255, nullable=true)
     */
    private $partner;

    /**
     * @var string
     *
     * @ORM\Column(name="tempi_realizzazione", type="string", length=400, nullable=true)
     */
    private $tempiRealizzazione;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione_progetto", type="text", nullable=true)
     */
    private $descrizioneProgetto;

    /**
     * @var string
     *
     * @ORM\Column(name="beneficiario", type="string", length=250, nullable=true)
     */
    private $beneficiario;

    /**
     * @var string
     *
     * @ORM\Column(name="obbiettivi", type="text", nullable=true)
     */
    private $obbiettivi;

    /**
     * @var string
     *
     * @ORM\Column(name="attivita_progetto", type="text", nullable=true)
     */
    private $attivitaProgetto;

    /**
     * @var string
     *
     * @ORM\Column(name="informazioni", type="text", nullable=true)
     */
    private $informazioni;

    /**
     * @var string
     *
     * @ORM\Column(name="link_esterni", type="string", length=400, nullable=true)
     */
    private $linkEsterni;

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
     * @ORM\Column(name="fotogallery", type="string", length=250, nullable=true)
     */
    private $fotogallery;

    /**
     * @var string
     *
     * @ORM\Column(name="parole_chiave", type="string", length=255, nullable=false)
     */
    private $paroleChiave;

    /**
     * @var string
     *
     * @ORM\Column(name="stato_progetto", type="integer", nullable=false)
     */
    private $statoProgetto;

    /**
     * @var string
     *
     * @ORM\Column(name="area_riservata", type="boolean", nullable=false)
     */
    private $areaRiservata;

    /**
     * @var string
     *
     * @ORM\Column(name="ruolo_gal_venezia_orientale", type="string", length=255, nullable=true)
     */
    private $ruoloGalVeneziaOrientale;

    /**
     * @var string
     *
     * @ORM\Column(name="procedura_attuazione", type="text", nullable=true)
     */
    private $proceduraAttuazione;

    /**
     * @var string
     *
     * @ORM\Column(name="soggetto_promotore", type="string", length=500, nullable=true)
     */
    private $soggettoPromotore;

    /**
     * @var string
     *
     * @ORM\Column(name="gal_partner_progetto", type="string", length=300, nullable=true)
     */
    private $galPartnerProgetto;

    /**
     * @var string
     *
     * @ORM\Column(name="partner_promotore", type="string", length=500, nullable=true)
     */
    private $partnerPromotore;

    /**
     * @var string
     *
     * @ORM\Column(name="anno_inizio", type="integer", nullable=false)
     */
    private $annoInizio;

    /**
     * @var string
     *
     * @ORM\Column(name="costo_ammesso", type="float", nullable=true)
     */
    private $costoAmmesso;

    /**
     * @var string
     *
     * @ORM\Column(name="recapito_beneficiario", type="string", length=255, nullable=true)
     */
    private $recapitoBeneficiario;

    /**
     * @var string
     *
     * @ORM\Column(name="richiesta_variante", type="text", nullable=true)
     */
    private $richiestaVariante;

    /**
     * @var string
     *
     * @ORM\Column(name="richiesta_anticipo", type="text", nullable=true)
     */
    private $richiestaAnticipo;

    /**
     * @var string
     *
     * @ORM\Column(name="atto_fine_intervento", type="text", nullable=true)
     */
    private $attoFineIntervento;

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
     *  @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory", inversedBy="products")
     *  @ORM\JoinTable(name="cross_tbl_catalogue_category_x_tbl_catalogue_product",
     *      joinColumns={@ORM\JoinColumn(name="id_item", referencedColumnName="id_tbl_catalogue_product")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_parent", referencedColumnName="id_tbl_catalogue_category")})
     */
    private $categories;
    
    /**
     *  @ORM\ManyToMany(targetEntity="QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue", inversedBy="productsWithFeaturevalue")
     *  @ORM\JoinTable(name="cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue",
     *      joinColumns={@ORM\JoinColumn(name="id_parent", referencedColumnName="id_tbl_catalogue_product")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_item", referencedColumnName="id_tbl_catalogue_featurevalue")})
     */
    private $featurevalues;
    
    public function __construct() {
        $this->categories = new ArrayCollection();
        $this->featurevalues = new ArrayCollection();
        $this->allegatiProgetto = new ArrayCollection();
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

    /**
     * Set categories
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory $categories
     */
    public function setCategories($categories)
    {
        if (!is_array($categories)) {
            $categories = array($categories);
        }
        $this->categories = $categories;
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
     * Add featurevalues
     *
     * @param \QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue $featurevalues
     * @return TblCatalogueProduct
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
     * Set costoTotale
     *
     * @param float $costoTotale
     * @return TblCatalogueProduct
     */
    public function setCostoTotale($costoTotale)
    {
        $this->costoTotale = $costoTotale;

        return $this;
    }

    /**
     * Get costoTotale
     *
     * @return float 
     */
    public function getCostoTotale()
    {
        return $this->costoTotale;
    }

    /**
     * Set contributo
     *
     * @param float $contributo
     * @return TblCatalogueProduct
     */
    public function setContributo($contributo)
    {
        $this->contributo = $contributo;

        return $this;
    }

    /**
     * Get contributo
     *
     * @return float 
     */
    public function getContributo()
    {
        return $this->contributo;
    }

    /**
     * Set responsabileProgetto
     *
     * @param string $responsabileProgetto
     * @return TblCatalogueProduct
     */
    public function setResponsabileProgetto($responsabileProgetto)
    {
        $this->responsabileProgetto = $responsabileProgetto;

        return $this;
    }

    /**
     * Get responsabileProgetto
     *
     * @return string 
     */
    public function getResponsabileProgetto()
    {
        return $this->responsabileProgetto;
    }

    /**
     * Set emailRiferimento
     *
     * @param string $emailRiferimento
     * @return TblCatalogueProduct
     */
    public function setEmailRiferimento($emailRiferimento)
    {
        $this->emailRiferimento = $emailRiferimento;

        return $this;
    }

    /**
     * Get emailRiferimento
     *
     * @return string 
     */
    public function getEmailRiferimento()
    {
        return $this->emailRiferimento;
    }

    /**
     * Set partner
     *
     * @param string $partner
     * @return TblCatalogueProduct
     */
    public function setPartner($partner)
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * Get partner
     *
     * @return string 
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * Set tempiRealizzazione
     *
     * @param string $tempiRealizzazione
     * @return TblCatalogueProduct
     */
    public function setTempiRealizzazione($tempiRealizzazione)
    {
        $this->tempiRealizzazione = $tempiRealizzazione;

        return $this;
    }

    /**
     * Get tempiRealizzazione
     *
     * @return string 
     */
    public function getTempiRealizzazione()
    {
        return $this->tempiRealizzazione;
    }

    /**
     * Set descrizioneProgetto
     *
     * @param string $descrizioneProgetto
     * @return TblCatalogueProduct
     */
    public function setDescrizioneProgetto($descrizioneProgetto)
    {
        $this->descrizioneProgetto = $descrizioneProgetto;

        return $this;
    }

    /**
     * Get descrizioneProgetto
     *
     * @return string 
     */
    public function getDescrizioneProgetto()
    {
        return $this->descrizioneProgetto;
    }

    /**
     * Set beneficiario
     *
     * @param string $beneficiario
     * @return TblCatalogueProduct
     */
    public function setBeneficiario($beneficiario)
    {
        $this->beneficiario = $beneficiario;

        return $this;
    }

    /**
     * Get beneficiario
     *
     * @return string 
     */
    public function getBeneficiario()
    {
        return $this->beneficiario;
    }

    /**
     * Set obbiettivi
     *
     * @param string $obbiettivi
     * @return TblCatalogueProduct
     */
    public function setObbiettivi($obbiettivi)
    {
        $this->obbiettivi = $obbiettivi;

        return $this;
    }

    /**
     * Get obbiettivi
     *
     * @return string 
     */
    public function getObbiettivi()
    {
        return $this->obbiettivi;
    }

    /**
     * Set attivitaProgetto
     *
     * @param string $attivitaProgetto
     * @return TblCatalogueProduct
     */
    public function setAttivitaProgetto($attivitaProgetto)
    {
        $this->attivitaProgetto = $attivitaProgetto;

        return $this;
    }

    /**
     * Get attivitaProgetto
     *
     * @return string 
     */
    public function getAttivitaProgetto()
    {
        return $this->attivitaProgetto;
    }

    /**
     * Set informazioni
     *
     * @param string $informazioni
     * @return TblCatalogueProduct
     */
    public function setInformazioni($informazioni)
    {
        $this->informazioni = $informazioni;

        return $this;
    }

    /**
     * Get informazioni
     *
     * @return string 
     */
    public function getInformazioni()
    {
        return $this->informazioni;
    }

    /**
     * Set linkEsterni
     *
     * @param string $linkEsterni
     * @return TblCatalogueProduct
     */
    public function setLinkEsterni($linkEsterni)
    {
        $this->linkEsterni = $linkEsterni;

        return $this;
    }

    /**
     * Get linkEsterni
     *
     * @return string 
     */
    public function getLinkEsterni()
    {
        return $this->linkEsterni;
    }

    /**
     * Set allegatiProgetto
     *
     * @param string $allegatiProgetto
     * @return TblCatalogueProduct
     */
    public function setAllegatiProgetto(ArrayCollection  $allegatiProgetto)
    {
        $this->allegatiProgetto = $allegatiProgetto;

        return $this;
    }

    /**
     * Get allegatiProgetto
     *
     * @return string 
     */
    public function getAllegatiProgetto()
    {
        return $this->allegatiProgetto;
    }

    /**
     * Set fotogallery
     *
     * @param string $fotogallery
     * @return TblCatalogueProduct
     */
    public function setFotogallery($fotogallery)
    {
        $this->fotogallery = $fotogallery;

        return $this;
    }

    /**
     * Get fotogallery
     *
     * @return string 
     */
    public function getFotogallery()
    {
        return $this->fotogallery;
    }

    /**
     * Set paroleChiave
     *
     * @param string $paroleChiave
     * @return TblCatalogueProduct
     */
    public function setParoleChiave($paroleChiave)
    {
        $this->paroleChiave = $paroleChiave;

        return $this;
    }

    /**
     * Get paroleChiave
     *
     * @return string 
     */
    public function getParoleChiave()
    {
        return $this->paroleChiave;
    }

    /**
     * Set statoProgetto
     *
     * @param integer $statoProgetto
     * @return TblCatalogueProduct
     */
    public function setStatoProgetto($statoProgetto)
    {
        $this->statoProgetto = $statoProgetto;

        return $this;
    }

    /**
     * Get statoProgetto
     *
     * @return integer 
     */
    public function getStatoProgetto()
    {
        return $this->statoProgetto;
    }

    /**
     * Set visibilita
     *
     * @param integer $visibilita
     * @return TblCatalogueProduct
     */
    public function setVisibilita($visibilita)
    {
        $this->visibilita = $visibilita;

        return $this;
    }

    /**
     * Get visibilita
     *
     * @return integer 
     */
    public function getVisibilita()
    {
        return $this->visibilita;
    }

    /**
     * Set ruoloGalVeneziaOrientale
     *
     * @param string $ruoloGalVeneziaOrientale
     * @return TblCatalogueProduct
     */
    public function setRuoloGalVeneziaOrientale($ruoloGalVeneziaOrientale)
    {
        $this->ruoloGalVeneziaOrientale = $ruoloGalVeneziaOrientale;

        return $this;
    }

    /**
     * Get ruoloGalVeneziaOrientale
     *
     * @return string 
     */
    public function getRuoloGalVeneziaOrientale()
    {
        return $this->ruoloGalVeneziaOrientale;
    }

    /**
     * Set proceduraAttuazione
     *
     * @param string $proceduraAttuazione
     * @return TblCatalogueProduct
     */
    public function setProceduraAttuazione($proceduraAttuazione)
    {
        $this->proceduraAttuazione = $proceduraAttuazione;

        return $this;
    }

    /**
     * Get proceduraAttuazione
     *
     * @return string 
     */
    public function getProceduraAttuazione()
    {
        return $this->proceduraAttuazione;
    }

    /**
     * Set soggettoPromotore
     *
     * @param string $soggettoPromotore
     * @return TblCatalogueProduct
     */
    public function setSoggettoPromotore($soggettoPromotore)
    {
        $this->soggettoPromotore = $soggettoPromotore;

        return $this;
    }

    /**
     * Get soggettoPromotore
     *
     * @return string 
     */
    public function getSoggettoPromotore()
    {
        return $this->soggettoPromotore;
    }

    /**
     * Set galPartnerProgetto
     *
     * @param string $galPartnerProgetto
     * @return TblCatalogueProduct
     */
    public function setGalPartnerProgetto($galPartnerProgetto)
    {
        $this->galPartnerProgetto = $galPartnerProgetto;

        return $this;
    }

    /**
     * Get galPartnerProgetto
     *
     * @return string 
     */
    public function getGalPartnerProgetto()
    {
        return $this->galPartnerProgetto;
    }

    /**
     * Set partnerPromotore
     *
     * @param string $partnerPromotore
     * @return TblCatalogueProduct
     */
    public function setPartnerPromotore($partnerPromotore)
    {
        $this->partnerPromotore = $partnerPromotore;

        return $this;
    }

    /**
     * Get partnerPromotore
     *
     * @return string 
     */
    public function getPartnerPromotore()
    {
        return $this->partnerPromotore;
    }

    /**
     * Set annoInizio
     *
     * @param integer $annoInizio
     * @return TblCatalogueProduct
     */
    public function setAnnoInizio($annoInizio)
    {
        $this->annoInizio = $annoInizio;

        return $this;
    }

    /**
     * Get annoInizio
     *
     * @return integer 
     */
    public function getAnnoInizio()
    {
        return $this->annoInizio;
    }

    /**
     * Set costoAmmesso
     *
     * @param float $costoAmmesso
     * @return TblCatalogueProduct
     */
    public function setCostoAmmesso($costoAmmesso)
    {
        $this->costoAmmesso = $costoAmmesso;

        return $this;
    }

    /**
     * Get costoAmmesso
     *
     * @return float 
     */
    public function getCostoAmmesso()
    {
        return $this->costoAmmesso;
    }

    /**
     * Set recapitoBeneficiario
     *
     * @param string $recapitoBeneficiario
     * @return TblCatalogueProduct
     */
    public function setRecapitoBeneficiario($recapitoBeneficiario)
    {
        $this->recapitoBeneficiario = $recapitoBeneficiario;

        return $this;
    }

    /**
     * Get recapitoBeneficiario
     *
     * @return string 
     */
    public function getRecapitoBeneficiario()
    {
        return $this->recapitoBeneficiario;
    }

    /**
     * Set richiestaVariante
     *
     * @param string $richiestaVariante
     * @return TblCatalogueProduct
     */
    public function setRichiestaVariante($richiestaVariante)
    {
        $this->richiestaVariante = $richiestaVariante;

        return $this;
    }

    /**
     * Get richiestaVariante
     *
     * @return string 
     */
    public function getRichiestaVariante()
    {
        return $this->richiestaVariante;
    }

    /**
     * Set richiestaAnticipo
     *
     * @param string $richiestaAnticipo
     * @return TblCatalogueProduct
     */
    public function setRichiestaAnticipo($richiestaAnticipo)
    {
        $this->richiestaAnticipo = $richiestaAnticipo;

        return $this;
    }

    /**
     * Get richiestaAnticipo
     *
     * @return string 
     */
    public function getRichiestaAnticipo()
    {
        return $this->richiestaAnticipo;
    }

    /**
     * Set attoFineIntervento
     *
     * @param string $attoFineIntervento
     * @return TblCatalogueProduct
     */
    public function setAttoFineIntervento($attoFineIntervento)
    {
        $this->attoFineIntervento = $attoFineIntervento;

        return $this;
    }

    /**
     * Get attoFineIntervento
     *
     * @return string 
     */
    public function getAttoFineIntervento()
    {
        return $this->attoFineIntervento;
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return TblCatalogueProduct
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
     * Set logoPath
     *
     * @param string $logoPath
     * @return TblCatalogueProduct
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
     * @param string $imageName
     *
     * @return Product
     */
    public function setImageName($imageName)
    {
        $this->logoPath = $imageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->logoPath;
    }

    /**
     * Set areaRiservata
     *
     * @param boolean $areaRiservata
     * @return TblCatalogueProduct
     */
    public function setAreaRiservata($areaRiservata)
    {
        $this->areaRiservata = $areaRiservata;

        return $this;
    }

    /**
     * Get areaRiservata
     *
     * @return boolean 
     */
    public function getAreaRiservata()
    {
        return $this->areaRiservata;
    }
}
