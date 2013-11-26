<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Heating\Controller\Heating' => 'Heating\Controller\HeatingController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'heating' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/heating[/:action][/:start]',
                    'contraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'start' => '[0-9-+]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Heating\Controller\Heating',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'template_path_stack' => array(
            'heating' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            'my_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Heating/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Heating\Entity' => 'my_annotation_driver'                    
                ),
            ),
        ),
    ),
);