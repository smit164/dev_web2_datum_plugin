<?php
/**
 * WooCommerce General Settings
 *
 * @package WooCommerce\Admin
 */

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'DM_Settings_General', false ) ) {
	return new DM_Settings_General();
}

/**
 * DM_Admin_Settings_General.
 */
class DM_Settings_General extends DM_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id    = 'general';
		$this->label = __( 'General', 'datum' );

		parent::__construct();
	}

	/**
	 * Get settings array.
	 *
	 * @return array
	 */
	public function get_settings() {

		/*$currency_code_options = get_datum_currencies();

		foreach ( $currency_code_options as $code => $name ) {
			$currency_code_options[ $code ] = $name . ' (' . get_datum_currency_symbol( $code ) . ')';
		}*/
		$GLOBALS['hide_save_button'] = true;
		$settings = apply_filters(
			'datum_general_settings',
			array(

				array(
					'title' => __( 'Store General Details', 'datum' ),
					'type'  => 'title',
					'desc'  => __( '', 'datum' ),
					'id'    => 'store_address',
				),

				array(
					'type' => 'sectionend',
					'id'   => 'pricing_options',
				),

			)
		);

		return apply_filters( 'datum_get_settings_' . $this->id, $settings );
	}

	/**
	 * Output a color picker input box.
	 *
	 * @param mixed  $name Name of input.
	 * @param string $id ID of input.
	 * @param mixed  $value Value of input.
	 * @param string $desc (default: '') Description for input.
	 */
	public function color_picker( $name, $id, $value, $desc = '' ) {
		echo '<div class="color_box">' . dm_help_tip( $desc ) . '
			<input name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '" type="text" value="' . esc_attr( $value ) . '" class="colorpick" /> <div id="colorPickerDiv_' . esc_attr( $id ) . '" class="colorpickdiv"></div>
		</div>';
	}

	/**
	 * Output the settings.
	 */
	public function output() {
		$settings = $this->get_settings();

		DM_Admin_Settings::output_fields( $settings );
	}

	/**
	 * Save settings.
	 */
	public function save() {
		$settings = $this->get_settings();

		DM_Admin_Settings::save_fields( $settings );
	}
}

return new DM_Settings_General();
