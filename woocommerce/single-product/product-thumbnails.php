<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$organisation_id = apply_filters( 'pf_query_get_organisation_id', (isset($_GET['organisationid'])) ? $_GET['organisationid'] : '0' );
wp_reset_postdata();

$array_custom_images = (!empty(get_post_meta( $organisation_id, '_organisation_products_custom_images', true ))) ? get_post_meta( $organisation_id, '_organisation_products_custom_images', true ) : [];
if (array_key_exists($product->get_id(), $array_custom_images) && !empty($array_custom_images[$product->get_id()])){
	
	if(!empty($array_custom_images[$product->get_id()]['show_default_additional_images']) && $array_custom_images[$product->get_id()]['show_default_additional_images'] == 'true'){
		$attachment_ids = $product->get_gallery_image_ids();
	}else{
		$attachment_ids = [];
	}
	
	
// 	if (array_key_exists($product->get_id(), $array_custom_images) && !empty($array_custom_images[$product->get_id()]['main_image'])){
		
// 	}
	
	if (array_key_exists($product->get_id(), $array_custom_images) && !empty($array_custom_images[$product->get_id()]['additional_image_1'])){
		array_push($attachment_ids, $array_custom_images[$product->get_id()]['main_image']);
		array_push($attachment_ids, $array_custom_images[$product->get_id()]['additional_image_1']);
	}

	if (array_key_exists($product->get_id(), $array_custom_images) && !empty($array_custom_images[$product->get_id()]['additional_image_2'])){
		array_push($attachment_ids, $array_custom_images[$product->get_id()]['additional_image_2']);
	}

	if (array_key_exists($product->get_id(), $array_custom_images) && !empty($array_custom_images[$product->get_id()]['additional_image_3'])){
		array_push($attachment_ids, $array_custom_images[$product->get_id()]['additional_image_3']);
	}

	if (array_key_exists($product->get_id(), $array_custom_images) && !empty($array_custom_images[$product->get_id()]['additional_image_4'])){
		array_push($attachment_ids, $array_custom_images[$product->get_id()]['additional_image_4']);
	}
}else {
	$attachment_ids = $product->get_gallery_image_ids();
}

function wc_get_gallery_image_html2( $attachment_id, $main_image = false ) {
  $flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
  $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
  $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
  $image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
  $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
  $thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
  $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
  $alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
  $image             = wp_get_attachment_image(
    $attachment_id,
    $image_size,
    false,
    apply_filters(
      'woocommerce_gallery_image_html_attachment_image_params',
      array(
        'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
        'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
        'data-src'                => esc_url( $full_src[0] ),
        'data-large_image'        => esc_url( $full_src[0] ),
        'data-large_image_width'  => esc_attr( $full_src[1] ),
        'data-large_image_height' => esc_attr( $full_src[2] ),
        'class'                   => esc_attr( $main_image ? 'wp-post-image' : '' ),
      ),
      $attachment_id,
      $image_size,
      $main_image
    )
  );

  return '<div data-thumb="' . esc_url( $thumbnail_src[1] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image" style="display: inline-block; margin-right: 10px;"><a href="' . esc_url( $full_src[0] ) . '">' . $image . '</a></div>';
}

if ( $attachment_ids && $product->get_image_id() ) {
	foreach ( $attachment_ids as $attachment_id ) {
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html2( $attachment_id ), $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
	}
}
