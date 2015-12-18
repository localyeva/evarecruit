<?php

/**
 * Description: List All Hooked Functions
 * Credit: http://www.smashingmagazine.com/2009/08/10-useful-wordpress-hook-hacks/
 * Sources: http://www.rarst.net
 *
 * @global type $wp_filter
 * @param type $tag
 * @return type
 *
 */
function list_hooked_functions($tag = false) {
    global $wp_filter;
    if ($tag) {
        $hook[$tag] = $wp_filter[$tag];
        if (!is_array($hook[$tag])) {
            trigger_error("Nothing found for '$tag' hook", E_USER_WARNING);
            return;
        }
    } else {
        $hook = $wp_filter;
        ksort($hook);
    }
    echo '<pre>';
    foreach ($hook as $tag => $priority) {
        echo "<br />&gt;&gt;&gt;&gt;&gt;t<strong>$tag</strong><br />";
        ksort($priority);
        foreach ($priority as $priority => $function) {
            echo $priority;
            foreach ($function as $name => $properties)
                echo "t$name<br />";
        }
    }
    echo '</pre>';
    return;
}

/**
 *
 * @param type $text
 * @param type $open_tag
 * @param type $close_tag
 * @return string
 */
function convert_newline($text = '', $open_tag = '<p>', $close_tag = '</p>') {
    if ($text != '') {
        $arr = preg_split('/(\r?\n)+/', $text);
        $result = '';
        foreach ($arr as $value) {
            $result .= $open_tag . $value . $close_tag;
        }
        return $result;
    }
}

/**
 *
 * @param type $unixTime
 * @return type
 */
function get_time_duration($unixTime) {
    $period = '';
    $secsago = time() - strtotime($unixTime);
    if ($secsago < 60) {
        $period = $secsago == 1 ? '1 second' : $secsago . ' seconds';
    } else if ($secsago < 3600) {
        $period = round($secsago / 60);
        $period = $period == 1 ? '1 minute' : $period . ' minutes';
    } else if ($secsago < 86400) {
        $period = round($secsago / 3600);
        $period = $period == 1 ? '1 hour' : $period . ' hours';
    } else if ($secsago < 604800) {
        $period = round($secsago / 86400);
        $period = $period == 1 ? '1 day' : $period . ' days';
    } else if ($secsago < 2419200) {
        $period = round($secsago / 604800);
        $period = $period == 1 ? '1 week' : $period . ' weeks';
    } else if ($secsago < 29030400) {
        $period = round($secsago / 2419200);
        $period = $period == 1 ? '1 month' : $period . ' months';
    } else {
        $period = round($secsago / 29030400);
        $period = $period == 1 ? '1 year' : $period . ' years';
    }
    return $period . ' ago';
}

/**
 *
 * @param type $datetime
 * @param type $full
 * @return type
 */
function pretty_relative_time($datetime, $full = false) {

    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

/**
 *
 * @global type $wp_query
 * @return type
 *
 * Function from Genesis Framework
 *
 */
function wpbeginner_numeric_posts_nav() {

    if (is_singular())
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1)
        return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /** 	Add current page to the array */
    if ($paged >= 1)
        $links[] = $paged;

    /** 	Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (( $paged + 2 ) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="navigation"><ul class="pagination">' . "\n";

    /** 	Previous Post Link */
    if (get_previous_posts_link())
        printf('<li>%s</li>' . "\n", get_previous_posts_link('Prev'));

    /** 	Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links))
            echo '<li>…</li>';
    }

    /** 	Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /** 	Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /** 	Next Post Link */
    if (get_next_posts_link())
        printf('<li>%s</li>' . "\n", get_next_posts_link('Next'));

    echo '</ul></nav>' . "\n";
}

/**
 *
 * @param type $post_ID
 * @return string
 *
 * Reference http://wpsnipp.com/index.php/functions-php/track-post-views-without-a-plugin-using-post-meta/#
 *
 */
