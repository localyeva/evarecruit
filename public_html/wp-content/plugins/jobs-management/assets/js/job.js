$().ready(function () {

    var form_valid = $('#apply-form');
    form_valid.validate_popover({
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
            're_email': 'Vui lòng kiểm tra email',
            're_fullname': 'Vui lòng nhập tên',
            're_tel': 'Vui lòng nhập điện thoại',
            're_attach': {
                required: 'Vui lòng Upload CV của bạn',
                extension: 'Chỉ chấp nhận định dạng .pdf, .doc, .docx, .xls, .xlsx'
            }
        },
        submitHandler: function (form) {
            if ($('#re_check').is(':checked')) {
                form.submit();
            } else {
                alert('Bạn có đồng ý ứng tuyển vị trí. Vui lòng check bên dưới');
            }
            return false;
        }
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

});


function get_iframe_result(data) {
    var rs = jQuery.parseJSON(data);
    //
    if (rs.code == 'ERR') {
        $.each(rs.message, function (key, value) {
            $('#' + key).after('<label id="' + key + '-error" class="error" for="' + key + '">' + value + '</label>');
        });
    } else {
        alert(rs.message);
        $('#apply-form')[0].reset();
        $('.fancybox-close').fancybox().trigger('click');
    }
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

/* Featured Employers */
$(document).ready(function () {
    $('.paging').find('li').click(function () {
        var current = $(this).data('index');
        var paging = $(this).parents('.paging');
        paging.siblings('.ads').hide();
        paging.find('li').removeClass('active');
        $(this).addClass('active');
        for (var i = current * 3; i < (current * 3) + 3; i++) {
            paging.siblings('.ads').eq(i).show();
        }
        ;
    });
    $('.ads').hide();
    $('.paging li:eq(0)').click();
});

/* Apply */
$(document).ready(function () {
    $('.upload-cv').find('input:button').click(function () {
        var fileUpload = $(this).siblings('input:file');
        fileUpload.click();

    });
    $("input:file").change(function () {
        var fileName = $(this).val();
        $(this).siblings(".filename").html(fileName);
    });
    $('.radiogroup > label.option').click(function () {
        var radioGroup = $(this).parent('.radiogroup');
        radioGroup.find('.radio').removeClass('checked');
        $(this).children('.radio').addClass('checked').children('input:radio').click();
    });
    $('.submit').click(function (event) {
        event.preventDefault();
        $(this).parents('form').submit();
    });
});