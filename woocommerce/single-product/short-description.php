<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

$organisation_id = apply_filters( 'pf_query_get_organisation_id', (isset($_GET['organisationid'])) ? $_GET['organisationid'] : '0' );
wp_reset_postdata();

?>
<div class="woocommerce-product-details__short-description">
	<?php 
		$array_custom_images = (!empty(get_post_meta( $organisation_id, '_organisation_products_custom_images', true ))) ? get_post_meta( $organisation_id, '_organisation_products_custom_images', true ) : [];
		if (array_key_exists($post->ID, $array_custom_images) && !empty($array_custom_images[$post->ID])){
			if(isset($array_custom_images[$post->ID]['custom_short_description']) && !empty($array_custom_images[$post->ID]['custom_short_description'])){
				echo $array_custom_images[$post->ID]['custom_short_description'];
			}else {
				echo $short_description; // WPCS: XSS ok.
			}
		}else {
			echo $short_description; // WPCS: XSS ok.
		}
	?>
</div>
