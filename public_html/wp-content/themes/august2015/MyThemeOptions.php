<?php

/**
 * Description of MyOptions
 *
 * @author khangld
 */
class MyThemeOptions {

    /**
     * Holds the values to be used in the fields callbacks
     */
    public $options = NULL;

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
//                'Theme Options', 'Theme Options', 'manage_options', 'my-setting-admin', array($this, 'settings_page')
//        );
    }

    /**
     * Options page callback
     */
    public function settings_page() {
        // Set class property
//        $this->options = get_option('my_theme_option');
        $this->options = get_option('my_theme_option');
        
        var_dump($this->options);
        print_r('<br>');
        var_dump(get_option('my_theme_option'));
        ?>

        <div id="theme-options-wrap">
            <div class="wp-menu-image dashicons-before dashicons-admin-tools" id="icon-tools"> <br/> </div>
            <h2>My Theme Options</h2>
            <p>Take control of your theme, by overriding the default settings with your own specific preferences.</p>
            <form method="post" action="options.php" enctype="multipart/form-data">
                <?php
                // This prints out all hidden setting fields
                settings_fields('my_theme_option_group');
                do_settings_sections('my-setting-admin');
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

        add_settings_section(
                'se_general_settings', // ID
                'General Settings', // Title
                array($this, 'print_section_general_info'), // Callback
                'my-setting-admin'  // Section
        );

        /*
         * add_settings_field(ID, Title Name, Callback function, Section, Setting ID)
         */

        add_settings_field(
                'ct_google_analytics', 'Google Analytics Script', array($this, 'ct_google_analytics_callback'), 'my-setting-admin', 'se_general_settings'
        );

        add_settings_field('ct_test', 'Test', array($this, 'ct_test_callback'), 'my-setting-admin', 'se_general_settings');
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input) {
        $new_input = array();

        if (isset($input['ct_google_analytics'])) {
            $new_input['ct_google_analytics'] = sanitize_text_field($input['ct_google_analytics']);
        }

        if (isset($input['ct_test'])) {
            $new_input['ct_test'] = sanitize_text_field($input['ct_test']);
        }

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_general_info() {
        print 'Enter your settings below';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function ct_google_analytics_callback() {
        printf(
                '<textarea rows="4" cols="50" id="title" name="my_theme_option[ct_google_analytics]">%s</textarea>', isset($this->options['ct_google_analytics']) ? esc_attr($this->options['ct_google_analytics']) : ''
        );
    }

    public function ct_test_callback() {
        printf(
                '<input type="text" name="my_theme_option[ct_test]" value="%s"/>', isset($this->options['ct_test']) ? esc_attr($this->options['ct_test']) : ''
        );
    }

}

if (is_admin()) {
    $my_theme_options = new MyThemeOptions();
    var_dump($my_theme_options);
}
