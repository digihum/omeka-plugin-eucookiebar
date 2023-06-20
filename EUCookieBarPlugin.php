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
        'public_footer',
        'neatline_public_static',
        'install', 
        'config', 
        'config_form', 
        'uninstall'
    );

    /**
     * @var array  Options that are used in the eucookiebar plugin.
     */
    protected $_options = array(
        'cookie_message' => 'We use cookies to track usage of this academic project.',
    );
 
    /**
     * Create the duration type format options form
     *
     * @param $args array
     */

    public function hookPublicHead() {
        queue_js_file('vendor/cookieconsent-v2.9.1');    
        queue_css_file('vendor/cookieconsent-v2.9.1');
        echo get_view()->partial('cookie_bar.php', array( "message" => get_option("cookie_message")));
    }

    public function hookPublicFooter() {
        
    }

    public function hookNeatlinePublicStatic($exhibit){
        echo get_view()->partial('cookie_bar.php', array( "message" => get_option("cookie_message")));
        queue_js_file('vendor/cookieconsent-v2.9.1');
        queue_css_file('vendor/cookieconsent-v2.9.1');

    }

    /**
     * Installation hook.
     */
    public function hookInstall()
    {
        $this->_installOptions();
        set_option('cookie_configuration', defaultConsent());
    }

    /**
     * Uninstalls any options that have been set.
     */
    public function hookUninstall()
    {
        $this->_uninstallOptions();
    }
    /**
     * Set the options from the Config form.
     */
    public function hookConfig()
    {
        foreach (array_keys($this->_options) as $key)
        {
            set_option($key, trim($_POST[$key]));
        }
    }

    /**
     * Displays the configuration form.
     */
    public function hookConfigForm()
    {
        require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views'. DIRECTORY_SEPARATOR . 'config_form.php';
    }

    private function defaultConfig()
    {
        return require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views'. DIRECTORY_SEPARATOR . 'javascripts' . DIRECTORY_SEPARATOR . 'vendor'. DIRECTORY_SEPARATOR . 'cookieconsent-init.js';
    }

}
