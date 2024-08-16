<?php

global $woocommerce;

$product_in_cart = false;

$without_totale = 0;

foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
    $product_data = $values['data'];
	$price .=  $values['line_subtotal'];
    $without_totale += $values['line_subtotal'];
}

$quantity_total = floatval(preg_replace( '#[^\d.]#', '', $without_totale));


if($_POST){
	parse_str($_POST['post_data'],$data);
	if( $_POST['bouquet_woo_field'] ){
		$woocommerce->cart->add_fee( __('Flower bouquet', 'edir-flower-checkout'), $_POST['bouquet_woo_field'] );
	}

	if( $data['bouquet_woo_field'] ){
		$woocommerce->cart->add_fee( __('Flower bouquet', 'edir-flower-checkout'), $data['bouquet_woo_field'] );
	}
}

?>