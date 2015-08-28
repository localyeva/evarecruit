<?php

/**
 * Description of jobs_cpt_acf_settings
 *
 * @author khangld
 */
if (!defined('ABSPATH'))
    exit;

global $job_status;
$job_status = array(
    0 => 'normal',
    1 => 'new',
    2 => 'urgent',
);

class jobs_cpt_acf_settings {

    public function __construct() {
        /* === cpt & acf === */
        add_action('init', array($this, 'cptui_register_my_cpts'));
        add_action('init', array($this, 'cptui_register_my_taxes'));
        add_action('init', array($this, 'my_register_field_group'));
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
            "hierarchical" => true,
            "rewrite" => array("slug" => "job", "with_front" => true),
            "query_var" => true,
            "menu_position" => 26,
            "menu_icon" => WP_PLUGIN_URL . '/jobs-management/images/ad-ico/h16.png',
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
                    array(
                        'key' => 'field_55da913d03fc1',
                        'label' => 'Status',
                        'name' => 'status',
                        'type' => 'radio',
                        'choices' => array(
                            '0' => 'Normal',
                            '1' => 'New',
                            '2' => 'Urgent',
                        ),
                        'other_choice' => 0,
                        'save_other_choice' => 0,
                        'default_value' => '',
                        'layout' => 'horizontal',
                    ),
                    array(
                        'key' => 'field_55cb0d7913788',
                        'label' => 'Work Level',
                        'name' => 'work_level',
                        'type' => 'select',
                        'choices' => array(
                            'Member' => 'Member',
                            'Leader' => 'Leader',
                            'Team Leader/Supervisor' => 'Team Leader/Supervisor',
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

new jobs_cpt_acf_settings();
