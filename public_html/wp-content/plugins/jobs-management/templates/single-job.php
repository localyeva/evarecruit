<?php
/*
 * Author: KhangLe
 * Template Name: Jobs
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

// Count number of views
if (function_exists('setPostViews')) {
    setPostViews(get_the_ID(), 'job_views');
}


$list_email = get_option('wpt_job_text_list_email');
$list_email = preg_split('/\r\n|\n|\r/', $list_email['wpt_job_text_list_email']);

get_header();
?>

<div id="new-job-detail">

    <!--//Search Bar-->
    <?php require_once(dirname(__FILE__) . '/job-search-bar.php') ?>
    <!--//Search Bar End-->

    <div id="print-job-part" class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="standout">
                    <div class="row">
                        <div class="col-xs-12 col-md-9">
                            <div class="title">
                                <?php the_title() ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            posted on <span class="time"><?php echo get_time_duration(get_the_date('Y-m-d H:i:s')) ?></span>
                        </div>
                    </div>
                </div>

                <div class="detail">
                    <!-- info -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title">Recruit Information</div>
                            <div class="content">
                                <?php $position = get_the_terms($post->ID, 'job-position'); ?>
                                <p>Position: <?php echo $position[0]->name ?></p>
                                <p>Work level: <?php echo get_field('work_level') ?></p>
                                <p>Salary: <?php echo get_field('salary') ?></p>
                                <?php $location = get_the_terms($post->ID, 'job-location'); ?>
                                <p>Location: <?php echo $location[0]->name ?></p>
                                <p>Expire date: <?php echo format_date(get_field('expire_date')) ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- description -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title">Job Description</div>
                            <?php echo get_field('job_requirement') ?>
                        </div>
                    </div>
                    <!-- requirement -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title">Job Description</div>
                            <?php echo get_field('job_description') ?>
                        </div>
                    </div>
                </div>

                <div class="actions noprint">
                    <div class="row">
                        <!--
                        <div class="col-xs-12 col-md-2">
                            <div class="item">
                                <img src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job_detail/4.png" alt="">
                                <span class="item-name">Save job</span>
                            </div>
                        </div>
                        -->
                        <div id="print-job" class="col-xs-12 col-md-2">
                            <div class="item">
                                <img src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job_detail/5.png" alt="">
                                <span class="item-name">Print this job</span>
                            </div>
                        </div>
                        <!--
                        <div class="col-xs-12 col-md-2">
                            <div class="item">
                                <img src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job_detail/6.png" alt="">
                                <span class="item-name">Report this job</span>
                            </div>
                        </div>
                        -->
                        <!--
                        <div class="col-xs-12 col-md-6 text-right item">[Edit]</div>
                        -->
                    </div>
                </div>

                <div class="row-gap-medium"></div>

                <div class="row noprint">
                    <div class="col-xs-12">
                        <a href="#apply-form-modal" class="openform"><button class="large pull-right btn btn-blue">Submit request</button></a>
                    </div>
                </div>

                <div class="row-gap-medium"></div>
            </div>
        </div>
    </div>
</div>

<style>#re_check-error{display: none;}</style>
<!-- // Apply Form Start -->
<div id="apply-form-modal" class="apply-form-modal" style="display: none;">
    <div class="header-top-apply">
        <div class="container text-center">
            <h2 class="text-bold">Apply Your Resume</h2>
        </div>
    </div>
    <div class="row-gap-large"></div>
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <form id="apply-form" name="apply-form" class="form-horizontal" action="<?php echo bloginfo('url') ?>/jobs-apply" target="iapply" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                    <label for="re_email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="re_email" name="re_email" placeholder="Email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="re_fullname" class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="re_fullname" name="re_fullname" placeholder="Full Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="re_tel" class="col-sm-2 control-label">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="re_tel" name="re_tel" placeholder="Phone Number">
                    </div>
                </div>

                <div class="form-group">
                    <label for="re_gender" class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="re_gender[]" id="re_gender_m" value="m" checked>Male
                            </label>
                            <label>
                                <input type="radio" name="re_gender[]" id="re_gender_f" value="f">Female
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="re_attach" class="col-sm-2 control-label">Attach CV</label>
                    <div class="col-sm-10">
                        <input type="file" id="re_attach" name="re_attach" />
                    </div>
                </div>
                
                <div class="row-gap-medium"></div>
                <div class="form-group">
                    <label for="content" class="col-sm-2 control-label">Terms - Privacy</label>
                </div>
                <div class="box">
                    <div class="row">
                        <div class="col-xs-10 nano">
                            <p class="nano-content content">
                                EVOLABLE ASIA Co., Ltd (sau đây gọi là [Công ty chúng tôi]) qui định chính sách bên dưới nhằm mục đích bảo mật thông tin và quản lý việc sử dụng thông tin cá nhân một cách hợp lý để người sử dụng yên tâm sử dụng website của công ty(sau đây gọi là [Website]).<br/><br/>
                                <span class="text-bold">Định nghĩa thông tin cá nhân</span>
                                <br/><br/>
                                [Thông tin cá nhân] ở phần chính sách riêng tư là những thông tin được nhận dạng là cá nhân như: họ tên, ngày tháng năm sinh, địa chỉ, số điện thoại, địa chỉ mail ... (bao gồm cả những thông tin không được nhận định là thông tin cá nhân nhưng có thể dễ dàng đối chiếu với những thông tin khác, để nhận dạng ra cá nhân đó)<br/><br/>
                                <span class="text-bold">Tuân thủ luật liên quan</span>
                                <br/><br/>
                                Công ty chúng tôi luôn nỗ lực bảo vệ thông tin cá nhân, tuân thủ nghiêm ngặt chính sách riêng tư, chủ trương của cơ quan có thẩm quyền và các luật liên quan đến việc bảo vệ thông tin cá nhân, đặc biệt là [Luật bảo vệ thông tin cá nhân]<br/><br/>
                                <span class="text-bold">Về việc thu thập thông tin cá nhân</span>
                                <br/><br/>
                                Công ty chúng tôi sẽ thu thập thông tin cá nhân có trên đơn đăng ký dự thi trên website trong phạm vi mục đích sử dụng.<br/><br/>
                                <span class="text-bold">Mục đích sử dụng</span>
                                <br/><br/>
                                Những thông tin cá nhân lấy từ form đăng ký chỉ sử dụng cho mục đích tuyển dụng, ngoài ra không sử dụng vào mục đích khác.<br/><br/>
                                <span class="text-bold">Cung cấp cho bên thứ 3</span>
                                <br/><br/>
                                Công ty chúng tôi không cung cấp thông tin cá nhân của người sử dụng trên website cho bên thứ 3, trừ những trường hợp sau đây. Được sự đồng ý của người sử dụng. Khi cơ quan pháp luật có yêu cầu Khi người sử dụng gây tổn hại hoặc có nguy cơ gây tổn hại đến công ty chúng tôi hay người sử dụng khác. Khi dữ liệu thống kê chuyển sang trạng thái không thể nhận dạng cá nhân<br/><br/>
                                <span class="text-bold">Quản lý an toàn</span>
                                <br/><br/>
                                Công ty chúng tôi thực hiện mọi biện pháp an toàn để quản lý nghiêm ngặt thông tin cá nhân, ngăn chặn việc thông tin bị rò rỉ, lưu chuyển, sửa đổi trái phép bởi sự xâm nhập bất chính của bên thứ 3.<br/><br/>
                                <span class="text-bold">Thủ tục yêu cầu hiển thị - Chỉnh sửa - Ngưng sử dụng thông tin cá nhân</span>
                                <br/><br/>
                                Công ty chúng tôi sẽ cố gắng xác nhận thông tin người dùng để hồi đáp một cách thích hợp và nhanh nhất trong phạm vi cần thiết khi có yêu cầu từ người sử dụng về việc hiển thị, chỉnh sửa, thêm mới, xóa, ngưng sử dụng dữ liệu cá nhân có được liên quan đến người sử dụng.<br/><br/>
                                <span class="text-bold">Liên tục cải tiến</span>
                                <br/><br/>
                                Nhằm hướng tới việc sử dụng thông tin cá nhân một cách thích hợp, công ty chúng tôi sẽ liên tục cải tiến và đánh giá lại chính sách bảo mật này.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row-gap-small"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="checkbox">
                            <label for="re_check">
                                <input type="checkbox" id="re_check" name="re_check" value="" checked>
                                I agree to the Evolable Asia Terms and Privacy.
                            </label>
                            <br/>
                            <label id="re_check-error" class="error" for="re_check">Bạn có đồng ý ứng tuyển vị trí. Vui lòng check bên dưới</label>
                        </div>
                    </div>
                </div>
                <div class="row-gap-medium"></div>
                <div class="row">
                    <div class="col-xs-3 col-xs-offset-9">
                        <button class="btn btn-block btn-orange" type="submit" name="apply" value="job">Apply</button>
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

<?php get_footer(); ?>