<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Entity\TblCatalogueProduct as Product;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */

        return $this->render('AcmeDemoBundle:Welcome:index.html.twig');
    }
    
    public function allProductAction(){
        $product = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueProduct')
            ->findAll();

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }
        
        // passo l'oggetto $product a un template
        return $this->render(
            'AcmeDemoBundle:Welcome:showallproduct.html.twig',
            array('products' => $product)
        );
    }
    
    public function allCategoryAction(){
        $category = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueCategory')
            ->findAll();

        if (!$category) {
            throw $this->createNotFoundException(
                'Nessuna categoria trovata!'
            );
        }
        
        // passo l'oggetto $product a un template
        return $this->render(
            'AcmeDemoBundle:Welcome:showallcategory.html.twig',
            array('categories' => $category)
        );
    }
    
    public function allFeatureAction(){
        $feature = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueFeature')
            ->findAll();

        if (!$feature) {
            throw $this->createNotFoundException(
                'Nessuna feature trovata!'
            );
        }
        
        // passo l'oggetto $product a un template
        return $this->render(
            'AcmeDemoBundle:Welcome:showallfeatures.html.twig',
            array('features' => $feature)
        );
    }
    
    public function allFeatureValueAction(){
        $featurevalue = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:TblCatalogueFeaturevalue')
            ->findAll();

        if (!$featurevalue) {
            throw $this->createNotFoundException(
                'Nessuna feature trovata!'
            );
        }
        
        // passo l'oggetto $product a un template
        return $this->render(
            'AcmeDemoBundle:Welcome:showallfeaturevalues.html.twig',
            array('featurevalues' => $featurevalue)
        );
    }
}
