<?php

//	Get editor environment
	add_filter( 'get_editor_environment', 'get_editor_environment_callback', 10, 1 );
	function get_editor_environment_callback($request){
		switch ($request) {
			case 'environment':
// 				return 'https://deveditor.peleman.com'; //DEMO
				return 'https://editor.peleman.com'; //LIVE
				break;
			case 'customer':
// 				return 'fusian'; //DEMO
				return 'fusion'; //LIVE
				break;
			case 'apikey':
// 				return 'printshopapikey12'; //DEMO
				return 'Jwmey7T1Cw0riaaYhOJuFDUc6jc5barwPxqSrsk3dd'; //LIVE
				break;
		}
	}

// 	This is the confirmation message that will appear.
	add_action('admin_footer', 'confirm_publish');
	$c_message = 'Are you SURE you want to publish this post?';
	function confirm_publish(){
		global $c_message;
		echo '';
	}

//	Add custom fields to CPT
	add_action( 'add_meta_boxes_organisation', 'pf_meta_box_settings' );
	function pf_meta_box_settings( $post ){
		add_meta_box( 'pf_meta_box_settings', __( 'Organisation settings', 'peleman-fusion' ), 'pf_meta_box_settings_html_output', 'organisation', 'normal', 'low' );
	}

//	Create meta box for all organisation settings
	function pf_meta_box_settings_html_output( $post ) {
		
		// Add a nonce field so we can check for it later.
		wp_nonce_field( 'global_notice_nonce', 'global_notice_nonce' );
		
		$args_editor = array('textarea_rows'=>20, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE, 'default_editor' => 'tinymce');
		$args_editor_2 = array('textarea_rows'=>10, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => FALSE, 'quicktags' => TRUE, 'default_editor' => 'quicktags');

		echo '<style>
			
			#poststuff .inside {
				margin-top: 10px !important;
			}
			
			.uploaded-image {
				width: 30%; 
			}
			
			.flex-parent-element {
				display: flex;
				width: 100%;
			}
			
			.tab {
				border: 1px solid #ccc;
				background-color: #FAFAFA;
				width: 15%;
				min-height: 500px;
			}
			
			.tabcontents {
				width: 85%;
			}
			
			.tab button {
				display: block;
			  	background-color: inherit;
			  	color: #2782ad;
			  	padding: 15px 15px;
			  	width: 100%;
			  	border: none;
			  	outline: none;
			  	text-align: left;
			  	cursor: pointer;
			  	transition: 0.3s;
			}

			.tab button:hover {
			  	background-color: #EEEEEE;
				color: #555;
			}

			.tab button.active {
			  	background-color: #EEEEEE;
				color: #555;
			}

			.tabcontent {
			  	border: 1px solid #ccc;
			  	border-left: none;
				padding: 20px;
				min-height: 550px;
			}
			
			input.pf-input-admin, textarea.pf-input-admin, select {
			  width: 100%;
			  padding: 5px 10px !important;
			  margin: 8px 0;
			  display: inline-block;
			  border: 1px solid #ccc;
			  border-radius: 4px !important;
			  box-sizing: border-box;
			}
			
			.wp-picker-container {
    			display: block;
				margin-bottom: 10px;
			}
			
			
			input[type=text].pf-input-admin::placeholder, textarea.pf-input-admin::placeholder {
				color: #b9b9b9;
			}
			
			.pf-checkbox-admin {
				width: 20px !important;
            	height: 20px !important;
			}
			
			.pf-checkbox-admin:checked::before {
				width: 25px !important;
			}
			
			.pf-checkbox-admin-div {
				margin-bottom: 30px;
			}
			
			.pf-label-admin {
				font-weight: 500;
			}
			
			.pf-h3-admin {
				margin-top: 0px !important;
			}
			
			.pf-h4-admin {
				margin-top: 0px !important;
				margin-bottom: 10px !important;
				font-size: 16px;
			}
			
			.horizontal-divider {
				margin-top: 20px;
				margin-bottom: 20px;
			}
			
			.horizontal-divider-between {
				margin-top: 20px;
				margin-bottom: 20px;
				border-style: dashed;
			}
			
			.alert {
				position: relative;
    			padding: 10px 10px;
    			margin-bottom: 10px;
				font-weight: 500;
			}
			
			.alert-info {
				color: #424b54;
    			background-color: #CCE5FF;
    			border: 2px solid #424b54;
			}
			
			.alert-success {
				color: #155724;
    			background-color: #d4edda;
    			border: 2px solid #155724;
			}
			
			.alert-danger {
				color: #721c24;
    			background-color: #f8d7da;
    			border: 2px solid #721c24;
			}
			
			.collapsible {
			  background-color: #777;
			  color: white;
			  padding: 18px;
			  border: none;
			  text-align: left;
			  outline: none;
			  font-size: 15px;
			}

			.collapsiblebutton {
				cursor: pointer;
			}

			collapsiblebutton-active {
				
			}
			
			.productoptions {
			  display: none;
			  overflow: hidden;
			}
			
			.orders-table {
			  font-family: Arial, Helvetica, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			.orders-table td, .orders-table th {
			  border: 1px solid #ddd;
			  padding: 8px;
			}

			.orders-table tr:nth-child(even){background-color: #f2f2f2;}

			.orders-table th {
			  padding-top: 12px;
			  padding-bottom: 12px;
			  text-align: left;
			  background-color: #2782ad;
			  color: white;
			}
			
			</style>';
		
		?>



<div class="flex-parent-element">
	<div class="tab flex-child-element">
		<button type="button" class="tablinks active" onclick="openCity(event, 'GetStarted')"><span class="dashicons dashicons-arrow-right-alt"></span>&nbsp;&nbsp;Get Started</button>
		<button type="button" class="tablinks" onclick="openCity(event, 'Organisation')"><span class="dashicons dashicons-store"></span>&nbsp;&nbsp;Organisation</button>
		<button type="button" class="tablinks" onclick="openCity(event, 'Logo')"><span class="dashicons dashicons-format-image"></span>&nbsp;&nbsp;Logo</button>
		<button type="button" class="tablinks" onclick="openCity(event, 'Products')"><span class="dashicons dashicons-cart"></span>&nbsp;&nbsp;Products</button>
		<button type="button" class="tablinks" onclick="openCity(event, 'Theme')"><span class="dashicons dashicons-admin-appearance"></span>&nbsp;&nbsp;Theme Design</button>
		<button type="button" class="tablinks" onclick="openCity(event, 'Fonts')"><span class="dashicons dashicons-editor-textcolor"></span>&nbsp;&nbsp;Typography</button>
		<button type="button" class="tablinks" onclick="openCity(event, 'Advanced')"><span class="dashicons dashicons-admin-settings"></span>&nbsp;&nbsp;Advanced</button>
		<button type="button" class="tablinks" onclick="openCity(event, 'ImageEditor')"><span class="dashicons dashicons-edit"></span>&nbsp;&nbsp;Image Editor</button>
		
		<?php if(get_post_meta( $post->ID, '_organisation_orders_visibility', true ) == 'true'): ?>
		<hr>
		<button type="button" class="tablinks" onclick="openCity(event, 'Orders')"><span class="dashicons dashicons-money-alt"></span>&nbsp;&nbsp;Orders</button>
		<?php endif; ?>
		
		<?php if(current_user_can('administrator')): ?>
		<hr>
		<button type="button" class="tablinks" onclick="openCity(event, 'Administrator')"><span class="dashicons dashicons-dashboard"></span>&nbsp;&nbsp;Administrator options</button>
		<button type="button" class="tablinks" onclick="openCity(event, 'ImportExport')"><span class="dashicons dashicons-database-export"></span>&nbsp;&nbsp;Import/Export</button>
		<?php endif; ?>
	</div>

	<div class="tabcontents flex-child-element">
		
		<div id="ImportExport" class="tabcontent" style="display: none;">
			<h3 class="pf-h3-admin"><span class="dashicons dashicons-database-export"></span>&nbsp;&nbsp;Import/Export</h3>
			
			<p>You can import/export your landing page here.</p>
				
			<?php
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Export</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Export</h4>';
					echo '<hr class="horizontal-divider">';
					
					echo '<p style="margin: 0px;">Copy the code from this field and save it to a textual file to export your options.</p>';
					echo '<textarea id="organisation_export" name="organisation_export" class="pf-input-admin" rows="6" cols="50"></textarea>';
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Import</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Import</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<p style="margin: 0px;">To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.</p>';
					echo '<textarea id="organisation_import" name="organisation_import" class="pf-input-admin" rows="6" cols="50"></textarea>';
		
					echo '<div class="alert alert-danger" role="alert">';
						echo 'Please note that import process will overide all your existing options.';
					echo '</div>';
		
					echo '<input type="submit" disabled="disabled" id="import-default-content" class="button button-primary button-large" name="import-default-content" value="Import" />';
				echo '</div>';
			?>
		</div>
		
		<div id="Administrator" class="tabcontent" style="display: none;">
			<?php
				if(current_user_can('administrator')) {

					echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-dashboard"></span>&nbsp;&nbsp;Administrator options</h3>';

					echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
						echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Default Organisation</h4>';
						echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
					echo '</div>';
					echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
						echo '<h4 class="pf-h4-admin">Default organisation</h4>';
						echo '<hr class="horizontal-divider">';

						if(!empty(get_post_meta( $post->ID, '_organisation_default', true )) && get_post_meta( $post->ID, '_organisation_default', true ) == '1'){
							$default = 'checked';
						}else {
							$default = '';
						}

						echo '<input id="organisation_default" name="organisation_default" class="pf-checkbox-admin" type="checkbox" value="1" '.$default.' style="margin-top: -10px;" />&nbsp;<label for="organisation_default" style="vertical-align: text-bottom;">Default organisation (this organisation will be used for the default theme settings when checked)</label><br><br>';

						echo '<p>The default organisation will also be used as the organisation to display on the homepage of the installation.<br/>You can view this here: <a href="' . get_site_url() . '" target="_blank">' . get_site_url() . '</a></p>';

						echo '<label for="organisation_default_color_panel" class="pf-label-admin">Panel color <span style="font-weight: 400;"></span></label>';
						echo '<input id="organisation_default_color_panel" name="organisation_default_color_panel" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_default_color_panel', true ) ) . '" placeholder="" />';

						echo '<label for="organisation_default_color_panel_text" class="pf-label-admin">Panel text color <span style="font-weight: 400;">(used as text color inside panel)</span></label>';
						echo '<input id="organisation_default_color_panel_text" name="organisation_default_color_panel_text" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_default_color_panel_text', true ) ) . '" placeholder="" />';
					echo '</div>';
					
					echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
						echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Orders options</h4>';
						echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
					echo '</div>';
					echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
						echo '<h4 class="pf-h4-admin">Orders</h4>';
						echo '<hr class="horizontal-divider">';
						
						echo '<label for="organisation_orders_visibility" class="pf-label-admin">Let organisations see their orders generated through landing page</label>';
						$organisation_orders_visibility = get_post_meta( $post->ID, '_organisation_orders_visibility', true );
						$select_organisation_orders_visibility = '<select id="organisation_orders_visibility" name="organisation_orders_visibility" class="pf-input-admin">';
						$select_organisation_orders_visibility .= '<option value="true"' . selected( $organisation_orders_visibility, 'true', false) . '>Yes</option>';
						$select_organisation_orders_visibility .= '<option value="false"' . selected( $organisation_orders_visibility, 'false', false) . '>No</option>';
						$select_organisation_orders_visibility .= '</select>';
						echo $select_organisation_orders_visibility;
					
						echo '<label for="organisation_orders_cust_visibility" class="pf-label-admin">Let organisations see customer details from orders</label>';
						$organisation_orders_cust_visibility = get_post_meta( $post->ID, '_organisation_orders_cust_visibility', true );
						$select_organisation_orders_cust_visibility = '<select id="organisation_orders_cust_visibility" name="organisation_orders_cust_visibility" class="pf-input-admin">';
						$select_organisation_orders_cust_visibility .= '<option value="true"' . selected( $organisation_orders_cust_visibility, 'true', false) . '>Yes</option>';
						$select_organisation_orders_cust_visibility .= '<option value="false"' . selected( $organisation_orders_cust_visibility, 'false', false) . '>No</option>';
						$select_organisation_orders_cust_visibility .= '</select>';
						echo $select_organisation_orders_cust_visibility;
						
					echo '</div>';
				}
			?>
		</div>
		
		<div id="Orders" class="tabcontent" style="display: none;">
			
			<h3 class="pf-h3-admin"><span class="dashicons dashicons-money-alt"></span>&nbsp;&nbsp;Orders</h3>
			
			<p>You can view all orders generated through your landing page here. </p>
			
			<?php if ( get_post_status ( $post->ID ) == 'publish' ): ?>
			
				<?php
					$orders = wc_get_orders( array(
						'status'        => ['processing','completed','on-hold'],
						'meta_key'      => '_organisation_id',
						'meta_value'    => get_post_meta( $post->ID, '_organisation_editor_id', true ), 
						'meta_compare'  => '=', 
					) );
				?>

				<div>
					<table class="orders-table">
						<thead>
							<tr>
								<th>Order ID</th>
								<th>Order Date</th>
								<th>Status</th>
								<th>Billing</th>
								<th>Shipping</th>
							</tr>
						</thead>
						<tbody>
							<?php if(empty($orders)): ?>
								<tr>
									<td colspan="5" style="text-align: center; padding: 10px;">There are no orders made yet</td>
								</tr>
							<?php else: ?>
								<?php foreach ($orders as $order_id => $order): ?>
								<tr>
									<td><?php echo $order->get_id(); ?></td>
									<td><?php echo date( 'd-m-Y', strtotime( $order->get_date_created() )); ?></td>
									<td><?php echo $order->get_status(); ?></td>
									<td><?php echo $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(); ?></td>
									<td><?php echo $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(); ?></td>
								</tr>
								<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			
			<?php else: ?>
				<div class="alert alert-danger" role="alert">
					Publish the organisation first before you can view the orders
				</div>
			<?php endif; ?>
			
		</div>
		
		<div id="GetStarted" class="tabcontent" style="display: block;">
			<?php
				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-arrow-right-alt"></span>&nbsp;&nbsp;Get started!</h3>';
			
			?>	
				
				<?php if ( get_post_status ( $post->ID ) == 'publish' ): ?>
					<div class="alert alert-success" role="alert">
						Your landing page is now published and ready for sharing, you can view it <a href="<?php echo get_permalink( $post->ID ); ?>" target="_blank">here</a>
					</div>
				<?php else: ?>
					<div class="alert alert-danger" role="alert">
						Your landing page is not published yet, please fill in all fields & publish your organisation
					</div>
				<?php endif; ?>
			
			<?php
				
				echo '<hr class="horizontal-divider">';
		
				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-admin-links"></span>&nbsp;&nbsp;For the customer</h3>';
				
				if ( get_post_status ( $post->ID ) == 'publish' ) {
					$str = random_bytes(32);
					$str = base64_encode($str);
					$str = str_replace(["+", "/", "="], "", $str);
					$str = substr($str, 0, 32);
					
					echo '<p>Below you can find the shareable URL for the landing page for this organisation.</p>';
					echo '<a href="'.get_permalink( $post->ID ).'" style="font-size: 16px; font-weight: bold;" target="_blank">'.get_permalink( $post->ID ).'</a>';
					echo '<p>Below you can find the QR code with the URL for the landing page for this organisation.<br/>You can download the QR in high resolution below.</p>';
					echo '<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.get_permalink( $post->ID ).'?ver='.$str.'&choe=UTF-8&chld=L|1" width="125px;">';
					echo '<br/>';
					echo '<a download="custom-filename.jpg" href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.get_permalink( $post->ID ).'?ver='.$str.'&choe=UTF-8&chld=L|1" title="ImageName" target="_blank" download>';
    					echo 'Download QR code';
					echo '</a>';
				} else {
					echo '<p>First publish the organisation to generate a QR code</p>';
				}
		
				echo '<hr class="horizontal-divider">';
		
				$editor_environment = apply_filters('get_editor_environment', 'environment');
				
				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-database"></span>&nbsp;&nbsp;For the organisation</h3>';
				if ( get_post_status ( $post->ID ) == 'publish' ) {
					echo '<p>You can add custom images & texts for this organisation, so that customers can view & use these in their projects.<br/>To do this, please click the button below to go to the editor.</p>';
					
					echo '<a href="' . $editor_environment . '/editor/dashboard/vieworganisation.php?a='.get_post_meta( $post->ID, '_organisation_apikey', true ).'" target="_blank" class="button button-primary button-large">Manage custom content</a>';
					
					echo '<p>You can also use this QR to access the editor.</p>';
					echo '<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . $editor_environment . '/editor/dashboard/vieworganisation.php?organisationid=' . get_post_field( 'post_name', $post->ID ) . '&viewascustomer=1&viewasorganisation=1&choe=UTF-8&chld=L|1" width="125px;">';
					echo '<br/>';
					echo '<a download="custom-filename.jpg" href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . $editor_environment . '/editor/dashboard/vieworganisation.php?a='.get_post_meta( $post->ID, '_organisation_apikey', true ).'&choe=UTF-8&chld=L|1" title="ImageName" target="_blank" download>';
    					echo 'Download QR code';
					echo '</a>';
				} else {
					echo '<p>First publish the organisation to generate a link to add custom images & texts</p>';
				}
		
		

			?>
		</div>
		
		<div id="Organisation" class="tabcontent" style="display: none;">
			<?php
				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-store"></span>&nbsp;&nbsp;Organisation details</h3>';

				echo '<label for="organisation_name" class="pf-label-admin">Organisation name</label>';
				echo '<input id="organisation_name" name="organisation_name" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_name', true ) ) . '" placeholder="Organisation name" />';

				echo '<label for="organisation_email" class="pf-label-admin">E-mail address</label>';
				echo '<input id="organisation_email" name="organisation_email" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_email', true ) ) . '" placeholder="E-mail address" />';

				echo '<label for="organisation_phone" class="pf-label-admin">Phone number</label>';
				echo '<input id="organisation_phone" name="organisation_phone" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_phone', true ) ) . '" placeholder="Phone number" />';

				echo '<hr class="horizontal-divider">';

				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-location"></span>&nbsp;&nbsp;Organisation address</h3>';

				echo '<label for="organisation_address_1" class="pf-label-admin">Street & house nr</label>';
				echo '<input id="organisation_address_1" name="organisation_address_1" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_address_1', true ) ) . '" placeholder="Street & house nr" />';

				echo '<label for="organisation_postal" class="pf-label-admin">Postal code</label>';
				echo '<input id="organisation_postal" name="organisation_postal" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_postal', true ) ) . '" placeholder="Postal code" />';

				echo '<label for="organisation_city" class="pf-label-admin">City / Town</label>';
				echo '<input id="organisation_city" name="organisation_city" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_city', true ) ) . '" placeholder="City / Town" />';
		
				echo '<label for="organisation_state" class="pf-label-admin">State</label>';
				echo '<input id="organisation_state" name="organisation_state" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_state', true ) ) . '" placeholder="State" />';

				echo '<label for="organisation_country" class="pf-label-admin">Country</label>';
				$country_text = get_post_meta( $post->ID, '_organisation_country', true );
				$select_country = '<select id="organisation_country" name="organisation_country" class="pf-input-admin">';
				$select_country .= '<option value="default">Select a country</option>';		
				$select_country .= '<option value="AT"' . selected( $country_text, 'AT', false) . '>Austria</option>';
				$select_country .= '<option value="BE"' . selected( $country_text, 'BE', false) . '>Belgium</option>';
				$select_country .= '<option value="BG"' . selected( $country_text, 'BG', false) . '>Bulgaria</option>';
				$select_country .= '<option value="HR"' . selected( $country_text, 'HR', false) . '>Croatia</option>';
				$select_country .= '<option value="CY"' . selected( $country_text, 'CY', false) . '>Cyprus</option>';
				$select_country .= '<option value="CZ"' . selected( $country_text, 'CZ', false) . '>Czech Republic</option>';
				$select_country .= '<option value="DK"' . selected( $country_text, 'DK', false) . '>Denmark</option>';
				$select_country .= '<option value="EE"' . selected( $country_text, 'EE', false) . '>Estonia</option>';
				$select_country .= '<option value="FI"' . selected( $country_text, 'FI', false) . '>Finland</option>';
				$select_country .= '<option value="FR"' . selected( $country_text, 'FR', false) . '>France</option>';
				$select_country .= '<option value="DE"' . selected( $country_text, 'DE', false) . '>Germany</option>';
				$select_country .= '<option value="GR"' . selected( $country_text, 'GR', false) . '>Greece</option>';
				$select_country .= '<option value="HU"' . selected( $country_text, 'HU', false) . '>Hungary</option>';
				$select_country .= '<option value="IE"' . selected( $country_text, 'IE', false) . '>Ireland</option>';
				$select_country .= '<option value="IT"' . selected( $country_text, 'IT', false) . '>Italy</option>';
				$select_country .= '<option value="LV"' . selected( $country_text, 'LV', false) . '>Latvia</option>';
				$select_country .= '<option value="LT"' . selected( $country_text, 'LT', false) . '>Lithuania</option>';
				$select_country .= '<option value="LU"' . selected( $country_text, 'LU', false) . '>Luxembourg</option>';
				$select_country .= '<option value="MT"' . selected( $country_text, 'MT', false) . '>Malta</option>';
				$select_country .= '<option value="NL"' . selected( $country_text, 'NL', false) . '>The Netherlands</option>';
				$select_country .= '<option value="PL"' . selected( $country_text, 'PL', false) . '>Poland</option>';
				$select_country .= '<option value="PT"' . selected( $country_text, 'PT', false) . '>Portugal</option>';
				$select_country .= '<option value="RO"' . selected( $country_text, 'RO', false) . '>Romania</option>';
				$select_country .= '<option value="SK"' . selected( $country_text, 'SK', false) . '>Slovakia</option>';
				$select_country .= '<option value="SI"' . selected( $country_text, 'SI', false) . '>Slovenia</option>';
				$select_country .= '<option value="ES"' . selected( $country_text, 'ES', false) . '>Spain</option>';
				$select_country .= '<option value="SE"' . selected( $country_text, 'SE', false) . '>Sweden</option>';
				$select_country .= '<option value="US"' . selected( $country_text, 'US', false) . '>United States</option>';
				$select_country .= '<option value="UK"' . selected( $country_text, 'UK', false) . '>United Kingdom</option>';
				$select_country .= '</select>';
				echo $select_country;

				echo '<hr class="horizontal-divider">';

				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-share"></span>&nbsp;&nbsp;Social media</h3>';

				echo '<label for="organisation_social_facebook" class="pf-label-admin">Facebook</label>';
				echo '<input id="organisation_social_facebook" name="organisation_social_facebook" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_social_facebook', true ) ) . '" placeholder="Facebook URL" />';

				echo '<label for="organisation_social_instagram" class="pf-label-admin">Instagram</label>';
				echo '<input id="organisation_social_instagram" name="organisation_social_instagram" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_social_instagram', true ) ) . '" placeholder="Instagram URL" />';

				echo '<label for="organisation_social_linkedin" class="pf-label-admin">Linkedin</label>';
				echo '<input id="organisation_social_linkedin" name="organisation_social_linkedin" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_social_linkedin', true ) ) . '" placeholder="Linkedin URL" />';
			?>
		</div>
		
		<div id="Theme" class="tabcontent" style="display: none;">
			<?php
				echo '<h3 class="pf-h3-admin" id="theme"><span class="dashicons dashicons-admin-appearance"></span>&nbsp;&nbsp;Theme Design</h3>';
		
				echo 'Jump to: <a href="#theme">Theme</a> | <a href="#themecolor">Styling</a> | <a href="#header">Header</a> | <a href="#content">Content</a> | <a href="#footer">Footer</a>';
				echo '<br>';
				echo '<br>';
		
			?>

				<?php if ( get_post_meta( $post->ID, '_organisation_defaultcontent_set', true ) == '1' ): ?>
					<div class="alert alert-success" role="info">
						Theme default settings are succesfully loaded in!
					</div>
				<?php endif; ?>
			
				<?php if ( get_post_meta( $post->ID, '_organisation_default', true ) == '1' ): ?>
					<div class="alert alert-info" role="alert">
						This organisation is set as the default organisation, theme settings from this organisation can be used for importing theme settings into other organisations.
					</div>
				<?php else: ?>
					<div class="alert alert-info" role="info">
						<p style="margin-top: 0px;">
							<?php if ( get_post_meta( $post->ID, '_organisation_defaultcontent_set', true ) == '1' ): ?>
								Do you want to import default theme settings again? This will overwrite any changes you made.
							<?php else: ?>
								<?php if ( !empty(get_post_meta( $post->ID, '_organisation_theme', true )) ): ?>
									You can import default theme settings to further customise your landing page. This will overwrite any changes you made.
								<?php else: ?>
									Right now, your landing page is still (a bit) empty. You can start from scratch or import default theme settings to get started.
								<?php endif; ?>
							<?php endif; ?>
						</p>
			
						<input type="submit" id="import-default-content" class="button button-primary button-large" name="import-default-content" value="Import default theme settings" />
					</div>
				<?php endif; ?>
			
			<?php
		
				echo '<hr class="horizontal-divider">';
		
				echo '<h3 class="pf-h3-admin" id="theme"><span class="dashicons dashicons-admin-appearance"></span>&nbsp;&nbsp;Theme</h3>';
				
				echo '<label for="organisation_theme" class="pf-label-admin">Theme of landing page</label>';
				$theme_text = get_post_meta( $post->ID, '_organisation_theme', true );
				$select_theme = '<select id="organisation_theme" name="organisation_theme" class="pf-input-admin">';
				$select_theme .= '<option value=""' . selected( $theme_text, '', false) . '>--- Please select a theme ---</option>';
				$select_theme .= '<option value="joyful"' . selected( $theme_text, 'joyful', false) . '>Joyful</option>';
				$select_theme .= '<option value="serene"' . selected( $theme_text, 'serene', false) . '>Serene</option>';
				$select_theme .= '</select>';
				echo $select_theme;
		
				echo '<br/>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">General Theme Settings</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">General settings</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_theme_settings_rounded" class="pf-label-admin">Background image/color all around</label>';
					$theme_bg_around = get_post_meta( $post->ID, '_organisation_theme_settings_bg_around', true );
					$select_theme_bg_around = '<select id="organisation_theme_settings_bg_around" name="organisation_theme_settings_bg_around" class="pf-input-admin">';
					$select_theme_bg_around .= '<option value="yes"' . selected( $theme_bg_around, 'yes', false) . '>Yes</option>';
					$select_theme_bg_around .= '<option value="no"' . selected( $theme_bg_around, 'no', false) . '>No</option>';
					$select_theme_bg_around .= '</select>';
					echo $select_theme_bg_around;
					
					echo '<label for="organisation_theme_settings_rounded" class="pf-label-admin">Make everything rounded (images, panels, ...)</label>';
					$theme_rounded = get_post_meta( $post->ID, '_organisation_theme_settings_rounded', true );
					$select_theme_rounded = '<select id="organisation_theme_settings_rounded" name="organisation_theme_settings_rounded" class="pf-input-admin">';
					$select_theme_rounded .= '<option value="yes"' . selected( $theme_rounded, 'yes', false) . '>Yes</option>';
					$select_theme_rounded .= '<option value="no"' . selected( $theme_rounded, 'no', false) . '>No</option>';
					$select_theme_rounded .= '</select>';
					echo $select_theme_rounded;
				echo '</div>';
		
				echo '<hr class="horizontal-divider">';
		
				echo '<h3 class="pf-h3-admin" id="themecolor"><span class="dashicons dashicons-color-picker"></span>&nbsp;&nbsp;Styling</h3>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Colors</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Theme Colors</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_theme_body_color" class="pf-label-admin">Theme body color <span style="font-weight: 400;">(used as body background for the page)</span></label>';
					echo '<input id="organisation_theme_body_color" name="organisation_theme_body_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_theme_body_color', true ) ) . '" placeholder="Theme body color" />';

					echo '<label for="organisation_theme_container_color" class="pf-label-admin">Theme container color <span style="font-weight: 400;">(used as container background for the page)</span></label>';
					echo '<input id="organisation_theme_container_color" name="organisation_theme_container_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_theme_container_color', true ) ) . '" placeholder="Theme container color" />';

					echo '<label for="organisation_color_main" class="pf-label-admin">Main color <span style="font-weight: 400;">(used on primary buttons)</span></label>';
					echo '<input id="organisation_color_main" name="organisation_color_main" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_color_main', true ) ) . '" placeholder="Main color" />';

					echo '<label for="organisation_color_main_button_text" class="pf-label-admin">Main button text color <span style="font-weight: 400;">(used as text color on primary buttons)</span></label>';
					echo '<input id="organisation_color_main_button_text" name="organisation_color_main_button_text" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_color_main_button_text', true ) ) . '" placeholder="Main button text color" />';

					echo '<label for="organisation_color_secondary" class="pf-label-admin">Secondary color <span style="font-weight: 400;">(used on secondary buttons and color assets)</span></label>';
					echo '<input id="organisation_color_secondary" name="organisation_color_secondary" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_color_secondary', true ) ) . '" placeholder="Secondary color" />';

					echo '<label for="organisation_color_secondary_button_text" class="pf-label-admin">Secondary button text color <span style="font-weight: 400;">(used as text color on secondary buttons and assets)</span></label>';
					echo '<input id="organisation_color_secondary_button_text" name="organisation_color_secondary_button_text" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_color_secondary_button_text', true ) ) . '" placeholder="Secondary button text color" />';
		
					echo '<label for="organisation_color_panel" class="pf-label-admin">Panel color <span style="font-weight: 400;">(used on panels)</span></label>';
					echo '<input id="organisation_color_panel" name="organisation_color_panel" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_color_panel', true ) ) . '" placeholder="" />';

					echo '<label for="organisation_color_panel_text" class="pf-label-admin">Panel text color <span style="font-weight: 400;">(used as text color inside panels)</span></label>';
					echo '<input id="organisation_color_panel_text" name="organisation_color_panel_text" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_color_panel_text', true ) ) . '" placeholder="" />';

					echo '<label for="organisation_color_main_text" class="pf-label-admin">Main text color <span style="font-weight: 400;">(used as normal text color)</span></label>';
					echo '<input id="organisation_color_main_text" name="organisation_color_main_text" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_color_main_text', true ) ) . '" placeholder="Main text color" />';
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Fonts</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Fonts</h4>';
					echo '<hr class="horizontal-divider">';
					
					echo '<p>Fonts & Typography have been moved to the Typography tab.<br/>You can customize the settings in the tab Typography.</p>';
					
					?>
						<button type="button" class="button button-primary button-large" onclick="openCity(event, 'Fonts')"><span class="dashicons dashicons-editor-textcolor" style="vertical-align: middle;"></span>&nbsp;&nbsp;Go to Typography</button>
					<?php
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Background</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Background Image</h4>';
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_image_background" class="pf-label-admin">Background Image</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
					if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_image_background', true ), 'full' ) ){
						echo '<a href="#" class="rudr-upload">';
						echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
						echo '</a>';
						echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
						echo '<input type="hidden" name="organisation_image_background" value="'.absint(get_post_meta( $post->ID, '_organisation_image_background', true )).'">';
					}else {
						echo '<a href="#" class="button rudr-upload">Upload image</a>';
						echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
						echo '<input type="hidden" name="organisation_image_background" value="">';
					}
					echo '</div>';
		
					echo '<label for="organisation_image_background_position" class="pf-label-admin">Background Position</label>';
					$theme_background_position = get_post_meta( $post->ID, '_organisation_image_background_position', true );
					$select_theme_background_position = '<select id="organisation_image_background_position" name="organisation_image_background_position" class="pf-input-admin">';
						$select_theme_background_position .= '<option value="top"' . selected( $theme_background_position, 'top', false) . '>Top</option>';
						$select_theme_background_position .= '<option value="bottom"' . selected( $theme_background_position, 'bottom', false) . '>Bottom</option>';
						$select_theme_background_position .= '<option value="center"' . selected( $theme_background_position, 'center', false) . '>Center</option>';
						$select_theme_background_position .= '<option value="left"' . selected( $theme_background_position, 'left', false) . '>Left</option>';
						$select_theme_background_position .= '<option value="right"' . selected( $theme_background_position, 'right', false) . '>Right</option>';
					$select_theme_background_position .= '</select>';
					echo $select_theme_background_position;
		
					echo '<label for="organisation_image_background_size" class="pf-label-admin">Background Size</label>';
					$theme_background_size = get_post_meta( $post->ID, '_organisation_image_background_size', true );
					$select_theme_background_size = '<select id="organisation_image_background_size" name="organisation_image_background_size" class="pf-input-admin">';
						$select_theme_background_size .= '<option value="cover"' . selected( $theme_background_size, 'cover', false) . '>Cover</option>';
						$select_theme_background_size .= '<option value="contain"' . selected( $theme_background_size, 'contain', false) . '>Contain</option>';
					$select_theme_background_size .= '</select>';
					echo $select_theme_background_size;
		
					echo '<label for="organisation_image_background_repeat" class="pf-label-admin">Background Repeat</label>';
					$theme_background_repeat = get_post_meta( $post->ID, '_organisation_image_background_repeat', true );
					$select_theme_background_repeat = '<select id="organisation_image_background_repeat" name="organisation_image_background_repeat" class="pf-input-admin">';
						$select_theme_background_repeat .= '<option value="no-repeat"' . selected( $theme_background_repeat, 'no-repeat', false) . '>No repeat</option>';
						$select_theme_background_repeat .= '<option value="repeat-x"' . selected( $theme_background_repeat, 'repeat-x', false) . '>Repeat X</option>';
						$select_theme_background_repeat .= '<option value="repeat-y"' . selected( $theme_background_repeat, 'repeat-y', false) . '>Repeat Y</option>';
						$select_theme_background_repeat .= '<option value="repeat"' . selected( $theme_background_repeat, 'repeat', false) . '>Repeat XY</option>';
					$select_theme_background_repeat .= '</select>';
					echo $select_theme_background_repeat;
				echo '</div>';
		
				echo '<hr class="horizontal-divider">';
		
				echo '<h3 class="pf-h3-admin" id="header"><span class="dashicons dashicons-align-full-width"></span>&nbsp;&nbsp;Header</h3>';
				
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Header</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Header</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_header_title" class="pf-label-admin">Landing page title</label>';
					echo '<input id="organisation_header_title" name="organisation_header_title" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_header_title', true ) ) . '" placeholder="Landing page title" />';
		
					echo '<label for="organisation_header_subtitle" class="pf-label-admin">Landing page subtitle</label>';
					echo '<input id="organisation_header_subtitle" name="organisation_header_subtitle" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_header_subtitle', true ) ) . '" placeholder="Landing page subtitle" />';
		
					echo '<label for="organisation_header_logo_width" class="pf-label-admin">Logo width in pixel</label>';
					echo '<input id="organisation_header_logo_width" name="organisation_header_logo_width" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_header_logo_width', true ) ) . '" placeholder="Logo width in pixel" />';
		
					echo '<label for="organisation_header_menu_color" class="pf-label-admin">Color of menu items</label>';
					echo '<input id="organisation_header_menu_color" name="organisation_header_menu_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_header_menu_color', true ) ) . '" placeholder="" />';
		
					echo '<label for="organisation_header_menu_color_hover" class="pf-label-admin">Color of menu items on hover</label>';
					echo '<input id="organisation_header_menu_color_hover" name="organisation_header_menu_color_hover" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_header_menu_color_hover', true ) ) . '" placeholder="" />';
		
					echo '<label for="organisation_header_min_height" class="pf-label-admin">Minimum height of header (in px)</label>';
					echo '<input id="organisation_header_min_height" name="organisation_header_min_height" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_header_min_height', true ) ) . '" placeholder="Minimum height of header (in px)" />';
		
					echo '<label for="organisation_header_image_background" class="pf-label-admin">Background Image</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
					if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_header_image_background', true ), 'full' ) ){
						echo '<a href="#" class="rudr-upload">';
						echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
						echo '</a>';
						echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
						echo '<input type="hidden" name="organisation_header_image_background" value="'.absint(get_post_meta( $post->ID, '_organisation_header_image_background', true )).'">';
					}else {
						echo '<a href="#" class="button rudr-upload">Upload image</a>';
						echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
						echo '<input type="hidden" name="organisation_header_image_background" value="">';
					}
					echo '</div>';
		
					echo '<label for="organisation_header_image_background_position" class="pf-label-admin">Background Position</label>';
					$theme_header_background_position = get_post_meta( $post->ID, '_organisation_header_image_background_position', true );
					$select_theme_header_background_position = '<select id="organisation_header_image_background_position" name="organisation_header_image_background_position" class="pf-input-admin">';
						$select_theme_header_background_position .= '<option value="top"' . selected( $theme_header_background_position, 'top', false) . '>Top</option>';
						$select_theme_header_background_position .= '<option value="bottom"' . selected( $theme_header_background_position, 'bottom', false) . '>Bottom</option>';
						$select_theme_header_background_position .= '<option value="center"' . selected( $theme_header_background_position, 'center', false) . '>Center</option>';
						$select_theme_header_background_position .= '<option value="left"' . selected( $theme_header_background_position, 'left', false) . '>Left</option>';
						$select_theme_header_background_position .= '<option value="right"' . selected( $theme_header_background_position, 'right', false) . '>Right</option>';
					$select_theme_header_background_position .= '</select>';
					echo $select_theme_header_background_position;
		
					echo '<label for="organisation_header_image_background_size" class="pf-label-admin">Background Size</label>';
					$theme_header_background_size = get_post_meta( $post->ID, '_organisation_header_image_background_size', true );
					$select_theme_header_background_size = '<select id="organisation_image_header_background_size" name="organisation_header_image_background_size" class="pf-input-admin">';
						$select_theme_header_background_size .= '<option value="cover"' . selected( $theme_header_background_size, 'cover', false) . '>Cover</option>';
						$select_theme_header_background_size .= '<option value="contain"' . selected( $theme_header_background_size, 'contain', false) . '>Contain</option>';
					$select_theme_header_background_size .= '</select>';
					echo $select_theme_header_background_size;
		
					echo '<label for="organisation_header_image_background_repeat" class="pf-label-admin">Background Repeat</label>';
					$theme_header_background_repeat = get_post_meta( $post->ID, '_organisation_header_image_background_repeat', true );
					$select_theme_header_background_repeat = '<select id="organisation_header_image_background_repeat" name="organisation_header_image_background_repeat" class="pf-input-admin">';
						$select_theme_header_background_repeat .= '<option value="no-repeat"' . selected( $theme_header_background_repeat, 'no-repeat', false) . '>No repeat</option>';
						$select_theme_header_background_repeat .= '<option value="repeat-x"' . selected( $theme_header_background_repeat, 'repeat-x', false) . '>Repeat X</option>';
						$select_theme_header_background_repeat .= '<option value="repeat-y"' . selected( $theme_header_background_repeat, 'repeat-y', false) . '>Repeat Y</option>';
						$select_theme_header_background_repeat .= '<option value="repeat"' . selected( $theme_header_background_repeat, 'repeat', false) . '>Repeat XY</option>';
					$select_theme_header_background_repeat .= '</select>';
					echo $select_theme_header_background_repeat;
				echo '</div>';

				echo '<hr class="horizontal-divider">';
		
				echo '<h3 class="pf-h3-admin" id="content"><span class="dashicons dashicons-align-wide"></span>&nbsp;&nbsp;Content</h3>';
				
				echo '<div class="div-joyful" style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Content Top</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Content top - Images in photobook mockup</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_image_ph_background_color" class="pf-label-admin">Background color of photobook</label>';
					echo '<input id="organisation_image_ph_background_color" name="organisation_image_ph_background_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_image_ph_background_color', true ) ) . '" placeholder="" />';
		
					echo '<hr class="horizontal-divider-between">';
					
					echo '<label for="organisation_image_ph_placeholder_1" class="pf-label-admin">Photobook Placeholder 1</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_image_ph_placeholder_1', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_image_ph_placeholder_1" value="'.absint(get_post_meta( $post->ID, '_organisation_image_ph_placeholder_1', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_image_ph_placeholder_1" value="">';
						}
					echo '</div>';
		
					echo '<hr class="horizontal-divider-between">';
		
					echo '<label for="organisation_image_ph_placeholder_1_background_color" class="pf-label-admin">Background color of Photobook Placeholder 1 - Text</label>';
					echo '<input id="organisation_image_ph_placeholder_1_background_color" name="organisation_image_ph_placeholder_1_background_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_image_ph_placeholder_1_background_color', true ) ) . '" placeholder="" />';
		
					echo '<label for="organisation_image_ph_placeholder_1_text" class="pf-label-admin">Photobook Placeholder 1 - Text (leave empty to remove block)</label>';
					echo '<input id="organisation_image_ph_placeholder_1_text" name="organisation_image_ph_placeholder_1_text" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_image_ph_placeholder_1_text', true ) ) . '" placeholder="Photobook Placeholder 1 - Text" style="margin-bottom: 20px;" />';
		
					echo '<label for="organisation_image_ph_placeholder_1_text_color" class="pf-label-admin">Text color of Photobook Placeholder 1 - Text</label>';
					echo '<input id="organisation_image_ph_placeholder_1_text_color" name="organisation_image_ph_placeholder_1_text_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_image_ph_placeholder_1_text_color', true ) ) . '" placeholder="" />';
		
					echo '<hr class="horizontal-divider-between">';

					echo '<label for="organisation_image_ph_placeholder_2" class="pf-label-admin">Photobook Placeholder 2</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_image_ph_placeholder_2', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_image_ph_placeholder_2" value="'.absint(get_post_meta( $post->ID, '_organisation_image_ph_placeholder_2', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_image_ph_placeholder_2" value="">';
						}
					echo '</div>';
		
					echo '<label for="organisation_image_ph_placeholder_3" class="pf-label-admin">Photobook Placeholder 3</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_image_ph_placeholder_3', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_image_ph_placeholder_3" value="'.absint(get_post_meta( $post->ID, '_organisation_image_ph_placeholder_3', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_image_ph_placeholder_3" value="">';
						}
					echo '</div>';
		
					echo '<hr class="horizontal-divider-between">';
		
					echo '<label for="organisation_image_ph_placeholder_4_background_color" class="pf-label-admin">Background color of Photobook Placeholder Empty Place</label>';
					echo '<input id="organisation_image_ph_placeholder_4_background_color" name="organisation_image_ph_placeholder_4_background_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_image_ph_placeholder_4_background_color', true ) ) . '" placeholder="" />';
		
					echo '<label for="organisation_image_ph_placeholder_4_text" class="pf-label-admin">Photobook Placeholder Empty Place</label>';
					echo '<input id="organisation_image_ph_placeholder_4_text" name="organisation_image_ph_placeholder_4_text" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_image_ph_placeholder_4_text', true ) ) . '" placeholder="Photobook Placeholder Empty Place" style="margin-bottom: 20px;" />';
		
					echo '<label for="organisation_image_ph_placeholder_4_text_color" class="pf-label-admin">Text color of Photobook Placeholder Empty Place</label>';
					echo '<input id="organisation_image_ph_placeholder_4_text_color" name="organisation_image_ph_placeholder_4_text_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_image_ph_placeholder_4_text_color', true ) ) . '" placeholder="" />';
				echo '</div>';
		
				echo '<div class="div-serene" style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Content Top</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Main images</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<h5 class="pf-h4-admin">Block 1 - Full width</h5>';
		
					echo '<label for="organisation_jumbotron_block1_visibility" class="pf-label-admin">Show/hide this block</label>';
					$theme_jumbotron_block1_visibility = get_post_meta( $post->ID, '_organisation_jumbotron_block1_visibility', true );
					$select_theme_jumbotron_block1_visibility = '<select id="organisation_jumbotron_block1_visibility" name="organisation_jumbotron_block1_visibility" class="pf-input-admin">';
						$select_theme_jumbotron_block1_visibility .= '<option value="show"' . selected( $theme_jumbotron_block1_visibility, 'show', false) . '>Show this block</option>';
						$select_theme_jumbotron_block1_visibility .= '<option value="hide"' . selected( $theme_jumbotron_block1_visibility, 'hide', false) . '>Hide this block</option>';
					$select_theme_jumbotron_block1_visibility .= '</select>';
					echo $select_theme_jumbotron_block1_visibility;
		
					echo '<label for="organisation_jumbotron_block1_minheight" class="pf-label-admin">Minimum height of block</label>';
					echo '<input id="organisation_jumbotron_block1_minheight" name="organisation_jumbotron_block1_minheight" class="pf-input-admin" type="number" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block1_minheight', true ) ) . '" placeholder="300" />';
		
					echo '<label for="organisation_jumbotron_block1_bgcolor" class="pf-label-admin">Background color of block</label>';
					echo '<input id="organisation_jumbotron_block1_bgcolor" name="organisation_jumbotron_block1_bgcolor" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block1_bgcolor', true ) ) . '" placeholder="" />';
					
					echo '<label for="organisation_jumbotron_block1_bgimage" class="pf-label-admin">Background image of block</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_jumbotron_block1_bgimage', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_jumbotron_block1_bgimage" value="'.absint(get_post_meta( $post->ID, '_organisation_jumbotron_block1_bgimage', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_jumbotron_block1_bgimage" value="">';
						}
					echo '</div>';
		
					echo '<label for="organisation_jumbotron_block1_text" class="pf-label-admin">Text inside block</label>';
