<?php
/*
 * Author: KhangLe
 * 
 * 
 */

function theme_customize_register($wp_customize) {

    /* GENERAL SECTION */
    $wp_customize->add_section('general', array(
        'title' => __('GENERAL'),
        'priority' => 20,
    ));
    
    $wp_customize->add_setting('site_logo', array(
        'default' => ''
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_logo_c', array(
        'label' => __('Logo'),
        'section' => 'general',
        'settings' => 'site_logo',
        'priority' => 1,
    )));
    
    $wp_customize->add_setting('home_top_image', array(
        'default' => ''
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'home_top_image_c', array(
        'label' => __('Home Top Image'),
        'section' => 'general',
        'settings' => 'home_top_image',
        'priority' => 1,
    )));
    
    $wp_customize->add_setting('top_image', array(
        'default' => ''
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'top_image_c', array(
        'label' => __('Top Image'),
        'section' => 'general',
        'settings' => 'top_image',
        'priority' => 1,
    )));

    $wp_customize->add_setting('intro_1_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('intro_1_text_c', array(
        'label' => __('Intro 1 Text'),
        'section' => 'general',
        'settings' => 'intro_1_text',
        'priority' => 1,
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('intro_2_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('intro_2_text_c', array(
        'label' => __('Intro 2 Text'),
        'section' => 'general',
        'settings' => 'intro_2_text',
        'priority' => 1,
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('intro_3_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('intro_3_text_c', array(
        'label' => __('Intro 3 Text'),
        'section' => 'general',
        'settings' => 'intro_3_text',
        'priority' => 1,
        'type' => 'text',
    ));
    
     /* HOME PAGE SECTION */
    $wp_customize->add_section('home', array(
        'title' => __('HOME PAGE'),
        'priority' => 20,
    ));
    
    $wp_customize->add_setting('home_top_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('intro_2_text_c', array(
        'label' => __('Top Text'),
        'section' => 'home',
        'settings' => 'home_top_text',
        'priority' => 1,
        'type' => 'text',
    ));
    
    /* ABOUT US */    
    $wp_customize->add_setting('part_about_us_title_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('part_about_us_title_text_c', array(
        'label' => __('Part About Us Title Text'),
        'section' => 'home',
        'settings' => 'part_about_us_title_text',
        'priority' => 1,
        'type' => 'text',
    ));
    $wp_customize->add_setting('part_about_us_image', array(
        'default' => ''
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'part_about_us_image_c', array(
        'label' => __('Part About Us Image'),
        'section' => 'home',
        'settings' => 'part_about_us_image',
        'priority' => 1,
    )));    
}

add_action('customize_register', 'theme_customize_register');

//css generate
function generate_css() {
    ?>
    <style>
        .header-banner{
            background: url("<?php echo get_home_top_image() ?>");
        }
    </style>
    <?php
}

add_action('wp_head', 'generate_css');

/* GENERAL */
function get_site_logo() {
    return esc_url(get_theme_mod('site_logo'));
}

function get_home_top_image() {
    return esc_url(get_theme_mod('home_top_image'));
}

function get_top_image() {
    return esc_url(get_theme_mod('top_image'));
}

function get_intro_1_text() {
    return get_theme_mod('intro_1_text');
}
function get_intro_2_text() {
    return get_theme_mod('intro_2_text');
}
function get_intro_3_text() {
    return get_theme_mod('intro_3_text');
}
function get_home_top_text() {
    return get_theme_mod('home_top_text');
}
function get_part_about_us_title_text() {
    return get_theme_mod('part_about_us_title_text');
}
function get_part_about_us_image() {
    return esc_url(get_theme_mod('part_about_us_image'));
}

