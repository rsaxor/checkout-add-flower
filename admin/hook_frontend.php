<?php

$count_matches 		= 0;

global $woocommerce;

foreach($woocommerce->cart->get_cart() as $cart_item ){
    // Handling also variable products and their products variations
    $cart_item_ids = array($cart_item['product_id'], $cart_item['variation_id']);

    if( get_field( 'giftset_hide_bouquet_opt' , $cart_item['product_id'] ) == '0' ):

    	$count_matches++; // incrementing items count

    endif;

}

if( have_rows( 'bouquet_fields' , 'option' ) && $count_matches == 0 ): ?>
<div id="bouquet-options-wrap" class="woocommerce-input-wrapper">
    <label class="checkbox woo-plugin-label-checkbox">
        <input type="checkbox" class="input-checkbox " name="bouquet-input-choices" id="bouquet-input-choices" value="1" style=" margin-right: 10px; width: 20px; height: 20px; line-height: 1; display: inline-block; vertical-align: bottom;">
        <?php echo __('ADD A BOUQUET OF FLOWERS?','edir-flower-checkout'); ?>
    </label>
    <fieldset id="flower-gift-wrap" class="bouquet-hide">
        <legend><?php echo __('Select your flowers/bouquet','edir-flower-checkout'); ?></legend>
        <div class="swiper">
        	<div class="swiper-wrapper">
				<?php

				$ctr_bouquet 	= 1;
				$count_rows 	= count( get_field( 'bouquet_fields'  , 'option' ) );

				while( have_rows( 'bouquet_fields'  , 'option' ) ) : the_row( );

					$checked 		= $ctr_bouquet == 1 ? 'checked' : '' ;
					$select_label 	= $ctr_bouquet == 1 ? 'selected' : '' ;
					$ebp_image 		= get_sub_field( 'ebp_image' );

					?>
					<div class="swiper-slide">
				        <label class="<?php echo $select_label; ?>" for="opt-bouquet-<?php echo $ctr_bouquet; ?>">
				            <input <?php echo $checked; ?> type="radio" class="input-radio" name="checkout_bouquet_selection" data-opt="<?php echo get_sub_field( 'ebp_bouquet_name' ); ?>" id="opt-bouquet-<?php echo $ctr_bouquet; ?>" value="<?php echo get_sub_field( 'ebp_price' ); ?>">
				            <img class="thumbnail" src="<?php echo $ebp_image['url']; ?>">
				            <div class="img_zoomer_container" data-scale="1.6">
					            <a
								    class="dslc-lightbox-image img_zoomer"
								    href="javascript:;"
								    target="_self"
								    style="background-image:url('<?php echo $ebp_image['url']; ?>')"
								  >
								  </a>
							</div>
				            <p class="bouquet-price"><?php echo __('KWD','edir-flower-checkout'). ' ' .get_sub_field( 'ebp_price' ); ?></p>
				        </label>
					</div>
					<?php
					$ctr_bouquet++;
				endwhile;

				?>
        	</div>
        </div>
        <?php //if( $count_rows >= 6 ): ?>
	        <div class="bouquet-button-wrap">
				<a href="javascript:;" class="bouquet-button-prev">
					<img src="<?php echo home_url( '/wp-content/uploads/2021/01/slider_left.png' ); ?>">
				</a>
				<a href="javascript:;" class="bouquet-button-next">
					<img src="<?php echo home_url( '/wp-content/uploads/2021/01/slider_right.png' ); ?>">
				</a>
	        </div>
	    <?php //endif; ?>
		<!-- <div class="slider-arrows">
			<button type="button" class="slider-arrow-prev">Prev</button>
			<button type="button" class="slider-arrow-next">Next</button>
		</div> -->
    </fieldset>
</div>
<?php

endif;


?>