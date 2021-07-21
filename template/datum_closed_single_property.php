<?php
get_header();
global $single_property;

$userId = '';
if(!empty($datum_user) && $datum_user != '') {
    $userId = $datum_user->id;
}
?>
<div class="datum_page_content">
    <?php
    // main_image.php
    do_action('datum_single_main_content');

    //details_mainbox.php
    do_action('datum_single_main_mainbox');
    ?>
    <div class="datum_wrapper">
        <div class="datum_breadcrumb_div">
            <ul>
                <li> <a href="<?php echo home_url(); ?>">Home</a></li>
                <li> <a href="<?php echo getDMProperyMainURL(); ?>"><?php echo get_the_title(); ?></a></li>
                <li> <a href="#"><?php echo getDMPropertyPropertyStatus();  ?></a></li>
                <li class="active"><?php echo getDMPropertyName(); ?></li>
            </ul>

            <div class="datum_property_actions">
                <?php
                $favorites = false;
                if(isset($single_property->favorite) && $single_property->favorite != '' && $single_property->favorite == 1) {
                    $favorites = true;
                }
                ?>
                <ul>
                    <li>
                        <label class="datum_star_toggle datum_model_open" data-popup="favorite_popup" data-property_id="<?php echo $single_property->id; ?>">
                            <input type="checkbox" <?php if($favorites) { echo 'checked'; }?>>
                            <div class="datum_icon">
                                <div class="datum_star"> </div>
                            </div>
                        </label>
                    </li>

                    <li> 
                        <div class="datum_share_icon">
                            <div data-popup="share_property" data-property_id="<?php echo getDMPropertyId(); ?>" class="datum_share_button datum_modal_toggle datum_model_open" id="datum_share_button">
                                <img src="<?php echo plugins_url()?>/datum/images/icons/social/share.svg">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        <section class="datum_pdp_feature_list">
            <div class="datum_row">
                <div class="datum_deskdevice_6 datum_rp_15">
                    <div class="datum_feature_detail_tab datum_feature_detail_tab_closed datum_d_sm_none">
                        <h2 class="datum_headline">Offering Summary</h2>
                        <div class="datum_collapse_data">
                            <div class="basic-detail-group">
                                <div class="basic-detail address_detail">
                                    <h4 class="headline">Address</h4>
                                    <ul>
                                        <div class="innerDiv">
                                            <li><?php echo getDMPropertyAddress1(); ?><br><?php echo getDMPropertyState(); ?> <?php echo getDMPropertyZipcode(); ?></li>
                                        </div>
                                    </ul>
                                </div>
                                <?php echo do_action('datum_property_details'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="datum_deskdevice_6 datum_lp_15">
                    <div class="feature-info datum_d_sm_none">
                        <h2 class="datum_headline">Sale Description</h2>
                        <div id="datum_nkf_theme_content" class="datum_nkf_theme_content_closed">
                            <p><?php echo getDMPropertyPropertyContent(); ?></p>

                            <div class="datum_download_section">
                                <a class="datum_btn_primary datum_modal_toggle datum_model_open" data-property_id="<?php echo getDMPropertyId(); ?>" data-popup="request_info" id="request_info">Request Info</a>
                                <?php include 'closed/press_release.php'; ?>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
        <div class="datum_accordion datum_d_sm_block datum_d_none" data-individual-openable="false" data-speed="400">
                <div class="datum_accordion_entries">
                    <div class="datum_accordion_entry is-expanded" aria-expanded="true" role="tablist">
                        <div id="c-accordion__entry-title-1" class="datum_accordion_entry_title" aria-selected="true" aria-controls="datum_accordion_entry_body_1" role="tab">
                            <a href="" class="datum_accordion_entry_header_link js-accordion__entry-header-link">
                                Offering Summary
                                <div class="datum_accordion_entry_header_icon_wrapper">
                                    <svg class="datum_accordion_entry_header_icon" xmlns="http://www.w3.org/2000/svg" width="14.999" height="12.979" viewBox="0 0 19.999 12.979">
                                        <path d="M12,14.979l-10-10L4.979,2,12,9.021,19.02,2,22,4.979Z" transform="translate(-2 -2)" fill="#7c7c7c"></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div id="datum_accordion_entry_body_1" class="datum_accordion_entry_body" aria-hidden="false" role="tabpanel" aria-labelledby="c-accordion__entry-title-1" style="display: block;">
                            <div class="datum_accordion_entry_content c-wysiwyg pdp-offeringSummary">
                                <div class="datum_collapse_data">
                                    <div class="basic-detail-group">
                                        <div class="basic-detail address_detail">
                                            <h4 class="headline">Address</h4>
                                            <ul>
                                                <div class="innerDiv">
                                                    <li><?php echo getDMPropertyAddress1(); ?><br><?php echo getDMPropertyState(); ?> <?php echo getDMPropertyZipcode(); ?>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                        <?php
                                        include 'single/property_details.php';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="datum_accordion_entry" aria-expanded="false" role="tablist">
                        <div id="c-accordion__entry-title-2" class="datum_accordion_entry_title" aria-selected="false" aria-controls="datum_accordion_entry_body_2" role="tab">
                            <a href="" class="datum_accordion_entry_header_link js-accordion__entry-header-link">
                                Description
                                <div class="datum_accordion_entry_header_icon_wrapper">
                                    <svg class="datum_accordion_entry_header_icon" xmlns="http://www.w3.org/2000/svg" width="14.999" height="12.979" viewBox="0 0 19.999 12.979">
                                        <path d="M12,14.979l-10-10L4.979,2,12,9.021,19.02,2,22,4.979Z" transform="translate(-2 -2)" fill="#7c7c7c"></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div id="datum_accordion_entry_body_2" class="datum_accordion_entry_body" aria-hidden="true" role="tabpanel" aria-labelledby="c-accordion__entry-title-2">
                            <div class="datum_accordion_entry_content c-wysiwyg pdp-description">
                                <p><?php echo getDMPropertyPropertyContent(); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="datum_row mt-50 pb-50">
            <div class="datum_deskdevice_6 datum_rp_15 datum_feature_slider_closed">
                <?php do_action('datum_single_gallery_slider'); ?>
            </div>
            <?php echo do_action('datum_single_deal_team'); ?>
        </div>
    </div>
</div>
<?php
include 'login.php';
include 'loading.php';
get_footer();
?>