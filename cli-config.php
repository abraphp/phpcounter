<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Annotations\AnnotationRegistry;

$apiClassLoader = new \Doctrine\Common\ClassLoader('Application', __DIR__ . '/module/Application/src');
$apiClassLoader->register();
$coreClassLoader = new \Doctrine\Common\ClassLoader('Core', __DIR__ . '/module/Core/src');
$coreClassLoader->register();
$adminClassLoader = new \Doctrine\Common\ClassLoader('Admin', __DIR__ . '/module/Admin/src');
$adminClassLoader->register();
$entityClassLoader = new \Doctrine\Common\ClassLoader('Entities', __DIR__ . '/module/Application/src/Application/Entity');
$entityClassLoader->register();
$proxyClassLoader = new \Doctrine\Common\ClassLoader('EntityProxy', __DIR__ . '/module/Application/src/Application/Entity/Proxies');
$proxyClassLoader->register();


$config = include __DIR__ . '/config/autoload/global.php';
$cache = new $config['doctrine']['driver']['cache'];

$doctrineConfig = new \Doctrine\ORM\Configuration();
$cache = new $config['doctrine']['driver']['cache'];
$doctrineConfig->setQueryCacheImpl($cache);
$doctrineConfig->setProxyDir('/tmp');
$doctrineConfig->setProxyNamespace('EntityProxy');
$doctrineConfig->setAutoGenerateProxyClasses(true);

\Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('events');

\Doctrine\Common\Annotations\AnnotationRegistry::registerFile(
    __DIR__ . '/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php'
);

$driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
    new \Doctrine\Common\Annotations\AnnotationReader(),
    array( 
        __DIR__ . '/module/Application/src/Application/Entity',
    )
);
$doctrineConfig->setMetadataDriverImpl($driver);
$doctrineConfig->setMetadataCacheImpl($cache);

$em = \Doctrine\ORM\EntityManager::create(
    $config['doctrine']['connection'],
    $doctrineConfig
);
/** @var $em \Doctrine\ORM\EntityManager */
$platform = $em->getConnection()->getDatabasePlatform();
$platform->registerDoctrineTypeMapping('enum', 'string');

$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));