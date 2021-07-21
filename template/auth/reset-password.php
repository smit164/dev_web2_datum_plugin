<div class="datum_modal_wrapper datum_modal_transition">
    <div class="datum_login_popupbox">
        <h2>Reset Password</h2>
        <a class="datum_login_close" href="javascript:void(0);">&times;</a>
        <div class="datum_login_content">
            <form id="reset-password" method="post" name="reset-password">
                <input type="hidden" name="reset_token" value="Zv9OdXqPnRQAT2ELar6X2dcXapR2Dp">
                <div class="datum_form_group" style="margin-top: 15px;">
                    <label class="datum_label">Password</label>
                    <input type="password" name="new_password" class="datum_form-control" id="new_password">
                </div>
                <div class="datum_form_group">
                    <label class="datum_label">Reenter Password<span>*</span></label>
                    <input type="password" name="reenter_password" class="datum_form-control">
                </div>
                <button type="submit" class="datum_btn_primary btn-lg">Reset Password</button>
            </form>
            <div class="datum_poweredbytext" >
                <p>Powered By <img src="<?php echo plugins_url() ?>/datum/images/general/DatatoDeals.png"> </p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $("#reset-password").validate({
        rules: {
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
            new_password: {
                required: "Please provide a current password",
                minlength: "Password must contain at least 8 characters"
            },
            reenter_password: {
                required: "Please provide a reenter password",
                minlength: "Password must contain at least 8 characters"
            }
        },
        submitHandler: function(form) {
            $(form).find('[type="submit"]').prop('disabled', true);

            var resetFrm = ajax_url+'?action=reset_password';
            jQuery.ajax({
                type    : 'POST',
                url     : resetFrm,
                data    :  $(form).serialize(),
                dataType: 'json',
                beforeSend : function() {
                    loadingshow();
                },
                success : function(res) {
                    $('#error_login').html('');
                    $(form).find('[type="submit"]').prop('disabled', false);
                    switch(res.data.type) {
                        case 'success' :
                            $('.datum_login_close').trigger( "click" );
                            break;
                        case 'failure' :
                            for(var i in res.data.html) {
                                var msgs = '';
                                if(res.data.html[i].length) {
                                    jQuery("#"+ i ).html(res.data.html[i]);
                                    //jQuery("."+ i ).addClass('alert-text');
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
            return false;
        }
    });


</script>