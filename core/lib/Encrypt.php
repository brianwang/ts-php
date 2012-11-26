<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Encrypt
 *
 * @author brian
 */
class Encrypt {

    //put your code here
    public static function aes256_encode($data) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $key = Config::get('aeskey');
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv);
        return base64_encode($crypttext);
    }

    public static function aes256_decode($data) {
        $data = base64_decode($data);
        $key = Config::get('aeskey');
        $decode = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB);
        return $decode;
    }

}

?>
