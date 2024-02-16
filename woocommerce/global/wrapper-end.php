<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-end.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	$organisation_id = apply_filters( 'pf_query_get_organisation_id', (isset($_GET['organisationid'])) ? $_GET['organisationid'] : '0' );
	wp_reset_postdata();	
?>

				</div>
			</div>
		</div>

		<hr>

		<?php include_once(get_template_directory().'/templates/themes/' . get_post_meta($organisation_id, '_organisation_theme', true) . '/footer.php'); ?>

	</main>

<?php