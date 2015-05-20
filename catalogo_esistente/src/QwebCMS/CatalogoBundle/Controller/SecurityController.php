<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
            'QwebCMSCatalogoBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }
    
    public function loginCheckAction()
    {
    }
}
