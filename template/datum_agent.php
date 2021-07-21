<?php
    get_header();
    global $single_property;
    $post_name  = get_option('datum_property_listing_id');
    $dm_post 	= get_post($post_name);
?>
<section class="datum_agent_banner">
    <div class="datum_banner_image">
        <img src="<?php echo DATUM_PLUGIN_URL ?>/images/backgrounds/agent-banner.jpg" alt="properties" class="datum_agent_banner_bg" loading="lazy">
        <div class="container-fluid">
            <div class="datum_agent_mainContent">
                <img src="<?php echo $agentDetails->ProfileImage; ?>" class="datum_agentpic">
                <div class="agent_detail">
                    <h4><?php echo $agentDetails->FirstName.' '.$agentDetails->LastName; ?></h4>
                    <p class="profile_title"><?php echo $agentDetails->Title; ?></p>
                    <p><span><img src="<?php echo DATUM_PLUGIN_URL ?>/images/icons/phone_banner.png"></span> <a class="work_phone_display" href="tel:<?php echo $agentDetails->WorkPhone; ?>"><?php echo $agentDetails->WorkPhone; ?></a></p>
                    <p><span><img src="<?php echo DATUM_PLUGIN_URL ?>/images/icons/email_banner.png"></span> <span><a href="mailto:<?php echo $agentDetails->Email; ?>"><?php echo $agentDetails->Email; ?></a></span></p>
                    <p><?php echo $agentDetails->Address; ?>, <?php echo $agentDetails->Suite; ?><br><?php echo $agentDetails->State; ?>, <?php echo $agentDetails->Country; ?> <?php echo $agentDetails->ZipCode; ?></p>
                    <p>CA RE Lic. <?php echo $agentDetails->CorporateLicense; ?></p>
                    <a href="<?php echo $agentDetails->LinkedIn; ?>"><img src="<?php echo DATUM_PLUGIN_URL ?>/images/icons/linkedin-logo.png"></a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="datum_wrapper">
    <div class="datum_breadcrumb_div">
        <ul>
            <li> <a href="<?php echo getDMProperyMainURL(); ?>"><?php  _e("Listings",'datum'); ?></a></li>

            <li class="active"><?php echo $agentDetails->FirstName.' '.$agentDetails->LastName; ?></li>
        </ul>
    </div>
    <section class="datum_agent_aboutUs">
        <div class="datum_row">
            <div class="datum_col_8 datum_pl_0">
                <div class="datum_feature-info">
                    <div class="datum_title-with-border">
                        <h2><?php echo $agentDetails->FirstName.' '.$agentDetails->LastName; ?></h2>
                    </div>
                    <div class="datum_agent_content">
                        <p><?php echo $agentDetails->Bio; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php if(!empty($agentDetails->closed_property)) { ?>
<section class="clearfix datum_closed_listings_section">
    <div class="container-fluid overflow-hide">
        <div class="row clearfix">
            <div class="col-sm-6">
                <div class="datum_title-with-border">
                    <h2>Closed Listings</h2>
                </div>
            </div>
        </div>
        <div class="slider datum_filtered_listing datum_portfolio_item datum_closed_listings-slider">
                <?php foreach ( $agentDetails->closed_property as $key => $value ) {
                    $single_property = $value;
                    ?>
                    <div class="datum_item datum_col_4">
                        <a href="<?php echo getDMProperyMainURL(); ?>">
                            <div class="datum_property_listing">
                                <div class="datum_img-box">
                                    <div class="datum_slick_carousel slider">
                                    <?php
                                    if(!empty(getDMOtherImage())){
                                        foreach (getDMOtherImage() as $img_name) {
                                        ?>

                                            <div>
                                                <div class="slide-content"> <img src="<?php echo $img_name; ?>"></div>
                                            </div>

                                        <?php
                                        }
                                    } else if(!empty(getDMPropertyMarkerListImage())) {
                                        ?>
                                        <div>
                                            <div class="slide-content">
                                                <img src="<?php echo getDMPropertyMarkerListImage(); ?>">
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div>
                                            <div class="slide-content">
                                                <img src="https://cdn.pixabay.com/photo/2016/11/29/03/53/architecture-1867187_960_720.jpg">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                    <label class="datum_star_toggle">
                                        <input type="checkbox" />
                                        <div class="datum_icon">
                                            <div class="datum_star"> </div>
                                        </div>
                                    </label>
                                    <!-- <span class="datum_property_type_label">Collab</span>  -->
                                </div>
                                <div  class="datum_project_detail">
                                    <div class="datum_project_title">
                                        <div class="datum_project_content">
                                            <h4 class="datum_inner_title"><?php echo getDMPropertyListingStatus(); ?> </h4>
                                            <p class="datum_inner_subtitle"><?php echo getDMPropertyName(); ?></p>
                                        </div>
                                        <div class="datum_project_price text-blue"> <?php echo getDMPropertyAskingPrice(); ?></div>
                                    </div>
                                    <?php
                                            $propertystatus = getDMPropertyListingStatus();
                                            if (getDMPropertyListingStatus() == 'Offers Due') {
                                                $propertystatus = getDMPropertyListingStatus() .' '.getDMPropertyStatusDate();
                                            }
                                            ?>
                                    <div class="datum_sub-detail">
                                        <div class="datum_project_type"><?php echo getDMPropertyPropertyStatus(); ?></div>
                                        <div class="datum_due_date"><?php echo $propertystatus; ?></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
        </div>
        <div class="btn-right"><a href="<?php echo home_url($dm_post->post_name); ?>" class="datum_view_allLink">View all</a></div>
    </div>
</section>
<?php } ?>
<?php
    get_footer();
?>