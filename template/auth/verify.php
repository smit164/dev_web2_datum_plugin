<style type="text/css">
    .js-error{
        font-weight: 400;
    font-size: 12px;
    color: #D22630;
    }
    .datum_modal_overlay {
        overflow-x: scroll;
        overflow-y: scroll;
    }
    #registerFrm #oepl_reg_1_back {
        margin-top: 10px;
    }
    .hide_S{
        display: none;
    }
</style>
<?php

?>
<div class="datum_modal_wrapper datum_modal_wrapper_signup datum_modal_transition">
    <div class="datum_login_popupbox">
        <h2>Register</h2>
		<p>Please enter your information to complete your registration.</p>
    <!--     <p>Please login to access the requested information.</p> -->
        <a class="datum_login_close" href="javascript:void(0);">&times;</a>
        <div class="datum_login_content">
            <div class="datum_form_wizard">
                <div class="datum_steps">
                    <ul>
                        <li class="d_step_1 active"> <span></span> Contact Information </li>
                        <li class="d_step_2 active"> <span></span> Details </li>
                        <li class="d_step_3 active"> <span></span> Complete </li>
                    </ul>
                </div>
                <div class="datum_form_wizard_container">
                        <div class="datum_main_form_container active">
                            <div class="datum_signup_popup_laststep">
                                <div style="margin-top: 20px;" id="datum_verify_email" class="datum_verify_email">
                                    <p>To verify your email, we've send a unique link to <span><strong class="email_s_send" id="email_s_send"><?php echo getDMUserEmail() ?></strong></span>.</p> 
									<p>To change your email please <a href="javascript:void(0)" id="change_email_datum" class="change_email_opel blue-text">click here</a>.</p>
                                    <p>If you did not receive an email:</p>
                                    <ul class="popup-list">
                                       <li>Confirm that your email address was entered correctly above.</li>
                                       <li>Check your spam or junk folder</li>
                                       <li><a class="send_sms_opel blue-text" data-id="1" id="send_sms_datum" href="javascript:void(0)">Click here</a> to complete your registration via SMS verification.</li>
                                    </ul>
                                    <p id="resend-email-success-message"></p>
                                    <input type="submit" id="resend_email" value="Resend Email" class="datum_btn_primary btn-lg mb-30">
                                 </div>
                                <div style="margin-top: 20px;" id="datum_verify_to_change_email" class="datum_verify_to_change_email">
                                    <form id="changeEmailFrm" class="changeEmailFrm" method="post" enctype="multipart/form-data">
                                    <div class="datum_row">
                                       <div class="datum_col_12">
                                          <p> If you want to change email address. </p>
                                       </div>
                                    </div>
                                    <div class="datum_row">
                                        <div class="datum_col_6">
                                            <div class="datum_form_group">
                                             <label class="datum_label">Email Address<span>*</span></label>
                                             <input type="text" value="<?php echo getDMUserEmail() ?>" class="datum_form-control" value="" name="email" id="email_change_address">
                                             <label id="email-error" class="error js-error" for="email"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="datum_row">
                                        <div class="datum_col_6">
                                            <div class="datum_form_group datum_pw_box">
                                                <label class="datum_label">Password</label>
                                                <input type="password" data-strength="" class="datum_form-control password-field" autocomplete="new-password" name="datum_password_h" id="chang_password_new">
                                                <span toggle="#oepl_password_h" class="fa fa-eye-slash field-icon toggle-password-h npcg_np1 show_password_field"></span>
                                                <div id="password-strength1" class="strength" style="height: 0px; width: 0px; margin-top: 0px;"><span style="width: 20%; background: rgb(0, 15, 159) none repeat scroll 0% 0%;"></span></div>
                                                 <p class="pswrd_strngth_text" style="display: none;">Weak</p>
                                                 <label id="password-error" class="error" for="password"></label>
                                            </div>
                                        </div>
                                        <div class="datum_col_6">
                                            <div class="datum_form_group datum_pw_box">
                                                <label class="datum_label">Reenter Password</label>
                                                <input type="password" class="datum_form-control password-field1" autocomplete="new-password" name="datum_confirm_pass_h" id="chang_password_re_new">
                                                <span toggle="#oepl_password_h" class="fa fa-eye-slash field-icon toggle-password-h npcg_np1 show_password_field1"></span>
                                            </div>
                                        </div>
                                        <div class="mt-15 datum_col_12">
                                            <span id="change_mgs_update"></span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value="<?php echo getDMUserId(); ?>" id="datum_user_id">
                                    <div class="datum_row">
                                       <div class="datum_col_12 datum_bottom_btns">
                                          <input type="button" id="back_verify_back" value="Back" class="datum_btn_primary btn-lg datum_float_left mb-30">
                                          <input type="submit" value="Update" id="update_email" class="datum_btn_primary btn-lg datum_float_right mb-30">
                                       </div>
                                    </div>
                                    </form>
                                </div>
                                <div style="margin-top: 20px;" id="datum_verify_to_send_sms" class="datum_verify_to_send_sms">
                                    <form id="verifyMobileNo" class="verifyMobileNo" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="user_id" value="<?php echo getDMUserId(); ?>" id="datum_user_id">
                                        <div class="datum_row">
                                           <div class="datum_col_12">
                                              <p> Please enter your mobile phone to receive a one-time verification code. </p>
                                           </div>
                                        </div>
                                        <div class="datum_row">
                                           <div class="datum_col_6">
                                              <div class="datum_form_group">
                                                 <label class="datum_label">Mobile Phone<span>*</span></label>
                                                 <input type="text" value="<?php echo getDMUserWorkPhone(); ?>" name="mobile_phone" id="mobile_new" class="datum_form-control">
                                                 <span class="error js-error"></span>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="datum_row">
                                           <div class="datum_col_6">
                                              <div class="datum_form_group">
                                                 <label class="datum_label">Verification Code<span>*</span></label>
                                                 <input type="text" name="otp" id="verify_code" class="datum_form-control disabled" disabled="disabled">
                                                 <span class="error js-error" id="verify_code_er"></span>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="datum_row">
                                           <div class="datum_col_12">
                                                <p class="text-left counter_r">OTP Expires in <span class="text-blue e-m-minutes"> <strong>02</strong></span> : <span class="text-blue e-m-seconds"><strong>00</strong></span></p>
                                                <a href="javascript:void(0)" id="resend_otp" value="Resend Code" class="hide_S text-blue">Click here to resend a one-time verification code</a>
                                           </div>
                                        </div>
                                        <div class="datum_row">
                                            <div class="mt-15 datum_col_12">
                                                <span id="change_mgs_update_mobile"></span> 
                                            </div>
                                        </div>
                                        <div class="datum_row">
                                           <div class="datum_col_12 datum_bottom_btns">
                                              <input type="button" id="back_verify_back" value="Back" class="datum_btn_primary btn-lg datum_float_left mb-30">


                                              <input type="submit" id="send_otp" value="Send OTP" class="datum_btn_primary btn-lg datum_float_right mb-30">
                                              <input type="submit" data-id="" id="verify" value="Verify" class="datum_btn_primary btn-lg datum_float_right mb-30 mr-15 hide_S">
                                           </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div> 
