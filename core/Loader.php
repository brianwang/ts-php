<?php

class Loader {

    private static $loaded = array();

    public static function load($object) {
        if (empty(self::$loaded[$object])) {
            self::$loaded[$object] = new $object();
        }
        return self::$loaded[$object];
    }

}

?>
