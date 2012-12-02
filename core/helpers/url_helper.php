<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('base_url')) {

    function base_url() {
        return "http://" . $_SERVER['HTTP_HOST'] . rtrim($_SERVER['SCRIPT_NAME'], '/');
    }

}

if (!function_exists('site_url')) {

    function site_url($n) {
        return "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . $n;
    }

}
if (!function_exists('assert_url')) {

    function assert_url($n) {
        $pos = strrpos($_SERVER['SCRIPT_NAME'], '/');
        $baseurl = substr($_SERVER['SCRIPT_NAME'], 0, $pos);
        return "http://" . $_SERVER['HTTP_HOST'] . $baseurl . '/public' . $n;
    }

}

/**
 * Header Redirect
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
if (!function_exists('redirect')) {

    function redirect($uri = '', $method = 'location', $http_response_code = 302) {
        if (!preg_match('#^https?://#i', $uri)) {
            $uri = site_url($uri);
        }

        switch ($method) {
            case 'refresh' : header("Refresh:0;url=" . $uri);
                break;
            default : header("Location: " . $uri, TRUE, $http_response_code);
                break;
        }
        exit;
    }

}
?>
