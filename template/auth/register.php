<style type="text/css">
    .js-error{
        font-weight: 400;
        font-size: 14px;
        color: #D22630;
    }
</style>
<div class="datum_modal_wrapper datum_modal_wrapper_signup datum_modal_transition">
    <div class="datum_login_popupbox">
        <h2>Register</h2>
		<p id="reg_step1">Please enter your information to complete your registration.</p>
		<p id="reg_step3" style="display:none;">Please verify your email to complete your registration.</p>
    <!--     <p>Please login to access the requested information.</p> -->
        <a class="datum_login_close" href="javascript:void(0);">&times;</a>
        <div class="datum_login_content">
            <div class="datum_form_wizard">
                <div class="datum_steps">
                    <ul>
                        <li class="d_step_1"> <span></span> Contact Information </li>
                        <li class="d_step_2"> <span></span> Details </li>
                        <li class="d_step_3"> <span></span> Complete </li>
                    </ul>
                </div>
                <div class="datum_form_wizard_container">
                    <form id="registerFrm" class="registerFrm" method="post" enctype="multipart/form-data">     
                        <div class="datum_main_form_container d_step_1">
                            <?php echo do_action('datum_sign' ,1); ?>
                            <!-- <a class="datum_btn_grey btn-lg mt-15 mb-15 login_page" id="login_page">Return to Login</a> -->
                            <button class="datum_btn_primary btn-lg next datum_float_right mt-15 mb-15" id="next_button" type="submit"> Next </button>
                        </div>
                        <div class="datum_main_form_container d_step_2">
                            <?php include 'step/step-2.php'; ?>
                            <div class="datum_row mt-30">
                                <div class="datum_col_12">
                                    <input type="button" value="Back" id="oepl_reg_1_back" class="datum_btn_grey btn-lg datum_float_left mb-30 back">
                                    <input type="submit" value="Complete" class="datum_btn_primary btn-lg next datum_float_right mb-30">
                                </div>
                            </div>
                        </div>
                        <div class="datum_main_form_container d_step_3">
                            <div class="datum_signup_popup_laststep">
                                <div class="datum_form_group">
                                    <h3 class="text-center">Thank You</h3>
                                    <p class="text-center">We have sent a one-time verification code to your email. Please enter code for verification and access.</p>
                                    <input type="text" class="datum_form-control" id="oepl_otp">
                                </div>
                                <span class="error js-error" id="otp_validation"></span>
                                <div class="datum_form_group text-center mar-b-0">
                                    <input type="button" value="Verify" id="oepl_user_verify" class="datum_btn_primary btn-lg mb-30">
                                    <input type="submit" value="Resend Email" id="oepl_resend" class="datum_btn_primary btn-lg mb-30">
                                </div>
                                <input type="hidden" name="user_id" class="user_id" id="user_id" value="">
                                <input type="hidden" name="step" class="cu_step" value="1">
                            </div>
                        </div>
                        <div class="datum_main_form_container d_step_4">
                            <div class="row">
                                <h2 style="text-align: center;" id="oepl_ty">Thank You for verification</h2>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div> 
