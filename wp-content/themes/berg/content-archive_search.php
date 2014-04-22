<?php get_header(); ?>

		<?php 
			$col_md_className = 'col-md-12';
			if ( is_active_sidebar( 'sidebar-1' ) ) {
				$col_md_className  = "col-md-9";
			} 
		?> 
<section class="content archive_search">
	<div class="container">
		<section class="<?php echo $col_md_className; ?> searchContent">
			<div class="inner-content">
                    <ul class="searchList list-unstyled">
                    <?php  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
                        <?php while ($wp_query->have_posts()):
                            $wp_query->the_post(); ?>
                            <li class="archive_search_box">
                                <?php if(has_post_thumbnail()):?>
                                    <div class="imgHolder">
                                        <?php $icon = "fa-thumb-tack"; ?>
                                        <?php
                                        if(has_post_format('audio')){
                                            $icon = "fa-music";
                                        }
                                        elseif(has_post_format( 'video' )){
                                            $icon = "fa-play-circle";
                                        }
                                        elseif(has_post_format( 'image' )){
                                            $icon = "fa-picture-o";
                                        }?>
                                        <a class="um_ajaxLink" href="<?php the_permalink(); ?>"> <i class="fa <?php echo $icon; ?> fa-2x"></i></a>
                                        <?php the_post_thumbnail('thumbnail',array('class'=>''));?>
                                    </div>
                                <?php endif; ?>
                                    <div class="archive_searchContent">
										<a class="um_ajaxLink" href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
										<?php the_excerpt(); ?>
									</div>								
                            </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php  if($wp_query->max_num_pages > 1){
			                 pagination($wp_query,$wp_rewrite); 
                        }
                     ?>
			</div>
		</section>
            <!--Sidebar-->
            <?php if ( is_active_sidebar( 'sidebar-1' ) ) :?>
				<section class="sidebar col-md-3">
					<div class="inner-content">
						<?php dynamic_sidebar( 'sidebar-1' );?>
					</div>
				</section>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>