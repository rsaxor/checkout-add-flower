<?php
if( have_rows( 'bouquet_fields' , 'option' ) ):

	woocommerce_form_field( 'bouquet_woo_field', array(
		'type'          => 'number',
		'class'         => '',
		'label'         => __('bouquet amount','edir-flower-checkout'),
	), $checkout->get_value( 'bouquet_woo_field' ) );

	woocommerce_form_field( 'bouquet_woo_selected_opt', array(
		'type'          => 'text',
		'class'         => '',
		'label'         => __('bouquet woo field selected','edir-flower-checkout'),
	), $checkout->get_value( 'bouquet_woo_selected_opt' ) );

endif;

?>