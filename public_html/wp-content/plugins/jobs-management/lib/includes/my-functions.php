<?php

/**
 * 
 * @param type $option_name
 * @return type
 */
function job_get_option($option_name) {
    $data = get_option($option_name);
    if (isset($data[$option_name])) {
        //
        return $data[$option_name];
    }
    return NULL;
}

function get_lab_images() {
    $term = get_the_terms(get_the_ID(), 'lab');
    if (function_exists('get_all_wp_terms_meta')) {
        $arrayMetaList = get_all_wp_terms_meta($term[0]->term_id);
    }
    
    $images = array();
    foreach ($arrayMetaList as $key => $value) {
        $images[$key] = $value[0];
        // get extension
        $ext = substr(strrchr($images[$key], '.'), 1);
        $images['thumbnail-' . $key] = str_replace('.' . $ext, '-150x150.' . $ext, $value[0]);
        $images['medium-' . $key] = str_replace('.' . $ext, '-225x300.' . $ext, $value[0]);
        $images['attachment-' . $key] = wp_get_attachment_url($term[0]->term_id);
    }

    return $images;
}

/* Filter Tiny MCE Default Settings */
//add_filter('tiny_mce_before_init', 'my_switch_tinymce_p_br');

/**
 * Switch Default Behaviour in TinyMCE to use "<br>"
 * On Enter instead of "<p>"
 * 
 * @link https://shellcreeper.com/?p=1041
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/tiny_mce_before_init
 * @link http://www.tinymce.com/wiki.php/Configuration:forced_root_block
 */
function my_switch_tinymce_p_br($settings) {
    $settings['forced_root_block'] = false;
    return $settings;
}

/**
 * Returns a inline CSS passage that resizes
 * wp_editor()'s width and height.
 *
 * @param int $width
 * @param int $height
 * 
 * usage: Call the function  wp_editor_resize($width, $height); before wp_editor()  is being called.
 * 
 */
function wp_editor_resize($width = 0, $height = 0) {
    $style = '<style type="text/css">';
    if ($width) {
        $style .= '.wp-editor-container { width:' . $width . 'px !important; }';
    }
    if ($height) {
        $style .= '.wp-editor-area { height:' . $height . 'px !important; }';
    }
    $style .= "</style>";
    echo $style;
}

/**
 * 
 */
add_action('admin_head', 'my_admin_custom_styles');

function my_admin_custom_styles() {
    $output_css = '<style type="text/css">
        .column-post_views{ width: 70px; }
        .column-status{ width: 100px; }
        .column-location{ width: 150px; }
        .column-position{ width: 150px; }
    </style>';
    echo $output_css;
}
