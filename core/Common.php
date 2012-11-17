<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function show_error($error){
    Response::show_error($error);
}
function show_404(){
  Response::show404();
}
?>
