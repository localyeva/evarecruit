<div class="header-environment">
    <div class="container">
        <div class="row-gap-small"></div>
        <h2 class="text-center">Work Environment</h2>
        <div class="row-gap-large"></div>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <ul class="nav nav-pills nav-justified">
                  <li role="presentation" data-tab=1><a href="#">All</a></li>
                  <li role="presentation" data-tab=2><a href="#">Event</a></li>
                  <li role="presentation" data-tab=3><a href="#">Benifit</a></li>
                  <li role="presentation" data-tab=4><a href="#">Work space</a></li>
                </ul>
            </div>
        </div>
        <div class="row-gap-large"></div>
        <!-- Image gallery -->
        <?php include('./_home/gallery.php'); ?>
</div>
<script type="text/javascript">
    $(function (e) {
        $('.gallery').fadeOut();
        $('.header-environment ul.nav-pills li').click(function (e) {
            var tab = $(this).data('tab');
            $('.header-environment ul.nav-pills li').removeClass('active');
            $(this).addClass('active');
            $('.gallery').fadeOut();
            $('.gallery[data-tab="' + tab + '"]').fadeIn();
            e.preventDefault();
        });
        $('.header-environment ul.nav-pills li:first-child').trigger('click');
    });
</script>