<div class="datum_modal_wrapper datum_modal_transition">
    <div class="datum_login_popupbox">
        <h2>Change Password</h2>
        <a class="datum_login_close" href="javascript:void(0);">&times;</a>
        <div class="datum_login_content">
            <form id="datum_change_password_form" method="post" name="datum_change_password_form">
                <input type="hidden" name="change_password" value="yes">
                <div class="datum_form_group" style="margin-top: 15px;">
                    <label class="datum_label"><?php  _e("Current Password",'datum'); ?><span>*</span> </label>
                    <input type="password" id="current_password" name="current_password" class="datum_form-control">
                    <span class="error js-error"></span>
                </div>
                <div class="datum_form_group">
                    <label class="datum_label"><?php  _e("New Password",'datum'); ?><span>*</span></label>
                    <input type="password" id="new_password" name="new_password" class="datum_form-control">
                    <span class="error js-error"></span>
                </div>
                <div class="datum_form_group">
                    <label class="datum_label"><?php  _e("Reenter New Password",'datum'); ?><span>*</span></label>
                    <input type="password" id="reenter_password" name="reenter_password" class="datum_form-control">
                    <span class="error js-error"></span>
                </div>
                <div class="datum_row datum_change-pw-row">
                    <input type="button" id="back_to_update_profile" class="datum_btn_primary btn-lg datum_float_left top-space datum_float_left datum_model_open datum_btn_grey btn-lg" value="Return to Profile" data-popup="register_html">
                    <button type="submit" class="datum_btn_primary btn-lg top-space datum_float_right "><?php  _e("Update",'datum'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .top-space {
        margin-top: 10px;
    }
    .datum_float_left {
        float: inherit !important;
    }
</style>
<script type="text/javascript">
$("#datum_change_password_form").validate({
    rules: {
        current_password: {
            required: true,
            minlength: 8
        },
        new_password: {
            required: true,
            minlength: 8
        },
        reenter_password: {
            required: true,
            minlength: 8,
            equalTo: "#new_password"
        }
    },
    messages: {
        current_password: {
            required: "Please provide a current password",
            minlength: "Password must contain at least 8 characters"
        },
        new_password: {
            required: "Please provide a new password",
            minlength: "Password must contain at least 8 characters"
        },
        reenter_password: {
            required: "Please provide a reenter new password",
            minlength: "Password must contain at least 8 characters"
        }
    },
    submitHandler: function(form) {
        var changePassword = ajax_url+'?action=changed_password';
        $.ajax({
            url: changePassword,
            type: 'POST',
            dataType: 'JSON',
            data: $(form).serialize(),
            beforeSend: function() {
                //$(form).find('[type="submit"]').prop('disabled', true);
            }
        }).done(function(res) {
            switch(res.data.type) {
                case 'success' :
                    if(!$('.datum_modal').hasClass('is-visible')){
                        $('.datum_modal').toggleClass('is-visible');
                    }
                    location.reload();
                    //$('#datum_popup_html').html(res.data.html);
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
        }); 
    }
});
back_to_update_profile
</script>