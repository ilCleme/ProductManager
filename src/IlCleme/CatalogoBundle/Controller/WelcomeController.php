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

        $count['product'] = $product;

        $category = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Category')
            ->countCategory($lingua);

        $count['category'] = $category;

        $feature = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Feature')
            ->countFeature($lingua);

        $count['feature'] = $feature;

        $featurevalue = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Featurevalue')
            ->countFeaturevalues($lingua);

        $count['featurevalues'] = $featurevalue;

        $category = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Category')
            ->findBy(array('idTblLingua' => $this->get('language.manager')->getSessionLanguage()));

        return $this->render('IlClemeCatalogoBundle:Welcome:index.html.twig',
            array('count' => $count, 'categories' => $category)
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
