<?php
namespace Heating\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class HeatingController extends AbstractActionController {
    public function indexAction() {
        return new ViewModel(array(
            
        ));
    }
}