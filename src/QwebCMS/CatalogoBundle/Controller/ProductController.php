<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QwebCMS\CatalogoBundle\Entity\TblCatalogueProduct as Product;
use QwebCMS\CatalogoBundle\Entity\TblPhotoCat as Album;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use QwebCMS\CatalogoBundle\Form\TblCatalogueProductType;
use QwebCMS\CatalogoBundle\Form\TblCatalogueProductEditType;
use QwebCMS\CatalogoBundle\Entity\TblPhoto as Foto;

class ProductController extends Controller
{
    public function createAction(Request $request)
    {
        $product = new Product();

        $form = $this->createForm(new TblCatalogueProductType(), $product);

        $form->handleRequest($request);
        
        if ($form->isValid()) {
            // esegue alcune azioni, salvare il prodotto nella base dati
            $em = $this->getDoctrine()->getManager();

            if($form->get('saveAndContinue')->isClicked()) {

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

                $form = $this->createForm(new TblCatalogueProductType(), $product);

                if ($product->getIdTblPhotoCat() != null) {
                    $id_album = $product->getIdTblPhotoCat();
                } else {
                    $id_album = 0;
                }

                return $this->render('QwebCMSCatalogoBundle:Product:new.html.twig', array(
                    'form'     => $form->createView(),
                    'id_album' => $id_album
                ));

            } elseif($form->get('save')->isClicked()) {

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
                return $this->redirect($this->generateUrl('products'));

            } else {
                return $this->redirect($this->generateUrl('products'));
            }

        }

        return $this->render('QwebCMSCatalogoBundle:Product:new.html.twig', array(
            'form' => $form->createView(),
            'id_album' => 0
        ));
    }
    
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
        // Getting product information
        $product = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblCatalogueProduct')
            ->find($id);

        $product->setIdTblLingua(4);
    
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

        $form = $this->createForm(new TblCatalogueProductEditType(), $product);

        if ( !($form->isValid()) ) {
            $featurevalues = $product->getFeaturevalues();
            $categorie = $product->getCategories();
            foreach ($categorie as $categoria) {
                $features = $categoria->getFeatures();
                foreach ($features as $feature) {
                    if($feature->getTypeInput() == "select"){
                        //$form->get('featurevalues_'.$feature->getId())->setData($featurevalues);
                        foreach($featurevalues as $featurevalue){
                            $featureChildrens = $feature->getFeaturevalues();
                            foreach($featureChildrens as $children){
                                if($children->getIdTblCatalogueFeaturevalue() == $featurevalue->getIdTblCatalogueFeaturevalue()){
                                    $form->get('featurevalues_'.$feature->getId())->setData($featurevalue);
                                }
                            }
                        }
                    } else {
                        $form->get('featurevalues_'.$feature->getId())->setData($featurevalues);
                    }
                }
            }
        }

        $form->handleRequest($request);
        //$features = null;

        if ($form->get('exit')->isClicked() && $form->isValid()) {
            $categorie = $product->getCategories();
            foreach($categorie as $categoria){
                $features = $categoria->getFeatures();
                foreach($features as $feature){
                    $featurevalues = $form->get('featurevalues_'.$feature->getId())->getData();
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

            return $this->redirect($this->generateUrl('products'));
        } elseif($form->get('save')->isClicked() && $form->isValid()) {
            $categorie = $product->getCategories();
            foreach($categorie as $categoria){
                $features = $categoria->getFeatures();
                foreach($features as $feature){
                    $featurevalues = $form->get('featurevalues_'.$feature->getId())->getData();
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
        }

        // passo l'oggetto $product a un template
        return $this->render('QwebCMSCatalogoBundle:Product:update.html.twig', array(
            'form' => $form->createView(),
            'product' => $product,
            'immagini' => $photos,
            'features'   =>  $features,
        ));
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
            'Il prodotto è stato eliminato!'
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
                return $this->redirect($this->generateUrl('update_product', array(
                    'id' => $product->getIdTblCatalogueProduct()
                )));

            } elseif($form->get('save')->isClicked()) {

                return $this->redirect($this->generateUrl('products'));

            }

        }

        return $this->render('QwebCMSCatalogoBundle:Product:infoproduct.html.twig', array(
            'form' => $form->createView()
        ));
    }
}