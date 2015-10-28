<?php
/**
 * Description of jobs_cpt_acf_settings
 *
 * @author khangld
 */
if (!defined('ABSPATH'))
    exit;

global $job_status;
$job_status = array(
    0 => 'normal',
    1 => 'new',
    2 => 'urgent',
);

class jobs_cpt_acf_settings {

    private $assets_url;

    public function __construct() {

        $this->assets_url = esc_url(trailingslashit(plugins_url('/assets/', __FILE__)));

        /* === cpt & acf === */
        add_action('init', array($this, 'cptui_register_my_cpts'));
        add_action('init', array($this, 'cptui_register_my_taxes'));
        add_action('init', array($this, 'my_register_field_group'));
    }

    /* ---------------------------------------------------------------------------- */
    /* post type definitions */
    /* ---------------------------------------------------------------------------- */

    public function cptui_register_my_cpts() {
        $labels = array(
            "name" => "Jobs",
            "singular_name" => "Job",
        );

        $args = array(
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "show_ui" => true,
            "has_archive" => true,
            "show_in_menu" => true,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => array("slug" => "job", "with_front" => true),
            "query_var" => true,
            "menu_position" => 26,
            "menu_icon" => $this->assets_url . 'images/ad-ico/h16.png',
            "supports" => array("title"),
        );
        register_post_type("job", $args);
    }

    /* ---------------------------------------------------------------------------- */
    /* taxonomy definitions */
    /* ---------------------------------------------------------------------------- */

    public function cptui_register_my_taxes() {
        $labels = array(
            "name" => "Job Locations",
            "label" => "Job Locations",
        );

        $args = array(
            "labels" => $labels,
            "hierarchical" => true,
            "label" => "Job Locations",
            "show_ui" => true,
            "query_var" => true,
            "rewrite" => array('slug' => 'job-location', 'with_front' => true),
            "show_admin_column" => false,
        );
        register_taxonomy("job-location", array("job"), $args);

        $labels = array(
            "name" => "Job Positions",
            "label" => "Job Positions",
        );

        $args = array(
            "labels" => $labels,
            "hierarchical" => true,
            "label" => "Job Positions",
            "show_ui" => true,
            "query_var" => true,
            "rewrite" => array('slug' => 'job-position', 'with_front' => true),
            "show_admin_column" => false,
        );
        register_taxonomy("job-position", array("job"), $args);

        $labels = array(
            "name" => "Labs",
            "label" => "Labs",
        );

        $args = array(
            "labels" => $labels,
            "hierarchical" => true,
            "label" => "Labs",
            "show_ui" => true,
            "query_var" => true,
            "rewrite" => array('slug' => 'lab', 'with_front' => true),
            "show_admin_column" => false,
        );
        register_taxonomy("lab", array("job", "staff"), $args);
    }

    /* ---------------------------------------------------------------------------- */
    /* custom fields definitions */
    /* ---------------------------------------------------------------------------- */

