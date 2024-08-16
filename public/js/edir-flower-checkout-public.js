(function( $ ) {
	'use strict';

	$(document).ready(function(){
		$('#bouquet-input-choices').on('click',function(){

			$('#flower-gift-wrap').toggleClass('bouquet-hide');

			$('input[name="checkout_bouquet_selection"]').on('click', function () {

				$('#bouquet-options-wrap fieldset label').removeClass('selected');
				$(this).parent().addClass('selected');
				var bouquet_amount 	= $(this).val(),
					bouquet_name 	= $(this).data('opt');
				$('input[name="bouquet_woo_field"]').val(bouquet_amount);
				$('input[name="bouquet_woo_selected_opt"]').val(bouquet_name);
				jQuery("body").trigger("update_checkout");

			});

			if( $('#flower-gift-wrap').hasClass('bouquet-hide') ) {
				$('input[name="bouquet_woo_field"]').val(0);
				$('input[name="bouquet_woo_selected_opt"]').val('');
				jQuery("body").trigger("update_checkout");
			} else {
				var bouquet_selected 		= $('input[name="checkout_bouquet_selection"]:checked').val(),
					bouquet_name_selected 	= $('input[name="checkout_bouquet_selection"]:checked').data('opt');
				$('input[name="bouquet_woo_field"]').val(bouquet_selected);
				$('input[name="bouquet_woo_selected_opt"]').val(bouquet_name_selected);
				jQuery("body").trigger("update_checkout");
			}

			$(".img_zoomer_container")
			  // tile mouse actions
			  .on("mouseover", function() {
			    $(this)
			      .children(".img_zoomer")
			      .css({ transform: "scale(" + $(this).attr("data-scale") + ")" });
			  })
			  .on("mouseout", function() {
			    $(this)
			      .children(".img_zoomer")
			      .css({ transform: "scale(1)" });
			  })
			  .on("mousemove", function(e) {
			    $(this)
			      .children(".img_zoomer")
			      .css({
			        "transform-origin":
			          ((e.pageX - $(this).offset().left) / $(this).width()) * 100 +
			          "% " +
			          ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +
			          "%"
			      });
			  });


		});

		const swiper = new Swiper('.swiper', {
			// Optional parameters
			// loop: true,
			// Navigation arrows
			navigation: {
			    nextEl: '.bouquet-button-next',
			    prevEl: '.bouquet-button-prev'
			},
			slidesPerView: '1',
			breakpoints: {
				320: {
					slidesPerView: 2,
					// spaceBetween: 20
				},
				601: {
					slidesPerView: 3,
					// spaceBetween: 30
				},
				769: {
					slidesPerView: 4,
					// spaceBetween: 40
				},
				1001: {
					slidesPerView: 5,
				}
			},
		});

	});

})( jQuery );
