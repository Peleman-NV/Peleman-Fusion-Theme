<div class="container mb-2">
	<header>
		<div class="">
			<div class="container" style="padding-left: 0px; padding-right: 0px;">
				
				<?php if(apply_filters( 'wpml_element_has_translations', NULL, $organisation_id, 'organisation' )): ?>
					<div class="d-flex flex-wrap align-items-right justify-content-right justify-content-lg-end mb-2">
						<?php do_action('wpml_add_language_selector'); ?>
					</div>
				<?php endif; ?>
				
				<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
					<?php
					$url = get_home_url() . '/organisation/' . get_post_meta($organisation_id, '_organisation_editor_id', true);
					?>

					<a href="<?php echo $url; ?>" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
						<img width="<?php echo (!empty(get_post_meta($organisation_id, '_organisation_header_logo_width', true))) ? get_post_meta($organisation_id, '_organisation_header_logo_width', true) : '125'; ?>px" src="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_logo_color', true ), 'full' ); ?>">
					</a>

					<ul class="nav col-12 col-lg-auto justify-content-center">
						<li>
							<a href="<?php echo $url; ?>" class="nav-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house d-block mx-auto mb-2" viewBox="0 0 16 16">
									<path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
								</svg>
								<?php echo __('Home', 'peleman-fusion'); ?>
							</a>
						</li>

						<?php if(!empty(get_post_meta($organisation_id, '_organisation_email', true))): ?>
						<li>
							<a href="mailto: <?php echo get_post_meta($organisation_id, '_organisation_email', true); ?>" class="nav-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-envelope d-block mx-auto mb-2" viewBox="0 0 16 16">
									<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
								</svg>
								<?php echo __('Contact', 'peleman-fusion'); ?>
							</a>
						</li>
						<?php endif; ?>

						<li>
							<a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>?organisationid=<?php echo basename(get_permalink($organisation_id)); ?>" class="nav-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-basket d-block mx-auto mb-2" viewBox="0 0 16 16">
									<path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
								</svg>
								<?php echo __('Cart', 'peleman-fusion'); ?>
							</a>
						</li>

						<?php if (is_user_logged_in()): ?>
						<li>
							<a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>?organisationid=<?php echo get_post_meta( $organisation_id, '_organisation_editor_id', true ); ?>" class="nav-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person d-block mx-auto mb-2" viewBox="0 0 16 16">
									<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
								</svg>
								<?php echo __('Account', 'peleman-fusion'); ?>
							</a>
						</li>
						<?php else: ?>
						<li>
							<a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>?organisationid=<?php echo get_post_meta( $organisation_id, '_organisation_editor_id', true ); ?>" class="nav-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person d-block mx-auto mb-2" viewBox="0 0 16 16">
									<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
								</svg>
								<?php echo __('Log in', 'peleman-fusion'); ?>
							</a>
						</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</header>
</div>