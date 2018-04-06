<?php
namespace LpnPlugin\Model\PimPamPoum;
 
use Pimcore\Model\Dao\AbstractDao;
 
class Dao extends AbstractDao {

     protected $tableName = 'lpn_pimpampoum';


     /**
     * get PimPamPoum by id
     *
     * @param null $id
     * @throws \Exception
     */
    public function getById($id = null) {
 
        if ($id != null)
            $this->model->setId($id);
 
        $data = $this->db->fetchRow('SELECT * FROM '.$this->tableName.' WHERE id = ?', $this->model->getId());
 
        if(!$data["id"])
            throw new \Exception("Object with the ID " . $this->model->getId() . " doesn't exists");
 
        $this->assignVariablesToModel($data);
    }

    /**
     * save vote
     *
     * @throws \Zend_Db_Adapter_Exception
     */
    public function save() {
        $vars = get_object_vars($this->model);
 
        $buffer = [];
 
        $validColumns = $this->getValidTableColumns($this->tableName);
 
        if(count($vars))
            foreach ($vars as $k => $v) {
 
                if(!in_array($k, $validColumns))
                    continue;
 
                $getter = "get" . ucfirst($k);
 
                if(!is_callable([$this->model, $getter]))
                    continue;
 
                $value = $this->model->$getter();
 
                if(is_bool($value))
                    $value = (int)$value;
 
                $buffer[$k] = $value;
            }
 
        if($this->model->getId() !== null) {
            $this->db->update($this->tableName, $buffer, $this->db->quoteInto("id = ?", $this->model->getId()));
            return;
        }
 
        $this->db->insert($this->tableName, $buffer);
        $this->model->setId($this->db->lastInsertId());
    }
 
    /**
     * delete vote
     */
    public function delete() {
        $this->db->delete($this->tableName, $this->db->quoteInto("id = ?", $this->model->getId()));
    }

    
 


    /**
     * @param array $data
     */
    protected function assignVariablesToModel($data)
    {
        parent::assignVariablesToModel($data);
        foreach ($data as $key => $value) {
            if ($key == 'date') {
                $this->model->setDate(new \Zend_Date($value));
            }
           
        }
    }
}

?>