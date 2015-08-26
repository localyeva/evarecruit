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


require_once 'lib/includes/jobs_cpt_acf_settings.php';
require_once 'lib/class-gamajo-template-loader.php';

/**
 * Template loader for Plugin.
 *
 * Only need to specify class properties here.
 *
 */
define('PW_SAMPLE_PLUGIN_DIR', plugin_dir_path(__FILE__));

class PW_Template_Loader extends Gamajo_Template_Loader {

    /**
     * Prefix for filter names.
     *
     * @since 1.0.0
     * @type string
     */
    protected $filter_prefix = 'pw';

    /**
     * Directory name where custom templates for this plugin should be found in the theme.
     *
     * @since 1.0.0
     * @type string
     */
    protected $theme_template_directory = 'templates';

    /**
     * Reference to the root directory path of this plugin.
     *
     * @since 1.0.0
     * @type string
     */
    protected $plugin_directory = PW_SAMPLE_PLUGIN_DIR;

}

class jobs_management extends PW_Template_Loader {

    protected $plugin_path;
    protected $plugin_url;

    /**
     * A Unique Identifier
     */
    protected $plugin_slug = 'jobs-management';
    protected $plugin_template = 'templates';

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

        add_action('init', array($this, 'register_pages'));

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
            'templates/jobs-search.php' => 'Jobs Search',
        );

        // Add short code
        add_shortcode('jobs-part', array($this, 'get_part_of_template'));

        add_filter('archive_template', array($this, 'get_custom_post_type_archive_template'));
        add_filter('single_template', array($this, 'get_custom_post_type_single_template'));
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

    public function get_plugin_template_path() {
        return $this->get_plugin_path() . '/' . $this->plugin_template . '/';
    }

    public function get_plugin_url() {
        // Set plugin Url
        $this->plugin_url = WP_PLUGIN_URL . '/' . $this->get_plugin_slug();
        return $this->plugin_url;
    }

    public function get_widget_slug() {
        return $this->widget_slug;
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
        $templates = wp_get_theme()->get_page_templates();
//        $templates = wp_cache_get($cache_key, 'themes');
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

    /**
     * Add Short Code
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    public function get_part_of_template($type) {
        extract(shortcode_atts(array(
            'type' => 'type'
                        ), $type));
        //
        ob_start();
        $template = new PW_Template_Loader();

        switch ($type) {
            case 'form-list':
                $template->get_template_part('jobs-form-list');
                break;
        }

        return ob_get_clean();
    }

    /**
     * Register archive template
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    function get_custom_post_type_archive_template($archive_template) {
        global $wp_query, $post;

        if (is_post_type_archive('job')) {
            $archive_template = $this->get_plugin_path() . 'archive-job.php';
        }
        return $archive_template;
    }

    /**
     * Register archive template
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    function get_custom_post_type_single_template($single_template) {
        global $wp_query, $post;

        if ($post->post_type == 'job') {
            $single_template = $this->get_plugin_template_path() . 'single-job.php';
        }
        return $single_template;
    }

    /**
     * Create Page if return NULL
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    function create_page_if_null($post = NULL) {
        if (get_page_by_title($post['post_name']) == NULL) {
            // create_pages_fly($target);
            // insert page and save the id
            $post_id = wp_insert_post($post, false);

            // save the id in the database
            update_option($post['post_name'], $post_id);

            // set the template
            update_post_meta($post_id, '_wp_page_template', $post['page_template']);

            return $post_id;
        }
    }

    /**
     * Register Pages
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    function register_pages() {

        // Jobs Page
        // jobs
        $post_job = array(
            'post_name' => 'jobs',
            'post_title' => 'Jobs',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'templates/jobs.php',
        );
        $this->create_page_if_null($post_job);

        // Search Page
        // jobs/search
        $post_job_search = array(
            'post_name' => 'search',
            'post_title' => 'Search',
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_category' => 'jobs',
            'page_template' => 'templates/jobs-search.php',
        );
        $this->create_page_if_null($post_job_search);
    }

}

//add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );

$jobs_management = new jobs_management();
