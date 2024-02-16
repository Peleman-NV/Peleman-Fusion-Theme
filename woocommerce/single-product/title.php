<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$organisation_id = apply_filters( 'pf_query_get_organisation_id', (isset($_GET['organisationid'])) ? $_GET['organisationid'] : '0' );
wp_reset_postdata();

?>
<div class="woocommerce-product-details__short-description">
	<?php 
		$array_custom_images = (!empty(get_post_meta( $organisation_id, '_organisation_products_custom_images', true ))) ? get_post_meta( $organisation_id, '_organisation_products_custom_images', true ) : [];
		if (array_key_exists($post->ID, $array_custom_images) && !empty($array_custom_images[$post->ID])){
			if(isset($array_custom_images[$post->ID]['custom_title']) && !empty($array_custom_images[$post->ID]['custom_title'])){
				echo '<h1 class="product_title entry-title">' . $array_custom_images[$post->ID]['custom_title'] . '</h1>';
			}else {
				the_title( '<h1 class="product_title entry-title">', '</h1>' );
			}
		}else {
			the_title( '<h1 class="product_title entry-title">', '</h1>' );
		}
	
		if (array_key_exists($post->ID, $array_custom_images) && !empty($array_custom_images[$post->ID]['custom_video'])){
	
			$data = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=https://vimeo.com/' . $array_custom_images[$post->ID]['custom_video'] ) );

			echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">';
				echo __('Watch the video', 'peleman-fusion');
			echo '</button>';

			echo '<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
				echo '<div class="modal-dialog modal-lg">';
					echo '<div class="modal-content">';
						echo '<div class="modal-header">';
							echo '<h5 class="modal-title" id="exampleModalLabel" style="margin-bottom: 0px !important;">' . $data->title . '</h5>';
							echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
						echo '</div>';

						echo '<div class="modal-body">';

							?>
								<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/<?php echo $array_custom_images[$post->ID]['custom_video']; ?>?h=7a839ee04d&color=f04e23&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
							<?php
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
	?>
</div>


