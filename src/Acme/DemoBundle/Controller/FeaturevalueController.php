<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Entity\TblCatalogueFeaturevalue as Featurevalue;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\TblCatalogueFeaturevalueType;

class FeaturevalueController extends Controller
{
    public function createAction(Request $request)
    {
        $featurevalues = new Featurevalue();
        
        $form = $this->createForm(new TblCatalogueFeaturevalueType(), $featurevalues);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($featurevalues);
            $em->flush();
            
            //Aggiornare il valore del campo id_tbl_catalogue_category con il nuovo id
            $featurevalues->setIdTblCatalogueFeaturevalue($featurevalues->getId());
            
            $em->persist($featurevalues);
            $em->flush();
            return $this->redirect($this->generateUrl('featurevalues'));
        }
        
        
        return $this->render('AcmeDemoBundle:Featurevalue:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function showAction($id)
    {
        $featurevalues = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueFeaturevalue')
            ->find($id);
    
        if (!$featurevalues) {
            throw $this->createNotFoundException(
                'Nessuna categoria trovata per l\'id '.$id
            );
        }
    
        // passo l'oggetto $featurevalues a un template
        return $this->render('AcmeDemoBundle:Featurevalue:showcategory.html.twig',
            array('category' => $featurevalues)
        );
    }
    
    public function updateAction($id, Request $request)
    {
        $featurevalues = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueFeaturevalue')
            ->find($id);
    
        if (!$featurevalues) {
            throw $this->createNotFoundException(
                'Nessun categoria trovato per l\'id '.$id
            );
        }
        
        $form = $this->createForm(new TblCatalogueFeaturevalueType(), $featurevalues);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($featurevalues);
            $em->flush();
            return $this->redirect($this->generateUrl('featurevalues'));
        }
    
        // passo l'oggetto $featurevalues a un template
        return $this->render('AcmeDemoBundle:Featurevalue:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function deleteAction($id, Request $request)
    {
        $featurevalues = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueFeaturevalue')
            ->find($id); 
    
        if (!$featurevalues) {
            throw $this->createNotFoundException(
                'Nessun categoria trovato per l\'id '.$id
            );
        }
        
        $form = $this->createForm(new TblCatalogueFeaturevalueType(), $featurevalues);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            
            $em = $this->getDoctrine()->getManager();
            
            $em->remove($featurevalues);
            $em->flush();
            return $this->redirect($this->generateUrl('featurevalues'));
        }
    
        // passo l'oggetto $featurevalues a un template
        return $this->render('AcmeDemoBundle:Featurevalue:delete.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}