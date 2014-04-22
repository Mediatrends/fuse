<?php
/*
Template Name:Galleries Horisontal
*/
?>
<?php $postCount = 0; ?>
<?php if(isset($_REQUEST["um_page"])): ?>
			<?php if(isset($_POST["paged"])): ?>
			
				
			<?php
				$display = get_field('categories'); 
				$custom_cat = get_field('custom_categories');
				 if($display == "all" || (!$custom_cat)){
							$custom_cat = array();
						}	
				$paged = $_POST["paged"];
					
				if($display == "all" || count($custom_cat) < 1 )
				{
					$args = array(
						'post_type' => 'gallery_post',
						'paged'     => $paged
					);
				}
				else{
					$args = array(
						'post_type' => 'gallery_post',
						'paged'     => $paged,
						'tax_query' => array(
							array(
								'taxonomy' => 'gallery_category',
								'field' => 'ID',
								'terms' => $custom_cat
							)
						)
					);
				}

				$the_Query = new WP_Query($args);
					while ($the_Query->have_posts()):
						$the_Query->the_post();
						
						$terms = get_the_terms( $post->ID, 'gallery_category' );
						$post_terms = '';
						$post_term_name = '';
						if($terms){
							foreach ($terms as $term){
								$post_terms .= str_replace(' ', '_', $term->name).' ';
								$post_term_name .= $term->name.', ';
							}
							//removes ', ' from the last category
							$post_term_name = substr($post_term_name, 0, -2);
						}
						?>
	
						<?php 
								$animateClass = ""; 
								if($postCount % 2 == 1){
									$animateClass = "fadeInLeft animated";
								}
								else{
									$animateClass = "fadeInRight animated";
								}
								$postCount++;
							?>
	
							<li class="col-md-12">
									<article cat="<?php echo $post_terms; ?>" class="<?php echo $animateClass;?>">
									
									<?php if(has_post_thumbnail()){
										the_post_thumbnail('horizontalShowcase');
									} ?>
									
									<div class="galleryHover hover horisontal">
										<span class="category"><?php echo $post_term_name; ?></span>
										<span class="title"><?php the_title(); ?></span>
										<div class="galleryLinks">
										<a href="<?php the_permalink(); ?>" class="um_ajaxLink singlePageLink"><i class="fa fa-plus"></i></a>
										<?php $slider = get_field('gallery'); ?>
										<?php if($slider):?>
											<a href="#" class="liteBoxLink" dataId="<?php the_ID(); ?>"><i class="fa fa-expand"></i></a>
										<?php endif; ?>
										</div>
									</div>
								</article>
							</li>
							
					<?php endwhile; ?>
			<?php endif; ?>
		<?php die();?>
	<?php endif; ?>

<?php get_header(); ?>

<section class="content galleryHorisontal">
	<div class="container">
		
		<?php wp_reset_postdata(); ?>
		<?php if(get_the_content()): ?>
			<section class="theContent hasMarginB">
				<h3 class="pageTitle"><?php the_title();?> </h3>
				<?php the_content(); ?>
			</section>
		<?php endif; ?>
		
		
		<?php  $display = get_field('categories'); ?>
		<?php  $custom_cat = get_field('custom_categories'); ?>	
		<?php if($display == "all" || (!$custom_cat)){
						$custom_cat = array();
					}	 
		?>
		
		<ul id="da-horisontal" class="da-thumbs">
		
		   <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            if($display == "all" || count($custom_cat) < 1 )
            {
                $args = array(
                    'post_type' => 'gallery_post',
                    'paged'     => $paged
                );
            }
            else{
                $args = array(
                    'post_type' => 'gallery_post',
                    'paged'     => $paged,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'gallery_category',
                            'field' => 'ID',
                            'terms' => $custom_cat
                        )
                    )
                );
            }
			$the_Query = new WP_Query($args);

			while ($the_Query->have_posts()):
				$the_Query->the_post();?>


			  <?php
            global $post;
            setup_postdata($post);
            $terms = get_the_terms( $post->ID, 'gallery_category' );
            $post_terms = '';
            $post_term_name = '';
            if($terms){
                foreach ($terms as $term){
                    $post_terms .= str_replace(' ', '_', $term->name).' ';
                    $post_term_name .= $term->name.', ';
                }
				//removes ', ' from the last category
				$post_term_name = substr($post_term_name, 0, -2);
            }
            ?>
		
			<?php 
				$animateClass = ""; 
				if($postCount % 2 == 1){
					$animateClass = "fadeInLeft animated";
				}
				else{
					$animateClass = "fadeInRight animated";
				}
				$postCount++;
			?>
		
			<li class="col-md-12">
					<article cat="<?php echo $post_terms; ?>" class="<?php echo $animateClass; ?>">
					
					<?php if(has_post_thumbnail()){
						the_post_thumbnail('horizontalShowcase');
					} ?>
					
					<div class="galleryHover hover horisontal">
						<span class="category"><?php echo $post_term_name; ?></span>
						<span class="title"><?php the_title(); ?></span>
						<div class="galleryLinks">
							<a href="<?php the_permalink(); ?>" class="singlePageLink"><i class="fa fa-plus"></i></a>
							<?php $slider = get_field('gallery'); ?>
							<?php if($slider):?>
								<a href="#" class="liteBoxLink" dataId="<?php the_ID(); ?>"><i class="fa fa-expand"></i></a>
							<?php endif; ?>
						</div>
					</div>
				</article>
			</li>
			
			<?php endwhile; ?>	
			<?php if($the_Query->max_num_pages != 1):?>
				<li class="col-md-12 col-xs-12">
					<div class="loadMore largeLoadMore text-center">
						<a href="#" class="loadMoreText"><?php _e('Load More ...','um_lang'); ?></a>
							<div class="um_spinner">
							<div class="um_bounce1"></div>
							<div class="um_bounce2"></div>
							<div class="um_bounce3"></div>
						</div>
					</div>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</section>

<script>

	var page = parseInt("<?php echo $paged; ?>");
    var last_page = parseInt('<?php echo $the_Query->max_num_pages; ?>');
	
	jQuery(document).ready(function(){	
		galleryTemplate();
	});
</script>
<?php get_footer(); ?>

