<?php

namespace IlCleme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('QwebCMSUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
