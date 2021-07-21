$(document).ready(function(){
    if($('#propertymap').length != 0){
        ajaxCall();
        propertymap.setup({
            marker : '',
        });
    }

    jQuery(document).on('click','#loadMore_pl',function(e){
        e.preventDefault();
        $('#next_page').val($(this).attr('data-page'));
        $('#loadMore_pl').attr('data-page',parseInt($(this).attr('data-page')) + parseInt(1));
        ajaxCall(true);
    });

    jQuery(document).on('click','.datum_filter_clear',function(e){
        e.preventDefault();
        $('.dropdown_select').val('');
        $('.property_sorting').val('');
        $('#asking_price').val('');
        $('.datum_checkbox-accordian input').prop('checked', false);
        $('#datum_drop-down-property').removeClass('datum_drop-down--active');
        $('#property_search').val("");
        $('#asking_price_min_max').val("");
        $("#datum_asking_price_dropDown").text("Asking Price");
        $('.up-arrow-sorting').show();
        $('.down-arrow-sorting').show();
        $('.datum_filter_clear').addClass('datum_hide');
        ajaxCall();
    });

    jQuery(document).on('change','.dropdown_select',function(e){
        e.preventDefault();
        var name = $(this).attr('name');
        $('#loadMore_pl').attr('data-page',1);
        $('.datum_filter_clear').removeClass('datum_hide');
        ajaxCall();
    });
    /**
     * Property sorting
     */
    jQuery(document).on('change','#property_sorting',function(e){
        var sortingHiglight = $(this).find(':selected').attr('data-sort');

        if(sortingHiglight == 1) {
            $('.up-arrow-sorting').show();
            $('.down-arrow-sorting').css({ opacity: 0.6 });
        } else {
            $('.down-arrow-sorting').show();
            $('.up-arrow-sorting').css({ opacity: 0.6 });
        }
        //$("select#property_sorting option:first-child").text($(this).find(':selected').attr('data-name'))
        e.preventDefault();
        var name = $(this).attr('name');
        $('#loadMore_pl').attr('data-page',1);
        $('.datum_filter_clear').removeClass('datum_hide');
        ajaxCall();
    });

    $('#propertymap').hide();

    if($('#google_map_data').is(':checked')) {
        $('#propertymap').show();
        $('#property_listing_html').css('width','50%');
        $(".datum_portfolio_item .datum_item").addClass("datum_col_6");
        $(".datum_portfolio_item .datum_item").removeClass("datum_col_4");
        $('.datum_pl_flipdiv').addClass('datum_pl_scroolListing');
    }


    jQuery(document).on('change','#google_map_data',function(e){
        e.preventDefault();
        if(this.checked) {
            $('#property_listing_html').css('width','50%');
            //ajaxCall();
            
            $('#propertymap').show();
            $(".datum_portfolio_item .datum_item").addClass("datum_col_6");
             $(".datum_portfolio_item .datum_item").removeClass("datum_col_4");
             $('.datum_pl_flipdiv').addClass('datum_pl_scroolListing');
            Maps.fitBounds(bounds);
        }else{
           
            $('#propertymap').hide();
            $(".datum_portfolio_item .datum_item").removeClass("datum_col_6");
            $(".datum_portfolio_item .datum_item").addClass("datum_col_4");
            $('#property_listing_html').css('width','100%');
            $('.datum_pl_flipdiv').removeClass('datum_pl_scroolListing');
        }
    });

    jQuery(document).on('click','#copy_link',function(e){
        e.preventDefault();
        var copyText = $(this).attr('data-link');

       document.addEventListener('copy', function(e) {
          e.clipboardData.setData('text/plain', copyText);
          e.preventDefault();
       }, true);
       document.execCommand('copy');
    });

    jQuery(document).on('change','#profile_avatar',function(event){
        var output = document.getElementById('datum_file_show');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
        $('#datum_photo_hide').hide();
    });
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

});
jQuery(document).on('submit','#loginFrm',function(e){
    e.preventDefault();
});
/*jQuery(document).on('submit','#property_filter',function(e){
    e.preventDefault();
});*/
function getAjaxCallData(lat = '',long = '',nkf_radius_km = ''){
    var data = {
        'lat':lat,
        'long':long,
        'radius_in_km':nkf_radius_km,
        'propertystatus':$('#property_status').val(),
        'propertytype':$('#property_type').val(),
        'propertysearch':$('#property_search').val(),
        'page':$('#loadMore_pl').attr('data-page'),
        'sorting':$('#property_sorting').val(),
        'asking_price': $('#datum_drop-down-asking-price').attr('data-filter-value')
    };
    return data;
}

function Copy()
{

}
function ajaxCall(append = '',lat = '',long = '',nkf_radius_km = ''){

    jQuery.ajax({
        type    : 'POST',
        url     : ajax_url+'?action=property_list',
        data    :  $('#property_filter').serialize(),
        dataType: 'json',
        beforeSend : function() {
            loadingshow();
          },
        success : function(res) {
            switch(res.data.type) {
                case 'success' :
                console.log(append);
                    if(append){
                        jQuery('#property_listing_html').append(res.data.html);
                        propertymap.setMarkers(res.data.marker_data,false);
                    }else{
                        jQuery('#property_listing_html').html(res.data.html);
                        propertymap.setMarkers(res.data.marker_data,true);
                    }
                    if(res.data.view_more){
                        $('#loadMore_pl').hide();
                    }else{
                        $('#loadMore_pl').show();
                    }
                    if(res.data.next_page_id) {
                        $('#loadMore_pl').attr('data-page', res.data.next_page_id);
                    }
                    if($('#google_map_data').is(':checked')) {
                        $(".datum_portfolio_item .datum_item").addClass("datum_col_6");
                        $('.datum_pl_flipdiv').addClass('datum_pl_scroolListing');
                        $(".datum_portfolio_item .datum_item").removeClass("datum_col_4");
                        //$(".datum_portfolio_item .datum_item").css("width","50%");
                    }else{

                        $(".datum_portfolio_item .datum_item").addClass("datum_col_4");
                        $('.datum_pl_flipdiv').removeClass('datum_pl_scroolListing');
                        $(".datum_portfolio_item .datum_item").removeClass("datum_col_6");
                        //$(".datum_portfolio_item .datum_item").css("width","25%");
                    }

                    if($('#property_search_tag').val() == '' && $('#datum_property_dropDown').val() == '' && $('#property_status').val() == 
                    ''){
                        $('.datum_filter_clear').removeClass('datum_hide');
                    }

                    break;
                case 'failure' :
                    for(var i in res.data.html) {
                        var msgs = '';
                        if(res.data.html[i].length) {
                            jQuery("#"+ i ).html(msgTemplate.replace(/{{type}}/g, 'danger').replace(/{{msg}}/g, res.data.html[i]));
                            //jQuery("."+ i ).addClass('alert-text');
                        }
                    }
                    break;
                default :
                    break;
            }
        },
        complete : function() {
            $(".datum_slick_carousel").not('.slick-initialized').slick({dots:!1,infinite:!0,speed:300,slidesToShow:1,autoplay:!0});
            loadinghide();
        }
    });
}

function loadingshow(){
    $('#loadingover').show();
    $('#loadingmsg').show();
}
function loadinghide(){
    setTimeout(function(){
        $('#loadingover').hide();
        $('#loadingmsg').hide();
    },
    1000);
}