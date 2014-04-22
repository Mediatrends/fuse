<?php
/*
Template Name:Clients
*/

get_header();
?>

<section class="content clientsPage">
	<div class="container">
	
		<?php wp_reset_postdata(); ?>
		<?php if(get_the_content()): ?>
			<section class="theContent hasMarginB">
				<h3 class="pageTitle"><?php the_title();?> </h3>
				<?php the_content(); ?>
			</section>
		<?php endif; ?>
	
	<?php $clients = get_field('clients'); ?>
	<?php if($clients): ?>
	<section class="clients">
		<?php foreach($clients as $client):?>
			<article class="client col-md-3 col-sm-6 col-xs-12 um_in">
					<?php $image = wp_get_attachment_image_src( $client['client_logo'], 'clients'); ?>
					<img src="<?php echo $image[0]; ?>"/>
					<span class="um_helper"></span>
					<div class="hover clientHover">
						<h4><a href="<?php echo $client['client_link'];?>"><?php echo $client['client_name'];?></a></h4>
						<p><?php echo $client['client_short_description'];?></p>
					</div>
			</article>
		<?php endforeach; ?>
	</section>
	<?php endif; ?>
	</div>
</section>

<script>
jQuery(document).ready(function($){
	client();	
});		
</script>
<?php get_footer(); ?>