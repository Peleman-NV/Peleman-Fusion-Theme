<style>
	
	:root {
		--main-color: <?php echo get_post_meta($organisation_id, '_organisation_color_main', true); ?>;
		--main-button-color-text: <?php echo get_post_meta($organisation_id, '_organisation_color_main_button_text', true); ?>;
		--secondary-color: <?php echo get_post_meta($organisation_id, '_organisation_color_secondary', true); ?>;
		--secondary-button-color-text: <?php echo get_post_meta($organisation_id, '_organisation_color_secondary_button_text', true); ?>;
		--color-text: <?php echo get_post_meta($organisation_id, '_organisation_color_main_text', true); ?>;
	}
	
	main.container {
		background: <?php echo get_post_meta($organisation_id, '_organisation_theme_container_color', true); ?>;
		padding: 20px 40px;
		margin-top: 30px;
		margin-bottom: 30px;
		max-width: 1280px;
	}
	
	.woocommerce-message a.button {display: none !important;}
	
	html{
  -moz-text-size-adjust: none;
  -webkit-text-size-adjust: none;
  text-size-adjust: none;
  }
	
	<?php 
		$has_english = apply_filters( 'wpml_object_id', $organisation_id, 'organisation', FALSE, 'en' );
		if(empty($has_english)){
			echo 'li.wpml-ls-item-en {display: none !important;}';
		}
	
		$has_dutch = apply_filters( 'wpml_object_id', $organisation_id, 'organisation', FALSE, 'nl' );
		if(empty($has_dutch)){
			echo 'li.wpml-ls-item-nl {display: none !important;}';
		}
	
		$has_french = apply_filters( 'wpml_object_id', $organisation_id, 'organisation', FALSE, 'fr' );
		if(empty($has_french)){
			echo 'li.wpml-ls-item-fr {display: none !important;}';
		}
	
		$has_german = apply_filters( 'wpml_object_id', $organisation_id, 'organisation', FALSE, 'de' );
		if(empty($has_german)){
			echo 'li.wpml-ls-item-de {display: none !important;}';
		}
	
		$has_spanish = apply_filters( 'wpml_object_id', $organisation_id, 'organisation', FALSE, 'es' );
		if(empty($has_spanish)){
			echo 'li.wpml-ls-item-es {display: none !important;}';
		}
	?>
	
	/* --------------------------------------------------------------------------------------------- */
	
	form.checkout div#customer_details {
		margin-bottom: 50px;
	}
	
	
	
	.wpml-ls-legacy-dropdown-click {
		width: auto !important;
		max-width: 100%;
	}
	
	.wpml-ls-legacy-dropdown-click a {
		display: block;
		text-decoration: none;
		color: #444;
		border: none !important;
		background-color: #fff;
		padding: 5px 10px;
		line-height: 1;
	}
	
	.wpml-ls-legacy-list-horizontal.wpml-ls-statics-footer {
		margin-bottom: 10px !important;
	}
	
	.wpml-ls-legacy-list-horizontal.wpml-ls-statics-footer>ul {
		text-align: left !important;
	}
	
	.wpml-ls-legacy-list-horizontal {
		padding: 0px !important;
	}

	p, body {
		font-family: "<?php echo get_post_meta($organisation_id, '_organisation_paragraph_font', true); ?>" !important;
		font-weight: <?php echo get_post_meta($organisation_id, '_organisation_paragraph_font_weight', true); ?> !important;
		font-size: <?php echo get_post_meta($organisation_id, '_organisation_paragraph_font_size', true); ?>px !important;
		line-height: <?php echo get_post_meta($organisation_id, '_organisation_paragraph_line_height', true); ?>px !important;
	}

	h1, h2, h3, h4, h5, h6 {
		font-family: "<?php echo get_post_meta($organisation_id, '_organisation_heading_font', true); ?>" !important;
		font-weight: <?php echo get_post_meta($organisation_id, '_organisation_heading_font_weight', true); ?> !important;
	}

	h1 {
		font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading1_font_size', true); ?>px !important;
		margin-bottom: <?php echo get_post_meta($organisation_id, '_organisation_heading1_margin_bottom', true); ?>px !important;
	}

	h2 {
		font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading2_font_size', true); ?>px !important;
		margin-bottom: <?php echo get_post_meta($organisation_id, '_organisation_heading2_margin_bottom', true); ?>px !important;
	}

	h3 {
		font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading3_font_size', true); ?>px !important;
		margin-bottom: <?php echo get_post_meta($organisation_id, '_organisation_heading3_margin_bottom', true); ?>px !important;
	}

	h4 {
		font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading4_font_size', true); ?>px !important;
		margin-bottom: <?php echo get_post_meta($organisation_id, '_organisation_heading4_margin_bottom', true); ?>px !important;
	}

	h5 {
		font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading5_font_size', true); ?>px !important;
		margin-bottom: <?php echo get_post_meta($organisation_id, '_organisation_heading5_margin_bottom', true); ?>px !important;
	}

	h6 {
		font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading6_font_size', true); ?>px !important;
		margin-bottom: <?php echo get_post_meta($organisation_id, '_organisation_heading6_margin_bottom', true); ?>px !important;
	}
	
	/* --------------------------------------------------------------------------------------------- */

	.pwp_editor_button {
		width: 80%;
		margin-top: 10px;
		background-color: var(--main-color) !important;
		border: 1px solid var(--main-button-color-text) !important;
		color: var(--main-button-color-text) !important;
		transition: all 0.5s ease;
		transform: scale(1);
		font-size: 14px;
		padding: 5px;
	}
	
	.pwp_editor_button:hover {
		background-color: var(--main-color) !important;
		border: 1px solid var(--main-button-color-text) !important;
		color: var(--main-button-color-text) !important;
		transform: scale(1.1) perspective(1px);
	}
	
	.woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit.alt, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) a.button.alt, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) input.button.alt, :where(body:not(.woocommerce-block-theme-has-button-styles)) .woocommerce #respond input#submit.alt, :where(body:not(.woocommerce-block-theme-has-button-styles)) .woocommerce a.button.alt, :where(body:not(.woocommerce-block-theme-has-button-styles)) .woocommerce button.button.alt, :where(body:not(.woocommerce-block-theme-has-button-styles)) .woocommerce input.button.alt {
		background-color: var(--main-color) !important;
		border: 1px solid var(--main-button-color-text) !important;
		color: var(--main-button-color-text) !important;
		transition: all 0.5s ease;
		transform: scale(1);
	}
	
	.btn-primary {
		background-color: var(--main-color);
		border: 1px solid var(--main-button-color-text);
		color: var(--main-button-color-text);
		transition: all 0.5s ease;
		transform: scale(1);
	}

	.btn-primary:hover {
		background-color: var(--main-color);
		border: 1px solid var(--main-button-color-text);
		color: var(--main-button-color-text);
		transform: scale(1.1) perspective(1px);
	}

	.btn-secondary {
		background-color: var(--secondary-color);
		border: 1px solid var(--secondary-color);
		color: var(--secondary-button-color-text);
		transition: all 0.5s ease;
		transform: scale(1);
	}

	.btn-secondary:hover {
		background-color: var(--secondary-color);
		border: 1px solid var(--secondary-color);
		color: var(--secondary-button-color-text);
		transform: scale(1.1) perspective(1px);
	}
	
	<?php if(get_post_meta($organisation_id, '_organisation_theme_settings_bg_around', true) == 'yes'): ?>
	main.container {
		margin-top: 30px !important;
		margin-bottom: 30px !important; 
	}
	<?php else: ?>
	main.container {
		margin-top: 0px !important;
		margin-bottom: 0px !important; 
	}
	<?php endif; ?>

	<?php if(get_post_meta($organisation_id, '_organisation_theme_settings_rounded', true) == 'yes'): ?>
	.rounded {
		border-radius: 1rem !important;
	}
	<?php else: ?>
	.rounded {
		border-radius: 0px !important;
	}
	<?php endif; ?>

	<?php if(!empty(get_post_meta($organisation_id, '_organisation_image_background', true))): ?>
	body {
		background-image: url(" <?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_image_background', true ), 'full' ); ?> ");
		background-position: <?php echo get_post_meta($organisation_id, '_organisation_image_background_position', true); ?>;
		background-size: <?php echo get_post_meta($organisation_id, '_organisation_image_background_size', true); ?>;
		background-repeat: <?php echo get_post_meta($organisation_id, '_organisation_image_background_repeat', true); ?>;
		background-color: <?php echo get_post_meta($organisation_id, '_organisation_theme_body_color', true); ?>;
	}
	<?php else: ?>
	body {
		background-color: <?php echo get_post_meta($organisation_id, '_organisation_theme_body_color', true); ?>;
	}
	<?php endif; ?>

	.nav-link {
		padding: 0 1rem;
		font-size: 20px;
		font-family: "Museo-Sans-Rounded-300";
		transition: all 0.5s ease;
		transform: scale(1);
	}

	.nav-link:hover {
		transform: scale(1.1) perspective(1px)
	}

	<?php if(!empty(get_post_meta($organisation_id, '_organisation_header_menu_color', true))): ?>
		.nav-link {
			color: <?php echo get_post_meta($organisation_id, '_organisation_header_menu_color', true); ?> !important;
			margin: 0px 10px;
			font-weight: bold;
		}
	
		.navbar-light .navbar-toggler {
			background-color: <?php echo get_post_meta($organisation_id, '_organisation_header_menu_color', true); ?>;
			color: <?php echo get_post_meta($organisation_id, '_organisation_header_menu_color_hover', true); ?>;
			margin-top: -20px;
		}

		.nav-link:hover {
			color: <?php echo get_post_meta($organisation_id, '_organisation_header_menu_color_hover', true); ?>;
		}

		.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
			color: <?php echo get_post_meta($organisation_id, '_organisation_header_menu_color_hover', true); ?>;
			background-color: <?php echo get_post_meta($organisation_id, '_organisation_header_menu_color', true); ?>;
		}
	<?php else: ?>
		.nav-link {
			color: var(--main-color);
		}

		.nav-link:hover {
			color: var(--secondary-color);
		}

		.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
			color: var(--main-button-color-text);
			background-color: var(--main-color);
		}
	<?php endif; ?>

	a.socialmedia-links {
		margin: 5px;
		color: var(--color-text);
		text-decoration: none;
	}

	a.socialmedia-links:hover {
		color: var(--main-color);
	}

	@media (min-width:320px) { 
		.placeholder4 {
			height: 300px; 
		}
	}

	@media (min-width:480px)  { /* smartphones, Android phones, landscape iPhone */ }
	@media (min-width:600px)  { /* portrait tablets, portrait iPad, e-readers (Nook/Kindle), landscape 800x480 phones (Android) */ }
	@media (min-width:801px)  { /* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .placeholder4 {
		height: 190px; 
		} }
	@media (min-width:1281px) { /* hi-res laptops and desktops */ }
	
	/* --------------------------------------------------------------------------------------------- */
	
	img.wp-post-image {
		width: 100%;
		height: auto;
	}

	.woocommerce-product-gallery__image {
		margin-bottom: 20px;
		height: 100%;
	}

	.woocommerce-breadcrumb {
		margin-top: 10px;
		margin-bottom: 20px;
	}

	.woocommerce-breadcrumb a {
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main', true); ?>;
	}

	.woocommerce-breadcrumb a:hover {
		font-weight: 600;
	}

	h1.product_title.entry-title {
		font-size: 40px;
		margin-top: 20px;
		margin-bottom: 5px;
	}

	.price span.woocommerce-Price-amount.amount {
		font-size: 25px;
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main_text', true); ?> !important;
	}

	.price small {
		font-size: 16px;
		color: grey;
	}

	.woocommerce-product-details__short-description {
		font-size: 18px;
		margin-top: 20px;
		margin-bottom: 40px;
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main_text', true); ?> !important;
	}

	table.variations {
		width: 100%;
		margin-bottom: 20px;
	}

	table.variations tbody tr th.label {
		font-size: 16px !important
	}

	table.variations tbody tr td.value select {
		width: 100%;
		padding: 5px;
	}
	
	.single_variation_wrap {
		margin-top: 50px;
	}
	
	div.quantity {
		display: inline-block;
	}
	
	.woocommerce-variation-description {
		display: none;
	}

	.quantity input {
		padding: 8px;
		width: 100%;
	}

	button.single_add_to_cart_button.button.alt.pwp_customizable {
		padding: 10px 20px;
		background-color: <?php echo get_post_meta($organisation_id, '_organisation_color_main', true); ?> !important;
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main_button_text', true); ?> !important;
		border: 1px solid var(--main-button-color-text);
		transition: all 0.5s ease;
		transform: scale(1);
	}

	button.single_add_to_cart_button.button.alt.pwp_customizable:hover {
		transform: scale(1.03) perspective(1px);
	}
	
	button.single_add_to_cart_button.button.alt {
		padding: 10px 20px;
		background-color: <?php echo get_post_meta($organisation_id, '_organisation_color_main', true); ?> !important;
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main_button_text', true); ?> !important;
		border: 1px solid var(--main-button-color-text);
		transition: all 0.5s ease;
		transform: scale(1);
	}

	button.single_add_to_cart_button.button.alt:hover {
		transform: scale(1.03) perspective(1px);
	}

	.product_meta {
		font-size: 16px !important;
		margin-top: 20px;
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main_text', true); ?> !important;
		display: none;
	}

	.product_meta .individual-price, .add-to-cart-price {
		font-size: 16px;
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main_text', true); ?> !important;
	}

	span.sku_wrapper {
		display: block;
	}

	span.posted_in {
		display: block;
	}

	span.posted_in a {
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main', true); ?> !important;
	}

	span.posted_in a:hover {
		font-weight: 600;
	}

	.woocommerce-tabs.wc-tabs-wrapper {
		margin: 30px 0px
	}

	.woocommerce-tabs ul li a {
		background: none;
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main', true); ?> !important;
	}

	.woocommerce-tabs ul li.active a {
		background-color: white !important;
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main', true); ?> !important;
		border: 1px solid <?php echo get_post_meta($organisation_id, '_organisation_color_main', true); ?> !important;
		padding: 10px 20px;
	}

	div.woocommerce-Tabs-panel {
		padding: 20px 0px
	}

	.bi {
		vertical-align: -.125em;
		fill: currentColor;
	}

	.feature-icon {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 4rem;
		height: 4rem;
		margin-bottom: 1rem;
		font-size: 2rem;
		color: #fff;
		border-radius: .75rem;
	}

	.icon-link {
		display: inline-flex;
		align-items: center;
	}
	.icon-link > .bi {
		margin-top: .125rem;
		margin-left: .125rem;
		transition: transform .25s ease-in-out;
		fill: currentColor;
	}
	.icon-link:hover > .bi {
		transform: translate(.25rem);
	}
	
	/* --- WOOCOMMERCE MY ACCOUNT --- */
	
	nav.woocommerce-MyAccount-navigation ul {
		list-style-type: none;
		padding-left: 0;
		font-size: 17px;
		line-height: 35px;
	}

	nav.woocommerce-MyAccount-navigation ul li {
		padding: 8px 20px;
		background-color: rgba(0,0,0,0.05);
		border-bottom: 1px solid rgba(0,0,0,0.05);
	}

	nav.woocommerce-MyAccount-navigation ul li a {
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main', true); ?>;
		text-decoration: none;
	}

	nav.woocommerce-MyAccount-navigation ul li.is-active {
		background-color: <?php echo get_post_meta($organisation_id, '_organisation_color_main', true); ?> !important;
	}

	nav.woocommerce-MyAccount-navigation ul li.is-active a {
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main_button_text', true); ?> !important;
	}
	
	/* --- WOOCOMMERCE --- */
	
	button.woocommerce-Button.button {
		background-color: <?php echo get_post_meta($organisation_id, '_organisation_color_main', true); ?> !important;
		color: <?php echo get_post_meta($organisation_id, '_organisation_color_main_button_text', true); ?> !important;
		transition: all 0.5s ease;
		transform: scale(1);
		margin-top: 20px;
	}

	button.woocommerce-Button.button:hover {
		transform: scale(1.1) perspective(1px)
	}
	
	p.return-to-shop {
		display: none;
	}
	
	@media all and (min-width:100px) and (max-width: 1024px) {
		
		<?php if(is_product() OR is_cart() OR is_checkout()): ?>
		main.container .container {
			min-height: 10px !important;
			margin-bottom: 0px !important;
		}
		
		main.container .container:nth-child(2) {
			padding: 0px 0px !important;
		}
		<?php endif; ?>
		
		main.container {
			background: <?php echo get_post_meta($organisation_id, '_organisation_theme_container_color', true); ?>;
			padding: 20px;
			margin-top: 0px !important;
			margin-bottom: 0px !important;
			border-radius: 0px !important;
		}
		
		
		form.checkout div#customer_details, form.checkout div#customer_details .col-1, form.checkout div#customer_details .col-2 {
			margin-bottom: 50px;
		}
		
		.mobile-p-0 {
			padding: 0px !important;
		}
		
		.jumbotron-left, .jumbotron-right {
			margin-bottom: 1.5rem!important;
			min-height: 130px;
		}
		
		button.single_add_to_cart_button.button.alt.pwp_customizable {
			width: 100%;
			margin-top: 10px;
		}
		
		div.quantity {
			width: 100%;
			margin-top: 10px;
		}
		
		.woocommerce-product-details__short-description {
			margin-bottom: 20px !important;
		}
		
		.nav-link {
			font-size: 18px !important;
			line-height: 26px; !important;
			font-weight: bold;
			margin-bottom: 15px;
			color: <?php echo get_post_meta($organisation_id, '_organisation_header_menu_color_hover', true); ?> !important;
		}
		
		div.navbar-collapse {
			background-color: <?php echo get_post_meta($organisation_id, '_organisation_header_menu_color', true); ?>;
			padding: 20px 10px;
		}
		
		.home-product-image {
			height: 100% !important;
		}
		
		h1 {
			font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading1_font_size', true) / 1.5; ?>px !important;
		}

		h2 {
			font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading2_font_size', true) / 1.5; ?>px !important;
		}

		h3 {
			font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading3_font_size', true) / 1.5; ?>px !important;
		}

		h4 {
			font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading4_font_size', true) / 1.5; ?>px !important;
		}

		h5 {
			font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading5_font_size', true) / 1.5; ?>px !important;
		}

		h6 {
			font-size: <?php echo get_post_meta($organisation_id, '_organisation_heading6_font_size', true) / 1.5; ?>px !important;
		}
	}

</style>