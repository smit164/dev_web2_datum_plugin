<div class="datum_modal_wrapper datum_modal_transition">
<div class="datum_login_popupbox">
    <h2>Forgot Password</h2>
	<p id="subtext">Please enter your registered email address below to reset your password.</p>
    <a class="datum_login_close" href="javascript:void(0);">&times;</a>
    <div class="datum_login_content">
        <form id="forgotFrm" method="post" name="forgotFrm">
            <div class="datum_form_group" style="margin-top: 15px;">
                <label class="datum_label">Email Address<span>*</span> </label>
                <input type="text" name="email" class="datum_form-control">
            </div>
            <div class="datum_form_group">
                <span class="error" id="emil_forgot"></span>
            </div>
           <!--  <a href="javascript:void(0);" id="oepl_frgt_back_h" class="datum_btn_grey btn-lg">Return to Login</a> -->
            <button type="submit" class="datum_btn_primary btn-lg">Send</button>
        </form>
        <div class="datum_poweredbytext" >
            <p>Powered By <img src="<?php echo plugins_url() ?>/datum/images/general/DatatoDeals.png"> </p>
        </div>
    </div>
</div>
</div>
    <script type="text/javascript">
        jQuery(document).on('click','#oepl_frgt_back_h',function(e){
            popupHtml('login_html');
        });
        $("#forgotFrm").validate({
            invalidHandler: function(event, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $('span.error, .js-error').hide('');
                }
            },
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "Please provide an email address",
                    email: "Please enter a valid email address"
                }
            },
            submitHandler: function(form) {
                var forgot_password = ajax_url+'?action=forgot_password';
                var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
                //var data = new FormData(this);
                jQuery.ajax({
                    type    : 'POST', 
                    url     : forgot_password,
                    data    :  $(form).serialize(),
                    dataType: 'json',
                    beforeSend : function() {
                        loadingshow();
                    },
                    success : function(res) {
                       switch(res.data.type) {
                            case 'success' :
                                    $('#subtext').hide();
                                    $('#forgotFrm').html('');
                                    $('#forgotFrm').html("<p class='success'>"+res.data.html+"</p>");
                                break;
                            case 'failure' :
                                $('#subtext').hide();
                                $('#emil_forgot').html("<p class='error'>"+res.data.html+"</p>");
                                /* _res = res.data.html;
                                 _showFormError(form, _res);*/
                                break;
                            default :
                                break;
                        }
                    },
                    complete : function() {
                        loadinghide();
                    }
                });
                return false;
            }
        });
    </script>