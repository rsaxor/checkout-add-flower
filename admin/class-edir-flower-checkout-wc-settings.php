<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Edir_Flower_Plugin_WC_Settings' ) ) {

    class Edir_Flower_Plugin_WC_Settings extends WC_Settings_Page {

        public function __construct() {

            $this->id    = 'edir-flower-checkout';
            $this->label = __( 'Add Flower to Checkout', 'edir-flower-checkout' );

            // Define all hooks instead of inheriting from parent
            add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
            add_action( 'woocommerce_sections_' . $this->id, array( $this, 'output_sections' ) );
            add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
            add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );

        }

        public function get_sections() {
            $sections = array(
                '' => __( 'Settings', 'edir-flower-checkout' ),
            );

            return apply_filters( 'woocommerce_get_sections_' . $this->id, $sections );
        }

        public function get_settings() {

            global $current_section;
            $prefix = 'Edir_Flower_Plugin_';
            $settings = array();

            switch ($current_section) {
                default:
                    include 'partials/edir-flower-checkout-settings-main.php';
            }

            return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings, $current_section );
        }

        public function output() {
            global $current_section;

            switch ($current_section) {
                default:
                    $settings = $this->get_settings();
                    WC_Admin_Settings::output_fields( $settings );
            }

        }

        public function save() {
            $settings = $this->get_settings();

            WC_Admin_Settings::save_fields( $settings );
        }

    }

}


return new Edir_Flower_Plugin_WC_Settings();