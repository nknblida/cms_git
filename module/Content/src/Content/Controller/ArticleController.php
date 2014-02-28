<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Content\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function editAction()
    {
        return array();
    }

    public function deleteAction()
    {
        return array();
    }

    public function listAction()
    {
        $id           = (int) $this->params()->fromRoute('id_rubrique');

        $articleTable = $this->getServiceLocator()->get('ArticleTable');

        $articles = $articleTable->fetchAll(array('rubrique_id' => $id));

        $viewModel  = new ViewModel(array('articles' => $articles)); 
        return $viewModel;
   }

    public function viewAction()
    {
		$id_article           = (int) $this->params()->fromRoute('id_article');

        $articleTable = $this->getServiceLocator()->get('ArticleTable');

        $article = $articleTable->getArticle($id_article);

        $viewModel  = new ViewModel(array('article' => $article)); 
        return $viewModel;
    }



}
