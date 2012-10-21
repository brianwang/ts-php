<?php
/**
 * Description of Cache
 *
 * @author brian
 */
interface Cache {
    public function get($name);
    public function save($name,$value,$ttl);

}

?>
