<?php
/*
Template Name:Services
*/

get_header();
?>
<section class="content servicePage">
	<div class="container">
	
		<?php wp_reset_postdata(); ?>
		<?php if(get_the_content()): ?>
			<section class="theContent hasMarginB">
				<h3 class="pageTitle"><?php the_title();?> </h3>
				<?php the_content(); ?>
			</section>
		<?php endif; ?>
	
	<?php $services = get_field('services'); ?>
		<?php if($services):?>
			<div id="owl-example" class="owl-carousel">
				<?php foreach($services as $service): ?>
					<article class="service um_in">
							<div class="serviceContent">
							<i class="serviceIcon fa <?php echo $service['service_icon']; ?> fa-2x"></i>
							<h3 class="title serviceTitle"><a href="<?php echo $service['service_link']; ?>"><?php echo $service['service_name']; ?></a></h3>
							<h4 class="description serviceDescription"><?php echo $service['short_description']; ?></h4>
							<div class="serviceText"> 
									<?php echo $service['description']; ?>
							</div>
						</div>
					</article>
				<?php endforeach;?>
			</div>
		<?php endif; ?>
		
	</div>

</section>

<script>
jQuery(document).ready(function($){
	service();
});		
</script>
<?php get_footer(); ?>