function getPostViews($post_ID, $count_key = '') {
    if ($count_key == '') {
        $count_key = 'post_views_count';
    }
    //
    $count = get_post_meta($post_ID, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_ID, $count_key);
        add_post_meta($post_ID, $count_key, '0');
        return "0";
    }
    return $count;
}

/**
 *
 * @param type $post_ID
 *
 * Reference http://wpsnipp.com/index.php/functions-php/track-post-views-without-a-plugin-using-post-meta/#
 *
 */
function setPostViews($post_ID, $count_key = '') {
    if ($count_key == '') {
        $count_key = 'post_views_count';
    }
    //
    $current_date = date('Y-m-d H:i:s');
    //
    $count = get_post_meta($post_ID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_ID, $count_key);
        add_post_meta($post_ID, $count_key, '1');
        add_post_meta($post_ID, $count_key . '_date', $current_date);
    } else {
        $current = strtotime($current_date);
        $timestamp = strtotime(get_post_meta($post_ID, $count_key . '_date', true));
        if (($current - $timestamp) < 10) {
            // do nothing
        } else {
            $count++;
            update_post_meta($post_ID, $count_key, $count);
            update_post_meta($post_ID, $count_key . '_date', $current_date);
        }
    }
}

// Remove issues with prefetching adding extra views
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function format_date($date = 'yyyymmdd', $format = '1') {
    // extract Y, M, D
    $y = substr($date, 0, 4);
    $m = substr($date, 4, 2);
    $d = substr($date, 6, 2);
    //
    switch ($format) {
        case 1:
            $date = "{$d}-{$m}-{$y}";
            break;
        case 2:
            $date = "{$y}-{$m}-{$d}";
            break;
        default:
            $date = "{$d}-{$m}-{$y}";
            break;
    }
    return $date;
}

/* -------------------------------------------------------------------------- */

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype($output) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}

add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
    global $post;
    if (!is_singular()) {
        echo '<meta property="fb:app_id" content="795903230445450">';
        echo '<meta property="og:title" content=""/>';
        echo '<meta property="og:type" content="website">';
        echo '<meta property="og:url" content="' . home_url() . '"/>';
        echo '<meta property="og:site_name" content="Evolable Asia - Tuyển dụng"/>';
        echo '<meta property="og:description" content="Trang tuyển dụng Evolable Asia. Chúng tôi đang tìm kiếm các ứng viên đáp ứng nhu cầu cho các dự án phát triển phần mềm, dịch vụ BPO.">';
        echo "";
        return;
    }
    //
    $current_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    echo '<meta property="fb:app_id" content="795903230445450">';
    echo '<meta property="og:title" content="' . get_the_title() . '"/>';
    echo '<meta property="og:type" content="website">';
    echo '<meta property="og:url" content="' . $current_url . '"/>';
    echo '<meta property="og:site_name" content="Evolable Asia - Tuyển dụng"/>';
    echo '<meta property="og:description" content="Trang tuyển dụng Evolable Asia. Chúng tôi đang tìm kiếm các ứng viên đáp ứng nhu cầu cho các dự án phát triển phần mềm, dịch vụ BPO.">';

    if (function_exists('get_lab_info')) {
        $lab_info = get_lab_info();
    }

    if (isset($lab_info)) {
        if (isset($lab_info['top-image']['medium'])) {
            $thumbnail_src = isset($lab_info['top-image']['medium']);
            echo '<meta property="og:image" content="' . esc_attr($thumbnail_src) . '"/>';
        }
    } elseif (!has_post_thumbnail($post->ID)) {

        $default_image = "http://jobs.evolable.asia/wp-content/uploads/2015/08/fb_share.png";
        echo '<meta property="og:image" content="' . $default_image . '"/>';
    } else {
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
        echo '<meta property="og:image" content="' . esc_attr($thumbnail_src[0]) . '"/>';
    }
    echo "";
}

add_action('wp_head', 'omw_master_wp_header', 5);

function omw_master_wp_header() {

    insert_fb_in_head();

    generate_css();

    staff_detail_generate_css();

    generate_global_service_css();
}
