<?php


class Sitemap_Sitemap {

    private $table;
    
    public function init(){
        
        $pimDb = Pimcore_Resource_Mysql::get();
        $rev = Pimcore_Version::$revision;
        if($rev>1350){
            Zend_Db_Table::setDefaultAdapter($pimDb->getResource());
        }else{
            Zend_Db_Table::setDefaultAdapter($pimDb);
        }

        $this->table = new Sitemap_DbTable_Sitemap();
        
    }

    public function create($name){
        $this->init();
        $id = $this->table->insert(array("name"=>$name,"date"=>time()));
        
        return $id;
    }   

    public function delete($id){
        $this->init();
        $ret = $this->table->delete("id=".$id);
        if ($ret>0){
            return true;
        }else{
            return false;
        }
    }

    public function read(){
        $this->init();
        $rows = $this->table->fetchAll();
       
        return $rows;
    }

    public function rename($id,$name){
        $this->init();
        $data = array("name"=>$name);
        $this->table->update($data,"id=" . $id);
        
    }

    public function getName($id){
        $this->init();
        $row = $this->table->fetchRow("id=" . $id);
        return $row->name;
    }

    public function getIdByName($name){
        $this->init();
        $row = $this->table->fetchRow("name = '" . $name . "'");
        return $row->id;
    }


}