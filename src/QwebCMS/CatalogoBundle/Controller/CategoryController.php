<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QwebCMS\CatalogoBundle\Entity\TblCatalogueCategory as Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use QwebCMS\CatalogoBundle\Form\TblCatalogueCategoryType;

class CategoryController extends Controller
{
    public function createAction(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(new TblCatalogueCategoryType(), $category);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($category);
            $em->flush();

            $category->setIdTblCatalogueCategory($category->getId());

            $em->persist($category);
            $em->flush();
            return $this->redirect($this->generateUrl('categories'));
        }
        
        
        return $this->render('QwebCMSCatalogoBundle:Category:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function showAction($id)
    {
        $category = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->find($id);
    
        if (!$category) {
            throw $this->createNotFoundException(
                'Nessuna categoria trovata per l\'id '.$id
            );
        }
    
        // passo l'oggetto $category a un template
        return $this->render('QwebCMSCatalogoBundle:Category:showcategory.html.twig',
            array('category' => $category)
        );
    }
    
    public function updateAction($id, Request $request)
    {
        $category = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->find($id);
    
        if (!$category) {
            throw $this->createNotFoundException(
                'Nessun categoria trovato per l\'id '.$id
            );
        }
        
        $form = $this->createForm(new TblCatalogueCategoryType(), $category);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($category);
            $em->flush();
            return $this->redirect($this->generateUrl('categories'));
        }
    
        // passo l'oggetto $category a un template
        return $this->render('QwebCMSCatalogoBundle:Category:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function deleteAction($id, Request $request)
    {
        $category = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->find($id); 
    
        if (!$category) {
            throw $this->createNotFoundException(
                'Nessun categoria trovato per l\'id '.$id
            );
        }

        // esegue alcune azioni, salvare il prodotto nella base dati

        $em = $this->getDoctrine()->getManager();

        $em->remove($category);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'La categoria è stata eliminata!'
        );

        return $this->redirect($this->generateUrl('categories'));
    }
}