<div class="shadow p-2 p-md-5 mb-4" style="min-height: 450px; background: linear-gradient(0deg, gray, darkgray 40%, gray) no-repeat center/0.25px 100%; background-color: <?php echo get_post_meta($organisation_id, '_organisation_image_ph_background_color', true); ?>;">
	<div class="row g-5">
		<div class="col-md-6 pr-2" style="">
			<div style="background: url('<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_image_ph_placeholder_1', true ), 'full' ); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center; width: 100%; height: 450px; position: relative;">
				<?php if(!empty(get_post_meta($organisation_id, '_organisation_image_ph_placeholder_1_text', true))): ?>
				<div class="" style="background-color: <?php echo get_post_meta($organisation_id, '_organisation_image_ph_placeholder_1_background_color', true); ?>; padding: 15px 20px; position: absolute; bottom: -15px; right: -10px; color: <?php echo get_post_meta($organisation_id, '_organisation_image_ph_placeholder_1_text_color', true); ?>; font-size: 30px; text-align: right; line-height: 1em;"><?php echo get_post_meta($organisation_id, '_organisation_image_ph_placeholder_1_text', true); ?></div>
				<?php endif; ?>
			</div>
		</div>

		<div class="col-md-6 pl-2" style="">
			<div style="height: 230px; margin-bottom: 30px;">
				<div style="background: url('<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_image_ph_placeholder_2', true ), 'full' ); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center; width: 55%; display: inline-block; height: 230px;">

				</div>

				<div style="background: url('<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_image_ph_placeholder_3', true ), 'full' ); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center; width: 40%; float: right; height: 230px;">

				</div>
			</div>
			<!-- 						<div class="my-auto mx-auto d-flex" style="width: 100%; height: 190px; text-align: center; border: 2px dashed #9FD1FF; background-color: #E6F1FF;">	 -->
			<div class="my-auto mx-auto d-flex placeholder4" style="width: 100%; text-align: center; border: 2px dashed <?php echo get_post_meta($organisation_id, '_organisation_image_ph_placeholder_4_text_color', true); ?>; background-color: <?php echo get_post_meta($organisation_id, '_organisation_image_ph_placeholder_4_background_color', true); ?>">	

				<div class="card-body align-items-center d-flex justify-content-center">
					<h2 style="color: <?php echo get_post_meta($organisation_id, '_organisation_image_ph_placeholder_4_text_color', true); ?> !important;" class="my-auto" style="margin-top: 50px;"><?php echo get_post_meta( $organisation_id, '_organisation_image_ph_placeholder_4_text', true ) ?>
					</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if(!empty(get_post_meta( $organisation_id, '_organisation_headline_title', true ))): ?>
<div class="row mt-2 mb-4">
	<div class="col-md-10">
		<h2 class="pb-0 mb-0" style="font-size: 40px;">
			<?php echo get_post_meta( $organisation_id, '_organisation_headline_title', true ); ?>
		</h2>
		<p style="font-size: 25px;">
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
					<div class="shadow-sm p-4 rounded" style="background-color: <?php echo get_post_meta($organisation_id, '_organisation_products_background_color', true); ?>; color: <?php echo get_post_meta( $organisation_id, '_organisation_products_text_color', true ); ?>">
						
						<a href="<?php echo $product->get_slug(); ?>?organisationid=<?php echo get_post_meta( $organisation_id, '_organisation_editor_id', true ); ?>">
							<?php if (array_key_exists($product_id, $array_custom_images) && !empty($array_custom_images[$product_id]['main_image'])): ?>
								<img src="<?php echo wp_get_attachment_image_url($array_custom_images[$product_id]['main_image'], 'medium' ); ?>" style="width: 100%; margin-bottom: 10px; height: 200px; object-fit: cover;">
							<?php else: ?>
								<img src="<?php echo wp_get_attachment_image_url($product->get_image_id(), 'medium' ); ?>" style="width: 100%; margin-bottom: 10px; height: 200px; object-fit: cover;">
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
											echo __('Create now', 'peleman-fusion');
										}
									}
								}else {
									if(!empty(get_post_meta($organisation_id, '_organisation_products_button_label', true))){
										echo get_post_meta($organisation_id, '_organisation_products_button_label', true);
									}else {
										echo __('Create now', 'peleman-fusion');
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

<?php if(!empty(get_post_meta( $organisation_id, '_organisation_advantage_1_text_left', true )) AND !empty(get_post_meta( $organisation_id, '_organisation_advantage_1_image_right', true ))): ?>
<div class="row mt-5 mb-5">
	<div class="col-md-5 my-auto">
		<?php echo (get_post_meta( $organisation_id, '_organisation_advantage_1_text_left', true )); ?>
	</div>

	<div class="col-md-7 my-auto">
		<img class="rounded" src="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_advantage_1_image_right', true ), 'full' ); ?>" style="width: 100%;" >

	</div>
</div>
<?php endif; ?>

<?php if(!empty(get_post_meta( $organisation_id, '_organisation_advantage_2_image_left', true )) AND !empty(get_post_meta( $organisation_id, '_organisation_advantage_2_text_right', true ))): ?>
<div class="row mt-5 mb-5">
	<div class="col-md-7 my-auto">
		<img class="rounded" src="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_advantage_2_image_left', true ), 'full' ); ?>" style="width: 100%;" >
	</div>

	<div class="col-md-5 px-5 my-auto">
		<?php echo get_post_meta( $organisation_id, '_organisation_advantage_2_text_right', true ); ?>
	</div>
</div>
<?php endif; ?>

<?php if(!empty(get_post_meta( $organisation_id, '_organisation_advantage_3_text_left', true )) AND !empty(get_post_meta( $organisation_id, '_organisation_advantage_3_image_right', true ))): ?>
<div class="row mt-5 mb-5">
	<div class="col-md-5 my-auto">
		<?php echo get_post_meta( $organisation_id, '_organisation_advantage_3_text_left', true ); ?>
	</div>

	<div class="col-md-7 my-auto">
		<img class="rounded" src="<?php echo wp_get_attachment_image_url( get_post_meta( $organisation_id, '_organisation_advantage_3_image_right', true ), 'full' ); ?>" style="width: 100%;" >
	</div>
</div>
<?php endif; ?>

<?php if(!empty(get_post_meta( $organisation_id, '_organisation_freeblock_title', true ))): ?>
<div class="row mb-2 g-5 p-5">
	<div class="col-md-12 shadow-sm rounded p-5" style="background-color: <?php echo get_post_meta($organisation_id, '_organisation_color_panel', true); ?>">
		<h3 class="mb-3" style="color: <?php echo get_post_meta($organisation_id, '_organisation_color_panel_text', true); ?>">
			<?php echo get_post_meta( $organisation_id, '_organisation_freeblock_title', true ); ?>
		</h3>

		<p class="text-start" style="color: <?php echo get_post_meta($organisation_id, '_organisation_color_panel_text', true); ?>">
			<?php echo get_post_meta( $organisation_id, '_organisation_freeblock_content', true ); ?>
		</p>

		<?php if(!empty(get_post_meta( $organisation_id, '_organisation_freeblock_button_url', true ))): ?>
		<a href="<?php echo get_post_meta( $organisation_id, '_organisation_freeblock_button_url', true ); ?>" class="btn btn-primary mt-2" target="_blank"><?php echo get_post_meta( $organisation_id, '_organisation_freeblock_button_label', true ); ?></a>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<hr>