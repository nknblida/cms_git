<?php
namespace Content\Model;

class Article
{
    public $article_id; 
    public $rubrique_id;   
    public $title;
    public $content;
       
	function exchangeArray($data)
	{
		$this->article_id		= (isset($data['article_id'])) ? $data['article_id'] : null;
		$this->rubrique_id		= (isset($data['rubrique_id'])) ? $data['rubrique_id'] : null;
		$this->title	    	= (isset($data['title'])) ? $data['title'] : null;
		$this->content	    	= (isset($data['content'])) ? $data['content'] : null;		
	}

	public function getArrayCopy()
	{
		return get_object_vars($this);
	}	
}
