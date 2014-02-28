<?php
namespace Content\Model;

class Rubrique
{
    public $rubrique_id;   
    public $title;
       
	function exchangeArray($data)
	{
		$this->rubrique_id		= (isset($data['rubrique_id'])) ? $data['rubrique_id'] : null;
		$this->title	    	= (isset($data['title'])) ? $data['title'] : null;
	}

	public function getArrayCopy()
	{
		return get_object_vars($this);
	}	
}
