<?php
/*
Template Name:Blog Buckets
*/
?>
<?php 
$postspage_id = 0;
if(!is_page()){
    $postspage_id = get_option('page_for_posts');
    $post = get_post($postspage_id);
}

		if(isset($_REQUEST["um_page"])):
			 if(isset($_POST["paged"])): 
				if(isset($_POST["count"])):
				
					$paged = $_POST["paged"];
					$postCount = $_POST['count'];
			    
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
										
								<?php if($postCount % 2 == 1): ?>
										<?php
											  $classes = array(
												'blog2Post',
												'col-md-3',
												'col-xs-6',
												'noPadding',
												'fadeInDown',
												'animated'
											  );
											?>
											<div class="articleWrapper">
											<a class="um_ajaxLink" href="<?php the_permalink();?>">
												<article cat="<?php echo $post_categories_names;  ?>" id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>	
													<div class="imageContent">
															<?php if(has_post_thumbnail()){
																the_post_thumbnail('blogBuckets');
															} ?>
														<div class="bhover">
														<i class="fa <?php echo $icon; ?> fa-3x"></i>
														</div>
													</div>
													<div class="textContent">
														<img src="<?php echo get_template_directory_uri().'/assets/css/transparentBlog2.png'; ?>" >
														<div class="textWrapper">
															<p class="category"><?php echo $post_categories_realNames;?></p>
															<h5 class="title"><?php the_title(); ?></h5>
																<?php $excerpt =  get_the_excerpt(); ?>
																	<p class="description"><?php echo $excerpt; ?></p>
														</div>
													</div>
												</article>
											</a>
											</div>
								<?php else: ?>
										<?php
											  $classes = array(
												'blog2Post',
												'col-md-3',
												'col-xs-6',
												'noPadding',
												'fadeInUp',
												'animated'
											  );
											?>
											<div class="articleWrapper">
											<a class="um_ajaxLink" href="<?php the_permalink();?>">
												<article cat="<?php echo $post_categories_names;  ?>" id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>	
													<div class="textContent">
														<img src="<?php echo get_template_directory_uri().'/assets/css/transparentBlog2.png'; ?>" >
														<div class="textWrapper">
															<p class="category"><?php echo $post_categories_realNames;?></p>
															<h5 class="title"><?php the_title(); ?></h5>
																<?php $excerpt =  get_the_excerpt(); ?>
																	<p class="description"><?php echo $excerpt; ?></p>
														</div>
													</div>
													<div class="imageContent">
															<?php if(has_post_thumbnail()){
																the_post_thumbnail('blogBuckets');
															} ?>
														<div class="bhover">
															<i class="fa <?php echo $icon; ?> fa-3x"></i>
														</div>
													</div>
												</article>
												</a>
											</div>
								<?php endif;?>
								<?php $postCount++; ?>
							<?php endwhile;?>	
				
							<script>var postCount = parseInt('<?php echo $postCount; ?>');</script>				
<?php			 
				endif;
			 endif;
			die();
		endif;
?>

<?php get_header(); ?>

<section class="content blog2Page">
	<div class="container">
		
		<section class="blogContent">

			<?php wp_reset_postdata(); ?>
		<?php if(get_the_content()): ?>
			<section class="theContent hasMarginB">
				<h3 class="pageTitle"><?php the_title();?> </h3>
				<?php the_content(); ?>
			</section>
		<?php endif; ?>
		
			<ul class="filter list-inline text-center">
				 <?php $display = get_field('categories'); ?>
                            <?php $custom_cat = get_field('custom_categories'); ?>
                            <?php if($display == "all" || (!$display)){
                                $custom_cat = array();
                            } ?>

				               
                                 <?php if(count($custom_cat) > 1 || $display == "all"): ?>
                                        <li><a class="filterActive" href="#" data-filter="*"><?php _e('All','um_lang') ?></a></li>
                                  <?php endif; ?>
					                	<?php
					                    	$categories =  get_categories();
						                    foreach($categories as $cat):?>
                                                <?php if(in_array($cat->term_id,$custom_cat) || $display == "all"): ?>
						                            <li><a href="#" data-filter="<?php echo str_replace(' ','_',$cat->cat_name);?>"><?php echo $cat->cat_name;?></a></li>
                                                <?php endif;?>
						                    <?php endforeach;?>
			           			
			          	  </ul>
			

			
			
					<?php 
					
					$postCount = 1;
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
										
			<?php if($postCount % 2 == 1): ?>
			
			<?php
			  $classes = array(
				'blog2Post',
				'col-md-3',
				'col-xs-6',
				'noPadding',
				'fadeInDown',
				'animated'
			  );
			?>		<div class="articleWrapper">
						<a class="um_ajaxLink" href="<?php the_permalink();?>">
						<article cat="<?php echo $post_categories_names;  ?>" id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>	
							<div class="imageContent">
									<?php if(has_post_thumbnail()){
										the_post_thumbnail('blogBuckets');
									} ?>
								<div class="bhover">
									<i class="fa <?php echo $icon; ?> fa-3x"></i>
								</div>
							</div>
							<div class="textContent">
								<img src="<?php echo get_template_directory_uri().'/assets/css/transparentBlog2.png'; ?>" >
								<div class="textWrapper">
									<p class="category"><?php echo $post_categories_realNames;?></p>
									<h5 class="title"><?php the_title(); ?></h5>
										<?php $excerpt =  get_the_excerpt(); ?>
											<p class="description"><?php echo $excerpt; ?></p>
								</div>
							</div>
						</article>
						</a>
					</div>
			<?php else: ?>
				<?php
					  $classes = array(
						'blog2Post',
						'col-md-3',
						'col-xs-6',
						'noPadding',
						'fadeInUp',
						'animated'
					  );
					?>
					<div class="articleWrapper">
						<article cat="<?php echo $post_categories_names;  ?>" id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>	
							<a class="um_ajaxLink" href="<?php the_permalink();?>">
							<div class="textContent">
								<img src="<?php echo get_template_directory_uri().'/assets/css/transparentBlog2.png'; ?>" >
								<div class="textWrapper">
									<p class="category"><?php echo $post_categories_realNames;?></p>
									<h5 class="title"><?php the_title(); ?></h5>
										<?php $excerpt =  get_the_excerpt(); ?>
											<p class="description"><?php echo $excerpt; ?></p>
								</div>
							</div>

							<div class="imageContent">
									<?php if(has_post_thumbnail()){
										the_post_thumbnail('blogBuckets');
									} ?>
								<div class="bhover">
									<i class="fa <?php echo $icon; ?> fa-3x"></i>
								</div>
							</div>
							</a>
						</article>
					</div>
			<?php endif;?>
				<?php $postCount++; ?>
			<?php endwhile;?>	
		</section>
		
		<div>
			<?php if($the_Query->max_num_pages != 1):?>
				<div class="loadMore largeLoadMore text-center">
					<a href="#" class="loadMoreText"><?php _e('Load More ...','um_lang'); ?></a>
						<div class="um_spinner">
							<div class="um_bounce1"></div>
							<div class="um_bounce2"></div>
							<div class="um_bounce3"></div>
						</div>
				</div>
			<?php endif;?>
		</div>
		
	</div>
</section>
<script>

	var page = parseInt("<?php echo $paged; ?>");
	var last_page = parseInt('<?php echo $the_Query->max_num_pages; ?>');
	var postCount = parseInt('<?php echo $postCount; ?>');

	jQuery(document).ready(function() {
		blogBuckets();
	});
</script>
<?php get_footer(); ?>