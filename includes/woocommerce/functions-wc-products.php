<?php

//  Variation treshold of Woocommerce variations higher 
	add_filter( 'woocommerce_ajax_variation_threshold', function() { return 500; } );

// Change breadcrumbs place to above title
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// Remove CLEAR from product variations
	add_filter( 'woocommerce_reset_variations_link', '__return_empty_string', 9999 );

// Add Navigation Arrows to slider product images
	add_filter( 'woocommerce_single_product_carousel_options', 'cuswoo_update_woo_flexslider_options' );
	function cuswoo_update_woo_flexslider_options( $options ) {
		$options['directionNav'] = true;
		return $options;
	}

//	Remove product data tabs
	add_filter( 'woocommerce_product_tabs', 'my_remove_product_tabs', 98 );
	function my_remove_product_tabs( $tabs ) {
		unset( $tabs['additional_information'] ); // To remove the additional information tab
		$tabs[ 'description' ][ 'title' ] = __('More information', 'peleman-fusion');
	  	return $tabs;
	}

//	Remove description heading in tab MORE INFORMATION defined above
	add_filter( 'woocommerce_product_description_heading', 'misha_description_heading' );
	function misha_description_heading( $heading ){
		return '';
	}