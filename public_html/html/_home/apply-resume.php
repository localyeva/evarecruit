<div class="header-apply-resume">
    <div class="container">
        <form class="input-form col-xs-12 col-md-12" enctype="multipart/form-data">
            <h2>Apply Your Resume</h2>
            <fieldset class="box">
                <i class="icon email"></i>
                <input type="text" placeholder="Email" />
            </fieldset>
            <fieldset class="box">
                <i class="icon user"></i>
                <input type="text" placeholder="Full name" />
            </fieldset>
            <fieldset class="box">
                <i class="icon phone"></i>
                <input type="text" placeholder="Phone number" />
            </fieldset>
            <div class="blankline"></div>
            <fieldset class="radiogroup">
                <label class="option"><i class="radio"></i><input name="gender" type="radio" value="0" style="display:none;" />Male</label>
                <label class="option"><i class="radio"></i><input name="gender" type="radio" value="1" style="display:none;" />Female</label>
            </fieldset>
            <fieldset class="upload-cv">
                <label>Attach CV</label>
                <input type="file" placeholder="Phone number" style="display: none;" />
                <input type="button" value="Browse" />
                <span class="filename">No file select</span>
            </fieldset>
            <div class="blankline"></div>
            <fieldset>
                <a href="" class="submit col-xs-12 col-md-6"><span class="send">Apply</span></a>
            </fieldset>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.upload-cv').find('input:button').click(function() {
            var fileUpload = $(this).siblings('input:file');
            fileUpload.click();

        });
        $("input:file").change(function () {
           var fileName = $(this).val();
           $(this).siblings(".filename").html(fileName);
        });
        $('.radiogroup > label.option').click(function() {
            var radioGroup = $(this).parent('.radiogroup');
            radioGroup.find('.radio').removeClass('checked');
            $(this).children('.radio').addClass('checked').children('input:radio').click();
        });
        $('.submit').click(function(event) {
            event.preventDefault();
            $(this).parents('form').submit();
        });
    });
</script>
