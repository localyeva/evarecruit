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
                required: true
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