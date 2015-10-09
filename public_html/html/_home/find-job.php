<div class="header-find-job">
    <div class="container">
        <h2 class="text-center">Find your dream jobs</h2>
        <div class="row-gap-medium"></div>
        <div class="col-xs-12 col-md-8 list l-col">
            <div class="row">
                <div class="header"></div>
                <h3>Jobs</h3>
            </div>
            <div class="row info">
                <h4><a href="" title="">Urgent! Nhan vien xu ly du lieu tieng Nhat <i class="highlight">(New)</i></a></h4>
                <p>Ho Chi Minh | Team leader/Supervisor</p>
            </div>
            <div class="row info odd">
                <h4><a href="" title="">Urgent! Nhan vien xu ly du lieu tieng Nhat <i class="highlight">(New)</i></a></h4>
                <p>Ho Chi Minh | Team leader/Supervisor</p>
            </div>
            <div class="row info">
                <h4><a href="" title="">Urgent! Nhan vien xu ly du lieu tieng Nhat <i class="highlight">(New)</i></a></h4>
                <p>Ho Chi Minh | Team leader/Supervisor</p>
            </div>
            <div class="row info odd">
                <h4><a href="" title="">Urgent! Nhan vien xu ly du lieu tieng Nhat <i class="highlight">(New)</i></a></h4>
                <p>Ho Chi Minh | Team leader/Supervisor</p>
            </div>
            <div class="row info">
                <h4><a href="" title="">Urgent! Nhan vien xu ly du lieu tieng Nhat <i class="highlight">(New)</i></a></h4>
                <p>Ho Chi Minh | Team leader/Supervisor</p>
            </div>
            <div class="row info see-all-job-overlay"></div>
            <div class="see-all-job">
                <a href="#">See all jobs</a>
            </div>
        </div>
        <div class="col-xs-12 col-md-4 list r-col">
            <div class="row">
                <div class="header"></div>
                <h3>Featured Employers</h3>
            </div>
            <div class="row-gap-medium space"></div>
            <div class="row ads">
                <a href="#" title="">
                    <h4>Lab name</h4>
                    <span class="overlay"></span>
                    <img src="img/find_jobs/1.png" alt="" />
                </a>
            </div>
            <div class="row ads">
                <a href="#" title="">
                    <h4>Lab name</h4>
                    <span class="overlay"></span>
                    <img src="img/find_jobs/1.png" alt="" />
                </a>
            </div>
            <div class="row ads">
                <a href="#" title="">
                    <h4>Lab name</h4>
                    <span class="overlay"></span>
                    <img src="img/find_jobs/1.png" alt="" />
                </a>
            </div>
            <div class="row ads">
                <a href="#" title="">
                    <h4>Lab name</h4>
                    <span class="overlay"></span>
                    <img src="img/find_jobs/1.png" alt="" />
                </a>
            </div>
            <div class="row ads">
                <a href="#" title="">
                    <h4>Lab name</h4>
                    <span class="overlay"></span>
                    <img src="img/find_jobs/1.png" alt="" />
                </a>
            </div>
            <div class="row ads">
                <a href="#" title="">
                    <h4>Lab name</h4>
                    <span class="overlay"></span>
                    <img src="img/find_jobs/1.png" alt="" />
                </a>
            </div>
            <div class="row ads">
                <a href="#" title="">
                    <h4>Lab name</h4>
                    <span class="overlay"></span>
                    <img src="img/find_jobs/1.png" alt="" />
                </a>
            </div>
            <div class="row ads">
                <a href="#" title="">
                    <h4>Lab name</h4>
                    <span class="overlay"></span>
                    <img src="img/find_jobs/1.png" alt="" />
                </a>
            </div>
            <div class="row ads">
                <a href="#" title="">
                    <h4>Lab name</h4>
                    <span class="overlay"></span>
                    <img src="img/find_jobs/1.png" alt="" />
                </a>
            </div>
            <div class="row paging">
                <ul>
                    <li data-index="0" class="active"></li>
                    <li data-index="1"></li>
                    <li data-index="2"></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.paging').find('li').click(function() {
            var current = $(this).data('index');
            var paging = $(this).parents('.paging');
            paging.siblings('.ads').hide();
            paging.find('li').removeClass('active');
            $(this).addClass('active');
            for (var i = current * 3; i < (current * 3) + 3; i++) {
                paging.siblings('.ads').eq(i).show();
            };
        });
        $('.ads').hide();
        $('.paging li:eq(0)').click();
    });
</script>