</div> 
<script type="text/javascript">

    $(document).ready(function() {
        $('#mobile_new').inputmask("999-999-9999");
        $('#verify_code').inputmask("999-999");
        $('#datum_verify_to_change_email').hide();
        $('#datum_verify_to_send_sms').hide();

        jQuery(document).on('click','#send_sms_datum',function(e){
            $('#datum_verify_email').hide();
            $('#datum_verify_to_change_email').hide();
            $('#datum_verify_to_send_sms').show();
            $('#change_mgs_update_mobile').html('');
        });
        
        jQuery(document).on('click','#change_email_datum',function(e){
            $('#change_mgs_update').html('');
            $('#datum_verify_email').hide();
            $('#datum_verify_to_send_sms').hide();
            $('#datum_verify_to_change_email').show();
        });

        jQuery(document).on('click','#back_verify_back',function(e){
            $('#datum_verify_email').show();
            $('#datum_verify_to_send_sms').hide();
            $('#datum_verify_to_change_email').hide();
        });

        jQuery(document).on('click','#resend_otp',function(e){
            $('#verify_code').val('');
            $('#verify').attr('data-id','');
            $('.counter_r .e-m-minutes').html('02');
            $('.counter_r .e-m-seconds').html('00');
            $( "#verifyMobileNo" ).submit();
            $(this).hide();
        });

        jQuery(document).on('click','#resend_email',function(e){
            var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
            //var data = new FormData(this);
            jQuery.ajax({
                type    : 'POST', 
                url     : ajax_url,
                data    :  {'action':'resend_email', 'user_id':<?php echo getDMUserId(); ?>},
                dataType: 'json',
                beforeSend : function() {
                    loadingshow();
                },
                success : function(res) {
                   switch(res.data.type) {
                        case 'success' :
                            $('#resend-email-success-message').addClass('datum_success');
                            $("#resend-email-success-message").text(res.data.html);
                            setTimeout(function(){
                                $('#resend-email-success-message').html('');
                                $('#resend-email-success-message').removeClass('datum_success');
                            }, 2000);
                            $('#registerFrm .d_step_3').removeClass('active');
                            $('#registerFrm .d_step_4').addClass('active');
                            break;
                        case 'failure' :
                            //$('#resend-email-success-message').addClass('datum_success');
                            $('#otp_validation').html(res.data.html);
                            break;
                        default :
                            break;
                    }
                },
                complete : function() {
                    loadinghide();
                }
            });
        });

        $("#changeEmailFrm").validate({
            rules: {
                email: {
                    required: true
                },
                datum_password_h: {
                    required: false,
                    minlength: 8
                },
                datum_confirm_pass_h: {
                    required: $("#chang_password_new").val() != '' ? true : false,
                    minlength: 8,
                    equalTo: "#chang_password_new"
                },
            },
            messages: {
                email: {
                    required: "Please provide an email address",
                    email: "Please enter a valid email address"
                },
                datum_password_h: {
                    required: "Please provide a password",
                    minlength: "Password must contain at least 8 characters"
                },
                datum_confirm_pass_h: {
                    required: "Please provide a confirm password",
                },
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "i_am"){
                    element.closest('.datum_form_group').append(error);
                }else if(element.attr("name") == "avatar"){
                    element.closest('.datum_profile_avatar').append(error);
                }else{
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {            
                    var update_email = ajax_url+'?action=update_email';
                    var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
                    var formData = new FormData(form);
                    $.ajax({
                        url: update_email,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function() {
                            loadingshow();
                            $(form).find('[type="submit"]').prop('disabled', true);
                        }
                    }).done(function(res) {
                        $(form).find('[type="submit"]').prop('disabled', false);
                        $('span.error, .js-error, .sessError').html('');
                        
                        switch(res.data.type) {
                            case 'success' :
                            loadingshow();
                                $('#change_mgs_update').html(res.data.html);
                                 $('#change_mgs_update').addClass('datum_success');
                                $('#email_s_send').html(res.data.email);
                                setTimeout(function(){ 
                                    $('#datum_verify_email').show();
                                    $('#datum_verify_to_send_sms').hide();
                                    $('#datum_verify_to_change_email').hide(); 
                                    //$('#change_mgs_update').html('Something went wrong please try again.'); 
                                }, 3000);
                                break;
                            case 'failure' :
                                _res = res.data.html;
                                $('#change_mgs_update').addClass('datum_fail');
                                $('#change_mgs_update').html('Something went wrong please try again.'); 

                                $(form).find('.js-error').html('');
                                //  Show validate messages
                                $.each(_res, function(index, val) {
                                    $(form).find(':input[name="' + index + '"]').closest('.datum_form_group').find('.js-error').show();
                                    $(form).find(':input[name="' + index + '"]').closest('.datum_form_group').find('.js-error').html(val);
                                });
                                
                                break;
                            default :
                                break;
                        }
                        loadinghide();
                    });
                
                //$(form).find('[type="submit"]').prop('disabled', true);
                return false;
            }
        });

        /*jQuery(document).on('click','#send_otp',function(e){
            var mobile_new = $('#mobile_new').val();
            var send_otp_url = ajax_url+'?action=send_otp';
            var formData = new FormData(form);
            if(mobile_new){            
                var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
                //var data = new FormData(this);
                jQuery.ajax({
                    type    : 'POST', 
                    url     : send_otp_url,
                    data    : {
                                'action':'send_otp',
                                'work_mobile':mobile_new
                            },
                    dataType: 'json',
                    beforeSend : function() {
                        loadingshow();
                    },
                    success : function(res) {
                       switch(res.data.type) {
                            case 'success' :
                                $('#verify_code').removeClass('disabled');
                                $('#verify_code').removeAttr('disabled');
                                $('#send_otp').addClass('hide_S');
                                $('#verify').removeClass('hide_S');
                                $('#resend_otp').removeClass('hide_S');
                                break;
                            case 'failure':
                                $('#otp_validation').html(res.data.html);
                                break;
                            default :
                                break;
                        }
                    },
                    complete : function() {
                        loadinghide();
                    }
                });
            }else{
                $('#Mobile-error').html('Please provide an Mobile Phone');                
            }
        });*/

        jQuery(document).on('click','#send_otp',function(e){
            //setTimeout(function(){ $('#verify').attr('data-id','1'); }, 1000);
            
        });

        $("#verifyMobileNo").validate({
            rules: {
                mobile_phone: {
                    required: true
                },
                otp: {
                    required: $("#verify").attr('data-id') == 1 ? true : false,
                },
            },
            messages: {
                mobile_phone: {
                    required: "Please provide a mobile no",
                },
                otp: {
                    required: "Please provide a OTP",
                },
            },
            errorPlacement: function(error, element) {

            },
            submitHandler: function(form) {
                var send_otp_url = ajax_url+'?action=send_otp';
                var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
                
                if($("#verify").attr('data-id') == 1 && $("#verify_code").val() == ''){    
                    $('#verify_code_er').html('Please provide a verify code');
                    return;
                }


                if($("#verify").attr('data-id') == 1){
                    $('#verify').removeClass('dis');
                    $('#resend_otp').addClass('dis');
                }

                var formData = new FormData(form);
                $.ajax({
                    url: send_otp_url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
                        loadingshow();
                        $(form).find('[type="submit"]').prop('disabled', true);
                    }
                }).done(function(res) {
                    $(form).find('[type="submit"]').prop('disabled', false);
                    $('span.error, .js-error, .sessError').html('');

                    switch(res.data.type) {
                        case 'success' :
                            loadinghide();
                            $('#change_mgs_update_mobile').removeClass('datum_fail');
                            jQuery('.counter_r .e-m-minutes').html('02');
                            jQuery('.counter_r .e-m-seconds').html('00');
                            $('#change_mgs_update_mobile').addClass('datum_success');
                            $('#change_mgs_update_mobile').html(res.data.html);
                            $('#verify_code').removeAttr('disabled');
                            $('#send_otp').hide();
                            $('#verify').show();
                            $('#verify').attr('data-id','1');
                            
                            var count = getcounter_rData($(".counter_r"));
                            $('#resend_otp').addClass('dis');
                            $('#resend_otp').removeClass('dis');
                            var timer = setInterval(function() {
                                count--;
                                if (count == 0) {
                                    clearInterval(timer);
                                    $('#resend_otp').removeClass('dis');
                                    $('#resend_otp').addClass('dis');
                                    $('.e-m-seconds').html(padToFour(0));
                                    $('#resend_otp').show();
                                    $('#verify').hide();
                                  return;
                                }
                                setcounter_rData(count, $(".counter_r"));
                            }, 1000);
                            setTimeout(function(){ 
                                $('#change_mgs_update_mobile').addClass('datum_fail');
                                $('#change_mgs_update_mobile').html(''); 
                                $('#change_mgs_update_mobile').html(''); 
                                if(res.data.verify == 1){
                                    location.reload();
                                }
                            }, 3000);
                            break;
                        case 'failure' :
                            _res = res.data.html;
                                if(res.data.array == 1){
                                    $(form).find('.js-error').html('');
                                    //  Show validate messages
                                    $.each(_res, function(index, val) {
                                        $(form).find(':input[name="' + index + '"]').closest('.datum_form_group').find('.js-error').show();
                                        $(form).find(':input[name="' + index + '"]').closest('.datum_form_group').find('.js-error').html(val);
                                    });
                                }else{
                                    $('#change_mgs_update_mobile').html(_res);
                                }

                            break;
                        default :
                            break;
                    }
                    loadinghide();
                });

                //$(form).find('[type="submit"]').prop('disabled', true);
                return false;
            }
        });
    });
    function OEPLvalidateEmail(oeplemail) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test(oeplemail);
    }
     function getcounter_rData(obj) {
        var minutes = parseInt($('.e-m-minutes', obj).text());
        var seconds = parseInt($('.e-m-seconds', obj).text());
        return seconds + (minutes * 60);
      }
    function setcounter_rData(s, obj) {
        var minutes = Math.floor((s % (60 * 60)) / 60);
        var seconds = Math.floor(s % 60);
        $('.e-m-minutes', obj).html(padToFour(minutes));
        $('.e-m-seconds', obj).html(padToFour(seconds));
    }
    function padToFour(number) {
      if (number<=99) { number = ("0"+number).slice(-2); }
      return number;
    }

    $(".show_password_field").click(function(){
        var password = $(".password-field");
        var type = "";
        var className = '';
        if(password.attr('type') == "password") {
            type = "text";
            $(this).removeClass("fa-eye-slash");
            $(this).addClass('fa-eye');
        } else {
            type = "password";
            $(this).removeClass("fa-eye");
            $(this).addClass('fa-eye-slash');
        }
        password.attr('type', type);
    });

    $(".show_password_field1").click(function(){
        var password = $(".password-field1");
        var type = "";
        var className = '';
        if(password.attr('type') == "password") {
            type = "text";
            $(this).removeClass("fa-eye-slash");
            $(this).addClass('fa-eye');
        } else {
            type = "password";
            $(this).removeClass("fa-eye");
            $(this).addClass('fa-eye-slash');
        }
        password.attr('type', type);
    });

</script>