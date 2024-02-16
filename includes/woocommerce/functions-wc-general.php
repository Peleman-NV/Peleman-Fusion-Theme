<?php

//	Include all functions related to Woocommerce
	include_once('functions-wc-products.php');
	include_once('functions-wc-checkout.php');

//	Add Woocommerce support
	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
    	add_theme_support( 'wc-product-gallery-lightbox' );
	}  
	
//	Remove Woocommerce sidebar
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

//	Change redirect after saving account details in WC
	add_action( 'woocommerce_save_account_details', 'custom__woocommerce_save_account_details__redirect', 90, 1 );
	function custom__woocommerce_save_account_details__redirect( $ID ) {
		$organisationid = '';
		
		if(isset($_GET['organisationid'])) {
			$organisationid = '?organisationid=' . $_GET['organisationid'];
		}
		
		wp_safe_redirect($organisationid );
		exit();
	}

//	Change redirect after saving account details in WC
	add_action( 'woocommerce_customer_save_address', 'action_woocommerce_customer_save_address', 99, 2 ); 
	function action_woocommerce_customer_save_address( $user_id, $load_address ) { 
		$organisationid = '';
		
		if(isset($_GET['organisationid'])) {
			$organisationid = '?organisationid=' . $_GET['organisationid'];
		}
		
		wp_safe_redirect($organisationid );
		exit();
	}; 

// 	Change redirect after logout
	add_filter('logout_url', 'redirect_after_logout', 10, 2);
	function redirect_after_logout($logout_url, $redirect) {
		$organisationid = '';

		if(isset($_GET['organisationid'])) {
			$organisationid = $_GET['organisationid'];
		}

		return $logout_url . '&amp;redirect_to=' . site_url() . '/organisation/' . $organisationid;
	}

//	Add query arguments like organisation ID to lost password reset link sent 
	add_action( 'woocommerce_reset_password_notification', 'action_woocommerce_reset_password_notification', 20, 4);
	function action_woocommerce_reset_password_notification($login, $key) {
		if(isset($_GET['organisationid'])) {
			$organisationid = $_GET['organisationid'];
		}
		wp_safe_redirect( add_query_arg( array('reset-link-sent' => 'true', 'organisationid' => $organisationid), 'true', wc_get_account_endpoint_url( 'lost-password' ) ) );
		exit;
	};
