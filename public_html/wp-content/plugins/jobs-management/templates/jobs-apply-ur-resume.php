<?php
/*
 * Author: KhangLe
 *
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}
?>

<div class="header-apply-resume" style="position: relative;">
    <div id="apply-overlay" class="apply-overlay">
        <i class="fa fa-spinner fa-spin apply-spin"></i>
    </div>
    <div id="apply-rs-overlay" class="apply-overlay">
        <aside id="apply-rs-popup" class="apply-rs-popup">
            <h2>Apply Resume</h2>
            <p>
                Cảm ơn bạn đã ứng tuyển!
            </p>
            <button id="apply-rs-close" class="btn btn-default center-block">Close</button>
        </aside>
    </div>

    <div class="container">
        <form id="apply-form" name="apply-form" class="input-form col-xs-12 col-md-12" action="<?php echo bloginfo('url') ?>/jobs-apply" target="iapply" enctype="multipart/form-data" method="POST">
            <h2>Apply Your Resume</h2>
            <div class="row-gap-small"></div>
            <fieldset class="form-group has-feedback">
                <input type="text" class="form-control input-lg" id="re_email" name="re_email" placeholder="Email">
            </fieldset>
            <fieldset class="form-group has-feedback">
                <input type="text" class="form-control input-lg" id="re_fullname" name="re_fullname" placeholder="Full Name">
            </fieldset>
            <fieldset class="form-group has-feedback">
                <input type="text" class="form-control input-lg" id="re_tel" name="re_tel" placeholder="Phone Number">
            </fieldset>
            <fieldset class="form-group">
                <label class="control-label" for="re_position">Position</label>
                <select class="form-control input-lg" id="re_position" name="re_position" placeholder="Choose a position">
                    <option value="">-- Select --</option>
                    <option value="1">Lập trình (Developer)</option>
                    <option value="2">HTML Coder</<option>
                    <option value="3">Xử lý dữ liệu (BPO)</option>
                    <option value="4">Kỹ sư cầu nối (BSE)</option>
                    <option value="5">Thông dịch / Trợ lý (Japanese Communicator/Assistant)</<option>
                    <option value="6">Khác (Others)</option>
                </select>
                <input type="hidden" id="job_position" name="job_position" value="" />
            </fieldset>
            <fieldset class="form-group relative-position" rel="1">
                <input type="text" class="form-control input-lg" id="re_programming_language" name="re_programming_language" placeholder="Ex: PHP, Java, Object-C, ...">
            </fieldset>
            <fieldset class="form-group relative-position" rel="6">
                <input type="text" class="form-control input-lg" id="re_other_position" name="re_other_position" placeholder="Ex: HR, Sales, Accounting, ...">
            </fieldset>
            <fieldset class="form-group">
                <label class="control-label" for="job_location">Location</label>
                <?php
                $args = array(
                    'orderby' => 'count',
                    'hide_empty' => 0
                );
                $locations = get_terms('job-location', $args);
                ?>
                <select class="form-control input-lg" id="job_location" name="job_location" placeholder="Location">
                    <option value="">-- Select --</option>
                    <?php foreach ($locations as $location): ?>
                        <option value="<?php echo $location->name ?>"><?php echo $location->name ?></option>
                    <?php endforeach; ?>
                </select>
            </fieldset>
            <fieldset class="form-group upload-cv">
                <label class="control-label">Attach CV</label>
                <input class="form-control input-lg" type="file" id="re_attach" name="re_attach" class="btn" />
            </fieldset>
            <fieldset class="form-group agree-cv">
                <label for="re_check">
                    <input type="checkbox" id="re_check" name="re_check" value="" checked>
                    I agree Evolable Asia Terms and Privacy.
                </label>
            </fieldset>
            <div class="blankline"></div>
            <fieldset>
                <button class="submit" type="submit"><span class="send">Apply</span></button>
            </fieldset>
            <input type="hidden" name="apply" value="job"/>
        </form>
    </div>
</div>

<iframe id="iapply" name="iapply" width="0" height="0" border="0" style="display: none;"></iframe>
