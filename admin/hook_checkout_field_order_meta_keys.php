<?php

if( get_post_meta( $order->id, 'bouquet_woo_field', true ) ) {

	$woo_field_price = get_post_meta( $order->id, 'bouquet_woo_field', true );

	if( have_rows( 'bouquet_fields' , 'option' ) ) {

		while( have_rows( 'bouquet_fields'  , 'option' ) ) {

			the_row( );

			if( $woo_field_price == get_sub_field( 'ebp_price' ) ) {

				$bouquet_woo_selected_opt = get_sub_field( 'ebp_bouquet_name' );

			}

		}

	}

} else {

	$bouquet_woo_selected_opt = __('N/A','edir-flower-checkout');

}

echo '<p style="margin: 0;"><strong>' . __( 'Bouquet of choice' ) . ' : </strong>' . $bouquet_woo_selected_opt . '</p>';

return $keys;

?>