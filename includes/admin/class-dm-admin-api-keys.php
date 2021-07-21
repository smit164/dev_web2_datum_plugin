<?php
defined( 'ABSPATH' ) || exit;

/**
 * DM_Admin_API_Keys.
 */
class DM_Admin_API_Keys {

	/**
	 * Initialize the API Keys admin actions.
	 */
	public function __construct() {
		
		add_action( 'admin_init', array( $this, 'actions' ) );
		add_action( 'datum_settings_page_init', array( $this, 'screen_option' ) );
		add_filter( 'datum_save_settings_advanced_keys', array( $this, 'allow_save_settings' ) );
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
						'id'    => 'advanced_page_options',
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
	 * Check if should allow save settings.
	 * This prevents "Your settings have been saved." notices on the table list.
	 *
	 * @param  bool $allow If allow save settings.
	 * @return bool
	 */
	public function allow_save_settings( $allow ) {
		if ( ! isset( $_GET['create-key'], $_GET['edit-key'] ) ) { // WPCS: input var okay, CSRF ok.
			return false;
		}

		return $allow;
	}

	/**
	 * Check if is API Keys settings page.
	 *
	 * @return bool
	 */
	private function is_api_keys_settings_page() {
		return isset( $_GET['page'], $_GET['tab'], $_GET['section'] ) && 'dm-settings' === $_GET['page'] && 'advanced' === $_GET['tab'] && 'dm_keys' === $_GET['section']; // WPCS: input var okay, CSRF ok.
	}

	/**
	 * Page output.
	 */
	public static function page_output() {
		// Hide the save button.
		$GLOBALS['hide_save_button'] = true;

		if ( isset( $_GET['create-key'] ) || isset( $_GET['edit-key'] ) ) {
			$key_id   = isset( $_GET['edit-key'] ) ? absint( $_GET['edit-key'] ) : 0; // WPCS: input var okay, CSRF ok.
			$key_data = self::get_key_data( $key_id );
			$user_id  = (int) $key_data['user_id'];

			if ( $key_id && $user_id && ! current_user_can( 'edit_user', $user_id ) ) {
				if ( get_current_user_id() !== $user_id ) {
					wp_die( esc_html__( 'You do not have permission to edit this API Key', 'datum' ) );
				}
			}

			include dirname( __FILE__ ) . '/settings/views/html-keys-edit.php';
		} else {
			self::table_list_output();
		}
	}

	/**
	 * Add screen option.
	 */
	public function screen_option() {
		global $keys_table_list;

		if ( ! isset( $_GET['create-key'] ) && ! isset( $_GET['edit-key'] ) && $this->is_api_keys_settings_page() ) { // WPCS: input var okay, CSRF ok.
			$keys_table_list = new DM_Admin_API_Keys_Table_List();

			// Add screen option.
			add_screen_option(
				'per_page',
				array(
					'default' => 10,
					'option'  => 'datum_keys_per_page',
				)
			);
		}
	}

	/**
	 * Table list output.
	 */
	private static function table_list_output() {
		global $wpdb, $keys_table_list;

		echo '<h2 class="dm-table-list-header">' . esc_html__( 'REST API', 'datum' ) . ' <a href="' . esc_url( admin_url( 'admin.php?page=dm-settings&tab=advanced&section=keys&create-key=1' ) ) . '" class="add-new-h2">' . esc_html__( 'Add key', 'datum' ) . '</a></h2>';

		// Get the API keys count.
		$count = $wpdb->get_var( "SELECT COUNT(key_id) FROM {$wpdb->prefix}datum_api_keys WHERE 1 = 1;" );

		if ( absint( $count ) && $count > 0 ) {
			$keys_table_list->prepare_items();

			echo '<input type="hidden" name="page" value="dm-settings" />';
			echo '<input type="hidden" name="tab" value="advanced" />';
			echo '<input type="hidden" name="section" value="keys" />';

			$keys_table_list->views();
			$keys_table_list->search_box( __( 'Search key', 'datum' ), 'key' );
			$keys_table_list->display();
		} else {
			echo '<div class="datum-BlankState datum-BlankState--api">';
			?>
			<h2 class="datum-BlankState-message"><?php esc_html_e( 'The WooCommerce REST API allows external apps to view and manage store data. Access is granted only to those with valid API keys.', 'datum' ); ?></h2>
			<a class="datum-BlankState-cta button-primary button" href="<?php echo esc_url( admin_url( 'admin.php?page=dm-settings&tab=advanced&section=keys&create-key=1' ) ); ?>"><?php esc_html_e( 'Create an API key', 'datum' ); ?></a>
			<style type="text/css">#posts-filter .wp-list-table, #posts-filter .tablenav.top, .tablenav.bottom .actions { display: none; }</style>
			<?php
		}
	}

	/**
	 * Get key data.
	 *
	 * @param  int $key_id API Key ID.
	 * @return array
	 */
	private static function get_key_data( $key_id ) {
		global $wpdb;

		$empty = array(
			'key_id'        => 0,
			'user_id'       => '',
			'description'   => '',
			'permissions'   => '',
			'truncated_key' => '',
			'last_access'   => '',
		);

		if ( 0 === $key_id ) {
			return $empty;
		}

		$key = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT key_id, user_id, description, permissions, truncated_key, last_access
				FROM {$wpdb->prefix}datum_api_keys
				WHERE key_id = %d",
				$key_id
			),
			ARRAY_A
		);

