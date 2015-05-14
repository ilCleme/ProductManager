<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Entity\TblCatalogueFeature as Feature;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\TblCatalogueFeatureType;

class FeatureController extends Controller
{
    public function createAction(Request $request)
    {
        $feature = new Feature();
        
        $form = $this->createForm(new TblCatalogueFeatureType(), $feature);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($feature);
            $em->flush();
            
            //Aggiornare il valore del campo id_tbl_catalogue_category con il nuovo id
            $feature->setIdTblCatalogueFeature($feature->getId());
            
            $em->persist($feature);
            $em->flush();
            return $this->redirect($this->generateUrl('features'));
        }
        
        
        return $this->render('AcmeDemoBundle:Feature:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function showAction($id)
    {
        $feature = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueFeature')
            ->find($id);
    
        if (!$feature) {
            throw $this->createNotFoundException(
                'Nessuna categoria di Feature è stata trovata per l\'id '.$id
            );
        }
    
        // passo l'oggetto $feature a un template
        return $this->render('AcmeDemoBundle:Feature:showfeature.html.twig',
            array('feature' => $feature)
        );
    }
    
    public function updateAction($id, Request $request)
    {
        $feature = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueFeature')
            ->find($id);
    
        if (!$feature) {
            throw $this->createNotFoundException(
                'Nessuna categoria di feature trovata per l\'id '.$id
            );
        }
        
        $form = $this->createForm(new TblCatalogueFeatureType(), $feature);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($feature);
            $em->flush();
            return $this->redirect($this->generateUrl('features'));
        }
    
        // passo l'oggetto $feature a un template
        return $this->render('AcmeDemoBundle:Feature:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function deleteAction($id, Request $request)
    {
        $feature = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueFeature')
            ->find($id); 
    
        if (!$feature) {
            throw $this->createNotFoundException(
                'Nessuna categoria di feature trovata per l\'id '.$id
            );
        }
        
        $form = $this->createForm(new TblCatalogueFeatureType(), $feature);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            
            $em = $this->getDoctrine()->getManager();
            
            $em->remove($feature);
            $em->flush();
            return $this->redirect($this->generateUrl('features'));
        }
    
        // passo l'oggetto $feature a un template
        return $this->render('AcmeDemoBundle:Feature:delete.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}