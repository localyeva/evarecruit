<?php

/**
 * Description of MyOptions
 *
 * @author khangld
 * 
 * use in front-end by this way get_option('my_theme_option')
 * 
 * @ct_google_analytics
 * @ct_google_tag_manager
 * @ct_facebook_script
 * @ct_google_plus_script
 * @ct_twitter_script
 * @ct_custom_script
 * 
 */
class MyThemeOptions {

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options = NULL;

    /**
     * Start up
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_plugin_page'));
        //
        add_action('admin_init', array($this, 'page_init'));
    }

    /**
     * Add options page
     */
    function add_plugin_page() {
        // This page will be under "Theme Options"
        // work
        add_menu_page(
                'Theme Options', 'Theme Options', 'manage_options', 'my-setting-theme', array($this, 'settings_page')
        );
        // not work ???
//        add_options_page(
//                'Theme Options', 'Theme Options', 'manage_options', 'my-setting-theme', array($this, 'settings_page')
//        );
    }

    /**
     * Options page callback
     */
    public function settings_page() {
        // Set class property
        $this->options = get_option('my_theme_option');
        ?>

        <div id="theme-options-wrap">
            <div class="wp-menu-image dashicons-before dashicons-admin-tools" id="icon-tools"> <br/> </div>
            <h2>My Theme Options</h2>
            <p>Take control of your theme, by overriding the default settings with your own specific preferences.</p>
            <form method="post" action="options.php" enctype="multipart/form-data">
                <?php
                // This prints out all hidden setting fields
                settings_fields('my_theme_option_group');
                do_settings_sections('section_analytics');
                do_settings_sections('section_social_script');
                do_settings_sections('section_custom_script');
                submit_button();
                ?>
            </form>
        </div>

        <?php
    }

    /**
     * Register and add settings
     * register_and_build_fields
     */
    public function page_init() {
        register_setting(
                'my_theme_option_group', // Option group
                'my_theme_option', // Option name
                array($this, 'sanitize')    // Sanitize
        );

        // Google Analytics Section
        add_settings_section(
                'id_analytics_settings', // ID
                'Google Analytics Settings', // Title
                array($this, 'print_section_google_analytics_info'), // Callback
                'section_analytics'  // Section
        );

        // Social Section
        add_settings_section('id_social_script', 'Social Script', array($this, 'print_social_script_info'), 'section_social_script');

        // Custom Script Section
        add_settings_section('id_custom_script_settings', 'Custom Script', array($this, 'print_section_custom_script_info'), 'section_custom_script');

        /*
         * add_settings_field(ID, Title Name, Callback function, Section, Setting ID)
         */

        add_settings_field(
                'ct_google_analytics', 'Google Analytics Script', array($this, 'ct_google_analytics_callback'), 'section_analytics', 'id_analytics_settings'
        );

        add_settings_field('ct_google_tag_manager', 'Google Tag Manger Script', array($this, 'ct_google_tag_manager_callback'), 'section_analytics', 'id_analytics_settings');

        // Social script
        add_settings_field('ct_facebook_script', 'Facebook Script', array($this, 'ct_facebook_script_callback'), 'section_social_script', 'id_social_script');
        
        add_settings_field('ct_google_plus_script', 'Google Plus Script', array($this, 'ct_google_plus_script_callback'), 'section_social_script', 'id_social_script');
        
        add_settings_field('ct_twitter_script', 'Twitter Script', array($this, 'ct_twitter_script_callback'), 'section_social_script', 'id_social_script');

        //
        add_settings_field('ct_custom_script', 'Script', array($this, 'ct_custom_script_callback'), 'section_custom_script', 'id_custom_script_settings');
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input) {
        // sanitize_text_field()
        $new_input = array();

        if (isset($input['ct_google_analytics'])) {
            $new_input['ct_google_analytics'] = $input['ct_google_analytics'];
        }

        if (isset($input['ct_google_tag_manager'])) {
            $new_input['ct_google_tag_manager'] = $input['ct_google_tag_manager'];
        }

        if (isset($input['ct_facebook_script'])) {
            $new_input['ct_facebook_script'] = $input['ct_facebook_script'];
        }
        
        if (isset($input['ct_google_plus_script'])) {
            $new_input['ct_google_plus_script'] = $input['ct_google_plus_script'];
        }
        
        if (isset($input['ct_twitter_script'])) {
            $new_input['ct_twitter_script'] = $input['ct_twitter_script'];
        }

        if (isset($input['ct_custom_script'])) {
            $new_input['ct_custom_script'] = $input['ct_custom_script'];
        }

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_google_analytics_info() {
        print 'Implementing Google Analytics with Google Tag Manager';
    }

    public function print_social_script_info() {
        print 'Implementing Social Network Sript Here';
    }

    public function print_section_custom_script_info() {
        print 'Define Your Own Javascript';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function ct_google_analytics_callback() {
        printf(
                '<textarea rows="4" cols="50" id="title" name="my_theme_option[ct_google_analytics]">%s</textarea>', isset($this->options['ct_google_analytics']) ? esc_attr($this->options['ct_google_analytics']) : ''
        );
    }

    public function ct_google_tag_manager_callback() {
        printf(
                '<textarea rows="4" cols="50" id="title" name="my_theme_option[ct_google_tag_manager]">%s</textarea>', isset($this->options['ct_google_tag_manager']) ? esc_attr($this->options['ct_google_tag_manager']) : ''
        );
    }

    public function ct_facebook_script_callback() {
        printf(
                '<textarea rows="4" cols="50" id="title" name="my_theme_option[ct_facebook_script]">%s</textarea>', isset($this->options['ct_facebook_script']) ? esc_attr($this->options['ct_facebook_script']) : ''
        );
    }
    
    public function ct_google_plus_script_callback() {
        printf(
                '<textarea rows="4" cols="50" id="title" name="my_theme_option[ct_google_plus_script]">%s</textarea>', isset($this->options['ct_google_plus_script']) ? esc_attr($this->options['ct_google_plus_script']) : ''
        );
    }
    
    public function ct_twitter_script_callback() {
        printf(
                '<textarea rows="4" cols="50" id="title" name="my_theme_option[ct_twitter_script]">%s</textarea>', isset($this->options['ct_twitter_script']) ? esc_attr($this->options['ct_twitter_script']) : ''
        );
    }

    public function ct_custom_script_callback() {
        printf(
                '<textarea rows="4" cols="50" id="title" name="my_theme_option[ct_custom_script]">%s</textarea>', isset($this->options['ct_custom_script']) ? esc_attr($this->options['ct_custom_script']) : ''
        );
    }

}

if (is_admin()) {
    $my_theme_option = new MyThemeOptions();
}