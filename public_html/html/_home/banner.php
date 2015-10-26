<!-- <div class="header-banner">
	<div class="container text-center">
		<div class="row-gap-medium"></div>
		<h1 class="text-bold standout">Welcome Evolable Asia</h1>
		<h2 class="mission">Our mission</h2>
		<h3 clas"out-tro">To be No.1 providing IT software development support in Asia</h3>
	</div>
</div> -->
<div class="bs-carousel" data-carousel-id="carousel-with-captions">
	<div id="carousel-captions" class="carousel slide carousel-fade" data-ride="carousel" data-interval=2000>
		<ol class="carousel-indicators">
			<li data-target="#carousel-captions" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-captions" data-slide-to="1" class=""></li>
			<li data-target="#carousel-captions" data-slide-to="2" class=""></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img alt="900x500" src="img/1.png">

			</div>
			<div class="item">
				<img alt="900x500" src="img/1.png">

			</div>
			<div class="item">
				<img alt="900x500" src="img/1.png">

			</div>
		</div>
		<!-- <a class="left carousel-control" href="#carousel-captions" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-captions" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a> -->
	</div>
</div>
<div class="slide-caption">
    <h1 class="text-bold standout">Our Misstion</h1>
    <h2 class="mission">Test test test tes tse</h2>
    <h3 class="out-tro">fff dafsd asdf asdf asdf</h3>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
	$(function() {
		var $item = $('#carousel-captions .item');
		var position = $item.offset();
		var coef = 5;
		$('#carousel-captions').css({
			height: $item.height()
		});
		/*
		$item.css({
			position: 'fixed',
			top: position.top,
			zIndex: -1
		});*/
		// $(window).scroll(function (e) {
		// 	var scroll = $(this).scrollTop();
		// 	$item.css({
		// 		top: position.top - scroll/coef
		// 	})
		// });
	});
</script>