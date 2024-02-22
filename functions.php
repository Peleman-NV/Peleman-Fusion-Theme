<?php

// 	Add CSS and JS files to load
	add_action('wp_enqueue_scripts', 'pelemanfusion_enqueue_styles_scripts');
	function pelemanfusion_enqueue_styles_scripts() {
		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', ''); // BOOTSTRAP FRAMEWORK
		wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css', ''); // BOOTSTRAP ICONS
		wp_enqueue_style('style', get_stylesheet_uri(), array()); // CUSTOM CSS

		wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.1.js', false); // JQUERY
		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), '4.5.3', true); // BOOTSTRAP JS
	}

//	Add admin scripts & styles
	add_action( 'admin_enqueue_scripts', 'pelemanfusion_enqueue_admin_styles_scripts' );
	function pelemanfusion_enqueue_admin_styles_scripts() {
		wp_enqueue_style('wp-color-picker'); // COLOR PICKER

		if (!did_action( 'wp_enqueue_media' )) {
			wp_enqueue_media(); // MEDIA UPLOAD
		}
		
		wp_enqueue_script('mishaupload', get_template_directory_uri().'/assets/js/admin-script.js', array( 'jquery','media-upload','thickbox','wp-color-picker' ), wp_rand(1, 99999999999));
		wp_enqueue_style('style', get_stylesheet_uri(), array()); // CUSTOM CSS
	}

// 	Include functions
	include_once('includes/functions-general.php');
	include_once('includes/custom-post/functions-cpt-general.php');
	include_once('includes/woocommerce/functions-wc-general.php');

//	Give additional rights to organisation editor to translate organisation
	add_filter('wpml_override_is_translator', function ($is_translator, $user_id, $args){
		$user = get_user_by('id', $user_id);

		if (in_array('organisation-editor', (array) $user->roles, true)) {
			return true;
		}

		return $is_translator;
	}, 10, 3);

//	reload for checkout
	add_action('wp_footer', 'woocommerce_custom_update_checkout', 50);
	function woocommerce_custom_update_checkout()
	{
		if (is_cart()) {
			?>
				<script type="text/javascript">
					jQuery( document.body ).on( 'applied_coupon_in_checkout removed_coupon_in_checkout', function () {
    					location.reload();
					} );
				</script>

			<?php
		}
	}

//	Only get own posts
	add_action( 'pre_get_posts', 'filter_cpt_listing_by_author_wpse_89233' );
	function filter_cpt_listing_by_author_wpse_89233( $wp_query_obj ) 
	{
		// Front end, do nothing
		if( !is_admin() )
			return;

		global $current_user, $pagenow;
		wp_get_current_user();

		// http://php.net/manual/en/function.is-a.php
		if( !is_a( $current_user, 'WP_User') )
			return;

		// Not the correct screen, bail out
		if( 'edit.php' != $pagenow )
			return;

		// Not the correct post type, bail out
		if( 'organisation' != $wp_query_obj->query['post_type'] )
			return;

		// If the user is not administrator, filter the post listing
		if( !current_user_can( 'delete_plugins' ) )
			$wp_query_obj->set('author', $current_user->ID );
	}

//	Only get own media
	add_action('pre_get_posts','users_own_attachments');
	function users_own_attachments( $wp_query_obj ) {

		global $current_user, $pagenow;

		$is_attachment_request = ($wp_query_obj->get('post_type')=='attachment');

		if( !$is_attachment_request )
			return;

		if( !is_a( $current_user, 'WP_User') )
			return;

		if( !in_array( $pagenow, array( 'upload.php', 'admin-ajax.php' ) ) )
			return;

		if( !current_user_can('delete_plugins') )
			$wp_query_obj->set('author', $current_user->ID );

		return;
	}

//	Remove all dashboard widgets for user role ORGANISATION-EDITOR
	add_action( 'wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes' );
	function wporg_remove_all_dashboard_metaboxes() {
		$user = wp_get_current_user();
		if ( in_array( 'organisation-editor', (array) $user->roles ) ) {
			remove_action( 'welcome_panel', 'wp_welcome_panel' );
			remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
			remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
			remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal');
		}
	}