// 					echo '<input id="organisation_jumbotron_block1_text" name="organisation_jumbotron_block1_text" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block1_text', true ) ) . '" placeholder="Text inside block" style="margin-bottom: 20px;" />';
					wp_editor(get_post_meta( $post->ID, '_organisation_jumbotron_block1_text', true ), "organisation_jumbotron_block1_text", $args_editor);
		
					echo '<label for="organisation_jumbotron_block1_text_color" class="pf-label-admin">Text color</label>';
					echo '<input id="organisation_jumbotron_block1_text_color" name="organisation_jumbotron_block1_text_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block1_text_color', true ) ) . '" placeholder="" />';
		
					echo '<label for="organisation_jumbotron_block1_button_label" class="pf-label-admin">Button label (leave empty to hide button)</label>';
					echo '<input id="organisation_jumbotron_block1_button_label" name="organisation_jumbotron_block1_button_label" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block1_button_label', true ) ) . '" placeholder="Button label" style="margin-bottom: 20px;" />';
		
					echo '<label for="organisation_jumbotron_block1_button_link" class="pf-label-admin">Button link</label>';
					echo '<input id="organisation_jumbotron_block1_button_link" name="organisation_jumbotron_block1_button_link" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block1_button_link', true ) ) . '" placeholder="Button link" style="margin-bottom: 20px;" />';
		
					echo '<hr class="horizontal-divider-between">';
		
					echo '<h5 class="pf-h4-admin">Block 2 & 3</h5>';
		
					echo '<label for="organisation_jumbotron_block23_minheight" class="pf-label-admin">Minimum height of block</label>';
					echo '<input id="organisation_jumbotron_block23_minheight" name="organisation_jumbotron_block23_minheight" class="pf-input-admin" type="number" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block23_minheight', true ) ) . '" placeholder="200" />';
		
					echo '<hr class="horizontal-divider-between">';
		
					echo '<h5 class="pf-h4-admin">Block 2 - Left</h5>';
		
					echo '<label for="organisation_jumbotron_block2_bgcolor" class="pf-label-admin">Background color of block</label>';
					echo '<input id="organisation_jumbotron_block2_bgcolor" name="organisation_jumbotron_block2_bgcolor" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block2_bgcolor', true ) ) . '" placeholder="" />';
					
					echo '<label for="organisation_jumbotron_block2_bgimage" class="pf-label-admin">Background image of block</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_jumbotron_block2_bgimage', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_jumbotron_block2_bgimage" value="'.absint(get_post_meta( $post->ID, '_organisation_jumbotron_block2_bgimage', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_jumbotron_block2_bgimage" value="">';
						}
					echo '</div>';
		
					echo '<label for="organisation_jumbotron_block2_text" class="pf-label-admin">Text inside block</label>';
