<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LanguageController extends Controller
{
    public function indexAction(){

        $id_language = $this->get('language.manager')->getSessionLanguage();

        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM QwebCMSCatalogoBundle:TblLingua a";
        $lingue = $em->createQuery($dql);

        return $this->render(
            'QwebCMSCatalogoBundle:Language:select_language.html.twig',
            array('id_lingua' => $id_language, 'lingue' => $lingue)
        );
    }

    public function setLanguageAction()
    {

        $attributes = $this->getRequest();
        $id = $attributes->get('lng');
        $route = $attributes->get('_route');
        $this->get('language.manager')->setSessionLanguage($id);

        /*if ($this->getRequest()->isMethod('GET')){
            if( null !== $id ){
                $this->get('session')->set('lingua', $id);
            } else {
                $this->get('session')->set('lingua', 4);
            }
        } else if ($this->getRequest()->isMethod('POST')){
            $attributes = $this->getRequest();
            $id = $attributes->get('lng');

            if( null !== $id ){
                $this->get('session')->set('lingua', $id);
            } else {
                $this->get('session')->set('lingua', 4);
            }
            return $this->redirect($this->generateUrl('welcome'));

        }*/

        return $this->redirectToRoute('welcome');
    }

}