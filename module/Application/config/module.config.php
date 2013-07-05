<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/[page/:page]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                        'module'     => 'application',
                    ),
                ),
            ),
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        'controller'    => 'Index',
                        'action'        => 'index',
                        '__NAMESPACE__' => 'Application\Controller',
                        'module'     => 'application'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                        'child_routes' => array( //permite mandar dados pela url 
                            'wildcard' => array(
                                'type' => 'Wildcard'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
            'Session' => function($sm) {
                return new \Zend\Session\Container('PHPCounter');
            },
            'Cache' => function($sm) {
                $config = $sm->get('Configuration');
                $cache = \Zend\Cache\StorageFactory::factory(
                    array(
                        'adapter' => $config['cache']['adapter'],
                        'plugins' => array(
                            'exception_handler' => array('throw_exceptions' => false),
                            'Serializer'
                        ),
                    )
                );

                return $cache;
            },
            'Log' => function($sm) {
                    $writer = new \Zend\Log\Writer\Stream('/tmp/phpcounter.log');
                    $logger = new \Zend\Log\Logger();
                    $logger->addWriter($writer);
                    return $logger;
            },
            'EntityManager' => function($sm) {
                $env = getenv('ENV');
                $config = $sm->get('Configuration');

                if ($env == 'testing') {
                    $config = include getenv('PROJECT_ROOT') . '/config/test.config.php';
                }
                $doctrineConfig = new \Doctrine\ORM\Configuration();
                $cache = new $config['doctrine']['driver']['cache'];
                $doctrineConfig->setQueryCacheImpl($cache);
                $doctrineConfig->setProxyDir('/tmp');
                $doctrineConfig->setProxyNamespace('EntityProxy');
                $doctrineConfig->setAutoGenerateProxyClasses(true);

                \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('events');

                \Doctrine\Common\Annotations\AnnotationRegistry::registerFile(
                    getenv('PROJECT_ROOT'). '/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php'
                );
                \Doctrine\Common\Annotations\AnnotationRegistry::registerFile(
                    getenv('PROJECT_ROOT'). '/vendor/jms/serializer/src/JMS/Serializer/Annotation/Groups.php'
                );
                \Doctrine\Common\Annotations\AnnotationRegistry::registerFile(
                    getenv('PROJECT_ROOT'). '/vendor/jms/serializer/src/JMS/Serializer/Annotation/Type.php'
                );
                \Doctrine\Common\Annotations\AnnotationRegistry::registerFile(
                    getenv('PROJECT_ROOT'). '/vendor/jms/serializer/src/JMS/Serializer/Annotation/Accessor.php'
                );

                $driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
                    new \Doctrine\Common\Annotations\AnnotationReader(),
                    $config['doctrine']['driver']['paths']
                );
                $doctrineConfig->setMetadataDriverImpl($driver);
                $doctrineConfig->setMetadataCacheImpl($cache);

                $em = \Doctrine\ORM\EntityManager::create(
                    $config['doctrine']['connection'],
                    $doctrineConfig
                );
                //subscriber
                $evm = $em->getEventManager();
                $entitySubscriber = $sm->get('Application\Model\Subscriber\EntitySubscriber');
                $evm->addEventSubscriber($entitySubscriber);
                
                return $em;
            },
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'phparray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.php',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
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
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
