<?php
/**
 * datum Template Hooks
 *
 * Action/filter hooks used for datum functions/templates.
 *
 * @package datum/Templates
 * @version 2.1.0
 */
defined( 'ABSPATH' ) || exit;

//add_filter( 'body_class', 'dm_body_class' );
//add_filter( 'post_class', 'dm_product_post_class', 20, 3 );


add_action( 'datum_post_setting','datum_add_post_setting', 10 );


/**
 * Content Wrappers.
 *
 * @see datum_output_content_wrapper()
 * @see datum_output_content_wrapper_end()
 */
add_action( 'datum_before_main_content', 'datum_output_content_wrapper', 10 );
add_action( 'datum_after_main_content', 'datum_output_content_wrapper_end', 10 );

/**
 * Breadcrumbs.
 *
 * @see datum_breadcrumb()
 */
//add_action( 'datum_before_main_content', 'datum_breadcrumb', 20, 0 );


/**
 * Loop.
 *
 * @see datum_breadcrumb()
 */

add_action( 'datum_loop_start','datum_property_loop_start', 10 );
add_action( 'datum_loop_end','datum_property_loop_end', 10 );

add_action( 'datum_loop_title','datum_property_title', 10 );
add_action( 'datum_loop_price','datum_property_price', 10 );
add_action( 'datum_loop_style','datum_property_style', 10 );
add_action( 'datum_loop_due_date','datum_property_due_date', 10 );

add_action( 'datum_loop_image','datum_property_image', 10 );

add_action( 'datum_loop_link','datum_property_link', 10 );


add_action( 'datum_admin_setting_tab','datum_setting_tab', 10 );


/**
*
*
* @see 
*/
add_action('datum_single_main_content','datum_single_content',10);

add_action('datum_single_main_mainbox','datum_single_details_mainbox',10);

add_action('datum_single_offering_summary','datum_single_offering',10);

add_action('datum_single_gallery_slider','datum_single_gallery_slider',10);

add_action('datum_single_deal_team','datum_deal_team',10);

add_action('datum_property_type','datum_property_type_data',10);

add_action('datum_property_details','datum_property_details_data',10);
//login
add_action('datum_sign','login_sign_up',10,1);

add_action('datum_update','login_update_up',10,1);

/**
 * Confidential agrement preview and attach run time page
 */
add_action('previw_ca_action','previw_ca',10,2);

/**
 * NDA_download action
 */

add_action('NDA_download_action','NDA_download',10);


add_action('datum_social_share','datum_social_share_action',10);


/** Comman */

add_action('datum_banner_section','datum_banner_section',10);
add_action('datum_property_single_image','datum_property_single_image',10);
add_action('datum_property_single_title','datum_property_single_title',10);