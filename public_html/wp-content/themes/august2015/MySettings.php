<?php
/**
 * Tabbed Settings Page
 */
//add_action('init', 'ilc_admin_init');
add_action('admin_menu', 'ilc_settings_page_init');

//
//function ilc_admin_init() {
//    $settings = get_option("my_theme_option");
//    if (empty($settings)) {
//        $settings = array(
//            'ilc_intro' => 'Some intro text for the home page',
//            'ilc_tag_class' => false,
//            'ilc_ga' => false
//        );
//        add_option("my_theme_option", $settings, '', 'yes');
//    }
//}

function ilc_settings_page_init() {
    $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
    $settings_page = add_theme_page($theme_data['Name'] . ' Theme Settings', $theme_data['Name'] . ' Theme Settings', 'edit_theme_options', 'theme-settings', 'ilc_settings_page');
    add_action("load-{$settings_page}", 'ilc_load_settings_page');
}

function ilc_load_settings_page() {
    if ($_POST["ilc-settings-submit"] == 'Y') {
        check_admin_referer("ilc-settings-page");
        ilc_save_theme_settings();
        $url_parameters = isset($_GET['tab']) ? 'updated=true&tab=' . $_GET['tab'] : 'updated=true';
        wp_redirect(admin_url('themes.php?page=theme-settings&' . $url_parameters));
        exit;
    }
}

function ilc_save_theme_settings() {
    global $pagenow;
    $settings = get_option("my_theme_option");
    if ($pagenow == 'themes.php' && $_GET['page'] == 'theme-settings') {
        if (isset($_GET['tab']))
            $tab = $_GET['tab'];
        else
            $tab = 'homepage';

        switch ($tab) {
            case 'general' :
                $settings['ct_use_css'] = $_POST['ct_use_css'];
                $settings['ct_custom_css'] = $_POST['ct_custom_css'];
                $settings['ct_use_script'] = $_POST['ct_use_script'];
                $settings['ct_custom_script'] = $_POST['ct_custom_script'];
                break;
            case 'footer' :
                $settings['ct_google_analytics'] = $_POST['ct_google_analytics'];
                $settings['ct_google_tag_manager'] = $_POST['ct_google_tag_manager'];
                $settings['ct_facebook_script'] = $_POST['ct_facebook_script'];
                $settings['ct_google_plus_script'] = $_POST['ct_google_plus_script'];
                $settings['ct_twitter_script'] = $_POST['ct_twitter_script'];
                $settings['ct_custom_script'] = $_POST['ct_custom_script'];
                break;
            case 'homepage' :
                $settings['ct_com_postal_code'] = $_POST['ct_com_postal_code'];
                $settings['ct_com_address_jp'] = $_POST['ct_com_address_jp'];
                $settings['ct_com_address_en'] = $_POST['ct_com_address_en'];
                $settings['ct_com_zip_code'] = $_POST['ct_com_zip_code'];
                $settings['ct_com_telephone'] = $_POST['ct_com_telephone'];
                $settings['ct_com_fax'] = $_POST['ct_com_fax'];
                break;
        }
    }

//    if (!current_user_can('unfiltered_html')) {
//        if ($settings['ct_google_analytics'])
//            $settings['ct_google_analytics'] = stripslashes(esc_textarea(wp_filter_post_kses($settings['ct_google_analytics'])));
//        if ($settings['ct_google_tag_manager'])
//            $settings['ct_google_tag_manager'] = stripslashes(esc_textarea(wp_filter_post_kses($settings['ct_google_tag_manager'])));
//    }

    $updated = update_option("my_theme_option", $settings);
}

function ilc_admin_tabs($current = 'homepage') {
    $tabs = array('homepage' => 'Home', 'general' => 'General', 'footer' => 'Footer');
    $links = array();
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ($tabs as $tab => $name) {
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=theme-settings&tab=$tab'>$name</a>";
    }
    echo '</h2>';
}

