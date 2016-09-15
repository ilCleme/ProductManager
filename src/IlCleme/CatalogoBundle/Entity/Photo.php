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
}
