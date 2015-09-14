<?php

/**
 * Description of jobs-plugin-management
 *
 * @author khangld
 */
class jobs_plugin_admin {

    private $dir;
    private $file;
    private $assets_dir;
    private $assets_url;
    private $settings_base;
    private $settings;

    public function __construct($file) {
        $this->file = $file;
        $this->dir = dirname($this->file);
        $this->assets_dir = trailingslashit($this->dir) . 'assets';
        $this->assets_url = esc_url(trailingslashit(plugins_url('/assets/', $this->file)));
        $this->settings_base = 'wpt_';
        // Initialise settings
        add_action('admin_init', array($this, 'init'));
        // Register plugin settings
        add_action('admin_init', array($this, 'register_settings'));
        // Add settings page to menu
        add_action('admin_menu', array($this, 'add_menu_item'));
        // Add settings link to plugins page
        add_filter('plugin_action_links_' . plugin_basename($this->file), array($this, 'add_settings_link'));
    }

    /**
     * Initialise settings
     * @return void
     */
    public function init() {
        $this->settings = $this->settings_fields();
    }

    /**
     * 
     * @return string
     */
    public function get_tab() {
        global $pagenow;

        $query_string = $_SERVER['QUERY_STRING'];
        parse_str($query_string, $get_uri);

        if ($pagenow == 'edit.php' && $get_uri['post_type'] == 'job' && $get_uri['page'] == 'plugin_settings') {
            if (isset($get_uri['tab']))
                $tab = $get_uri['tab'];
            else
                $tab = 'list';
        }

        return $tab;
    }

    /**
     * Add settings page to admin menu
     * @return void
     */
    public function add_menu_item() {
        $page = add_submenu_page('edit.php?post_type=job', __('Job Settings', 'plugin_textdomain'), __('Job Settings', 'plugin_textdomain'), 'manage_options', 'plugin_settings', array($this, 'settings_page'));
        add_action('admin_print_styles-' . $page, array($this, 'settings_assets'));
    }

    /**
     * Load settings JS & CSS
     * @return void
     */
    public function settings_assets() {
// We're including the farbtastic script & styles here because they're needed for the colour picker
// If you're not including a colour picker field then you can leave these calls out as well as the farbtastic dependency for the wpt-admin-js script below
        wp_enqueue_style('farbtastic');
        wp_enqueue_script('farbtastic');
// We're including the WP media scripts here because they're needed for the image upload field
// If you're not including an image upload then you can leave this function call out
        wp_enqueue_media();
        wp_register_script('wpt-admin-js', $this->assets_url . 'js/settings.js', array('farbtastic', 'jquery'), '1.0.0');
        wp_enqueue_script('wpt-admin-js');
    }

    /**
     * Add settings link to plugin list table
     * @param  array $links Existing links
     * @return array 		Modified links
     */
    public function add_settings_link($links) {
        $settings_link = '<a href="options-general.php?page=plugin_settings">' . __('Settings', 'plugin_textdomain') . '</a>';
        array_push($links, $settings_link);
        return $links;
    }

    /**
     * Build settings fields
     * @return array Fields to be displayed on settings page
     */
    private function settings_fields() {
        $settings['list-cadidate'] = array(
            'title' => __('List Candidates', 'plugin_textdomain'),
            'description' => __('List Cadidates', 'plugin_textdomain'),
        );

        $settings['mail-to'] = array(
            'title' => __('Setting Email', 'plugin_textdomain'),
            'description' => __('List "email-to" after candidates applied CV', 'plugin_textdomain'),
            'fields' => array(
                array(
                    'id' => 'text_block',
                    'label' => __('List email', 'plugin_textdomain'),
                    'description' => __('Each email 1 line', 'plugin_textdomain'),
                    'type' => 'textarea',
                    'default' => 'ito@evolableasia.vn',
                    'placeholder' => __('', 'plugin_textdomain')
                ),
            )
        );

        $settings = apply_filters('plugin_settings_fields', $settings);
        return $settings;
    }

