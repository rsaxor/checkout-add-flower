<?php

class Edir_Flower_Plugin_Public {

	private $plugin_name;

	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function enqueue_styles() {

		if( is_checkout( ) ):
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/edir-flower-checkout-public.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'plugin-swiper', 'https://unpkg.com/swiper@7/swiper-bundle.min.css' , 'all' );
		endif;

	}

	public function enqueue_scripts() {

		if( is_checkout( ) ):
			wp_enqueue_script( 'plugin-swiper', 'https://unpkg.com/swiper@7/swiper-bundle.min.js', array( 'jquery', $this->plugin_name ), $this->version, false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/edir-flower-checkout-public.js', array( 'jquery' ), $this->version, false );
		endif;

	}

}
