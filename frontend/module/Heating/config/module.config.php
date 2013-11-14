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
                    'route' => '/heating[/:action][/:id]',
                    'contraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
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
        'template_path_stack' => array(
            'heating' => __DIR__ . '/../view',
        ),
    ),
);