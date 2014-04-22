<?php
/*
Template Name:Blog Big
*/

$postspage_id = 0;
if(!is_page()){
    $postspage_id = get_option('page_for_posts');
    $post = get_post($postspage_id);

}

		if(isset($_REQUEST["um_page"])):
			 if(isset($_POST["paged"])): 
 				
				$paged = $_POST["paged"];
			    
				 $display = get_field('categories'); 
                 $custom_cat = get_field('custom_categories'); 
					if($display == 'all'){
							$args = array(
								'post_type' => 'post',
								'paged'     => $paged
							);
					}
					else{
							$args = array(
								'post_type' => 'post',
								'paged'     => $paged,
								'category__in' => $custom_cat
							);
						}
					$the_Query = new WP_Query($args);

					while ($the_Query->have_posts()):
                		$the_Query->the_post();?>

						<?php
			                $post_categories  = get_the_category();
			                $post_categories_names = '';
                            $post_categories_realNames = '';
			                if($post_categories){
			                    foreach ($post_categories as $post_cat){
			                        $post_categories_names .= str_replace(' ', '_',$post_cat->name)." ";
                                    $post_categories_realNames .= $post_cat->name.', ';
			                    }
								//removes ', ' from the last category
								$post_categories_realNames = substr($post_categories_realNames, 0, -2);
			                }
		                ?>
		                <?php
						  $classes = array(
							'blogPost',
							'fadeInDown',
							'animated'
							//$post_categories_names
						  );
						?>
						
						<article cat="<?php echo $post_categories_names;  ?>" id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>	
							<div class="imageContent">
									<?php if(has_post_thumbnail()){
												the_post_thumbnail('blogBig');
											} ?>
											
								<div class="hover">
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
												}
										?>
								
									<a class="um_ajaxLink" href="<?php the_permalink(); ?>"><i class="fa <?php echo $icon; ?> fa-5x"></i></a>
								</div>
							</div>
							<div class="articleContent">
								<h3><a class="um_ajaxLink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<ul class="list-inline list-unstyled">
									<li><?php _e('Author','um_lang'); ?><b><?php the_author(); ?></b></li>
									<li><?php _e('Date','um_lang'); ?><b><?php echo get_the_date(' j F Y '); ?></b></li>
									<li><?php _e('Category','um_lang'); ?><b><?php echo  $post_categories_realNames; ?></b></li>
								</ul>
									<?php $excerpt =  get_the_excerpt(); ?>
									<p class="description"><?php echo $excerpt; ?></p>
							</div>
						</article>
<?php 
					endwhile; 
			endif;
			die();
		endif; 
		

get_header();
?>

		<?php 
			$col_md_className = 'col-md-12';
			if ( is_active_sidebar( 'sidebar-1' ) ) {
				$col_md_className  = "col-md-9";
			} 
			?> 


<section class="content blogPage">
	<div class="container">	
		
		<section class="<?php echo $col_md_className; ?> blogContent">
	
		<?php if(is_page()): ?>
			<?php wp_reset_postdata(); ?>
				<?php if(get_the_content()): ?>
					<section class="theContent hasMarginB inner-content">
						<h3 class="pageTitle"><?php the_title();?> </h3>
						<?php the_content(); ?>
					</section>
				<?php endif; ?>
		<?php endif; ?>

			<div class="inner-content">
				
					<?php 
							$display = get_field('categories'); 
                            $custom_cat = get_field('custom_categories');
							
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            if($display == 'all'){
                                $args = array(
                                    'post_type' => 'post',
                                    'paged'     => $paged
                                );
                            }
                            else{
                                $args = array(
                                    'post_type' => 'post',
                                    'paged'     => $paged,
                                    'category__in' => $custom_cat
                                );
                            }

							$the_Query = new WP_Query($args);

							while ($the_Query->have_posts()):
								$the_Query->the_post();?>

								<?php
									$post_categories  = get_the_category();
									$post_categories_names = '';
                                    $post_categories_realNames = '';
									if($post_categories){
										foreach ($post_categories as $post_cat){
											$post_categories_names .= str_replace(' ', '_',$post_cat->name)." ";
                                            $post_categories_realNames .= $post_cat->name.', ';
										}
										//removes ', ' from the last category
										$post_categories_realNames = substr($post_categories_realNames, 0, -2);
									}
								?>
								<?php
								  $classes = array(
									'blogPost',
									'fadeInDown',
									'animated'
								  );
								?>
				
										<article cat="<?php echo $post_categories_names;  ?>" id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>	
											<div class="imageContent">
													<?php if(has_post_thumbnail()){
																the_post_thumbnail('blogBig');
															} ?>
															
												<div class="hover">
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
																}
														?>
												
													<a href="<?php the_permalink(); ?>"><i class="fa <?php echo $icon; ?> fa-5x"></i></a>
												</div>
											</div>
											<div class="articleContent">
												<h3><a class="um_ajaxLink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<ul class="list-inline list-unstyled">
													<li><?php _e('Author','um_lang'); ?><b><?php the_author(); ?></b></li>
													<li><?php _e('Date','um_lang'); ?><b><?php echo get_the_date(' j F Y '); ?></b></li>
													<li><?php _e('Category','um_lang'); ?><b><?php echo  $post_categories_realNames; ?></b></li>
												</ul>
													<?php $excerpt =  get_the_excerpt(); ?>
													<p class="description"><?php echo $excerpt; ?></p>
											</div>
										</article>
				<?php endwhile; ?>
				 <?php if($the_Query->max_num_pages != 1):?>
					<article class="loadMore largeLoadMore text-center">
						<a href="#" class="loadMoreText"><?php _e('Load More ...','um_lang'); ?></a>
						<div class="um_spinner">
							<div class="um_bounce1"></div>
							<div class="um_bounce2"></div>
							<div class="um_bounce3"></div>
						</div>
					</article>
				<?php endif;?>
			</div>
		</section>
		
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) :?>
		<section class="sidebar col-md-3">
			<div class="inner-content">
				<?php dynamic_sidebar( 'sidebar-1' );?>
			</div>
		</section>
		<?php endif; ?>
	</div>
</section>

<script>

	var page = parseInt("<?php echo $paged; ?>");
	var last_page = parseInt('<?php echo $the_Query->max_num_pages; ?>');

	jQuery(document).ready(function() {
		blog();
	});
</script>

<?php get_footer(); ?>