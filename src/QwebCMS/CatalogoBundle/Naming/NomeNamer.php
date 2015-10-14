<?php

namespace QwebCMS\CatalogoBundle\Naming;

use Oneup\UploaderBundle\Uploader\File\FileInterface;
use Oneup\UploaderBundle\Uploader\Naming\NamerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class NomeNamer extends EntityManager implements NamerInterface
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function name(FileInterface $file)
    {
        $request = Request::createFromGlobals();
        $id_album = $request->headers->get('id-album');

        $query = $this->em->createQuery(
            'SELECT p
            FROM QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct p
            WHERE p.idTblPhotoCat =  :id'
        )->setParameter('id', $id_album);

        $product = $query->getResult();

        $query = $this->em->createQuery(
            'SELECT p
            FROM QwebCMS\CatalogoBundle\Entity\TblPhoto p
            WHERE p.idTblPhotoCat =  :id'
        )->setParameter('id', $id_album);

        $photo = $query->getResult();

        $productName = $this->transformSpaceToHyphen($product[0]->getTitle());

        $productCategories = $product[0]->getCategories();
        $productCategory = $this->transformSpaceToHyphen($productCategories[0]->getTitle());


        return sprintf('appartamenti-%s-%s-%s.%s', strtolower($productCategory), strtolower($productName), count($photo) ,strtolower($file->getExtension()) );
    }

    protected function transformSpaceToHyphen($string){

        if (null !== $string){
            $stringWithoutSpace = str_replace(" ", "-", $string);
        } else {
            $stringWithoutSpace = "";
        }

        return $stringWithoutSpace;
    }
}