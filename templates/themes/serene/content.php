<div class="container mobile-p-0">
	
	<?php if(empty(get_post_meta( $organisation_id, '_organisation_jumbotron_block1_visibility', true )) OR (get_post_meta( $organisation_id, '_organisation_jumbotron_block1_visibility', true ) == 'show')): ?>
	<div class="p-5 mb-4 rounded" style="min-height: <?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block1_minheight', true ) . 'px'; ?>; background-color: <?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block1_bgcolor', true ); ?> !important; background: url('<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_jumbotron_block1_bgimage', true ), 'full' ); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;">
		<div class="container-fluid py-3">
			<div class="row">
				<div class="col-md-6">
					<span style="color: <?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block1_text_color', true ); ?> !important;"><?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block1_text', true ); ?></span>
					<br/><br/>
					<?php if(!empty(get_post_meta( $organisation_id, '_organisation_jumbotron_block1_button_label', true ))): ?>
						<a href="<?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block1_button_link', true ); ?>" target="_blank" class="btn btn-primary btn-lg"><?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block1_button_label', true ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="row align-items-md-stretch mb-5">
		<div class="col-md-6 jumbotron-left">
			<div class="h-100 p-5 rounded" style="background-color: <?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block2_bgcolor', true ); ?> !important; background: url('<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_jumbotron_block2_bgimage', true ), 'full' ); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;">
				<span style="color: <?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block2_text_color', true ); ?> !important;"><?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block2_text', true ); ?></span>
			</div>
		</div>
		<div class="col-md-6 jumbotron-right">
			<div class="h-100 p-5 rounded" style="background-color: <?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block3_bgcolor', true ); ?> !important; background: url('<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_jumbotron_block3_bgimage', true ), 'full' ); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;">
				<span style="color: <?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block3_text_color', true ); ?> !important;"><?php echo get_post_meta( $organisation_id, '_organisation_jumbotron_block3_text', true ); ?></span>
			</div>
		</div>
	</div>
	
	<?php if(!empty(get_post_meta( $organisation_id, '_organisation_headline_title', true ))): ?>
	<div class="row mt-2 mb-4">
		<div class="col-md-10">
			<h2>
				<?php echo get_post_meta( $organisation_id, '_organisation_headline_title', true ); ?>
			</h2>
			<p>
				<?php echo get_post_meta( $organisation_id, '_organisation_headline_subtitle', true ); ?>
			</p>
		</div>

		<?php if(!empty(get_post_meta( $organisation_id, '_organisation_headline_button_label', true ))): ?>
		<div class="col-md-2 my-auto">
			<a href="#products" type="button" class="btn btn-lg btn-primary me-2"><?php echo get_post_meta( $organisation_id, '_organisation_headline_button_label', true ) ?></a>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php if(!empty(get_post_meta( $organisation_id, '_organisation_products', true ))): ?>
	<div class="row mt-3 mb-5" id="products">
		
		<?php if(empty(get_post_meta($organisation_id, '_organisation_products_title_visibility', true)) OR (get_post_meta($organisation_id, '_organisation_products_title_visibility', true) == 'show')): ?>
			<div class="col-md-12">
				<h2 class="pb-0 mb-0">
					<?php echo (!empty(get_post_meta( $organisation_id, '_organisation_products_title', true ))) ? get_post_meta( $organisation_id, '_organisation_products_title', true ) : __('Our products', 'peleman-fusion'); ?> 
				</h2>
			</div>
		<?php endif; ?>

		<div class="col-md-12">
			<div class="row p-2">
				<?php $array_custom_images = (!empty(get_post_meta( $organisation_id, '_organisation_products_custom_images', true ))) ? get_post_meta( $organisation_id, '_organisation_products_custom_images', true ) : []; ?>

				<?php foreach(get_post_meta( $organisation_id, '_organisation_products', true ) as $id => $product_id): ?>
				<?php $product = wc_get_product( $product_id ); ?>
				<div class="col-md-3 p-2" style="">
					<div class="p-4 rounded" style="color: <?php echo get_post_meta( $organisation_id, '_organisation_products_text_color', true ); ?>">
						<a href="<?php echo $product->get_slug(); ?>?organisationid=<?php echo get_post_meta( $organisation_id, '_organisation_editor_id', true ); ?>">
							<?php if (array_key_exists($product_id, $array_custom_images) && !empty($array_custom_images[$product_id]['main_image'])): ?>
								<img src="<?php echo wp_get_attachment_image_url($array_custom_images[$product_id]['main_image'], 'medium' ); ?>" style="width: 100%; margin-bottom: 10px; height: 200px; object-fit: cover;" class="home-product-image">
							<?php else: ?>
								<img src="<?php echo wp_get_attachment_image_url($product->get_image_id(), 'medium' ); ?>" style="width: 100%; margin-bottom: 10px; height: 200px; object-fit: cover;" class="home-product-image">
							<?php endif; ?>
						</a>	
						
						<?php if(empty(get_post_meta($organisation_id, '_organisation_products_hide_product_titles', true)) OR (get_post_meta($organisation_id, '_organisation_products_hide_product_titles', true) == 'show')): ?>
						<h4 class="mb-3" style="min-height: 100px; color: <?php echo get_post_meta($organisation_id, '_organisation_products_text_color', true); ?>">
							<?php
								if (array_key_exists($product_id, $array_custom_images) && !empty($array_custom_images[$product_id])){
									if(isset($array_custom_images[$product_id]['custom_title']) && !empty($array_custom_images[$product_id]['custom_title'])){
										echo $array_custom_images[$product_id]['custom_title'];
									}else {
										echo $product->get_name();
									}
								}else {
									echo $product->get_name();
								}
							?>
						</h4>
						<?php endif; ?>
						
						<?php 
							$button_width = '';
							if(get_post_meta($organisation_id, '_organisation_products_hide_product_titles', true) == 'hide'){
								$button_width = '100%';
							} 
						?>
						
						<a href="<?php echo $product->get_slug(); ?>?organisationid=<?php echo get_post_meta( $organisation_id, '_organisation_editor_id', true ); ?>" class="btn btn-primary mt-2" style="width: <?php echo $button_width; ?>">
							<?php
								if (array_key_exists($product_id, $array_custom_images) && !empty($array_custom_images[$product_id])){
									if(isset($array_custom_images[$product_id]['custom_button_label']) && !empty($array_custom_images[$product_id]['custom_button_label'])){
										echo $array_custom_images[$product_id]['custom_button_label'];
									}else {
										if(!empty(get_post_meta($organisation_id, '_organisation_products_button_label', true))){
											echo get_post_meta($organisation_id, '_organisation_products_button_label', true);
										}else {
											echo 'Create now';
										}
									}
								}else {
									if(!empty(get_post_meta($organisation_id, '_organisation_products_button_label', true))){
										echo get_post_meta($organisation_id, '_organisation_products_button_label', true);
									}else {
										echo 'Create now';
									}
								}
							?>
						</a>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="row g-5">
		<div class="col-md-8">
			<?php if(!empty(get_post_meta( $organisation_id, '_organisation_advantage_1_text_left', true )) AND !empty(get_post_meta( $organisation_id, '_organisation_advantage_1_image_right', true ))): ?>
				<article class="">
					<?php echo (get_post_meta( $organisation_id, '_organisation_advantage_1_text_left', true )); ?>
					<img class="mt-3 rounded" src="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_advantage_1_image_right', true ), 'full' ); ?>" style="width: 100%; margin-top: 10px; margin-bottom: 10px;" >
				</article>
			<?php endif; ?>
			
			<?php if(!empty(get_post_meta( $organisation_id, '_organisation_advantage_2_image_left', true )) AND !empty(get_post_meta( $organisation_id, '_organisation_advantage_2_text_right', true ))): ?>
				<article class="mt-5">
					<?php echo get_post_meta( $organisation_id, '_organisation_advantage_2_text_right', true ); ?>
					<img class="rounded" src="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_advantage_2_image_left', true ), 'full' ); ?>" style="width: 100%; margin-top: 10px; margin-bottom: 10px;" >
				</article>
			<?php endif; ?>
			
			<?php if(!empty(get_post_meta( $organisation_id, '_organisation_advantage_3_text_left', true )) AND !empty(get_post_meta( $organisation_id, '_organisation_advantage_3_image_right', true ))): ?>
				<article class="mt-5">
					<?php echo get_post_meta( $organisation_id, '_organisation_advantage_3_text_left', true ); ?>
					<img class="rounded" src="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_advantage_3_image_right', true ), 'full' ); ?>" style="width: 100%; margin-top: 10px; margin-bottom: 10px;" >
				</article>
			<?php endif; ?>
		</div>

		<div class="col-md-4 mt-0">
			<div class="position-sticky" style="top: 2rem;">
				<?php if(!empty(get_post_meta( $organisation_id, '_organisation_freeblock_title', true ))): ?>
				<div class="p-4 mb-3 bg-light rounded">
					<h3 class=""><?php echo get_post_meta( $organisation_id, '_organisation_freeblock_title', true ); ?></h3>
					<p class="mb-0"><?php echo get_post_meta( $organisation_id, '_organisation_freeblock_content', true ); ?></p>
					
					<?php if(!empty(get_post_meta( $organisation_id, '_organisation_freeblock_button_url', true ))): ?>
						<a href="<?php echo get_post_meta( $organisation_id, '_organisation_freeblock_button_url', true ); ?>" class="btn btn-primary mt-2" target="_blank"><?php echo get_post_meta( $organisation_id, '_organisation_freeblock_button_label', true ); ?></a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				
				<?php if(!empty(get_post_meta( $organisation_id, '_organisation_freeblock_image', true ))): ?>
					<div class="">
						<img class="rounded" src="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_freeblock_image', true ), 'full' ); ?>" style="width: 100%;" >
					</div>
				<?php endif; ?>
				
			</div>
		</div>
  </div>
</div>

<hr class="mt-5 mb-3">