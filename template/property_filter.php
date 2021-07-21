<?php
$asking_price_min_max = $criteria->data->asking_price_min_max;
$asking_price_max = ($asking_price_min_max[0]->max_asking_price) ? $asking_price_min_max[0]->max_asking_price : 0;
$asking_price_min = ($asking_price_min_max[0]->min_asking_price) ? $asking_price_min_max[0]->min_asking_price : 0;
$maxMinus = $asking_price_max - $asking_price_min;
$maxMinus = $maxMinus / 5;
$minMaxOption = range($asking_price_min, $asking_price_max, $maxMinus);
?>
<form method="post" name="property_filter" id="property_filter">
    
    <div class="datum_wrapper">
        <div class="datum_topbar" style="margin-top: 61px;">
            <div class="datum_row">
                <div class="datum_topbar_search">
                    <input type="text" id="property_search" name="property_search" value="<?php get_parameter_search(); ?>" placeholder="<?php  _e("Search by Location, Property Type, or Description",'datum'); ?>" class="datum_topbar_search_box datum_form-control">
                    <div id="suggesstion-box"></div>
                </div>
            </div>
        </div>
        <div class="datum_filter_row">
            <div class="datum_filter_leftcontent">

                <div class="datum_drop-down datum_select_box" id="datum_drop-down-property">
                    <div id="datum_property_dropDown" class="datum_form-control"><?php  _e("Property Type",'datum'); ?></div>
                    <div class="datum_drop-down_menubox">
                        <ul class="datum_checkbox-accordian" id="f_property_type">
                            <?php
                            foreach ($criteria->data->PropertyType->get_acquisition_criteria_type as $k1 => $value) {
                                ?>
                                <li class="datum_accordian-card">
                                    <div class="datum_accordian-card-header">
                                        <div class="datum_custom_checkbox">
                                            <input type="checkbox" class="custom-control-input f_property_type" id="checkbox_<?php echo $value->Id; ?>" name="property_filter[<?php echo $value->Id; ?>][]">
                                            <label class="custom-control-label" for="checkbox_<?php echo $value->Id; ?>"><?php echo $value->Name; ?></label>
                                        </div>
                                        <span>+</span> 
                                    </div>
                                    <div class="answer">
                                        <div class="datum_accordian-card-body">
                                            <?php
                                            foreach ($value->get_acquisition_criteria_sub_type as $k => $v) { ?>
                                                    <div class="datum_custom_checkbox">
                                                        <input class="custom-control-input f_property_sub_type" type="checkbox" name="property_type[]" value="<?php echo $v->Id ?>" id="sub_<?php echo $v->Id ?>">
                                                        <label for="sub_<?php echo $v->Id ?>"> <?php echo $v->Name ?> </label>
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
                </div>
                <div class="datum_drop-down datum_select_box" id="datum_drop-down-asking-price">
                    <div id="datum_asking_price_dropDown" class="datum_form-control"> <?php  _e("Asking Price",'datum'); ?> </div>
                    <div class="datum_drop-down_menubox" >
                        <ul class="datum_text-box-custome">
                            <li>
                                <div class="datum_text-box-card-header">

                                    <div class="datum-asking-min">
                                        <input type="text" name="askin_min" min="0" oninput="validity.valid||(value='');"placeholder="$ Min" class="datum-asking-min-text datum_form-control inputmaskdecimal" id="asking_min_price">
                                    </div>

                                    <div class="datum-asking-max">
                                        <input type="text" name="askin_max" placeholder="$ Max" class="datum-asking-max-text datum_form-control inputmaskdecimal" id="asking_max_price">
                                    </div>

                                </div>
                            </li>
                            <?php
                            if( !empty( $minMaxOption ) ) {
                                for($i = 0; $i<count($minMaxOption);$i++) {
                                    if(isset($minMaxOption[$i+1])) {
                                        ?>
                                        <li data-min="<?php echo $minMaxOption[$i]; ?>" data-max="<?php echo $minMaxOption[$i+1]; ?>">$<?php echo number_format($minMaxOption[$i]); ?>to $<?php echo number_format($minMaxOption[$i+1]); ?></li>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <?php
                    global $post;
                    $post_closed = get_option('datum_property_closed_id');
                    

                    if($post_closed == $post->ID){ 
                        foreach ($criteria->data->property_status as $key => $value) {
                                if($value->Description == 'Closed') { ?>
                                    <input type="hidden" name="property_status" value="<?php echo $value->ID; ?>" id="property_status">
                                <?php }
                            }
                        ?>
                    
                <?php } else{ ?>
                <div class="datum_select_box" id="datum_drop-down-property-status">
                    <select class="custom-select-2 datum_form-control custom-select-arrow property-status-select2" multiple="multiple" name="property_status[]" id="property_status">
                        <option value=""><?php  _e("Property Status",'datum'); ?></option>
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
                <?php } ?>
                <button class="datum_btn_secondary datum_model_open" data-popup="advanced_search"><?php  _e("Advanced Search",'datum'); ?></button>
                <a class="datum_filter_clear text-blue datum_hide">Clear</a>
            </div>
            <div class="datum_filter_rightcontent">
                <div class="datum_listing_type">
                    <div class="datum_select_box">
                        <select class="datum_form-control property_sorting" name="sorting" id="property_sorting">
                            <option value="">Sort</option>
                            <option data-sort="1" data-name="Asking Price" value="asking_price_high"><?php  _e("Asking Price (High to Low)",'datum'); ?></option>
                            <option data-sort="0" data-name="Asking Price"  value="asking_price_low"><?php  _e("Asking Price (Low to High)",'datum'); ?></option>
                            <option data-sort="1" data-name="Square Feet"  value="square_feet_high"><?php  _e("Square Feet (High to Low)",'datum'); ?></option>
                            <option data-sort="0" data-name="Square Feet"  value="square_feet_low"><?php  _e("Square Feet (Low to High)",'datum'); ?></option>
                            <option data-sort="1" data-name="Units"  value="unites_high"><?php  _e("Units (High to Low)",'datum'); ?></option>
                            <option data-sort="0" data-name="Units"  value="unites_low"><?php  _e("Units (Low to High)",'datum'); ?></option>
                            <option data-sort="1" data-name="Occupancy"  value="occupancy_high"><?php  _e("Occupancy (High to Low)",'datum'); ?></option>
                            <option data-sort="0" data-name="Occupancy"  value="occupancy_low"><?php  _e("Occupancy (Low to High)",'datum'); ?></option>
                            <option data-sort="1" data-name="Cap Rate"  value="cap_rate_high"><?php  _e("Cap Rate (High to Low)",'datum'); ?></option>
                            <option data-sort="0" data-name="Cap Rate"  value="cap_rate_low"><?php  _e("Cap Rate (Low to High)",'datum'); ?></option>
                            <option data-sort="1" data-name="Days on Market"  value="days_on_market_new"><?php  _e("Days on Market (New to Old)",'datum'); ?></option>
                            <option data-sort="0"  data-name="Days on Market" value="days_on_market_high"><?php  _e("Days on Market (Old to New)",'datum'); ?></option>
                        </select>
                    </div>
                </div>
                 
            </div>
<!--            <img src="--><?php //echo home_url() ?><!--/wp-content/plugins/datum/images/icons/sort.svg">-->
            <!-- <img class="up-arrow-sorting" src="<?php //echo home_url() ?>/wp-content/plugins/datum/images/icons/sort-amount-up.svg">
            <img class="down-arrow-sorting" src="<?php //echo home_url() ?>/wp-content/plugins/datum/images/icons/sort-amount-down.svg"> -->
            <div class="datum_pl_googlemap">
                <label>Map</label>
                <label class="switch">
                <input type="checkbox" name="google_map_data" id="google_map_data" value="1" <?php echo get_parameter_map(); ?>>
                <span class="slider round"></span> </label>
            </div>
        </div>
        <div class="datum_breadcrumb_div">
            <ul>
                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="active"><?php echo get_the_title(); ?></li>
            </ul>
        </div>
    </div>
    <input type="hidden" name="asking_price" value="" id="asking_price_min_max">
    <input type="hidden" name="property_search" value="" id="property_name_selected">
    <input type="hidden" name="lat" value="" id="current_lat">
    <input type="hidden" name="long" value="" id="current_long">
    <input type="hidden" name="radius_in_km" value="" id="nkf_radius_km">
    <input type="hidden" name="next_page" value="" id="next_page">
</form>
<script type="text/javascript">

    $(document).on("click", "#f_property_type .f_property_type", function(e) {
        if($(this).prop('checked')){
            $(this).closest('li').find('.f_property_sub_type').prop('checked', true); 
        }else{
            $(this).closest('li').find('.f_property_sub_type').prop('checked', false);
        }
        ajaxCall();
    });

    $(document).on("click", "#f_property_type .f_property_sub_type", function(e) {
        var parentOfParent = $(this).closest('li').find('.f_property_sub_type');
        var unchecked = 0;
        var checkedCHeck = 0;
        parentOfParent.each(function() {
            var checked = $(this).prop('checked')
            if(checked) {
                checkedCHeck = checkedCHeck + 1;
            }
        });
        if( checkedCHeck  != 0 ) {
            $(this).closest('li').find('.f_property_type').prop('checked', true);
        } else {
            $(this).closest('li').find('.f_property_type').prop('checked', false);
        }
        ajaxCall();
    });

    jQuery(document).ready(function() {
        jQuery("#datum_asking_price_dropDown").click(function() {
            jQuery("#datum_drop-down-asking-price").toggleClass("datum_drop-down--active");
        })
    })

    /**
     * Property Asking price filter
     */
    jQuery(document).on('click','#datum_drop-down-asking-price .datum_drop-down_menubox ul.datum_text-box-custome li:not(:first)',function(e){
        e.preventDefault();
        var dropdownTitle = $(this).text();
        $("#datum_asking_price_dropDown").text(dropdownTitle);
        var min =$(this).attr('data-min');
        var max =$(this).attr('data-max');
        $('#asking_price_min_max').val(min+','+max);
        jQuery("#datum_drop-down-asking-price").toggleClass("datum_drop-down--active");
        ajaxCall();
    });

    jQuery('#datum_drop-down-asking-price .datum_drop-down_menubox ul.datum_text-box-custome li:first-child .datum_text-box-card-header .datum-asking-min, #datum_drop-down-asking-price .datum_drop-down_menubox ul.datum_text-box-custome li:first-child .datum_text-box-card-header .datum-asking-max').keyup(function(e){
        e.preventDefault();
        var min = $('.datum-asking-min-text').val();
        var max = $('.datum-asking-max-text').val();
        if(min != '' && max != '' && max.length > 6 ) {
            $('#asking_price_min_max').val(min+','+max);
            jQuery("#datum_drop-down-asking-price").toggleClass("datum_drop-down--active");
            ajaxCall();
        }
    });

    $("body").click(function( event ){
        var $target = $(event.target);
        if(!$target.closest("#datum_drop-down-property").length) {
            if($("#datum_drop-down-property").hasClass('datum_drop-down--active')) {
                $("#datum_drop-down-property").removeClass('datum_drop-down--active');
            }
        }

        if(!$target.closest("#datum_drop-down-asking-price").length) {
            if($("#datum_drop-down-asking-price").hasClass('datum_drop-down--active')) {
                $("#datum_drop-down-asking-price").removeClass('datum_drop-down--active');
            }
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
        $(".property-status-select2").select2({
            closeOnSelect: !1,
            placeholder: "Property Status",
            allowHtml: !0,
            allowClear: !0,
            tags: !0
        });
    });

</script>