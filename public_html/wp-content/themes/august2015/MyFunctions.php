<?php

/*
 * 
 * Description: List All Hooked Functions
 * Credit: http://www.smashingmagazine.com/2009/08/10-useful-wordpress-hook-hacks/
 * Sources: http://www.rarst.net
 * 
 *  */

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
