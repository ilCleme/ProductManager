<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct as Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use QwebCMS\CatalogoBundle\Form\TblCatalogueProductType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductController extends Controller
{
    public function createAction(Request $request)
    {
        $product = new Product();
        
        $form = $this->createForm(new TblCatalogueProductType(), $product);
        //$form = $this->createFormBuilder()
        //    ->add('elfinder','elfinder', array('instance'=>'form', 'enable'=>true))
        //    ->getForm();
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            $em = $this->getDoctrine()->getManager();
            
            $error					= false;
            
            $absolutedir			= dirname(__FILE__);
            $dir					= 'uploads/documents/';
            $serverdir				= $dir;
            $filename				= array();
            
            $json                   = $_POST['product']['img'];
            
            $json					= json_decode($json);
            $tmp					= explode(',',$json->data);
            $imgdata 				= base64_decode($tmp[1]);
            
            $extensions				= explode('.',$json->name);
            $extension              = strtolower($extensions[1]);
            $fname					= substr($json->name,0,-(strlen($extension) + 1)).'.'.substr(sha1(time()),0,6).'.'.$extension;
            
            
            $handle					= fopen($serverdir.$fname,'a+');
            fwrite($handle, $imgdata);
            fclose($handle);
            
            $filename[]				= $fname;
            
            //$form['img']->getData()->move($dir, $someNewFilename);
            $product->setImg($dir.'/'.$fname);
            $em->persist($product);
            $em->flush();
            
            //Aggiornare il valore del campo id_tbl_catalogue_product con il nuovo id
            $product->setIdTblCatalogueProduct($product->getId());
            
            $em->persist($product);
            $em->flush();
            return $this->redirect($this->generateUrl('products'));
        }
        
        
        return $this->render('QwebCMSCatalogoBundle:Product:new.html.twig', array(
            'form' => $form->createView(),
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
        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
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
        return $this->render('QwebCMSCatalogoBundle:Product:new.html.twig', array(
            'form' => $form->createView(),
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
        return $this->render('QwebCMSCatalogoBundle:Product:delete.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}