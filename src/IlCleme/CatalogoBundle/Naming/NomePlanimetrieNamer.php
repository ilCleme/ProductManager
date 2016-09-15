<?php

namespace IlCleme\CatalogoBundle\Naming;

use Oneup\UploaderBundle\Uploader\File\FileInterface;
use Oneup\UploaderBundle\Uploader\Naming\NamerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class NomePlanimetrieNamer extends EntityManager implements NamerInterface
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function name(FileInterface $file)
    {
        $request = Request::createFromGlobals();
        $id_product = $request->headers->get('id-product');

        $query = $this->em->createQuery(
            'SELECT p
            FROM IlCleme\CatalogoBundle\Entity\Product p
            WHERE p.idTblCatalogueProduct =  :id'
        )->setParameter('id', $id_product);

        $product = $query->getResult();

        $productName = $this->transformSpaceToHyphen($product[0]->getTitle());

        $productCategories = $product[0]->getCategories();
        $productCategory = $this->transformSpaceToHyphen($productCategories[0]->getTitle());

        return sprintf('appartamenti-%s-%s-%s.%s', strtolower($productCategory), strtolower($productName), "planimetria" ,strtolower($file->getExtension()) );
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