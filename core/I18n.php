<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asserts
 *
 * @author brian
 */
class I18n {

    private $default_lang;
    private $_lang = array();

    public function getLang() {
        return $this->default_lang;
    }

    public function __construct() {
        $path = Config::get('i18n');
        $this->default_lang = $path['default_lang'];
        if ($handle = opendir($path['default_folder'])) {
            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $_lang = array();
                    include LANG_PATH . '/' . $entry;
                    $name = substr($entry, 0, stripos($entry, '.'));
                    $this->_lang[$name] = $_lang;
                }
            }
            closedir();
        } else {
            throw new Exceptioni('You i18n config is NULL');
        }
    }

    public static function create() {
        static $inst = NULL;
        if ($inst == NULL)
            $inst = new I18n();
        return $inst;
    }

    public function get($text, $lang = NULL) {
        if ($lang == NULL) {
            $lang = $this->default_lang;
        }
        $t = strtolower($text);
        if (array_key_exists($t, $this->_lang[$lang])) { 
            return $this->_lang[$lang][$t];
        } else {
            return $text;
        }
    }

}

?>
