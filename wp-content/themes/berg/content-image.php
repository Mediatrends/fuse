<div class="imageContent imageFormat">
	<?php
		$image_attachment_id =  get_field('add_image'); 
		$image = wp_get_attachment_image_src( $image_attachment_id, 'full' );
	?>

		<div class="imagePost">
			<img src="<?php echo $image[0]; ?>">
		</div>
</div>