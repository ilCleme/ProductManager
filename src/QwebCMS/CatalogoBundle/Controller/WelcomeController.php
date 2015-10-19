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
            $request->query->getInt('number', 50)/*limit per page*/
        );

        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findAll();
        
        // passo l'oggetto $product a un template
        return $this->render(
            'QwebCMSCatalogoBundle:Welcome:showallproduct.html.twig',
            array('products' => $product, 'pagination' => $pagination, 'categories' => $categories)
        );
    }
    
    public function allCategoryAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM QwebCMSCatalogoBundle:TblCatalogueCategory a";
        $category = $em->createQuery($dql);

        if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='title' ){
            $filterValue = $request->query->get('filterValue');

            $category = $em->createQuery('SELECT a FROM QwebCMSCatalogoBundle:TblCatalogueCategory a WHERE a.title LIKE :filterValue ');
            $category->setParameters(array(
                'filterValue' => '%'.$filterValue.'%'
            ));
        } else if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='idTblCatalogueCategory' ){
            $filterValue = $request->query->get('filterValue');

            $category = $em->createQuery('SELECT a FROM QwebCMSCatalogoBundle:TblCatalogueCategory a WHERE a.idTblCatalogueCategory LIKE :filterValue ');
            $category->setParameters(array(
                'filterValue' => '%'.$filterValue.'%'
            ));
        }

        if (!$category) {
            throw $this->createNotFoundException(
                'Nessuna categoria trovata!'
            );
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $category,
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('number', 10)/*limit per page*/
        );

        $category = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findAll();

        // passo l'oggetto $product a un template
        return $this->render(
            'QwebCMSCatalogoBundle:Welcome:showallcategory.html.twig',
            array('categories' => $category, 'pagination' => $pagination)
        );
    }
    
    public function allFeatureAction(Request $request){
        $feature = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueFeature')
            ->findAll();

        $category = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findAll();
        
        // passo l'oggetto $product a un template
        return $this->render(
            'QwebCMSCatalogoBundle:Welcome:showallfeatures.html.twig',
            array('features' => $feature, 'categories' => $category)
        );
    }
    
    public function allFeatureValueAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM QwebCMSCatalogoBundle:TblCatalogueFeaturevalue a";
        $featurevalue = $em->createQuery($dql);

        if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='title' ){
            $filterValue = $request->query->get('filterValue');

            $featurevalue = $em->createQuery('SELECT a FROM QwebCMSCatalogoBundle:TblCatalogueFeaturevalue a WHERE a.title LIKE :filterValue ');
            $featurevalue->setParameters(array(
                'filterValue' => '%'.$filterValue.'%'
            ));
        } else if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='idTblCatalogueFeaturevalue' ){
            $filterValue = $request->query->get('filterValue');

            $featurevalue = $em->createQuery('SELECT a FROM QwebCMSCatalogoBundle:TblCatalogueFeaturevalue a WHERE a.idTblCatalogueFeaturevalue LIKE :filterValue ');
            $featurevalue->setParameters(array(
                'filterValue' => '%'.$filterValue.'%'
            ));
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $featurevalue,
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('number', 10)/*limit per page*/
        );
        
        // passo l'oggetto $product a un template
        return $this->render(
            'QwebCMSCatalogoBundle:Welcome:showallfeaturevalues.html.twig',
            array('featurevalues' => $featurevalue, 'pagination' => $pagination)
        );
    }
}
