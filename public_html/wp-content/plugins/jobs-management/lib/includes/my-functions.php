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
        if (is_numeric($data[$option_name])) {
            return $data[$option_name];
        } else {
            return 0;
        }
        //
        if (is_string($data[$option_name])) {
            return $data[$option_name];
        } else {
            return '';
        }
        //
        if (is_array($data[$option_name])) {
            return $data[$option_name];
        } else {
            return NULL;
        }
    }
    return NULL;
}
