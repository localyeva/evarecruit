<!-- <nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img alt="Brand" src="img/logo.png">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Home</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Team</a></li>
                <li><a href="#">Contact</a></li>
                <li>
                    <button type="button" class="btn btn-orange navbar-btn">Sign in</button>
                </li>
            </ul>
        </div>
    </div>
</nav> -->
<div id="mobile-header">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a id="responsive-menu-button" class="btn btn-orange navbar-btn" href="#">Menu</a>
            </div>
        </div>
    </nav>
</div>
<div id="navigation">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About EvolableAsia</a></li>
                    <li><a href="#">開発ならエボ</a></li>
                    <li><a href="#">
                        <img class="img-responsives" src="img/29.png">
                    </a></li>
                    <li><a href="#">サービス</a></li>
                    <li><a href="#">ニュース</a></li>
                    <li><a href="#">Recruit</a></li>
                    <li>
                        <a href="#" class="active">お問い合わせ</a>
                    </li>
                    <!-- <li class="navbar-bars">
                        <a href="#"><span class="fa fa-bars fa-lg"></span></a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
</div>
<script type="text/javascript">
    $(function () {
        $('#navigation li button.navbar-btn').click(function () {
            location.href = $(this).data('url');
        });
    })
</script>