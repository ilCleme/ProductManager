<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QwebCMS\CatalogoBundle\Entity\Category as Category;
use Symfony\Component\HttpFoundation\Request;
use QwebCMS\CatalogoBundle\Form\CategoryType;

class CategoryController extends Controller
{
    public function createAction(Request $request)
    {
        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:Category')
            ->findAll();

        $category = new Category();
        $category->setIdTblLingua($this->get('language.manager')->getSessionLanguage());
        $form = $this->createForm(new CategoryType($this->get('language.manager')->getSessionLanguage()), $category);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirect($this->generateUrl('categories'));
        }
        
        
        return $this->render('QwebCMSCatalogoBundle:Category:new.html.twig', array(
            'form' => $form->createView(),
            'categories' => $categories
        ));
    }
    
    public function showAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='a.title' ){
            $filterValue = $request->query->get('filterValue');

            $dql = 'SELECT a FROM QwebCMSCatalogoBundle:Product a JOIN a.categories c WHERE c.id = ?1 AND a.idTblLingua = ?2 AND a.title LIKE :filterValue ORDER BY a.title ASC';
            $product = $em->createQuery($dql);
            $product->setParameters(array(
                'filterValue' => '%'.$filterValue.'%',
                1   =>  $id,
                2   =>  $this->get('language.manager')->getSessionLanguage()
            ));

            $product = $product->getResult();
        } else if ( null !== $request->query->get('filterField') && $request->query->get('filterField')=='a.shortDescription' ){
            $filterValue = $request->query->get('filterValue');

            $product = $em->createQuery('SELECT a FROM QwebCMSCatalogoBundle:Product a JOIN a.categories c WHERE c.id = ?1 AND a.idTblLingua = ?2 AND a.shortDescription LIKE :filterValue ');
            $product->setParameters(array(
                'filterValue' => '%'.$filterValue.'%',
                1   =>  $id,
                2   =>  $this->get('language.manager')->getSessionLanguage()
            ));

            $product = $product->getResult();
        } else {
            $dql   = "SELECT a FROM QwebCMSCatalogoBundle:Product a JOIN a.categories c WHERE c.id = ?1 AND a.idTblLingua = ?2 ORDER BY a.title ASC";
            $product = $em->createQuery($dql);
            $product->setParameter(1,$id);
            $product->setParameter(2,$this->get('language.manager')->getSessionLanguage());
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $product,
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('number', 50)/*limit per page*/
        );

        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:Category')
            ->findBy(array('idTblLingua' => $this->get('language.manager')->getSessionLanguage()));

        if (!$categories) {
            throw $this->createNotFoundException(
                'Nessuna categoria trovata!'
            );
        }

        $category = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:Category')
            ->findBy(array('id' => $id, 'idTblLingua' => $this->get('language.manager')->getSessionLanguage()));

        // Getting photo of product
        $photos= $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblPhoto')
            ->findBy(array(), array('posizione' => 'ASC'));

        return $this->render(
            'QwebCMSCatalogoBundle:Welcome:showallcategoryproduct.html.twig',
            array('category' => $category, 'categories' => $categories, 'pagination' => $pagination, 'id' => $id, 'photos' => $photos)
        );
    }
    
    public function updateAction($id, Request $request)
    {
        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:Category')
            ->findBy(array('idTblLingua' => $this->get('language.manager')->getSessionLanguage()));

        $category = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:Category')
            ->findOneBy(array('id' => $id, 'idTblLingua' => $this->get('language.manager')->getSessionLanguage()));
    
        if (!$category) {
            throw $this->createNotFoundException(
                'Nessun categoria trovato per l\'id '.$id
            );
        }
        
        $form = $this->createForm(new CategoryType($this->get('language.manager')->getSessionLanguage()), $category);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($category);
            $em->flush();
            return $this->redirect($this->generateUrl('categories'));
        }
    
        // passo l'oggetto $category a un template
        return $this->render('QwebCMSCatalogoBundle:Category:update.html.twig', array(
            'form' => $form->createView(),
            'categories' => $categories,
            'category' => $category
        ));
    }
    
    public function deleteAction($id, Request $request)
    {
        $category = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:Category')
            ->findOneBy(array('id' => $id, 'idTblLingua' => $this->get('language.manager')->getSessionLanguage()));
    
        if (!$category) {
            throw $this->createNotFoundException(
                'Nessun categoria trovato per l\'id '.$id
            );
        }

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