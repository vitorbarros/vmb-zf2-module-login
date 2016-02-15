<?php
namespace VMBLogin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
use VMBLogin\Form\Login as LoginForm;

class LoginController extends AbstractActionController
{

    public function loginAction()
    {
        $messages = null;
        $isAuth = false;

        $form = new LoginForm();
        $auth = new AuthenticationService();
        $sessionStorage = new SessionStorage("Login");

        $request = $this->getRequest();

        if ($request->isPost()) {

            $data = $request->getPost()->toArray();
            $form->setData($data);

            if ($form->isValid()) {

                $auth->setStorage($sessionStorage);

                $authAdapter = $this->getServiceLocator()->get('VMBLogin\Auth\Adapter');
                $authAdapter->setUsername($data['username'])->setPassword($data['password']);

                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {

                    $sessionStorage->write($auth->getIdentity()['user'], null);
                    $messages = "you are now authenticated";

                    $isAuth = true;
                } else {
                    $messages = "username or password is incorrect";
                }
            }
	}

        return new ViewModel(array(
            'form' => $form,
            'messages' => $messages,
            'auth' => $isAuth,
        ));
    }
}
