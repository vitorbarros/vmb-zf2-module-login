<?php
namespace VMBLogin\Auth;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result;

use VMBLogin\Entity\User;

use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var User
     */
    protected $user;

    protected $username;
    protected $password;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\Authentication\Adapter\AdapterInterface::authenticate()
     */
    public function authenticate()
    {
        $repository = $this->em->getRepository('VMBLogin\Entity\User');
        $this->user = $repository->findOneByUserUsername($this->getUsername());

        if($this->user) {

            if($this->user->getUserPassword() == $this->user->encryptPassword($this->getPassword())) {
                return new Result(Result::SUCCESS, array('user' => $this->user), array('ok'));
            }
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array());
        }
        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array());

    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

}