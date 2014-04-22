<?php get_header(); ?>

<section class="content fourOfour">
	<div class="container">
		<div class="col-md-12">
			<section class="theContent">
				<h1><?php _e( "error", "um_lang" ) ?> <span><?php _e('{404}','um_lang')?></span></h1>
				<h3><?php _e("The page doesn't exist or its deleted","um_lang"); ?></h3>
				<p><?php _e("Click here to go back at","um_lang"); ?> <a class="um_ajaxLink" href="<?php echo site_url(); ?>"><?php _e('Homepage','um_lang'); ?></a></p>
			</section>
		</div>
	</div>
</section> 


<?php get_footer(); ?>