$(document).ready(function() {
    $('.phone_number').inputmask("999-999-9999");
    $('.step_2').hide();
    $('.step_3').hide();
    $('.registerFrm_step').hide();
    $('.forgotFrm_step').hide();
    $('.forgot_title').hide();
    $('#oepl_investor').hide();
    $('#oepl_brokerType').hide();    
    

    jQuery(document).on('click','.favorite_my_listing_start',function(e){
        var main =  $(this).attr('data-main');
        var favProperty = $(this).attr('data-listing');
        popupHtml($(this).attr('data-popup'), '', $(this).attr('data-property_id'), favProperty,main);
    });
    jQuery(document).on('click','.datum_model_open',function(e){
        e.preventDefault();
        $('#datum_popup_html').html('');
        var main =  $(this).attr('data-main');
        var favProperty = $(this).attr('data-listing')
        popupHtml($(this).attr('data-popup'), '', $(this).attr('data-property_id'), favProperty,main,$(this).attr('data-type'));
        if(!$('.datum_modal').hasClass('is-visible')){
            $('.datum_modal').toggleClass('is-visible');
        }
        setTimeout(function(){ 
            $('#popup_main').val(main);
            //$('#propertytype').val($(this).attr('data-type'));
        }, 4000);
    });

     jQuery(document).on('click','.datum_login_close',function(e){
        $('.datum_modal').toggleClass('is-visible');
        $('#datum_popup_html').html('');
        $('body').removeClass('datum_opened_modal');
    });

    $("#otpFrm").validate({
        rules: {
            digit1: {
                required: true,
            },
            digit2: {
                required: true,
            },
            digit3: {
                required: true,
            },
            digit4: {
                required: true,
            },
        },
        messages: {
            
        },
        submitHandler: function(form) {
            $(form).find('[type="submit"]').prop('disabled', true);
            return true;
        }
    });

    

    $("#resetFrm").validate({
        invalidHandler: function(event, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                $('span.error, .js-error').hide('');
            }
        },
        rules: {
            'password': {
                required: true,
                minlength: 8
            },
            'confirm_password': {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
        },
        messages: {
            'password': {
                required: "Please provide password",
                minlength: "Password must be at least 8 character",
            },
            'confirm_password': {
                required: "Please provide confirm password",
                minlength: "Confirm password must be at least 8 character",
                equalTo: "Confirm password must be equal to password"
            },
        },
        submitHandler: function(form) {
			$(form).find('[type="submit"]').prop('disabled', true);
			return true;
        }
    });
    
    
});

function dynamicCss() {
    $(".applHGT").css("height", $(window).height());
}
function _showFormError(form, _res) {
    //  Show validate messages
    $(form).find('.js-error').html('');
    //  Show validate messages
    $.each(_res, function(index, val) {
        $(form).find(':input[name="' + index + '"]').closest('.datum_row_group').find('.js-error').html(val);
    });
}




function popupHtml(popup,popup_html, property_id = '', favProperty,main = 0,type){
    $('body').addClass('datum_opened_modal');
    var propertyID = property_id;
    $('.datum_signup_popup').html('');
    $('.datum_login_popup_html').html('');
    $('.datum_forgot_popup').html('');
    var popuphtml = ajax_url+'?action=popuphtml';

    if(popup == ''){
        popup = 'login_html';
    }

    if(propertyID == '') {
        var property_id = $('.datum_model_open').attr('data-property_id');
    } else {
        property_id = propertyID;
    }
    
    jQuery.ajax({
        type    : 'POST', 
        url     : popuphtml,
        data    :  {'popuphtml':popup, property_id: parseInt(property_id), favProperty: favProperty,'type':type},
        dataType: 'json',
        beforeSend : function() {
            loadingshow();
        },
        success : function(res) {
           switch(res.data.type) {
                case 'success' :
                    if(popup == 'favorite_my_listing'){
                        $('#my-faverite-listing-page').html(res.data.html);
                    }else{
                       if(res.data.favorite.popup) {
                            $('#datum_popup_html').html(res.data.html);
                            if(res.data.favorite.login) {
                                var property_id = res.data.favorite.property_id
                                var favHidden = '<input type="hidden" name="favorite" value="yes" />';
                                $('#propertyId').val(parseInt(property_id));
                                $('#datum_login_form').append(favHidden);
                                if(res.data.favorite.favProperty) {
                                    var favHidden = '<input type="hidden" name="favProperty" value="favProperty" />';
                                    $('#datum_login_form').append(favHidden);
                                }
                            }
                        } else {
                            if(res.data.favorite.reload) {
                                location.reload();
                            }
                            if(res.data.favorite.favrite) {
                                if( typeof res.data.favorite.property_id != 'undefined' ) {
                                    $('label#datum_property_id_'+res.data.favorite.property_id+' input[type="checkbox"]').prop( "checked", true );
                                    if($('.datum_modal').hasClass('is-visible')){
                                        $('.datum_modal').toggleClass('is-visible');
                                    }
                                    if(window.location.href.indexOf('my-favorite-listing') > -1) {
                                        location.reload();
                                    }
                                } else {
                                    if( typeof res.data.favorite.property_id != 'undefined' ) {
                                        $('label#datum_property_id_'+res.data.favorite.property_id+' input[type="checkbox"]').prop( "checked", true );
                                        if($('.datum_modal').hasClass('is-visible')){
                                            $('.datum_modal').toggleClass('is-visible');
                                        }
                                    } else {
                                        $('label.datum_star_toggle input[type="checkbox"]').prop( "checked", true );
                                        if($('.datum_modal').hasClass('is-visible')){
                                            $('.datum_modal').toggleClass('is-visible');
                                        }
                                    }
                                    
                                }
                                
                            } 
                            if(res.data.favorite.remove_favrite) {
                                $('label#datum_property_id_'+res.data.favorite.property_id+' input[type="checkbox"]').prop( "checked", false );
                                if($('.datum_modal').hasClass('is-visible')){
                                    $('.datum_modal').toggleClass('is-visible');
                                }
                                if(window.location.href.indexOf('my-favorite-listing') > -1) {
                                    location.reload();
                                }
                            }
                        }
                        $('#propertytype').val(type);
                    }
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
jQuery(document).on('click','#datum_logout',function(e){
        var datum_logout = ajax_url+'?action=datum_logout';
        var msgTemplate = '<div class="alert  alert-{{type}}">' + '{{msg}}' +'</div>';
        //var data = new FormData(this);
        jQuery.ajax({
            type    : 'POST', 
            url     : datum_logout,
            data    :  {'user_id':$('#user_id').val()},
            dataType: 'json',
            beforeSend : function() {
                $('#datum_logout').prop("disabled", true);
                loadingshow();
            },
            success : function(res) {
               switch(res.data.type) {
                    case 'success' :
                        window.location.href = '';
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