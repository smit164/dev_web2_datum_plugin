<?php
/**
 * Admin View: Settings
 *
 * @package WooCommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$tab_exists        = isset( $tabs[ $current_tab ] ) || has_action( 'datum_sections_' . $current_tab ) || has_action( 'datum_settings_' . $current_tab ) || has_action( 'datum_settings_tabs_' . $current_tab );
$current_tab_label = isset( $tabs[ $current_tab ] ) ? $tabs[ $current_tab ] : '';

if ( ! $tab_exists ) {
    wp_safe_redirect( admin_url( 'admin.php?page=wc-settings' ) );
    exit;
}
?>
<div class="wrap datum">
    <?php do_action( 'datum_before_settings_' . $current_tab ); ?>
    <form method="<?php echo esc_attr( apply_filters( 'datum_settings_form_method_tab_' . $current_tab, 'post' ) ); ?>" id="mainform" action="" enctype="multipart/form-data">
        <nav class="nav-tab-wrapper woo-nav-tab-wrapper">
            <?php

            foreach ( $tabs as $slug => $label ) {
                echo '<a href="' . esc_html( admin_url( 'admin.php?page=dm-settings&tab=' . esc_attr( $slug ) ) ) . '" class="nav-tab ' . ( $current_tab === $slug ? 'nav-tab-active' : '' ) . '">' . esc_html( $label ) . '</a>';
            }

            do_action( 'datum_settings_tabs' );

            ?>
        </nav>
        <h1 class="screen-reader-text"><?php echo esc_html( $current_tab_label ); ?></h1>
        <?php
            do_action( 'datum_sections_' . $current_tab );

            self::show_messages();

            do_action( 'datum_settings_' . $current_tab );
            do_action( 'datum_settings_tabs_' . $current_tab ); // @deprecated 3.4.0 hook.
        ?>
        <p class="submit">
            <?php if ( empty( $GLOBALS['hide_save_button'] ) ) : ?>
                <button name="save" class="button-primary datum-save-button" type="submit" value="<?php esc_attr_e( 'Save changes', 'datum' ); ?>"><?php esc_html_e( 'Save Changes', 'datum' ); ?></button>
            <?php endif; ?>
            <?php wp_nonce_field( 'datum-settings' ); ?>
        </p>
    </form>
    <?php do_action( 'datum_after_settings_' . $current_tab ); ?>
</div>
