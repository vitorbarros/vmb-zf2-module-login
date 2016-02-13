# vmb-zf2-module-login

## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

`php composer.phar require vitorbarros/vmb-zf2-module-login`

Then add `DoctrineModule`, `DoctrineORMModule`, `DoctrineDataFixtureModule` and `Login` to your `config/application.config.php` and create directory
`data/DoctrineORMModule/Proxy` and make sure your application has write access to it.

Installation without composer is not officially supported and requires you to manually install all dependencies
that are listed in `composer.json`

## Configuration options

To create initial data to test the module configure the database connection as following

```php
<?php
return array(
    'doctrine' => array(
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'user',
                    'password' => 'password',
                    'dbname'   => 'dbnae',
                )
            )
        )
    ),
);
```
## Command Line
Access the Doctrine command line as following

##Import
```sh
./vendor/bin/doctrine-module data-fixture:import 
```

##Test
Access in your browser `www.yourdomain/login`

try authenticate with fallowing credentians

`username: admin`
`password: admin`

