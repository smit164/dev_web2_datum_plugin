<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $single_property;
if(getDMPropertyListingStatusOnly() == 'Offers Due'){
    $propertystatus = getDMPropertyListingStatus();
}

?>
<section class="datum_pdp_feature_list">
    <div class="datum_row">
        <div class="datum_deskdevice_6 datum_rp_15">
            <div class="datum_feature_detail_tab datum_d_sm_none">
                <h2 class="datum_headline"> <?php  _e("Offering Summary",'datum'); ?></h2>
                <?php if($propertystatus != '') { ?>
                    <p class="datum_offer_due_date"><?php echo $propertystatus; ?></p>
                <?php } ?>
                <div class="datum_collapse_data">
                    <div class="basic-detail-group">
                        <div class="basic-detail address_detail">
                            <h4 class="headline"><?php  _e("Address",'datum'); ?></h4>
                            <ul>
                                <div class="innerDiv">
                                    <li><?php echo getDMPropertyAddress1(); ?><br><?php echo getDMPropertyCity(); ?>, <?php echo getDMPropertyState(); ?> <?php echo getDMPropertyZipcode(); ?></li>
                                </div>
                            </ul>
                        </div>
                        <?php echo do_action('datum_property_details'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="datum_deskdevice_6 datum_lp_15">
            <?php do_action('datum_single_gallery_slider'); ?>
            <div class="datum_download_section">
                <a data-property_id="<?php echo getDMPropertyId(); ?>" data-popup="login_html" class="datum_btn_primary datum_modal_toggle datum_model_open" id="login_popup_sdata"><?php  _e("OFFERING MEMORANDUM",'datum'); ?></a>
                <a  href="javascript:void(0);" data-popup="due_diligence" data-property_id="<?php echo getDMPropertyId(); ?>" class="datum_btn_grey due_diligence_popup datum_model_open" id="due_diligence_popup" <?php if(!empty( $checkCaSign )) { echo ''; } else { echo 'style="pointer-events: none;"'; } ?> style=""> <img src="<?php echo plugins_url() ?>/datum/images/icons/lock.svg"> <?php  _e("DUE DILIGENCE",'datum'); ?></a> 
                
            </div>
        </div>
    </div>
</section>
<!--  Mobile   -->
<div class="datum_accordion-new datum_d_sm_block datum_d_none" data-individual-openable="false" data-speed="400">
    <div class="datum_accordion_entries">
       <div class="datum_accordion_entry is-expanded" aria-expanded="true" role="tablist">
          <div id="c-accordion__entry-title-1" class="datum_accordion_entry_title" aria-selected="true" aria-controls="datum_accordion_entry_body_1" role="tab">
             <span class="datum_accordion_entry_header_link js-accordion__entry-header-link">
                <h2 class="datum_headline"><?php  _e("Offering Summary",'datum'); ?></h2>
               <!--  <div class="datum_accordion_entry_header_icon_wrapper">
                   <svg class="datum_accordion_entry_header_icon" xmlns="http://www.w3.org/2000/svg" width="14.999" height="12.979" viewBox="0 0 19.999 12.979">
                      <path d="M12,14.979l-10-10L4.979,2,12,9.021,19.02,2,22,4.979Z" transform="translate(-2 -2)" fill="#7c7c7c"></path>
                   </svg>
                </div> -->
             </span>
          </div>
          <div id="datum_accordion_entry_body_1" class="datum_accordion_entry_body" aria-hidden="false" role="tabpanel" aria-labelledby="c-accordion__entry-title-1" style="display: block;">
             <div class="datum_accordion_entry_content c-wysiwyg pdp-offeringSummary">
                <div class="datum_collapse_data">
                   <div class="basic-detail-group">
                      <div class="basic-detail address_detail">
                         <h4 class="headline"><?php  _e("Address",'datum'); ?></h4>
                         <ul>
                            <div class="innerDiv">
                                <li><?php echo getDMPropertyAddress1(); ?><br><?php echo getDMPropertyState(); ?> <?php echo getDMPropertyZipcode(); ?></li>
                            </div>
                         </ul>
                      </div>
                      <?php  include 'property_details.php';?>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="datum_accordion_entry" aria-expanded="false" role="tablist">
          <div id="c-accordion__entry-title-2" class="datum_accordion_entry_title" aria-selected="false" aria-controls="datum_accordion_entry_body_2" role="tab">
             <span class="datum_accordion_entry_header_link js-accordion__entry-header-link">
                <h2 class="datum_headline"><?php  _e("Description",'datum'); ?></h2>
                <!-- <div class="datum_accordion_entry_header_icon_wrapper">
                   <svg class="datum_accordion_entry_header_icon" xmlns="http://www.w3.org/2000/svg" width="14.999" height="12.979" viewBox="0 0 19.999 12.979">
                      <path d="M12,14.979l-10-10L4.979,2,12,9.021,19.02,2,22,4.979Z" transform="translate(-2 -2)" fill="#7c7c7c"></path>
                   </svg>
                </div> -->
             </span>
          </div>
          <div id="datum_accordion_entry_body_2" class="datum_accordion_entry_body" aria-hidden="true" role="tabpanel" aria-labelledby="c-accordion__entry-title-2" style="display: block;">
             <div class="datum_accordion_entry_content c-wysiwyg pdp-description">
                <p><?php echo getDMPropertyPropertyContent(); ?>
                </p>
             </div>
          </div>
       </div>
    </div>
</div>