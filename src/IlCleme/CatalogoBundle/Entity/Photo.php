<?php

namespace IlCleme\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="IlCleme\CatalogoBundle\Entity\PhotoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Photo
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
     * @ORM\Column(name="id_tbl_lingua", type="bigint")
     */
    private $idTblLingua = 4;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="img_big", type="string", length=255, nullable=true)
     */
    private $imgBig;

    /**
     * @ORM\ManyToOne(targetEntity="Album")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id")
     */
    private $album;

    /**
     * @var integer
     *
     * @ORM\Column(name="posizione", type="bigint")
     */
    private $posizione = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="pub", type="boolean")
     */
    private $pub = 1;

    /**
     * @var \DateTime
     */
    private $datamod;

    /**
     * Get id
     *
     * @return guid 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idTblLingua
     *
     * @param integer $idTblLingua
     * @return Photo
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
     * Set nome
     *
     * @param string $nome
     * @return Photo
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return Photo
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
     * Set imgBig
     *
     * @param string $imgBig
     * @return Photo
     */
    public function setImgBig($imgBig)
    {
        $this->imgBig = $imgBig;

        return $this;
    }

    /**
     * Get imgBig
     *
     * @return string 
     */
    public function getImgBig()
    {
        return $this->imgBig;
    }

    /**
     * Set posizione
     *
     * @param integer $posizione
     * @return Photo
     */
    public function setPosizione($posizione)
    {
        $this->posizione = $posizione;

        return $this;
    }

    /**
     * Get posizione
     *
     * @return integer 
     */
    public function getPosizione()
    {
        return $this->posizione;
    }

    /**
     * Set pub
     *
     * @param boolean $pub
     * @return Photo
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
     * Set album
     *
     * @param \IlCleme\CatalogoBundle\Entity\Album $album
     * @return Photo
     */
    public function setAlbum(\IlCleme\CatalogoBundle\Entity\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \IlCleme\CatalogoBundle\Entity\Album 
     */
    public function getAlbum()
    {
        return $this->album;
    }
}
