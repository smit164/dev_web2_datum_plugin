<div class="datum_modal_wrapper datum_modal_transition">
    <div class="datum_login_popupbox">
        <h2><?php  _e("Contact",'datum'); ?></h2>
        <a class="datum_login_close" href="javascript:void(0);">&times;</a>
        <div class="datum_login_content">
            <form id="Contact_form" method="post" name="Contact_form">
                <input type="hidden" name="property_id" id="propertyId" value="<?php echo getDMPropertyId(); ?>">
                <div class="datum_form_group" style="margin-top: 15px;">
                    <label class="datum_label"><?php  _e("Subject",'datum'); ?><span>*</span> </label>
                    <input type="text" name="subject" value="<?php echo getDMPropertyName(); ?>" class="datum_form-control">
                    <span class="error js-error" id="subject"></span>
                </div>
                <div class="datum_form_group">
                    <label class="datum_label"><?php  _e("Message",'datum'); ?><span>*</span></label>
                    <textarea name="message" class="datum_form-control"></textarea>
                    <span class="error js-error" id="message"></span>
                </div>
                <div class="datum_form_group">
                    <span id="error_login" class="error js-error"></span>
                </div>
                <p class="success-message"></p>
                <button type="submit" class="datum_btn_primary btn-lg"><?php  _e("Send",'datum'); ?></button>
            </form>
            <input type="hidden" name="main" value="" id="popup_main">
            <div class="datum_poweredbytext" >
                <p><?php  _e("Powered By ",'datum'); ?><img src="<?php echo plugins_url() ?>/datum/images/general/DatatoDeals.png"> </p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $("#Contact_form").validate({
        rules: {
            subject: {
                required: true,
            },
            // message: {
            //     required: true,
            //     minlength: 8
            // }
        },
        messages: {
            subject: {
                required: "Please provide a subject",
            },
            // message: {
            //     required: "Please provide a message",
            // }
        },
        submitHandler: function(form) {
            $(form).find('[type="submit"]').prop('disabled', true);
            
            var Contact_form = ajax_url+'?action=contact_form';
            //var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
            //var data = new FormData(this);
            jQuery.ajax({
                type    : 'POST', 
                url     : Contact_form,
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
                            $(".success-message").text(res.data.html);
                            setInterval(function() {
                                $(".datum_login_close").trigger('click');
                            }, 2000);
                        break;
                        case 'failure' :
                            _res = res.data.html;
                            $('#Contact_form').find('.js-error').html('');

                            //  Show validate messages
                            $.each(_res, function(index, val) {
                                $('#Contact_form').find(':input[name="' + index + '"]').closest('.datum_form_group').find('.js-error').html(val[0]);
                            });
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