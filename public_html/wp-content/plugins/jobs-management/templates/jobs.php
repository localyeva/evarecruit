<?php
/*
 * Author: KhangLe
 * Template Name: Jobs
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

get_header();
?>

<div id="new-jobs">
    <!--//Search Bar-->
    <div class="header-search-bar">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-6">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Nhập chức danh, ngành nghề, từ khóa">
                            </div>
                            <div class="col-xs-12 col-xs-3">
                                <select name="position" class="form-control">
                                    <option value="">Vị trí</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-xs-3">
                                <select name="position" class="form-control">
                                    <option value="">Địa điểm</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="row-gap-medium"></div>
                    <div class="row-gap-small"></div>
                    <div class="row">
                        <div class="col-xs-12 col-md-10">
                            <p class="stat">BPO (2) <span class="vertical-bar">|</span> Communicator (2) <span class="vertical-bar">|</span> BSE (1) <span class="vertical-bar">|</span> Developer (11)</p>
                        </div>
                        <div class="col-xs-12 col-md-2 pull-right">
                            <button class="btn btn-block btn-search btn-orange"><i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i> Tìm kiếm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--//Search Bar End-->

    <!--//Jobs List-->
    <div class="container header-job-list">
        <!-- hot -->
        <div class="row item hot">
            <div class="col-xs-6">
                <div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                <div class="info">
                    <span class="localtion">Ho Chi Minh</span> | <span class="level">Team Leader/Supervisor</span>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="text-blue">Internation Skill</div>
                <div class="text-blue">Technical Field Knowledge</div>
                <div class="text-blue">Management & Leadership</div>
            </div>
            <div class="col-xs-3">
                <div><img class="date" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/4.png" alt=""> Posted: 13/08/2015</div>
                <div><img class="view" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/5.png" alt=""> Views: 92</div>
            </div>
        </div>

        <div class="row item hot">
            <div class="col-xs-6">
                <div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                <div class="info">
                    <span class="localtion">Ho Chi Minh</span> | <span class="level">Team Leader/Supervisor</span>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="text-blue">Internation Skill</div>
                <div class="text-blue">Technical Field Knowledge</div>
                <div class="text-blue">Management & Leadership</div>
            </div>
            <div class="col-xs-3">
                <div><img class="date" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/4.png" alt=""> Posted: 13/08/2015</div>
                <div><img class="view" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/5.png" alt=""> Views: 92</div>
            </div>
        </div>

        <div class="row item hot">
            <div class="col-xs-6">
                <div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                <div class="info">
                    <span class="localtion">Ho Chi Minh</span> | <span class="level">Team Leader/Supervisor</span>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="text-blue">Internation Skill</div>
                <div class="text-blue">Technical Field Knowledge</div>
                <div class="text-blue">Management & Leadership</div>
            </div>
            <div class="col-xs-3">
                <div><img class="date" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/4.png" alt=""> Posted: 13/08/2015</div>
                <div><img class="view" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/5.png" alt=""> Views: 92</div>
            </div>
        </div>
        <!-- lastest -->
        <div class="row item">
            <div class="col-xs-6">
                <div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                <div class="info">
                    <span class="localtion">Ho Chi Minh</span> | <span class="level">Team Leader/Supervisor</span>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="text-blue">Internation Skill</div>
                <div class="text-blue">Technical Field Knowledge</div>
                <div class="text-blue">Management & Leadership</div>
            </div>
            <div class="col-xs-3">
                <div><img class="date" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/4.png" alt=""> Posted: 13/08/2015</div>
                <div><img class="view" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/5.png" alt=""> Views: 92</div>
            </div>
        </div>

        <div class="row item">
            <div class="col-xs-6">
                <div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                <div class="info">
                    <span class="localtion">Ho Chi Minh</span> | <span class="level">Team Leader/Supervisor</span>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="text-blue">Internation Skill</div>
                <div class="text-blue">Technical Field Knowledge</div>
                <div class="text-blue">Management & Leadership</div>
            </div>
            <div class="col-xs-3">
                <div><img class="date" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/4.png" alt=""> Posted: 13/08/2015</div>
                <div><img class="view" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/5.png" alt=""> Views: 92</div>
            </div>
        </div>

        <div class="row item">
            <div class="col-xs-6">
                <div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                <div class="info">
                    <span class="localtion">Ho Chi Minh</span> | <span class="level">Team Leader/Supervisor</span>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="text-blue">Internation Skill</div>
                <div class="text-blue">Technical Field Knowledge</div>
                <div class="text-blue">Management & Leadership</div>
            </div>
            <div class="col-xs-3">
                <div><img class="date" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/4.png" alt=""> Posted: 13/08/2015</div>
                <div><img class="view" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/5.png" alt=""> Views: 92</div>
            </div>
        </div>

        <div class="row item">
            <div class="col-xs-6">
                <div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                <div class="info">
                    <span class="localtion">Ho Chi Minh</span> | <span class="level">Team Leader/Supervisor</span>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="text-blue">Internation Skill</div>
                <div class="text-blue">Technical Field Knowledge</div>
                <div class="text-blue">Management & Leadership</div>
            </div>
            <div class="col-xs-3">
                <div><img class="date" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/4.png" alt=""> Posted: 13/08/2015</div>
                <div><img class="view" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/5.png" alt=""> Views: 92</div>
            </div>
        </div>

        <div class="row item">
            <div class="col-xs-6">
                <div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                <div class="info">
                    <span class="localtion">Ho Chi Minh</span> | <span class="level">Team Leader/Supervisor</span>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="text-blue">Internation Skill</div>
                <div class="text-blue">Technical Field Knowledge</div>
                <div class="text-blue">Management & Leadership</div>
            </div>
            <div class="col-xs-3">
                <div><img class="date" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/4.png" alt=""> Posted: 13/08/2015</div>
                <div><img class="view" src="<?php echo $jobs_management->get_plugin_url() ?>/img/new_job/5.png" alt=""> Views: 92</div>
            </div>
        </div>
    </div>
    <!--//Jobs List End-->

    <!--//Paging-->
    <div class="container">
        <div class="row">
            <div class="col-xs-12 no-padding-l">
                <nav>
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">Prev</span>
                            </a>
                        </li>
                        <li><a href="#" class="active">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--//Paging End-->

<?php get_footer(); ?>