jQuery.fn.center = function (parent) {
    if (parent) {
        parent = this.parent();
    } else {
        parent = window;
    }
    this.css({
        "position": "absolute",
        "top": ((($(parent).height() - this.outerHeight()) / 2) + $(parent).scrollTop() + "px"),
        "left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
    });
    return this;
}

$().ready(function () {

    var error_icon_template = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
    var form_valid = $('#apply-form');
    form_valid.validate({
        popoverPosition: 'right',
        rules: {
            're_email': {
                required: true,
                email: true
            },
            're_fullname': {
                required: true
            },
            're_tel': {
                required: true,
                number: true
            },
            're_attach': {
                required: true,
                extension: 'pdf|doc|docx|xls|xlsx'
            }
        },
        messages: {
            're_email': error_icon_template,
            're_fullname': error_icon_template,
            're_tel': error_icon_template,
            're_attach': {
                required: 'Vui lòng Upload CV của bạn',
                extension: 'Chỉ chấp nhận định dạng .pdf, .doc, .docx, .xls, .xlsx'
            }
        },
        submitHandler: function (form) {
            //
            if ($('#re_check').is(':checked')) {
                //
                var re_position;
                var re_position_id = $('#re_position').val();
                switch (re_position_id) {
                    case '1':
                        re_position = $('#re_position option:selected').text() + ' ' + $('#re_programming_language').val();
                        break;
                    case '6':
                        re_position = $('#re_position option:selected').text() + ' ' + $('#re_other_position').val();
                        break;
                    case '':
                        re_position = '';
                        break;
                    default:
                        re_position = $('#re_position option:selected').text();
                        break;
                }
                $('#job_position').val(re_position);
                //
                $('#apply-overlay').show();
                //
                form.submit();
            } else {
                alert('Bạn có đồng ý ứng tuyển vị trí. Vui lòng check bên dưới');
            }
            return false;
        }
    });

    $('#apply-rs-close').on('click', function(){
       $('#apply-rs-overlay').hide();
    });

    $('a.openform').fancybox({
        maxWidth: 900,
//        'scrolling' : 'no',
        afterShow: function () {
//            $('.nano').nanoScroller();
        },
        afterClose: function () {
            $(".error").html('');
            $(".error").removeClass("error");
            return;
        }
    });

    $('a.open-privacy').fancybox({
        maxWidth: 500,
    });

    $('.relative-position').each(function () {
        if ($(this).attr('rel') == $('#re_position').val()) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });

    $('#re_position').change(function () {
        var currentPosition = $(this).val();
        $('.relative-position').each(function () {
            if ($(this).attr('rel') == currentPosition) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

});


function get_iframe_result(data) {
    var rs = jQuery.parseJSON(data);
    //
    $('#apply-overlay').hide();
    if (rs.code == 'ERR') {
        $.each(rs.message, function (key, value) {
            $('#' + key).after('<label id="' + key + '-error" class="error" for="' + key + '">' + value + '</label>');
        });
    } else {
        /* alert(rs.message); */
        $('#apply-rs-overlay').show();
        $('#apply-rs-popup').center(true);
        $('#apply-form')[0].reset();
        $('.fancybox-close').fancybox().trigger('click');
    }
    //
}

$(function () {
    $('#print-job').on('click', function () {
        var prtContent = $('#print-job-part');
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write('<link rel="stylesheet" type="text/css" href="' + jobvars.plugin_url + '/assets/css/job-print.css">');
        WinPrint.document.write(prtContent.html());
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    });
});

$(function () {
    $('#job-carousel-sidebar').height($('#job-carousel-sidebar').height());
});

/* Featured Employers */
/*
$(document).ready(function () {
    var currentPage = 0;
    var blockContentHeight = 0;

    $('.paging').find('li').click(function () {
        var currentPage = $(this).data('index');
        var paging = $(this).parents('.paging');
        paging.siblings('.ads').slideUp();
        paging.siblings('.ads').hide();
        paging.find('li').removeClass('active');
        $(this).addClass('active');
        for (var i = currentPage * 3; i < (currentPage * 3) + 3; i++) {
            paging.siblings('.ads').eq(i).fadeIn();
        }
        if (blockContentHeight == 0 && currentPage == 0) {
            $('.block-content').css('height', 'auto');
            blockContentHeight = $('.block-content').height();
        }
        $('.block-content').height(blockContentHeight);
    });

    setInterval(function() {
        var pageCount = $('.paging ul').children('li').length;
        $('.paging ul').find('li.active').each(function() {
            currentPage = $(this).data('index');
        });
        if (currentPage < pageCount - 1) {
            currentPage ++;
        } else {
            currentPage = 0;
        }
        $('.paging li:eq(' + currentPage + ')').click();
    }, 5000);

    $('.ads').hide();
    $('.paging li:eq(' + currentPage + ')').click();

    $(window).resize(function(){
        blockContentHeight = 0;
        currentPage = 0;
        $('.ads').hide();
        $('.paging li:eq(' + currentPage + ')').click();
    });
});
*/