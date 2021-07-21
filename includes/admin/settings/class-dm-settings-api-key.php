<?php
/**
 * Datum api settings
 *
 * @package  Datum\Admin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Settings for API.
 */
if ( class_exists( 'DM_Settings_Api', false ) ) {
	return new DM_Settings_Api();
}

/**
 * DM_Settings_Api.
 */
class DM_Settings_Api  extends DM_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {
		//$this->notices();
	}

	/**
	 * Get sections.
	 *
	 * @return array
	 */
	public function get_sections() {
		$sections = array(
			''                => __( 'Page setup', 'datum' ),
			'dm_keys'         => __( 'REST API', 'datum' ),
			'datum_com' 	  => __( 'Master Login', 'datum' ),
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

		if ( '' === $current_section ) {
			$settings = apply_filters(
				'datum_settings_pages',
				array(

					array(
						'title' => __( 'Page setup', 'datum' ),
						'desc'  => __( 'These pages need to be set so that Datum knows where to send users to set.', 'datum' ),
						'type'  => 'title',
						'id'    => 'api_page_options',
					),

					array(
						'title'    => __( 'Property Listing Page', 'datum' ),
						/* Translators: %s Page contents. */
						'desc'     => __('Page contents: [property_listing]', 'datum'),
						//'desc'     => sprintf( __( 'Page contents: [%s]', 'datum' ), apply_filters( 'datum_cart_shortcode_tag', 'datum_cart' ) ),
						'id'       => 'datum_property_listing_id',
						'type'     => 'single_select_page',
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
						'title'    => __( 'Terms and conditions', 'datum' ),
						'desc'     => __( 'If you define a "Terms" page the customer will be asked if they accept them when checking out.', 'datum' ),
						'id'       => 'datum_terms_page_id',
						'default'  => '',
						'class'    => 'dm-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'type'     => 'single_select_page',
						'args'     => array( 'exclude' => '' ),
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
		global $current_section;

		if ( apply_filters( 'datum_rest_api_valid_to_save', ! in_array( $current_section, array( 'dm_keys', 'webhooks' ), true ) ) ) {
			$settings = $this->get_settings( $current_section );

			
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

/**
 * DM_Settings_Rest_API class.
 *
 * @deprecated 3.4 in favour of DM_Settings_Api.
 * @todo remove in 4.0.
 */
class DM_Settings_Rest_API extends DM_Settings_Api {
} // @codingStandardsIgnoreLine.

return new DM_Settings_Api();
