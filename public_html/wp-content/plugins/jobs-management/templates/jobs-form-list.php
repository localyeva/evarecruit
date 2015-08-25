<?php
/*
 * Author: KhangLe
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}
?>

<div class="header-job-list">
    <div class="container">
        <div class="row-gap-medium"></div>
        <h2 class="text-center">Find your dream jobs</h2>
        <div class="row-gap-large"></div>
        <div class="row">
            <div class="col-xs-12 block-center">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-7 col-md-9">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Nhập chức danh, ngành nghề, từ khóa">
                        </div>
                        <div class="col-xs-offset-1 col-xs-4 col-md-offset-1 col-md-2">
                            <button class="btn btn-block btn-search"><i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i> Tìm kiếm</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-3">
                            <?php
                            $args = array(
                                'orderby' => 'count',
                                'hide_empty' => 0
                            );
                            $positions = get_terms('job-position', $args);
                            ?>
                            <select name = "position" class = "form-control">
                                <option value="">-- Select Position --</option>
                                <?php foreach ($positions as $position): ?>
                                    <option value="<?php echo $position->term_id ?>"><?php echo $position->name ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="col-xs-3">
                            <?php
                            $args = array(
                                'orderby' => 'count',
                                'hide_empty' => 0
                            );
                            $locations = get_terms('job-location', $args);
                            ?>
                            <select name="location" class="form-control">
                                <option value="">-- Select Location --</option>
                                <?php foreach ($locations as $location): ?>
                                <option value="<?php echo $location->term_id ?>"><?php echo $location->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="stat">
                            <a href="#" class="white-link">BPO (2)</a> <span class="vertical-bar">|</span> Communicator (2) <span class="vertical-bar">|</span> BSE (1) <span class="vertical-bar">|</span> Developer (11)</p>
                    </div>
                </div>
                <div class="row-gap-small"></div>
                <!-- list of jobs -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="item-list nano">
                            <!--                            <div class="nano-content">
                                                            {% for post in posts %}
                                                            <div class="row item" data-postid="{{ post.ID }}">
                                                                <div class="col-xs-1 status {{ post.status }} "></div>
                                                                <div class="col-xs-6">
                                                                    <div class="title">{{ post.title }}</div>
                                                                    <div class="text-muted"></div>
                                                                </div>
                                                            </div>
                                                            {% endfor %}
                                                        </div>-->
                            <div class="nano-content">
                                <div class="row item">
                                    <div class="col-xs-1 status">NEW</div>
                                    <div class="col-xs-6">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                </div>
                                <div class="row item">
                                    <div class="col-xs-1 status">NEW</div>
                                    <div class="col-xs-6">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                </div>
                                <div class="row item">
                                    <div class="col-xs-1 status">NEW</div>
                                    <div class="col-xs-6">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                </div>
                                <div class="row item">
                                    <div class="col-xs-1 status">NEW</div>
                                    <div class="col-xs-6">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                </div>
                                <div class="row item">
                                    <div class="col-xs-1 status">NEW</div>
                                    <div class="col-xs-6">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                </div>
                                <div class="row item">
                                    <div class="col-xs-1 status">NEW</div>
                                    <div class="col-xs-6">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                </div>
                                <div class="row item">
                                    <div class="col-xs-1 status">NEW</div>
                                    <div class="col-xs-6">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                </div>
                                <div class="row item">
                                    <div class="col-xs-1 status">NEW</div>
                                    <div class="col-xs-6">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                </div>
                                <div class="row item">
                                    <div class="col-xs-1 status">NEW</div>
                                    <div class="col-xs-6">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="title">Factory Director - Secretary</div>
                                        <div class="text-muted">04 AUG 2015 TP.HCM</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-gap-large"></div>
                <!-- end of job list -->
            </div>
        </div>
    </div>
</div>