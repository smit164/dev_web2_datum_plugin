<?php
defined( 'ABSPATH' ) || exit;

if ( class_exists( 'DM_Admin_Menus', false ) ) {
	return new DM_Admin_Menus();
}

/**
 * DM_Admin_Menus Class.
 */
class DM_Admin_Menus {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		// Add menus.

		add_action( 'admin_menu', array( $this, 'admin_menu' ), 50 );
		add_action( 'admin_menu', array( $this, 'settings_menu' ), 50 );
		add_action( 'admin_menu', array( $this, 'status_menu' ), 60 );

		if ( apply_filters( 'datum_show_addons_page', true ) ) {
			add_action( 'admin_menu', array( $this, 'addons_menu' ), 70 );
		}
/*
		add_action( 'admin_head', array( $this, 'menu_highlight' ) );
		add_action( 'admin_head', array( $this, 'menu_order_count' ) );
		add_filter( 'menu_order', array( $this, 'menu_order' ) );
		add_filter( 'custom_menu_order', array( $this, 'custom_menu_order' ) );
		add_filter( 'set-screen-option', array( $this, 'set_screen_option' ), 10, 3 );*/
		add_action( 'admin_head-nav-menus.php', array( $this, 'add_nav_menu_meta_boxes' ) );
		// Add endpoints custom URLs in Appearance > Menus > Pages.
		/*add_action( 'admin_head-nav-menus.php', array( $this, 'add_nav_menu_meta_boxes' ) );

		// Admin bar menus.
		if ( apply_filters( 'datum_show_admin_bar_visit_store', true ) ) {
			add_action( 'admin_bar_menu', array( $this, 'admin_bar_menus' ), 31 );
		}*/

