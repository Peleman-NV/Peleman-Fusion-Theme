<?php

//	Include all functions related to Custom Post
	include_once('functions-cpt-meta.php');
	include_once('functions-cpt-save.php');

//	Create a custom post and define arguments
	add_action( 'init', 'pf_add_custom_post_type', 0 );
	function pf_add_custom_post_type() {
		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Organisations - Landing Pages', 'Post Type General Name', 'peleman-fusion' ),
			'singular_name'       => _x( 'Organisation - Landing Page', 'Post Type Singular Name', 'peleman-fusion' ),
			'menu_name'           => __( 'Landing Pages', 'peleman-fusion' ),
			'parent_item_colon'   => __( 'Parent Organisation Landing Page', 'peleman-fusion' ),
			'all_items'           => __( 'View all', 'peleman-fusion' ),
			'view_item'           => __( 'View organisation', 'peleman-fusion' ),
			'add_new_item'        => __( 'Add new organisation', 'peleman-fusion' ),
			'add_new'             => __( 'Add new', 'peleman-fusion' ),
			'edit_item'           => __( 'Edit', 'peleman-fusion' ),
			'update_item'         => __( 'Update', 'peleman-fusion' ),
			'search_items'        => __( 'Search', 'peleman-fusion' ),
			'not_found'           => __( 'Not Found', 'peleman-fusion' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'peleman-fusion' ),
		);
      
		// Set other options for Custom Post Type
		$args = array(
			'label'               	=> __( 'Organisations', 'peleman-fusion' ),
			'description'         	=> __( 'Organisations - Landing Pages', 'peleman-fusion' ),
			'labels'              	=> $labels,
			'supports'            	=> array( 'title', 'author'),
			'hierarchical'        	=> false,
			'public'              	=> true,
			'show_ui'             	=> true,
			'show_in_menu'        	=> true,
			'show_in_nav_menus'   	=> true,
			'show_in_admin_bar'   	=> false,
			'menu_position'       	=> 2,
			'can_export'          	=> false,
			'has_archive'         	=> true,
			'exclude_from_search' 	=> true,
			'publicly_queryable'  	=> true,
			'capability_type'     	=> 'post',
			'show_in_rest' 			=> false,
			'menu_icon' => 'dashicons-database'
		);

		// Registering your Custom Post Type
		register_post_type( 'organisation', $args );
	}

//	Create action for creating organisation in PIE
	add_filter( 'pf_pie_organisation_creation', 'pf_pie_organisation_creation_callback', 10, 8 );
	function pf_pie_organisation_creation_callback($url, $customerapikey, $organisationid, $organisationname, $colors, $logo, $usedtemplates, $action) {		
		$data = [
			'action' => $action,
			'customerapikey' => $customerapikey,
			'organisationid' => $organisationid,
			'organisationname' => $organisationname,
			'colors' => $colors,
			'logourl' => $logo,
			'usedtemplates' => $usedtemplates
		];
		
		$options = [
			'http' => [
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data),
			],
		];

		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		
		return $result;
	}

//	Create action for query GET organisationid
	add_filter( 'pf_query_get_organisation_id', 'pf_query_get_organisation_id_callback', 10, 1 );
	function pf_query_get_organisation_id_callback($_organisation_editor_id) {		
		// Build a query and search an organisation with organisation_editor_id
		$query = new WP_Query( array (
			'post_type'              => array( 'organisation' ),
			'post_status'            => array( 'publish' ),
			'meta_query'             => array(
				array(
					'key'       => '_organisation_editor_id',
					'value'     => $_organisation_editor_id,
				),
			),
		) );

		// Loop over the query and see if there is a post that matches
		if ( $query->have_posts() ) {

			// If there is post, return the ID of post
			while ( $query->have_posts() ) {
				$query->the_post();
				return get_the_ID();

				break;
			}

		}else {

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
					return get_the_ID();
					break;
				}

			}else {
				return 0;
			}

			// Restore original Post Data
			wp_reset_postdata();

		}

		// Restore original Post Data
		wp_reset_postdata();
	}

// 	Reorder & add the custom columns to the book post type:
	add_filter( 'manage_organisation_posts_columns', 'set_custom_edit_organisation_columns' );
	function set_custom_edit_organisation_columns($columns) {
		unset($columns['title']);
		unset($columns['date']);
		unset($columns['author']);

		return array_merge ( $columns, array ( 
			'logo' => __ ( 'Logo' ),
			'title' => __ ('Organisation Name'),
			'defaultorg' => __ ('Default organisation'),
			'organisation_id' => __ ( 'Organisation ID' ),
			'pie_editor' => __ ('Manage custom content'),
			'products' => __ ( 'Products' ),
			'author' => __ ( 'Author' ),
			'date' => __('Date')
		) );
	}

// 	Add the data to the custom columns for the book post type:
	add_action( 'manage_organisation_posts_custom_column' , 'custom_organisation_column', 10, 2 );
	function custom_organisation_column( $column, $post_id ) {
		switch ( $column ) {

			case 'defaultorg' :
				if(get_post_meta( $post_id , '_organisation_default' , true ) == '1'){
					echo '<a class="button"  style="color: #424b54 !important; background-color: #CCE5FF !important;" href="#" disabled>Default organisation</a>';
				}
				break;
				
			case 'pie_editor' :
				if ( get_post_status ( $post_id ) == 'publish' ) {
					echo '<a href="' . apply_filters('get_editor_environment', 'environment') . '/editor/dashboard/vieworganisation.php?a='.get_post_meta( $post_id, '_organisation_apikey', true ).'" target="_blank" class="button button-primary">Manage custom content</a>';
				}
				break;
			
			case 'theme' :
				echo get_post_meta( $post_id , '_organisation_theme' , true ); 
				break;

			case 'products' :
				if(!empty(get_post_meta( $post_id , '_organisation_products' , true ))){
					echo count(get_post_meta( $post_id , '_organisation_products' , true )) . ' products'; 
				}else {
					echo 'No products';
				}

				break;

			case 'logo' :
				if(!empty(get_post_meta( $post_id , '_organisation_logo_color' , true ))){
					echo '<img width="100px" src="' . wp_get_attachment_image_url( get_post_meta( $post_id, '_organisation_logo_color', true ), 'full' ) . '">';
				}
				break;

			case 'organisation_id' :
				if(!empty(get_post_meta( $post_id , '_organisation_editor_id' , true ))){
					echo get_post_meta( $post_id , '_organisation_editor_id' , true ); 
				}
				break;

		}
	}

