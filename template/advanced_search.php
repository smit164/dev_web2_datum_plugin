<?php
$advance_search_type = get_site_transient( 'advance_search_types' );
$tempCount = [];
$tempCount1 = [];
if(!empty($advance_search_type) && $advance_search_type != "" ) {
    foreach ($criteria->data->PropertyType->get_acquisition_criteria_type as $key => $value) {
        foreach ($value->get_acquisition_criteria_sub_type as $k => $v) {
            $tempCount1[$value->Name][] = $v->Id;
            if( in_array($v->Id, $advance_search_type)){
                $tempCount[$value->Name][] = $v->Id;
            }
        }
    }
}

?>
<div class="datum_modal_advance_search" style="position: absolute !important;top: 0;right: 0;bottom: 0;left: 0;z-index: 10000;width: 100%;height: 100%;overflow-x: hidden;overflow-y: scroll;">
    <div class="datum_modal_overlay"></div>
    <div class="datum_modal_wrapper datum_modal_wrapper_signup datum_modal_transition">
        <div class="datum_login_popupbox">
            <a class="datum_login_close" href="javascript:void(0);">&times;</a>
            <h2 class="modal-heading">Advanced Search</h2>
            <div class="datum_login_content">
                <form id="datum_advanced_search_form" method="post" name="datum_advanced_search_form">
                    <input type="hidden" name="advance_search" value="yes">
                    <div class="datum_row">
                        <div class="datum_col_3">
                            <ul class="datum_checkbox-accordian">
                                <?php
                                    foreach ($criteria->data->PropertyType->get_acquisition_criteria_type as $key => $value) {
                                    ?>
                                    <li class="datum_accordian-card">
                                        <div class="datum_accordian-card-header">
                                            <div class="datum_custom_checkbox">
                                                <input type="checkbox" <?php if( (!empty($tempCount1) && !empty($tempCount)) && count($tempCount1[$value->Name]) == count($tempCount[$value->Name]) ) { echo "checked"; } else { echo ""; } ?> class="custom-control-input property_type" id="checkbox_a_<?php echo $value->Id; ?>" name="property_filter[<?php echo $value->Id; ?>][]">
                                                <label class="custom-control-label" for="checkbox_a_<?php echo $value->Id; ?>"><?php echo $value->Name; ?></label>
                                            </div>
                                            <span>+</span> 
                                        </div>
                                        <div class="answer">
                                            <div class="datum_accordian-card-body">
                                                <?php
                                                foreach ($value->get_acquisition_criteria_sub_type as $k => $v) { ?>
                                                        <div class="datum_custom_checkbox">
                                                            <input class="custom-control-input property_sub_type" <?php if( in_array($v->Id, $advance_search_type)){ echo "checked"; } ?> type="checkbox" name="property_type[]" value="<?php echo $v->Id ?>" id="sub_a_<?php echo $v->Id ?>">
                                                            <label for="sub_a_<?php echo $v->Id ?>"> <?php echo $v->Name ?> </label>
                                                        </div>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php } 
                                ?>
                            </ul>
                        </div>

                        <div class="datum_col_9">
                            <div class="datum_row">
                                <div class="datum_col_4">
                                    <div class="form-group datum_advance_search_location">
                                        <label class="datum_label"><?php  _e("Location(s)",'datum'); ?></label>
                                        <input type="text" class="datum_form-control" name="search_by_location" placeholder="<?php  _e("Search by City, State, or Zip Code",'datum'); ?>">
                                    </div>
                                </div>
                                <div class="datum_col_8 datum_padding_0">
                                    <div class="datum_row">
                                        <div class="datum_col_6">
                                            <div class="form-group">
                                                <label class="datum_label"><?php  _e("Asking Price",'datum'); ?></label>
                                                <div class="asking-price-group">
                                                    <input type="text" class="datum_form-control inputmaskdecimal" placeholder="Min $" name="asking_price_from">
                                                    <span>to</span>
                                                    <input type="text" class="datum_form-control inputmaskdecimal" placeholder="Max $" name="asking_price_to">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="datum_col_6">
                                            <div class="form-group">
                                                <label class="datum_label"><?php  _e("Price/SF",'datum'); ?></label>
                                                <div class="asking-price-group">
                                                    <input type="text" class="datum_form-control inputmaskdecimal" placeholder="Min $" name="price_sf_from">
                                                    <span>to</span>
                                                    <input type="text" class="datum_form-control inputmaskdecimal" placeholder="Max $" name="price_sf_to">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="datum_row">
                                        <div class="datum_col_6">
                                            <div class="form-group">
                                                <label class="datum_label"><?php  _e("Price/Unit",'datum'); ?></label>
                                                <div class="asking-price-group">
                                                    <input type="text" class="datum_form-control inputmaskdecimal" placeholder="Min $" name="price_unit_from">
                                                    <span>to</span>
                                                    <input type="text" class="datum_form-control inputmaskdecimal" placeholder="Max $"name="price_unit_to">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="datum_col_6">
                                            <div class="form-group">
                                                <label class="datum_label"><?php  _e("Price/Acre",'datum'); ?></label>
                                                <div class="asking-price-group">
                                                    <input type="text" class="datum_form-control inputmaskdecimal" placeholder="Min $" name="price_acre_from">
                                                    <span>to</span>
                                                    <input type="text" class="datum_form-control inputmaskdecimal" placeholder="Max $" name="price_acre_to">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("Square Feet",'datum'); ?></label>
                                        <div class="asking-price-group">
                                            <input type="text" class="inputmaskonlydecimal datum_form-control" placeholder="Min SF" name="square_feet_from">
                                            <span>to</span>
                                            <input type="text" class="inputmaskonlydecimal datum_form-control" placeholder="Max SF" name="square_feet_to">
                                        </div>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("Units",'datum'); ?></label>
                                        <div class="asking-price-group">
                                            <input type="text" class="number datum_form-control" placeholder="Min" name="unit_from">
                                            <span>to</span>
                                            <input type="text" class="number datum_form-control" placeholder="Max" name="unit_to">
                                        </div>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("Tenancy",'datum'); ?></label>
                                        <select class="tenancy-select2 custom-select-2 datum_form-control custom-select-arrow" multiple="multiple" name="tenancy[]">
                                            <?php 
                                                if( !empty( $criteria->data->property_tenancy ) ) {
                                                  foreach ( $criteria->data->property_tenancy as $key => $value ) {
                                                    ?>
                                            <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                            <?php
                                                }
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("WALT / Lease Term",'datum'); ?></label>
                                        <div class="asking-price-group">
                                            <input type="text" class="number datum_form-control" placeholder="Min Years" name="walt_from">
                                            <span>to</span>
                                            <input type="text" class="number datum_form-control" placeholder="Max Years" name="walt_to">
                                        </div>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("Cap Rate",'datum'); ?></label>
                                        <div class="asking-price-group">
                                            <input type="text" class="occupancydecimal datum_form-control" placeholder="Min %" name="cap_rate_from">
                                            <span>to</span>
                                            <input type="text" class="occupancydecimal datum_form-control" placeholder="Max %" name="cap_rate_to">
                                        </div>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("Listing Status",'datum'); ?></label>
                                        <select class="listing-status-select2 custom-select-2 datum_form-control custom-select-arrow" multiple="multiple" name="property_status[]" id="property_status">
                                            <option value="">Property Status</option>-->
                                            <?php
                                            if( !empty( $criteria->data->property_status ) ) {
                                                foreach ( $criteria->data->property_status as $key => $value ) {
                                                    if($value->Description != 'Closed') {
                                                        ?>
                                                        <option value="<?php echo $value->ID; ?>"><?php echo $value->Description; ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("Occupancy",'datum'); ?></label>
                                        <div class="asking-price-group">
                                            <input type="text" class="occupancydecimal datum_form-control" placeholder="Min %" name="occupancy_from">
                                            <span>to</span>
                                            <input type="text" class="occupancydecimal datum_form-control" placeholder="Max %" name="occupancy_to">
                                        </div>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("Year Built",'datum'); ?></label>
                                        <div class="asking-price-group">
                                            <input type="text" class="number datum_form-control" placeholder="Min" name="build_year_from">
                                            <span>to</span>
                                            <input type="text" class="number datum_form-control" placeholder="Max" name="build_year_to">
                                        </div>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("Days on Market",'datum'); ?></label>
                                        <div class="asking-price-group">
                                            <input type="text" class="number datum_form-control" placeholder="Min" name="day_on_market_from">
                                            <span>to</span>
                                            <input type="text" class="number datum_form-control" placeholder="Max" name="day_on_market_to">
                                        </div>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("Acres",'datum'); ?></label>
                                        <div class="asking-price-group">
                                            <input type="text" class="acresdecimal datum_form-control" placeholder="Min AC" name="acres_from">
                                            <span><?php  _e("to",'datum'); ?></span>
                                            <input type="text" class="acresdecimal datum_form-control" placeholder="Max AC" name="acres_to">
                                        </div>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("Building Class",'datum'); ?></label>
                                        <select class="datum_form-control datum_custom_select" name="building_class">
                                            <option value="">Select</option>
                                            <?php 
                                                if( !empty( $criteria->data->property_building_class ) ) {
                                                  foreach ( $criteria->data->property_building_class as $key => $value ) {
                                                    ?>
                                            <option value="<?php echo $value->Description; ?>"><?php echo $value->Description; ?></option>
                                            <?php
                                                } 
                                                ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="datum_col_4">
                                    <div class="form-group">
                                        <label class="datum_label"><?php  _e("Keyword",'datum'); ?></label>
                                        <input type="text" class="datum_form-control" name="keyword" placeholder="Search">
                                    </div>
                                </div>
                                <div class="datum_col_12">
                                    <button type="submit" class="datum_btn_primary btn-lg datum_float_right"><?php  _e("Apply",'datum'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#datum_advanced_search_form").validate({
        submitHandler: function(form) {
          //$(form).find('[type="submit"]').prop('disabled', true);
          var postUrl = ajax_url+'?action=property_list';
          
          jQuery.ajax({
            type    : 'POST', 
            url     : postUrl,
            data    :  $(form).serialize()+ '&' + $.param(getAjaxCallData()),
            dataType: 'json',
            beforeSend : function() {
                loadingshow();
            },
            success : function(res) {
              switch(res.data.type) {
                case 'success' :
                    $('.datum_login_close').trigger('click');
                    jQuery('#property_listing_html').html(res.data.html);
                    propertymap.setMarkers(res.data.marker_data,false);
                    if(res.data.view_more){
                      $('#loadMore_pl').hide();
                    }else{
                      $('#loadMore_pl').show();
                    }
                    if($('#google_map_data').is(':checked')) {
                        //$(".datum_portfolio_item .datum_item").css("width","50%");
                    }else{
                        //$(".datum_portfolio_item .datum_item").css("width","25%");
                    }
                  break;
                  case 'failure' :
                    for(var i in res.data.html) {
                      var msgs = '';
                      if(res.data.html[i].length) {                                
                        jQuery("#"+ i ).html(msgTemplate.replace(/{{type}}/g, 'danger').replace(/{{msg}}/g, res.data.html[i]));
                      }
                    }
                    break;
                  default :
                  break;
              }
            },
            complete : function() {
                $(".datum_slick_carousel").slick({dots:!1,infinite:!0,speed:300,slidesToShow:1,autoplay:!0});
                loadinghide();
            }
          });
          return false;
        }
    });
    
    $(document).ready(function() {
      $("#datum_advanced_search_form .datum_checkbox-accordian > li > .answer").hide(),
          $("#datum_advanced_search_form .datum_checkbox-accordian li span").click(function() {
          return $(this).closest("li").hasClass("active") ? $(this).closest("li").removeClass("active").find(".answer").slideUp() : ($("#datum_advanced_search_form .datum_checkbox-accordian > li.active .answer").slideUp(), $("#datum_advanced_search_form .datum_checkbox-accordian > li.active").removeClass("active"), $(this).closest("li").addClass("active").find(".answer").slideDown()), !1, $('#datum_advanced_search_form .datum_checkbox-accordian li.datum_accordian-card').each(function( index ) {
            if($(this).hasClass('active')) {
                $(this).children().find('span').text('-');
            } else {
                $(this).children().find('span').text('+');
            }
        });
      })
    });
    
    var MODULE = MODULE || {};
    ! function(o, e) {
        e.init_accordion = function() {
            var e, t, a, i = (e = o(".datum_accordion"), t = e.find(".js-accordion__entry-header-link"), e.find(".datum_accordion_entry"), a = {
                speed: parseInt(e.attr("data-speed")) || 400,
                individual_openable: "true" === e.attr("data-individual-openable")
            }, {
                init: function() {
                    t.on("click", function(e) {
                        e.preventDefault(), i.toggle(o(this))
                    }), !a.individual_openable && 1 < o(".datum_accordion_entry.is-expanded").length && o(".datum_accordion_entry.is-expanded").removeClass("is-expanded")
                },
                toggle: function(e) {
                    a.individual_openable || e[0] == e.closest(".datum_accordion").find(".datum_accordion_entry.is-expanded .datum_accordion_entry_header_link")[0] || e.closest(".datum_accordion").find(".datum_accordion_entry").removeClass("is-expanded").find(".c-accordion__entry-body").slideUp(), e.closest(".datum_accordion_entry").toggleClass("is-expanded").attr("aria-expanded", function(e, t) {
                        return "true" == t ? "false" : "true"
                    }), e.parent().attr("aria-selected", function(e, t) {
                        return "true" == t ? "false" : "true"
                    }), e.parent().next().stop().slideToggle(a.speed).attr("aria-hidden", function(e, t) {
                        return "true" == t ? "false" : "true"
                    })
                }
            });
            i.init()
        }, o(function() {
            e.init_accordion()
        })
    }(jQuery, MODULE);

    $(".tenancy-select2").select2({
        closeOnSelect: !1,
        placeholder: "Property Tenancy",
        allowHtml: !0,
        allowClear: !0,
        tags: !0
    });

    $(".listing-status-select2").select2({
          closeOnSelect: !1,
          placeholder: "Property Status",
          allowHtml: !0,
          allowClear: !0,
          tags: !0
    });
    
    function getAjaxCallData(lat = '',long = '',nkf_radius_km = ''){
    var data = {
        'lat':lat,
        'long':long,
        'radius_in_km':nkf_radius_km,
        'propertystatus':$('#property_status').val(),
        'propertytype':$('#property_type').val(),
        'propertysearch':$('#property_search').val(),
        'page':$('#loadMore_pl').attr('data-page'),
    };
    return data;
    }
    
    $(document).on("click", ".property_type", function(e) {
        if($(this).prop('checked')){
            $(this).closest('li').find('.property_sub_type').prop('checked', true); 
        }else{
            $(this).closest('li').find('.property_sub_type').prop('checked', false);
        }
    });
    $(document).on("click", ".property_sub_type", function(e) {
        var parentOfParent = $(this).closest('li').find('.property_sub_type');
        var unchecked = 0;
        var checkedCHeck = 0;
        parentOfParent.each(function() {
            var checked = $(this).prop('checked')
            if(checked) {
                checkedCHeck = checkedCHeck + 1;
            }
        });
        if( checkedCHeck != 0 ) {
            $(this).closest('li').find('.property_type').prop('checked', true);
        } else {
            $(this).closest('li').find('.property_type').prop('checked', false);
        }
    });
    $('.number').keypress(function(event) {
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
    $(document).ready(function(){

        $('.inputmaskdecimal').inputmask({
            alias: 'decimal',
            groupSeparator: ',',
            autoGroup: true,
            digits: 0,
            digitsOptional: false,
            prefix: '$',
            rightAlign: false,
            allowMinus: false,
            allowPlus: false
        });

        $('.inputmaskonlydecimal').inputmask({
            alias: 'decimal',
            groupSeparator: ',',
            autoGroup: true,
            digits: 0,
            digitsOptional: false,
            rightAlign: false,
            allowMinus: false,
            allowPlus: false
        });
        $('.occupancydecimal').inputmask({
            alias: 'decimal',
            groupSeparator: ',',
            autoGroup: true,
            digits: 0,
            digitsOptional: false,
            suffix: '%',
            rightAlign: false,
            allowMinus: false,
            allowPlus: false
        });
        $('.acresdecimal').inputmask({
            alias: 'decimal',
            groupSeparator: ',',
            autoGroup: true,
            digits: 0,
            digitsOptional: false,
            suffix: '%',
            rightAlign: false,
            allowMinus: false,
            allowPlus: false
        });

    });
</script>