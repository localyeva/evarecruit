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

add_action('wp_head', 'generate_global_service_css');

/* TOP */

function get_global_top_image() {
    return esc_url(get_theme_mod('global_top_image'));
}
