<?php

namespace IlCleme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // recupera l'errore, se ce n'è uno
        $error = $authenticationUtils->getLastAuthenticationError();
    
        // ultimo nome utente inserito
        $lastUsername = $authenticationUtils->getLastUsername();
    
        return $this->render(
            'IlClemeUserBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }
}
