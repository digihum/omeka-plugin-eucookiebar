// This is an empty file to be overridden by the theme.

window.addEventListener('load', function(){
    // obtain cookieconsent plugin

    // if $built_in_config is a json object
    // then it is the built-in config
    console.log('typeof $gui_options: ' + eval(typeof $gui_options === 'object' && typeof $languages === 'object'));
    
    if(typeof $gui_options === 'object' && typeof $languages === 'object') {
        console.log('running...');
        var cc = initCookieConsent();
        
        cc.run({

            current_lang : 'en',
            autoclear_cookies : true,                   // default: false
            cookie_name: 'cc_cookie',             // default: 'cc_cookie'
            cookie_expiration : 182,                    // default: 182
            page_scripts: true,                         // default: false
        
            // auto_language: null,                     // default: null; could also be 'browser' or 'document'
            // autorun: true,                           // default: true
            // delay: 0,                                // default: 0
            force_consent: true,
            // hide_from_bots: false,                   // default: false
            // remove_cookie_tables: false              // default: false
            // cookie_domain: location.hostname,        // default: current domain
            // cookie_path: "/",                        // default: root
            // cookie_same_site: "Lax",
            // use_rfc_cookie: false,                   // default: false
            // revision: 0,                             // default: 0
        
            onFirstAction: function(){
                // console.log('onFirstAction fired');
            },
        
            onAccept: function (cookie) {
                // console.log('onAccept fired ...');
            },
        
            onChange: function (cookie, changed_preferences) {
                // If analytics category is disabled => disable google analytics
                if (!cc.allowedCategory('analytics')) {
                    typeof gtag === 'function' && gtag('consent', 'update', {
                        'analytics_storage': 'denied'
                    });
                }
            },
            gui_options: $gui_options,
            languages: $languages
        })
    };
});