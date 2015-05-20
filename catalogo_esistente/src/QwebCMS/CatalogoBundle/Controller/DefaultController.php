<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('QwebCMSCatalogoBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function adminAction()
    {
        return new Response('Pagina admin!');
    }
}
