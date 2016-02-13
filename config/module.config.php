<?php
namespace Login;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller' => 'Login\Controller\Login',
                        'action'     => 'login',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Login\Controller\Login' => 'Login\Controller\LoginController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'login/index/index'       => __DIR__ . '/../view/login/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine'  =>  array(
        'driver'    =>  array(
            __NAMESPACE__ . '_driver'  =>  array(
                'class' =>  'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' =>  'array',
                'paths' =>  array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default'   =>  array(
                'drivers'   =>  array(
                    __NAMESPACE__ . '\Entity'   =>  __NAMESPACE__ . '_driver',
                ),
            ),
        ),
    ),
    'data-fixture' => array(
        'Login_fixture' => __DIR__ . '/../src/Login/Fixture',
    ),
);
