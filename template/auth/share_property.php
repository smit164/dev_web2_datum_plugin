<div class="datum_modal_wrapper datum_modal_transition">
    <div class="datum_login_popupbox">
        <h2>Share Property</h2>
        <a class="datum_login_close" href="javascript:void(0);">&times;</a>
        <div class="datum_login_content">
        	<div class="datum_row datum_share_property_image">
        		<div class="datum_deskdevice_6 datum_rp_15">
        			<img alt="<?php echo getDMPropertyImageAltText(); ?>" src="<?php echo getDMPropertyMarkerListImage(); ?>">	
        		</div>
        		<div class="datum_deskdevice_6 datum_rp_15">
        			<h4>
                        <a href="<?php echo getDMProperyURL(); ?>" target="_blank" style="color:inherit;"><?php echo getDMPropertyName(); ?></a>
                    </h4>
                    <span><?php echo getDMPropertyListingStatus(); ?></span>
        		</div>
        	</div>
        	<div class="datum_share_property">
                <form id="share_property" method="post" name="share_property">
                    <input type="hidden" name="property_id" id="propertyId" value="<?php echo getDMPropertyId(); ?>">
                    <div class="datum_form_group">
                        <label class="datum_label">Email(s) to share with<span>*</span> </label>
                        <textarea name="email" placeholder="Insert the list of your client's emails in here. Use commas or line breaks to separate email addresses" class="datum_form-control datum_textarea_control"></textarea>
                        <span class="error js-error" id="email"></span>
                    </div>
                    <div class="datum_form_group">
                        <label class="datum_label">Your Email<span>*</span> </label>
                        <input type="text" name="your_email" value="" class="datum_form-control">
                        <span class="error js-error" id="your_email"></span>
                    </div>
                    <div class="datum_form_group">
                        <label class="datum_label">Your Name<span>*</span> </label>
                        <input type="text" name="your_name" value="" class="datum_form-control">
                        <span class="error js-error" id="your_name"></span>
                    </div>
                    <div class="datum_form_group">
                        <label class="datum_label">Subject<span>*</span> </label>
                        <input type="text" name="subject" value="" class="datum_form-control">
                        <span class="error js-error" id="subject"></span>
                    </div>
                    <div class="datum_form_group">
                        <label class="datum_label">Message<span>*</span> </label>
                        <textarea name="message" class="datum_form-control datum_textarea_control"></textarea>
                        <span class="error js-error" id="message"></span>
                    </div>
                    <p class="success-message"></p>
                    <button type="submit" class="datum_btn_primary btn-lg"  style="margin-top: 15px;">Share Property</button>
                </form>
                <div class="datum_share_social">
                    <label class="datum_label">Share On </label>
                    <?php echo do_shortcode('[dm_social]') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$("#share_property").validate({
        rules: {
            email: {
                required: true,
            },
            your_email: {
                required: true,
            },
            your_name: {
                required: true,
            },
            subject: {
                required: true,
            },
            message: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Please provide an email address",
            },
            your_email: {
                required: "Please provide a your email",
            },
            your_name: {
                required: "Please provide a your name",
            },
            subject: {
                required: "Please provide a subject",
            },
            message: {
                required: "Please provide a message",
            },
        },
        submitHandler: function(form) {
            $('#share_property').find('[type="submit"]').prop('disabled', true);
            
            var share_property = ajax_url+'?action=share_property';
            //var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
            //var data = new FormData(this);
            jQuery.ajax({
                type    : 'POST', 
                url     : share_property,
                data    :  $(form).serialize(),
                dataType: 'json',
                beforeSend : function() {
                    loadingshow();
                },
                success : function(res) {
                    $('#error_login').html('');
                    $('#share_property').find('[type="submit"]').prop('disabled', false);
                   switch(res.data.type) {
                        case 'success' :
                            $(".success-message").text(res.data.html);
                            setInterval(function() {
                                $(".datum_login_close").trigger('click');
                            }, 2000);
                    	break;
                        case 'failure' :
                            console.log("TEST");
                             _res = res.data.html;
                            $('#share_property').find('.js-error').html('');

							//  Show validate messages
							$.each(_res, function(index, val) {
                                $('#share_property').find(':input[name="' + index + '"]').closest('.datum_form_group').find('.js-error').html(val[0]);
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