<script type="text/javascript">

    $(document).ready(function() {
        $(".datum_checkbox-accordian li .answer").hide();
        $(".datum_checkbox-accordian li span").click(function(){
            if($(this).closest("li").hasClass("active")){
                $(this).closest("li").removeClass("active").find(".answer").slideUp();
                $(".datum_checkbox-accordian li.active .answer").slideUp();
                $(this).text('+');
            }else{
                $(".datum_checkbox-accordian li.active").removeClass("active");
                $(this).closest("li").addClass("active").find(".answer").slideDown();
                $(this).text('-');
            }
        });
        $(".datum_checkbox-accordian > li > .answer").hide();


    });
    jQuery.validator.addMethod("lettersonlyfirstname", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please provide a valid first name");

    jQuery.validator.addMethod("lettersonlylastname", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please provide a valid last name");

    //$(".datum_checkbox-accordian li span").click(function(){}

    $(".datum_steps li:nth-of-type(1)").addClass("active");
    $(".datum_main_form_container:nth-of-type(1)").addClass("active");
    $("#registerFrm").validate({
        rules: {
            first_name: {
                required: $(".cu_step").val() == '1' ? true : false,
                maxlength: 50,
                lettersonlyfirstname: true
            },
            last_name: {
                required: $(".cu_step").val() == '1' ? true : false,
                maxlength: 50,
                lettersonlylastname: true
            },
            street: {
                required: $(".cu_step").val() == '1' ? true : false,
            },
            city: {
                required: $(".cu_step").val() == '1' ? true : false,
            },
            state: {
                required: $(".cu_step").val() == '1' ? true : false,
            },
            i_am: {
                required: $(".cu_step").val() == '1' ? true : false,
            },
            country: {
                required: $(".cu_step").val() == '1' ? true : false,
            },
            zipcode: {
                required: $(".cu_step").val() == '1' ? true : false,
                maxlength:10
            },
            state_select: {
                required: $(".cu_step").val() == '1' ? $("#country_lead").val() == 'US' ? true : false : false,
            },
            state_text: {
                required: $(".cu_step").val() == '1' ? $("#country_lead").val() != 'US' ? true : false : false,
            },
            cell_phone: {
                required: $(".cu_step").val() == '1' ? true : false,
				minlength:10
            },
            email: {
                required: $(".cu_step").val() == '1' ? true : false
            },
            reenter_email_address: {
                required: $(".cu_step").val() == '1' ? true : false,
                equalTo: "#email"
            },
            password: {
                required: $(".cu_step").val() == '1' ? true : false,
                minlength: 8
            },
            confirm_password: {
                required: $(".cu_step").val() == '1' ? true : false,
                minlength: 8,
                equalTo: "#password"
            },
            i_am_h: {
                required: $(".cu_step").val() == '1' ? true : false,
            },
            exchange_status: {
                required: $(".cu_step").val() == '2' ? true : false,
            },
        },
        messages: {
            first_name: {
                required: "Please provide a first name",
                maxlength: "Please provide a valid first name"
            },
            last_name: {
                required: "Please provide a last name",
                maxlength: "Please provide a valid last name"
            },
            street: {
                required: "Please provide a street",
            },
            city: {
                required: "Please provide a city",
            },
            zipcode: {
                required: "Please provide a zip code",
                maxlength: "Please provide a valid zip code"
            },
            cell_phone: {
                required: "Please provide a work phone",
				minlength: "Please provide a valid work phone"
            },
            i_am: {
                required: "Please provide a industry role",
            },
            state_text: {
                required: "Please provide a state",
            },
            state_select: {
                required: "Please provide a state",
            },
            email: {
                required: "Please provide an email address",
                email: "Please provide a valid email address"
            },
            country: {
                required: "Please provide an country",
            },
            phone: {
                required: "Please provide a phone number",
            },
            password: {
                required: "Please provide a password",
                minlength: "Password must contain at least 8 characters"
            },
            confirm_password: {
                required: "Please provide a confirm password",
            },
            reenter_email_address: {
                required: "Please provide a reenter email address",
                equalTo: "Please enter the same email address"
            }
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
            if($(".cu_step").val() == 1){
                var registerFrm = ajax_url+'?action=sing_in';
                var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
                var formData = new FormData(form);
                $.ajax({
                    url: registerFrm,
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
                            //$('.datum_steps li').removeClass('active');
                            $('#registerFrm .datum_main_form_container').removeClass('active');
                            $('.d_step_2').addClass('active');
                            $('.cu_step').val(2);
                            break;
                        case 'failure' :
                            _res = res.data.html;
                            $(form).find('.js-error').html('');
                            //  Show validate messages
                            $.each(_res, function(index, val) {
                                $(form).find(':input[name="' + index + '"]').closest('.datum_form_group').find('.js-error').html(val);
                            });
                            
                            break;
                        default :
                            break;
                    }
                    loadinghide();
                });
            }else if($(".cu_step").val() == 2){
                if(!$("input:radio[name='exchange_status']").is(":checked")) {
                    $('#exchange_status_check').html('Please provide a 1031 Exchange Status.');
                    return;
                }
                var registerFrm = ajax_url+'?action=sing_in';
                var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
                var formData = new FormData(form);
                var fileInput = document.getElementById('profile_avatar');

                var file = fileInput.files[0];
                formData.append('avatar', file);
                $.ajax({
                    url: registerFrm,
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
                            $('#datum_popup_html').html(res.data.html);
                            break;
                        case 'failure' :
                             _res = res.data.html;
                            $(form).find('.js-error').html('');
                            //  Show validate messages
                            $.each(_res, function(index, val) {
                                $(form).find(':input[name="' + index + '"]').closest('.datum_row').find('.js-error').html(val);
                            });
                            break;
                        default :
                            break;
                    }
                    loadinghide();
                });    
            }else{
                $(".cu_step").val(2);
                loadinghide();
            }
            //$(form).find('[type="submit"]').prop('disabled', true);
            return false;
        }
    });

    $('#oepl_investor').hide();
    $('#oepl_brokerType').hide();
    //$(document).ready(function() {
        $('.phone_number').inputmask("999-999-9999");
        $('.step_2').hide();
        $('.step_3').hide();
        $('.step_4').hide();
    
    if($('#country_lead').val() == 'US'){
        $('.state_text_id').hide();
        $('.state_text_select').show();
    }else{
        $('.state_text_select').hide();
        $('.state_text_id').show();
    }

    jQuery(document).on('change','#country_lead',function(e){
        if($(this).val() == 'US'){
            $('.state_text_id').hide();
            $('.state_text_select').show();
            $("#state_lead").rules("add", {
                required: true,
                messages: {
                required: "Please provide a state"
              }
            });
            $("#street_text_box").rules("add", {
                required: false,
                messages: {
                required: "Please provide a state"
              }
            });
        }else{
            $('.state_text_select').hide();
            $('.state_text_id').show();
            $("#street_text_box").rules("add", {
                required: true,
                messages: {
                required: "Please provide a state"
              }
            });
            $("#state_lead").rules("add", {
                required: false,
                messages: {
                required: "Please provide a state"
              }
            });
        }
    });
    jQuery(document).on('click','#oepl_reg_1_back',function(e){
        $('.datum_steps li').removeClass('active');
        $('#registerFrm .datum_main_form_container').removeClass('active');
        $('.d_step_1').addClass('active');
        $('.cu_step').val('1');
    });
    $(".show_password_texbox").click(function(){
        var password = $(this).closest('.datum_pw_box').find('input');
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
/*    jQuery(document).on('click','#next_button',function(e){
        alert(5);
        $('#registerFrm').validate();
    });
*/
    
    $(document).on("click", ".re_property", function(e) {
        
        if($(this).prop('checked')){
            $('.re_property').prop('checked', false);
            $(this).prop('checked', true);
            $('.re_property_sub').prop('checked', false);
            $(this).closest('li').find('.re_property_sub').prop('checked', true); 
        }else{
            $(this).closest('li').find('.re_property_sub').prop('checked', false);
        }
    });
    $(document).on("click", ".re_property_sub", function(e) {
        var parentOfParent = $(this).closest('li').find('.re_property_sub');
        var unchecked = 0;
        var yourArray = [];


        parentOfParent.each(function() {
            var checked = $(this).prop('checked');
            if($(this).prop('checked')){
                yourArray.push($(this).val());
            }
            if(!checked) {
                unchecked = unchecked + 1;
            }
        });

        if($(this).closest('.re_property').prop('checked')){
              
        }else{
            $('.re_property').prop('checked',false);
            $('.re_property_sub').prop('checked',false);
        }
        


        
        if(unchecked != 0) {
            $(this).closest('li').find('.re_property').prop('checked', false);
        }else {
            $(this).closest('li').find('.re_property').prop('checked', true);
        }


        if(yourArray.length){
            for(var i = 0; i < Object.keys(yourArray).length; i++) {
                $('#reg_'+yourArray[i]).prop('checked', true);
            }
        }
    });

    jQuery(document).on('click','#login_page',function(e){
        popupHtml('login_html');
    });

    jQuery(document).on('click','#oepl_user_reg',function(e){
        $('#registerFrm').validate();
    });

    jQuery(document).on('click','#oepl_user_verify',function(e){

        if($('#oepl_otp').val()){

            var otp_verify = ajax_url+'?action=otp_verify';
            var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
            //var data = new FormData(this);
            jQuery.ajax({
                type    : 'POST', 
                url     : otp_verify,
                data    :  {'user_id':$('#user_id').val(),'otp':$('#oepl_otp').val()},
                dataType: 'json',
                beforeSend : function() {
                    loadingshow();
                },
                success : function(res) {
                   switch(res.data.type) {
                        case 'success' :
                                $('#registerFrm .d_step_3').removeClass('active');
                                $('#registerFrm .d_step_4').addClass('active');
                            break;
                        case 'failure' :
                            $('#otp_validation').html(res.data.html);
    /*                         _res = res.data.html;
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
        }else{
            $('#otp_validation').html('Please provide a verification code');  
        }

    });

    jQuery(document).on('click','#oepl_resend',function(e){
        var otp_resend = ajax_url+'?action=otp_resend';
        var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
        //var data = new FormData(this);
        jQuery.ajax({
            type    : 'POST', 
            url     : otp_resend,
            data    :  {'user_id':$('#user_id').val()},
            dataType: 'json',
            beforeSend : function() {
                loadingshow();
            },
            success : function(res) {
               switch(res.data.type) {
                    case 'success' :
                        
                        break;
                    case 'failure' :
                        for(var i in res.data.html) {
                            var msgs = '';
                            if(res.data.html[i].length) {                                
                                jQuery("#"+ i ).html(msgTemplate.replace(/{{type}}/g, 'danger').replace(/{{msg}}/g, res.data.html[i]));
                                jQuery("."+ i ).addClass('alert-text');
                            }
                        }
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

    $('input[name="i_am"]').change(function(){
        var prof_i_am = $( 'input[name=i_am]:checked' ).val();
        if(prof_i_am == '1'){
            $('input[name=brokertype]').prop('checked', false);
            $('#oepl_brokerType').hide();
            $('#oepl_investor').show();
            $('.datum_steps .d_step_2').html('<span></span> Acquisition Criteria');
        } else if (prof_i_am == '2') {
            $('#oepl_brokerType').show();
            $('input[name=investor]').prop('checked', false);
            $('#oepl_investor').hide();
            $('.datum_steps .d_step_2').html('<span></span> Client Acquisition Criteria');
        } else {
            $('input[name=investor]').prop('checked', false);
            $('input[name=brokertype]').prop('checked', false);
            $('#oepl_investor').hide();
            $('#oepl_brokerType').hide();
            $('.datum_steps .d_step_2').html('<span></span> Acquisition Criteria');
        }
    });

    $("#password").keyup(function() {
        strength = 0;
        var password = $(this).val();
        passwordCheck(password);
    });
    function passwordCheck(password) {
        if (password.length >= 8)
            strength += 1;

        if (password.match(/(?=.*[0-9])/))
            strength += 1;

        if (password.match(/(?=.*[!,%,&,@,#,$,^,*,?,_,~,<,>,])/))
            strength += 1;

        if (password.match(/(?=.*[a-z])/))
            strength += 1;

        if (password.match(/(?=.*[A-Z])/))
            strength += 1;

        displayBar(strength);
    }
    function _showFormError(form, _res) {
        //  Show validate messages
        $(form).find('.js-error').html('');
        //  Show validate messages
        $.each(_res, function(index, val) {
            $(form).find(':input[name="' + index + '"]').closest('.control-group').find('.js-error').html(val);
        });
    }
    function displayBar(strength) {
        
        switch (strength) {
        case 1:
            $(".pswrd_strngth_text").text('Weak');
            $("#password-strength span").css({
                "width" : "20%",
                "background" : "#000F9F"
            });
            break;

        case 2:
            $(".pswrd_strngth_text").text('Weak');
            $("#password-strength span").css({
                "width" : "40%",
                "background" : "#000F9F"
            });
            break;

        case 3:
            $(".pswrd_strngth_text").text('So-so');
            $("#password-strength span").css({
                "width" : "60%",
                "background" : "#000F9F"
            });
            break;

        case 4:
            $(".pswrd_strngth_text").text('So-so');
            $("#password-strength span").css({
                "width" : "80%",
                "background" : "#000F9F"
            });
            break;

        case 5:
            $(".pswrd_strngth_text").text('Great');
            $("#password-strength span").css({
                "width" : "100%",
                "background" : "#000F9F"
            });
            break;

        default:
            $(".pswrd_strngth_text").text('Weak');
            $("#password-strength span").css({
                "width" : "0",
                "background" : "#000F9F"
            });
        }
    }
   // });
</script>