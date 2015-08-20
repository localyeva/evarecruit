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

class jobs {

    protected $pluginPath;
    protected $pluginUrl;

    public function __construct() {

        // set Plugin Path
        $this->pluginPath = dirname(__FILE__);

        // Set plugin Url
        $this->pluginUrl = WP_PLUGIN_URL . '/jobs';

//        register_activation_hook(__FILE__, array($this, ''));
        add_action('init', array($this, 'cptui_register_my_cpts'));
        add_action('init', array($this, 'cptui_register_my_taxes'));
        add_action('init', array($this, 'my_register_field_group'));
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
            "menu_icon" => get_template_directory_uri() . '/img/ad-ico/h3.png',
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

}

$jobs = new jobs();
