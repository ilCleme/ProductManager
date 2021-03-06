<?php

namespace IlCleme\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IlCleme\CatalogoBundle\Entity\Product as Product;
use IlCleme\CatalogoBundle\Entity\Album as Album;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use IlCleme\CatalogoBundle\Form\TblCatalogueProductType;
use IlCleme\CatalogoBundle\Form\TblCatalogueProductEditInfoType;
use IlCleme\CatalogoBundle\Form\TblCatalogueProductEditFeaturesType;
use IlCleme\CatalogoBundle\Form\TblCatalogueProductEditImagesType;
use IlCleme\CatalogoBundle\Entity\Photo as Foto;

class ProductController extends Controller
{
    public function deleteAction($id, Request $request)
    {
        $product = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Product')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }

        $categories = $product->getCategories();
        $category_id =  $categories[0]->getId();

        $em = $this->getDoctrine()->getManager();

        $em->remove($product);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'Il prodotto è stato eliminato!'
        );


        return $this->redirect($this->generateUrl('show_category', array(
            'id' => $category_id
        )));
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
        $foto->setIdTblLingua($this->get('language.manager')->getSessionLanguage());
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

    public function createAction(Request $request)
    {
        $lingua = $this->get('language.manager')->getSessionLanguage();
        $categories = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Category')
            ->findBy(array('idTblLingua' => $lingua));

        $product = new Product();
        $product->setIdTblLingua($lingua);
        $form = $this->createForm(TblCatalogueProductType::class, $product, array(
            'language' => $lingua
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $album = new Album();
            $album->setNome($product->getTitle());
            $em->persist($album);
            $em->flush();

            // Save product information on database
            $product->setIdTblPhotoCat($album->getId());
            $em->persist($product);
            $em->flush();

            if($form->get('saveAndContinue')->isClicked()) {
                return $this->redirect($this->generateUrl('update_product_feature', array(
                    'id' => $product->getId()
                )));

            } elseif($form->get('save')->isClicked()) {

                $categories = $product->getCategories();
                $category_id =  $categories->first()->getId();
                return $this->redirect($this->generateUrl('show_category', array(
                    'id' => $category_id
                )));

            }

        }

        return $this->render('IlClemeCatalogoBundle:Product:newproductinfo.html.twig', array(
            'form' => $form->createView(),
            'categories'    =>  $categories
        ));
    }

    public function updateInfoAction($id, Request $request)
    {
        /*$categories = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Category')
            ->findBy(array('idTblLingua' => $this->get('language.manager')->getSessionLanguage()));*/

        $lingua = $this->get('language.manager')->getSessionLanguage();
        $product = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Product')
            ->findOneBy(array('id' => $id, 'idTblLingua' => $lingua));

        $categories = $product->getCategoriesByLanguage($lingua);

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }

        $form = $this->createForm(TblCatalogueProductEditInfoType::class, $product, array(
            'language' => $lingua,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            if($form->get('saveAndContinue')->isClicked()) {

                return $this->redirect($this->generateUrl('update_product_feature', array(
                    'id' => $product->getId()
                )));

            } elseif($form->get('save')->isClicked()) {

                $categories = $product->getCategories();
                $category_id =  $categories->first()->getId();
                return $this->redirect($this->generateUrl('show_category', array(
                    'id' => $category_id
                )));

            }

        }

        return $this->render('IlClemeCatalogoBundle:Product:updateproductinfo.html.twig', array(
            'form' => $form->createView(), 'product' => $product, 'categories' => $categories,
        ));
    }

    public function updateFeaturesAction($id, Request $request){
        /*$categories = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Category')
            ->findBy(array('idTblLingua' => $this->get('language.manager')->getSessionLanguage()));
        */

        $lingua = $this->get('language.manager')->getSessionLanguage();
        $product = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Product')
            ->findOneBy(array('id' => $id, 'idTblLingua' => $lingua));

        $categories = $product->getCategoriesByLanguage($lingua);

        $categorie = $product->getCategories();
        foreach($categorie as $categoria){
            $features = $categoria->getFeatures();
        }

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }

        $form = $this->createForm(TblCatalogueProductEditFeaturesType::class, $product, array(
            'language' => $lingua
        ));

        if ( !($form->isValid()) ) {

            $featurevalues = $this->getDoctrine()
                ->getRepository('IlClemeCatalogoBundle:Product')
                ->findFeaturevaluesProductByLanguage($id, $this->get('language.manager')->getSessionLanguage());

            if ($featurevalues != null){
                $categorie = $product->getCategories();
                foreach ($categorie as $categoria) {
                    $features = $categoria->getFeaturesByLanguage($this->get('language.manager')->getSessionLanguage());
                    foreach ($features as $feature) {
                        if($feature->getTypeInput() == "select"){
                            //$form->get('featurevalues_'.$feature->getIdTblCatalogueFeature())->setData($featurevalues);
                            foreach($featurevalues as $featurevalue){
                                $featureChildrens = $feature->getFeaturevalues();
                                foreach($featureChildrens as $children){
                                    if($children->getId() == $featurevalue->getId()){
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
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $categorie = $product->getCategories();
            foreach($categorie as $categoria){
                $features = $categoria->getFeatures();
                foreach($features as $feature){
                    if ($form->has('featurevalues_'.$feature->getId())){
                        $featurevalues = $form->get('featurevalues_'.$feature->getId())->getData();
                        if (!empty($featurevalues)){
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
                }
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            if ($form->get('exit')->isClicked()) {
                $categories = $product->getCategories();
                $category_id =  $categories->first()->getId();
                return $this->redirect($this->generateUrl('show_category', array(
                    'id' => $category_id
                )));
            } elseif($form->get('save')->isClicked()) {

                return $this->redirect($this->generateUrl('update_product_immagini', array(
                    'id' => $product->getId()
                )));
            }

        }

        return $this->render('IlClemeCatalogoBundle:Product:updateproductfeatures.html.twig', array(
            'form' => $form->createView(), 'product' => $product, 'categories' => $categories, 'features'   =>  $features,
        ));
    }

    public function updateImagesAction($id, Request $request){
        $lingua = $this->get('language.manager')->getSessionLanguage();
        $product = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Product')
            ->findOneBy(array('id' => $id, 'idTblLingua' => $lingua));

        $categories = $product->getCategoriesByLanguage($lingua);

        if (!$product) {
            throw $this->createNotFoundException(
                'Nessun prodotto trovato per l\'id '.$id
            );
        }

        // Getting photo of product
        $photos= $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Photo')
            ->findBy( array(
                'album' => $product->getIdTblPhotoCat(),
                'idTblLingua' => $lingua
            ), array(
                'posizione' => 'ASC'
            ));

        $form = $this->createForm(TblCatalogueProductEditImagesType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            if($form->get('saveAndContinue')->isClicked()) {

                return $this->redirect($this->generateUrl('update_product_info', array(
                    'id' => $product->getId()
                )));

            } elseif($form->get('save')->isClicked()) {

                $categories = $product->getCategories();
                $category_id =  $categories->first()->getId();
                return $this->redirect($this->generateUrl('show_category', array(
                    'id' => $category_id
                )));

            }

        }

        return $this->render('IlClemeCatalogoBundle:Product:updateproductimages.html.twig', array(
            'form' => $form->createView(), 'product' => $product, 'categories' => $categories, 'immagini' => $photos,
        ));
    }
}