    public function my_register_field_group() {
        if (function_exists("register_field_group")) {
            register_field_group(array(
                'id' => 'acf_job',
                'title' => 'Job',
                'fields' => array(
                    array(
                        'key' => 'field_55da913d03fc1',
                        'label' => 'Status',
                        'name' => 'status',
                        'type' => 'radio',
                        'choices' => array(
                            '0' => 'Normal',
                            '1' => 'New',
                            '2' => 'Urgent',
                        ),
                        'other_choice' => 0,
                        'save_other_choice' => 0,
                        'default_value' => '',
                        'layout' => 'horizontal',
                    ),
                    array(
                        'key' => 'field_55cb0d7913788',
                        'label' => 'Work Level',
                        'name' => 'work_level',
                        'type' => 'select',
                        'choices' => array(
                            'Member' => 'Member',
                            'Leader' => 'Leader',
                            'Team Leader/Supervisor' => 'Team Leader/Supervisor',
                            'Designer' => 'Designer',
                        ),
                        'default_value' => '',
                        'allow_null' => 0,
                        'multiple' => 0,
                    ),
                    array(
                        'key' => 'field_55cb0e2713789',
                        'label' => 'Salary',
                        'name' => 'salary',
                        'type' => 'text',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_55cb0e7e1378b',
                        'label' => 'Expire Date',
                        'name' => 'expire_date',
                        'type' => 'date_picker',
                        'date_format' => 'yymmdd',
                        'display_format' => 'dd/mm/yy',
                        'first_day' => 1,
                    ),
                    array(
                        'key' => 'field_55cb0ed21378c',
                        'label' => 'Job Description',
                        'name' => 'job_description',
                        'type' => 'wysiwyg',
                        'default_value' => '',
                        'toolbar' => 'full',
                        'media_upload' => 'yes',
                    ),
                    array(
                        'key' => 'field_55cb0ee71378d',
                        'label' => 'Job Requirement',
                        'name' => 'job_requirement',
                        'type' => 'wysiwyg',
                        'default_value' => '',
                        'toolbar' => 'full',
                        'media_upload' => 'yes',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'job',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),
                'options' => array(
                    'position' => 'normal',
                    'layout' => 'no_box',
                    'hide_on_screen' => array(
                    ),
                ),
                'menu_order' => 0,
            ));
        }
    }

}

new jobs_cpt_acf_settings();

/* ---------------------------------------------------------------------------- */

global $jola_settings;

$jola_settings['top-image'] = array(
    'id' => 'top-image',
    'label' => 'Top Image',
    'description' => '',
    'type' => 'media',
    'default',
    'placeholder',
);

$jola_settings['image-1'] = array(
    'id' => 'image-1',
    'label' => 'About Image 1',
    'description' => '',
    'type' => 'media',
    'default',
    'placeholder',
);

$jola_settings['image-2'] = array(
    'id' => 'image-2',
    'label' => 'About Image 2',
    'description' => '',
    'type' => 'media',
    'default',
    'placeholder',
);

$jola_settings['lab-des-1'] = array(
    'id' => 'lab-des-1',
    'label' => 'About Us',
    'description' => '',
    'type' => 'wysiwyg',
    'default',
    'placeholder',
);

$jola_settings['lab-des-2'] = array(
    'id' => 'lab-des-2',
    'label' => 'Development Team',
    'description' => '',
    'type' => 'wysiwyg',
    'default',
    'placeholder',
);

$jola_settings['lab-des-3'] = array(
    'id' => 'lab-des-3',
    'label' => 'Carrier',
    'description' => '',
    'type' => 'wysiwyg',
    'default',
    'placeholder',
);

//function jola_load_media(){
//    wp_enqueue_media();
//}
//
//add_action('jola_admin_print_styles', 'jola_load_media');

function taxonomy_add_new_meta_field() {
    global $jola_settings;
    $html = '';
    //
    foreach ($jola_settings as $field => $data) {
        //
        $t_id = $data['id'];
        //  
        switch ($data['type']) {
            case 'wysiwyg':
                ?>
                <div class="form-field">
                    <label for="<?php echo $t_id ?>"> <?php _e($data['label']) ?></label>
                    <?php wp_editor('', $t_id, array('wpautop' => false, 'tinymce' => true)); ?>
                    <p class="description"><?php _e($data['description']) ?></p>
                </div>
                <?php
                break;
            case 'media':
                ?>
                <div class="form-field">
                    <label for="<?php echo $t_id ?>"> <?php _e($data['label']) ?></label>
                    <img src="images/media-button-image.gif" alt="Add photos from your media" /> 
                    <a href="media-upload.php?type=image&#038;wpaft_send_label=<?php echo $t_id ?>&#038;TB_iframe=1&#038;tab=library&#038;height=500&#038;width=640" onclick="image_photo_url_add('<?php echo $t_id ?>')" class="thickbox" title="Add an Image"> 
                        <strong>
                            <?php echo _e('Click here to add/change your image', 'wp-texonomy-meta'); ?>
                        </strong>
                    </a>
                    <p class="description"><?php _e($data['description']) ?></p>
                </div>
                <?php
                break;
        }
    }
    //
}

//add_action('lab_add_form_fields', 'taxonomy_add_new_meta_field', 10, 2);

function taxonomy_edit_meta_field($term) {
    global $jola_settings;
    $html = '';
    //
    foreach ($jola_settings as $field => $data) {
        // retrieve the existing value(s) for this meta field. This returns an array
        $t_id = $data['id'] . '-' . $term->term_id;
        $term_meta = get_option('jola_' . $t_id);
        //
        switch ($data['type']) {
            case 'wysiwyg':
                ?>
                <tr class="form-field">
                    <th scope="row" valign="top"><label for="<?php echo $t_id ?>"><?php _e($data['label']) ?></label></th>
                    <td>
                        <?php wp_editor($term_meta[$t_id] ? stripcslashes($term_meta[$t_id]) : '', $t_id, array('wpautop' => false, 'tinymce' => true)); ?>
                        <p class="description"><?php _e($data['description']) ?></p>
                    </td>
                </tr>
                <?php
                break;
            case 'media':
                $image_thumb = '';
                if ($term_meta[$t_id]) {
                    $image_thumb = $term_meta[$t_id];
                }
                ?>
                <tr class="form-field">
                    <th scope="row" valign="top">
                        <label for="<?php echo $t_id ?>" class="wpaft_meta_name_label"><?php _e($data['label']) ?></label>
                    </th>
                    <td>
                        <div id="<?php echo $t_id ?>_selected_image" class="wpaft_selected_image">
                            <?php if ($image_thumb != '') echo '<img src="' . $image_thumb . '" style="max-width:50%;"/>'; ?>
                        </div>
                        <input type="text" name="<?php echo $t_id ?>" id="<?php echo $t_id ?>" value="<?php echo $image_thumb; ?>" /><br />
                        <br />
                        <img src="images/media-button-image.gif" alt="Add photos from your media" /> 
                        <a href="media-upload.php?type=image&#038;wpaft_send_label=<?php echo $t_id ?>&#038;TB_iframe=1&#038;tab=library&#038;height=500&#038;width=640" onclick="image_photo_url_add('<?php echo $t_id ?>')" class="thickbox" title="Add an Image"> 
                            <strong>
                                <?php echo _e('Click here to add/change your image', 'wp-texonomy-meta'); ?>
                            </strong>
                        </a>
                    </td>
                </tr>
                <?php
                break;
        }
    }
}

add_action('lab_edit_form_fields', 'taxonomy_edit_meta_field', 10, 2);

function save_taxonomy_custom_meta($term_id) {
    global $jola_settings;
    //
    foreach ($jola_settings as $field => $data) {
        //
        $t_id = $data['id'] . '-' . $term_id;
        //
        if (isset($_POST[$t_id])) {
            $term_meta = get_option('jola_' . $t_id);
            $term_meta[$t_id] = $_POST[$t_id];
            // Save the option array.
            update_option('jola_' . $t_id, $term_meta);
        }
    }
}

add_action('edited_lab', 'save_taxonomy_custom_meta', 10, 2);
add_action('create_lab', 'save_taxonomy_custom_meta', 10, 2);
