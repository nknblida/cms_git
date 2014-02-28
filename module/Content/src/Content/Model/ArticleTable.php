<?php
namespace Content\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class ArticleTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function saveArticle(Article $article)
    {
        $data = array(
            'title'  => $article->title,
            'content'  => $article->content,
            'rubrique_id'  => $article->rubrique_id
        );

        $id = (int) $article->article_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getArticle($id)) {
                $this->tableGateway->update($data, array('article_id' => $id));
            } else {
                throw new \Exception('Article ID does not exist');
            }
        }
    }

    public function fetchAll($where=array())
    {
        $resultSet = $this->tableGateway->select($where);
        return $resultSet;
    }
    
    public function getArticle($id)
    {
    	$id  = (int) $id;
    	$rowset = $this->tableGateway->select(array('article_id' => $id));
    	$row = $rowset->current();
    	if (!$row) {
    		new Article();
    	}    	
    	return $row;
    }

    public function deleteArticle($id)
    {
        $this->tableGateway->delete(array('article_id' => $id));
    }
    
}
