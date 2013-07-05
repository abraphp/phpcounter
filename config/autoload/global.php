<?php
return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn'    => 'mysql:dbname=phpcounter;host=localhost'
    ),
    'doctrine' => array(
        'connection' => array(
            'driver'   => 'pdo_mysql',
            'host'     => 'localhost',
            'port'     => '3306',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'phpcounter'
        ),
        'driver' => array(
            'cache' => 'Doctrine\Common\Cache\ArrayCache',
            'paths' => array(__DIR__ . '/../module/Admin/src/Admin/Model', __DIR__ . '/../module/Application/src/Application/Model')
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
