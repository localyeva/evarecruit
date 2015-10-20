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
        $this->settings_base = 'wpt_job_';
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

        $tab = '';
        if ($pagenow == 'edit.php' &&
                isset($get_uri['post_type']) && $get_uri['post_type'] == 'job' &&
                isset($get_uri['page']) && $get_uri['page'] == 'plugin_settings') {
            if (isset($get_uri['tab']))
                $tab = $get_uri['tab'];
            else
                $tab = 'list-cadidate';
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
        add_action('load-' . $page, array($this, 'load_settings_plugin'));
    }

    /**
     * Load settings JS & CSS
     * @return void
     */
    public function settings_assets() {

        wp_register_style('job-style', $this->assets_url . 'css/job-style.css');
        wp_enqueue_style('job-style');
        wp_register_style('fancybox-style', $this->assets_url . 'fancybox/jquery.fancybox.css');
        wp_enqueue_style('fancybox-style');

// We're including the farbtastic script & styles here because they're needed for the colour picker
// If you're not including a colour picker field then you can leave these calls out as well as the farbtastic dependency for the wpt-admin-js script below
        wp_enqueue_style('farbtastic');
        wp_enqueue_script('farbtastic');
// We're including the WP media scripts here because they're needed for the image upload field
// If you're not including an image upload then you can leave this function call out
        wp_enqueue_media();
        wp_register_script('wpt-admin-js', $this->assets_url . 'js/settings.js', array('farbtastic', 'jquery'), '1.0.0');
        wp_enqueue_script('wpt-admin-js');
        //
        wp_register_script('fancybox-admin-js', $this->assets_url . 'fancybox/jquery.fancybox.pack.js', array('farbtastic', 'jquery'), '2.1.5');
        wp_enqueue_script('fancybox-admin-js');
    }

    public function load_settings_plugin() {
        if (isset($_POST['job-settings-submit']) && $_POST['job-settings-submit'] == 'Y') {
            $this->save_settings_plugin();
            $tab = $this->get_tab();
            $url_parameters = isset($tab) ? 'updated=true&tab=' . $tab : 'updated=true';
            wp_redirect(admin_url('edit.php?post_type=job&page=plugin_settings&' . $url_parameters));
        }
    }

    public function save_settings_plugin() {
        if (is_array($this->settings)) {
            foreach ($this->settings as $section => $data) {
                // Add section to page
                $tab = $this->get_tab();

                if ($tab == $section) {
                    if (isset($data['fields'])) {
                        foreach ($data['fields'] as $field) {
                            $option_name = $this->settings_base . $field['id'];
                            $setting = get_option($option_name);
                            $tab = $this->get_tab();
                            switch ($tab) {
                                case 'mail-to':
                                    $setting[$option_name] = $_POST[$option_name];
                                    break;
                                case 'top-define':
                                    $setting[$option_name] = $_POST[$option_name];
                                    break;
                            }
                            $updated = update_option($option_name, $setting);
                        }
                    }
                }
            }
        }
    }

    /**
     * Add settings link to plugin list table
     * @param  array $links Existing links
     * @return array 		Modified links
     */
    public function add_settings_link($links) {
        $settings_link = '<a href="edit.php?post_type=job&page=plugin_settings">' . __('Settings', 'plugin_textdomain') . '</a>';
//        $settings_link = '<a href="options-general.php?page=plugin_settings">' . __('Settings', 'plugin_textdomain') . '</a>';
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
                    'id' => 'text_from_email',
                    'label' => __('From Email', 'plugin_textdomain') . "<br><h5>( {$this->settings_base}text_from_email )</h5>",
                    'description' => __('', 'plugin_textdomain'),
                    'type' => 'text',
                    'default' => '',
                    'placeholder' => __('', 'plugin_textdomain')
                ),
                array(
                    'id' => 'text_from_name',
                    'label' => __('From Name', 'plugin_textdomain') . "<br><h5>( {$this->settings_base}text_from_name )</h5>",
                    'description' => __('', 'plugin_textdomain'),
                    'type' => 'text',
                    'default' => '',
                    'placeholder' => __('', 'plugin_textdomain')
                ),
                array(
                    'id' => 'text_subject_candidate',
                    'label' => __('Mail Subject (To Candidate)', 'plugin_textdomain') . "<br><h5>( {$this->settings_base}text_subject_candidate )</h5>",
                    'description' => __('', 'plugin_textdomain'),
                    'type' => 'text',
                    'default' => '',
                    'placeholder' => __('', 'plugin_textdomain')
                ),
                array(
                    'id' => 'text_block_candidate',
                    'label' => __('Mail Template (To Candidate)', 'plugin_textdomain') . "<br><h5>( {$this->settings_base}text_block_candidate )</h5>",
                    'description' => __('{{apply_date}} {{fullname}} {{email}} {{phone_number}} {{gender}} {{attach_file}} {{job_id}} {{job_title}} {{job_position}} {{job_level}} {{job_salary}} {{job_location}} {{job_expired}} {{job_slug}}', 'plugin_textdomain'),
                    'type' => 'wysiwyg',
                    'default' => '',
                    'placeholder' => __('', 'plugin_textdomain')
                ),
                array(
                    'id' => 'text_list_email',
                    'label' => __('Email List (To Admin)', 'plugin_textdomain') . "<br><h5>( {$this->settings_base}text_list_email )</h5>",
                    'description' => __('Each email 1 line', 'plugin_textdomain'),
                    'type' => 'textarea',
                    'default' => '',
                    'placeholder' => __('', 'plugin_textdomain')
                ),
                array(
                    'id' => 'text_subject_admin',
                    'label' => __('Mail Subject (To Admin)', 'plugin_textdomain') . "<br><h5>( {$this->settings_base}text_subject_admin )</h5>",
                    'description' => __('', 'plugin_textdomain'),
                    'type' => 'text',
                    'default' => '',
                    'placeholder' => __('', 'plugin_textdomain')
                ),
                array(
                    'id' => 'text_block_admin',
                    'label' => __('Mail Template (To Admin)', 'plugin_textdomain') . "<br><h5>( {$this->settings_base}text_block_admin )</h5>",
                    'description' => __('{{apply_date}} {{fullname}} {{email}} {{phone_number}} {{gender}} {{attach_file}} {{job_id}} {{job_title}} {{job_position}} {{job_level}} {{job_salary}} {{job_location}} {{job_expired}} {{job_slug}} {{entry_time}} {{entry_host}} {{entry_ua}}', 'plugin_textdomain'),
                    'type' => 'wysiwyg',
                    'default' => '',
                    'placeholder' => __('', 'plugin_textdomain')
                ),
            )
        );

        $settings['top-define'] = array(
            'title' => __('Top Definition', 'plugin_textdomain'),
            'description' => __('', 'plugin_textdomain'),
            'fields' => array(
                array(
                    'id' => 'text_item_per_page',
                    'label' => __('Item Per Page (Top)', 'plugin_textdomain'),
                    'description' => __('', 'plugin_textdomain'),
                    'type' => 'text',
                    'default' => '10',
                    'placeholder' => __('', 'plugin_textdomain')
                ),
                array(
                    'id' => 'text_item_per_page_job',
                    'label' => __('Item Per Page (Job)', 'plugin_textdomain'),
                    'description' => __('', 'plugin_textdomain'),
                    'type' => 'text',
                    'default' => '10',
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

                global $wpdb;

                $html .= '<h3>List of Candidates</h3>';
                $html .= '<p></p>';

                $table_name = $wpdb->prefix . 'jobs_management';
                $total = $wpdb->get_var("SELECT COUNT(*) FROM  $table_name");
                $items_per_page = 20;
                $page = isset($_GET['cpage']) ? abs((int) $_GET['cpage']) : 1;
                $offset = ( $page * $items_per_page ) - $items_per_page;
                $list_candidates = $wpdb->get_results(
                        ""
                        . " SELECT * "
                        . " FROM  $table_name "
                        . " ORDER BY job_expired, apply_date DESC "
                        . " LIMIT ${offset}, ${items_per_page} "
                );

                $html .= '<div class="pagination">';
                $html .= paginate_links(array(
                    'base' => add_query_arg('cpage', '%#%'),
                    'format' => '',
                    'prev_text' => __('&laquo;'),
                    'next_text' => __('&raquo;'),
                    'total' => ceil($total / $items_per_page),
                    'current' => $page
                ));
                $html .= '</div>';

                $html .= '<div class="job-table">';
                $html .= '<table>';
                $html .= '<tr>';
                $html .= '<td width="3%">id</td>';
                $html .= '<td width="135">Applied Date</td>';
                $html .= '<td width="75">Expired</td>';
                $html .= '<td width="200">Candidate Name</td>';
                $html .= '<td width="250">Email</td>';
                $html .= '<td width="100">Telephone</td>';
                $html .= '<td width="40">Gender</td>';
                $html .= '<td width="105">CV</td>';
                $html .= '<td width="">Job Title</td>';
                $html .= '</tr>';
                if ($list_candidates) {
                    foreach ($list_candidates as $post) {

                        $ext = substr(strrchr($post->attach_file, '.'), 1);
                        $download = sanitize_title($post->fullname . '-cv') . '.' . $ext;

                        $html .= '<tr>';
                        $html .= '<td>' . $post->id . '</td>';
                        $html .= '<td>' . date_format(new DateTime($post->apply_date), 'd-m-Y H:i:s') . '</td>';
                        $html .= '<td>' . $post->job_expired . '</td>';
                        $html .= '<td>' . $post->fullname . '</td>';
                        $html .= '<td>' . $post->email . '</td>';
                        $html .= '<td>' . $post->phone_number . '</td>';
                        $html .= '<td style="text-align:center;">' . strtoupper($post->gender) . '</td>';
                        $html .= '<td><a target="_blank" href="' . $post->attach_file . '" download="' . $download . '"><button>Download CV</button></a></td>';
                        $html .= '<td>';
                        $html .= '<a class="pop-job" href="#job_' . $post->id . '">' . $post->job_title . '</a>';
                        $html .= '<div id="job_' . $post->id . '" class="table" style="display:none;">'
                                . '<h3><a href="' . $post->job_slug . '">' . $post->job_title . '</a></h3>'
                                . '<p>Salary: ' . $post->job_salary . '</p>'
                                . '<p>Expired: ' . $post->job_expired . '</p>'
                                . '<p>Location: ' . $post->job_location . '</p>'
                                . '<p>Position: ' . $post->job_position . '</p>'
                                . '<p>Work Level: ' . $post->job_level . '</p>'
                                . '<p>' . '</p>'
                                . '</div>';
                        $html .= '</td>';
                        $html .= '</tr>';
                    }
                }
                $html .= '</table>';
                $html .= '</div>';

                $html .= '<div class="pagination">';
                $html .= paginate_links(array(
                    'base' => add_query_arg('cpage', '%#%'),
                    'format' => '',
                    'prev_text' => __('&laquo;'),
                    'next_text' => __('&raquo;'),
                    'total' => ceil($total / $items_per_page),
                    'current' => $page
                ));
                $html .= '</div>';

                break;

            case 'mail-to':

                switch ($field['type']) {
                    case 'text':
                        $_data = isset($data[$option_name]) ? $data[$option_name] : '';
                        $html .= '<input id="' . esc_attr($field['id']) . '" type="text" name="' . esc_attr($option_name) . '" placeholder="' . esc_attr($field['placeholder']) . '" value="' . stripcslashes($_data) . '" size="100%"/>' . "\n";
                        break;
                    case 'textarea':
                        $_data = isset($data[$option_name]) ? $data[$option_name] : '';
                        $html .= '<textarea id="' . esc_attr($field['id']) . '" rows="5" cols="50" name="' . esc_attr($option_name) . '" placeholder="' . esc_attr($field['placeholder']) . '">' . stripcslashes($_data) . '</textarea><br/>' . "\n";
                        $html .= '<br/><span class="description">' . $field['description'] . '</span>';
                        break;
                    case 'wysiwyg':
                        $_data = isset($data[$option_name]) ? $data[$option_name] : '';
                        $html .= wp_editor_resize(NULL, 200);
                        $html .= wp_editor(stripcslashes($_data), esc_attr($option_name), array('wpautop' => false, 'tinymce' => true));
                        $html .= $field['description'];
                        break;
                }

                break;

            case 'top-define':

                switch ($field['type']) {
                    case 'text':
                        $_data = isset($data[$option_name]) ? $data[$option_name] : '';
                        $html .= '<input id="' . esc_attr($field['id']) . '" type="text" name="' . esc_attr($option_name) . '" placeholder="' . esc_attr($field['placeholder']) . '" value="' . $_data . '"/>' . "\n";
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
        $tab = $this->get_tab();

        // Build page HTML
        $html = '<div class="wrap" id="plugin_settings">' . "\n";
        $html .= '<h2>' . __('Plugin Settings', 'plugin_textdomain') . '</h2>' . "\n";
        // Setup navigation
        $html .= '<div class="cssmenu">' . "\n";
        $html .= '<ul id="settings-sections" class="hide-if-no-js">' . "\n";
        foreach ($this->settings as $section => $data) {
            $active = '';
            if ($tab == $section) {
                $active = 'active';
            }
            $html .= '<li class=" ' . $active . '"><a class="tab" href="edit.php?post_type=job&page=plugin_settings&tab=' . $section . '">' . $data['title'] . '</a></li>' . "\n";
        }
        $html .= '</ul>' . "\n";
        $html .= '</div>' . "\n";
        $html .= '<div class="clear"></div>' . "\n";

        if ($tab == 'list-cadidate') {
            ob_start();
            $html .= $this->display_field(array('field' => array('id' => 'list-candidate', 'type' => 'list-candidate')));
            $html .= ob_get_clean();
        } else {
            $html .= '<form method="post" action="' . admin_url('edit.php?post_type=job&page=plugin_settings&tab=' . $tab) . '" enctype="multipart/form-data">' . "\n";
            // Get settings fields
            ob_start();
            settings_fields('plugin_settings');
            do_settings_sections('plugin_settings');
            $html .= ob_get_clean();
            $html .= '<p class="submit">' . "\n";
            $html .= '<input name="Submit" type="submit" class="button-primary" value="' . esc_attr(__('Save Settings', 'plugin_textdomain')) . '" />' . "\n";
            $html .= '<input type="hidden" name="job-settings-submit" value="Y" />' . "\n";
            $html .= '</p>' . "\n";
            $html .= '</form>' . "\n";
        }
        $html .= '</div>' . "\n";
        echo $html;
    }

}

new jobs_plugin_admin(__FILE__);
