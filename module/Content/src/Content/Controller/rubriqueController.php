<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Content\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RubriqueController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function editAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/skeleton/foo
        return array();
    }
	
	public function deleteAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/skeleton/foo
        return array();
    }
	
	public function listAction()
    {
        //$id           = (int) $this->params()->fromRoute('id_rubrique');

        $rubriqueTable = $this->getServiceLocator()->get('RubriqueTable');

        $rubriques = $rubriqueTable->fetchAll();

        $viewModel  = new ViewModel(array('rubriques' => $rubriques)); 
        return $viewModel;
    }
	
	public function viewAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/skeleton/foo
        return array();
    }
}
