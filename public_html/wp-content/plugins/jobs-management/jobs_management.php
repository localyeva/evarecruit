<?php

/**
  Plugin Name: Jobs Management
  Plugin URI:
  Description: Jobs Management
  Version:     1.0
  Author:      Khang LD
  Author URI:
  License:
  License URI:
  Domain Path:
  Text Domain:
 */
if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

class jobs_management {

    protected $pluginPath;
    protected $pluginUrl;

    /**
     * A Unique Identifier
     */
    protected $plugin_slug = 'jobs-management-plugin';

    /**
     * A reference to an instance of this class.
     */
    private static $instance;

    /**
     * The array of templates that this plugin tracks.
     */
    protected $templates;

    /**
     *
     */
    protected $widget_slug = 'jobs-management-widget';

    public static function get_instance() {
        if (null == self::$instance) {
            self::$instance = new jobs_management();
        }
        return self::$instance;
    }

    public function __construct() {

        $this->templates = array();

        // Add a filter to the attributes metabox to inject template into the cache.
        add_filter('page_attributes_dropdown_pages_args', array($this, 'register_project_templates'));

        // Add a filter to the save post to inject out template into the page cache
        add_filter('wp_insert_post_data', array($this, 'register_project_templates'));

        // Add a filter to the template include to determine if the page has our 
        // template assigned and return it's path
        add_filter('template_include', array($this, 'view_project_template'));

        // Add your templates to this array.
        $this->templates = array(
            'templates/jobs.php' => 'Jobs',
        );


//        register_activation_hook(__FILE__, array($this, ''));
        add_action('init', array($this, 'cptui_register_my_cpts'));
        add_action('init', array($this, 'cptui_register_my_taxes'));
        add_action('init', array($this, 'getAdminOptions'));


        // --------------- test
        add_action('init', array($this, 'test_template'));

        add_action('init', array($this, 'my_register_field_group'));

        add_filter('get_sub_field', array($this, 'test_uppercase'));
    }

    public function test_uppercase($text = '') {
        if (get_field('main_locations')) {
            while (has_sub_field('repeater')) {
//                $text = apply_filters('address', strtoupper($text));
                $text = '11111111111111111111111' . get_sub_field('address');
                echo $text . '<br>';
            }
        }

        return $text;
    }

    var $adminOptionsName = "DevloungePluginSeriesAdminOptions";

    function getAdminOptions() {
        $devloungeAdminOptions = array('show_header' => 'true',
            'add_content' => 'true',
            'comment_author' => 'true',
            'content' => '');
        $devOptions = get_option($this->adminOptionsName);
        if (!empty($devOptions)) {
            foreach ($devOptions as $key => $option)
                $devloungeAdminOptions[$key] = $option;
        }
        update_option($this->adminOptionsName, $devloungeAdminOptions);
        return $devloungeAdminOptions;
    }

    function test_template() {
        return get_template_part('/templates/jobs-form-list', 'page');
    }

    public function get_plugin_slug() {
        return $this->plugin_slug;
    }

    public function get_plugin_path() {
        // set Plugin Path
        $this->pluginPath = plugin_dir_path(__FILE__);
        return $this->pluginPath;
    }

    public function get_plugin_url() {
        // Set plugin Url
        $this->pluginUrl = WP_PLUGIN_URL . '/' . $this->get_plugin_slug();
        return $this->pluginUrl;
    }

    public function get_widget_slug() {
        return $this->widget_slug;
    }

    public function cptui_register_my_cpts() {
        $labels = array(
            "name" => "Jobs",
            "singular_name" => "Job",
        );

        $args = array(
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "show_ui" => true,
            "has_archive" => true,
            "show_in_menu" => true,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => array("slug" => "job", "with_front" => true),
            "query_var" => true,
            "menu_position" => 28,
            "menu_icon" => plugins_url('images/ad-ico/h3.png', __FILE__),
            "supports" => array("title"),
        );
        register_post_type("job", $args);
    }

