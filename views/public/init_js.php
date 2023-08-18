<?php $this->headScript()->captureStart() ?>

// This script creates a configuration object for Cookie Consent from the options provided in the plugin admin interface

var logo = <?php echo js_escape($this->settings_title) ?>;
var cookie = '🍪';

$gui_options = {
    consent_modal: {
        <?php if ($this->consent_layout): ?>
        layout: <?php echo js_escape($this->consent_layout) ?>,
        <?php endif; ?>
        <?php if ($this->consent_position): ?>
        position: <?php echo js_escape($this->consent_position) ?>,
        <?php endif; ?>
        <?php if ($this->consent_transition): ?>
        transition: <?php echo js_escape($this->consent_transition) ?>,
        <?php endif; ?>
        <?php if ($this->consent_swap_buttons): ?>
        swap_buttons: <?php echo js_escape($this->consent_swap_buttons) ?>,
        <?php endif; ?>
    },
    settings_modal: {
        <?php if ($this->settings_layout): ?>
        layout: <?php echo js_escape($this->settings_layout) ?>,
        <?php endif; ?>
        <?php if ($this->settings_position): ?>
        position: <?php echo js_escape($this->settings_position) ?>,
        <?php endif; ?>
        <?php if ($this->settings_transition): ?>
        transition: <?php echo js_escape($this->settings_transition) ?>,
        <?php endif; ?>
        }
};

$languages = {
    'en': {
        consent_modal: {
            title: <?php echo js_escape($this->title) ?>,
            description: <?php echo js_escape($this->description) ?>,
            primary_btn: {
                text: 'Accept all',
                role: 'accept_all'              // 'accept_selected' or 'accept_all'
            },
            secondary_btn: {
                text: 'Reject all',
                role: 'accept_necessary'        // 'settings' or 'accept_necessary'
            }
        },
        settings_modal: {
            title: logo,
            save_settings_btn: 'Save settings',
            accept_all_btn: 'Accept all',
            reject_all_btn: 'Reject all',
            close_btn_label: 'Close',
            cookie_table_headers: [
                {col1: 'Name'},
                {col2: 'Purpose'},
                {col3: 'Expiration'},
            ],
            blocks: [
                {
                    title: 'Cookie consent',
                    description: 'Please review the cookies we set on this website used for the basic functionalities of the website and to enhance your online experience. You can choose for each category to opt-in/out whenever you want. For more details relative to cookies and other sensitive data, please read the full <a href="https://warwick.ac.uk/terms/privacy" class="cc-link" target="_blank">privacy policy</a>.'
                }, {
                    title: 'Necessary cookies',
                    description: 'TThese cookies are necessary for the operation of our web site, for example, those that determine whether you\'re signed in and who you are.',
                    toggle: {
                        value: 'necessary',
                        enabled: true,
                        readonly: true          // cookie categories with readonly=true are all treated as "necessary cookies"
                    }
                }, 			<?php /* Only show if analytics is live */ if ($this->analytics): ?> {
                    title: 'Performance and Analytics cookies',
                    description: 'These cookies allow us to track the performance and usage of the Warwick web site with anonymised \'statistics\'. We use cookies to track your route around the Warwick web site and use the statistics that these create to improve the web site\'s performance and user experience.',
                    toggle: {
                        value: 'analytics',     // there are no default categories => you specify them
                        enabled: false,
                        readonly: false
                    },
                    cookie_table: [
                        {
                            col1: '^_ga, ^_gid',
                            col2: 'These cookies are used by Google Analytics software to distinguish users. The information we gather includes but is not limited to how users interact with the Warwick web site, which pages are most frequently viewed, how frequently the users visit the web site, traffic source of user visit, demographics data (age and gender), location and device information (make and model). Any data collected is anonymous and used for statistical reporting only. Other cookies created by Google Analytics include _gid, AMP_TOKEN and _gac_<property-id>. These cookies store other randomly generated IDs and campaign information about the user.',
                            col3: 'Up to two years after last web site visit.',
                            is_regex: false
                        }
                    ]
                }, <?php endif; ?> {
                    title: "More information",
                    description: <?php echo js_escape($this->more_information) ?>,
                }
            ]
        }
    }
};
<?php $this->headScript()->captureEnd() ?>