    /**
     * Register plugin settings
     * @return void
     */
    public function register_settings() {
        if (is_array($this->settings)) {
            foreach ($this->settings as $section => $data) {
                // Add section to page
                $tab = $this->get_tab();

                if ($tab == $section) {
                    if (isset($data['fields'])) {
                        add_settings_section($section, $data['title'], array($this, 'settings_section'), 'plugin_settings');
                        foreach ($data['fields'] as $field) {
                            // Validation callback for field
                            $validation = '';
                            if (isset($field['callback'])) {
                                $validation = $field['callback'];
                            }
                            // Register field
                            $option_name = $this->settings_base . $field['id'];
                            register_setting('plugin_settings', $option_name, $validation);
                            // Add field to page
                            add_settings_field($field['id'], $field['label'], array($this, 'display_field'), 'plugin_settings', $section, array('field' => $field));
                        }
                    }
                }
            }
        }
    }

    public function settings_section($section) {
        $html = '<p> ' . $this->settings[$section['id']]['description'] . '</p>' . "\n";
        echo $html;
    }

    /**
     * Generate HTML for displaying fields
     * @param  array $args Field data
     * @return void
     */
    public function display_field($args) {

        $field = $args['field'];
        $html = '';
        $option_name = $this->settings_base . $field['id'];
        $option = get_option($option_name);
        $data = '';

        if (isset($field['default'])) {
            $data = $field['default'];
            if ($option) {
                $data = $option;
            }
        }

        $tab = $this->get_tab();

        switch ($tab) {

            case 'list-cadidate':

                $html .= '<h3>List of Candidates</h3>';
                $html .= '<p></p>';
                
                $args = array(
                    'orderby' => 'count',
                    'hide_empty' => 0
                );
                $positions = get_terms('job-position', $args);
                $option = '';
                foreach ($positions as $position){
                    $option .= '<option value="' . $position->term_id . '">' . $position->name . '</option>';
                }
                
                $html .= '<select name = "position" class = "form-control">
                                <option value="">-- Select Position --</option>
                                ' . $option . '</select>';

                break;

            case 'mail-to':

                switch ($field['type']) {
                    case 'textarea':
                        $html .= '<textarea id="' . esc_attr($field['id']) . '" rows="5" cols="50" name="' . esc_attr($option_name) . '" placeholder="' . esc_attr($field['placeholder']) . '">' . $data . '</textarea><br/>' . "\n";
                        $html .= '<br/><span class="description">' . $field['description'] . '</span>';
                        break;
                }
                break;
        }

        echo $html;
    }

    /**
     * Validate individual settings field
     * @param  string $data Inputted value
     * @return string       Validated value
     */
    public function validate_field($data) {
        if ($data && strlen($data) > 0 && $data != '') {
            $data = urlencode(strtolower(str_replace(' ', '-', $data)));
        }
        return $data;
    }

    /**
     * Load settings page content
     * @return void
     */
    public function settings_page() {
// Build page HTML
        $html = '<div class="wrap" id="plugin_settings">' . "\n";
        $html .= '<h2>' . __('Plugin Settings', 'plugin_textdomain') . '</h2>' . "\n";
        $html .= '<form method="post" action="options.php" enctype="multipart/form-data">' . "\n";
        // Setup navigation
        $html .= '<ul id="settings-sections" class="subsubsub hide-if-no-js">' . "\n";
        foreach ($this->settings as $section => $data) {
            $html .= '<li><a class="tab" href="edit.php?post_type=job&page=plugin_settings&tab=' . $section . '">' . $data['title'] . '</a></li>' . "\n";
        }
        $html .= '</ul>' . "\n";
        $html .= '<div class="clear"></div>' . "\n";


        $tab = $this->get_tab();
        if ($tab == 'list-cadidate') {
            ob_start();
            $html .= $this->display_field(array('field' => array('id' => 'list-candidate', 'type' => 'list-candidate')));
            $html .= ob_get_clean();
        } else {
            // Get settings fields
            ob_start();
            settings_fields('plugin_settings');
            do_settings_sections('plugin_settings');
            $html .= ob_get_clean();
            $html .= '<p class="submit">' . "\n";
            $html .= '<input name="Submit" type="submit" class="button-primary" value="' . esc_attr(__('Save Settings', 'plugin_textdomain')) . '" />' . "\n";
            $html .= '</p>' . "\n";
        }
        $html .= '</form>' . "\n";
        $html .= '</div>' . "\n";
        echo $html;
    }

}

new jobs_plugin_admin(__FILE__);
