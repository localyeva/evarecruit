/*------------------------------------------------------------------ Scroll To*/
jQuery.fn.extend(
        {
            scrollTo: function (speed, easing)
            {
                return this.each(function ()
                {
                    var targetOffset = $(this).offset().top;
                    $('html,body').animate({scrollTop: targetOffset}, speed, easing);
                });
            }
        });

/*---------------------------------------------------------------- Nano Scroll*/
$(function () {
//    console.log($('div.nano').length);
    $(".nano").nanoScroller();
});

/*------------------------------------------------------------- Top Nav Button*/
$(window).load(function () {
    var goto = window.location.hash;
    if (goto != '') {
        $(goto).scrollTo(500);
    }
});

$(function () {

    $('a').on('click', function () {
        if ($(this).data('goto') != '') {
            var goto = $(this).data('goto');
            $('#' + goto).scrollTo(500);
        }
    });

    $('#navigation li button.navbar-btn').click(function () {
        location.href = $(this).data('url');
    });
});

/*-------------------------------------------------------------------- Gallery*/
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

/*----------------------------------------------------------------- Google Map*/
$(function () {
    if (typeof google === 'object' && typeof google.maps === 'object') {

        //
        var map_data = $.parseJSON(vars.map_data);
        var markers = [];
        var map;
        var infowindow = new google.maps.InfoWindow({size: new google.maps.Size(150, 50)});
        var center = new google.maps.LatLng(16.0755818, 108.22209129999999);
        //
        function initMap() {

            var myOptions = {
                zoom: 5,
                center: center,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById('map'), myOptions);

            google.maps.event.addListener(map, 'click', function () {
                infowindow.close();
            });

            drop();

            $('.map-marker').on('click', function () {
                map.setCenter(center);
                map.setZoom(5);
            });

            $('.map-focus').on('click', function () {
                $("#map").scrollTo('slow');
                var lat = $(this).data('lat');
                var lng = $(this).data('lng');
                map.setCenter(new google.maps.LatLng(lat, lng));
                map.setZoom(17);
            });
        }

        function drop() {
            var i = 0;
            map_data.forEach(function (data) {
                addMarkerWithTimeout(new google.maps.LatLng(data.lat, data.lng), data, i * 500);
                i++;
            });
        }

        function addMarkerWithTimeout(position, data, timeout) {
            window.setTimeout(function () {
                var marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    animation: google.maps.Animation.DROP
                });
                markers.push(marker);
                //
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.close();
                    //
                    infowindow = new google.maps.InfoWindow({content: '<b>' + data.main_location + '</b><br/>' + data.address});
                    infowindow.open(map, marker);
                });
                //
            }, timeout);
        }

        google.maps.event.addDomListener(window, 'load', initMap);
    }
});

/*----------------------------------------------------------- Global Services*/
$('#navigation li button.navbar-btn').click(function () {
    location.href = $(this).data('url');
});

/*----------------------------------------------------------- Work Environment*/
$("a.photo").fancybox({
    helpers: {
        title: {
            type: 'inside'
        }
    }
});

$('.image-wrapper').mouseover(function (e) {
    var that = this;
    $(this).find('.text-wrapper').css({backgroundColor: $(that).data('bg-color')});
    e.stopPropagation();
}).mouseout(function (e) {
    $(this).find('.text-wrapper').css({backgroundColor: '#fff'});
    e.stopPropagation();
});

$('#responsive-menu-button').sidr({
    name: 'sidr-main',
    source: '#navigation'
});
/*-----------------------------------------------------------------------Menu */
$(function () {
    $('#navigation li button.navbar-btn').click(function () {
        location.href = $(this).data('url');
    });
    $('#responsive-menu-button').click(function (e) {
        e.stopPropagation();
    });
    // hide mobile right sidebar menu on tab body
    var hideMobilemenu = function () {
        if ($('#sidr-main').is(':visible')) {
            $('#responsive-menu-button').trigger('click');
        }
    }
    $('body').click(function (e) {
        hideMobilemenu();
    });
    $(window).resize(function (e) {
        hideMobilemenu();
    });
})

$(function () {
    var $item = $('#carousel-captions .item');
    var position = $item.offset();
    var coef = 5;
    $('#carousel-captions').css({
        height: $item.height()
    });
    $(window).resize(function () {
        $('#carousel-captions').css({
            height: $item.height()
        });
    });
});

/* fix top menu */
$(function () {
    var nav = $('.navbar');
    nav.removeClass('navbar-fixed-top');
    $(window).scroll(function (e) {
        var scroll = $(this).scrollTop();
        if (scroll > 50) {
            if (!nav.hasClass('navbar-fixed-top')) {
                nav.addClass('navbar-fixed-top');
            }
        } else {
            if (nav.hasClass('navbar-fixed-top')) {
                nav.removeClass('navbar-fixed-top');
            }
        }
        // console.log(scroll);
        // console.log($('.navbar').position().top);
    });
});

/* Use wow animation */
$(function () {
    var wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 200, // distance to the element when triggering the animation (default is 0)
        mobile: false        // trigger animations on mobile devices (true is default)
    });
    wow.init();
});

/*  Paralax slider */
$(function () {
    var setBanerHeight = function() {
        var headerHeight = $('#mobile-header').height();
        $('#carousel-captions')
            .height($(window).height() - headerHeight)
            .find('.carousel-inner').height($(window).height() - headerHeight)
            .find('.item').each(function() {
                $(this).height($(window).height() - headerHeight);
            });
    }

    $( window ).resize(function() {
        setBanerHeight();
    });

    setBanerHeight();
/*
    $('.header-apply-resume').parallax({
        speed: 0.15,
    });
*/
});

$(function () {
   $("#carousel-captions").swiperight(function() {
      $("#carousel-captions").carousel('prev');
    });
   $("#carousel-captions").swipeleft(function() {
      $("#carousel-captions").carousel('next');
   });
});

$(function () {
    $('#labs-carousel').height($('#labs-carousel').height());
});

$(function () {
    if ($('#carousel-captions').length > 0) {
        $('.carousel').carousel({
            interval: 4000
        });

        $('#carousel-captions').on('slide.bs.carousel', function (event) {
            // do something…
            img_src = $(event.relatedTarget.innerHTML).attr('data-image-src');
            //alert(img_src);

            $("img.parallax-slider").attr('src', img_src);
        });
    }
});
