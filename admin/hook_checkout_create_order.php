<?php


if( isset( $data['bouquet_woo_selected_opt'] ) ) {

    $order->update_meta_data( '_bouquet_woo_selected_opt', sanitize_text_field( $data['bouquet_woo_selected_opt'] ) );

}

?>