function ilc_settings_page() {
    global $pagenow;
    $settings = get_option("my_theme_option");
    $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
    ?>

    <div class="wrap">
        <h2><?php echo $theme_data['Name']; ?> Theme Settings</h2>

        <?php
        if ('true' == esc_attr($_GET['updated']))
            echo '<div class="updated" ><p>Theme Settings updated.</p></div>';

        if (isset($_GET['tab']))
            ilc_admin_tabs($_GET['tab']);
        else
            ilc_admin_tabs('homepage');
        ?>

        <div id="poststuff">
            <form method="post" action="<?php admin_url('themes.php?page=theme-settings'); ?>">
                <?php
                wp_nonce_field("ilc-settings-page");

                if ($pagenow == 'themes.php' && $_GET['page'] == 'theme-settings') {

                    if (isset($_GET['tab']))
                        $tab = $_GET['tab'];
                    else
                        $tab = 'homepage';

                    echo '<table class="form-table">';
                    switch ($tab) {
                        case 'general' :
                            ?>
                            <tr>
                                <th><label for="ct_use_css">Use Custom CSS:</label></th>
                                <td>
                                    <input id="ct_use_css" name="ct_use_css" type="checkbox" <?php if ($settings["ct_use_css"]) echo 'checked="checked"'; ?> value="true" /> 
                                    <span class="description">Enable/Disable custom CSS</span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_custom_css">CSS Code:</label></th>
                                <td>
                                    <textarea id="ct_custom_css" name="ct_custom_css" cols="60" rows="5"><?php echo esc_html(stripslashes($settings["ct_custom_css"])); ?></textarea><br/>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_use_script">Use Custom Script:</label></th>
                                <td>
                                    <input id="ct_use_script" name="ct_use_script" type="checkbox" <?php if ($settings["ct_use_script"]) echo 'checked="checked"'; ?> value="true" /> 
                                    <span class="description">Enable/Disable custom CSS</span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_custom_script">Javascript Code:</label></th>
                                <td>
                                    <textarea id="ct_custom_script" name="ct_custom_script" cols="60" rows="5"><?php echo esc_html(stripslashes($settings["ct_custom_script"])); ?></textarea><br/>
                                </td>
                            </tr>
                            <?php
                            break;
                        case 'footer' :
                            ?>
                            <tr>
                                <th><label for="ct_google_analytics">Google Analytics Code:</label></th>
                                <td>
                                    <textarea id="ct_google_analytics" name="ct_google_analytics" cols="60" rows="5"><?php echo esc_html(stripslashes($settings["ct_google_analytics"])); ?></textarea><br/>
                                    <span class="description">Enter your Google Analytics tracking code</span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_google_tag_manager">Google Tag Manager Code:</label></th>
                                <td>
                                    <textarea id="ct_google_tag_manager" name="ct_google_tag_manager" cols="60" rows="5"><?php echo esc_html(stripslashes($settings["ct_google_tag_manager"])); ?></textarea><br/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" align="center">
                                    <h2>Social Network</h2><hr/>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_facebook_script">Facebook Script:</label></th>
                                <td>
                                    <textarea id="ct_facebook_script" name="ct_facebook_script" cols="60" rows="5"><?php echo esc_html(stripslashes($settings["ct_facebook_script"])); ?></textarea><br/>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_google_plus_script">Google Plus Script:</label></th>
                                <td>
                                    <textarea id="ct_google_plus_script" name="ct_google_plus_script" cols="60" rows="5"><?php echo esc_html(stripslashes($settings["ct_google_plus_script"])); ?></textarea><br/>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_twitter_script">Twitter Script:</label></th>
                                <td>
                                    <textarea id="ct_twitter_script" name="ct_twitter_script" cols="60" rows="5"><?php echo esc_html(stripslashes($settings["ct_twitter_script"])); ?></textarea><br/>
                                </td>
                            </tr>
                            <?php
                            break;
                        case 'homepage' :
                            ?>
                            <tr>
                                <td></td>
                                <td>
                                    <h2>Company Information</h2>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_com_postal_code">〒 Postal Code</label></th>
                                <td>
                                    <input type="text" id="ct_com_postal_code" name="ct_com_postal_code" value="<?php echo esc_html(stripslashes($settings["ct_com_postal_code"])); ?>" /><br/>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_com_address_jp">Address (Japanese)</label></th>
                                <td>
                                    <input type="text" size="70" id="ct_com_address_jp" name="ct_com_address_jp" value="<?php echo esc_html(stripslashes($settings["ct_com_address_jp"])); ?>" /><br/>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_com_address_en">Address (English)</label></th>
                                <td>
                                    <input type="text" size="70" id="ct_com_address_en" name="ct_com_address_en" value="<?php echo esc_html(stripslashes($settings["ct_com_address_en"])); ?>" /><br/>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_com_zip_code">Zip Code</label></th>
                                <td>
                                    <input type="text" id="ct_com_zip_code" name="ct_com_zip_code" value="<?php echo esc_html(stripslashes($settings["ct_com_zip_code"])); ?>" /><br/>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_com_telephone">Telephone Number</label></th>
                                <td>
                                    <input type="text" id="ct_com_telephone" name="ct_com_telephone" value="<?php echo esc_html(stripslashes($settings["ct_com_telephone"])); ?>" /><br/>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="ct_com_fax">Tax Code</label></th>
                                <td>
                                    <input type="text" id="ct_com_fax" name="ct_com_fax" value="<?php echo esc_html(stripslashes($settings["ct_com_fax"])); ?>" /><br/>
                                </td>
                            </tr>
                            <?php
                            break;
                    }
                    echo '</table>';
                }
                ?>
                <p class="submit" style="clear: both;">
                    <input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
                    <input type="hidden" name="ilc-settings-submit" value="Y" />
                </p>
            </form>

            <p><?php echo $theme_data['Name'] ?> theme by <?php echo $theme_data['AuthorName'] ?></p>
        </div>

    </div>
    <?php
}
?>