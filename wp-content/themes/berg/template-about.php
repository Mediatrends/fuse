<?php
/*
Template Name:About
*/

get_header();
?>

<section class="content aboutPage">
	<div class="container">
	
		<?php if(is_page()): ?>
			<?php wp_reset_postdata(); ?>
				<?php if(get_the_content()): ?>
					<section class="theContent hasMarginB">
						<h3 class="pageTitle"><?php the_title();?> </h3>
						<?php the_content(); ?>
					</section>
				<?php endif; ?>
		<?php endif; ?>
	
	<?php $members = get_field('team_members'); ?>
	<?php if($members): ?>
		<ul class="textContent list-unstyled col-md-6">
			<?php foreach($members as $member): ?>
				<li class="um_none">
					<div class="wrapper">
						<h4 class="aboutTitle"><?php echo $member['position']; ?></h4>
						<div class="nameAndSocial">
							<h3 class="aboutName"><?php echo $member['full_name']; ?></h3>
							<?php $networks = $member['social_networks']; ?>
							<?php if($networks): ?>
								<ul class="aboutSocial socialIcons">
									<?php foreach($networks as $network): ?>
									<li><a href="<?php echo $network['network_url']; ?>"><i class="fa <?php echo $network['network']; ?>"></i></a></li>
									<?php endforeach;?>
								</ul>
							<?php endif; ?>
						</div>
						<div class="aboutMeContent">
							<p><?php echo $member['description']; ?></p>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>

		<ul class="sliderContent col-md-6">
			<div id="slides">
				<ul class="slides-container">
					<?php foreach($members as $member): ?>
						<?php $image = wp_get_attachment_image_src( $member['image'], 'aboutUs'); ?> ?>
						<li><img src="<?php echo $image[0]; ?>" alt=""></li>
					<?php endforeach; ?>
				</ul>
				<div class="slides-navigation originalPosition">
	    			<a class="next"><i class="fa fa-angle-right fa-4x"></i></a>
					<a class="prev"><i class="fa fa-angle-left fa-4x"></i></a>
				</div>
			</div>
		</ul>
	<?php endif; ?>
		
		
		<?php $facts = get_field('facts'); ?>
		<?php if($facts): ?>
			<section class="facts">
				<?php foreach($facts as $fact): ?>
					<div class="fact um_in">
							<?php if( $fact['fact_link'] != '' &&  $fact['fact_link'] != "http://"): ?>
								<a class="um_ajaxLink" href=<?php echo $fact['fact_link']; ?>>
							<?php  endif;?>
										
										<?php if( $fact['fact_icon'] != 'none') : ?>
											<div class="iconWrapper"><i class="fa <?php echo $fact['fact_icon']; ?> fa-4x"></i></div>
										<?php endif; ?>
										
										<div class="factWrapper">
											<h3><?php echo $fact['fact_name']; ?></h3>
											<h5><?php echo $fact['fact_description']; ?></h5>
										</div>
										
							<?php if( $fact['fact_link'] != '' &&  $fact['fact_link'] != "http://"): ?>
								</a>	
							<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</section>
		<?php endif;?>

	</div>
</section>

<script>
	jQuery(document).ready(function(){
		aboutUs();
		
		jQuery('.facts').owlCarousel({
			items: 4, 
			navigation: true, 
			navigationText: ["<i class='fa fa-angle-left fa-4x'></i>", "<i class='fa fa-angle-right fa-4x'></i>"]
		});
	});
</script>


<?php get_footer(); ?>