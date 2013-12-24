<?php
namespace Heating;

use Zend\I18n\Translator\TranslatorAwareInterface;

class Module {
    public function onBootstrap($e) {
        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setAlias('_', 'translate');
        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setAlias('plural', 'translateplural');
    }
    
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }
}