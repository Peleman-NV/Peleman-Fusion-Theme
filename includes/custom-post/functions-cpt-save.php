<?php

// 	Save custom post data from CPT
	add_action( 'save_post', 'save_global_notice_meta_box_data' );
	function save_global_notice_meta_box_data( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['global_notice_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['global_notice_nonce'], 'global_notice_nonce' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}
		else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		/* OK, it's safe for us to save the data now. */
		// Make sure that it is set.
		
		// First we check if the button to import default content is pressed, if not do regular things
		if ( key_exists( 'import-default-content', $_POST ) && $_POST['import-default-content'] == 'Import default theme settings'){
			
				update_post_meta( $post_id, '_organisation_defaultcontent_set', '1' );
			
				// If no posts are found, then look for a default organisation
				$query = new WP_Query( array (
					'post_type'              => array( 'organisation' ),
					'post_status'            => array( 'publish' ),
					'meta_query'             => array(
						array(
							'key'       => '_organisation_default',
							'value'     => '1',
						),
					),
				) );

				if ( $query->have_posts() ) {

					// If there is post, return the ID of post
					while ( $query->have_posts() ) {
						$query->the_post();
						$default_organisation_id = get_the_ID();
						break;
					}

				}else {
					$default_organisation_id = 0;
				}
			
				// Theme
				$organisation_theme = get_post_meta( $default_organisation_id, '_organisation_theme', true );

				// General settings
				$organisation_theme_settings_bg_around = get_post_meta( $default_organisation_id, '_organisation_theme_settings_bg_around', true );
				$organisation_theme_settings_rounded = get_post_meta( $default_organisation_id, '_organisation_theme_settings_rounded', true );

				// Theme colors
				$organisation_theme_body_color = get_post_meta( $default_organisation_id, '_organisation_theme_body_color', true );
				$organisation_theme_container_color = get_post_meta( $default_organisation_id, '_organisation_theme_container_color', true );
				$organisation_color_main = get_post_meta( $default_organisation_id, '_organisation_color_main', true );
				$organisation_color_main_button_text = get_post_meta( $default_organisation_id, '_organisation_color_main_button_text', true );
				$organisation_color_secondary = get_post_meta( $default_organisation_id, '_organisation_color_secondary', true );
				$organisation_color_secondary_button_text = get_post_meta( $default_organisation_id, '_organisation_color_secondary_button_text', true );
				$organisation_color_panel = get_post_meta( $default_organisation_id, '_organisation_color_panel', true );
				$organisation_color_panel_text = get_post_meta( $default_organisation_id, '_organisation_color_panel_text', true );
				$organisation_color_main_text = get_post_meta( $default_organisation_id, '_organisation_color_main_text', true );

				// Background image	
				$organisation_image_background = get_post_meta( $default_organisation_id, '_organisation_image_background', true );
				$organisation_image_background_position = get_post_meta( $default_organisation_id, '_organisation_image_background_position', true );
				$organisation_image_background_size = get_post_meta( $default_organisation_id, '_organisation_image_background_size', true );
				$organisation_image_background_repeat = get_post_meta( $default_organisation_id, '_organisation_image_background_repeat', true );

				// Header
				$organisation_header_title = get_post_meta( $default_organisation_id, '_organisation_header_title', true );
				$organisation_header_subtitle = get_post_meta( $default_organisation_id, '_organisation_header_subtitle', true );
				$organisation_header_logo_width = get_post_meta( $default_organisation_id, '_organisation_header_logo_width', true );
				$organisation_header_menu_color = get_post_meta( $default_organisation_id, '_organisation_header_menu_color', true );
				$organisation_header_menu_color_hover = get_post_meta( $default_organisation_id, '_organisation_header_menu_color_hover', true );
				$organisation_header_min_height = get_post_meta( $default_organisation_id, '_organisation_header_min_height', true );
				$organisation_header_image_background = get_post_meta( $default_organisation_id, '_organisation_header_image_background', true );
				$organisation_header_image_background_position = get_post_meta( $default_organisation_id, '_organisation_header_image_background_position', true );
				$organisation_header_image_background_size = get_post_meta( $default_organisation_id, '_organisation_header_image_background_size', true );
				$organisation_header_image_background_repeat = get_post_meta( $default_organisation_id, '_organisation_header_image_background_repeat', true );

				// Content top - Images in photobook mockup
				$organisation_image_ph_background_color = get_post_meta( $default_organisation_id, '_organisation_image_ph_background_color', true );
				$organisation_image_ph_placeholder_1 = get_post_meta( $default_organisation_id, '_organisation_image_ph_placeholder_1', true );
				$organisation_image_ph_placeholder_1_background_color = get_post_meta( $default_organisation_id, '_organisation_image_ph_placeholder_1_background_color', true );
				$organisation_image_ph_placeholder_1_text = get_post_meta( $default_organisation_id, '_organisation_image_ph_placeholder_1_text', true );
				$organisation_image_ph_placeholder_1_text_color = get_post_meta( $default_organisation_id, '_organisation_image_ph_placeholder_1_text_color', true );
				$organisation_image_ph_placeholder_2 = get_post_meta( $default_organisation_id, '_organisation_image_ph_placeholder_2', true );
				$organisation_image_ph_placeholder_3 = get_post_meta( $default_organisation_id, '_organisation_image_ph_placeholder_3', true );
				$organisation_image_ph_placeholder_4_text = get_post_meta( $default_organisation_id, '_organisation_image_ph_placeholder_4_text', true );
				$organisation_image_ph_placeholder_4_background_color = get_post_meta( $default_organisation_id, '_organisation_image_ph_placeholder_4_background_color', true );
				$organisation_image_ph_placeholder_4_text_color = get_post_meta( $default_organisation_id, '_organisation_image_ph_placeholder_4_text_color', true );

				// Jumbotron
				$organisation_jumbotron_block1_visibility = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block1_visibility', true );
				$organisation_jumbotron_block1_minheight = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block1_minheight', true );
				$organisation_jumbotron_block1_bgcolor = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block1_bgcolor', true );
				$organisation_jumbotron_block1_bgimage = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block1_bgimage', true );
				$organisation_jumbotron_block1_text = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block1_text', true );
				$organisation_jumbotron_block1_text_color = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block1_text_color', true );
				$organisation_jumbotron_block1_button_label = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block1_button_label', true );
				$organisation_jumbotron_block1_button_link = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block1_button_link', true );
				$organisation_jumbotron_block23_minheight = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block23_minheight', true );
				$organisation_jumbotron_block2_bgcolor = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block2_bgcolor', true );
				$organisation_jumbotron_block2_bgimage = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block2_bgimage', true );
				$organisation_jumbotron_block2_text = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block2_text', true );
				$organisation_jumbotron_block2_text_color = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block2_text_color', true );
				$organisation_jumbotron_block3_bgcolor = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block3_bgcolor', true );
				$organisation_jumbotron_block3_bgimage = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block3_bgimage', true );
				$organisation_jumbotron_block3_text = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block3_text', true );
				$organisation_jumbotron_block3_text_color = get_post_meta( $default_organisation_id, '_organisation_jumbotron_block3_text_color', true );

				// Headline
				$organisation_headline_title = get_post_meta( $default_organisation_id, '_organisation_headline_title', true );
				$organisation_headline_subtitle = get_post_meta( $default_organisation_id, '_organisation_headline_subtitle', true );
				$organisation_headline_button_label = get_post_meta( $default_organisation_id, '_organisation_headline_button_label', true );

				// Products block
				$organisation_products_background_color = get_post_meta( $default_organisation_id, '_organisation_products_background_color', true );
				$organisation_products_title = get_post_meta( $default_organisation_id, '_organisation_products_title', true );
				$organisation_products_title_visibility = get_post_meta( $default_organisation_id, '_organisation_products_title_visibility', true );
				$organisation_products_hide_product_titles = get_post_meta( $default_organisation_id, '_organisation_products_hide_product_titles', true );
				$organisation_products_text_color = get_post_meta( $default_organisation_id, '_organisation_products_text_color', true );
				$organisation_products_button_label = get_post_meta( $default_organisation_id, '_organisation_products_button_label', true );

				// Advantage blocks
				$organisation_advantage_1_order = get_post_meta( $default_organisation_id, '_organisation_advantage_1_order', true );
				$organisation_advantage_1_text_left = get_post_meta( $default_organisation_id, '_organisation_advantage_1_text_left', true );
				$organisation_advantage_1_image_right = get_post_meta( $default_organisation_id, '_organisation_advantage_1_image_right', true );
				$organisation_advantage_2_image_left = get_post_meta( $default_organisation_id, '_organisation_advantage_2_image_left', true );
				$organisation_advantage_2_text_right = get_post_meta( $default_organisation_id, '_organisation_advantage_2_text_right', true );
				$organisation_advantage_3_text_left = get_post_meta( $default_organisation_id, '_organisation_advantage_3_text_left', true );
				$organisation_advantage_3_image_right = get_post_meta( $default_organisation_id, '_organisation_advantage_3_image_right', true );

				// Free Content Block
				$organisation_freeblock_title = get_post_meta( $default_organisation_id, '_organisation_freeblock_title', true );
				$organisation_freeblock_content = get_post_meta( $default_organisation_id, '_organisation_freeblock_content', true );
				$organisation_freeblock_image = get_post_meta( $default_organisation_id, '_organisation_freeblock_image', true );
				$organisation_freeblock_button_label = get_post_meta( $default_organisation_id, '_organisation_freeblock_button_label', true );
				$organisation_freeblock_button_url = get_post_meta( $default_organisation_id, '_organisation_freeblock_button_url', true );

				// Footer
				$organisation_footer_block1_title = get_post_meta( $default_organisation_id, '_organisation_footer_block1_title', true );
				$organisation_footer_block1_content = get_post_meta( $default_organisation_id, '_organisation_footer_block1_content', true );
		
		}else {
			
			// 	VARIABLES TO USE LATER TO UPDATE META
			
				// Theme
				$organisation_theme = sanitize_text_field( $_POST['organisation_theme'] );

				// General settings
				$organisation_theme_settings_bg_around = sanitize_text_field( $_POST['organisation_theme_settings_bg_around'] );
				$organisation_theme_settings_rounded = sanitize_text_field( $_POST['organisation_theme_settings_rounded'] );

				// Theme colors
				$organisation_theme_body_color = sanitize_text_field( $_POST['organisation_theme_body_color'] );
				$organisation_theme_container_color = sanitize_text_field( $_POST['organisation_theme_container_color'] );
				$organisation_color_main = sanitize_text_field( $_POST['organisation_color_main'] );
				$organisation_color_main_button_text = sanitize_text_field( $_POST['organisation_color_main_button_text'] );
				$organisation_color_secondary = sanitize_text_field( $_POST['organisation_color_secondary'] );
				$organisation_color_secondary_button_text = sanitize_text_field( $_POST['organisation_color_secondary_button_text'] );
				$organisation_color_panel = sanitize_text_field( $_POST['organisation_color_panel'] );
				$organisation_color_panel_text = sanitize_text_field( $_POST['organisation_color_panel_text'] );
				$organisation_color_main_text = sanitize_text_field( $_POST['organisation_color_main_text'] );
			
				// Background image	
				$organisation_image_background = sanitize_text_field( $_POST['organisation_image_background'] );
				$organisation_image_background_position = sanitize_text_field( $_POST['organisation_image_background_position'] );
				$organisation_image_background_size = sanitize_text_field( $_POST['organisation_image_background_size'] );
				$organisation_image_background_repeat = sanitize_text_field( $_POST['organisation_image_background_repeat'] );
			
				// Header
				$organisation_header_title = sanitize_text_field( $_POST['organisation_header_title'] );
				$organisation_header_subtitle = sanitize_text_field( $_POST['organisation_header_subtitle'] );
				$organisation_header_logo_width = sanitize_text_field( $_POST['organisation_header_logo_width'] );
				$organisation_header_menu_color = sanitize_text_field( $_POST['organisation_header_menu_color'] );
				$organisation_header_menu_color_hover = sanitize_text_field( $_POST['organisation_header_menu_color_hover'] );
				$organisation_header_min_height = sanitize_text_field( $_POST['organisation_header_min_height'] );
				$organisation_header_image_background = sanitize_text_field( $_POST['organisation_header_image_background'] );
				$organisation_header_image_background_position = sanitize_text_field( $_POST['organisation_header_image_background_position'] );
				$organisation_header_image_background_size = sanitize_text_field( $_POST['organisation_header_image_background_size'] );
				$organisation_header_image_background_repeat = sanitize_text_field( $_POST['organisation_header_image_background_repeat'] );
			
				// Content top - Images in photobook mockup
				$organisation_image_ph_background_color = sanitize_text_field( $_POST['organisation_image_ph_background_color'] );
				$organisation_image_ph_placeholder_1 = sanitize_text_field( $_POST['organisation_image_ph_placeholder_1'] );
				$organisation_image_ph_placeholder_1_background_color = sanitize_text_field( $_POST['organisation_image_ph_placeholder_1_background_color'] );
				$organisation_image_ph_placeholder_1_text = sanitize_text_field( $_POST['organisation_image_ph_placeholder_1_text'] );
				$organisation_image_ph_placeholder_1_text_color = sanitize_text_field( $_POST['organisation_image_ph_placeholder_1_text_color'] );
				$organisation_image_ph_placeholder_2 = sanitize_text_field( $_POST['organisation_image_ph_placeholder_2'] );
				$organisation_image_ph_placeholder_3 = sanitize_text_field( $_POST['organisation_image_ph_placeholder_3'] );
				$organisation_image_ph_placeholder_4_text = sanitize_text_field( $_POST['organisation_image_ph_placeholder_4_text'] );
				$organisation_image_ph_placeholder_4_background_color = sanitize_text_field( $_POST['organisation_image_ph_placeholder_4_background_color'] );
				$organisation_image_ph_placeholder_4_text_color = sanitize_text_field( $_POST['organisation_image_ph_placeholder_4_text_color'] );
			
				// Jumbotron
				$organisation_jumbotron_block1_visibility = sanitize_text_field( $_POST['organisation_jumbotron_block1_visibility'] );
				$organisation_jumbotron_block1_minheight = sanitize_text_field( $_POST['organisation_jumbotron_block1_minheight'] );
				$organisation_jumbotron_block1_bgcolor = sanitize_text_field( $_POST['organisation_jumbotron_block1_bgcolor'] );
				$organisation_jumbotron_block1_bgimage = sanitize_text_field( $_POST['organisation_jumbotron_block1_bgimage'] );
				$organisation_jumbotron_block1_text = $_POST['organisation_jumbotron_block1_text'];
				$organisation_jumbotron_block1_text_color = sanitize_text_field( $_POST['organisation_jumbotron_block1_text_color'] );
				$organisation_jumbotron_block1_button_label = sanitize_text_field( $_POST['organisation_jumbotron_block1_button_label'] );
				$organisation_jumbotron_block1_button_link = sanitize_text_field( $_POST['organisation_jumbotron_block1_button_link'] );
				$organisation_jumbotron_block23_minheight = sanitize_text_field( $_POST['organisation_jumbotron_block23_minheight'] );
				$organisation_jumbotron_block2_bgcolor = sanitize_text_field( $_POST['organisation_jumbotron_block2_bgcolor'] );
				$organisation_jumbotron_block2_bgimage = sanitize_text_field( $_POST['organisation_jumbotron_block2_bgimage'] );
				$organisation_jumbotron_block2_text = $_POST['organisation_jumbotron_block2_text'];
				$organisation_jumbotron_block2_text_color = sanitize_text_field( $_POST['organisation_jumbotron_block2_text_color'] );
				$organisation_jumbotron_block3_bgcolor = sanitize_text_field( $_POST['organisation_jumbotron_block3_bgcolor'] );
				$organisation_jumbotron_block3_bgimage = sanitize_text_field( $_POST['organisation_jumbotron_block3_bgimage'] );
				$organisation_jumbotron_block3_text = $_POST['organisation_jumbotron_block3_text'];
				$organisation_jumbotron_block3_text_color = sanitize_text_field( $_POST['organisation_jumbotron_block3_text_color'] );
			
				// Headline
				$organisation_headline_title = sanitize_text_field( $_POST['organisation_headline_title'] );
				$organisation_headline_subtitle = sanitize_text_field( $_POST['organisation_headline_subtitle'] );
				$organisation_headline_button_label = sanitize_text_field( $_POST['organisation_headline_button_label'] );
			
				// Products block
				$organisation_products_background_color = sanitize_text_field( $_POST['organisation_products_background_color'] );
				$organisation_products_title = sanitize_text_field( $_POST['organisation_products_title'] );
				$organisation_products_title_visibility = sanitize_text_field( $_POST['organisation_products_title_visibility'] );
				$organisation_products_hide_product_titles = sanitize_text_field( $_POST['organisation_products_hide_product_titles'] );
				$organisation_products_text_color = sanitize_text_field( $_POST['organisation_products_text_color'] );
				$organisation_products_button_label = sanitize_text_field( $_POST['organisation_products_button_label'] );
				
				// Advantage blocks
				$organisation_advantage_1_order = $_POST['organisation_advantage_1_order'];
				$organisation_advantage_1_text_left = $_POST['organisation_advantage_1_text_left'];
				$organisation_advantage_1_image_right = sanitize_text_field( $_POST['organisation_advantage_1_image_right'] );
				$organisation_advantage_2_image_left = sanitize_text_field( $_POST['organisation_advantage_2_image_left'] );
				$organisation_advantage_2_text_right = $_POST['organisation_advantage_2_text_right'];
				$organisation_advantage_3_text_left = $_POST['organisation_advantage_3_text_left'];
				$organisation_advantage_3_image_right = sanitize_text_field( $_POST['organisation_advantage_3_image_right'] );
			
				// Free Content Block
				$organisation_freeblock_title = sanitize_text_field( $_POST['organisation_freeblock_title'] );
				$organisation_freeblock_content = $_POST['organisation_freeblock_content'];
				$organisation_freeblock_image = $_POST['organisation_freeblock_image'];
				$organisation_freeblock_button_label = sanitize_text_field( $_POST['organisation_freeblock_button_label'] );
				$organisation_freeblock_button_url = sanitize_text_field( $_POST['organisation_freeblock_button_url'] );
			
				// Footer
				$organisation_footer_block1_title = sanitize_text_field( $_POST['organisation_footer_block1_title'] );
				$organisation_footer_block1_content = $_POST['organisation_footer_block1_content'];
			
			//	--------------------------------------------------------------------------------------------------------------------------	
			
		}
		
		// 	ORGANISATION
				
			// Organisation details
			update_post_meta( $post_id, '_organisation_name', sanitize_text_field( $_POST['organisation_name'] ) );
			update_post_meta( $post_id, '_organisation_email', sanitize_text_field( $_POST['organisation_email'] ) );
			update_post_meta( $post_id, '_organisation_phone', sanitize_text_field( $_POST['organisation_phone'] ) );

			// Organisation address
			update_post_meta( $post_id, '_organisation_address_1', sanitize_text_field( $_POST['organisation_address_1'] ) );
			update_post_meta( $post_id, '_organisation_postal', sanitize_text_field( $_POST['organisation_postal'] ) );
			update_post_meta( $post_id, '_organisation_city', sanitize_text_field( $_POST['organisation_city'] ) );
			update_post_meta( $post_id, '_organisation_state', sanitize_text_field( $_POST['organisation_state'] ) );
			update_post_meta( $post_id, '_organisation_country', sanitize_text_field( $_POST['organisation_country'] ) );

			// Social media
			update_post_meta( $post_id, '_organisation_social_facebook', sanitize_text_field( $_POST['organisation_social_facebook'] ) );
			update_post_meta( $post_id, '_organisation_social_instagram', sanitize_text_field( $_POST['organisation_social_instagram'] ) );
			update_post_meta( $post_id, '_organisation_social_linkedin', sanitize_text_field( $_POST['organisation_social_linkedin'] ) );

		//	--------------------------------------------------------------------------------------------------------------------------	

		//	LOGO

			// Logo
			update_post_meta( $post_id, '_organisation_logo_favicon', sanitize_text_field( $_POST['organisation_logo_favicon'] ) );
			update_post_meta( $post_id, '_organisation_logo_color', sanitize_text_field( $_POST['organisation_logo_color'] ) );
			update_post_meta( $post_id, '_organisation_logo_bw', sanitize_text_field( $_POST['organisation_logo_bw'] ) );

		//	--------------------------------------------------------------------------------------------------------------------------

		//	PRODUCTS

			// Products
			update_post_meta( $post_id, '_organisation_products', $_POST['organisation_products'] );
			if(!empty($_POST['organisation_products_custom_images'])){
				update_post_meta( $post_id, '_organisation_products_custom_images', $_POST['organisation_products_custom_images'] );
			}

		//	--------------------------------------------------------------------------------------------------------------------------

		//	THEME DESIGN

			// Theme
			update_post_meta( $post_id, '_organisation_theme', $organisation_theme );

			// General settings
			update_post_meta( $post_id, '_organisation_theme_settings_bg_around', $organisation_theme_settings_bg_around );
			update_post_meta( $post_id, '_organisation_theme_settings_rounded', $organisation_theme_settings_rounded );

			// Theme colors
			update_post_meta( $post_id, '_organisation_theme_body_color', $organisation_theme_body_color );
			update_post_meta( $post_id, '_organisation_theme_container_color', $organisation_theme_container_color );
			update_post_meta( $post_id, '_organisation_color_main', $organisation_color_main );
			update_post_meta( $post_id, '_organisation_color_main_button_text', $organisation_color_main_button_text );
			update_post_meta( $post_id, '_organisation_color_secondary', $organisation_color_secondary );
			update_post_meta( $post_id, '_organisation_color_secondary_button_text', $organisation_color_secondary_button_text );
			update_post_meta( $post_id, '_organisation_color_panel', $organisation_color_panel );
			update_post_meta( $post_id, '_organisation_color_panel_text', $organisation_color_panel_text );
			update_post_meta( $post_id, '_organisation_color_main_text', $organisation_color_main_text );

			// Background image
			update_post_meta( $post_id, '_organisation_image_background', $organisation_image_background );
			update_post_meta( $post_id, '_organisation_image_background_position', $organisation_image_background_position );
			update_post_meta( $post_id, '_organisation_image_background_size', $organisation_image_background_size );
			update_post_meta( $post_id, '_organisation_image_background_repeat', $organisation_image_background_repeat );

			// Header
			update_post_meta( $post_id, '_organisation_header_title', $organisation_header_title );
			update_post_meta( $post_id, '_organisation_header_subtitle', $organisation_header_subtitle );
			update_post_meta( $post_id, '_organisation_header_logo_width', $organisation_header_logo_width );
			update_post_meta( $post_id, '_organisation_header_menu_color', $organisation_header_menu_color );
			update_post_meta( $post_id, '_organisation_header_menu_color_hover', $organisation_header_menu_color_hover );
			update_post_meta( $post_id, '_organisation_header_min_height', $organisation_header_min_height );
			update_post_meta( $post_id, '_organisation_header_image_background', $organisation_header_image_background );
			update_post_meta( $post_id, '_organisation_header_image_background_position', $organisation_header_image_background_position );
			update_post_meta( $post_id, '_organisation_header_image_background_size', $organisation_header_image_background_size );
			update_post_meta( $post_id, '_organisation_header_image_background_repeat', $organisation_header_image_background_repeat );

			// Content top - Images in photobook mockup
			update_post_meta( $post_id, '_organisation_image_ph_background_color', $organisation_image_ph_background_color );
			update_post_meta( $post_id, '_organisation_image_ph_placeholder_1', $organisation_image_ph_placeholder_1 );
			update_post_meta( $post_id, '_organisation_image_ph_placeholder_1_background_color', $organisation_image_ph_placeholder_1_background_color );
			update_post_meta( $post_id, '_organisation_image_ph_placeholder_1_text', $organisation_image_ph_placeholder_1_text );
			update_post_meta( $post_id, '_organisation_image_ph_placeholder_1_text_color', $organisation_image_ph_placeholder_1_text_color );
			update_post_meta( $post_id, '_organisation_image_ph_placeholder_2', $organisation_image_ph_placeholder_2 );
			update_post_meta( $post_id, '_organisation_image_ph_placeholder_3', $organisation_image_ph_placeholder_3 );
			update_post_meta( $post_id, '_organisation_image_ph_placeholder_4_text', $organisation_image_ph_placeholder_4_text );
			update_post_meta( $post_id, '_organisation_image_ph_placeholder_4_background_color', $organisation_image_ph_placeholder_4_background_color );
			update_post_meta( $post_id, '_organisation_image_ph_placeholder_4_text_color', $organisation_image_ph_placeholder_4_text_color );

			// Jumbotron
			update_post_meta( $post_id, '_organisation_jumbotron_block1_visibility', $organisation_jumbotron_block1_visibility );
			update_post_meta( $post_id, '_organisation_jumbotron_block1_minheight', $organisation_jumbotron_block1_minheight );
			update_post_meta( $post_id, '_organisation_jumbotron_block1_bgcolor', $organisation_jumbotron_block1_bgcolor );
			update_post_meta( $post_id, '_organisation_jumbotron_block1_bgimage', $organisation_jumbotron_block1_bgimage );
			update_post_meta( $post_id, '_organisation_jumbotron_block1_text', $organisation_jumbotron_block1_text );
			update_post_meta( $post_id, '_organisation_jumbotron_block1_text_color', $organisation_jumbotron_block1_text_color );
			update_post_meta( $post_id, '_organisation_jumbotron_block1_button_label', $organisation_jumbotron_block1_button_label );
			update_post_meta( $post_id, '_organisation_jumbotron_block1_button_link', $organisation_jumbotron_block1_button_link );
			update_post_meta( $post_id, '_organisation_jumbotron_block23_minheight', $organisation_jumbotron_block23_minheight );
			update_post_meta( $post_id, '_organisation_jumbotron_block2_bgcolor', $organisation_jumbotron_block2_bgcolor );
			update_post_meta( $post_id, '_organisation_jumbotron_block2_bgimage', $organisation_jumbotron_block2_bgimage );
			update_post_meta( $post_id, '_organisation_jumbotron_block2_text', $organisation_jumbotron_block2_text );
			update_post_meta( $post_id, '_organisation_jumbotron_block2_text_color', $organisation_jumbotron_block2_text_color );
			update_post_meta( $post_id, '_organisation_jumbotron_block3_bgcolor', $organisation_jumbotron_block3_bgcolor );
			update_post_meta( $post_id, '_organisation_jumbotron_block3_bgimage', $organisation_jumbotron_block3_bgimage );
			update_post_meta( $post_id, '_organisation_jumbotron_block3_text', $organisation_jumbotron_block3_text );
			update_post_meta( $post_id, '_organisation_jumbotron_block3_text_color', $organisation_jumbotron_block3_text_color );

			// Headline
			update_post_meta( $post_id, '_organisation_headline_title', $organisation_headline_title );
			update_post_meta( $post_id, '_organisation_headline_subtitle', $organisation_headline_subtitle );
			update_post_meta( $post_id, '_organisation_headline_button_label', $organisation_headline_button_label );

			// Products block
			update_post_meta( $post_id, '_organisation_products_background_color', $organisation_products_background_color );
			update_post_meta( $post_id, '_organisation_products_title', $organisation_products_title );
			update_post_meta( $post_id, '_organisation_products_title_visibility', $organisation_products_title_visibility );
			update_post_meta( $post_id, '_organisation_products_hide_product_titles', $organisation_products_hide_product_titles );
			update_post_meta( $post_id, '_organisation_products_text_color', $organisation_products_text_color );
			update_post_meta( $post_id, '_organisation_products_button_label', $organisation_products_button_label );

			// Advantage blocks
			update_post_meta( $post_id, '_organisation_advantage_1_order', $organisation_advantage_1_order );
			update_post_meta( $post_id, '_organisation_advantage_1_text_left', $organisation_advantage_1_text_left );
			update_post_meta( $post_id, '_organisation_advantage_1_image_right', $organisation_advantage_1_image_right );
			update_post_meta( $post_id, '_organisation_advantage_2_image_left', $organisation_advantage_2_image_left );
			update_post_meta( $post_id, '_organisation_advantage_2_text_right', $organisation_advantage_2_text_right );
			update_post_meta( $post_id, '_organisation_advantage_3_text_left', $organisation_advantage_3_text_left );
			update_post_meta( $post_id, '_organisation_advantage_3_image_right', $organisation_advantage_3_image_right );

			// Free Content Block
			update_post_meta( $post_id, '_organisation_freeblock_title', $organisation_freeblock_title );
			update_post_meta( $post_id, '_organisation_freeblock_content', $organisation_freeblock_content );
			update_post_meta( $post_id, '_organisation_freeblock_image', $organisation_freeblock_image );
			update_post_meta( $post_id, '_organisation_freeblock_button_label', $organisation_freeblock_button_label );
			update_post_meta( $post_id, '_organisation_freeblock_button_url', $organisation_freeblock_button_url );

			// Footer
			update_post_meta( $post_id, '_organisation_footer_block1_title', $organisation_footer_block1_title );
			update_post_meta( $post_id, '_organisation_footer_block1_content', $organisation_footer_block1_content );

		//	--------------------------------------------------------------------------------------------------------------------------

		// 	TYPOGRAPHY

			// Paragraphs - Body text
			update_post_meta( $post_id, '_organisation_paragraph_font_size', sanitize_text_field( $_POST['organisation_paragraph_font_size'] ) );
			update_post_meta( $post_id, '_organisation_paragraph_line_height', sanitize_text_field( $_POST['organisation_paragraph_line_height'] ) );
			update_post_meta( $post_id, '_organisation_paragraph_font', sanitize_text_field( $_POST['organisation_paragraph_font'] ) );
			update_post_meta( $post_id, '_organisation_paragraph_font_weight', sanitize_text_field( $_POST['organisation_paragraph_font_weight'] ) );

			// Heading font
			update_post_meta( $post_id, '_organisation_heading_font', sanitize_text_field( $_POST['organisation_heading_font'] ) );
			update_post_meta( $post_id, '_organisation_heading_font_weight', sanitize_text_field( $_POST['organisation_heading_font_weight'] ) );

			// Heading 1
			update_post_meta( $post_id, '_organisation_heading1_font_size', sanitize_text_field( $_POST['organisation_heading1_font_size'] ) );
			update_post_meta( $post_id, '_organisation_heading1_margin_bottom', sanitize_text_field( $_POST['organisation_heading1_margin_bottom'] ) );

			// Heading 2
			update_post_meta( $post_id, '_organisation_heading2_font_size', sanitize_text_field( $_POST['organisation_heading2_font_size'] ) );
			update_post_meta( $post_id, '_organisation_heading2_margin_bottom', sanitize_text_field( $_POST['organisation_heading2_margin_bottom'] ) );

			// Heading 3
			update_post_meta( $post_id, '_organisation_heading3_font_size', sanitize_text_field( $_POST['organisation_heading3_font_size'] ) );
			update_post_meta( $post_id, '_organisation_heading3_margin_bottom', sanitize_text_field( $_POST['organisation_heading3_margin_bottom'] ) );

			// Heading 4
			update_post_meta( $post_id, '_organisation_heading4_font_size', sanitize_text_field( $_POST['organisation_heading4_font_size'] ) );
			update_post_meta( $post_id, '_organisation_heading4_margin_bottom', sanitize_text_field( $_POST['organisation_heading4_margin_bottom'] ) );

			// Heading 5
			update_post_meta( $post_id, '_organisation_heading5_font_size', sanitize_text_field( $_POST['organisation_heading5_font_size'] ) );
			update_post_meta( $post_id, '_organisation_heading5_margin_bottom', sanitize_text_field( $_POST['organisation_heading5_margin_bottom'] ) );

			// Heading 6
			update_post_meta( $post_id, '_organisation_heading6_font_size', sanitize_text_field( $_POST['organisation_heading6_font_size'] ) );
			update_post_meta( $post_id, '_organisation_heading6_margin_bottom', sanitize_text_field( $_POST['organisation_heading6_margin_bottom'] ) );

		//	--------------------------------------------------------------------------------------------------------------------------

		//	ADVANCED
			// Tracking codes
			update_post_meta( $post_id, '_organisation_tag_ga4', sanitize_text_field( $_POST['organisation_tag_ga4'] ) );
			update_post_meta( $post_id, '_organisation_tag_hotjar', sanitize_text_field( $_POST['organisation_tag_hotjar'] ) );
			update_post_meta( $post_id, '_organisation_tag_other', $_POST['organisation_tag_other'] );
		
		//	--------------------------------------------------------------------------------------------------------------------------

		//	ADMINISTRATOR OPTIONS
			
			if(isset($_POST['organisation_default'])){
				update_post_meta( $post_id, '_organisation_default', $_POST['organisation_default'] );
				update_post_meta( $post_id, '_organisation_default_color_panel', $_POST['organisation_default_color_panel'] );
				update_post_meta( $post_id, '_organisation_default_color_panel_text', $_POST['organisation_default_color_panel_text'] );
			}else {
				update_post_meta( $post_id, '_organisation_default', '0' );
			}
		
			update_post_meta( $post_id, '_organisation_orders_visibility', $_POST['organisation_orders_visibility'] );
			update_post_meta( $post_id, '_organisation_orders_cust_visibility', $_POST['organisation_orders_cust_visibility'] );

		//	--------------------------------------------------------------------------------------------------------------------------

		// 	IMAGE EDITOR

			// Organisation ID
			if(!empty(get_post_meta( $post_id, '_organisation_editor_id', true )) && !empty(get_post_meta( $post_id, '_organisation_apikey', true ))){
				$action = 'update';
			}else {
				update_post_meta( $post_id, '_organisation_editor_id', get_post_field( 'post_name', $post_id ) );
				$action = 'create';
			}
		
// 			update_post_meta( $post_id, '_organisation_editor_id', get_post_field( 'post_name', $post_id ) );
// 			$action = 'create';
		
			// Create organisation in editor
			$url = apply_filters('get_editor_environment', 'environment') . '/editor/api/organisationAPI.php';
			$customerapikey = apply_filters('get_editor_environment', 'apikey');
			$organisationid = get_post_field( 'post_name', $post_id );
			$organisationname = get_post_meta($post_id, '_organisation_name', true);
			$colors = [get_post_meta($post_id, '_organisation_color_main', true)];
			$logo = wp_get_attachment_image_url( get_post_meta( $post_id, '_organisation_logo_color', true ), 'full' );	
			$usedtemplates = 'tpl458949,tpl395768,tpl460399,tpl593779';

			// Get API key from editor and save to _organisation_apikey
			$apikey = apply_filters( 'pf_pie_organisation_creation', $url, $customerapikey, $organisationid, $organisationname, $colors, $logo, $usedtemplates, $action);
			if(empty(get_post_meta( $post_id, '_organisation_apikey', true ))){
				$apikey = json_decode($apikey);
				update_post_meta( $post_id, '_organisation_apikey', $apikey->apiKey );
			}
		
// 			update_post_meta( $post_id, '_organisation_editor_id', get_post_field( 'post_name', $post_id ) );
// 			update_post_meta( $post_id, '_organisation_apikey', $_POST['organisation_apikey'] );
// 			$apikey = json_decode($apikey);
// 			update_post_meta( $post_id, '_organisation_apikey', $apikey->apiKey );

		//	--------------------------------------------------------------------------------------------------------------------------

		// update_post_meta( $post_id, '_organisation_color_background', sanitize_text_field( $_POST['organisation_color_background'] ) );
		// update_post_meta( $post_id, '_organisation_color_menu', sanitize_text_field( $_POST['organisation_color_menu'] ) );
	}