<style>#re_check-error{display: none;}</style>
<!-- // Apply Form Start -->
<div id="apply-form-modal" class="apply-form-modal" style="display: none;">
    <div class="header-top-apply">
        <div class="text-center">
            <h2 class="text-bold">Apply Your Resume</h2>
        </div>
    </div>
    <div class="row-gap-large"></div>
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <form id="apply-form" name="apply-form" class="form-horizontal" action="<?php echo bloginfo('url') ?>/jobs-apply" target="iapply" enctype="multipart/form-data" method="POST">
                <div class="form-group has-feedback">
                    <label for="re_email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control input-lg" id="re_email" name="re_email" placeholder="Email">
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="re_fullname" class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="re_fullname" name="re_fullname" placeholder="Full Name">
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="re_tel" class="col-sm-2 control-label">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="re_tel" name="re_tel" placeholder="Phone Number">
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="re_attach" class="col-sm-2 control-label">Attach CV</label>
                    <div class="col-sm-10">
                        <input type="file" id="re_attach" name="re_attach" />
                    </div>
                </div>

                <div class="row-gap-medium"></div>
                <div class="form-group has-feedback">
                    <label for="content" class="control-label">Terms - Privacy</label>
                </div>
                <div class="box">
                    <div class="row">
                        <div class="col-xs-10">
                            <?php require_once(dirname(__FILE__) . '/part-job-privacy-agree.php'); ?>
                        </div>
                    </div>
                </div>
                <div class="row-gap-small"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="checkbox">
                            <label for="re_check">
                                <input type="checkbox" id="re_check" name="re_check" value="" checked>
                                I agree Evolable Asia Terms and Privacy.
                            </label>
                            <br/>
                            <label id="re_check-error" class="error" for="re_check">Bạn có đồng ý ứng tuyển vị trí. Vui lòng check bên dưới</label>
                        </div>
                    </div>
                </div>
                <div class="row-gap-medium"></div>
                <div class="row">
                    <div class="col-md-5 col-xs-12 btn-apply">
                        <button class="btn btn-block btn-orange" type="submit" name="apply" value="job">Submit request</button>
                    </div>
                </div>
                <div class="row-gap-large"></div>
                <input type="hidden" name="job_id" value="<?php the_ID() ?>"/>
                <input type="hidden" name="job_slug" value="<?php echo $post->post_name ?>"/>
                <input type="hidden" name="job_title" value="<?php the_title() ?>"/>
                <input type="hidden" name="job_position" value="<?php echo $position[0]->name ?>"/>
                <input type="hidden" name="job_location" value="<?php echo $location[0]->name ?>"/>
                <input type="hidden" name="job_level" value="<?php echo get_field('work_level') ?>"/>
                <input type="hidden" name="job_salary" value="<?php echo get_field('salary') ?>"/>
                <input type="hidden" name="job_expired" value="<?php echo format_date(get_field('expire_date')) ?>"/>
            </form>
        </div>
    </div>
</div>
<iframe id="iapply" name="iapply" width="0" height="0" border="0" style="display: none;"></iframe>
<!-- // Apply Form End -->