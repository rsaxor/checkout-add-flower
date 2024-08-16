<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Checkout Add Flower - Edirect
 * Description:       Implements an option to add flower in the checkout page
 * Version:           1.0.0
 * Author:            Ralph Roxas
 * Author URI:        https://www.linkedin.com/in/ralphroxas/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       edir-checkout-flower
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'EDIR_FLOWER_PLUGIN_VERSION', '1.0.0' );

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . '/wp-admin/includes/plugin.php');
}

/**
* Check for the existence of WooCommerce and any other requirements
*/
function edir_plugin_check_requirements() {
    // if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
    if ( is_plugin_active( 'woocommerce/woocommerce.php' ) && is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
        return true;

    } else {
        add_action( 'admin_notices', 'edir_plugin_missing_wc_notice' );
        return false;
    }
}

/**
* Display a message advising WooCommerce is required
*/
function edir_plugin_missing_wc_notice() {
    $class = 'notice notice-error';
    $message = __( 'Edirect - Checkout Add Flower plugin requires ACF PRO & WooCommerce to be installed and active.', 'edir-checkout-flower' );

    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-edir-checkout-flower-activator.php
 */
function activate_edir_flower_plugin() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-edir-checkout-flower-activator.php';
    edir_flower_plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-edir-checkout-flower-deactivator.php
 */
function deactivate_edir_flower_plugin() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-edir-checkout-flower-deactivator.php';
    edir_flower_plugin_Deactivator::deactivate();
}

add_action( 'plugins_loaded', 'edir_plugin_check_requirements' );

register_activation_hook( __FILE__, 'activate_edir_flower_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_edir_flower_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-edir-checkout-flower.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_edir_flower_plugin() {
    if (edir_plugin_check_requirements()) {
        $plugin = new edir_flower_plugin();
        $plugin->run();
    }
}

run_edir_flower_plugin();