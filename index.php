<?php get_header(); ?>

<?php
	$organisation_id = apply_filters( 'pf_query_get_organisation_id', (isset($_GET['organisationid'])) ? $_GET['organisationid'] : '0' );
	wp_reset_postdata();
?>

<!-- IF NOT FRONT PAGE -->
<?php if (!is_front_page() ): ?>
	
	<?php include_once(get_template_directory().'/templates/themes/' . get_post_meta($organisation_id, '_organisation_theme', true) . '/style.php'); ?>

	<main class="container rounded" style="">
		
		<?php include_once(get_template_directory().'/templates/themes/' . get_post_meta($organisation_id, '_organisation_theme', true) . '/header.php'); ?>
		
		<div class="container my-5">
			<div class='row'>
				<div class="col-md-12">
					<?php 
					if (have_posts()) {
						while ( have_posts() ) : the_post();
					?>

					<?php the_content();?>

					<?php
						endwhile;
					} 
					?>
				</div>
			</div>
		</div>

		<hr>

		<?php include_once(get_template_directory().'/templates/themes/' . get_post_meta($organisation_id, '_organisation_theme', true) . '/footer.php'); ?>
	</main>

<!-- ELSE IF FRONT PAGE -->
<?php elseif ( is_front_page() ): ?>

	<?php include_once(get_template_directory().'/templates/themes/' . get_post_meta($organisation_id, '_organisation_theme', true) . '/style.php'); ?>

	<main class="container rounded" style="background: <?php echo get_post_meta($organisation_id, '_organisation_default_color_panel', true); ?>; padding: 20px 40px; margin-top: 100px; margin-bottom: 30px; max-width: 800px;">
		<div class="container my-5">
			<div class='row'>
				<div class="col-md-12 text-center">
					<img class="mb-5" src="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_logo_color', true ), 'full' ); ?>" width="250px">
					<p class="mb-4" style="font-size: 25px !important; line-height: 35px !important; color: <?php echo get_post_meta($organisation_id, '_organisation_default_color_panel_text', true); ?> !important;">
						<strong><?php echo get_post_meta($organisation_id, '_organisation_name', true); ?></strong><br/>
						<?php echo get_post_meta($organisation_id, '_organisation_address_1', true); ?><br/>
						<?php echo get_post_meta($organisation_id, '_organisation_postal', true) . '&nbsp;' . get_post_meta($organisation_id, '_organisation_city', true); ?>,
						<?php echo get_post_meta($organisation_id, '_organisation_country', true); ?>
					</p>
					<p class="mb-0" style="font-size: 25px !important; line-height: 35px !important; color: <?php echo get_post_meta($organisation_id, '_organisation_default_color_panel_text', true); ?> !important;">
						<?php echo get_post_meta($organisation_id, '_organisation_email', true); ?><br/>
						<?php echo get_post_meta($organisation_id, '_organisation_phone', true); ?><br/>
					</p>
				</div>
			</div>
		</div>
	</main>

<?php endif; ?>

<?php get_footer(); ?>