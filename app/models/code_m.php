<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of code
 *
 * @author brian
 */
class code_m extends ExtModel {

    protected $modelname = 'code';

    function getlatest() {
        $this->mongo->limit(15);
        return $this->mongo->
                        order_by(array('createtime' => 'DESC'))
                        ->get($this->modelname);
    }

    function getgreat() {
        $this->mongo->limit(15);
        return $this->mongo->order_by(array('avgvalue' => 'DESC'))
                        ->get($this->modelname);
    }

    function gettags() {
        return $this->mongo->group($this->modelname, array('language' => 1), array('count' => 0), "function(obj,cur){cur.count++;}");
    }

    function getbytag($tag = "") {
        return $this->mongo->order_by(array('createtime' => 'DESC'))
                ->get_where($this->modelname,array('language' => $tag));
    }

}

?>
