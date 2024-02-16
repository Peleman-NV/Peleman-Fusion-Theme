<?php
	$organisation_id = $post->ID;
?><!doctype html>
<html lang="en">
	<head>
		<?php if(!empty(get_post_meta($organisation_id, '_organisation_tag_ga4', true))): ?>
			<!-- Google tag (gtag.js) -->
			<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_post_meta($organisation_id, '_organisation_tag_ga4', true); ?>"></script>
			<script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());

				gtag('config', '<?php echo get_post_meta($organisation_id, '_organisation_tag_ga4', true); ?>');
			</script>
		<?php endif; ?>
		
		<?php if(!empty(get_post_meta($organisation_id, '_organisation_tag_hotjar', true))): ?>
			<!-- Hotjar Tracking Code -->
			<script>
				(function(h,o,t,j,a,r){
					h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
					h._hjSettings={hjid:<?php echo get_post_meta($organisation_id, '_organisation_tag_hotjar', true); ?>,hjsv:6};
					a=o.getElementsByTagName('head')[0];
					r=o.createElement('script');r.async=1;
					r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
					a.appendChild(r);
				})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
			</script>
		<?php endif; ?>
		
		<?php if(!empty(get_post_meta($organisation_id, '_organisation_tag_other', true))): ?>
			<?php echo get_post_meta($organisation_id, '_organisation_tag_other', true); ?>
		<?php endif; ?>
		
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<?php
			if(!empty(get_post_meta($organisation_id, '_organisation_header_title', true))){
				$title = get_post_meta($organisation_id, '_organisation_header_title', true);
				if(!empty(get_post_meta($organisation_id, '_organisation_header_subtitle', true))){
					$title .= ' - ' . get_post_meta($organisation_id, '_organisation_header_subtitle', true);
				}
			}else {
				$title = get_post_meta($organisation_id, '_organisation_name', true);
			}
		?>
		
    	<title><?php echo $title; ?></title>
		<link rel="shortcut icon" type="image/jpg" href="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_logo_favicon', true ), 'full' ); ?>"/>
	
		<?php wp_head(); ?>
		
  	</head>
  	
	<body>
		<?php if(empty(get_post_meta($organisation_id, '_organisation_theme', true))): ?>
			<h2>Please select a theme to get started</h2>
		<?php else: ?>
			<?php include_once(get_template_directory().'/templates/themes/' . get_post_meta($organisation_id, '_organisation_theme', true) . '/style.php'); ?>
		
			<main class="container rounded" style="">

				<?php include_once(get_template_directory().'/templates/themes/' . get_post_meta($organisation_id, '_organisation_theme', true) . '/header.php'); ?>

				<?php include_once(get_template_directory().'/templates/themes/' . get_post_meta($organisation_id, '_organisation_theme', true) . '/content.php'); ?>

				<?php include_once(get_template_directory().'/templates/themes/' . get_post_meta($organisation_id, '_organisation_theme', true) . '/footer.php'); ?>

			</main>
		<?php endif; ?>
		
		<?php wp_footer(); ?>
    
	</body>
</html>