<?php

namespace IlCleme\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LanguageController extends Controller
{
    public function indexAction(){

        $id_language = $this->get('language.manager')->getSessionLanguage();

        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM IlClemeCatalogoBundle:TblLingua a";
        $lingue = $em->createQuery($dql);

        return $this->render(
            'IlClemeCatalogoBundle:Language:select_language.html.twig',
            array('id_lingua' => $id_language, 'lingue' => $lingue)
        );
    }

    public function setLanguageAction(Request $attributes)
    {
        $id = $attributes->get('lng');
        $route = $attributes->get('_route');
        $this->get('language.manager')->setSessionLanguage($id);

        return $this->redirectToRoute('welcome');
    }

}
