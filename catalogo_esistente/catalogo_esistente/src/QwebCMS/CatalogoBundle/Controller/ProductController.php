<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct as Product;
use QwebCMS\CatalogoBundle\Entity\TblPhotoCat as Album;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use QwebCMS\CatalogoBundle\Form\TblCatalogueProductType;
use QwebCMS\CatalogoBundle\Form\TblCatalogueProductEditType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductController extends Controller
{
    public function createAction(Request $request)
    {
        $product = new Product();

        $form = $this->createForm(new TblCatalogueProductType(), $product);

        $form->handleRequest($request);
        
        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            $em = $this->getDoctrine()->getManager();


            if($form->get('saveAndContinue')->isClicked()){

                // Create a new empty Album for this product
                $album = new Album();
                $album->setNome($product->getTitle());
                $em->persist($album);
                $em->flush();

                // Save product information on database
                $product->setIdTblCatalogueProduct(0);
                $product->setIdTblPhotoCat($album->getIdTblPhotoCat());
                $em->persist($product);
                $em->flush();

                // Copy id product on idTblCatalogueProduct field
                $product->setIdTblCatalogueProduct($product->getId());
                $em->flush();

                $form = $this->createForm(new TblCatalogueProductType(), $product);

                if ($product->getIdTblPhotoCat() != null){
                    $id_album = $product->getIdTblPhotoCat();
                } else {
                    $id_album = 0;
                }

                return $this->render('QwebCMSCatalogoBundle:Product:new.html.twig', array(
                    'form' => $form->createView(),
                    'id_album' => $id_album
                ));

            } else {

                // Create a new empty Album for this product
                $album = new Album();
                $album->setNome($product->getTitle());
                $em->persist($album);
                $em->flush();

                // Save product and redirect user to products list
                $product->setIdTblCatalogueProduct(0);
                $product->setIdTblPhotoCat($album->getIdTblPhotoCat());
                $product->setIdTblCatalogueProduct($product->getId());

                $em->persist($product);
                $em->flush();
                return $this->redirect($this->generateUrl('products'));

            }

        }

        return $this->render('QwebCMSCatalogoBundle:Product:new.html.twig', array(
            'form' => $form->createView(),
            'id_album' => 0
        ));
    }
    
    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->find($id);
    
        if (!$product) {
        throw $this->createNotFoundException(
            'Nessun prodotto trovato per l\'id '.$id
        );
    }
    
        // passo l'oggetto $product a un template
        return $this->render(
            'QwebCMSCatalogoBundle:Product:showproduct.html.twig',
            array('product' => $product)
        );
    }
    
    public function updateAction($id, Request $request)
    {
        // Getting product information
        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->find($id);
    
        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }

        // Getting photo of product
        $photos= $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblPhoto')
            ->findBy(array('idTblPhotoCat' => $product->getIdTblPhotoCat() ));

        $form = $this->createForm(new TblCatalogueProductEditType(), $product);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($product);
            $em->flush();

            return $this->redirect($this->generateUrl('products'));
        }


        // passo l'oggetto $product a un template
        return $this->render('QwebCMSCatalogoBundle:Product:update.html.twig', array(
            'form' => $form->createView(),
            'product' => $product,
            'immagini' => $photos
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($product);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'Il prodotto è stato eliminato!'
        );

        return $this->redirect($this->generateUrl('products'));
    }
}