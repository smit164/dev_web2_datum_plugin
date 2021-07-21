<?php
/**
 * Datum advanced settings
 *
 * @package  Datum\Admin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Settings for API.
 */
if ( class_exists( 'DM_Settings_Advanced', false ) ) {
	return new DM_Settings_Advanced();
}

/**
 * DM_Settings_Advanced.
 */
class DM_Settings_Advanced  extends DM_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id    = 'advanced';
		$this->label = __( 'Advanced', 'datum' );

		parent::__construct();
		$this->notices();
	}

	/**
	 * Get sections.
	 *
	 * @return array
	 */
	public function get_sections() {
		$sections = array(
			''         => __( 'Activation key', 'datum' ),
			'page_setup'      => __( 'Page setup', 'datum' ),
			//'google_api'      => __( 'Google Settings', 'datum' ),
			//'datum_com' 	  => __( 'Master Login', 'datum' ),
		);

		return apply_filters( 'datum_get_sections_' . $this->id, $sections );
	}

	/**
	 * Get settings array.
	 *
	 * @param string $current_section Current section slug.
	 *
	 * @return array
	 */
	public function get_settings( $current_section = '' ) {
		$settings = array();

		if ( 'page_setup' === $current_section ) {
			$settings = apply_filters(
				'datum_settings_pages',
				array(

					array(
						'title' => __( 'Page setup', 'datum' ),
						'desc'  => __( 'These pages need to be set so that Datum knows where to send users to set.', 'datum' ),
						'type'  => 'title',
						'id'    => 'advanced_page_options',
					),

					array(
						'title'    => __( 'Property Listing Page', 'datum' ),
						/* Translators: %s Page contents. */
						'desc'     => __('Page contents: [property_listing]', 'datum'),
						//'desc'     => sprintf( __( 'Page contents: [%s]', 'datum' ), apply_filters( 'datum_cart_shortcode_tag', 'datum_cart' ) ),
						'id'       => 'datum_property_listing_id',
						'type'     => 'single_select_page',
						'default'  => dm_get_page_id( 'listing' ),
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'args'     => array(
							'exclude' =>
								array(
									dm_get_page_id( 'listing' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
						'desc_tip' => true,
						'autoload' => false,
						
					),
					array(
						'title'    => __( 'Property type page', 'datum' ),
						/* Translators: %s Page contents. */
						'desc'     => __('', 'datum'),
						//'desc'     => sprintf( __( 'Page contents: [%s]', 'datum' ), apply_filters( 'datum_cart_shortcode_tag', 'datum_cart' ) ),
						'id'       => 'datum_property_type_id',
						'type'     => 'single_select_page',
						'default'  => dm_get_page_id( 'proerty_type' ),
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'args'     => array(
							'exclude' =>
								array(
									dm_get_page_id( 'proerty_type' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
						'desc_tip' => true,
						'autoload' => false,
					),
					array(
						'title'    => __( 'Property closed page', 'datum' ),
						/* Translators: %s Page contents. */
						'desc'     => __('', 'datum'),
						
						'id'       => 'datum_property_closed_id',
						'type'     => 'single_select_page',
						'default'  => dm_get_page_id( 'closed' ),
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'args'     => array(
							'exclude' =>
								array(
									dm_get_page_id( 'closed' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
						'desc_tip' => true,
						'autoload' => false,
					),

					array(
						'title'    => __( 'Agent page', 'datum' ),
						/* Translators: %s Page contents. */
						'desc'     => __('', 'datum'),
						
						'id'       => 'datum_agent_id',
						'type'     => 'single_select_page',
						'default'  => dm_get_page_id( 'agent' ),
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'args'     => array(
							'exclude' =>
								array(
									dm_get_page_id( 'agent' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
						'desc_tip' => true,
						'autoload' => false,
					),

					array(
						'title'    => __( 'Forgot Password', 'datum' ),
						'desc'     => __( 'forgot password', 'datum' ),
						'id'       => 'datum_forgot_password_page_id',
						'default'  => dm_get_page_id( 'forgot_password' ),
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'type'     => 'single_select_page',
						'args'     => array(
							'exclude' =>
								array(
									dm_get_page_id( 'forgot_password' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
						'desc_tip' => true,
						'autoload' => false,
					),
					array(
						'title'    => __( 'My Listing', 'datum' ),
						'desc'     => __( 'My Listing', 'datum' ),
						'id'       => 'datum_my_listing_page_id',
						'default'  => dm_get_page_id( 'my_listing' ),
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'type'     => 'single_select_page',
						'args'     => array(
							'exclude' =>
								array(
									dm_get_page_id( 'my_listing' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
						'desc_tip' => true,
						'autoload' => false,
					),
                    array(
                        'title'    => __( 'My Favorite Listing', 'datum' ),
                        'desc'     => __( 'My Favorite Listing', 'datum' ),
                        'id'       => 'datum_my_favorite_listing_page_id',
                        'default'  => dm_get_page_id( 'my_favorite' ),
                        'class'    => 'dm-enhanced-select-nostd',
                        'css'      => 'min-width:300px;',
                        'type'     => 'single_select_page',
                        'args'     => array(
							'exclude' =>
								array(
									dm_get_page_id( 'my_favorite' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
                        'desc_tip' => true,
                        'autoload' => false,
                    ),
					array(
						'title'    => __( 'Terms and conditions', 'datum' ),
						'desc'     => __( 'If you define a "Terms" page the customer will be asked if they accept them when checking out.', 'datum' ),
						'id'       => 'datum_terms_page_id',
						'default'  => dm_get_page_id( 'terms_and_conditions' ),
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'type'     => 'single_select_page',
						'args'     => array(
							'exclude' =>
								array(
									dm_get_page_id( 'terms_and_conditions' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
						'desc_tip' => true,
						'autoload' => false,
					),

					

					array(
						'type' => 'sectionend',
						'id'   => 'account_endpoint_options',
					),
				)
			);
		}else if( '' == $current_section){
			$settings = apply_filters(
				'datum_api_settings_pages',
				array(

					array(
						'title' => '',
						'desc'  => __( '', 'datum' ),
						'type'  => 'title',
						'id'    => 'advanced_key_page_options',
					),

					array(
						'title'    => __( 'API Activation Key', 'datum' ),
						'desc'     => '',
						'id'       => 'datum_api_key_id',
						'type'     => 'text',
						'default'  => '',
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'args'     => array(
							'exclude' =>
								array(
								),
						),
						'desc_tip' => true,
						'autoload' => false,
						'disable' => false,
					),
					array(
						'type' => 'sectionend',
						'id'   => 'account_endpoint_options',
					),
				)
			);
		}else if( 'google_api' == $current_section){
			$settings = apply_filters(
				'datum_google_settings_pages',
				array(

					array(
						'title' => __( 'Google Settings', 'datum' ),
						'desc'  => __( '', 'datum' ),
						'type'  => 'title',
						'id'    => 'advanced_key_page_options',
					),

					/*array(
						'title'    => __( 'Google Api Map key', 'datum' ),
						
						'desc'     => '',
						
						'id'       => 'datum_google_api_key_id',
						'type'     => 'text',
						'default'  => '',
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'args'     => array(
							'exclude' =>
								array(
								
								),
						),
						'desc_tip' => true,
						'autoload' => false,
					),*/
					
					array(
						'title'    => __( 'Map Zoom Number', 'datum' ),
						/* Translators: %s Page contents. */
						'desc'     => '',
						//'desc'     => sprintf( __( 'Page contents: [%s]', 'datum' ), apply_filters( 'datum_cart_shortcode_tag', 'datum_cart' ) ),
						'id'       => 'google_zoom_map',
						'type'     => 'text',
						'default'  => '',
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'args'     => array(
							'exclude' =>
								array(
									//dm_get_page_id( 'checkout' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
						'desc_tip' => true,
						'autoload' => false,
					),
					array(
						'title'    => __( 'Map Center Latitude', 'datum' ),
						/* Translators: %s Page contents. */
						'desc'     => '',
						//'desc'     => sprintf( __( 'Page contents: [%s]', 'datum' ), apply_filters( 'datum_cart_shortcode_tag', 'datum_cart' ) ),
						'id'       => 'google_zoom_latitude',
						'type'     => 'text',
						'default'  => '',
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'args'     => array(
							'exclude' =>
								array(
									//dm_get_page_id( 'checkout' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
						'desc_tip' => true,
						'autoload' => false,
					),
					array(
						'title'    => __( 'Map Center Longitude', 'datum' ),
						/* Translators: %s Page contents. */
						'desc'     => '',
						//'desc'     => sprintf( __( 'Page contents: [%s]', 'datum' ), apply_filters( 'datum_cart_shortcode_tag', 'datum_cart' ) ),
						'id'       => 'google_zoom_longitude',
						'type'     => 'text',
						'default'  => '',
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'args'     => array(
							'exclude' =>
								array(
									//dm_get_page_id( 'checkout' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
						'desc_tip' => true,
						'autoload' => false,
					),
					array(
						'title'    => __( 'Google Recaptcha Key', 'datum' ),
						/* Translators: %s Page contents. */
						'desc'     => '',
						//'desc'     => sprintf( __( 'Page contents: [%s]', 'datum' ), apply_filters( 'datum_cart_shortcode_tag', 'datum_cart' ) ),
						'id'       => 'google_recaptcha_key',
						'type'     => 'text',
						'default'  => '',
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'args'     => array(
							'exclude' =>
								array(
									//dm_get_page_id( 'checkout' ),
									//dm_get_page_id( 'myaccount' ),
								),
						),
						'desc_tip' => true,
						'autoload' => false,
					),
					array(
						'type' => 'sectionend',	
						'id'   => 'account_endpoint_options',
					),
				)
			);
		}

		return apply_filters( 'datum_get_settings_' . $this->id, $settings, $current_section );
	}

	/**
	 * Form method.
	 *
	 * @deprecated 3.4.4
	 *
	 * @param  string $method Method name.
	 *
	 * @return string
	 */
	public function form_method( $method ) {
		return 'post';
	}

	/**
	 * Notices.
	 */
	private function notices() {
		if ( isset( $_GET['section'] ) && 'webhooks' === $_GET['section'] ) { // WPCS: input var okay, CSRF ok.
			DM_Admin_Webhooks::notices();
		}
	}

	/**
	 * Output the settings.
	 */
	public function output() {
		global $current_section;

		$settings = $this->get_settings( $current_section );
		DM_Admin_Settings::output_fields( $settings );
	}

	/**
	 * Save settings.
	 */
	public function save() {
		global $current_section,$ot_message;
		$settings = $this->get_settings( $current_section );

		if(isset($_POST['datum_api_key_id'])){
			$result = DM_Curl::HTTPPost(array('activation_key' => $_POST['datum_api_key_id']),'active_plugin',true);
			if(!empty($result)){
				$output = json_decode($result);
				if($output->status == 'success'){
					if ( $current_section ) {
						do_action( 'datum_update_options_' . $this->id . '_' . $current_section );
					}
					$ot_message = $output->message;
					DM_Admin_Settings::save_fields( $settings );
				}else{
					$ot_message = $output->message;
				}
			}else{
				$ot_message = 'Some things went wrong!';
			}
		}else{		
			if ( apply_filters( 'datum_rest_api_valid_to_save', ! in_array( $current_section, array( 'dm_keys', 'webhooks' ), true ) ) ) {


				// Prevent the T&Cs and checkout page from being set to the same page.
				if ( isset( $_POST['datum_terms_page_id'], $_POST['datum_checkout_page_id'] ) && $_POST['datum_terms_page_id'] === $_POST['datum_checkout_page_id'] ) { // WPCS: input var ok, CSRF ok.
					$_POST['datum_terms_page_id'] = '';
				}

				// Prevent the Cart, checkout and my account page from being set to the same page.
				if ( isset( $_POST['datum_cart_page_id'], $_POST['datum_checkout_page_id'], $_POST['datum_myaccount_page_id'] ) ) { // WPCS: input var ok, CSRF ok.
					if ( $_POST['datum_cart_page_id'] === $_POST['datum_checkout_page_id'] ) { // WPCS: input var ok, CSRF ok.
						$_POST['datum_checkout_page_id'] = '';
					}
					if ( $_POST['datum_cart_page_id'] === $_POST['datum_myaccount_page_id'] ) { // WPCS: input var ok, CSRF ok.
						$_POST['datum_myaccount_page_id'] = '';
					}
					if ( $_POST['datum_checkout_page_id'] === $_POST['datum_myaccount_page_id'] ) { // WPCS: input var ok, CSRF ok.
						$_POST['datum_myaccount_page_id'] = '';
					}
				}

				DM_Admin_Settings::save_fields( $settings );

				if ( $current_section ) {
					do_action( 'datum_update_options_' . $this->id . '_' . $current_section );
				}
			}
		}
	}
}

/**
 * DM_Settings_Rest_API class.
 *
 * @deprecated 3.4 in favour of DM_Settings_Advanced.
 * @todo remove in 4.0.
 */
class DM_Settings_Rest_API extends DM_Settings_Advanced {
} // @codingStandardsIgnoreLine.

return new DM_Settings_Advanced();
