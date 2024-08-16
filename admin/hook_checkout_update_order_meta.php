<?php

if( $_POST['bouquet_woo_field'] ) {
	update_post_meta( $order_id, 'bouquet_woo_field', $_POST['bouquet_woo_field']);
}

?>