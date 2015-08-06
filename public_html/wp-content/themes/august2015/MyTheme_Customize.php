<?php
/*
 * Author: KhangLe
 * 
 * 
 */

function theme_customize_register($wp_customize) {

    /* ADD SECTION */
    /* TOP */
    $wp_customize->add_section('top', array(
        'title' => __('TOP'),
        'priority' => 20,
    ));

    /* ADD SETTING & CONTROL */
    /* TOP */
    $wp_customize->add_setting('top_image', array(
        'default' => ''
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'top_image_c', array(
        'label' => __('Top Image'),
        'section' => 'top',
        'settings' => 'top_image',
        'priority' => 1,
    )));

    $wp_customize->add_setting('top_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('top_text_c', array(
        'label' => __('Top text'),
        'section' => 'top',
        'settings' => 'top_text',
        'priority' => 1,
        'type' => 'text',
    ));
}

add_action('customize_register', 'theme_customize_register');

//css generate
function generate_css() {
    ?>
    <style>
        .keyvisual.index{
            background: url("<?php echo get_top_image() ?>") no-repeat scroll center center / 100% auto;
        }
    </style>
    <?php
}

add_action('wp_head', 'generate_css');

/* TOP */

function get_top_image() {
    return esc_url(get_theme_mod('top_image'));
}

function get_top_text() {
    return get_theme_mod('top_text');
}