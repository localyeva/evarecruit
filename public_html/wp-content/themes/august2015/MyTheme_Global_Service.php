<?php
/*
 * Author: KhangLe
 * 
 * 
 */

function theme_customize_register_global_service($wp_customize) {

    /* ADD SECTION */
    /* TOP */
    $wp_customize->add_section('top', array(
        'title' => __('TOP'),
        'priority' => 20,
    ));

    /* ADD SETTING & CONTROL */
    /* TOP */
    $wp_customize->add_setting('global_top_image', array(
        'default' => ''
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'top_image_c', array(
        'label' => __('Top Image'),
        'section' => 'top',
        'settings' => 'top_image',
        'priority' => 1,
    )));

    $wp_customize->add_setting('intro_4_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('intro_4_text_c', array(
        'label' => __('Intro 4 Text'),
        'section' => 'general',
        'settings' => 'intro_4_text',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('intro_5_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('intro_5_text_c', array(
        'label' => __('Intro 5 Text'),
        'section' => 'general',
        'settings' => 'intro_5_text',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('intro_6_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('intro_6_text_c', array(
        'label' => __('Intro 6 Text'),
        'section' => 'general',
        'settings' => 'intro_6_text',
        'priority' => 1,
        'type' => 'text',
    ));
}

add_action('customize_register', 'theme_customize_register_global_service');

//css generate
function generate_global_service_css() {
    ?>
    <style>
        .keyvisual.index{
            background: url("<?php echo get_global_top_image() ?>") no-repeat scroll center center / 100% auto;
        }
    </style>
    <?php
}

//add_action('wp_head', 'generate_global_service_css');

/* TOP */

function get_global_top_image() {
    return esc_url(get_theme_mod('global_top_image'));
}

function get_intro_4_text() {
    return get_theme_mod('intro_4_text');
}

function get_intro_5_text() {
    return get_theme_mod('intro_5_text');
}

function get_intro_6_text() {
    return get_theme_mod('intro_6_text');
}