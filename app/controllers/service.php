<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of service
 *
 * @author brian
 */
class service extends Controller {

    //put your code here
    public function clearcache() {
        $langs = ideone::getlanguages();
        if (!empty($langs))
            $langs = $langs['languages'];
        Memcache::create()->save('langs', $langs, 6000);
    }

}

?>
