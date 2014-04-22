<?php get_header(); ?>

<?php 
	$col_md_className = '';
	if(get_field('enable_sidebar')){
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$col_md_className  = "col-md-9 inner-content";
		} 
	}
?> 
			
<section class="content defaultPage">
	<div class="container">
		<div class="<?php echo $col_md_className; ?>">
			<section class="theContent">
				<?php wp_reset_postdata(); ?>
				<h3 class="pageTitle"> <?php the_title(); ?></h3>
				<?php the_content(); ?>
				
			</section>
		</div>
		<?php if(get_field('enable_sidebar')): ?>
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) :?>
			<section class="sidebar col-md-3">
				<div class="inner-content">
					<?php dynamic_sidebar( 'sidebar-1' );?>
				</div>
			</section>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>