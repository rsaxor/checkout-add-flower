<?php

class Edir_Flower_Plugin_Admin {

	private $plugin_name;

	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/edir-flower-checkout-admin.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {


		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/edir-flower-checkout-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function edir_plugin_add_settings( $settings ) {
        $settings[] = include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-edir-flower-checkout-wc-settings.php';

        return $settings;
    }

    public function edir_plugin_after_order_notes( $checkout ) {

        include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/hook_after_order_notes.php';

    }

    public function edir_plugin_checkout_before_order_review( ) {

        include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/hook_frontend.php';

    }

    public function edir_plugin_cart_calculate_fees( ) {

        include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/hook_cart_calculate_fees.php';

    }

    public function edir_plugin_checkout_update_order_meta( $order_id ) {

        include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/hook_checkout_update_order_meta.php';

    }

    public function edir_plugin_admin_order_data_after_billing_address( $order ) {

        include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/hook_display_admin_order_meta.php';

    }

    public function edir_plugin_email_after_order_table( $order ) {

        include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/hook_checkout_field_order_meta_keys.php';

    }

    public function edir_plugin_checkout_create_order( $order ) {

        include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/hook_checkout_create_order.php';

    }

}
