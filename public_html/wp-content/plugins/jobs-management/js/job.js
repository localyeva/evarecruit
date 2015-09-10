$(function () {
    $(".nano").nanoScroller();
});

$().ready(function () {

    var form_valid = $('#apply-form');
    form_valid.validate({
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
        var prtContent = $('new-job-detail');
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
//        WinPrint.document.write(cssLinkTag);
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    });
});