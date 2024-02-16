<?php

//	Change label text in place order button in checkout
	add_filter( 'woocommerce_order_button_text', 'misha_custom_button_text' );
	function misha_custom_button_text( $button_text ) {
		return __('Place order', 'peleman-fusion'); // new text is here 
	}

//	Remove product image from checkout cart
	add_filter( 'woocommerce_checkout_cart_item_thumbnail', '__return_false' );

//	Remove permalink from products in order table and order overview
	add_filter( 'woocommerce_cart_item_permalink', '__return_false' );
	add_filter( 'woocommerce_order_item_permalink', '__return_false' );

//	Remove product link in cart
	add_filter( 'woocommerce_cart_item_name', 'sv_remove_cart_product_link', 10, 3 );
	function sv_remove_cart_product_link( $product_link, $cart_item, $cart_item_key ) {
		$product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		return $product->get_title();
	}

//	Filter shipping methods in the checkout
	add_filter( 'woocommerce_package_rates', 'wooelements_filter_shipping_methods', 10, 2 );
	function wooelements_filter_shipping_methods( $rates, $package ) {

		if(isset($_GET['organisationid']) && ($_GET['organisationid'] == 'kick-off-party')) {
			unset( $rates['flat_rate:1'] );
		}

		return $rates;
	}

//	Add organisation ID to checkout button in cart
	function woocommerce_button_proceed_to_checkout() { 
		$organisationid = '';
		if(isset($_GET['organisationid'])) {
			$organisationid = '?organisationid=' . $_GET['organisationid'];
		}
		?>
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?><?php echo $organisationid ?>" class="button button-primary checkout-button button alt wc-forward">
				<?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?>
			</a>
		<?php
	}

//	Customize return URL
	add_filter( 'woocommerce_get_return_url', 'customize_get_return_url', 10, 2 );
	add_filter( 'woocommerce_get_checkout_order_received_url', 'customize_get_return_url', 10, 2 );
	function customize_get_return_url( $return_url, $order ){
		//     print_r($order->get_meta( '_organisation_id', true ));exit;

		$organisationid = '';
		if(isset($_GET['organisationid'])) {
			$organisationid = $_GET['organisationid'];
		}

		$query_args = array(
			'organisationid' => $order->get_meta( '_organisation_id', true ),
		);
		return add_query_arg( $query_args, $return_url );
	}

// 	Outputting the hidden field in checkout page
	add_action( 'woocommerce_after_order_notes', 'add_custom_checkout_hidden_field' );
	function add_custom_checkout_hidden_field( $checkout ) {

		$organisationid = '';
		if(isset($_GET['organisationid'])) {
			$organisationid = $_GET['organisationid'];
		}

		// Output the hidden field
// 		echo '<div id="user_link_hidden_checkout_field">
// 					<input type="text" class="input-hidden" name="organisation_id" id="organisation_id" value="' . $organisationid . '">
// 			</div>';
		
		echo '<p class="form-row form-row-wide" id="organisation_id" data-priority="50">';
			echo '<label for="organisation_id" class="">Organisation ID</label>';
			echo '<span class="woocommerce-input-wrapper">';
				echo '<input type="text" class="input-text" name="organisation_id" id="organisation_id" placeholder="Organisation ID" value="' . $organisationid . '" readonly style="background-color: #e3e3e3">';
			echo '</span>';
		echo '</p>';
	}

// 	Saving the hidden field value in the order metadata
	add_action( 'woocommerce_checkout_update_order_meta', 'save_custom_checkout_hidden_field' );
	function save_custom_checkout_hidden_field( $order_id ) {
		if ( ! empty( $_POST['organisation_id'] ) ) {
			update_post_meta( $order_id, '_organisation_id', sanitize_text_field( $_POST['organisation_id'] ) );
		}
	}

// 	Displaying "Verification ID" in customer order
	add_action( 'woocommerce_order_details_after_customer_details', 'display_verification_id_in_customer_order', 10 );
	function display_verification_id_in_customer_order( $order ) {
		// compatibility with WC +3
		$order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;

		echo '<p class="verification-id"><strong>'.__('Organisation ID', 'woocommerce') . ':</strong> ' . get_post_meta( $order_id, '_organisation_id', true ) .'</p>';
	}

// 	Display "Verification ID" on Admin order edit page
	add_action( 'woocommerce_admin_order_data_after_billing_address', 'display_verification_id_in_admin_order_meta', 10, 1 );
	function display_verification_id_in_admin_order_meta( $order ) {
		// compatibility with WC +3
		$order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
		echo '<p><strong>'.__('Organisation ID', 'woocommerce').':</strong> ' . get_post_meta( $order_id, '_organisation_id', true ) . '</p>';
	}