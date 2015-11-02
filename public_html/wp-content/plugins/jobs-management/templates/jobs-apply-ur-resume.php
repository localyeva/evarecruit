<?php
/*
 * Author: KhangLe
 *
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}
?>
<div class="header-apply-resume">
    <div class="container">
        <form id="apply-form" name="apply-form" class="input-form col-xs-12 col-md-12" action="<?php echo bloginfo('url') ?>/jobs-apply" target="iapply" enctype="multipart/form-data" method="POST">
            <h2>Apply Your Resume</h2>
            <fieldset class="form-group has-success has-feedback">
                <!-- <i class="icon email"></i> -->
                <label class="control-label" for="re_email">Email</label>
                <input type="text" class="form-control input-lg" id="re_email" name="re_email" placeholder="Email">
                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                <!-- <span id="inputSuccess2Status" class="sr-only">(success)</span> -->
            </fieldset>
            <fieldset class="form-group has-warning has-feedback">
                <label class="control-label" for="re_fullname">Full name</label>
                <input type="text" class="form-control input-lg" id="re_fullname" name="re_fullname" placeholder="Full Name">
                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
            </fieldset>
            <fieldset class="form-group has-error has-feedback">
                <label class="control-label" for="re_tel">Phone number</label>
                <input type="text" class="form-control input-lg" id="re_tel" name="re_tel" placeholder="Phone Number">
                <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
            </fieldset>
            <fieldset class="form-group">
                <label class="control-label" for="re_position">Position</label>
                <select class="form-control input-lg" id="re_position" name="re_position" placeholder="Choose a position">
                    <option value="1">Lập trình (Developer)</<option>
                    <option value="2">HTML Coder</<option>
                    <option value="3">Xử lý dữ liệu (BPO)</<option>
                    <option value="4">Kỹ sư cầu nối (BSE)</<option>
                    <option value="5">Thông dịch / Trợ lý (Japanese Communicator/Assistant)</<option>
                    <option value="6">Khác (Others)</<option>
                </select>
            </fieldset>
            <fieldset class="form-group relative-position" rel="1">
                <!-- <label class="control-label" for="re_programming_language">Programming language</label> -->
                <input type="text" class="form-control input-lg" id="re_programming_language" name="re_programming_language" placeholder="Ex: PHP, Java, Object-C, ...">
            </fieldset>
            <fieldset class="form-group relative-position" rel="6">
                <!-- <label class="control-label" for="re_other_position">Others</label> -->
                <input type="text" class="form-control input-lg" id="re_other_position" name="re_other_position" placeholder="Ex: HR, Sales, Accounting, ...">
            </fieldset>
            <fieldset class="form-group">
                <label class="control-label" for="re_location">Location</label>
                <select class="form-control input-lg" id="re_location" name="re_location" placeholder="Location">
                    <option value="HCM">HCM</<option>
                    <option value="Ha Noi">Ha Noi</<option>
                    <option value="Da Nang">Da Nang</<option>
                </select>
            </fieldset>
            <fieldset class="form-group upload-cv">
                <label class="control-label">Attach CV</label>
                <input class="form-control input-lg" type="file" id="re_attach" name="re_attach" class="btn" />
            </fieldset>
            <fieldset class="form-group agree-cv">
                <label for="re_check">
                    <input type="checkbox" id="re_check" name="re_check" value="" checked>
                    I agree to the Evolable Asia Terms and Privacy.
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