<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct as Product;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */

        return $this->render('QwebCMSCatalogoBundle:Welcome:index.html.twig');
    }
    
    public function allProductAction(){
        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->findAll();

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }
        
        //$_SESSION['login'] = 1;
        
        // passo l'oggetto $product a un template
        return $this->render(
            'QwebCMSCatalogoBundle:Welcome:showallproduct.html.twig',
            array('products' => $product)
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
