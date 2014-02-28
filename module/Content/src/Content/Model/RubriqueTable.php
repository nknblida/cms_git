<?php
namespace Content\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class RubriqueTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function saveRubrique(Rubrique $rubrique)
    {
        $data = array(
            'title'  => $rubrique->title,
        );

        $id = (int) $rubrique->rubrique_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getRubrique($id)) {
                $this->tableGateway->update($data, array('rubrique_id' => $id));
            } else {
                throw new \Exception('Rubrique ID does not exist');
            }
        }
    }

    public function fetchAll($where=array())
    {
        $resultSet = $this->tableGateway->select($where);
        return $resultSet;
    }
    
    public function getRubrique($id)
    {
    	$id  = (int) $id;
    	$rowset = $this->tableGateway->select(array('rubrique_id' => $id));
    	$row = $rowset->current();
    	if (!$row) {
    		new Rubrique();
    	}    	
    	return $row;
    }

    public function deleteRubrique($id)
    {
        $this->tableGateway->delete(array('rubrique_id' => $id));
    }
    
}
