<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QwebCMS\CatalogoBundle\Entity\TblCatalogueFeature as Feature;
use Symfony\Component\HttpFoundation\Request;
use QwebCMS\CatalogoBundle\Form\TblCatalogueFeatureType;

class FeatureController extends Controller
{
    public function createAction(Request $request)
    {
        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findBy(array('idTblLingua' => $this->get('language.manager')->getSessionLanguage()));

        $feature = new Feature();
        $feature->setIdTblLingua($this->get('language.manager')->getSessionLanguage());
        $form = $this->createForm(new TblCatalogueFeatureType($this->get('language.manager')->getSessionLanguage()), $feature);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $feature->setIdTblCatalogueFeature(0);
            $em->persist($feature);
            $em->flush();
            
            //Aggiornare il valore del campo id_tbl_catalogue_category con il nuovo id
            $feature->setIdTblCatalogueFeature($feature->getId());
            
            $em->persist($feature);
            $em->flush();
            return $this->redirect($this->generateUrl('features'));
        }
        
        return $this->render('QwebCMSCatalogoBundle:Feature:new.html.twig', array(
            'form' => $form->createView(),
            'categories' => $categories
        ));
    }

    
    public function updateAction($id, Request $request)
    {
        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findBy(array('idTblLingua' => $this->get('language.manager')->getSessionLanguage()));

        $feature = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueFeature')
            ->findOneBy(array('idTblCatalogueFeature' => $id, 'idTblLingua' => $this->get('language.manager')->getSessionLanguage()));
    
        if (!$feature) {
            throw $this->createNotFoundException(
                'Nessuna categoria di feature trovata per l\'id '.$id
            );
        }
        
        $form = $this->createForm(new TblCatalogueFeatureType($this->get('language.manager')->getSessionLanguage()), $feature);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feature);
            $em->flush();
            return $this->redirect($this->generateUrl('features'));
        }

        return $this->render('QwebCMSCatalogoBundle:Feature:update.html.twig', array(
            'form' => $form->createView(),
            'feature' => $feature,
            'categories' => $categories
        ));
    }
    
    public function deleteAction($id, Request $request)
    {
        $feature = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueFeature')
            ->findOneBy(array('idTblCatalogueFeature' => $id, 'idTblLingua' => $this->get('language.manager')->getSessionLanguage()));
    
        if (!$feature) {
            throw $this->createNotFoundException(
                'Nessuna categoria di feature trovata per l\'id '.$id
            );
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($feature);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'La feature è stata eliminata!'
        );

        return $this->redirect($this->generateUrl('features'));
    }
}