<?php 
	$organisation_id = apply_filters( 'pf_query_get_organisation_id', (isset($_GET['organisationid'])) ? $_GET['organisationid'] : '0' );
	wp_reset_postdata();
?><!doctype html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	
		<?php
			if(!empty(get_post_meta($organisation_id, '_organisation_header_title', true))){
				$title = get_post_meta($organisation_id, '_organisation_header_title', true);
				$title .= ' - ' . get_the_title( get_the_ID() );
			}else {
				$title = get_post_meta($organisation_id, '_organisation_name', true);
			}
		?>
		
    	<title><?php echo $title; ?></title>
		
		<link rel="shortcut icon" type="image/jpg" href="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_logo_favicon', true ), 'full' ); ?>"/>

		<?php wp_head(); ?>
  	</head>
	<body>