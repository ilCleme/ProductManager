<?php

namespace IlCleme\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IlCleme\CatalogoBundle\Entity\Feature as Feature;
use Symfony\Component\HttpFoundation\Request;
use IlCleme\CatalogoBundle\Form\TblCatalogueFeatureType;

class FeatureController extends Controller
{
    public function createAction(Request $request)
    {
        $lingua = $this->get('language.manager')->getSessionLanguage();
        $categories = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Category')
            ->findBy(array('idTblLingua' => $lingua));

        $feature = new Feature();
        $feature->setIdTblLingua($this->get('language.manager')->getSessionLanguage());
        $form = $this->createForm(TblCatalogueFeatureType::class, $feature, array(
            'language' => $lingua
        ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feature);
            $em->flush();

            return $this->redirect($this->generateUrl('features'));
        }

        return $this->render('IlClemeCatalogoBundle:Feature:new.html.twig', array(
            'form' => $form->createView(),
            'categories' => $categories
        ));
    }


    public function updateAction($id, Request $request)
    {
        $lingua = $this->get('language.manager')->getSessionLanguage();
        $categories = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Category')
            ->findBy(array('idTblLingua' => $lingua));

        $feature = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Feature')
            ->findOneBy(array('id' => $id, 'idTblLingua' => $lingua));

        if (!$feature) {
            throw $this->createNotFoundException(
                'Nessuna categoria di feature trovata per l\'id '.$id
            );
        }

        $form = $this->createForm(TblCatalogueFeatureType::class, $feature, array(
            'language' => $lingua
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feature);
            $em->flush();
            return $this->redirect($this->generateUrl('features'));
        }

        return $this->render('IlClemeCatalogoBundle:Feature:update.html.twig', array(
            'form' => $form->createView(),
            'feature' => $feature,
            'categories' => $categories
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $feature = $this->getDoctrine()
            ->getRepository('IlClemeCatalogoBundle:Feature')
            ->findOneBy(array('id' => $id, 'idTblLingua' => $this->get('language.manager')->getSessionLanguage()));

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
