<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of common
 *
 * @author brian
 */
function bchexdec($hex) {
    if (strlen($hex) == 1) {
        return hexdec($hex);
    } else {
        $remain = substr($hex, 0, -1);
        $last = substr($hex, -1);
        return bcadd(bcmul(16, bchexdec($remain)), hexdec($last));
    }
}

//put your code here
class PseudoCrypt {
    /* Next prime greater than 62 ^ n / 1.618033988749894848 */

    private static $golden_primes = array(
        '1',
        '41',
        '2377',
        '147299',
        '9132313',
        '566201239',
        '35104476161',
        '2176477521929',
        '134941606358731',
        '8366379594239857',
        '518715534842869223'
    );

    /* Ascii : 0 9, A Z, a z */
    /* $chars = array_merge(range(48,57), range(65,90), range(97,122)) */
    private static $chars = array(
        0 => 48, 1 => 49, 2 => 50, 3 => 51, 4 => 52, 5 => 53, 6 => 54, 7 => 55, 8 => 56, 9 => 57, 10 => 65,
        11 => 66, 12 => 67, 13 => 68, 14 => 69, 15 => 70, 16 => 71, 17 => 72, 18 => 73, 19 => 74, 20 => 75,
        21 => 76, 22 => 77, 23 => 78, 24 => 79, 25 => 80, 26 => 81, 27 => 82, 28 => 83, 29 => 84, 30 => 85,
        31 => 86, 32 => 87, 33 => 88, 34 => 89, 35 => 90, 36 => 97, 37 => 98, 38 => 99, 39 => 100, 40 => 101,
        41 => 102, 42 => 103, 43 => 104, 44 => 105, 45 => 106, 46 => 107, 47 => 108, 48 => 109, 49 => 110,
        50 => 111, 51 => 112, 52 => 113, 53 => 114, 54 => 115, 55 => 116, 56 => 117, 57 => 118, 58 => 119,
        59 => 120, 60 => 121, 61 => 122
    );

    public static function base62($int) {
        $key = '';
        while (bccomp($int, 0) > 0) {
            $mod = bcmod($int, 62);
            $key .= chr(self::$chars[$mod]);
            $int = bcdiv($int, 62);
        }
        return strrev($key);
    }

    public static function udihash($num, $len = 5) {
        $ceil = bcpow(62, $len);
        $prime = self::$golden_primes[$len];
        $dec = bcmod(bcmul($num, $prime), $ceil);
        $hash = self::base62($dec);
        return str_pad($hash, $len, '0', STR_PAD_LEFT);
    }

    public static function createshortid() {
        $uid = bchexdec(uniqid());
        $hash = PseudoCrypt::udihash($uid);
        return $hash;
    }

}

?>
