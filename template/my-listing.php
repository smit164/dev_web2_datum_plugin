<?php
    get_header();
    global $mypropertylist,$single_property;
     if (!empty($single_property->sq_feet)) {
        $sq_feet = number_format($single_property->sq_feet);
    }else{
        $sq_feet = '-';
    }
?>
<?php do_action('datum_banner_section'); ?>
<div class="datum_wrapper">
    <section class="myListing-page" id="section1">
        <div class="datum_row">
            <?php
            if(empty($mypropertylist)){ ?>
                <div class="clearfix datum_no_record">
                    <section class="datum_no_record_content">
                        <picture>
                            <img src="https://datumdocstorage.blob.core.windows.net/datumfilecontainer/error/listing-no-result-found.png" alt="no-result-found.png" class="img-responsive" loading="lazy">
                        </picture>
                        <div class="">
                            <p><?php  _e("We are out hunting for more  deals. Check back here and subscribe to our email list to be the first to know about new deals.",'datum'); ?></p>
                        </div>
                    </section>
                </div>
            <?php }else{ ?>
                <?php
                foreach ($mypropertylist as $key => $value) {
                    $single_property = $value;
                    ?>
                    <div class="listing-box">
                        <div class="datum_col_2">
                            <a href="<?php echo getDMProperyURL();?>" target="_blank">
                                <img src="<?php echo getDMPropertyMarkerListImage(); ?>" class="img-fluid" alt="<?php echo getDMPropertyImageAltText(); ?>">
                            </a>
                        </div>
                        <div class="listing-detail datum_col_10">
                            <div class="above-div">
                                <div>
                                    <h4>
                                        <a href="<?php echo getDMProperyURL(); ?>" target="_blank" style="color:inherit;"><?php echo getDMPropertyName(); ?></a><span class="pro_status"><?php echo getDMPropertyListingStatus(); ?></span>
                                    </h4>
                                    <p><?php echo getDMPropertyAddress1(); ?><br><?php echo getDMPropertyCity(); ?>, <?php echo getDMPropertyState(); ?> <?php echo getDMPropertyZipcode(); ?></p>
                                </div>
                                <div class="contact-link">
                                    <a href="javascript:void(0)" data-property_id="<?php echo getDMPropertyId(); ?>" data-popup="contact_from" class="datum_modal_toggle datum_model_open"><span><img src="<?php echo DATUM_PLUGIN_IMAGES_URL ?>icons/envelope.png"></span>Contact</a>
                                </div>
                            </div>
                            <div class="below-div">
                                <div class="price"><?php echo getDMPropertyAskingPrice(); ?></div>
                                <div class="listing-btns">
                                    <a href="javascript:void(0)" data-property_id="<?php echo getDMPropertyId(); ?>" data-popup="login_html" class="datum_btn_primary datum_modal_toggle datum_model_open" id="login_popup_sdata"><?php  _e("OFFERING MEMORANDUM",'datum'); ?></a>
                                    <a href="javascript:void(0);" data-popup="due_diligence" data-property_id="<?php echo getDMPropertyId(); ?>" class="datum_btn_grey datum_modal_toggle datum_model_open"><img src="<?php echo DATUM_PLUGIN_IMAGES_URL ?>icons/lock.svg" id="due_diligence_popup"><?php  _e("DUE DILIGENCE",'datum'); ?></a>
                                   
                                </div>
                            </div>
                            <div class="counts-wrap">
                                <div class="imp-counts">
                                    <div class="lable">
                                        <h4><?php echo getDMPropertyAskingPrice(); ?></h4>
                                        <p><?php  _e("Asking Price",'datum'); ?></p>
                                    </div>
                                    <div class="lable">
                                        <h4><?php echo getDMPropertyYear1CapRate(); ?></h4>
                                        <p><?php  _e("Cap Rate",'datum'); ?></p>
                                    </div>
                                    <div class="lable">
                                        <h4><?php echo getDMPropertyOccupancy() ?></h4>
                                        <p><?php  _e("Occupancy",'datum'); ?></p>
                                    </div>
                                    <div class="lable">
                                        <h4><?php echo getDMPropertyWalt() ?></h4>
                                        <p><?php  _e("WALT",'datum'); ?></p>
                                    </div>
                                    <div class="lable">
                                        <h4><?php echo getDMPropertyListingStatus(); ?></h4>
                                        <p><?php  _e("Property Type",'datum'); ?></p>
                                    </div>
                                    <div class="lable">
                                        <h4><?php echo getDMPropertySqFeet(); ?></h4>
                                        <p><?php  _e("Square Feet",'datum'); ?></p>
                                    </div>
                                </div>
                                <a href="javascript:void(0);" data-property_id="<?php echo getDMPropertyId(); ?>" class="download_nda_pdf"><img src="<?php echo DATUM_PLUGIN_IMAGES_URL ?>icons/download-solid.svg"> <?php  _e("Download CA",'datum'); ?></a>

                            </div>
                        </div>
                    </div>
                <?php }
                ?>
               
            <?php }
            ?>
        </div>
    </section>
</div>
    <script type="text/javascript">

        jQuery(document).on('click','.download_nda_pdf',function(e){
            var property_id = $(this).attr('data-property_id');
            window.location.href = "<?php echo DATUM_PLUGIN_URL; ?>datum_ca_download.php?p_id=" +property_id;
        });
    </script>
<?php
include 'login.php';
get_footer();
?>