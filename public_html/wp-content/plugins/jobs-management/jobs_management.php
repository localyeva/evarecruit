<?php

/**
  Plugin Name: Jobs Management
  Plugin URI:
  Description: This plugin allows you mangage jobs through (cpt acf template)
  Version:     1.0
  Author:      Le Duong Khang
  Author URI:  mailto:leduongkhang@gmail.com
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

require_once 'lib/includes/my-functions.php';
require_once 'lib/includes/jobs_cpt_acf_settings.php';
require_once 'lib/includes/jobs-plugin-admin.php';
require_once 'lib/includes/jobs-setting-mail.php';
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

        // Register pages jobs & search
        add_action('init', array($this, 'register_pages'));
        add_action('init', array($this, 'register_table'));

        // Load frontend JS & CSS
        add_action('wp_enqueue_scripts', array($this, 'register_styles'), 10);
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'), 10);

        // Load admin JS & CSS
//        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'), 10, 1);
//        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_styles'), 10, 1);
        // Hooks a function to a specific filter action.
        // applied to the list of columns to print on the manage posts screen.
        add_filter('manage_edit-job_sortable_columns', array($this, 'sort_post_column'));
        add_filter('manage_job_posts_columns', array($this, 'add_post_column'));
        // Hooks a function to a specific action. 
        // allows you to add custom columns to the list post/custom post type pages.
        // '10' default: specify the function's priority.
        // and '2' is the number of the functions' arguments.
        add_action('manage_job_posts_custom_column', array($this, 'post_custom_column'), 10, 2);


        // Add a filter to the attributes metabox to inject template into the cache.
        add_filter('page_attributes_dropdown_pages_args', array($this, 'register_project_templates'), 10, 1);

        // Add a filter to the save post to inject out template into the page cache
        add_filter('wp_insert_post_data', array($this, 'register_project_templates'), 10, 1);

        // Add a filter to the template include to determine if the page has our 
        // template assigned and return it's path
        add_filter('template_include', array($this, 'view_project_template'), 10, 1);

        // Add your templates to this array.
        $this->templates = array(
            'templates/jobs.php' => 'Jobs',
            'templates/jobs-search.php' => 'Jobs Search',
            'templates/jobs-apply.php' => 'Jobs Apply',
        );

        // Add short code
        add_shortcode('jobs-part', array($this, 'get_part_of_template'), 10, 1);

        add_filter('archive_template', array($this, 'get_custom_post_type_archive_template'), 10, 1);
        add_filter('single_template', array($this, 'get_custom_post_type_single_template'), 10, 1);
        add_filter('taxonomy_template', array($this, 'get_custom_taxonomy_template'), 10, 1);

        //
        add_action('template_redirect', array($this, 'download_cv'));
        add_action('template_redirect', array($this, 'api_get_applied_jobs'));
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
            'type' => 'type',
                        ), $type));
        //
        ob_start();
        $template = new PW_Template_Loader();

        switch ($type) {
            case 'form-list':
                $template->get_template_part('jobs-form-list');
                break;
            case 'find-ur-dream-jobs':
                $template->get_template_part('jobs-find-ur-dream-jobs');
                break;
            case 'apply-ur-resume':
                $template->get_template_part('jobs-apply-ur-resume');
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
    public function get_custom_post_type_archive_template($archive_template) {
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
    public function get_custom_post_type_single_template($single_template) {
        global $wp_query, $post;

        $term = get_the_terms($post->ID, 'lab');

        if (isset($term) && $term != FALSE) {
            if ($term[0]->taxonomy == 'lab' && $post->post_type == 'job') {
                $single_template = $this->get_plugin_template_path() . 'taxonomy-lab-job.php';
            }
            //
        } else {
            if ($post->post_type == 'job') {
                $single_template = $this->get_plugin_template_path() . 'single-job.php';
            }
        }

        return $single_template;
    }

    /**
     * 
     * @param type $taxonomy_template
     * 
     * @version	1.0.0
     * @since	1.0.0
     */
    public function get_custom_taxonomy_template($taxonomy_template) {

        global $wp_query;

        if (get_query_var('lab') != '') {
            $taxonomy_template = $this->get_plugin_template_path() . 'taxonomy-lab-jobs.php';
        }

        return $taxonomy_template;
    }

    /**
     * Create Page if return NULL
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    public function create_page_if_null($post = NULL) {
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
    public function register_pages() {

        // CV download page
        $download_cv = array(
            'post_name' => 'download',
            'post_title' => 'Download',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => '',
        );
        $download_cv_page_id = $this->create_page_if_null($download_cv);

        // Apply Job
        $apply_job = array(
            'post_name' => 'jobs-apply',
            'post_title' => 'Jobs-Apply',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'templates/jobs-apply.php',
        );
        $apply_job_id = $this->create_page_if_null($apply_job);

        // Jobs Page
        // jobs
        $post_job = array(
            'post_name' => 'jobs',
            'post_title' => 'Jobs',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'templates/jobs.php',
        );
        $page_id = $this->create_page_if_null($post_job);

        // Search Page
        // jobs/search
        $post_job_search = array(
            'post_name' => 'search',
            'post_title' => 'Search',
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_parent' => $page_id,
            'page_template' => 'templates/jobs-search.php',
        );
        $this->create_page_if_null($post_job_search);
    }

    /**
     * Load frontend CSS.
     * @access  public
     * @since   1.0.0
     * @return void
     */
    public function register_styles() {
        wp_register_style('css-jobs-frontend', $this->get_plugin_url() . '/assets/css/job.css', array(), '1.0');
        wp_enqueue_style('css-jobs-frontend');
        //
//        wp_register_style('css-exvalidation-frontend', $this->get_plugin_url() . '/assets/css/exvalidation.css', array(), '1.0');
//        wp_enqueue_style('css-exvalidation-frontend');
    }

    /**
     * Load frontend Javascript.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function register_scripts() {
        //
//        wp_register_script('js-validate-frontend', $this->get_plugin_url() . '/assets/js/jquery.validate.min.js', array('jquery'), '1.14.0', TRUE);
//        wp_enqueue_script('js-validate-frontend');
//        wp_register_script('js-validate-popover-frontend', $this->get_plugin_url() . '/assets/js/jquery.validate.bootstrap.popover.min.js', array('jquery'), '1.6.3', TRUE);
//        wp_enqueue_script('js-validate-popover-frontend');
//        wp_register_script('js-additional-frontend', $this->get_plugin_url() . '/assets/js/additional-methods.min.js', array('jquery'), '1.14.0', TRUE);
//        wp_enqueue_script('js-additional-frontend');

        wp_register_script('js-job-plugin-frontend', $this->get_plugin_url() . '/assets/js/job-plugin.js', array('jquery'), '1.0.0', TRUE);
        wp_enqueue_script('js-job-plugin-frontend');

        //
//        wp_register_script('js-easing-frontend', $this->get_plugin_url() . '/assets/js/jquery.easing.js', array('jquery'), '1.3', TRUE);
//        wp_enqueue_script('js-easing-frontend');
//        wp_register_script('js-jQselectable-frontend', $this->get_plugin_url() . '/assets/js/jQselectable.js', array('jquery'), '1.3.2', TRUE);
//        wp_enqueue_script('js-jQselectable-frontend');
//        wp_register_script('js-exvalidation-frontend', $this->get_plugin_url() . '/assets/js/exvalidation.min.js', array('jquery'), '1.3.3', TRUE);
//        wp_enqueue_script('js-exvalidation-frontend');
//        wp_register_script('js-exchecker-frontend', $this->get_plugin_url() . '/assets/js/exchecker-ja.min.js', array('jquery'), '1.1', TRUE);
//        wp_enqueue_script('js-exchecker-frontend');
        //
        wp_register_script('js-jobs-frontend', $this->get_plugin_url() . '/assets/js/job.js', array('jquery'), '1.0', TRUE);
        wp_enqueue_script('js-jobs-frontend');
        $dataToBePassed = array(
            'plugin_url' => $this->get_plugin_url(),
        );
        wp_localize_script('js-jobs-frontend', 'jobvars', $dataToBePassed);
    }

    /**
     * 
     * @param type $post_id
     * @return type
     */
    public function get_job_views($post_id) {
        $count_key = 'job_views';
        // returns values of the custom field with specified key
        $count = get_post_meta($post_id, $count_key, true);
        return $count;
    }

    /**
     * 
     * Add sortable columns
     * 
     * @param type $columns
     * @return type
     */
    public function sort_post_column($columns) {
        return array_merge($columns, array(
//            'location' => __('Location'),
        ));
    }

    /**
     * 
     * Add new columns
     * 
     * @param array $columns
     * @return type
     */
    public function add_post_column($columns) {

        return array_merge($columns, array(
            'post_views' => __('Views'),
            'status' => __('Status'),
            'location' => __('Location'),
            'position' => __('Position'),
            'lab' => __('Lab'),
        ));
    }

    /**
     * 
     * @param type $column
     * @param type $id
     */
    public function post_custom_column($column, $post_id) {

        switch ($column) {
            case 'post_views':
                echo $this->get_job_views(get_the_ID());
                break;
            case 'status':
                global $job_status;
                $status = get_field('status', get_the_ID());
                echo ucwords($job_status[$status]);
                break;
            case 'location':
                $term = get_the_terms(get_the_ID(), 'job-location');
                if (isset($term) && $term != FALSE) {
                    echo $term[0]->name;
                }
                break;
            case 'position':
                $term = get_the_terms(get_the_ID(), 'job-position');
                if (isset($term) && $term != FALSE) {
                    echo $term[0]->name;
                }
                break;
            case 'lab':
                $term = get_the_terms(get_the_ID(), 'lab');
                if (isset($term) && $term != FALSE) {
                    echo $term[0]->name;
                }
                break;
        }
    }

    /**
     * 
     * @global type $wpdb
     */
    public function register_table() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'jobs_management';

        $sql = "CREATE TABLE $table_name (
            id int(12) NOT NULL AUTO_INCREMENT,
            apply_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            fullname varchar(60) DEFAULT '' NOT NULL,
            email varchar(255) DEFAULT '' NOT NULL,
            phone_number varchar(15) DEFAULT '' NOT NULL,
            gender varchar(1) DEFAULT '-',
            attach_file varchar(255) NOT NULL,
            download_link varchar(255) NOT NULL,
            job_id int(12) NULL,
            job_title varchar(255) NULL,
            job_slug varchar(255) NULL,
            job_position varchar(32) NULL,
            job_level varchar(32) NULL,
            job_salary varchar(32) NULL,
            job_location varchar(32) NULL,
            job_expired varchar(32) NULL,
            UNIQUE KEY id (id)
            ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }

    /**
     * 
     */
    function download_cv() {
        global $wp_query;
        global $wpdb;
        //
        if (isset($wp_query->query['pagename'])) {
            if ($wp_query->query['pagename'] == 'download') {
                if (current_user_can('manage_options')) {
                    //
                    if (isset($_GET['attach'])) {
                        if (is_numeric($_GET['attach'])) {
                            $id = $_GET['attach'];
                            //
                            $table_name = $wpdb->prefix . 'jobs_management';
                            $list_candidates = $wpdb->get_results(
                                    ""
                                    . " SELECT * "
                                    . " FROM  $table_name "
                                    . " WHERE id =  $id "
                            );
                            $post = $list_candidates[0];
                            //
                            $attach_file = $post->attach_file;
                            $ext = substr(strrchr($attach_file, '.'), 1);
                            $clean_name = sanitize_title($post->fullname . '-cv') . '.' . $ext;
                            //
                            $parse = parse_url($attach_file);
                            $attach_file_path = WP_CONTENT_DIR . str_replace('/wp-content', '', $parse['path']);
                            //
                            header('Content-Description: File Transfer');
                            header('Content-Type: application/force-download');
                            header("Content-Disposition: attachment; filename=\"" . $clean_name . "\";");
                            header('Content-Transfer-Encoding: binary');
                            header('Expires: 0');
                            header('Cache-Control: must-revalidate');
                            header('Pragma: public');
                            header('Content-Length: ' . filesize($attach_file_path));
                            ob_clean();
                            flush();
                            readfile($attach_file_path);
                            exit();
                        }
                    }
                }
            }
        }
    }

    /**
     * 
     * @global type $wp_query
     * @global type $wpdb
     */
    public function api_download_cv() {
        global $wp_query;
        global $wpdb;
        //
        var_dump($wp_query->query['pagename']);
                exit();
                
        if (isset($wp_query->query['pagename'])) {
            if ($wp_query->query['pagename'] == 'api/cv') {
                if (isset($_GET['attach'])) {
                    if (is_numeric($_GET['attach'])) {
                        $id = $_GET['attach'];
                        //
                        $table_name = $wpdb->prefix . 'jobs_management';
                        $list_candidates = $wpdb->get_results(
                                ""
                                . " SELECT * "
                                . " FROM  $table_name "
                                . " WHERE id =  $id "
                        );
                        $post = $list_candidates[0];
                        //
                        $attach_file = $post->attach_file;
                        $ext = substr(strrchr($attach_file, '.'), 1);
                        $clean_name = sanitize_title($post->fullname . '-cv') . '.' . $ext;
                        //
                        $parse = parse_url($attach_file);
                        $attach_file_path = WP_CONTENT_DIR . str_replace('/wp-content', '', $parse['path']);
                        //
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/force-download');
                        header("Content-Disposition: attachment; filename=\"" . $clean_name . "\";");
                        header('Content-Transfer-Encoding: binary');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($attach_file_path));
                        ob_clean();
                        flush();
                        readfile($attach_file_path);
                        exit();
                    }
                }
            }
        }
    }
    
    function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') == $date;
    }

    /**
     * 
     * @global type $wp_query
     * @global type $wpdb
     */
    public function api_get_applied_jobs() {
        global $wp_query;
        global $wpdb;
        //
        if (isset($wp_query->query['pagename'])) {
            /**
             * get applied jobs data
             */
            if ($wp_query->query['pagename'] == 'api/get-applied-jobs') {
                $table_name = $wpdb->prefix . 'jobs_management';
                $from = $_GET['from'];
                $to = empty($_GET['to']) ? null : $_GET['to'];
                if(!$this->validateDate($from) || (!empty($to) && !$this->validateDate($from))){
                    echo json_encode(array('error'=>1, 'message'=>'invalid date format. Date format must be YYYY-m-d'));
                    exit;
                }
                if (!empty($to) && !$this->validateDate($from)) {
                    $qstr .= " AND apply_date <=" . '"' . $to . '"';
                }
                
                $qstr = ""
                        . " SELECT * "
                        . " FROM  $table_name "
                        . " WHERE apply_date >= " . '"' . $from . '"';
                if (!empty($to)) {
                    $qstr .= " AND apply_date <=" . '"' . $to . '"';
                }
                $list_jobs = $wpdb->get_results($qstr);

                echo json_encode(array('data'=>$list_jobs));
            }
            /**
             * download cv
             */
            if ($wp_query->query['pagename'] == 'api/cv') {
                if (isset($_GET['attach'])) {
                    if (is_numeric($_GET['attach'])) {
                        $id = $_GET['attach'];
                        //
                        $table_name = $wpdb->prefix . 'jobs_management';
                        $list_candidates = $wpdb->get_results(
                                ""
                                . " SELECT * "
                                . " FROM  $table_name "
                                . " WHERE id =  $id "
                        );
                        $post = $list_candidates[0];
                        //
                        $attach_file = $post->attach_file;
                        $ext = substr(strrchr($attach_file, '.'), 1);
                        $clean_name = sanitize_title($post->fullname . '-cv') . '.' . $ext;
                        //
                        $parse = parse_url($attach_file);
                        $attach_file_path = WP_CONTENT_DIR . str_replace('/wp-content', '', $parse['path']);
                        //
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/force-download');
                        header("Content-Disposition: attachment; filename=\"" . $clean_name . "\";");
                        header('Content-Transfer-Encoding: binary');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($attach_file_path));
                        ob_clean();
                        flush();
                        readfile($attach_file_path);
                        exit();
                    }
                }
            }
            //        
            exit();
        }
    }
}

//add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );

$jobs_management = new jobs_management();
