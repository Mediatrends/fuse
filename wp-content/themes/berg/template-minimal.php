<?php
/*
Template Name:Home Minimal
*/

get_header();
?>

<section class="content homeMinimal">

<?php wp_reset_postdata(); ?>
		<?php if(get_the_content()): ?>
			<section class="theContent">
				<h3 class="pageTitle"><?php the_title();?> </h3>
				<?php the_content(); ?>
			</section>
		<?php endif; ?>

	<section class="minimalSlider">
		<div id="slides">
			<?php $slider = get_field('slider'); ?>
			<?php if($slider): ?>
		
			<ul class="slides-container">
				<?php foreach($slider as $slide): ?>
					<?php 
						$overlayPercantage = $slide['image_overlay_percantage'];
						$overlay = 1 - ($overlayPercantage / 100);
						$overlayColorHex = $slide['image_overlay_color'];
						$color = sscanf($overlayColorHex, "#%02x%02x%02x");
					?>
				
					<li style="background:<?php echo $overlayColorHex; ?>;">
					<?php $image = wp_get_attachment_image_src( $slide['image'], 'full'); ?>
						<img style="opacity:<?php echo $overlay; ?>" src="<?php echo $image[0]; ?>" alt="">
						<div class="sliderContainer">
							<span class="um_helper"></span>
							<span class="sliderContentWrapper">
								<div class="<?php echo $slide['content_effect'];?> sliderContent">
									<?php echo $slide['content']; ?>
								</div>
								<a href="<?php echo $slide['button_link'];?>" class=" slider_button <?php echo $slide['button_effect'];?>"><?php echo $slide['button_text']; ?></a>
							</span>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			
			<div class="slides-navigation">
				<a class="next"><i class="fa fa-angle-right fa-4x"></i></a>
				<a class="prev"><i class="fa fa-angle-left fa-4x"></i></a>
			</div>
			
			<?php endif; ?>
		</div>
	</section>
</section>

<?php $autoPlay = get_field('slider_auto_play'); ?>
<?php $effect = get_field('slider_effect'); ?>
<script>

	var autoPlay = "<?php echo $autoPlay; ?>";
	var effect =  "<?php echo $effect; ?>";

	jQuery(document).ready(function(){
		homeMinimal(effect,autoPlay);
	});

</script>


<?php get_footer(); ?>