<?php get_header(); ?>
<?php wp_reset_postdata(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<section class="content singlePage">
		<div class="container">	
			
			<?php 
				$col_md_className = 'col-md-12';
				if ( is_active_sidebar( 'sidebar-1' ) ) {
					$col_md_className  = "col-md-9";
				} 
				?> 
			
			<section class="<?php echo $col_md_className; ?> blogContent">
				<div class="inner-content">
					<article class="blogPost">
						
						<?php if(!has_post_format() ): ?>
								<?php if(has_post_thumbnail()):?>
									<div class="imageContent standardFormat">
										<?php the_post_thumbnail('full'); ?>
									</div>
						<?php endif; ?>
						<?php else:?>
								<?php  get_template_part('content', get_post_format()); ?>
						<?php endif; ?>
						
						<?php
							$post_categories  = get_the_category();
							$post_categories_realNames = '';
							if($post_categories){
								foreach ($post_categories as $post_cat){
									$post_categories_realNames .= $post_cat->name.' ';
								}
							}
						?>
						
						<div class="articleContent">
							<h3><?php the_title();?></h3>
							<ul class="list-inline list-unstyled">
								<li><?php _e('Author','um_lang'); ?><b><?php the_author(); ?></b></li>
								<li><?php _e('Date','um_lang'); ?><b><?php echo get_the_date(' j F Y '); ?></b></li>
								<li><?php _e('Category','um_lang'); ?><b><?php echo  $post_categories_realNames; ?></b></li>
							</ul>
								<?php the_content(); ?>
								<?php wp_link_pages(); ?>
								<?php if(get_the_tags()): ?>
									<div class="tags">
										<span class="tagsTitle"><?php _e('Tags: ', 'um_lang'); ?></span>
										<?php the_tags('',' ',''); ?>
									</div>
								<?php endif; ?>
						
						
							<?php if($post->comment_status == 'open'): ?>
								<section class="singleComments">
										<?php comments_template(); ?>
								</section>
							<?php endif; ?>
						</div>
					</article>
				</div>
			</section>
			
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) :?>
				<section class="sidebar col-md-3">
					<div class="inner-content">
						<?php dynamic_sidebar( 'sidebar-1' );?>
					</div>
				</section>
			<?php endif;?>
		</div>
	</section>
</div>	

<?php get_footer(); ?>