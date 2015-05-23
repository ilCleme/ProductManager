<?php
// src/QwebCMS/CatalogoBundle/Security/ApiKeyUserProvider.php
namespace QwebCMS\CatalogoBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityManager;
use QwebCMS\UserBundle\Entity\User;

class ApiKeyUserProvider extends EntityManager implements UserProviderInterface
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getUsernameForApiKey($apiKey)
    {
        // Cerca il nome utente in base al token nella base dati, tramite
        // una chiamata ad API oppure con qualcosa di completamente diverso
        $username = $apiKey;

        return $username;
    }

    public function loadUserByUsername($username)
    {
        
        $query = $this->em->createQuery(
            'SELECT p
            FROM QwebCMS\UserBundle\Entity\User p
            WHERE p.username =  :username'
        )->setParameter('username', $username);
        
        $user = $query->getResult();
        
        return $user;
        //return new User(
        //    $username,
        //    null,
        //    // i ruoli dell'utente. Potrebbero essere determinati
        //    // dinamicamente in qualche modo
        //    array('ROLE_ADMIN')
        //);
    }

    public function refreshUser(UserInterface $user)
    {
        // $user è l'utente che era stato impostato nel token in authenticateToken()
        // dopo che è stato deserializzato dalla sessione

        // si potrebbe usare $user per cercare su base dati un utente aggiornato
        // $id = $user->getId();
        // usare $id per fare la query

        // se *non* si legge da una base dati e si sta solo creando un
        // oggetto utente (come in questo esempio), basta restituirlo
        return $user;
    }

    public function supportsClass($class)
    {
        return 'Symfony\Component\Security\Core\User\User' === $class;
    }
}