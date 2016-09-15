<?php

namespace IlCleme\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IlClemeCatalogoBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function adminAction()
    {
        return new Response('Pagina admin!');
    }
}
