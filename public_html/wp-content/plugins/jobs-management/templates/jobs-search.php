<?php
/*
 * Author: KhangLe
 * Template Name: Jobs Search
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

get_header();
?>

<div id="new-jobs">

    <!--//Search Bar-->
    <?php require_once(dirname(__FILE__) . '/job-search-bar.php') ?>
    <!--//Search Bar End-->

    <!--//Jobs List-->
    <div class="container header-job-list">

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