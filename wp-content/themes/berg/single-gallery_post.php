<?php get_header(); ?>

<?php 
	$type = get_field('slider_type'); 
	$className = "";
	
	if($type == 'bg'){ 	
		$className = 'hasBackground';
		$bgImage = get_field('background_image'); 
		if($bgImage){ 
			$bgImage = wp_get_attachment_image_src($bgImage,'full'); 
			$bgImage = $bgImage[0];	
		}
	}
	elseif($type == 'pattern'){
			$bgImage = get_field('background_image'); 
			$className = 'hasPattern';
			if($bgImage){ 
			$bgImage = wp_get_attachment_image_src($bgImage,'full'); 
			$bgImage = $bgImage[0];	
		
				?> 
					<style>
						.hasPattern{
							background: url(<?php  echo $bgImage; ?>);
						}
					</style>

				<?php
		}

	}
?> 
<section class="content gallerySinglePage">
	<div class="container">	
		<section class="col-md-12 galleryContent">
			<div class="inner-content">
				<article class="galleryPost">
					
				<?php $slider = get_field('gallery'); ?>
				<?php if($slider): ?>
					<div class="imageContent <?php echo $className; ?>">
						<ul class="rslides">
							<?php foreach($slider as $slide): ?>
								<li>
									<?php if($type == "bg" || $type == "pattern" ): ?>
										<span class="um_helper"></span>
									<?php endif; ?>
									<img src="<?php echo $slide['url']; ?>" alt="<?php echo $slide['alt']; ?>">
									
								</li>
					    	<?php endforeach; ?>
					    </ul>
				
					    <?php if($type == "bg"): ?>
					    		<img src="<?php  echo $bgImage; ?>">
						<?php endif; ?>

						<?php if(!get_field('disable_network_share')): ?>
							<?php if(get_field('share_galleries_in','options')):?>	
								<div class="shareButtons">
									<?php addSocialShareButtons(get_field('share_galleries_in','options')); ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
						
					</div>
				<?php endif;?>
				
				
					<div class="articleContent">

						<?php if(!get_field('disable_network_share')): ?>
								<?php if(get_field('share_galleries_in','options')):?>		
									<div class="shareWrapper">
										<div class="shareIt">
											<i class="fa fa-share-square-o fa-2x"></i>
										</div>
									</div>
							<?php endif; ?>
						<?php endif; ?>


						<h3><?php the_title(); ?></h3>
						<?php 
							$terms = get_the_terms( $post->ID, 'gallery_category' );
							$post_terms = '';
							if($terms){
								foreach ($terms as $term){
									$post_terms .= $term->name.', ';
								}
								$post_terms = substr($post_terms, 0, -2);
							}
						?>
						<h4><?php echo $post_terms; ?></h4>
						
						<?php wp_reset_postdata(); ?>
						<?php the_content(); ?>
					</div>
				</article>
			</div>
		</section>
	</div>

	<?php $details = get_field('post_details'); ?>
	<?php if($details): ?>
		<ul class="postDetails list-inline list-unstyled">
			<?php foreach($details as $detail): ?>
				<li><?php echo $detail['detail_title']; ?><b> <?php echo $detail['details_content']; ?></b></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>


</section>
<script>
jQuery(document).ready(function(){
	singleGallery();
});
</script>
<?php get_footer(); ?>
