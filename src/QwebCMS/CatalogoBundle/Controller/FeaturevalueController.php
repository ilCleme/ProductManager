<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QwebCMS\CatalogoBundle\Entity\TblCatalogueFeaturevalue as Featurevalue;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use QwebCMS\CatalogoBundle\Form\TblCatalogueFeaturevalueType;

class FeaturevalueController extends Controller
{
    public function createAction(Request $request)
    {
        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findAll();

        $featurevalues = new Featurevalue();
        $featurevalues->setIdTblLingua($this->get('language.manager')->getSessionLanguage());
        $form = $this->createForm(new TblCatalogueFeaturevalueType($this->get('language.manager')->getSessionLanguage()), $featurevalues);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($featurevalues);
            $em->flush();
            
            //Aggiornare il valore del campo id_tbl_catalogue_category con il nuovo id
            $featurevalues->setIdTblCatalogueFeaturevalue($featurevalues->getId());
            
            $em->persist($featurevalues);
            $em->flush();
            return $this->redirect($this->generateUrl('features'));
        }

        return $this->render('QwebCMSCatalogoBundle:Featurevalue:new.html.twig', array(
            'form' => $form->createView(),
            'categories' => $categories
        ));
    }
    
    public function updateAction($id, Request $request)
    {
        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findAll();

        $featurevalues = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueFeaturevalue')
            ->findOneBy(array('idTblCatalogueFeaturevalue' => $id, 'idTblLingua' => $this->get('language.manager')->getSessionLanguage()));
    
        if (!$featurevalues) {
            throw $this->createNotFoundException(
                'Nessun categoria trovato per l\'id '.$id
            );
        }
        
        $form = $this->createForm(new TblCatalogueFeaturevalueType($this->get('language.manager')->getSessionLanguage()), $featurevalues);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($featurevalues);
            $em->flush();
            return $this->redirect($this->generateUrl('features'));
        }

        return $this->render('QwebCMSCatalogoBundle:Featurevalue:update.html.twig', array(
            'form' => $form->createView(),
            'featurevalue' => $featurevalues,
            'categories' => $categories
        ));
    }
    
    public function deleteAction($id, Request $request)
    {
        $featurevalues = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueFeaturevalue')
            ->findOneBy(array('idTblCatalogueFeaturevalue' => $id, 'idTblLingua' => $this->get('language.manager')->getSessionLanguage()));
    
        if (!$featurevalues) {
            throw $this->createNotFoundException(
                'Nessun categoria trovato per l\'id '.$id
            );
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($featurevalues);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'La featurevalues è stata eliminata!'
        );

        return $this->redirect($this->generateUrl('features'));
    }

    public function showCategoryFeaturevalueAction($id, Request $request)
    {
        $feature = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueFeature')
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a, u FROM QwebCMSCatalogoBundle:TblCatalogueFeaturevalue a JOIN a.features u WHERE u.idTblCatalogueFeature = ".$id;
        $featurevalue = $em->createQuery($dql);

        if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='title' ){
            $filterValue = $request->query->get('filterValue');

            $featurevalue = $em->createQuery('SELECT a, u FROM QwebCMSCatalogoBundle:TblCatalogueFeaturevalue a JOIN a.features u WHERE u.idTblCatalogueFeature = :id AND a.title LIKE :filterValue ');
            $featurevalue->setParameters(array(
                'filterValue' => '%'.$filterValue.'%',
                'id'    => $id
            ));
        } else if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='idTblCatalogueFeaturevalue' ){
            $filterValue = $request->query->get('filterValue');

            $featurevalue = $em->createQuery('SELECT a, u FROM QwebCMSCatalogoBundle:TblCatalogueFeaturevalue a JOIN a.features u WHERE u.idTblCatalogueFeature = :id AND a.idTblCatalogueFeaturevalue LIKE :filterValue ');
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
            'QwebCMSCatalogoBundle:Featurevalue:listcategoryfeaturevalues.html.twig',
            array('featurevalues' => $featurevalue, 'pagination' => $pagination, 'feature' => $feature)
        );
    }
}