//	Add custom dashboard widget for WELCOME TO FUSION
	add_action( 'wp_dashboard_setup', 'dashboard_add_widget_gethelp' );
	function dashboard_add_widget_gethelp() {
		wp_add_dashboard_widget( 'dw_dashboard_widget_help', __( 'Welcome to Fusion', 'peleman-fusion' ), 'dw_dashboard_widget_help_handler' );
	}

	function dw_dashboard_widget_help_handler() {
		echo '<h3 style="font-weight: 500; margin-bottom: 5px;">'.__('Get started!','peleman-fusion').'</h3>';
		
		echo '<p style="margin-top: 0px;">'.__('In Fusion, you can create your own landing page. To get started, go to','peleman-fusion').' <a href="'.get_admin_url().'edit.php?post_type=organisation" style="text-decoration: underline; font-weight:strong;">'.__('Landing Pages', 'peleman-fusion').'</a> '.__('to create your first landing page.','peleman-fusion').'</p>';
		
		echo '<p style="margin-top: 0px;">'.__('Once all fields are filled in, you can click on PUBLISH and your landing page is live. All that is left to do is share it with all of your customers!','peleman-fusion').'</p>';
		
		echo '<h3 style="font-weight: 500; margin-top: 20px; margin-bottom: 5px;">'.__('Need help?','peleman-fusion').'</h3>';
		echo '<p style="margin-top: 0px;">'.__('If there are any problems, please send a support ticket to <a href="mailto: support@peleman.com" style="text-decoration: underline; font-weight:strong;">support@peleman.com</a> and we will get back to you!','peleman-fusion').'</p>';
	}

//	Add custom dashboard widget for CHANGELOG
	add_action( 'wp_dashboard_setup', 'dashboard_add_widget_gethelp2' );
	function dashboard_add_widget_gethelp2() {
		wp_add_dashboard_widget( 'dw_dashboard_widget_help2', __( 'Changelog', 'peleman-fusion' ), 'dw_dashboard_widget_help_handler2' );
	}

	function dw_dashboard_widget_help_handler2() {
		echo '<h3 style="font-weight: 500; margin-top: 20px; margin-bottom: 10px;">'.__( 'Changelog', 'peleman-fusion' ).' - '.wp_get_theme()->get( 'Version' ).'</h3>';
		
		echo '<h4 style="font-weight: 500; margin-top: 5px; margin-bottom: 0px; font-size: 13px;">22/02/2024 – 1.3.2</h4>';
		echo '<ul style="list-style: square; margin-left: 20px; margin-top: 5px;">';
			echo '<li>'.__('Responsive design improved', 'peleman-fusion-changelog').'</li>';
			echo '<li>'.__('Added more options for customizing your landing page', 'peleman-fusion-changelog').'</li>';
		echo '</ul>';

		echo '<h4 style="font-weight: 500; margin-top: 5px; margin-bottom: 0px; font-size: 13px;">15/11/2023 – 1.2.0</h4>';
		echo '<ul style="list-style: square; margin-left: 20px; margin-top: 5px;">';
			echo '<li>'.__('Added more options for styling your landing page', 'peleman-fusion-changelog').'</li>';
			echo '<li>'.__('Added more options for customizing your product', 'peleman-fusion-changelog').'</li>';
			echo '<li>'.__('More stability in taking the organisation ID along in the checkout & order', 'peleman-fusion-changelog').'</li>';
		echo '</ul>';
		
		echo '<h4 style="font-weight: 500; margin-top: 5px; margin-bottom: 0px; font-size: 13px;">09/11/2023 – 1.1.0</h4>';
		echo '<ul style="list-style: square; margin-left: 20px; margin-top: 5px;">';
			echo '<li>'.__('Added option for importing default theme settings when starting new organisation', 'peleman-fusion-changelog').'</li>';
			echo '<li>'.__('Added option for customizing product description', 'peleman-fusion-changelog').'</li>';
		echo '</ul>';
		
		echo '<h4 style="font-weight: 500; margin-top: 5px; margin-bottom: 0px; font-size: 13px;">31/10/2023 – 1.0.0</h4>';
		echo '<ul style="list-style: square; margin-left: 20px; margin-top: 5px;">';
			echo '<li>'.__('Added support for tracking visitors with Google Analytics, Hotjar', 'peleman-fusion-changelog').'</li>';
			echo '<li>'.__('Added support for adding custom tracking code', 'peleman-fusion-changelog').'</li>';
		echo '</ul>';
	}

//	Add confirmation message to publishing and updating organisation
	add_action( 'admin_print_footer_scripts', 'wp_confirm_post' );
	function wp_confirm_post() {
		?>
			<script>
				jQuery(document).ready(function($){
					$('.post-type-organisation #publishing-action input[name=\"publish\"]').click(function() {
						if(confirm('Are you sure you want to publish this organisation?')) {
							return true;
						} else {
							$('#publishing-action .spinner').hide();
							$('#publishing-action img').hide();
							$(this).removeClass('button-primary-disabled');
							return false;
						}
					});
					
					$('#publishing-action input[name=\"save\"]').click(function() {
						if(confirm('Are you sure you want to update?')) {
							return true;
						} else {
							$('#publishing-action .spinner').hide();
							$('#publishing-action img').hide();
							$(this).removeClass('button-primary-disabled');
							return false;
						}
					});
					
					$('input[name=\"import-default-content\"]').click(function() {
						if(confirm('Are you sure you want to import default content? Your settings will be overwritten')) {
							return true;
						} else {
							$('#publishing-action .spinner').hide();
							$('#publishing-action img').hide();
							$(this).removeClass('button-primary-disabled');
							return false;
						}
					});
				});
			</script>
		<?php
	}
