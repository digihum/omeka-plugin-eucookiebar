<?php

/**
 * EU Cookie Bar plugin main class
 *
 * @author Steve Ranford
 */
class EUCookieBarPlugin extends Omeka_Plugin_AbstractPlugin
{



    protected $_hooks = array(
        'public_head',
        'neatline_public_static'
        //'public_content_top'
    );
 
    /**
     * Create the duration type format options form
     *
     * @param $args array
     */

public function hookPublicHead() {


    queue_js_file('lib/jquery.cookiebar');
    queue_js_file('config');

    queue_css_file('lib/jquery.cookiebar');

}
public function hookNeatlinePublicStatic($exhibit){
    queue_js_file('lib/jquery.cookiebar');
    queue_js_file('config');

    queue_css_file('lib/jquery.cookiebar');

}

}