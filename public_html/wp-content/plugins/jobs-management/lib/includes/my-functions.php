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

function get_lab_info() {
    global $jola_settings;
    
    $term = get_the_terms(get_the_ID(), 'lab');
    $t_id = $term[0]->term_id;
    $lab_info = array();
            
    foreach ($jola_settings as $field => $data){
        $key = $data['id'];
        $tax_id = $key . '-' . $t_id;
        $tax_meta = 'jola_' . $tax_id;
        //
        $info = get_option($tax_meta);
        $lab_info[$key] = stripcslashes($info[$tax_id]);
    }
    
    return $lab_info;
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
