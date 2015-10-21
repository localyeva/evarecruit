<div class="row-gap-large"></div>
<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		<form class="input-form col-xs-12 col-md-12" enctype="multipart/form-data">
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
                <label style="width: 20%;">Gender</label>
                <label class="option"><i class="radio"></i><input name="gender" type="radio" value="0" style="display:none;" />Male</label>
                <label class="option"><i class="radio"></i><input name="gender" type="radio" value="1" style="display:none;" />Female</label>
            </fieldset>
            <fieldset class="upload-cv">
                <label style="width: 20%;">Attach CV</label>
                <input type="file" placeholder="Phone number" style="display: none;" />
                <input type="button" value="Browse" />
                <span class="filename">No file select</span>
            </fieldset>
            <div class="blankline"></div>
            <div class="row-gap-medium"></div>
            <div class="box nano has-scrollbar">
                <!-- <div class="row"> -->
                    <div class="nano-content">
                        <p>
                            <span class="text-bold">EVOLABLE ASIA Co., Ltd</span> consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                <!-- </div> -->
                <div class="nano-pane"><div class="nano-slider"></div></div>
            </div>
            <div class="row-gap-small"></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="checkbox">
                      <label class="option">
                        <input type="checkbox" value="1" />
                        I agree to the Evolable Asia Terms and Privacy
                      </label>
                    </div>
                </div>
            </div>
            <fieldset>
                <a href="" class="submit col-xs-12 col-md-4 float-right">Apply</a>
            </fieldset>
        </form>
	</div>
</div>
<script type="text/javascript" src="js/jquery.nanoscroller.min.js"></script>
<script type="text/javascript">
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
        $(".nano").nanoScroller();
    });
</script>