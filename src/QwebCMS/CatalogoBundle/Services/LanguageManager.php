<?php

namespace QwebCMS\CatalogoBundle\Services;

use Symfony\Component\HttpFoundation\Session\Session;

class LanguageManager
{
    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function setSessionLanguage($id = null)
    {
        $this->session->set('lingua', $id);

    }

    public function getSessionLanguage()
    {
        if ($this->session->has('lingua')){
            return $this->session->get('lingua');
        } else {
            return 4;
        }

    }
}
