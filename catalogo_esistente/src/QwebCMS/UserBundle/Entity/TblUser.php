<?php
// src/QwebCMS/UserBundle/Entity/User.php
namespace QwebCMS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * QwebCMS\UserBundle\Entity\TblUser
 *
 * @ORM\Table(name="tbl_user")
 * @ORM\Entity(repositoryClass="QwebCMS\UserBundle\Entity\TblUserRepository")
 */
class TblUser implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $cognome;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="checkbox_tbl_gruppi", type="string", length=200)
     */
    private $checkboxTblGruppi;

    /**
     * @ORM\Column(name="checkbox1_tbl_gruppi", type="string", length=200)
     */
    private $checkbox1TblGruppi;

    public function __construct()
    {
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->login;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // *potrebbe* non essere necessario un vero salt, a seconda del codificatore
        // vedere la sezione sul salt più avanti
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->login,
            $this->password,
            $this->nome,
            $this->cognome,
            // vedere la sezione sul salt più avanti
            // $this->salt,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->login,
            $this->password,
            $this->nome,
            $this->cognome,
            // vedere la sezione sul salt più avanti
            // $this->salt
        ) = unserialize($serialized);
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setlogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }


    /**
     * Set nome
     *
     * @param string $nome
     * @return TblUser
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set cognome
     *
     * @param string $cognome
     * @return TblUser
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;

        return $this;
    }

    /**
     * Get cognome
     *
     * @return string 
     */
    public function getCognome()
    {
        return $this->cognome;
    }



    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set checkboxTblGruppi
     *
     * @param string $checkboxTblGruppi
     * @return TblUser
     */
    public function setCheckboxTblGruppi($checkboxTblGruppi)
    {
        $this->checkboxTblGruppi = $checkboxTblGruppi;

        return $this;
    }

    /**
     * Get checkboxTblGruppi
     *
     * @return string 
     */
    public function getCheckboxTblGruppi()
    {
        return $this->checkboxTblGruppi;
    }

    /**
     * Set checkbox1TblGruppi
     *
     * @param string $checkbox1TblGruppi
     * @return TblUser
     */
    public function setCheckbox1TblGruppi($checkbox1TblGruppi)
    {
        $this->checkbox1TblGruppi = $checkbox1TblGruppi;

        return $this;
    }

    /**
     * Get checkbox1TblGruppi
     *
     * @return string 
     */
    public function getCheckbox1TblGruppi()
    {
        return $this->checkbox1TblGruppi;
    }

}
