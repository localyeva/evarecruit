$(function () {
    $(".nano").nanoScroller();
});

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

$(function () {
    //
    var map_data = $.parseJSON(vars.map_data);
    var markers = [];
    var map;
    var infowindow = new google.maps.InfoWindow(
            {
                size: new google.maps.Size(150, 50)
            });
    //
    function initMap() {

        var myOptions = {
            zoom: 5,
            center: new google.maps.LatLng(16.0755818, 108.22209129999999),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById('map'), myOptions);

        google.maps.event.addListener(map, 'click', function () {
            infowindow.close();
        });

        drop();
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
});