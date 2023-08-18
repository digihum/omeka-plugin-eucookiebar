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
        'install', 
        'upgrade',
        'config',
        'config_form', 
        'uninstall'
    );

    protected $_options = array(
        // main
        'cookie_title',
        'cookie_description',
        'cookie_more_information',
        // google analytics
        'cookie_analytics',
        // consent modal
        'cookie_consent_layout',
        'cookie_consent_position',
        'cookie_consent_transition',
        'cookie_consent_swap_buttons',
        // settings modal
        'cookie_settings_title',
        'cookie_settings_layout',
        'cookie_settings_position',
        'cookie_settings_transition',
        );

    /**
     * Create the duration type format options form
     *
     * @param $args array
     */

    public function hookPublicHead() {
        // this allows us to include async, the type and other attributes on script elements
        get_view()->headScript()->setAllowArbitraryAttributes(true);

        // cookie consent loading is deferred
        queue_js_file('vendor/cookieconsent',"javascripts",["defer"=>"defer"]);

        // load the locally overridable init file
        queue_js_file('cookieconsent-init');
        queue_css_file('vendor/cookieconsent');

        $get_view_options = [];

        // get the options from the database
        foreach ($this->_options as $key) 
            { $get_view_options[$key] = get_option($key); }

        // don't inject analytics if it's not set
        if (get_option('cookie_analytics') !== "" && get_option('cookie_analytics') !== "UA-XXXXXXXX-X") {
            // inject analytics into init via generated js objects
            echo get_view()->partial('analytics_js.php', $get_view_options);
        }

        // inject options into init via generated js objects
        echo get_view()->partial('init_js.php', $get_view_options);
    }

    public function hookPublicFooter() {
        
    }

    public function hookNeatlinePublicStatic($exhibit){
        echo get_view()->partial('cookie_bar.php', array( 
            "title" => get_option("cookie_title"),
            "description" => get_option("cookie_description"),
            "more_information" => get_option("cookie_more_information"),

            "analytics" => get_option("cookie_analytics"),

            "consent_layout" => get_option("cookie_consent_layout"),
            "consent_position" => get_option("cookie_consent_position"),
            "consent_transition" => get_option("cookie_consent_transition"),
            "consent_swap_buttons" => get_option("cookie_consent_swap_buttons"),

            "settings_title" => get_option("cookie_settings_title"),
            "settings_layout" => get_option("cookie_settings_layout"),
            "settings_position" => get_option("cookie_settings_position"),
            "settings_transition" => get_option("cookie_settings_transition")
        ));
        queue_js_file('vendor/cookieconsent-v2.9.1');
        queue_js_file('cookieconsent-init');
        queue_css_file('vendor/cookieconsent-v2.9.1');

    }

    /**
     * Installation hook.
     */
    public function hookInstall()
    {
        /* TODO: Make these generic so that the module can be shared */
        $this->_installOptions();
        set_option('cookie_title', "");
        set_option('cookie_description', "This website uses essential cookies to ensure its proper operation and analytics cookies to understand how you interact with it. The latter will be set only after consent. <button type='button' data-cc='c-settings' class='cc-link'>Let me choose</button>");
        set_option('cookie_more_information', "For further information about cookies on this website, please read our page about <a class='cc-link' href='https://example.com/cookies/'>cookies</a>.");
        set_option('cookie_analytics', "UA-XXXXXXXX-X");

        set_option('cookie_consent_layout',"block");
        set_option('cookie_consent_position',"top");
        set_option('cookie_consent_transition',"fade");
        set_option('cookie_consent_swap_buttons',"false");

        set_option('cookie_settings_title',"");
        set_option('cookie_settings_layout',"block");
        set_option('cookie_settings_position',"left");
        set_option('cookie_settings_transition',"fade");

    }

    /**
     * Uninstalls any options that have been set.
     */
    public function hookUninstall()
    {
        $this->_uninstallOptions();
        foreach ($this->_options as $key)
        {  
            delete_option($key);
        }
    }

    public function hookUpgrade($args)
    {
        if (version_compare($args['old_version'], '1.0.0', '<=')) {
            // we significantly changed the options in v2
            delete_option('cookie_message');
        }
    }

    /**
     * Set the options from the Config form.
     */
    public function hookConfig($args)
    { 
        foreach ($this->_options as $key)
        {
            set_option($key, trim($_POST[$key]));
        }
    }

    /**
     * Displays the configuration form.
     */
    public function hookConfigForm($args)
    { 
        require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views'. DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR .  'config_form.php';
    }

}
