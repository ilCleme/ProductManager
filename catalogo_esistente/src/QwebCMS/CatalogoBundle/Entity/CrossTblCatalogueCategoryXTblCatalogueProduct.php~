<?php

namespace QwebCMS\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrossTblCatalogueCategoryXTblCatalogueProduct
 *
 * @ORM\Table(name="cross_tbl_catalogue_category_x_tbl_catalogue_product")
 * @ORM\Entity
 */
class CrossTblCatalogueCategoryXTblCatalogueProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_item", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_parent", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idParent;



    /**
     * Set idItem
     *
     * @param integer $idItem
     * @return CrossTblCatalogueCategoryXTblCatalogueProduct
     */
    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;

        return $this;
    }

    /**
     * Get idItem
     *
     * @return integer 
     */
    public function getIdItem()
    {
        return $this->idItem;
    }

    /**
     * Set idParent
     *
     * @param integer $idParent
     * @return CrossTblCatalogueCategoryXTblCatalogueProduct
     */
    public function setIdParent($idParent)
    {
        $this->idParent = $idParent;

        return $this;
    }

    /**
     * Get idParent
     *
     * @return integer 
     */
    public function getIdParent()
    {
        return $this->idParent;
    }
}
