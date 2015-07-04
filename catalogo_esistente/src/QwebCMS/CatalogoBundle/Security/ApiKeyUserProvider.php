<?php
// src/QwebCMS/CatalogoBundle/Security/ApiKeyUserProvider.php
namespace QwebCMS\CatalogoBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityManager;
use QwebCMS\UserBundle\Entity\TblUser as User;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

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
        
        $user = new User;
        
        $query = $this->em->createQuery(
            'SELECT p
            FROM QwebCMS\UserBundle\Entity\TblUser p
            WHERE p.login =  :username'
        )->setParameter('username', $username);
        
        $user = $query->getResult();
        
        if (count($user) > 0){
            return $user[0];    
        } else {
            throw new AuthenticationException('Utente inesistente');
        }
        
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
        return 'QwebCMS\UserBundle\Entity\TblUser' === $class;
    }
}