// 					echo '<input id="organisation_jumbotron_block2_text" name="organisation_jumbotron_block2_text" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block2_text', true ) ) . '" placeholder="Text inside block" style="margin-bottom: 20px;" />';
					wp_editor(get_post_meta( $post->ID, '_organisation_jumbotron_block2_text', true ), "organisation_jumbotron_block2_text", $args_editor);
		
					echo '<label for="organisation_jumbotron_block2_text_color" class="pf-label-admin">Text color</label>';
					echo '<input id="organisation_jumbotron_block2_text_color" name="organisation_jumbotron_block2_text_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block2_text_color', true ) ) . '" placeholder="" />';
		
					echo '<hr class="horizontal-divider-between">';
		
					echo '<h5 class="pf-h4-admin">Block 3 - Right</h5>';
		
					echo '<label for="organisation_jumbotron_block3_bgcolor" class="pf-label-admin">Background color of block</label>';
					echo '<input id="organisation_jumbotron_block3_bgcolor" name="organisation_jumbotron_block3_bgcolor" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block3_bgcolor', true ) ) . '" placeholder="" />';
					
					echo '<label for="organisation_jumbotron_block3_bgimage" class="pf-label-admin">Background image of block</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 40px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_jumbotron_block3_bgimage', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_jumbotron_block3_bgimage" value="'.absint(get_post_meta( $post->ID, '_organisation_jumbotron_block3_bgimage', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_jumbotron_block3_bgimage" value="">';
						}
					echo '</div>';
		
					echo '<label for="organisation_jumbotron_block3_text" class="pf-label-admin">Text inside block</label>';
