<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of router
 *
 * @author brian
 */
$router['default_controller'] = 'pages';
$router['default_action'] = 'index';
$router['([a-zA-Z0-9]+)$'] = 'code/get/$1';
?>
