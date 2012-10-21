<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExtModel
 *
 * @author brian
 */
class ExtModel extends Model {
    //put your code here
    
    protected $modelname;

    function get($id) {
        $result = $this->mongo->get_where($this->modelname, array('_id' => $id));
        if (!empty($result)) {
            return $result[0];
        }
        return $result;
    }

    function get_by($arr, $start = 0, $size = PAGESIZE, $page = false) {
        if ($page) {
            $this->mongo->offset($start);
            $this->mongo->limit($size);
        }
        $result = $this->mongo->get_where($this->modelname, $arr);
        return $result;
    }

    function add($data) {
        //$this->beforeupdate($data);
        $this->mongo->insert($this->modelname, $data);
        return $data['_id'];
    }

    function update($data) {
        //$this->beforeupdate($data);
        $this->mongo->update($this->modelname, $data);
    }

    function count(){
        return $this->mongo->count($this->modelname);
    }
    function delete($id) {
        $this->mongo->where(array('_id' => $id))->delete($this->modelname);
    }

    function beforeupdate(&$data) {
        if (empty($data['create_date']) || !isset($data['create_date'])) {
            $data['create_date'] = now();
            if (array_key_exists('uid', $_SESSION)) {
                $data['creator'] = $_SESSION['uid'];
            }
        }
        $data['update_date'] = now();
        if (array_key_exists('uid', $_SESSION)) {
            $data['lastupdator'] = $_SESSION['uid'];
        }
        if (!array_key_exists('_id', $data) || empty($data['_id']) || !isset($data['_id'])) {
            $data['_id'] = Uuid::v4();
        }
    }

    function save($data) {
        //$this->beforeupdate($data);
        $this->mongo->save($this->modelname, $data);
    }
    function search($text='',$other=array()){
        return $this->mongo->or_where($other)->search($this->modelname,$text,array('name','description'));
    }
    function get_all() {
        return $this->mongo->get($this->modelname);
    }
}

?>
