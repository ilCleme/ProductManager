<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Entity\TblCatalogueProduct as Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\TblCatalogueProductType;
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
            
            $product->upload();
            
            $em->persist($product);
            $em->flush();
            
            //Aggiornare il valore del campo id_tbl_catalogue_product con il nuovo id
            $product->setIdTblCatalogueProduct($product->getId());
            
            $em->persist($product);
            $em->flush();
            return $this->redirect($this->generateUrl('products'));
        }
        
        
        return $this->render('AcmeDemoBundle:Product:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueProduct')
            ->find($id);
    
        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }
    
        // passo l'oggetto $product a un template
        return $this->render(
            'AcmeDemoBundle:Product:showproduct.html.twig',
            array('product' => $product)
        );
    }
    
    public function updateAction($id, Request $request)
    {
        $product = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueProduct')
            ->find($id);
    
        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }
        
        $form = $this->createForm(new TblCatalogueProductType(), $product);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($product);
            $em->flush();
            return $this->redirect($this->generateUrl('products'));
        }
    
        // passo l'oggetto $product a un template
        return $this->render('AcmeDemoBundle:Product:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function deleteAction($id, Request $request)
    {
        $product = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueProduct')
            ->find($id); 
    
        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }
        
        $form = $this->createForm(new TblCatalogueProductType(), $product);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            
            $em = $this->getDoctrine()->getManager();
            
            $em->remove($product);
            $em->flush();
            return $this->redirect($this->generateUrl('products'));
        }
    
        // passo l'oggetto $product a un template
        return $this->render('AcmeDemoBundle:Product:delete.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}