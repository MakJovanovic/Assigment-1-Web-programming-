<?php
require_once __DIR__ . "/../dao/BaseDao.php";
class BaseService{
    protected $dao;

    protected function __construct($entity){
        $this->dao = $entity;
    }


    public function add($entity){
        return $this->dao->add($entity);
    }

    public function update($entity, $id, $id_column = "id"){
        return $this->dao->update($entity, $id, $id_column);
    }

    public function delete($id){
        return $this->dao->delete($id);
    }

    public function get_all(){
        return $this->dao->get_all();
    }
}
?>