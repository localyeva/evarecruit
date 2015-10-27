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
            <fieldset class="box">
                <i class="icon email"></i>
                <input type="text" class="form-control" id="re_email" name="re_email" placeholder="Email">
            </fieldset>
            <fieldset class="box">
                <i class="icon user"></i>
                <input type="text" class="form-control" id="re_fullname" name="re_fullname" placeholder="Full Name">
            </fieldset>
            <fieldset class="box">
                <i class="icon phone"></i>
                <input type="text" class="form-control" id="re_tel" name="re_tel" placeholder="Phone Number">
            </fieldset>
            <div class="blankline"></div>
            <fieldset class="radiogroup">
                <label class="option"><i class="radio"></i><input type="radio" name="re_gender[]" id="re_gender_m" value="m"  style="display:none;" checked />Male</label>
                <label class="option"><i class="radio"></i><input type="radio" name="re_gender[]" id="re_gender_f" value="f"  style="display:none;" />Female</label>
            </fieldset>
            <!--
            <fieldset class="upload-cv">
                <label>Attach CV</label>
                <input type="file" id="re_attach" name="re_attach" />
                <!--<input type="button" value="Browse" />-->
                <!--<span class="filename">No file select</span>-->
            <!--</fieldset>-->
            <fieldset class="agree-cv">
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