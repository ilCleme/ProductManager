<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct as Product;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->findAll();
            
        $category = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findAll();
            
        $feature = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueFeature')
            ->findAll();
        
        $featurevalue = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueFeaturevalue')
            ->findAll();
            
        return $this->render('QwebCMSCatalogoBundle:Welcome:index.html.twig',
            array('products' => $product, 'categories' => $category, 'features' => $feature, 'featurevalues' => $featurevalue)
            );
    }

    public function allProductAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM QwebCMSCatalogoBundle:TblCatalogueProduct a";
        $product = $em->createQuery($dql);


        // Getting photo of product
        //$photos= $this->getDoctrine()
        //    ->getRepository('QwebCMSCatalogoBundle:TblPhoto')
        //    ->findBy(array('idTblPhotoCat' => $product->getIdTblPhotoCat() ));

        if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='title' ){
            $filterValue = $request->query->get('filterValue');

            $product = $em->createQuery('SELECT a FROM QwebCMSCatalogoBundle:TblCatalogueProduct a WHERE a.title LIKE :filterValue ');
            $product->setParameters(array(
                'filterValue' => '%'.$filterValue.'%'
            ));
        } else if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='shortDescription' ){
            $filterValue = $request->query->get('filterValue');

            $product = $em->createQuery('SELECT a FROM QwebCMSCatalogoBundle:TblCatalogueProduct a WHERE a.shortDescription LIKE :filterValue ');
            $product->setParameters(array(
                'filterValue' => '%'.$filterValue.'%'
            ));
        } else if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='idTblCatalogueProduct' ){
            $filterValue = $request->query->get('filterValue');

            $product = $em->createQuery('SELECT a FROM QwebCMSCatalogoBundle:TblCatalogueProduct a WHERE a.idTblCatalogueProduct LIKE :filterValue ');
            $product->setParameters(array(
                'filterValue' => '%'.$filterValue.'%'
            ));
        }

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato'
            );
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $product,
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('number', 10)/*limit per page*/
        );
        
        // passo l'oggetto $product a un template
        return $this->render(
            'QwebCMSCatalogoBundle:Welcome:showallproduct.html.twig',
            array('products' => $product, 'pagination' => $pagination)
        );
    }
    
    public function allCategoryAction(){
        $category = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findAll();

        if (!$category) {
            throw $this->createNotFoundException(
                'Nessuna categoria trovata!'
            );
        }
        
        // passo l'oggetto $product a un template
        return $this->render(
            'QwebCMSCatalogoBundle:Welcome:showallcategory.html.twig',
            array('categories' => $category)
        );
    }
    
    public function allFeatureAction(){
        $feature = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueFeature')
            ->findAll();

        if (!$feature) {
            throw $this->createNotFoundException(
                'Nessuna feature trovata!'
            );
        }
        
        // passo l'oggetto $product a un template
        return $this->render(
            'QwebCMSCatalogoBundle:Welcome:showallfeatures.html.twig',
            array('features' => $feature)
        );
    }
    
    public function allFeatureValueAction(){
        $featurevalue = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueFeaturevalue')
            ->findAll();

        if (!$featurevalue) {
            throw $this->createNotFoundException(
                'Nessuna feature trovata!'
            );
        }
        
        // passo l'oggetto $product a un template
        return $this->render(
            'QwebCMSCatalogoBundle:Welcome:showallfeaturevalues.html.twig',
            array('featurevalues' => $featurevalue)
        );
    }
}