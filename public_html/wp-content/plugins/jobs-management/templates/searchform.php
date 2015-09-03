<?php
/*
 * Author: KhangLe
 * Template Name: Jobs
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}


//global $wp_query;
//var_dump($wp_query);
// check select position location
?>

<div class="header-search-bar">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <form class="form-horizontal" action="<?php echo bloginfo('url') ?>/jobs/search" method="POST">
                    <div class="form-group">
                        <div class="col-xs-12 col-md-6">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Nhập chức danh, ngành nghề, từ khóa">
                        </div>
                        <div class="col-xs-12 col-xs-3">
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
                        <div class="col-xs-12 col-xs-3">
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
                    <div class="row-gap-medium"></div>
                    <div class="row-gap-small"></div>
                    <div class="row">
                        <div class="col-xs-12 col-md-10">
                            <?php
                            $i = 0;
                            foreach ($positions as $position):
                                ?>
                                <a href="#" class="white-link text-bold"><?php echo $position->name ?> (<?php echo $position->count ?>)</a> 
                                <?php if ($i < count($positions) - 1): ?>
                                    <span class="vertical-bar">|</span> 
                                <?php endif; ?>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                        </div>
                        <div class="col-xs-12 col-md-2 pull-right">
                            <button class="btn btn-block btn-search btn-orange" type="submit"><i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i> Tìm kiếm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>