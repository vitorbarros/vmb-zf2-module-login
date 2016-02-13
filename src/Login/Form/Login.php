<?php
namespace Login\Form;

use Zend\Form\Form;

class Login extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('LoginForm');
        $this->setAttribute('method', 'post');

        // username field
        $this->add(array(
            'name' => 'username',
            'options' => array(
                'label' => 'Username'
            ),
            'attributes' => array(
                'id' => 'username',
                'class' => 'form-control',
                'placeholder' => 'Enter with your username'
            )
        ));

        // password field
        $this->add(array(
            'name' => 'password',
            'options' => array(
                'label' => 'Password'
            ),
            'attributes' => array(
                'id' => 'password',
                'class' => 'form-control',
                'type' => 'password',
                'placeholder' => 'Enter with your password'
            )
        ));

        // csrf field
        $this->add(array(
            'type' => 'Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));

        // buttom
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Login',
                'class' => 'btn btn-success'
            )
        ));
    }
}