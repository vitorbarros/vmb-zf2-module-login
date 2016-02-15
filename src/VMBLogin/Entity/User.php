<?php
namespace VMBLogin\Entity;

use Zend\Stdlib\Hydrator,
    Zend\Math\Rand,
    Zend\Crypt\Key\Derivation\Pbkdf2;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="VMBLogin\Entity\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="user_id")
     * @ORM\GeneratedValue
     */
    private $userId;

    /**
     * @ORM\Column(type="text", name="user_username")
     */
    private $userUsername;

    /**
     * @ORM\Column(type="text", name="user_password")
     */
    private $userPassword;

    /**
     * @ORM\Column(type="text", name="user_salt")
     */
    private $userSalt;

    public function __construct(array $data = array())
    {
        (new Hydrator\ClassMethods())->hydrate($data, $this);
        $this->userSalt = base64_encode(Rand::getBytes(8, true));
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUserUsername()
    {
        return $this->userUsername;
    }

    public function getUserPassword()
    {
        return $this->userPassword;
    }

    public function getUserSalt()
    {
        return $this->userSalt;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function setUserUsername($userUsername)
    {
        $this->userUsername = $userUsername;
        return $this;
    }

    public function setUserPassword($userPassword)
    {
        $this->userPassword = $this->encryptPassword($userPassword);
        return $this;
    }

    public function encryptPassword($password)
    {
        return base64_encode(Pbkdf2::calc('sha256', $password, $this->userSalt, 10000, 120));
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }
}