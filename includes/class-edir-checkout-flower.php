<?php

class Edir_Flower_Plugin {

	protected $loader;

	protected $plugin_name;

	protected $version;

	public function __construct() {
		if ( defined( 'EDIR_FLOWER_PLUGIN_VERSION' ) ) {
			$this->version = EDIR_FLOWER_PLUGIN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'edir-flower-checkout';

		$this->load_dependencies();
		// $this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependencies() {

		// Define path and URL to the ACF plugin.
		define( 'MY_ACF_PATH', WP_CONTENT_DIR . '/plugins/advanced-custom-fields-pro/' );
        define( 'MY_ACF_URL', WP_CONTENT_DIR . '/plugins/advanced-custom-fields-pro/' );

		// Include the ACF plugin.
		require_once( MY_ACF_PATH . 'acf.php' );

		if( function_exists("acf_add_options_page") ) {
			acf_add_options_sub_page(array(
			    'page_title'    => 'Bouquet Checkout',
			    'menu_title'    => 'Bouquet Checkout',
			    'parent_slug'   => 'woocommerce',
			));
		}

		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_619f86e832088',
				'title' => 'Bouquet Options',
				'fields' => array(
					array(
						'key' => 'field_619f8767eed95',
						'label' => 'Bouquet Fields',
						'name' => 'bouquet_fields',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => '',
						'min' => 0,
						'max' => 0,
						'layout' => 'table',
						'button_label' => '',
						'sub_fields' => array(
							array(
								'key' => 'field_619f8774eed96',
								'label' => 'Image',
								'name' => 'ebp_image',
								'type' => 'image',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'return_format' => 'array',
								'preview_size' => 'medium',
								'library' => 'all',
								'min_width' => '',
								'min_height' => '',
								'min_size' => '',
								'max_width' => '',
								'max_height' => '',
								'max_size' => '',
								'mime_types' => '',
							),
							array(
								'key' => 'field_619f87a1eed97',
								'label' => 'Price (in Kuwaiti Dinar)',
								'name' => 'ebp_price',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
							array(
								'key' => 'field_619f87b2eed98',
								'label' => 'Bouquet Option Name',
								'name' => 'ebp_bouquet_name',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
						),
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'acf-options-bouquet-checkout',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
				'show_in_rest' => 0,
			));

			// acf_add_local_field_group(array(
			// 	'key' => 'group_61a3d1770966f',
			// 	'title' => 'Enable bouquet features',
			// 	'fields' => array(
			// 		array(
			// 			'key' => 'field_61a3d1a737da6',
			// 			'label' => 'Enable bouquet features?',
			// 			'name' => 'bouquet_test_mode',
			// 			'type' => 'true_false',
			// 			'instructions' => 'Enable/disable test mode.',
			// 			'required' => 0,
			// 			'conditional_logic' => 0,
			// 			'wrapper' => array(
			// 				'width' => '',
			// 				'class' => '',
			// 				'id' => '',
			// 			),
			// 			'message' => '',
			// 			'default_value' => 1,
			// 			'ui' => 0,
			// 			'ui_on_text' => '',
			// 			'ui_off_text' => '',
			// 		),
			// 	),
			// 	'location' => array(
			// 		array(
			// 			array(
			// 				'param' => 'options_page',
			// 				'operator' => '==',
			// 				'value' => 'acf-options-bouquet-checkout',
			// 			),
			// 		),
			// 	),
			// 	'menu_order' => 0,
			// 	'position' => 'normal',
			// 	'style' => 'default',
			// 	'label_placement' => 'top',
			// 	'instruction_placement' => 'label',
			// 	'hide_on_screen' => '',
			// 	'active' => true,
			// 	'description' => '',
			// 	'show_in_rest' => 0,
			// ));

		endif;

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-edir-flower-checkout-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-edir-flower-checkout-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-edir-flower-checkout-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-edir-flower-checkout-public.php';

		$this->loader = new Edir_Flower_Plugin_Loader();

	}

	private function set_locale() {

		$plugin_i18n = new Edir_Flower_Plugin_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$plugin_admin = new Edir_Flower_Plugin_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        // Add plugin settings to WooCommerce
        $this->loader->add_filter( 'woocommerce_get_settings_pages', $plugin_admin, 'edir_plugin_add_settings' );
        $this->loader->add_action( 'woocommerce_after_order_notes', $plugin_admin, 'edir_plugin_after_order_notes' ); // adds the field inside the CHECKOUT FORM
        $this->loader->add_action( 'woocommerce_checkout_before_order_review', $plugin_admin, 'edir_plugin_checkout_before_order_review' ); // frontend markup BEFORE the ORDER REVIEW
        $this->loader->add_action( 'woocommerce_cart_calculate_fees', $plugin_admin, 'edir_plugin_cart_calculate_fees' ); // ajax calculate fees in checkout page review order section
        $this->loader->add_action( 'woocommerce_checkout_update_order_meta', $plugin_admin, 'edir_plugin_checkout_update_order_meta' );
        $this->loader->add_action( 'woocommerce_admin_order_data_after_billing_address', $plugin_admin, 'edir_plugin_admin_order_data_after_billing_address' );
        $this->loader->add_action( 'woocommerce_email_after_order_table', $plugin_admin, 'edir_plugin_email_after_order_table' );
        // $this->loader->add_action( 'woocommerce_checkout_create_order', $plugin_admin, 'edir_plugin_checkout_create_order' );

	}

	private function define_public_hooks() {

		$plugin_public = new Edir_Flower_Plugin_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Edir_Flower_Plugin_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
