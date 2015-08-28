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

    /* OUR SERVICE */
    $wp_customize->add_setting('part_our_service_title_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('part_our_service_title_text_c', array(
        'label' => __('Part Our Service Title Text'),
        'section' => 'home',
        'settings' => 'part_our_service_title_text',
        'priority' => 1,
        'type' => 'text',
    ));

    /* WORK ENVIROMENT */
    $wp_customize->add_setting('part_work_environment_title_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('part_work_environment_title_text_c', array(
        'label' => __('Part Work Environment Title Text'),
        'section' => 'home',
        'settings' => 'part_work_environment_title_text',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('part_work_environment_movie_title_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('part_work_environment_movie_title_text_c', array(
        'label' => __('Part Work Environment Movie Title Text'),
        'section' => 'home',
        'settings' => 'part_work_environment_movie_title_text',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('part_work_environment_movie_desc_text', array(
        'default' => '',
    ));
    $wp_customize->add_control('part_work_environment_movie_desc_text_c', array(
        'label' => __('Part Work Environment Movie Description Text'),
        'section' => 'home',
        'settings' => 'part_work_environment_movie_desc_text',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('part_work_environment_movie_link', array(
        'default' => '',
    ));
    $wp_customize->add_control('part_work_environment_movie_link_c', array(
        'label' => __('Part Work Environment Movie Link'),
        'section' => 'home',
        'settings' => 'part_work_environment_movie_link',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('part_ceo_message_title', array(
        'default' => '',
    ));
    $wp_customize->add_control('part_ceo_message_title_c', array(
        'label' => __('Part CEO Message Title'),
        'section' => 'home',
        'settings' => 'part_ceo_message_title',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('part_ceo_message_image', array(
        'default' => '',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'part_ceo_message_image_c', array(
        'label' => __('Part CEO Message Image'),
        'section' => 'home',
        'settings' => 'part_ceo_message_image',
        'priority' => 1,
    )));

    $wp_customize->add_setting('part_dream_jobs_background_color', array(
        'default' => '',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'part_dream_jobs_background_color_c', array(
        'label' => __('Part Dream Jobs Background Color'),
        'section' => 'home',
        'settings' => 'part_dream_jobs_background_color',
        'priority' => 1,
    )));

    $wp_customize->add_setting('part_dream_jobs_search_background_color', array(
        'default' => '',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'part_dream_jobs_search_background_color_c', array(
        'label' => __('Part Dream Jobs Search Button Background Color'),
        'section' => 'home',
        'settings' => 'part_dream_jobs_search_background_color',
        'priority' => 1,
    )));

    $wp_customize->add_setting('part_dream_jobs_search_text_and_border_color', array(
        'default' => '',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'part_dream_jobs_search_text_and_border_color_c', array(
        'label' => __('Part Dream Jobs Search Button Text And Border Color'),
        'section' => 'home',
        'settings' => 'part_dream_jobs_search_text_and_border_color',
        'priority' => 1,
    )));

    $wp_customize->add_setting('part_dream_jobs_search_text_color', array(
        'default' => '',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'part_dream_jobs_search_text_color_c', array(
        'label' => __('Part Dream Jobs Search Button Text Color'),
        'section' => 'home',
        'settings' => 'part_dream_jobs_search_text_color',
        'priority' => 1,
    )));

    $wp_customize->add_setting('part_connected_title', array(
        'default' => '',
    ));
    $wp_customize->add_control('part_connected_title_c', array(
        'label' => __('Part Connected Title'),
        'section' => 'home',
        'settings' => 'part_connected_title',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('part_connected_content', array(
        'default' => '',
    ));
    $wp_customize->add_control('part_connected_content_c', array(
        'label' => __('Part Connected Content'),
        'section' => 'home',
        'settings' => 'part_connected_content',
        'priority' => 1,
        'type' => 'text',
    ));
}

add_action('customize_register', 'theme_customize_register');

//css generate
function generate_css() {
    ?>
    <style>
        .header-banner{
            background: url("<?php echo get_home_top_image() ?>");
        }
        .header-job-list.home-page {
            background: <?php echo get_part_dream_jobs_background_color() ?>;//#ff530d;
            //color: #fff;
        }
        .header-job-list .btn-search {
            background: <?php echo get_part_dream_jobs_search_background_color() ?>;//#ff530d;
            border: 3px solid <?php echo get_part_dream_jobs_search_text_and_border_color() ?>;
            color: <?php echo get_part_dream_jobs_search_text_and_border_color() ?>;
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

function get_part_our_service_title_text() {
    return get_theme_mod('part_our_service_title_text');
}

function get_part_work_environment_title_text() {
    return get_theme_mod('part_work_environment_title_text');
}

function get_part_work_environment_movie_title_text() {
    return get_theme_mod('part_work_environment_movie_title_text');
}

function get_part_work_environment_movie_desc_text() {
    return get_theme_mod('part_work_environment_movie_desc_text');
}

function get_part_work_environment_movie_link() {
    return get_theme_mod('part_work_environment_movie_link');
}

function get_part_ceo_message_title() {
    return get_theme_mod('part_ceo_message_title');
}

function get_part_ceo_message_image() {
    return get_theme_mod('part_ceo_message_image');
}

function get_part_dream_jobs_background_color() {
    return get_theme_mod('part_dream_jobs_background_color');
}

function get_part_dream_jobs_search_background_color() {
    return get_theme_mod('part_dream_jobs_search_background_color');
}

function get_part_dream_jobs_search_text_and_border_color() {
    return get_theme_mod('part_dream_jobs_search_text_and_border_color');
}

function get_part_connected_title() {
    return get_theme_mod('part_connected_title');
}

function get_part_connected_content() {
    return get_theme_mod('part_connected_content');
}