// 					echo '<input id="organisation_jumbotron_block3_text" name="organisation_jumbotron_block3_text" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block3_text', true ) ) . '" placeholder="Text inside block" style="margin-bottom: 20px;" />';
					wp_editor(get_post_meta( $post->ID, '_organisation_jumbotron_block3_text', true ), "organisation_jumbotron_block3_text", $args_editor);
		
					echo '<label for="organisation_jumbotron_block3_text_color" class="pf-label-admin">Text color</label>';
					echo '<input id="organisation_jumbotron_block3_text_color" name="organisation_jumbotron_block3_text_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_jumbotron_block3_text_color', true ) ) . '" placeholder="" />';
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Headline</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Headline</h4>';
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_headline_title" class="pf-label-admin">Headline title</label>';
					echo '<input id="organisation_headline_title" name="organisation_headline_title" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_headline_title', true ) ) . '" placeholder="Headline title" />';

					echo '<label for="organisation_headline_subtitle" class="pf-label-admin">Headline subtitle</label>';
					echo '<input id="organisation_headline_subtitle" name="organisation_headline_subtitle" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_headline_subtitle', true ) ) . '" placeholder="Headline subtitle" />';
		
					echo '<label for="organisation_headline_button_label" class="pf-label-admin">Headline button label</label>';
					echo '<input id="organisation_headline_button_label" name="organisation_headline_button_label" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_headline_button_label', true ) ) . '" placeholder="Headline button label" />';
				echo '</div>';
				
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Products</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Products block</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_products_background_color" class="pf-label-admin">Background color of Products block</label>';
					echo '<input id="organisation_products_background_color" name="organisation_products_background_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_products_background_color', true ) ) . '" placeholder="" />';
		
					echo '<label for="organisation_products_title_visibility" class="pf-label-admin">Show/hide products block title</label>';
					$theme_products_title_visibility = get_post_meta( $post->ID, '_organisation_products_title_visibility', true );
					$select_theme_products_title_visibility = '<select id="organisation_products_title_visibility" name="organisation_products_title_visibility" class="pf-input-admin">';
						$select_theme_products_title_visibility .= '<option value="show"' . selected( $theme_products_title_visibility, 'show', false) . '>Show products block title</option>';
						$select_theme_products_title_visibility .= '<option value="hide"' . selected( $theme_products_title_visibility, 'hide', false) . '>Hide products block title</option>';
					$select_theme_products_title_visibility .= '</select>';
					echo $select_theme_products_title_visibility;
					
					echo '<label for="organisation_products_title" class="pf-label-admin">Products block title (default if empty: Our Products)</label>';
					echo '<input id="organisation_products_title" name="organisation_products_title" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_products_title', true ) ) . '" placeholder="Products block title" />';
		
					echo '<label for="organisation_products_hide_product_titles" class="pf-label-admin">Show/hide product titles</label>';
					$theme_products_hide_product_titles = get_post_meta( $post->ID, '_organisation_products_hide_product_titles', true );
					$select_theme_products_hide_product_titles = '<select id="organisation_products_hide_product_titles" name="organisation_products_hide_product_titles" class="pf-input-admin">';
						$select_theme_products_hide_product_titles .= '<option value="show"' . selected( $theme_products_hide_product_titles, 'show', false) . '>Show product titles</option>';
						$select_theme_products_hide_product_titles .= '<option value="hide"' . selected( $theme_products_hide_product_titles, 'hide', false) . '>Hide product titles</option>';
					$select_theme_products_hide_product_titles .= '</select>';
					echo $select_theme_products_hide_product_titles;
		
					echo '<label for="organisation_products_text_color" class="pf-label-admin">Text color of Products block</label>';
					echo '<input id="organisation_products_text_color" name="organisation_products_text_color" class="color-field" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_products_text_color', true ) ) . '" placeholder="" />';
		
					echo '<label for="organisation_products_button_label" class="pf-label-admin">Products button label (for all products)<br/><small>You can set a button label for each product separate in the Products tab</small></label>';
					echo '<input id="organisation_products_button_label" name="organisation_products_button_label" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_products_button_label', true ) ) . '" placeholder="Products button label" />';
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Advantages</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Advantage blocks</h4>';
					echo '<hr class="horizontal-divider">';

					echo '<label for="organisation_advantage_1_order" class="pf-label-admin">Order of Advantage 1</label>';
					$organisation_advantage_1_order = get_post_meta( $post->ID, '_organisation_advantage_1_order', true );
					$select_organisation_advantage_1_order = '<select id="organisation_advantage_1_order" name="organisation_advantage_1_order" class="pf-input-admin">';
						$select_organisation_advantage_1_order .= '<option value="content-first"' . selected( $organisation_advantage_1_order, 'content-first', false) . '>Content first, image second</option>';
						$select_organisation_advantage_1_order .= '<option value="image-first"' . selected( $organisation_advantage_1_order, 'image-first', false) . '>Image first, content second</option>';
					$select_organisation_advantage_1_order .= '</select>';
					echo $select_organisation_advantage_1_order;
					
					echo '<label for="organisation_advantage_1_text_left" class="pf-label-admin">Advantage 1 - Text Left</label>';
					// echo '<textarea id="organisation_advantage_1_text_left" name="organisation_advantage_1_text_left" class="pf-input-admin" rows="4" cols="50" placeholder="Advantage 1 - Text Left">' . esc_attr( get_post_meta( $post->ID, '_organisation_advantage_1_text_left', true ) ) . '</textarea>';
					wp_editor(get_post_meta( $post->ID, '_organisation_advantage_1_text_left', true ), "organisation_advantage_1_text_left", $args_editor);
					echo '<br>';
		
					echo '<label for="organisation_advantage_1_image_right" class="pf-label-admin">Advantage 1 - Image Right</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_advantage_1_image_right', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_advantage_1_image_right" value="'.absint(get_post_meta( $post->ID, '_organisation_advantage_1_image_right', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_advantage_1_image_right" value="">';
						}
					echo '</div>';
					
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_advantage_2_image_left" class="pf-label-admin">Advantage 2 - Image Left</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_advantage_2_image_left', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_advantage_2_image_left" value="'.absint(get_post_meta( $post->ID, '_organisation_advantage_2_image_left', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_advantage_2_image_left" value="">';
						}
					echo '</div>';
		
					echo '<br>';
		
					echo '<label for="organisation_advantage_2_text_right" class="pf-label-admin">Advantage 2 - Text Right</label>';
					// echo '<textarea id="organisation_advantage_2_text_right" name="organisation_advantage_2_text_right" class="pf-input-admin" rows="4" cols="50" placeholder="Advantage 2 - Text Right">' . esc_attr( get_post_meta( $post->ID, '_organisation_advantage_2_text_right', true ) ) . '</textarea>';
					wp_editor(get_post_meta( $post->ID, '_organisation_advantage_2_text_right', true ), "organisation_advantage_2_text_right", $args_editor);
					
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_advantage_3_text_left" class="pf-label-admin">Advantage 3 - Text Left</label>';
					// echo '<textarea id="organisation_advantage_3_text_left" name="organisation_advantage_3_text_left" class="pf-input-admin" rows="4" cols="50" placeholder="Advantage 3 - Text Left">' . esc_attr( get_post_meta( $post->ID, '_organisation_advantage_3_text_left', true ) ) . '</textarea>';
					wp_editor(get_post_meta( $post->ID, '_organisation_advantage_3_text_left', true ), "organisation_advantage_3_text_left", $args_editor);
					echo '<br>';
		
					echo '<label for="organisation_advantage_3_image_right" class="pf-label-admin">Advantage 3 - Image Right</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_advantage_3_image_right', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_advantage_3_image_right" value="'.absint(get_post_meta( $post->ID, '_organisation_advantage_3_image_right', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_advantage_3_image_right" value="">';
						}
					echo '</div>';
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Free Content</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Free Content block</h4>';
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_freeblock_title" class="pf-label-admin">Free Content Block - Title</label>';
					echo '<input id="organisation_freeblock_title" name="organisation_freeblock_title" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_freeblock_title', true ) ) . '" placeholder="Free Content Block - Title" />';
		
					echo '<br>';
					echo '<br>';

					echo '<label for="organisation_freeblock_content" class="pf-label-admin">Free Content Block - Content</label>';
