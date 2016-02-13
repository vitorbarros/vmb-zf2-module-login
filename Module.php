<?php
namespace Login;

use Login\Auth\Adapter;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Login\Auth\Adapter' => function($service) {
                    return new Adapter($service->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }
}
