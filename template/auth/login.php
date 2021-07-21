    <div class="datum_modal_wrapper datum_modal_transition">
    <div class="datum_login_popupbox">
        <h2>Login</h2>
        <p>Please login to access the requested information.</p>
        <a class="datum_login_close" href="javascript:void(0);">&times;</a>
        <div class="datum_login_content">
            <form id="datum_login_form" method="post" name="datum_login_form">
                <input type="hidden" name="property_id" id="propertyId" value="<?php echo getDMPropertyId(); ?>">
                <input type="hidden" name="type" id="propertytype" value="<?php echo getDMPropertyName(); ?>">
                <div class="datum_form_group" style="margin-top: 15px;">
                    <label class="datum_label">Email Address<span>*</span> </label>
                    <input type="text" name="email" class="datum_form-control">
                </div>
                <div class="datum_form_group datum_pw_box">
                    <label class="datum_label">Password<span>*</span></label>
                    <input type="password" name="password" class="datum_form-control">
                    <span toggle="#password" class="fa fa-eye-slash field-icon toggle-password-h npcg_np1 show_password_texbox"></span>
                </div>
                <div class="datum_form_group">
                    <span id="error_login" class="error"></span>
                </div>
                <div class="datum_form_group">
                    <p>Forgot password? <a href="JavaScript:void(0)" data-popup="forgot" id="datum_forgot_password" class="text-blue datum_model_open">Click here</a></p>
                </div>
                <button type="submit" class="datum_btn_primary btn-lg">Login</button> 
                <a data-popup="register_html" class="modal-toggle-signup datum_btn_grey btn-lg datum_model_open">Create New Account</a>
            </form>
            <input type="hidden" name="main" value="" id="popup_main">
            <div class="datum_poweredbytext" >
                <p>Powered By <svg xmlns="http://www.w3.org/2000/svg" width="118.215" height="17" viewBox="0 0 118.215 17"><g id="DatatoDeals_Logo" transform="translate(0.001 147.917)"><g id="g12" transform="translate(-0.001 -147.917)"><path id="path14" d="M0-145.354v15.414H4.465a7.625,7.625,0,0,0,7.772-7.716,7.632,7.632,0,0,0-7.772-7.7Zm3.512,12.275v-9.136h.542a4.34,4.34,0,0,1,4.39,4.578,4.346,4.346,0,0,1-4.39,4.558Zm9.584-1.644a4.809,4.809,0,0,0,4.764,5.063A4.245,4.245,0,0,0,21-131.025h.037v1.084h3.27v-9.584H21v.915a4.362,4.362,0,0,0-3.139-1.2,4.826,4.826,0,0,0-4.764,5.082m3.512,0a2.2,2.2,0,0,1,2.242-2.261,2.191,2.191,0,0,1,2.223,2.261,2.154,2.154,0,0,1-2.223,2.242,2.138,2.138,0,0,1-2.242-2.242m10.37-4.8H25.6V-137h1.383v3.68c0,1.7.635,3.662,3.269,3.662a5.475,5.475,0,0,0,2.429-.6l-.822-2.672a1.565,1.565,0,0,1-.822.3c-.523,0-.747-.43-.747-1.327V-137H32.3v-2.522H30.285v-3.569H26.978Zm6.09,4.8a4.809,4.809,0,0,0,4.764,5.063,4.244,4.244,0,0,0,3.139-1.364h.037v1.084h3.269v-9.584H40.971v.915a4.361,4.361,0,0,0-3.139-1.2,4.826,4.826,0,0,0-4.764,5.082m3.512,0a2.2,2.2,0,0,1,2.242-2.261,2.191,2.191,0,0,1,2.223,2.261,2.154,2.154,0,0,1-2.223,2.242,2.138,2.138,0,0,1-2.242-2.242" transform="translate(0.001 145.649)" fill="#434850"></path><path id="path16" d="M429.051-112.2h-.91v1.661h.91v2.424c0,1.12.418,2.412,2.153,2.412a3.6,3.6,0,0,0,1.6-.394l-.542-1.759a1.029,1.029,0,0,1-.541.2c-.345,0-.493-.283-.493-.874v-2.006h1.329V-112.2h-1.329v-2.35h-2.178Zm4.035,3.162c0,1.944,1.526,3.334,3.8,3.334,2.177,0,3.765-1.391,3.765-3.334a3.49,3.49,0,0,0-3.765-3.347c-2.129,0-3.8,1.378-3.8,3.347m2.313,0a1.446,1.446,0,0,1,1.477-1.489,1.443,1.443,0,0,1,1.464,1.489,1.418,1.418,0,0,1-1.464,1.476,1.408,1.408,0,0,1-1.477-1.476" transform="translate(-378.934 118.382)" fill="#434850"></path><path id="path18" d="M586.423-147.263v15.413h4.466a7.625,7.625,0,0,0,7.772-7.716,7.632,7.632,0,0,0-7.772-7.7Zm3.512,12.275v-9.136h.542a4.34,4.34,0,0,1,4.391,4.578,4.346,4.346,0,0,1-4.391,4.558Zm19.972-1.2a3.483,3.483,0,0,0,.019-.449c0-3.363-2.223-5.082-5.138-5.082a5.19,5.19,0,0,0-5.269,5.082,5.186,5.186,0,0,0,5.269,5.063,5.33,5.33,0,0,0,4.97-2.5l-2.391-1.2a2.63,2.63,0,0,1-2.336,1.065,1.959,1.959,0,0,1-2.073-1.98Zm-6.856-1.831a1.651,1.651,0,0,1,1.831-1.551,1.7,1.7,0,0,1,1.813,1.551Zm7.641,1.383a4.809,4.809,0,0,0,4.764,5.063,4.244,4.244,0,0,0,3.139-1.364h.037v1.084H621.9v-9.584h-3.307v.915a4.36,4.36,0,0,0-3.139-1.2,4.826,4.826,0,0,0-4.764,5.082m3.512,0a2.2,2.2,0,0,1,2.242-2.261,2.191,2.191,0,0,1,2.224,2.261,2.155,2.155,0,0,1-2.224,2.242,2.138,2.138,0,0,1-2.242-2.242m9.939,4.783h3.307v-16.067h-3.307Zm9.716-9.865c-2.522,0-4.186,1.121-4.186,3.083a2.9,2.9,0,0,0,1.943,2.616c1.084.56,2.13.617,2.13,1.307,0,.635-.561.692-1.027.692a4.791,4.791,0,0,1-2.373-1.1L629-132.859a5.735,5.735,0,0,0,3.7,1.289c1.961,0,4.54-.448,4.54-3.269,0-1.961-1.644-2.672-2.914-3.064-.822-.262-1.495-.411-1.495-.916,0-.448.3-.579,1.027-.579a5.4,5.4,0,0,1,2.13.6l1.083-2.168a7.314,7.314,0,0,0-3.213-.747" transform="translate(-519.025 147.917)" fill="#434850"></path><path id="path20" d="M409.886-22.685h14.757A1.4,1.4,0,0,0,426-21.632a1.4,1.4,0,0,0,1.4-1.4,1.4,1.4,0,0,0-1.4-1.4,1.4,1.4,0,0,0-1.359,1.053H409.886" transform="translate(-362.778 38.632)" fill="#e7294b"></path></g></g></svg> </p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".show_password_texbox").click(function(){
        var password = $(this).closest('.datum_pw_box').find('input');
        var type = "";
        var className = '';
        if(password.attr('type') == "password") {
            type = "text";
            $(this).removeClass("fa-eye-slash");
            $(this).addClass('fa-eye');
        } else {
            type = "password";
            $(this).removeClass("fa-eye");
            $(this).addClass('fa-eye-slash');
        }
        password.attr('type', type);
    });
    $("#datum_login_form").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            email: {
                required: "Please provide an email address",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please provide a password",
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
                                    if(res.data.IsAccountVerified != 0){

                                        showingUserDetalis();
                                    }
                                }
                            }else{
                                if(res.data.otp){
                                }else{
                                    if(typeof res.data.favorite == 'undefined') {
                                        if(res.data.press_release_type == '1'){
                                            if(res.data.is_press_release == 1){
                                                const a = document.createElement('a');
                                                a.style.display = 'none';
                                                a.href = res.data.pp_link;
                                                // the filename you want
                                                a.download = res.data.pp_name;
                                                document.body.appendChild(a);
                                                a.click();
                                                window.URL.revokeObjectURL(res.data.pp_link);
                                                location.reload();
                                            }else{
                                                window.open(res.data.pp_link);
                                                location.reload();
                                            }
                                        }else{
                                            $('#datum_popup_html').html(res.data.html);
                                        }
                                    } else {
                                        if(res.data.favorite.popup) {
                                            $('#datum_popup_html').html(res.data.html);
                                        } else if(res.data.isNextUpdateDate == 1) {
                                            $('#datum_popup_html').html(res.data.html);
                                        }else{
                                            location.reload();

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

    function showingUserDetalis(){
    
    var showing_user_detalis = ajax_url+'?action=showing_user_detalis';
    jQuery.ajax({
        type    : 'POST', 
        url     : showing_user_detalis,
        data    :  {},
        dataType: 'json',
        beforeSend : function() {
            loadingshow();
        },
        success : function(res) {
           switch(res.data.type) {
                case 'success' :
                    $('.navbar-nav .header-btn').remove();
                    $('.navbar-nav').append(res.data.html);
                    //window.location.href = '';
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