// 					echo '<input id="organisation_freeblock_content" name="organisation_freeblock_content" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_freeblock_content', true ) ) . '" placeholder="Free Content Block - Content" />';
					wp_editor(get_post_meta( $post->ID, '_organisation_freeblock_content', true ), "organisation_freeblock_content", $args_editor);
					echo '<br>';
		
					echo '<label for="organisation_freeblock_image" class="pf-label-admin">Free Content Block - Image</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
					if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_freeblock_image', true ), 'full' ) ){
						echo '<a href="#" class="rudr-upload">';
						echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
						echo '</a>';
						echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
						echo '<input type="hidden" name="organisation_freeblock_image" value="'.absint(get_post_meta( $post->ID, '_organisation_freeblock_image', true )).'">';
					}else {
						echo '<a href="#" class="button rudr-upload">Upload image</a>';
						echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
						echo '<input type="hidden" name="organisation_freeblock_image" value="">';
					}
					echo '</div>';
		
					echo '<label for="organisation_freeblock_button_label" class="pf-label-admin">Free Content Block - Button label</label>';
					echo '<input id="organisation_freeblock_button_label" name="organisation_freeblock_button_label" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_freeblock_button_label', true ) ) . '" placeholder="Free Content Block - Button label" />';
		
					echo '<label for="organisation_freeblock_button_url" class="pf-label-admin">Free Content Block - Button URL</label>';
					echo '<input id="organisation_freeblock_button_url" name="organisation_freeblock_button_url" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_freeblock_button_url', true ) ) . '" placeholder="Free Content Block - Button URL" />';
				echo '</div>';
		
				echo '<hr class="horizontal-divider">';
		
				echo '<h3 class="pf-h3-admin" id="footer"><span class="dashicons dashicons-align-full-width" style="transform: rotate(180deg);"></span>&nbsp;&nbsp;Footer</h3>';
				
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Footer</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Footer Block 1</h4>';
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_footer_block1_title" class="pf-label-admin">Title</label>';
					echo '<input id="organisation_footer_block1_title" name="organisation_footer_block1_title" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_footer_block1_title', true ) ) . '" placeholder="Title for footer block 1" />';

					echo '<label for="organisation_footer_block1_content" class="pf-label-admin">Content</label>';
