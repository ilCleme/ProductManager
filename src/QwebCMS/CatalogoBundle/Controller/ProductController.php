<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct as Product;
use QwebCMS\CatalogoBundle\Entity\TblPhotoCat as Album;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use QwebCMS\CatalogoBundle\Form\TblCatalogueProductType;
use QwebCMS\CatalogoBundle\Form\TblCatalogueProductEditType;
use QwebCMS\CatalogoBundle\Form\TblCatalogueProductEditInfoType;
use QwebCMS\CatalogoBundle\Form\TblCatalogueProductEditFeaturesType;
use QwebCMS\CatalogoBundle\Form\TblCatalogueProductEditImagesType;
use QwebCMS\CatalogoBundle\Entity\TblPhoto as Foto;

class ProductController extends Controller
{

    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }

        // passo l'oggetto $product a un template
        return $this->render(
            'QwebCMSCatalogoBundle:Product:showproduct.html.twig',
            array('product' => $product)
        );
    }

    public function updateAction($id, Request $request)
    {
        return $this->redirect($this->generateUrl('update_product_info', array(
            'id' => $id
        )));
    }

    public function deleteAction($id, Request $request)
    {
        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($product);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'Il prodotto Ã¨ stato eliminato!'
        );

        return $this->redirectToRoute('products');
    }

    public function uploadPhotoAction(Request $request)
    {
        $absolutedir			= $request->server->get('DOCUMENT_ROOT');
        $webserver              = strstr($absolutedir, 'public_html');

        if (strlen($webserver) > 0){
            $dir					= '/catalogo/web/uploads/gallery/';
        } else {
            $dir					= '/uploads/gallery/';
        }


        $serverdir				= $absolutedir.$dir;
        $filename				= array();

        $json = array();
        $json['data'] = $request->request->get('data');
        $json['name'] = $request->request->get('name');
        $json['id_album'] = $request->request->get('id_album');
        $json['id_prodotto'] = $request->request->get('id_prodotto');
        $name = $json['name'];

        $tmp					= explode(',',$json['data']);
        $imgdata 				= base64_decode($tmp[1]);
        $extension				= explode('.',$name);
        $fname					= substr($json['name'],0,-(strlen($extension[0]) + 1)).'.'.substr(sha1(time()),0,6).'.'.$extension[1];

        $handle					= fopen($serverdir.$fname,'w');
        fwrite($handle, $imgdata);
        fclose($handle);

        $filename[]				= $fname;

        $dir					= '/uploads/gallery/';
        $foto = new Foto();
        $foto->setNome($fname);
        $foto->setImg($dir.$fname);
        $foto->setIdTblPhotoCat($json['id_album']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($foto);
        $em->flush();

        $foto->setIdTblPhoto($foto->getId());
        $em->persist($foto);
        $em->flush();


        // RedirectResponse object
        $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($request, $dir.$fname, 'img_preview');

        // RedirectResponse object
        $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($request, $dir.$fname, 'img_small');

        // RedirectResponse object
        $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($request, $dir.$fname, 'img_medium');

        // RedirectResponse object
        $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($request, $dir.$fname, 'img_large');

        return new Response($fname);
    }

    public function createNewAction(Request $request){
        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findAll();

        $product = new Product();

        $form = $this->createForm(new TblCatalogueProductType(), $product);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            $em = $this->getDoctrine()->getManager();
            // Create a new empty Album for this product
            $album = new Album();
            $album->setNome($product->getTitle());
            $em->persist($album);
            $em->flush();

            // Save product information on database
            $product->setIdTblCatalogueProduct(0);
            $product->setIdTblPhotoCat($album->getIdTblPhotoCat());
            $product->setIdTblLingua(4);
            $em->persist($product);
            $em->flush();

            // Copy id product on idTblCatalogueProduct field
            $product->setIdTblCatalogueProduct($product->getId());
            $em->flush();

            if($form->get('saveAndContinue')->isClicked()) {
                return $this->redirect($this->generateUrl('update_product_feature', array(
                    'id' => $product->getIdTblCatalogueProduct()
                )));

            } elseif($form->get('save')->isClicked()) {

                $categoria = $product->getCategories();
                $categoria = $categoria[0]->getIdTblCatalogueCategory();

                return $this->redirect($this->generateUrl('show_category', array(
                    'id' => $categoria
                )));

            }

        }

        return $this->render('QwebCMSCatalogoBundle:Product:newproductinfo.html.twig', array(
            'form' => $form->createView(),
            'categories'    =>  $categories
        ));
    }

    public function updateInfoAction($id, Request $request){
        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findAll();

        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }

        $form = $this->createForm(new TblCatalogueProductEditInfoType(), $product);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            if($form->get('saveAndContinue')->isClicked()) {

                return $this->redirect($this->generateUrl('update_product_feature', array(
                    'id' => $product->getIdTblCatalogueProduct()
                )));

            } elseif($form->get('save')->isClicked()) {

                $categories = $product->getCategories();
                $category_id =  $categories[0]->getIdTblCatalogueCategory();
                return $this->redirect($this->generateUrl('show_category', array(
                    'id' => $category_id
                )));

            }

        }

        return $this->render('QwebCMSCatalogoBundle:Product:updateproductinfo.html.twig', array(
            'form' => $form->createView(), 'product' => $product, 'categories' => $categories,
        ));
    }

    public function updateFeaturesAction($id, Request $request){
        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findAll();

        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->find($id);

        $categorie = $product->getCategories();
        foreach($categorie as $categoria){
            $features = $categoria->getFeatures();
        }

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }

        $form = $this->createForm(new TblCatalogueProductEditFeaturesType(), $product);

        if ( !($form->isValid()) ) {
            $featurevalues = $product->getFeaturevalues();
            $categorie = $product->getCategories();
            foreach ($categorie as $categoria) {
                $features = $categoria->getFeatures();
                foreach ($features as $feature) {
                    if($feature->getTypeInput() == "select"){
                        //$form->get('featurevalues_'.$feature->getIdTblCatalogueFeature())->setData($featurevalues);
                        foreach($featurevalues as $featurevalue){
                            $featureChildrens = $feature->getFeaturevalues();
                            foreach($featureChildrens as $children){
                                if($children->getIdTblCatalogueFeaturevalue() == $featurevalue->getIdTblCatalogueFeaturevalue()){
                                    $form->get('featurevalues_'.$feature->getIdTblCatalogueFeature())->setData($featurevalue);
                                }
                            }
                        }
                    } else {
                        $form->get('featurevalues_'.$feature->getIdTblCatalogueFeature())->setData($featurevalues);
                    }
                }
            }
        }
        $form->handleRequest($request);

        if ($form->isValid()) {

            $categorie = $product->getCategories();
            foreach($categorie as $categoria){
                $features = $categoria->getFeatures();
                foreach($features as $feature){
                    $featurevalues = $form->get('featurevalues_'.$feature->getIdTblCatalogueFeature())->getData();
                    if($feature->getTypeInput() == "select"){
                        $product->removeFeaturevalue($featurevalues);
                        $product->addFeaturevalue($featurevalues);
                    } else {
                        foreach($featurevalues as $featurevalue){
                            $product->removeFeaturevalue($featurevalue);
                            $product->addFeaturevalue($featurevalue);
                        }
                    }
                }
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            if ($form->get('exit')->isClicked()) {
                $categories = $product->getCategories();
                $category_id =  $categories[0]->getIdTblCatalogueCategory();
                return $this->redirect($this->generateUrl('show_category', array(
                    'id' => $category_id
                )));
            } elseif($form->get('save')->isClicked()) {

                return $this->redirect($this->generateUrl('update_product_immagini', array(
                    'id' => $product->getIdTblCatalogueProduct()
                )));
            }



        }

        return $this->render('QwebCMSCatalogoBundle:Product:updateproductfeatures.html.twig', array(
            'form' => $form->createView(), 'product' => $product, 'categories' => $categories, 'features'   =>  $features,
        ));
    }

    public function updateImagesAction($id, Request $request){
        $categories = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueCategory')
            ->findAll();

        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }

        // Getting photo of product
        $photos= $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblPhoto')
            ->findBy( array('idTblPhotoCat' => $product->getIdTblPhotoCat()),
                array('posizione' => 'ASC'));

        $form = $this->createForm(new TblCatalogueProductEditImagesType(), $product);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            if($form->get('saveAndContinue')->isClicked()) {

                return $this->redirect($this->generateUrl('update_product_info', array(
                    'id' => $product->getIdTblCatalogueProduct()
                )));

            } elseif($form->get('save')->isClicked()) {

                $categories = $product->getCategories();
                $category_id =  $categories[0]->getIdTblCatalogueCategory();
                return $this->redirect($this->generateUrl('show_category', array(
                    'id' => $category_id
                )));

            }

        }

        return $this->render('QwebCMSCatalogoBundle:Product:updateproductimages.html.twig', array(
            'form' => $form->createView(), 'product' => $product, 'categories' => $categories, 'immagini' => $photos,
        ));
    }
}