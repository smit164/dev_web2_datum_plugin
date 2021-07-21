<div class="datum_modal_wrapper datum_modal_transition">
    <div class="datum_login_popupbox">
        <h2>Due Diligence</h2>
        <a class="datum_login_close" href="javascript:void(0);">&times;</a>
        <div class="datum_login_content">
            <form id="dd_form" method="post" name="dd_form">
                <input type="hidden" name="property_id" value="<?php echo getDMPropertyId(); ?>">
                <div class="form-group" id="dd_first">
                    <div class="custom-control custom-checkbox custom-control-inline dutum_custom-checkbox">
                        <label class="datum_checkbox_label">
                            <input type="checkbox" class="custom-control-input datum_checkbox" id="send_dd" name="send_dd" value="send_dd" />
                            <span class="datum-checkbox-span checkbox-span"></span>
                        </label>
                        <label class="custom-control-label" for="send_dd">Please confirm to request due diligence information.</label>
                    </div>
                    <div style="margin-top: 10px;">
                        If you are interested in receiving further information about this unique opportunity, please click the submit button below.
                    </div>
                    <div class="form-group" id="dd_second" style="display: none">
                        <div style="font-size: 18px;">
                            One of our agents will be in touch shortly and you will receive an email notification when your request is approved.<br /><br />Thank you for your interest.
                        </div>
                    </div>
                </div>
                <button type="submit" class="datum_btn_primary btn-lg">Submit</button> 
            </form>
            
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $("#dd_form").validate({
        rules: {
            send_dd: {
                required: true,
            },
        },
        messages: {
            send_dd: {
                required: "Please checked",
            },
        },
        submitHandler: function(form) {
            $(form).find('[type="submit"]').prop('disabled', true);
            
            var dd_req = ajax_url+'?action=dd_request';
            var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
            
            jQuery.ajax({
                type    : 'POST', 
                url     : dd_req,
                data    :  $(form).serialize(),
                dataType: 'json',
                beforeSend : function() {
                    loadingshow();
                },
                success : function(res) {
                    if(res.data.type == 'success') {
                        ddSuccessResponce();
                    } else {
                        $(".datum_login_content").html("<p>"+res.data.message+"</p>")
                    }
                },
                complete : function() {
                    loadinghide();
                }
            });
            return false;
        }
    });

    function ddSuccessResponce() {
        jQuery.ajax({
			type    : 'POST', 
			url     : ajax_url+'?action=dd_success',
            data    : {documenttype: 'dd'} ,
			dataType: 'json',
			beforeSend : function() {
				loadingshow();
			},
			success : function(res) {
			switch(res.data.type) {
					case 'success' :
						$('#datum_popup_html').html(res.data.html);
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
    }
</script>