// 					echo '<textarea id="organisation_footer_block1_content" name="organisation_footer_block1_content" class="pf-input-admin" rows="4" cols="50" placeholder="Content for footer block 1">' . esc_attr( get_post_meta( $post->ID, '_organisation_footer_block1_content', true ) ) . '</textarea>';
					wp_editor(get_post_meta( $post->ID, '_organisation_footer_block1_content', true ), "organisation_footer_block1_content", $args_editor);
				echo '</div>';
			?>
		</div>

		<div id="Logo" class="tabcontent" style="display: none;">
			<?php
				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-format-image"></span>&nbsp;&nbsp;Logo</h3>';
		
				echo '<div class="" style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px;">';
					echo '<h4 class="pf-h4-admin">Logo</h4>';
					echo '<hr class="horizontal-divider">';

					echo '<label for="organisation_logo_favicon" class="pf-label-admin">Favicon (small image in browser tab, preferred size 512x512 px)</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_logo_favicon', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 50px;" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_logo_favicon" value="'.absint(get_post_meta( $post->ID, '_organisation_logo_favicon', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_logo_favicon" value="">';
						}
					echo '</div>';

					echo '<label for="organisation_logo_color" class="pf-label-admin">Organisation logo - Color</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_logo_color', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_logo_color" value="'.absint(get_post_meta( $post->ID, '_organisation_logo_color', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_logo_color" value="">';
						}
					echo '</div>';

					echo '<label for="organisation_logo_bw" class="pf-label-admin">Organisation logo - Black & white</label>';
					echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
						if( $image = wp_get_attachment_image_url( get_post_meta( $post->ID, '_organisation_logo_bw', true ), 'full' ) ){
							echo '<a href="#" class="rudr-upload">';
								echo '<img src="'.esc_url( $image ).'" style="width: 30%" />';
							echo '</a>';
							echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
							echo '<input type="hidden" name="organisation_logo_bw" value="'.absint(get_post_meta( $post->ID, '_organisation_logo_bw', true )).'">';
						}else {
							echo '<a href="#" class="button rudr-upload">Upload image</a>';
							echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
							echo '<input type="hidden" name="organisation_logo_bw" value="">';
						}
					echo '</div>';
				echo '</div>';
		
				
			?>
		</div>

		<div id="Colors" class="tabcontent" style="display: none;">
			<?php
				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-color-picker"></span>&nbsp;&nbsp;Colors</h3>';
		
				
			?>
		</div>
		
		<div id="Fonts" class="tabcontent" style="display: none;">
			<?php
				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-editor-textcolor"></span>&nbsp;&nbsp;Typography</h3>';
				
				$paragraph_font_size = (get_post_meta( $post->ID, '_organisation_paragraph_font_size', true )) ? get_post_meta( $post->ID, '_organisation_paragraph_font_size', true ) : '16';
				$paragraph_line_height = (get_post_meta( $post->ID, '_organisation_paragraph_line_height', true )) ? get_post_meta( $post->ID, '_organisation_paragraph_line_height', true ) : '20';
				$paragraph_font = get_post_meta( $post->ID, '_organisation_paragraph_font', true );
				$paragraph_font_weight = (get_post_meta( $post->ID, '_organisation_paragraph_font_weight', true )) ? get_post_meta( $post->ID, '_organisation_paragraph_font_weight', true ) : '400';
		
				$heading_font = get_post_meta( $post->ID, '_organisation_heading_font', true );
				$heading_font_weight = (get_post_meta( $post->ID, '_organisation_heading_font_weight', true )) ? get_post_meta( $post->ID, '_organisation_heading_font_weight', true ) : '700';
		
				$heading1_font_size = (get_post_meta( $post->ID, '_organisation_heading1_font_size', true )) ? get_post_meta( $post->ID, '_organisation_heading1_font_size', true ) : '50';
				$heading1_margin_bottom = (get_post_meta( $post->ID, '_organisation_heading1_margin_bottom', true )) ? get_post_meta( $post->ID, '_organisation_heading1_margin_bottom', true ) : '10';
				
				$heading2_font_size = (get_post_meta( $post->ID, '_organisation_heading2_font_size', true )) ? get_post_meta( $post->ID, '_organisation_heading2_font_size', true ) : '40';
				$heading2_margin_bottom = (get_post_meta( $post->ID, '_organisation_heading2_margin_bottom', true )) ? get_post_meta( $post->ID, '_organisation_heading2_margin_bottom', true ) : '10';
				
				$heading3_font_size = (get_post_meta( $post->ID, '_organisation_heading3_font_size', true )) ? get_post_meta( $post->ID, '_organisation_heading3_font_size', true ) : '30';
				$heading3_margin_bottom = (get_post_meta( $post->ID, '_organisation_heading3_margin_bottom', true )) ? get_post_meta( $post->ID, '_organisation_heading3_margin_bottom', true ) : '10';
				
				$heading4_font_size = (get_post_meta( $post->ID, '_organisation_heading4_font_size', true )) ? get_post_meta( $post->ID, '_organisation_heading4_font_size', true ) : '24';
				$heading4_margin_bottom = (get_post_meta( $post->ID, '_organisation_heading4_margin_bottom', true )) ? get_post_meta( $post->ID, '_organisation_heading4_margin_bottom', true ) : '10';
				
				$heading5_font_size = (get_post_meta( $post->ID, '_organisation_heading5_font_size', true )) ? get_post_meta( $post->ID, '_organisation_heading5_font_size', true ) : '20';
				$heading5_margin_bottom = (get_post_meta( $post->ID, '_organisation_heading5_margin_bottom', true )) ? get_post_meta( $post->ID, '_organisation_heading5_margin_bottom', true ) : '10';
				
				$heading6_font_size = (get_post_meta( $post->ID, '_organisation_heading6_font_size', true )) ? get_post_meta( $post->ID, '_organisation_heading6_font_size', true ) : '16';
				$heading6_margin_bottom = (get_post_meta( $post->ID, '_organisation_heading6_margin_bottom', true )) ? get_post_meta( $post->ID, '_organisation_heading6_margin_bottom', true ) : '10';
				
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Paragraphs - Body text</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Paragraphs - Body text</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_font_main" class="pf-label-admin">Preview of paragraph <span style="font-weight: 400;">(regenerated after saving changes)</span></label><br/>';
					echo '<div style="border: 1px solid #ccc; background-color: white; padding: 20px; font-family: '.$paragraph_font.'; font-size: '.$paragraph_font_size.'px; line-height: '.$paragraph_line_height.'px; font-weight: '.$paragraph_font_weight.';">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque urna nibh, vulputate nec gravida ac, eleifend ultricies turpis. Quisque aliquam augue at massa rutrum, vitae ultrices leo eleifend. Aenean tempor velit in eros finibus ornare. Aenean rutrum maximus quam ac dictum. Mauris euismod orci non lorem posuere porttitor. </div>';
		
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_paragraph_font_size" class="pf-label-admin">Font size in px</label>';
					echo '<input id="organisation_paragraph_font_size" name="organisation_paragraph_font_size" class="pf-input-admin" type="number" min="0" value="' . $paragraph_font_size . '" placeholder="Font size in px" />';
		
					echo '<label for="organisation_paragraph_line_height" class="pf-label-admin">Line height in px</label>';
					echo '<input id="organisation_paragraph_line_height" name="organisation_paragraph_line_height" class="pf-input-admin" type="number" min="0" value="' . $paragraph_line_height . '" placeholder="Line height in px" />';
		
					echo '<label for="organisation_paragraph_font" class="pf-label-admin">Font</label>';
					$select_organisation_paragraph_font = '<select id="organisation_paragraph_font" name="organisation_paragraph_font" class="pf-input-admin">';	
						$select_organisation_paragraph_font .= '<option value="Museo-Sans-Rounded-500"' . selected( $paragraph_font, 'Museo-Sans-Rounded-500', false) . '>Museo Sans Rounded</option>';
						$select_organisation_paragraph_font .= '<option value="Arial, Helvetica Neue, Helvetica, sans-serif"' . selected( $paragraph_font, 'Arial, Helvetica Neue, Helvetica, sans-serif', false) . '>Arial</option>';
						$select_organisation_paragraph_font .= '<option value="Baskerville, Baskerville Old Face, Garamond, Times New Roman, serif"' . selected( $paragraph_font, 'Baskerville, Baskerville Old Face, Garamond, Times New Roman, serif', false) . '>Baskerville</option>';
						$select_organisation_paragraph_font .= '<option value="Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif"' . selected( $paragraph_font, 'Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif', false) . '>Calibri</option>';
						$select_organisation_paragraph_font .= '<option value="Century Gothic, CenturyGothic, AppleGothic, sans-serif"' . selected( $paragraph_font, 'Century Gothic, CenturyGothic, AppleGothic, sans-serif', false) . '>Century Gothic</option>';
						$select_organisation_paragraph_font .= '<option value="Roboto"' . selected( $paragraph_font, 'Roboto', false) . '>Roboto</option>';
					$select_organisation_paragraph_font .= '</select>';
					echo $select_organisation_paragraph_font;
		
					echo '<label for="organisation_paragraph_font_weight" class="pf-label-admin">Font weight</label>';
					$select_paragraph_font_weight = '<select id="organisation_paragraph_font_weight" name="organisation_paragraph_font_weight" class="pf-input-admin">';	
						$select_paragraph_font_weight .= '<option value="400"' . selected( $paragraph_font_weight, '400', false) . '>Default</option>';
						$select_paragraph_font_weight .= '<option value="100"' . selected( $paragraph_font_weight, '100', false) . '>Thin</option>';
						$select_paragraph_font_weight .= '<option value="400"' . selected( $paragraph_font_weight, '400', false) . '>Regular</option>';
						$select_paragraph_font_weight .= '<option value="700"' . selected( $paragraph_font_weight, '700', false) . '>Bold</option>';
					$select_paragraph_font_weight .= '</select>';
					echo $select_paragraph_font_weight;
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Heading</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Heading font</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_heading_font" class="pf-label-admin">Font</label>';
					$select_organisation_heading_font = '<select id="organisation_heading_font" name="organisation_heading_font" class="pf-input-admin">';	
						$select_organisation_heading_font .= '<option value="Museo-Sans-Rounded-500"' . selected( $heading_font, 'Museo-Sans-Rounded-500', false) . '>Museo Sans Rounded</option>';
						$select_organisation_heading_font .= '<option value="Arial, Helvetica Neue, Helvetica, sans-serif"' . selected( $heading_font, 'Arial, Helvetica Neue, Helvetica, sans-serif', false) . '>Arial</option>';
						$select_organisation_heading_font .= '<option value="Baskerville, Baskerville Old Face, Garamond, Times New Roman, serif"' . selected( $heading_font, 'Baskerville, Baskerville Old Face, Garamond, Times New Roman, serif', false) . '>Baskerville</option>';
						$select_organisation_heading_font .= '<option value="Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif"' . selected( $heading_font, 'Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif', false) . '>Calibri</option>';
						$select_organisation_heading_font .= '<option value="Century Gothic, CenturyGothic, AppleGothic, sans-serif"' . selected( $heading_font, 'Century Gothic, CenturyGothic, AppleGothic, sans-serif', false) . '>Century Gothic</option>';
						$select_organisation_heading_font .= '<option value="Roboto"' . selected( $paragraph_font, 'Roboto', false) . '>Roboto</option>';
					$select_organisation_heading_font .= '</select>';
					echo $select_organisation_heading_font;
		
					
					echo '<label for="organisation_heading_font_weight" class="pf-label-admin">Font weight</label>';
					$select_heading_font_weight = '<select id="organisation_heading_font_weight" name="organisation_heading_font_weight" class="pf-input-admin">';	
						$select_heading_font_weight .= '<option value="400"' . selected( $heading_font_weight, '700', false) . '>Default</option>';
						$select_heading_font_weight .= '<option value="100"' . selected( $heading_font_weight, '100', false) . '>Thin</option>';
						$select_heading_font_weight .= '<option value="400"' . selected( $heading_font_weight, '400', false) . '>Regular</option>';
						$select_heading_font_weight .= '<option value="700"' . selected( $heading_font_weight, '700', false) . '>Bold</option>';
					$select_heading_font_weight .= '</select>';
					echo $select_heading_font_weight;
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Heading 1</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Heading 1</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_font_main" class="pf-label-admin">Preview of font <span style="font-weight: 400;">(regenerated after saving changes)</span></label><br/>';
					echo '<div style="border: 1px solid #ccc; background-color: white; padding: 20px; font-family: '.$heading_font.'; font-size: '.$heading1_font_size.'px; font-weight: '.$heading_font_weight.';">The quick brown fox jumps over the lazy dog</div>';
		
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_heading1_font_size" class="pf-label-admin">Font size in px</label>';
					echo '<input id="organisation_heading1_font_size" name="organisation_heading1_font_size" class="pf-input-admin" type="number" value="'.$heading1_font_size.'" placeholder="Font size in px" />';
		
					echo '<label for="organisation_heading1_margin_bottom" class="pf-label-admin">Margin below</label>';
					echo '<input id="organisation_heading1_margin_bottom" name="organisation_heading1_margin_bottom" class="pf-input-admin" type="number" value="'.$heading1_margin_bottom.'" placeholder="Margin bottom in px" />';
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Heading 2</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Heading 2</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_font_main" class="pf-label-admin">Preview of font <span style="font-weight: 400;">(regenerated after saving changes)</span></label><br/>';
					echo '<div style="border: 1px solid #ccc; background-color: white; padding: 20px; font-family: '.$heading_font.'; font-size: '.$heading2_font_size.'px; font-weight: '.$heading_font_weight.';">The quick brown fox jumps over the lazy dog</div>';
		
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_heading2_font_size" class="pf-label-admin">Font size in px</label>';
					echo '<input id="organisation_heading2_font_size" name="organisation_heading2_font_size" class="pf-input-admin" type="number" value="'.$heading2_font_size.'" placeholder="Font size in px" />';
		
					echo '<label for="organisation_heading2_margin_bottom" class="pf-label-admin">Margin below</label>';
					echo '<input id="organisation_heading2_margin_bottom" name="organisation_heading2_margin_bottom" class="pf-input-admin" type="number" value="'.$heading2_margin_bottom.'" placeholder="Margin bottom in px" />';
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Heading 3</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Heading 3</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_font_main" class="pf-label-admin">Preview of font <span style="font-weight: 400;">(regenerated after saving changes)</span></label><br/>';
					echo '<div style="border: 1px solid #ccc; background-color: white; padding: 20px; font-family: '.$heading_font.'; font-size: '.$heading3_font_size.'px; font-weight: '.$heading_font_weight.';">The quick brown fox jumps over the lazy dog</div>';
		
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_heading3_font_size" class="pf-label-admin">Font size in px</label>';
					echo '<input id="organisation_heading3_font_size" name="organisation_heading3_font_size" class="pf-input-admin" type="number" value="'.$heading3_font_size.'" placeholder="Font size in px" />';
		
					echo '<label for="organisation_heading3_margin_bottom" class="pf-label-admin">Margin below</label>';
					echo '<input id="organisation_heading3_margin_bottom" name="organisation_heading3_margin_bottom" class="pf-input-admin" type="number" value="'.$heading3_margin_bottom.'" placeholder="Margin bottom in px" />';
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Heading 4</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Heading 4</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_font_main" class="pf-label-admin">Preview of font <span style="font-weight: 400;">(regenerated after saving changes)</span></label><br/>';
					echo '<div style="border: 1px solid #ccc; background-color: white; padding: 20px; font-family: '.$heading_font.'; font-size: '.$heading4_font_size.'px; font-weight: '.$heading_font_weight.';">The quick brown fox jumps over the lazy dog</div>';
		
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_heading4_font_size" class="pf-label-admin">Font size in px</label>';
					echo '<input id="organisation_heading4_font_size" name="organisation_heading4_font_size" class="pf-input-admin" type="number" value="'.$heading4_font_size.'" placeholder="Font size in px" />';
		
					echo '<label for="organisation_heading4_margin_bottom" class="pf-label-admin">Margin below</label>';
					echo '<input id="organisation_heading4_margin_bottom" name="organisation_heading4_margin_bottom" class="pf-input-admin" type="number" value="'.$heading4_margin_bottom.'" placeholder="Margin bottom in px" />';
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Heading 5</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Heading 5</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_font_main" class="pf-label-admin">Preview of font <span style="font-weight: 400;">(regenerated after saving changes)</span></label><br/>';
					echo '<div style="border: 1px solid #ccc; background-color: white; padding: 20px; font-family: '.$heading_font.'; font-size: '.$heading5_font_size.'px; font-weight: '.$heading_font_weight.';">The quick brown fox jumps over the lazy dog</div>';
		
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_heading5_font_size" class="pf-label-admin">Font size in px</label>';
					echo '<input id="organisation_heading5_font_size" name="organisation_heading5_font_size" class="pf-input-admin" type="number" value="'.$heading5_font_size.'" placeholder="Font size in px" />';
		
					echo '<label for="organisation_heading5_margin_bottom" class="pf-label-admin">Margin below</label>';
					echo '<input id="organisation_heading5_margin_bottom" name="organisation_heading5_margin_bottom" class="pf-input-admin" type="number" value="'.$heading5_margin_bottom.'" placeholder="Margin bottom in px" />';
				echo '</div>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Heading 6</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Heading 6</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_font_main" class="pf-label-admin">Preview of font <span style="font-weight: 400;">(regenerated after saving changes)</span></label><br/>';
					echo '<div style="border: 1px solid #ccc; background-color: white; padding: 20px; font-family: '.$heading_font.'; font-size: '.$heading6_font_size.'px; font-weight: '.$heading_font_weight.';">The quick brown fox jumps over the lazy dog</div>';
		
					echo '<hr class="horizontal-divider">';
					
					echo '<label for="organisation_heading6_font_size" class="pf-label-admin">Font size in px</label>';
					echo '<input id="organisation_heading6_font_size" name="organisation_heading6_font_size" class="pf-input-admin" type="number" value="'.$heading6_font_size.'" placeholder="Font size in px" />';
		
					echo '<label for="organisation_heading6_margin_bottom" class="pf-label-admin">Margin below</label>';
					echo '<input id="organisation_heading6_margin_bottom" name="organisation_heading6_margin_bottom" class="pf-input-admin" type="number" value="'.$heading6_margin_bottom.'" placeholder="Margin bottom in px" />';
				echo '</div>';
		
			?>
		</div>
		
		<div id="Products" class="tabcontent" style="display: none;">
			<?php
				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-cart"></span>&nbsp;&nbsp;Products</h3>';
		
				echo '<p>Check all products that will be sold on the landing page</p>';
				
				$args = array(
					'limit' => -1,
					'status' => 'publish',
					'return' => 'ids',
				);
				$products = wc_get_products( $args );
		
				
		
				$array_custom_images = (!empty(get_post_meta( $post->ID, '_organisation_products_custom_images', true ))) ? get_post_meta( $post->ID, '_organisation_products_custom_images', true ) : [];
				
				foreach($products as $id => $product_id){				
					$checked = '';
					if(!empty(get_post_meta( $post->ID, '_organisation_products', true ))){
						if (in_array($product_id, get_post_meta( $post->ID, '_organisation_products', true ))) {
							$checked = 'checked';
						}
					}
					
					
					
					echo '<div class="" style="margin-bottom: 0px;">';
						
						echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
							echo '<input id="organisation_products_' . $product_id . '" name="organisation_products[]" class="pf-checkbox-admin" type="checkbox" '.$checked.' value="' . $product_id . '" style="margin-top: -10px;" />&nbsp;<label for="organisation_products_' . $product_id . '" style="vertical-align: text-bottom; font-size: 16px; font-weight: bold;">#'.$product_id.' - ' . get_the_title( $product_id ) . ' - <a href="'.get_permalink( $product_id ).'?organisationid=' . esc_attr( get_post_meta( $post->ID, '_organisation_editor_id', true ) ) . '" target="_blank" style="font-weight: 500; font-size: 12px;">View product</a></label>';
							echo '<a type="button" class="collapsiblebutton" style="float: right;">Customize</a>';
							
							if((!empty($array_custom_images[$product_id]['main_image'])) OR (!empty($array_custom_images[$product_id]['additional_image_1'])) OR (!empty($array_custom_images[$product_id]['custom_short_description'])) OR (!empty($array_custom_images[$product_id]['custom_long_description']))){
								echo '<span style="color: #424b54; font-weight: bold; background-color: #CCE5FF; border: 2px solid #424b54; padding: 5px; margin-top: -7px; margin-right: 10px; float: right;">This product is customized</span>';
							}
						echo '</div>';
					
						echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
							echo '<h4 class="pf-h4-admin">Customization options for ' . get_the_title( $product_id ) . '</h4>';
							echo '<hr class="horizontal-divider">';
					
// 							print_r('<pre>');
// 							print_r($array_custom_images);
// 							print_r('</pre>');
					
							if (array_key_exists($product_id, $array_custom_images) && !empty($array_custom_images[$product_id]['main_image'])){
								echo '<label for="" class="pf-label-admin">Standard product image will not be used</label>';
								echo '<div style="display: inline-block; width: 100%; margin-bottom: 20px;">';
									$product = wc_get_product( $product_id );
									echo '<img src="'.wp_get_attachment_image_url($product->get_image_id(), 'thumbnail' ).'" style="opacity: 0.2;"><br/>';
									echo '<a href="'.wp_get_attachment_image_url($product->get_image_id(), 'full' ).'" target="_blank">View full size</a>';
								echo '</div>';
							}else {
								echo '<label for="" class="pf-label-admin">Standard product image</label>';
								echo '<div style="display: inline-block; width: 100%; margin-bottom: 20px;">';
									$product = wc_get_product( $product_id );      
									echo '<img src="'.wp_get_attachment_image_url($product->get_image_id(), 'thumbnail' ).'"><br/>';
									echo '<a href="'.wp_get_attachment_image_url($product->get_image_id(), 'full' ).'" target="_blank">View full size</a>';
								echo '</div>';
							}
							
							echo '<label for="organisation_products_custom_images['.$product_id.'][main_image]" class="pf-label-admin">Custom product image</label>';
							echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
								if (array_key_exists($product_id, $array_custom_images)){
									if( $image = wp_get_attachment_image_url( $array_custom_images[$product_id]['main_image'], 'thumbnail' ) ){
										echo '<a href="#" class="rudr-upload">';
										echo '<img src="'.esc_url( $image ).'" style="" />';
										echo '</a>';
										echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
										echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][main_image]" value="'.$array_custom_images[$product_id]['main_image'].'">';
									}else {
										echo '<a href="#" class="button rudr-upload">Upload image</a>';
										echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
										echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][main_image]" value="">';
									}
								}else{
									echo '<a href="#" class="button rudr-upload">Upload image</a>';
									echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
									echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][main_image]" value="">';
								}
							echo '</div>';
					
					
					
							echo '<label for="organisation_products_custom_images['.$product_id.'][show_default_additional_images]" class="pf-label-admin">Show default additional images</label>';
							if(isset($array_custom_images[$product_id]['show_default_additional_images'])){
								$product_default_additional_images = $array_custom_images[$product_id]['show_default_additional_images'];
								$select_default_additional = '<select id="organisation_products_custom_images['.$product_id.'][show_default_additional_images]" name="organisation_products_custom_images['.$product_id.'][show_default_additional_images]" class="pf-input-admin">';
									$select_default_additional .= '<option value="true"' . selected( $product_default_additional_images, 'true', false) . '>Yes</option>';
									$select_default_additional .= '<option value="false"' . selected( $product_default_additional_images, 'false', false) . '>No</option>';
								$select_default_additional .= '</select>';
								echo $select_default_additional;
							}else {
								$select_default_additional = '<select id="organisation_products_custom_images['.$product_id.'][show_default_additional_images]" name="organisation_products_custom_images['.$product_id.'][show_default_additional_images]" class="pf-input-admin">';
									$select_default_additional .= '<option value="true">Yes</option>';
									$select_default_additional .= '<option value="false">No</option>';
								$select_default_additional .= '</select>';
								echo $select_default_additional;
							}
					
							echo '<label for="organisation_products_custom_images['.$product_id.'][additional_images]" class="pf-label-admin">Custom additional product images<br/><small>You can upload up to 4 additional custom images</small></label><br/><br/>';
							echo '<div style="display: inline-block; width: 24%; margin-top: 5px; margin-bottom: 20px;">';
								if (array_key_exists($product_id, $array_custom_images)){
									if( $image = wp_get_attachment_image_url( $array_custom_images[$product_id]['additional_image_1'], 'thumbnail' ) ){
										echo '<a href="#" class="rudr-upload">';
										echo '<img src="'.esc_url( $image ).'" style="" />';
										echo '</a>';
										echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
										echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_1]" value="'.$array_custom_images[$product_id]['additional_image_1'].'">';
									}else {
										echo '<a href="#" class="button rudr-upload">Upload image 1</a>';
										echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
										echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_1]" value="">';
									}
								}else{
									echo '<a href="#" class="button rudr-upload">Upload image 1</a>';
									echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
									echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_1]" value="">';
								}
							echo '</div>';
					
							echo '<div style="display: inline-block; width: 24%; margin-top: 5px; margin-bottom: 20px;">';
								if (array_key_exists($product_id, $array_custom_images)){
									if( $image = wp_get_attachment_image_url( $array_custom_images[$product_id]['additional_image_2'], 'thumbnail' ) ){
										echo '<a href="#" class="rudr-upload">';
										echo '<img src="'.esc_url( $image ).'" style="" />';
										echo '</a>';
										echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
										echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_2]" value="'.$array_custom_images[$product_id]['additional_image_2'].'">';
									}else {
										echo '<a href="#" class="button rudr-upload">Upload image 2</a>';
										echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
										echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_2]" value="">';
									}
								}else{
									echo '<a href="#" class="button rudr-upload">Upload image 2</a>';
									echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
									echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_2]" value="">';
								}
							echo '</div>';
					
							echo '<div style="display: inline-block; width: 100%; margin-top: 5px; margin-bottom: 20px;">';
							echo '</div>';
					
							echo '<div style="display: inline-block; width: 24%; margin-top: 5px; margin-bottom: 20px;">';
								if (array_key_exists($product_id, $array_custom_images)){
									if( $image = wp_get_attachment_image_url( $array_custom_images[$product_id]['additional_image_3'], 'thumbnail' ) ){
										echo '<a href="#" class="rudr-upload">';
										echo '<img src="'.esc_url( $image ).'" style="" />';
										echo '</a>';
										echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
										echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_3]" value="'.$array_custom_images[$product_id]['additional_image_3'].'">';
									}else {
										echo '<a href="#" class="button rudr-upload">Upload image 3</a>';
										echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
										echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_3]" value="">';
									}
								}else{
									echo '<a href="#" class="button rudr-upload">Upload image 3</a>';
									echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
									echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_3]" value="">';
								}
							echo '</div>';
					
							echo '<div style="display: inline-block; width: 24%; margin-top: 5px; margin-bottom: 20px;">';
								if (array_key_exists($product_id, $array_custom_images)){
									if( $image = wp_get_attachment_image_url( $array_custom_images[$product_id]['additional_image_4'], 'thumbnail' ) ){
										echo '<a href="#" class="rudr-upload">';
										echo '<img src="'.esc_url( $image ).'" style="" />';
										echo '</a>';
										echo '<a href="#" class="rudr-remove" style="display: block;">Remove image</a>';
										echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_4]" value="'.$array_custom_images[$product_id]['additional_image_4'].'">';
									}else {
										echo '<a href="#" class="button rudr-upload">Upload image 4</a>';
										echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
										echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_4]" value="">';
									}
								}else{
									echo '<a href="#" class="button rudr-upload">Upload image 4</a>';
									echo '<a href="#" class="rudr-remove" style="display:none">Remove image</a>';
									echo '<input type="hidden" name="organisation_products_custom_images['.$product_id.'][additional_image_4]" value="">';
								}
							echo '</div>';
					
							echo '<div style="width: 100%; margin-top: 5px; margin-bottom: 20px;">';
								echo '<label for="organisation_products_custom_images['.$product_id.'][custom_video]" class="pf-label-admin">Custom video of product (will be added below product images)<br/><small>Only Vimeo video ID is valid, example "903623460"</small></label>';
								echo '<input id="organisation_products_custom_images['.$product_id.'][custom_video]" name="organisation_products_custom_images['.$product_id.'][custom_video]" class="pf-input-admin" type="text" value="' . $array_custom_images[$product_id]['custom_video'] . '" placeholder="Vimeo video ID, example 903623460" />';
							echo '</div>';
					
							if(isset($array_custom_images[$product_id]['custom_title']) && !empty($array_custom_images[$product_id]['custom_title'])){
								$custom_title = $array_custom_images[$product_id]['custom_title'];
								$standard_title = 'Standard title of product will not be used';
								$standard_title_opacity = 'opacity: 0.2;';
							}else {
								$custom_title = '';
								$standard_title = 'Standard title of product';
								$standard_title_opacity = 'opacity: 1;';
							}
					
							echo '<div style="width: 100%; margin-top: 5px; margin-bottom: 20px;">';
								echo '<label for="" class="pf-label-admin">' . $standard_title . '</label>';
								echo '<div style="font-size: 20px; margin: 0px; padding: 10px; border: 1px solid #ccc; background: #F6F7F7; '.$standard_title_opacity.'">' . $product->get_name() . '</div>';
							echo '</div>'; 
					
							echo '<div style="width: 100%; margin-top: 5px; margin-bottom: 20px;">';
								echo '<label for="organisation_products_custom_images['.$product_id.'][custom_title]" class="pf-label-admin">Custom title of product (will replace standard title above if filled in)</label>';
								echo '<input id="organisation_products_custom_images['.$product_id.'][custom_title]" name="organisation_products_custom_images['.$product_id.'][custom_title]" class="pf-input-admin" type="text" value="' . $custom_title . '" placeholder="Custom title of product" />';
							echo '</div>';
					
							if(isset($array_custom_images[$product_id]['custom_short_description']) && !empty($array_custom_images[$product_id]['custom_short_description'])){
								$custom_short_description = $array_custom_images[$product_id]['custom_short_description'];
								$standard_description_title = 'Standard short description of product will not be used';
								$standard_description_opacity = 'opacity: 0.2;';
							}else {
								$custom_short_description = '';
								$standard_description_title = 'Standard short description of product';
								$standard_description_opacity = '';
							}
							$custom_short_description_id = 'short_description_id_'.$product_id;
							
							echo '<div style="width: 100%; margin-top: 5px; margin-bottom: 20px;">';
								echo '<label for="" class="pf-label-admin">' . $standard_description_title . '</label>';
								echo '<div style="margin: 0px; padding: 10px; border: 1px solid #ccc; background: #F6F7F7; '.$standard_description_opacity.'">' . $product->get_short_description() . '</div>';
							echo '</div>';
					
							echo '<div style="width: 100%; margin-top: 5px; margin-bottom: 20px;">';
								echo '<label for="organisation_products_custom_images['.$product_id.'][custom_short_description]" class="pf-label-admin">Custom short description of product (will replace standard description above if filled in)</label>';
								wp_editor($custom_short_description, $custom_short_description_id, ['textarea_name' => 'organisation_products_custom_images['.$product_id.'][custom_short_description]', 'textarea_rows'=>20, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE, 'default_editor' => 'tinymce']);
							echo '</div>';
					
					
							if(isset($array_custom_images[$product_id]['custom_long_description']) && !empty($array_custom_images[$product_id]['custom_long_description'])){
								$custom_long_description = $array_custom_images[$product_id]['custom_long_description'];
								$standard_long_description_title = 'Standard long description of product will not be used';
								$standard_long_description_opacity = 'opacity: 0.2;';
							}else {
								$custom_long_description = '';
								$standard_long_description_title = 'Standard long description of product';
								$standard_long_description_opacity = '';
							}
							$custom_long_description_id = 'long_description_id_'.$product_id;
							
							echo '<div style="width: 100%; margin-top: 5px; margin-bottom: 20px;">';
								echo '<label for="" class="pf-label-admin">' . $standard_long_description_title . '</label>';
								echo '<div style="margin: 0px; padding: 10px; border: 1px solid #ccc; background: #F6F7F7; '.$standard_long_description_opacity.'">' . $product->get_description() . '</div>';
							echo '</div>';
					
							echo '<div style="width: 100%; margin-top: 5px; margin-bottom: 20px;">';
								echo '<label for="organisation_products_custom_images['.$product_id.'][custom_long_description]" class="pf-label-admin">Custom long description of product (will replace standard description above if filled in)</label>';
								wp_editor($custom_long_description, $custom_long_description_id, ['textarea_name' => 'organisation_products_custom_images['.$product_id.'][custom_long_description]', 'textarea_rows'=>20, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE, 'default_editor' => 'tinymce']);
							echo '</div>';
							
							echo '<hr class="horizontal-divider">';
					
							echo '<h4 class="pf-h4-admin">Options for overview products</h4>';
					
							if(isset($array_custom_images[$product_id]['custom_button_label']) && !empty($array_custom_images[$product_id]['custom_button_label'])){
								$custom_button_label = $array_custom_images[$product_id]['custom_button_label'];
							}else {
								$custom_button_label = '';
							}
					
							echo '<div style="width: 100%; margin-top: 5px; margin-bottom: 20px;">';
								echo '<label for="organisation_products_custom_images['.$product_id.'][custom_button_label]" class="pf-label-admin">Custom button label in overview (will override default button label)</label>';
								echo '<input id="organisation_products_custom_images['.$product_id.'][custom_button_label]" name="organisation_products_custom_images['.$product_id.'][custom_button_label]" class="pf-input-admin" type="text" value="' . $custom_button_label . '" placeholder="Custom button label, eg. Create Your Photobook" />';
							echo '</div>';
					
  						echo '</div>';
					echo '</div>';

				}
			?>
		</div>
		
		<div id="Advanced" class="tabcontent" style="display: none;">
			<?php
				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-admin-settings"></span>&nbsp;&nbsp;Advanced</h3>';
		
				echo '<div style="border: 1px solid #ccc; background: #FAFAFA; padding: 10px; padding-top: 15px; margin-top: 5px; margin-bottom: 0px; overflow:hidden">';
					echo '<h4 class="pf-h4-admin" style="width: 70%; display: inline-block;">Tracking Codes</h4>';
					echo '<a type="button" class="collapsiblebutton" style="float: right; margin-top: 5px;">Customize</a>';
				echo '</div>';
				echo '<div class="productoptions" style="border: 1px solid #ccc; background: white; padding: 10px; padding-top: 15px; border-top: none;">';
					echo '<h4 class="pf-h4-admin">Tracking Codes</h4>';
					echo '<hr class="horizontal-divider">';
		
					echo '<label for="organisation_tag_ga4" class="pf-label-admin">Google Analytics 4 - Tracking code</label>';
					echo '<input id="organisation_tag_ga4" name="organisation_tag_ga4" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_tag_ga4', true ) ) . '" placeholder="Google Analytics 4 - Tracking code ID, example G-20Q3KZY8SK" />';

					echo '<label for="organisation_tag_hotjar" class="pf-label-admin">Hotjar - Tracking code</label>';
					echo '<input id="organisation_tag_hotjar" name="organisation_tag_hotjar" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_tag_hotjar', true ) ) . '" placeholder="Hotjar - Site ID, example 42764" />';

					echo '<label for="organisation_tag_other" class="pf-label-admin">Other tracking codes</label>';
					wp_editor(get_post_meta( $post->ID, '_organisation_tag_other', true ), "organisation_tag_other", $args_editor_2);
				echo '</div>';
			?>
		</div>
		
		<div id="ImageEditor" class="tabcontent" style="display: none;">
			<?php
				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-edit"></span>&nbsp;&nbsp;Image Editor</h3>';
		
				echo '<label for="organisation_editor_id" class="pf-label-admin">Organisation ID <small>(This will be set automatically and cannot be changed)</small></label>';
				echo '<input id="organisation_editor_id" name="organisation_editor_id" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_editor_id', true ) ) . '" placeholder="Organisation ID" disabled style="background-color: #ccc; color: black;" />';
		
				echo '<label for="organisation_apikey" class="pf-label-admin">Organisation API key <small>(This will be set automatically and cannot be changed)</small></label>';
				echo '<input id="organisation_apikey" name="organisation_apikey" class="pf-input-admin" type="text" value="' . esc_attr( get_post_meta( $post->ID, '_organisation_apikey', true ) ) . '" placeholder="Organisation API Key" disabled style="background-color: #ccc; color: black;" />';
				
				echo '<hr class="horizontal-divider">';
				
				echo '<h3 class="pf-h3-admin"><span class="dashicons dashicons-open-folder"></span>&nbsp;&nbsp;Custom images & texts</h3>';
				
				echo '<p>You can add custom images & texts for this organisation, so that customers can view & use these in their projects.<br/>To do this, please click the button below to go to the editor.</p>';
				
				echo '<a href="' . $editor_environment . '/editor/dashboard/vieworganisation.php?a='.get_post_meta( $post->ID, '_organisation_apikey', true ).'" target="_blank" class="button button-primary button-large">Manage custom content</a>'
			?>
		</div>
		
	</div>
