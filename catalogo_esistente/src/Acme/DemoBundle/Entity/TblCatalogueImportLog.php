<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblCatalogueImportLog
 *
 * @ORM\Table(name="tbl_catalogue_import_log")
 * @ORM\Entity
 */
class TblCatalogueImportLog
{
    /**
     * @var string
     *
     * @ORM\Column(name="tablerif", type="string", length=255, nullable=true)
     */
    private $tablerif;

    /**
     * @var integer
     *
     * @ORM\Column(name="idrif", type="bigint", nullable=true)
     */
    private $idrif;

    /**
     * @var string
     *
     * @ORM\Column(name="act", type="string", length=255, nullable=true)
     */
    private $act;

    /**
     * @var boolean
     *
     * @ORM\Column(name="result", type="boolean", nullable=false)
     */
    private $result;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_import", type="datetime", nullable=false)
     */
    private $dateImport;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="bigint", nullable=false)
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_user", type="string", length=255, nullable=false)
     */
    private $ipUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set tablerif
     *
     * @param string $tablerif
     * @return TblCatalogueImportLog
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
     * Set idrif
     *
     * @param integer $idrif
     * @return TblCatalogueImportLog
     */
    public function setIdrif($idrif)
    {
        $this->idrif = $idrif;

        return $this;
    }

    /**
     * Get idrif
     *
     * @return integer 
     */
    public function getIdrif()
    {
        return $this->idrif;
    }

    /**
     * Set act
     *
     * @param string $act
     * @return TblCatalogueImportLog
     */
    public function setAct($act)
    {
        $this->act = $act;

        return $this;
    }

    /**
     * Get act
     *
     * @return string 
     */
    public function getAct()
    {
        return $this->act;
    }

    /**
     * Set result
     *
     * @param boolean $result
     * @return TblCatalogueImportLog
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return boolean 
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return TblCatalogueImportLog
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
     * Set dateImport
     *
     * @param \DateTime $dateImport
     * @return TblCatalogueImportLog
     */
    public function setDateImport($dateImport)
    {
        $this->dateImport = $dateImport;

        return $this;
    }

    /**
     * Get dateImport
     *
     * @return \DateTime 
     */
    public function getDateImport()
    {
        return $this->dateImport;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     * @return TblCatalogueImportLog
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set ipUser
     *
     * @param string $ipUser
     * @return TblCatalogueImportLog
     */
    public function setIpUser($ipUser)
    {
        $this->ipUser = $ipUser;

        return $this;
    }

    /**
     * Get ipUser
     *
     * @return string 
     */
    public function getIpUser()
    {
        return $this->ipUser;
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
