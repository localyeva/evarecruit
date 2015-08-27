<?php
/*
 * Author: KhangLe
 * 
 * 
 */

function staff_detail_theme_customize_register($wp_customize) {   
    
    /* STAFF DETAIL SECTION*/    
    $wp_customize->add_section('staff_detail', array(
        'title' => __('STAFF DETAIL PAGE'),
        'priority' => 20,
    ));
    $wp_customize->add_setting('staff_detail_top_image', array(
        'default' => ''
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'staff_detail_top_image_c', array(
        'label' => __('Staff Detail Top Image'),
        'section' => 'staff_detail',
        'settings' => 'staff_detail_top_image',
        'priority' => 1,
    )));
    
    $wp_customize->add_setting('staff_detail_thought_title_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('staff_detail_thought_title_text_c', array(
        'label' => __('Staff Detail Thought Title Text'),
        'section' => 'staff_detail',
        'settings' => 'staff_detail_thought_title_text',
        'priority' => 1,
        'type' => 'text',
    ));
}

add_action('customize_register', 'staff_detail_theme_customize_register');

//css generate
function staff_detail_generate_css() {
    ?>
    <style>
        #detail-staff .header-banner{
            background: url("<?php echo get_staff_detail_top_image() ?>");
        }
    </style>
    <?php
}

add_action('wp_head', 'staff_detail_generate_css');

function get_staff_detail_top_image() {
    return esc_url(get_theme_mod('staff_detail_top_image'));
}

function get_staff_detail_thought_title_text() {
    return get_theme_mod('staff_detail_thought_title_text');
}
