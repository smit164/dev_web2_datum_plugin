<?php
$propertyName   = getDMPropertyName();
$property_id    = getDMPropertyId();

?>
<div class="datum_modal_advance_search" style="position: absolute !important;top: 0;right: 0;bottom: 0;left: 0;z-index: 10000;width: 100%;height: 100%;overflow-x: hidden;overflow-y: scroll;">
    <div class="datum_modal_overlay"></div>
    <div class="datum_modal_wrapper datum_modal_wrapper_signup datum_modal_transition">
        <div class="datum_login_popupbox">
            <a class="datum_login_close" href="javascript:void(0);">&times;</a>
            <h2 class="modal-heading">Closed Listing Inquiry | <?php echo $propertyName; ?></h2>
            <div class="datum_login_content">
                <form id="datum_request_info_form" method="post" name="datum_request_info_form">
                    <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
                    <div class="datum_row">
                        <div class="datum_row_100">
                            <div class="datum_form_group ">
                                <label class="datum_label">First Name<span>*</span></label>
                                <input class="datum_form-control" type="text" name="first_name">
                                <span class="error js-error" id="first_name"></span>
                            </div>
                            <div class="datum_form_group ">
                                <label class="datum_label">Last Name<span>*</span></label>
                                <input class="datum_form-control" type="text" name="last_name">
                                <span class="error js-error" id="last_name"></span>
                            </div>
                        </div>
                        <div class="datum_row_100">
                            <div class="datum_form_group ">
                                <label class="datum_label">Email Address<span>*</span></label>
                                <input class="datum_form-control" type="text" name="email">
                                <span class="error js-error" id="email"></span>
                            </div>
                            <div class="datum_form_group ">
                                <label class="datum_label">Work Phone<span>*</span></label>
                                <input class="datum_form-control phone_number" type="text" name="work_phone">
                                <span class="error js-error" id="work_phone"></span>
                            </div>
                        </div>
                        <div class="datum_row_100">
                            <div class="datum_form_group ">
                                <label class="datum_label">Message<span>*</span></label>
                                <textarea name="message" id="message"></textarea>
                                <span class="error js-error" id="message"></span>
                            </div>
                        </div>
                        <div class="datum_col_12">
                            <button type="submit" class="datum_btn_primary btn-lg datum_float_right" id="send_message">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.phone_number').inputmask("999-999-9999");
    $("#datum_request_info_form").validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            work_phone: {
                required: true,
            },
            message: {
                required: true,
            },
        },
        messages: {
            first_name: {
                required: "Please provide a first name",
            },
            last_name: {
                required: "Please provide a last name",
            },
            email: {
                required: "Please provide an email address",
            },
            work_phone: {
                required: "Please provide a work phone",
            },
            message: {
                required: "Please provide a message",
            }
        },
        submitHandler: function(form) {
            $(form).find('[type="submit"]').prop('disabled', true);
            var requestFrm = ajax_url+'?action=request_info';
            jQuery.ajax({
                type    : 'POST',
                url     : requestFrm,
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
                            var html = res.data.html;
                            $('.datum_login_content').html('<div class="message">' + html + '</div>');
                            break;
                        case 'failure' :
                            for(var i in res.data.html) {
                                var msgs = '';
                                if(res.data.html[i].length) {
                                    jQuery("#"+ i ).text(res.data.html[i][0]);
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