    public function cptui_register_my_taxes() {
        $labels = array(
            "name" => "Job Locations",
            "label" => "Job Locations",
        );

        $args = array(
            "labels" => $labels,
            "hierarchical" => false,
            "label" => "Job Locations",
            "show_ui" => true,
            "query_var" => true,
            "rewrite" => array('slug' => 'job-location', 'with_front' => true),
            "show_admin_column" => false,
        );
        register_taxonomy("job-location", array("job"), $args);

        $labels = array(
            "name" => "Job Positions",
            "label" => "Job Positions",
        );

        $args = array(
            "labels" => $labels,
            "hierarchical" => false,
            "label" => "Job Positions",
            "show_ui" => true,
            "query_var" => true,
            "rewrite" => array('slug' => 'job-position', 'with_front' => true),
            "show_admin_column" => false,
        );
        register_taxonomy("job-position", array("job"), $args);
    }

    public function my_register_field_group() {
        if (function_exists("register_field_group")) {
            register_field_group(array(
                'id' => 'acf_job',
                'title' => 'Job',
                'fields' => array(
                    array(
                        'key' => 'field_55cb0d1a13787',
                        'label' => 'Position',
                        'name' => 'position',
                        'type' => 'taxonomy',
                        'taxonomy' => 'job-position',
                        'field_type' => 'select',
                        'allow_null' => 0,
                        'load_save_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                    ),
                    array(
                        'key' => 'field_55cb0d7913788',
                        'label' => 'Work Level',
                        'name' => 'work_level',
                        'type' => 'select',
                        'choices' => array(
                            'Member' => 'Member',
                            'Leader' => 'Leader',
                            'Designer' => 'Designer',
                        ),
                        'default_value' => '',
                        'allow_null' => 0,
                        'multiple' => 0,
                    ),
                    array(
                        'key' => 'field_55cb0e2713789',
                        'label' => 'Salary',
                        'name' => 'salary',
                        'type' => 'text',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_55cb0e611378a',
                        'label' => 'Location',
                        'name' => 'location',
                        'type' => 'taxonomy',
                        'taxonomy' => 'job-location',
                        'field_type' => 'select',
                        'allow_null' => 0,
                        'load_save_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                    ),
                    array(
                        'key' => 'field_55cb0e7e1378b',
                        'label' => 'Expire Date',
                        'name' => 'expire_date',
                        'type' => 'date_picker',
                        'date_format' => 'yyyy-mm-dd',
                        'display_format' => 'dd/mm/yy',
                        'first_day' => 1,
                    ),
                    array(
                        'key' => 'field_55cb0ed21378c',
                        'label' => 'Job Description',
                        'name' => 'job_description',
                        'type' => 'wysiwyg',
                        'default_value' => '',
                        'toolbar' => 'full',
                        'media_upload' => 'yes',
                    ),
                    array(
                        'key' => 'field_55cb0ee71378d',
                        'label' => 'Job Requirement',
                        'name' => 'job_requirement',
                        'type' => 'wysiwyg',
                        'default_value' => '',
                        'toolbar' => 'full',
                        'media_upload' => 'yes',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'job',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),
                'options' => array(
                    'position' => 'normal',
                    'layout' => 'no_box',
                    'hide_on_screen' => array(
                    ),
                ),
                'menu_order' => 0,
            ));
        }
    }

    public function register_project_templates($atts) {
        // Create the key used for the themes cache
        $cache_key = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());

        // Retrieve the cache list. 
        // If it doesn't exist, or it's empty prepare an array
        $templates = wp_get_theme()->get_page_templates();
        if (empty($templates)) {
            $templates = array();
        }

        // New cache, therefore remove the old one
        wp_cache_delete($cache_key, 'themes');

        // Now add our template to the list of templates by merging our templates
        // with the existing templates array from the cache.
        $templates = array_merge($templates, $this->templates);

        // Add the modified cache to allow WordPress to pick it up for listing
        // available templates
        wp_cache_add($cache_key, $templates, 'themes', 1800);

        return $atts;
    }

    /**
     * Checks if the template is assigned to the page
     */
    public function view_project_template($template) {

        global $post;

        if (!isset($this->templates[get_post_meta($post->ID, '_wp_page_template', true)])) {

            return $template;
        }

        $file = $this->get_plugin_path() . get_post_meta($post->ID, '_wp_page_template', true);

        // Just to be safe, we check if the file exist first
        if (file_exists($file)) {
            return $file;
        } else {
            echo $file;
        }

        return $template;
    }

}

//add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );

$jobs_management = new jobs_management();
