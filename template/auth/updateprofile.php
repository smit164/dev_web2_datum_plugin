<?php
 global $datum_user;
?>
<style>
    #registerFrm #oepl_reg_1_back {
        margin-top: 10px;
    }
</style>
<div class="datum_modal_wrapper datum_modal_wrapper_signup datum_modal_transition">
    <div class="datum_login_popupbox">
        <h2>Update Profile</h2>
        <a class="datum_login_close" href="javascript:void(0);">&times;</a>
        <div class="datum_login_content">
            <div class="datum_form_wizard update_step">
                <div class="datum_steps">
                    <ul>
                        <li class="d_step_1"> <span></span> Contact Information </li>
                        <li class="d_step_2"> <span></span> Acquisition Criteria </li>
                        <li class="d_step_3"> <span></span> Complete </li>
                    </ul>
                </div>
                <div class="datum_form_wizard_container">
                    <form id="registerFrm" class="registerFrm" method="post">
                        <div class="datum_main_form_container d_step_1">
                            <?php echo do_action('datum_update' ,1); ?>
                            <button class="datum_btn_primary btn-lg next datum_float_right mb-30" id="next_button" type="submit"> Next </button>
                        </div>
                        <div class="datum_main_form_container d_step_2">
                            <?php include 'step/step-2.php'; ?>
                            <input type="button" value="Back" id="oepl_reg_1_back" class="datum_btn_primary btn-lg datum_float_left mb-30 back">
                            <input type="submit" value="Complete" class="datum_btn_primary btn-lg next datum_float_right mb-30">
                        </div>
                        <div class="datum_main_form_container d_step_3">
                            <div class="datum_signup_popup_laststep">
                                <div class="datum_form_group">
                                    <h3 class="text-center">Thank you for updating your profile.</h3>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="step" class="cu_step" value="1">
                        <div class="datum_main_form_container d_step_4">
                            <div class="row">
                                <h2 style="text-align: center;" id="oepl_ty">Thank You for verification</h2>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="datum_main_form_container ds_step_3">
                <div class="datum_signup_popup_laststep">
                    <div class="datum_form_group">
                        <h3 class="text-center">Thank you for updating your profile.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php
    global $datum_user;

    if($datum_user->get_user_address_details_relation->Country == 'US'){
        ?>
        $('.state_text_id').hide();
        $('.state_text_select').show();
        <?php
    }else{ ?>
        $('.state_text_select').hide();
        $('.state_text_id').show();
    <?php
    }

    if($datum_user->IndustryRoleId == 1){ ?>
        $('#i_am_<?php echo $datum_user->IndustryRoleId; ?>').prop('checked', true);
        <?php
        if($datum_user->InvestorTypeId == 1) {
            ?>
                $('#investor_type_<?php echo $datum_user->InvestorTypeId; ?>').prop('checked', true);
            <?php
        } elseif ($datum_user->InvestorTypeId == 2) {
            ?>
                $('#investor_type_<?php echo $datum_user->InvestorTypeId; ?>').prop('checked', true);
            <?php
        } elseif ($datum_user->InvestorTypeId == 3) {
            ?>
                $('#investor_type_<?php echo $datum_user->InvestorTypeId; ?>').prop('checked', true);
            <?php
        }
        ?>
        $('input[name=brokertype]').prop('checked', false);
        $('#oepl_brokerType').hide();
        $('#oepl_investor').show();
        $('.datum_steps .d_step_2').html('<span></span> Acquisition Criteria');
    <?php } elseif ($datum_user->IndustryRoleId == 2) { ?>
        $('#i_am_<?php echo $datum_user->IndustryRoleId; ?>').prop('checked', true);
            <?php
            if($datum_user->BrokerTypeId == 1) {
            ?>
                $('#brokertype_h_<?php echo $datum_user->BrokerTypeId; ?>').prop('checked', true);
            <?php
            } elseif ($datum_user->BrokerTypeId == 2) {
            ?>
                $('#brokertype_h_<?php echo $datum_user->BrokerTypeId; ?>').prop('checked', true);
            <?php
            } elseif ($datum_user->BrokerTypeId == 3) {
            ?>
                $('#brokertype_h_<?php echo $datum_user->BrokerTypeId; ?>').prop('checked', true);
            <?php
            }
            ?>
        $('#oepl_brokerType').show();
        $('input[name=investor]').prop('checked', false);
        $('#oepl_investor').hide();
        $('.datum_steps .d_step_2').html('<span></span> Client Acquisition Criteria');
    <?php } else { ?>
        $('#i_am_<?php echo $datum_user->IndustryRoleId; ?>').prop('checked', true);
        $('input[name=investor]').prop('checked', false);
        $('input[name=brokertype]').prop('checked', false);
        $('#oepl_investor').hide();
        $('#oepl_brokerType').hide();
        $('.datum_steps .d_step_2').html('<span></span> Acquisition Criteria');
    <?php }
    ?>

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

    $('.ds_step_3').hide();
    $(".datum_steps li:nth-of-type(1)").addClass("active");
    $(".datum_main_form_container:nth-of-type(1)").addClass("active");

    jQuery.validator.addMethod("lettersonlyfirstname", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please provide a valid first name");

    jQuery.validator.addMethod("lettersonlylastname", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please provide a valid last name");


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
                required: $(".cu_step").val() == '1' ? true : false
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
                minlength: "Password must contain at least 8 characters"
            }
        },
        submitHandler: function(form) {
            if($(".cu_step").val() == 1){
                var registerFrm = ajax_url+'?action=update_profile';
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
                var registerFrm = ajax_url+'?action=update_profile';
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
                            $('.cu_step').val(3);
                            $('#user_id').val(res.data.user_id);
                            $('.datum_steps li').removeClass('active');
                            $('.update_step').html('');
                            $('.ds_step_3').show();

                            break;
                        case 'failure' :
                             _res = res.data.html;
                            $(form).find('.js-error').html('');
                            //  Show validate messages
                            $.each(_res, function(index, val) {
                                $(form).find(':input[name="' + index + '"]').closest('.datum_row_group').find('.js-error').html(val);
                            });
                            break;
                        default :
                            break;
                    }
                    loadinghide();
                });
            }else{
                $(".cu_step").val(2);
            }
            //$(form).find('[type="submit"]').prop('disabled', true);
            return false;
        }
    });
    //$(document).ready(function() {
    $('.phone_number').inputmask("999-999-9999");
    $('.step_2').hide();
    $('.step_3').hide();
    $('.step_4').hide();

    $(document).on("click", ".re_property", function(e) {
        if($(this).prop('checked')){
            $(this).closest('li').find('.re_property_sub').prop('checked', true);
        }else{
            $(this).closest('li').find('.re_property_sub').prop('checked', false);
        }
    });

    $(document).on("click", ".re_property_sub", function(e) {
        var parentOfParent = $(this).closest('li').find('.re_property_sub');
        var unchecked = 0;
        parentOfParent.each(function() {
            var checked = $(this).prop('checked')
            if(!checked) {
                unchecked = unchecked + 1;
            }
        });
        if( unchecked != 0 ) {
            $(this).closest('li').find('.re_property').prop('checked', false)
        } else {
            $(this).closest('li').find('.re_property').prop('checked', true)
        }

    });
    if($('#datum_file_show').attr('data-id') == 1){
        $('#datum_photo_hide').hide();
    }

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


    jQuery(document).on('click','#login_page',function(e){
        //popupHtml('login_html');
        $('.datum_signup_popup').hide();
        $('.datum_login_popup').trigger('click');
    });
    jQuery(document).on('click','#oepl_user_reg',function(e){
        $('#registerFrm').validate();
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