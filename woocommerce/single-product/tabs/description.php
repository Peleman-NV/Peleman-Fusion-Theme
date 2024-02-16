<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) );

$organisation_id = apply_filters( 'pf_query_get_organisation_id', (isset($_GET['organisationid'])) ? $_GET['organisationid'] : '0' );
wp_reset_postdata();

?>

	<?php if ( $heading ) : ?>
		<h2><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<?php 
		$array_custom_images = (!empty(get_post_meta( $organisation_id, '_organisation_products_custom_images', true ))) ? get_post_meta( $organisation_id, '_organisation_products_custom_images', true ) : [];
		if (array_key_exists($post->ID, $array_custom_images) && !empty($array_custom_images[$post->ID])){
			if(isset($array_custom_images[$post->ID]['custom_long_description']) && !empty($array_custom_images[$post->ID]['custom_long_description'])){
				echo $array_custom_images[$post->ID]['custom_long_description'];
			}else {
				the_content();
			}
		}else {
			the_content();
		}
	?>
