<?php

require_once SYS_PATH . '/db/DB.php';
class Model {
    protected $dbs = array();
    public function __construct(){
        #$this->dbs['db']= &DB();
        $this->dbs['mongo']= Mongo_db::create();
    }
    
    public function __get($name) {
        return $this->dbs[$name];
    }
}

?>