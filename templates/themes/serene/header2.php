<div class="container rounded" style="
									  margin-bottom: 20px; 
									  padding: 20px; 
									  min-height: <?php echo get_post_meta($organisation_id, '_organisation_header_min_height', true); ?>px; 
									  background-image: url(' <?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_header_image_background', true ), 'full' ); ?> ');
									  background-position: <?php echo get_post_meta($organisation_id, '_organisation_header_image_background_position', true); ?>;
									  background-size: <?php echo get_post_meta($organisation_id, '_organisation_header_image_background_size', true); ?>;
									  background-repeat: <?php echo get_post_meta($organisation_id, '_organisation_header_image_background_repeat', true); ?>;">
    <header class="d-flex flex-wrap justify-content-center mb-1">
      	<?php 
// 			$url = get_site_url() . '/organisation/' . get_post_meta($organisation_id, '_organisation_editor_id', true);
			$url = get_permalink($organisation_id);
			global $wp;
			$current_url = home_url( add_query_arg( array(), $wp->request ) );
		?>
			
		<a href="<?php echo $url; ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
			<img width="<?php echo (!empty(get_post_meta($organisation_id, '_organisation_header_logo_width', true))) ? get_post_meta($organisation_id, '_organisation_header_logo_width', true) : '125'; ?>px" src="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_logo_color', true ), 'full' ); ?>">
		</a>
	
		<ul class="nav navbar-collapse nav-pills align-items-end" style="padding-bottom: 10px;">
			
			<li class="nav-item"><a href="<?php echo $url; ?>" class="nav-link <?php echo ($current_url == $url) ? 'active' : '';?>" aria-current="page"><?php echo __('Home', 'peleman-fusion'); ?></a></li>
			
			<?php if(!empty(get_post_meta($organisation_id, '_organisation_email', true))): ?>
				<li class="nav-item"><a href="mailto: <?php echo get_post_meta($organisation_id, '_organisation_email', true); ?>" class="nav-link"><?php echo __('Contact', 'peleman-fusion'); ?></a></li>
			<?php endif; ?>
			
			<li class="nav-item"><a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>?organisationid=<?php echo basename(get_permalink($organisation_id)); ?>" class="nav-link <?php echo (is_cart()) ? 'active' : '';?>"><?php echo __('Cart', 'peleman-fusion'); ?></a></li>
			
			
			<?php if (is_user_logged_in()): ?>
				<li class="nav-item"><a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>?organisationid=<?php echo get_post_meta( $organisation_id, '_organisation_editor_id', true ); ?>" class="nav-link <?php echo (is_account_page()) ? 'active' : '';?>"><?php echo __('Account', 'peleman-fusion'); ?></a></li>
			<?php else: ?>
				<li class="nav-item"><a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>?organisationid=<?php echo get_post_meta( $organisation_id, '_organisation_editor_id', true ); ?>" class="nav-link <?php echo (is_account_page()) ? 'active' : '';?>"><?php echo __('Log in', 'peleman-fusion'); ?></a></li>
			<?php endif; ?>
			
			<?php if(apply_filters( 'wpml_element_has_translations', NULL, $organisation_id, 'organisation' )): ?>
				<li class="nav-item"><?php do_action('wpml_add_language_selector'); ?></li>
			<?php endif; ?>
		</ul>
    </header>
  </div>