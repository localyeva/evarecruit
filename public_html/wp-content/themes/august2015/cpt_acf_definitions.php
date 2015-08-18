<?php

/*
 * This file is custom post type, custom taxonomy and custom fields
 * definition file.
 * 
 * Exported from CPT UI & Advanced Custom Fields
 */

/* ---------------------------------------------------------------------------- */
/* post type definitions */
/* ---------------------------------------------------------------------------- */
add_action('init', 'cptui_register_my_cpts');

function cptui_register_my_cpts() {

    $labels = array(
        "name" => "Service",
        "singular_name" => "Service",
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
        "rewrite" => array("slug" => "service", "with_front" => true),
        "query_var" => true,
        "menu_position" => 26,
        "menu_icon" => get_template_directory_uri() . '/img/ad-ico/h1.png',
        "supports" => array("title"),
    );
    register_post_type("service", $args);

    $labels = array(
        "name" => "Work Environment",
        "singular_name" => "Work Environment",
        "menu_name" => "Environment",
    );

    $args = array(
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_ui" => true,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "work-environment", "with_front" => true),
        "query_var" => true,
        "menu_position" => 27,
        "menu_icon" => get_template_directory_uri() . '/img/ad-ico/h2.png',
        "supports" => array("title"),
    );
    register_post_type("work-environment", $args);

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

    $labels = array(
        "name" => "Stay Connected",
        "singular_name" => "Stay Connected",
    );

    $args = array(
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_ui" => true,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "stay-connected", "with_front" => true),
        "query_var" => true,
        "menu_position" => 29,
        "menu_icon" => get_template_directory_uri() . '/img/ad-ico/h3.png',
        "supports" => array("title"),
    );
    register_post_type("stay-connected", $args);

// End of cptui_register_my_cpts()
}

/* ---------------------------------------------------------------------------- */
/* taxonomy definitions */
/* ---------------------------------------------------------------------------- */
add_action('init', 'cptui_register_my_taxes');

function cptui_register_my_taxes() {

    $labels = array(
        "name" => "Category",
        "label" => "Category",
    );

    $args = array(
        "labels" => $labels,
        "hierarchical" => false,
        "label" => "Category Evironment",
        "show_ui" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'cat-work-environment', 'with_front' => true),
        "show_admin_column" => false,
    );
    register_taxonomy("cat-work-environment", array("work-environment"), $args);

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

// End cptui_register_my_taxes
}

/* ---------------------------------------------------------------------------- */
/* custom fields definitions */
/* ---------------------------------------------------------------------------- */
if (function_exists("register_field_group")) {
    register_field_group(array(
        'id' => 'acf_service',
        'title' => 'Service',
        'fields' => array(
            array(
                'key' => 'field_55d14add95e69',
                'label' => 'Short Description',
                'name' => 'short_description',
                'type' => 'textarea',
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'br',
            ),
            array(
                'key' => 'field_55cb01740b031',
                'label' => 'image',
                'name' => 'image',
                'type' => 'image',
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'service',
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

    register_field_group(array(
        'id' => 'acf_photo-environment',
        'title' => 'Photo Environment',
        'fields' => array(
            array(
                'key' => 'field_55cb079203d6b',
                'label' => 'Main Image',
                'name' => 'main_image',
                'type' => 'image',
                'required' => 1,
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array(
                'key' => 'field_55cb07b103d6c',
                'label' => 'Images',
                'name' => 'images',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_55cb08ce03d6d',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'column_width' => '',
                        'save_format' => 'url',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'work-environment',
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

    register_field_group(array(
        'id' => 'acf_stay-connected',
        'title' => 'Stay Connected',
        'fields' => array(
            array(
                'key' => 'field_55cb1a6e28141',
                'label' => 'Main Locations',
                'name' => 'main_locations',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_55cb1ac128142',
                        'label' => 'Main Location',
                        'name' => 'main_location',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_55cb1ad028143',
                        'label' => 'Address',
                        'name' => 'address',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_55d2b9ae1e9dc',
                        'label' => 'Lat',
                        'name' => 'lat',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'none',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_55d2b9d41e9dd',
                        'label' => 'Lng',
                        'name' => 'lng',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'none',
                        'maxlength' => '',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'stay-connected',
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
