<div class="datum_modal_wrapper datum_modal_transition">
    <div class="datum_login_popupbox">
        <h2>Reset Password</h2>
        <a class="datum_login_close" href="javascript:void(0);">&times;</a>
        <div class="datum_login_content">
            <form id="forgot_password" method="post" name="forgot_password">
                <div class="datum_form_group" style="margin-top: 15px;">
                    <label class="datum_label">New Password</label>
                    <input type="text" name="new_password" class="datum_form-control">
                </div>
                <div class="datum_form_group">
                    <label class="datum_label">Reenter New Password<span>*</span></label>
                    <input type="password" name="re_password" class="datum_form-control">
                </div>
                <button type="submit" class="datum_btn_primary btn-lg">Change Password</button>
            </form>
            <input type="hidden" name="main" value="" id="popup_main">
            <div class="datum_poweredbytext" >
                <p>Powered By <img src="<?php echo plugins_url() ?>/datum/images/general/DatatoDeals.png"> </p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $("#forgot_password").validate({
        rules: {
            new_password: {
                required: true,
                 minlength: 8
            },
            re_password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            email: {
                required: "Please provide a new password",
                minlength: "Password must contain at least 8 characters"
            },
            password: {
                required: "Please provide a reenter new password",
                minlength: "Password must contain at least 8 characters"
            }
        },
        submitHandler: function(form) {
            $(form).find('[type="submit"]').prop('disabled', true);
            
            var loginFrm = ajax_url+'?action=loginFrm';
            //var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
            //var data = new FormData(this);
            jQuery.ajax({
                type    : 'POST', 
                url     : loginFrm,
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
                        if($('#popup_main').val() == 1){
                            if(res.data.IsAccountVerified == 1){
                                location.reload();
                            }else{
                                $('#datum_popup_html').html(res.data.html);
                            }
                        }else{

                            if(res.data.otp){
                            }else{
                                if(typeof res.data.favorite == 'undefined') {
                                    $('#datum_popup_html').html(res.data.html);
                                } else {
                                    if(res.data.favorite.popup) {
                                        $('#datum_popup_html').html(res.data.html);
                                    } else {
                                        if(res.data.favorite.favrite) {
                                            if( typeof res.data.favorite.property_id != 'undefined' ) {
                                                $('label#datum_property_id_'+res.data.favorite.property_id+' input[type="checkbox"]').prop( "checked", true );
                                                if($('.datum_modal').hasClass('is-visible')){
                                                    $('.datum_modal').toggleClass('is-visible');
                                                }
                                            } else {
                                                $('label#datum_property_id_'+res.data.favorite.property_id+' input[type="checkbox"]').prop( "checked", true );
                                                if($('.datum_modal').hasClass('is-visible')){
                                                    $('.datum_modal').toggleClass('is-visible');
                                                }
                                            }
                                            
                                        } 
                                        if(res.data.favorite.remove_favrite) {
                                            if( typeof res.data.favorite.property_id != 'undefined' ) {
                                                $('label#datum_property_id_'+res.data.favorite.property_id+' input[type="checkbox"]').prop( "checked", false );
                                                if($('.datum_modal').hasClass('is-visible')){
                                                    $('.datum_modal').toggleClass('is-visible');
                                                } 
                                            } else {
                                                $('label.datum_star_toggle input[type="checkbox"]').prop( "checked", false );
                                                if($('.datum_modal').hasClass('is-visible')){
                                                    $('.datum_modal').toggleClass('is-visible');
                                                }    
                                            }
                                            
                                        }
                                    }
                                }
                                $('#open_register').removeClass('hide_s');
                                
                            }
                        }
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