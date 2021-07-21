<style type="text/css">
    .js-error{
        font-weight: 400;
    font-size: 12px;
    color: #D22630;
    }
</style>
<div class="datum_modal_wrapper datum_modal_wrapper_signup datum_modal_transition datum_offer_popup">
	<div class="datum_login_popupbox ">
	    <h2><?php  _e("Confidentiality Agreement",'datum'); ?></h2>
	    <a class="datum_login_close" href="javascript:void(0);">&times;</a>
	    <div class="datum_login_content">
	        <div class="datum_form_wizard">
	            <div class="datum_steps">
	                <ul>
	                    <li class="d_step_1 active"> <span></span> <?php  _e("Login",'datum'); ?></li>
	                    <li class="d_step_2 active"> <span></span> <?php  _e("Confidentiality Agreement",'datum'); ?> </li>
	                    <li class="d_step_3"> <span></span> <?php  _e("Download",'datum'); ?> </li>
	                </ul>
	            </div>
				
	            <div class="datum_form_wizard_container">
	                <div class="datum_main_form_container active">
	                    <div class="agreement-text">
							<iframe src="<?php echo DATUM_PLUGIN_URL; ?>/datum_preview_ca.php?p_id=<?php echo getDMPropertyId(); ?>#toolbar=1" class="preview_CA_iframe" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						</div>
						
						<form id="oepl_agrrement_form">
							<input type="hidden" id="oepl_hid_userid" name="oepl_hid_userid" value="" />
							<input type="hidden" id="oepl_hid_propertyid" name="oepl_hid_propertyid" value="" />
									
							<div class="datum_custom_checkbox mt-30">
		                      	<input type="checkbox" class="custom-control-input" id="checkbox5" name="property_type" value="Other">
		                      	<label class="custom-control-label" for="checkbox5"><?php _e("Email me a copy of this Confidential Agreement",'datum'); ?></label>
		                   	</div>
							<button class="datum_btn_primary btn-lg" id="download_nda_pdf" data-property_id="<?php echo getDMPropertyId(); ?>" name="download_nda_pdf" data-id="1" style="margin-bottom: 30px;" value="I Accept the Confidentiality Agreement">
								<?php _e("I Accept the Confidentiality Agreement",'datum'); ?>
							</button>	
							<p id="oepl_login_text" class="datum_agreement_info">
								<?php _e("You are logged in as ",'datum'); ?><strong><?php echo (getDMUserFirstName()) ? getDMUserFirstName() : '';?> <?php echo (getDMUserLastName()) ? getDMUserLastName() : '';?></strong>. <a href="javascript:void(0);" class="link download_nda_pdf" data-property_id="<?php echo getDMPropertyId(); ?>" data-id="2" id="npcg_d_options"><?php _e("Click here ",'datum'); ?> </a> <?php _e("to download an unexecuted confidentiality agreement for ",'datum'); ?> <?php echo ($datum_user->first_name) ? $datum_user->first_name : '';?>
							</p>
						</form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
<script type="text/javascript">

jQuery(document).on('click','#download_nda_pdf',function(e){
	e.preventDefault();
	var document_vault_structure = ajax_url+'?action=document_vault_structure';
	var property_id = $(this).attr('data-property_id');

	var copyOnEmail = false;
	if($("#checkbox5").prop('checked') == true){
		copyOnEmail = $("#checkbox5").prop('checked');
	} else {
		copyOnEmail = $("#checkbox5").prop('checked');
	}
	window.location.href = "<?php echo DATUM_PLUGIN_URL; ?>datum_ca_download.php?p_id=" +property_id+ "&copy_email=" + copyOnEmail;
	
	setTimeout(function(){
		jQuery.ajax({
			type    : 'POST', 
			url     : document_vault_structure,
			data    : {'step':$(this).attr('data-id'), property_id: parseInt(property_id), documenttype: 'Offering Memorandum'} ,
			dataType: 'json',
			beforeSend : function() {
				loadingshow();
			},
			success : function(res) {
			switch(res.data.type) {
					case 'success' :
						$('#datum_popup_html').html(res.data.html);
						$('#due_diligence_popup').css('pointer-events','inherit');
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
	}, 3500);
	
});
var ajaxCount = 1;
jQuery(document).on('click','#npcg_d_options',function(e){
	/**
	 * unexecuted
	 */
	var property_id = $(this).attr('data-property_id');
	var open_un_ex = ajax_url+'?action=popuphtml';
	if( ajaxCount > 1) {
		return false;
	}
	ajaxCount = ajaxCount + 1;
	jQuery.ajax({
		type    : 'POST', 
		url     : open_un_ex,
		data    : {'popuphtml':'unexecuted', property_id: parseInt(property_id)} ,
		dataType: 'json',
		beforeSend : function() {
			loadingshow();
		},
		success : function(res) {
		switch(res.data.type) {
				case 'success' :
					$('#datum_popup_html').html(res.data.html);
					$('#due_diligence_popup').css('pointer-events','inherit');
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
</script>