<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Content;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Content\Model\Article;
use Content\Model\ArticleTable;

use Content\Model\Rubrique;
use Content\Model\RubriqueTable;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }


    public function getServiceConfig()
    {
        return array(
                'abstract_factories' => array(),
                'aliases' => array(),
                'factories' => array(
                    // SERVICES
                                        
                    // DB                   
                    'ArticleTable' =>  function($sm) {
                        $tableGateway = $sm->get('ArticleTableGateway');
                        $table = new ArticleTable($tableGateway);
                        return $table;
                    },
                    'ArticleTableGateway' => function ($sm) {
                        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $resultSetPrototype = new ResultSet();
                        $resultSetPrototype->setArrayObjectPrototype(new Article());
                        return new TableGateway('article', $dbAdapter, null, $resultSetPrototype);
                    },
                    'RubriqueTable' =>  function($sm) {
                        $tableGateway = $sm->get('RubriqueTableGateway');
                        $table = new RubriqueTable($tableGateway);
                        return $table;
                    },
                    'RubriqueTableGateway' => function ($sm) {
                        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $resultSetPrototype = new ResultSet();
                        $resultSetPrototype->setArrayObjectPrototype(new Rubrique());
                        return new TableGateway('rubrique', $dbAdapter, null, $resultSetPrototype);
                    },
                                            
                    // FORMS 
                    //'NotificationForm' => function ($sm) {
                    //    $form = new \Tenders\Form\NotificationForm();
                    //    $form->setInputFilter($sm->get('NotificationFilter'));
                    //    return $form;
                    //},
                                        
                    // FILTERS                    
                    //'TenderEditFilter' => function ($sm) {
                    //    return new \Tenders\Form\TenderEditFilter();    
                    //},
                    
                    
                ),
                'invokables' => array(),
                'services' => array(),
                'shared' => array(),
        );
    } 
}