</div>

<script>
	
	var coll = document.getElementsByClassName("collapsiblebutton");
	var i;
	for (i = 0; i < coll.length; i++) {
		coll[i].addEventListener("click", function() {
			this.classList.toggle("collapsiblebutton-active");
			var content = this.parentElement.nextElementSibling;
			if (content.style.display === "block") {
				content.style.display = "none";
			} else {
				content.style.display = "block";
				this.parentElement.scrollIntoView();
			}
		});
	}
	
	theme_name = "<?php echo $theme_text; ?>";
	if (theme_name == 'joyful') {
		jQuery(".div-joyful").show();
		jQuery(".div-serene").hide();
	} else if (theme_name == 'serene') {
		jQuery(".div-joyful").hide();
		jQuery(".div-serene").show();
	} else {
		jQuery(".div-joyful").hide();
		jQuery(".div-serene").hide();
	}

	document.getElementById('organisation_theme').addEventListener('change', function handleChange(event) {
		if (event.target.value === 'joyful') {
			jQuery(".div-joyful").show();
			jQuery(".div-serene").hide();
		}else if (event.target.value === 'serene') {
			jQuery(".div-joyful").hide();
			jQuery(".div-serene").show();
		}else {
			jQuery(".div-joyful").hide();
			jQuery(".div-serene").hide();
		}
	});
	
	function openCity(evt, cityName) {
		// Declare all variables
		var i, tabcontent, tablinks;

		// Get all elements with class="tabcontent" and hide them
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}

		// Get all elements with class="tablinks" and remove the class "active"
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}

		// Show the current tab, and add an "active" class to the link that opened the tab
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";
	}

</script>

		<?php
		
	}