		if ( is_null( $key ) ) {
			return $empty;
		}

		return $key;
	}

	/**
	 * API Keys admin actions.
	 */
	public function actions() {
		if ( $this->is_api_keys_settings_page() ) {
			// Revoke key.
			if ( isset( $_REQUEST['revoke-key'] ) ) { // WPCS: input var okay, CSRF ok.
				$this->revoke_key();
			}

			// Bulk actions.
			if ( isset( $_REQUEST['action'] ) && isset( $_REQUEST['key'] ) ) { // WPCS: input var okay, CSRF ok.
				$this->bulk_actions();
			}
		}
	}

	/**
	 * Notices.
	 */
	public static function notices() {
		echo 's';
		die;

		if ( isset( $_GET['revoked'] ) ) { // WPCS: input var okay, CSRF ok.
			$revoked = absint( $_GET['revoked'] ); // WPCS: input var okay, CSRF ok.

			/* translators: %d: count */
			DM_Admin_Settings::add_message( sprintf( _n( '%d API key permanently revoked.', '%d API keys permanently revoked.', $revoked, 'datum' ), $revoked ) );
		}
	}

	/**
	 * Revoke key.
	 */
	private function revoke_key() {
		global $wpdb;

		check_admin_referer( 'revoke' );

		if ( isset( $_REQUEST['revoke-key'] ) ) { // WPCS: input var okay, CSRF ok.
			$key_id  = absint( $_REQUEST['revoke-key'] ); // WPCS: input var okay, CSRF ok.
			$user_id = (int) $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM {$wpdb->prefix}datum_api_keys WHERE key_id = %d", $key_id ) );

			if ( $key_id && $user_id && ( current_user_can( 'edit_user', $user_id ) || get_current_user_id() === $user_id ) ) {
				$this->remove_key( $key_id );
			} else {
				wp_die( esc_html__( 'You do not have permission to revoke this API Key', 'datum' ) );
			}
		}

		wp_safe_redirect( esc_url_raw( add_query_arg( array( 'revoked' => 1 ), admin_url( 'admin.php?page=dm-settings&tab=advanced&section=keys' ) ) ) );
		exit();
	}

	/**
	 * Bulk actions.
	 */
	private function bulk_actions() {
		check_admin_referer( 'datum-settings' );

		if ( ! current_user_can( 'manage_datum' ) ) {
			wp_die( esc_html__( 'You do not have permission to edit API Keys', 'datum' ) );
		}

		if ( isset( $_REQUEST['action'] ) ) { // WPCS: input var okay, CSRF ok.
			$action = sanitize_text_field( wp_unslash( $_REQUEST['action'] ) ); // WPCS: input var okay, CSRF ok.
			$keys   = isset( $_REQUEST['key'] ) ? array_map( 'absint', (array) $_REQUEST['key'] ) : array(); // WPCS: input var okay, CSRF ok.

			if ( 'revoke' === $action ) {
				$this->bulk_revoke_key( $keys );
			}
		}
	}

	/**
	 * Bulk revoke key.
	 *
	 * @param array $keys API Keys.
	 */
	private function bulk_revoke_key( $keys ) {
		if ( ! current_user_can( 'remove_users' ) ) {
			wp_die( esc_html__( 'You do not have permission to revoke API Keys', 'datum' ) );
		}

		$qty = 0;
		foreach ( $keys as $key_id ) {
			$result = $this->remove_key( $key_id );

			if ( $result ) {
				$qty++;
			}
		}

		// Redirect to webhooks page.
		wp_safe_redirect( esc_url_raw( add_query_arg( array( 'revoked' => $qty ), admin_url( 'admin.php?page=dm-settings&tab=advanced&section=keys' ) ) ) );
		exit();
	}

	/**
	 * Remove key.
	 *
	 * @param  int $key_id API Key ID.
	 * @return bool
	 */
	private function remove_key( $key_id ) {
		global $wpdb;

		$delete = $wpdb->delete( $wpdb->prefix . 'datum_api_keys', array( 'key_id' => $key_id ), array( '%d' ) );

		return $delete;
	}
}
new DM_Admin_API_Keys();