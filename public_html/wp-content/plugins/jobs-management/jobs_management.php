<?php

/**
  Plugin Name: Jobs Management
  Plugin URI:
  Description: This plugin allows you mangage jobs through (cpt acf template)
  Version:     1.0
  Author:      Khang LD
  Author URI:
  License:
  License URI:
  Domain Path:
  Text Domain:
 */
/**
 * This plugin allows you add cpt acf for jobs management (Exported from CPT UI & Advanced Custom Field)
 * 
 * This plugin allows you to include templates with your plugin so that they can
 * be added with any theme.
 */
if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

require_once 'lib/Twig/Autoloader.php';

class jobs_management {

    protected $plugin_path;
    protected $plugin_url;

    /**
     * A Unique Identifier
     */
    protected $plugin_slug = 'jobs-management';

    /**
     * A reference to an instance of this class.
     */
    private static $instance;

    /**
     * The array of templates that this plugin tracks.
     */
    protected $templates;
    protected $part_templates;

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

        add_shortcode('jobs-part', array($this, 'get_part_of_template'));

        $this->part_templates = array(
            'form-list' => 'jobs-form-list.php'
        );

        add_filter('template_include', array($this, 'register_part_template'));

        // adding support for theme templates to be merged and shown in dropdown
        $templates = wp_get_theme()->get_page_templates();
        $templates = array_merge($templates, $this->templates);

        /* === cpt & acf === */
        add_action('init', array($this, 'cptui_register_my_cpts'));
        add_action('init', array($this, 'cptui_register_my_taxes'));
        add_action('init', array($this, 'my_register_field_group'));
    }

    /**
     * Retrieves and returns the slug of this plugin. This function should be called on an instance
     * of the plugin outside of this class.
     *
     * @return  string    The plugin's slug used in the locale.
     * @version	1.0.0
     * @since	1.0.0
     */
    public function get_plugin_slug() {
        return $this->plugin_slug;
    }

    public function get_plugin_path() {
        // set Plugin Path
        $this->plugin_path = plugin_dir_path(__FILE__);
        return $this->plugin_path;
    }

    public function get_plugin_url() {
        // Set plugin Url
        $this->plugin_url = WP_PLUGIN_URL . '/' . $this->get_plugin_slug();
        return $this->plugin_url;
    }

    public function get_widget_slug() {
        return $this->widget_slug;
    }

    /* ---------------------------------------------------------------------------- */
    /* post type definitions */
    /* ---------------------------------------------------------------------------- */

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

    /* ---------------------------------------------------------------------------- */
    /* taxonomy definitions */
    /* ---------------------------------------------------------------------------- */

    public function cptui_register_my_taxes() {
        $labels = array(
            "name" => "Job Locations",
            "label" => "Job Locations",
        );

        $args = array(
            "labels" => $labels,
            "hierarchical" => true,
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
            "hierarchical" => true,
            "label" => "Job Positions",
            "show_ui" => true,
            "query_var" => true,
            "rewrite" => array('slug' => 'job-position', 'with_front' => true),
            "show_admin_column" => false,
        );
        register_taxonomy("job-position", array("job"), $args);
    }

    /* ---------------------------------------------------------------------------- */
    /* custom fields definitions */
    /* ---------------------------------------------------------------------------- */

    public function my_register_field_group() {
        if (function_exists("register_field_group")) {
            register_field_group(array(
                'id' => 'acf_job',
                'title' => 'Job',
                'fields' => array(
//                    array(
//                        'key' => 'field_55cb0d1a13787',
//                        'label' => 'Position',
//                        'name' => 'position',
//                        'type' => 'taxonomy',
//                        'taxonomy' => 'job-position',
//                        'field_type' => 'select',
//                        'allow_null' => 0,
//                        'load_save_terms' => 0,
//                        'return_format' => 'id',
//                        'multiple' => 0,
//                    ),
                    array(
                        'key' => 'field_55cb0d7913788',
                        'label' => 'Work Level',
                        'name' => 'work_level',
                        'type' => 'select',
                        'choices' => array(
                            'Member' => 'Member',
                            'Leader' => 'Leader',
                            'Designer' => 'Designer',
                            'Supervisor' => 'Supervisor',
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
//                    array(
//                        'key' => 'field_55cb0e611378a',
//                        'label' => 'Location',
//                        'name' => 'location',
//                        'type' => 'taxonomy',
//                        'taxonomy' => 'job-location',
//                        'field_type' => 'select',
//                        'allow_null' => 0,
//                        'load_save_terms' => 0,
//                        'return_format' => 'id',
//                        'multiple' => 0,
//                    ),
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

    /**
     * Adds our template to the pages cache in order to trick WordPress
     * into thinking the template file exists where it doens't really exist.
     *
     * @param   array    $atts    The attributes for the page attributes dropdown
     * @return  array    $atts    The attributes for the page attributes dropdown
     * @verison	1.0.0
     * @since	1.0.0
     */
    public function register_project_templates($atts) {
        // Create the key used for the themes cache
        $cache_key = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());

        // Retrieve the cache list. 
        // If it doesn't exist, or it's empty prepare an array
        // $templates = wp_get_theme()->get_page_templates();
        $templates = wp_cache_get($cache_key, 'themes');
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
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    public function view_project_template($template) {

        global $post;

        // If no posts found, return to
        // avoid "Trying to get property of non-object" error
        if (!isset($post))
            return $template;

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

    public function register_part_template($template) {
        // Post ID
        $post_id = get_the_ID();

        // For all other CPT
        if (get_post_type($post_id) != 'job') {
            return $template;
        }

        // Else use custom template
        if (is_single()) {
            return $this->view_part_template_hierachy('single');
        } else {
            return $this->view_part_template($template);
        }
    }

    public function view_part_template_hierachy($template) {
        // Get the tempate slug
        $template_slug = rtrim($template, '.php');
        $template = $template_slug . '.php';
        
        // Check if a custom template exists in the theme folder, if not, load the plugin template file
        if ($theme_file = locate_template(array('template/' . $template))){
            $file = $theme_file;
        } else {
//            $file = 
        }
    }

    public function view_part_template($template) {
        
    }

    public function get_part_of_template($type) {
        extract(shortcode_atts(array(
            'type' => 'type'
                        ), $type));
        //
        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem($this->get_plugin_path() . 'templates');

        $twig = new Twig_Environment($loader);

        $template = '';

        switch ($type) {
            case 'form-list':
                $load = $twig->loadTemplate($this->part_templates['form-list']);

                // get Terms
                $args = array(
                    'orderby' => 'count',
                    'hide_empty' => 0
                );
                $terms = get_terms('job-position', $args);

                print_r($terms);

                $template = $load->render(array());
                break;
        }

        return $template;
    }

}

//add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );

$jobs_management = new jobs_management();
