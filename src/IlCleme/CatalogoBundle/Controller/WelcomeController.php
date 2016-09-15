<?php

namespace IlCleme\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        $lingua = $this->get('language.manager')->getSessionLanguage();

        $product = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Product')
            ->countProduct($lingua);

        $category = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Category')
            ->countCategory($lingua);
            
        $feature = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Feature')
            ->countFeature($lingua);

        $featurevalue = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Featurevalue')
            ->countFeaturevalues($lingua);
            
        return $this->render('IlClemeCatalogoBundle:Welcome:index.html.twig',
            array('products' => $product, 'categories' => $category, 'features' => $feature, 'featurevalues' => $featurevalue)
            );
    }

    public function allProductAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM IlClemeCatalogoBundle:Product a";
        $product = $em->createQuery($dql);

        if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='title' ){
            $filterValue = $request->query->get('filterValue');

            $product = $em->createQuery('SELECT a FROM IlClemeCatalogoBundle:Product a WHERE a.title LIKE :filterValue ');
            $product->setParameters(array(
                'filterValue' => '%'.$filterValue.'%'
            ));
        } else if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='shortDescription' ){
            $filterValue = $request->query->get('filterValue');

            $product = $em->createQuery('SELECT a FROM IlClemeCatalogoBundle:Product a WHERE a.shortDescription LIKE :filterValue ');
            $product->setParameters(array(
                'filterValue' => '%'.$filterValue.'%'
            ));
        } else if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='idProduct' ){
            $filterValue = $request->query->get('filterValue');

            $product = $em->createQuery('SELECT a FROM IlClemeCatalogoBundle:Product a WHERE a.id LIKE :filterValue ');
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
            ->getRepository('IlClemeCatalogoBundle:Category')
            ->findAll();
        
        // passo l'oggetto $product a un template
        return $this->render(
            'IlClemeCatalogoBundle:Welcome:showallproduct.html.twig',
            array('products' => $product, 'pagination' => $pagination, 'categories' => $categories)
        );
    }
    
    public function allCategoryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM IlClemeCatalogoBundle:Category a WHERE a.idTblLingua = ?1";
        $category = $em->createQuery($dql);
        $category->setParameters(array(
            1   => $this->get('language.manager')->getSessionLanguage()
        ));

        if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='title' ){
            $filterValue = $request->query->get('filterValue');

            $category = $em->createQuery('SELECT a FROM IlClemeCatalogoBundle:Category a WHERE a.title LIKE :filterValue AND a.idTblLingua = ?1');
            $category->setParameters(array(
                'filterValue' => '%'.$filterValue.'%',
                1   => $this->get('language.manager')->getSessionLanguage()
            ));
        } else if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='id' ){
            $filterValue = $request->query->get('filterValue');

            $category = $em->createQuery('SELECT a FROM IlClemeCatalogoBundle:Category a WHERE a.id LIKE :filterValue AND a.idTblLingua = ?1');
            $category->setParameters(array(
                'filterValue' => '%'.$filterValue.'%',
                1   => $this->get('language.manager')->getSessionLanguage()
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
            $request->query->getInt('number', 50)/*limit per page*/
        );

        $category = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Category')
            ->findBy(array('idTblLingua' => $this->get('language.manager')->getSessionLanguage()));

        // passo l'oggetto $product a un template
        return $this->render(
            'IlClemeCatalogoBundle:Welcome:showallcategory.html.twig',
            array('categories' => $category, 'pagination' => $pagination)
        );
    }
    
    public function allFeatureAction(Request $request)
    {
        $feature = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Feature')
            ->findBy(array('idTblLingua' => $this->get('language.manager')->getSessionLanguage()));

        $category = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Category')
            ->findBy(array('idTblLingua' => $this->get('language.manager')->getSessionLanguage()));
        
        // passo l'oggetto $product a un template
        return $this->render(
            'IlClemeCatalogoBundle:Welcome:showallfeatures.html.twig',
            array('features' => $feature, 'categories' => $category, 'lingua' => $this->get('language.manager')->getSessionLanguage(),)
        );
    }
    
    public function allFeatureValueAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM IlClemeCatalogoBundle:Featurevalue a";
        $featurevalue = $em->createQuery($dql);

        if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='title' ){
            $filterValue = $request->query->get('filterValue');

            $featurevalue = $em->createQuery('SELECT a FROM IlClemeCatalogoBundle:Featurevalue a WHERE a.title LIKE :filterValue ');
            $featurevalue->setParameters(array(
                'filterValue' => '%'.$filterValue.'%'
            ));
        } else if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='id' ){
            $filterValue = $request->query->get('filterValue');

            $featurevalue = $em->createQuery('SELECT a FROM IlClemeCatalogoBundle:Featurevalue a WHERE a.id LIKE :filterValue ');
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
            'IlClemeCatalogoBundle:Welcome:showallfeaturevalues.html.twig',
            array('featurevalues' => $featurevalue, 'pagination' => $pagination)
        );
    }
}
