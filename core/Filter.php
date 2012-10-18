<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Filter
 *
 * @author brian
 */
class Filter implements IFilter {

    private $filters = array();
    protected $router;
    public function __construct(&$route) {
        $fs = Config::get('filters');
        $filterarr = explode(',', $fs);
        foreach ($filterarr as $f) {
            array_push($this->filters, new $f());
        }
        $this->router = $route;
    }

    public function input() {
        foreach ($this->filters as $filter) {
            $filter->input();
        }
    }

    public function output() {
        foreach ($this->filters as $filter) {
            $filter->output();
        }
    }

}

?>
