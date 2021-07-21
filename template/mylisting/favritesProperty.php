<?php
global $single_property;
    if(!empty($favritesProperty)){
        foreach ($favritesProperty as $key => $value) {
            $single_property = $value;
            $post_name = get_option('datum_property_listing_id');
            $dm_post 	= get_post($post_name);
            ?>
                <div class="listing-box">
                    <div class="datum_col_2">
                        <a href="<?php echo getDMProperyURL();  ?>" target="_blank">
                            <img src="<?php echo getDMPropertyMarkerListImage(); ?>" class="img-fluid" alt="<?php echo getDMPropertyImageAltText(); ?>">
                        </a>
                    </div>

                    <div class="listing-detail datum_col_10">
                        <div class="above-div">
                            <div>
                                <h4>
                                    <a href="<?php echo getDMProperyURL();  ?>" target="_blank" style="color:inherit;"><?php echo getDMPropertyName(); ?></a><span class="pro_status"><?php echo getDMPropertyListingStatus(); ?></span>
                                </h4>
                                <p><?php echo getDMPropertyAddress1(); ?><br><?php echo getDMPropertyCity(); ?>, <?php echo getDMPropertyState(); ?> <?php echo getDMPropertyZipcode(); ?></p>
                                <label class="datum_star_toggle" id="favorite_my_listing_start" >
                                    <input type="checkbox" data-popup="favorite_my_listing" data-property_id="<?php echo getDMPropertyId(); ?>" checked class="favorite_my_listing_start">
                                    <div class="datum_icon">
                                        <div class="datum_star"> </div>
                                    </div>
                                </label>
                            </div>                                
                        </div>

                        <div class="below-div">
                            <div class="price"><?php echo getDMPropertyAskingPrice(); ?></div>
                            
                        </div>

                        <div class="counts-wrap">
                            <div class="imp-counts">
                                <div class="lable">
                                    <h4>$<?php echo getDMPropertyAskingPrice(); ?></h4>
                                    <p>Asking Price</p>
                                </div>
                                <div class="lable">
                                    <h4><?php echo getDMPropertyYear1CapRate(); ?></h4>
                                    <p>Cap Rate</p>
                                </div>
                                <div class="lable">
                                    <h4><?php echo getDMPropertyOccupancy() ?></h4>
                                    <p>Occupancy</p>
                                </div>
                                <div class="lable">
                                    <h4><?php echo getDMPropertyWalt() ?></h4>
                                    <p>WALT</p>
                                </div>
                                <div class="lable">
                                    <h4><?php echo getDMPropertyListingStatus(); ?></h4>
                                    <p>Property Type</p>
                                </div>
                                <div class="lable">
                                    <h4><?php echo getDMPropertySqFeet(); ?></h4>
                                    <p>Square Feet</p>
                                </div>
                            </div>
                            

                        </div>
                    </div>
                </div>
            <?php
        }
    }else{ ?>
        <div class="clearfix datum_no_record myListing-page">
            <section class="datum_no_record_content">
                <picture>
                    <img src="https://datumdocstorage.blob.core.windows.net/datumfilecontainer/error/listing-no-result-found.png" alt="no-result-found.png" class="img-responsive" loading="lazy">
                </picture>
                <div class="">
                    <p>We are out hunting for more  deals. Check back here and subscribe to our email list to be the first to know about new deals.</p>
                </div>
            </section>
        </div>
    <?php }
?>