		// Handle saving settings earlier than load-{page} hook to avoid race conditions in conditional menus.
		add_action( 'wp_loaded', array( $this, 'save_settings' ) );
	}

	/**
	 * Add menu items.
	 */
	public function admin_menu() {
		global $menu;
		add_menu_page( __( 'Datum', 'datum' ), __( 'Datum', 'datum' ), 'edit_pages', 'datum_menu', array( $this, 'datum_menu' ), null, '55.5' );

	}

	public function datum_menu(){
		echo "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
	}

	/**
	 * Add menu item.
	 */
	public function settings_menu() {
		$settings_page = add_submenu_page( 'datum_menu', __( 'Datum settings', 'datum' ), __( 'Settings', 'datum' ), 'edit_pages', 'dm-settings', array( $this, 'settings_page' ) );

		add_action( 'load-' . $settings_page, array( $this, 'settings_page_init' ) );
	}

	/**
	 * Loads gateways and shipping methods into memory for use within settings.
	 */
	public function settings_page_init() {


		// Include settings pages.
		DM_Admin_Settings::get_settings_pages();

		// Add any posted messages.
		if ( ! empty( $_GET['dm_error'] ) ) { // WPCS: input var okay, CSRF ok.
			DM_Admin_Settings::add_error( wp_kses_post( wp_unslash( $_GET['dm_error'] ) ) ); // WPCS: input var okay, CSRF ok.
		}

		if ( ! empty( $_GET['dm_message'] ) ) { // WPCS: input var okay, CSRF ok.
			DM_Admin_Settings::add_message( wp_kses_post( wp_unslash( $_GET['dm_message'] ) ) ); // WPCS: input var okay, CSRF ok.
		}

		do_action( 'datum_settings_page_init' );
	}

	/**
	 * Handle saving of settings.
	 *
	 * @return void
	 */
	public function save_settings() {
		global $current_tab, $current_section;

		// We should only save on the settings page.
		if ( ! is_admin() || ! isset( $_GET['page'] ) || 'dm-settings' !== $_GET['page'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return;
		}

		// Include settings pages.
		DM_Admin_Settings::get_settings_pages();

		// Get current tab/section.
		$current_tab     = empty( $_GET['tab'] ) ? 'general' : sanitize_title( wp_unslash( $_GET['tab'] ) ); // WPCS: input var okay, CSRF ok.
		$current_section = empty( $_REQUEST['section'] ) ? '' : sanitize_title( wp_unslash( $_REQUEST['section'] ) ); // WPCS: input var okay, CSRF ok.

		// Save settings if data has been posted.
		if ( '' !== $current_section && apply_filters( "datum_save_settings_{$current_tab}_{$current_section}", ! empty( $_POST['save'] ) ) ) { // WPCS: input var okay, CSRF ok.
			DM_Admin_Settings::save();
		} elseif ( '' === $current_section && apply_filters( "datum_save_settings_{$current_tab}", ! empty( $_POST['save'] ) ) ) { // WPCS: input var okay, CSRF ok.
			DM_Admin_Settings::save();
		}
	}

	/**
	 * Add menu item.
	 */
	public function status_menu() {
		add_submenu_page( 'datum', __( 'WooCommerce status', 'datum' ), __( 'Status', 'datum' ), 'manage_datum', 'dm-status', array( $this, 'status_page' ) );
	}

	/**
	 * Addons menu item.
	 */
	public function addons_menu() {
		
	}

	/**
	 * Highlights the correct top level admin menu item for post type add screens.
	 */
	public function menu_highlight() {
		global $parent_file, $submenu_file, $post_type;

		switch ( $post_type ) {
			case 'shop_order':
			case 'shop_coupon':
				$parent_file = 'datum'; // WPCS: override ok.
				break;
			case 'product':
				$screen = get_current_screen();
				if ( $screen && taxonomy_is_product_attribute( $screen->taxonomy ) ) {
					$submenu_file = 'product_attributes'; // WPCS: override ok.
					$parent_file  = 'edit.php?post_type=product'; // WPCS: override ok.
				}
				break;
		}
	}

	/**
	 * Adds the order processing count to the menu.
	 */
	public function menu_order_count() {
		global $submenu;
	}

	/**
	 * Reorder the DM menu items in admin.
	 *
	 * @param int $menu_order Menu order.
	 * @return array
	 */
	public function menu_order( $menu_order ) {
		// Initialize our custom order array.
		$datum_menu_order = array();

		// Get the index of our custom separator.
		$datum_separator = array_search( 'separator-datum', $menu_order, true );

		// Get index of product menu.
		$datum_product = array_search( 'edit.php?post_type=product', $menu_order, true );

		// Loop through menu order and do some rearranging.
		foreach ( $menu_order as $index => $item ) {

			if ( 'datum' === $item ) {
				$datum_menu_order[] = 'separator-datum';
				$datum_menu_order[] = $item;
				$datum_menu_order[] = 'edit.php?post_type=product';
				unset( $menu_order[ $datum_separator ] );
				unset( $menu_order[ $datum_product ] );
			} elseif ( ! in_array( $item, array( 'separator-datum' ), true ) ) {
				$datum_menu_order[] = $item;
			}
		}

		// Return order.
		return $datum_menu_order;
	}

	/**
	 * Custom menu order.
	 *
	 * @param bool $enabled Whether custom menu ordering is already enabled.
	 * @return bool
	 */
	public function custom_menu_order( $enabled ) {
		return $enabled || current_user_can( 'edit_others_shop_orders' );
	}

	/**
	 * Validate screen options on update.
	 *
	 * @param bool|int $status Screen option value. Default false to skip.
	 * @param string   $option The option name.
	 * @param int      $value  The number of rows to use.
	 */
	public function set_screen_option( $status, $option, $value ) {
		if ( in_array( $option, array( 'datum_keys_per_page', 'datum_webhooks_per_page' ), true ) ) {
			return $value;
		}

		return $status;
	}

	/**
	 * Init the reports page.
	 */
	public function reports_page() {
		DM_Admin_Reports::output();
	}

	/**
	 * Init the settings page.
	 */
	public function settings_page() {
		DM_Admin_Settings::output();
	}

	/**
	 * Init the attributes page.
	 */
	public function attributes_page() {
		DM_Admin_Attributes::output();
	}

	/**
	 * Init the status page.
	 */
	public function status_page() {
		DM_Admin_Status::output();
	}

	/**
	 * Init the addons page.
	 */
	public function addons_page() {
		DM_Admin_Addons::output();
	}

	/**
	 * Add custom nav meta box.
	 *
	 * Adapted from http://www.johnmorrisonline.com/how-to-add-a-fully-functional-custom-meta-box-to-wordpress-navigation-menus/.
	 */
	public function add_nav_menu_meta_boxes() {
		add_meta_box( 'datum_endpoints_nav_link', __( 'Datum Menu', 'datum' ), array( $this, 'nav_menu_links' ), 'nav-menus', 'side', 'low' );
	}

	/**
	 * Output menu links.
	 */
	public function nav_menu_links() {
		// Get items from account menu.

		$endpoints = array('Login','Register');
		?>
		<div id="posttype-datum-endpoints" class="posttypediv">
			<div id="tabs-panel-datum-endpoints" class="tabs-panel tabs-panel-active">
				<ul id="datum-endpoints-checklist" class="categorychecklist form-no-clear">
					<?php
					$i = 1;
					foreach ( $endpoints as $key => $value ) :
						?>
						<li>
							<label class="menu-item-title">
								<input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-object-id]" value="<?php echo esc_attr( $i ); ?>" /> <?php echo esc_html( $value ); ?>
							</label>
							<input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-type]" value="custom" />
							<input type="hidden" class="menu-item-title" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-title]" value="<?php echo esc_attr( $value ); ?>" />
							<input type="hidden" class="menu-item-url" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-url]" value="" />
							<input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-classes]"  value="datum_modal_toggle datum_model_open" />
							<input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-attr-title]"  value="login_html" />
						</li>
						<?php
						$i++;
					endforeach;
					?>
				</ul>
			</div>
			<p class="button-controls">
				<span class="list-controls">
					<a href="<?php echo esc_url( admin_url( 'nav-menus.php?page-tab=all&selectall=1#posttype-datum-endpoints' ) ); ?>" class="select-all"><?php esc_html_e( 'Select all', 'datum' ); ?></a>
				</span>
				<span class="add-to-menu">
					<button type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to menu', 'datum' ); ?>" name="add-post-type-menu-item" id="submit-posttype-datum-endpoints"><?php esc_html_e( 'Add to menu', 'datum' ); ?></button>
					<span class="spinner"></span>
				</span>
			</p>
		</div>
		<?php
	}

	/**
	 * Add the "Visit Store" link in admin bar main menu.
	 *
	 * @since 2.4.0
	 * @param WP_Admin_Bar $wp_admin_bar Admin bar instance.
	 */
	public function admin_bar_menus( $wp_admin_bar ) {
		if ( ! is_admin() || ! is_admin_bar_showing() ) {
			return;
		}

		// Show only when the user is a member of this site, or they're a super admin.
		if ( ! is_user_member_of_blog() && ! is_super_admin() ) {
			return;
		}

		// Don't display when shop page is the same of the page on front.
/*		if ( intval( get_option( 'page_on_front' ) ) === dm_get_page_id( 'shop' ) ) {
			return;
		}*/

		// Add an option to visit the store.
/*		$wp_admin_bar->add_node(
			array(
				'parent' => 'site-name',
				'id'     => 'view-store',
				'title'  => __( 'Visit Store', 'datum' ),
				'href'   => dm_get_page_permalink( 'shop' ),
			)
		);*/
	}
}

return new DM_Admin_Menus();
