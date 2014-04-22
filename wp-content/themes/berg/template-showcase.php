<?php
/*
Template Name:Home Showcase
*/

get_header();
?>

<section class="content homeShowcase">

		<?php wp_reset_postdata(); ?>
		<?php if(get_the_content()): ?>
			<section class="theContent">
				<h3 class="pageTitle"><?php the_title();?> </h3>
				<?php the_content(); ?>
			</section>
		<?php endif; ?>

	<ul id="da-thumbs" class="da-thumbs">
	
	<?php $type = get_field('display_type');  ?>
	
	<?php if($type == "cat"): ?>		
			<?php $cat = get_field('categories');?>
			
			<?php
				$args = array(
                        'post_type' => 'gallery_post',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'gallery_category',
                                'field' => 'ID',
                                'terms' => $cat
                            )
                        )
                    );
			?>	
			
			<?php $the_Query = new WP_Query($args);
                    while ($the_Query->have_posts()):
                        $the_Query->the_post();?>
					
					<?php
						$post_terms = "";
							$terms = get_the_terms( $post->ID, 'gallery_category' );
							if($terms){
								foreach ($terms as $term){
									$post_terms .= $term->name.', ';
								}
								//removes ', ' from the last category
								$post_terms = substr($post_terms, 0, -2);
							}
						?>
						  <li class="col-md-2 col-sm-4 col-xs-12">
							<article class="um_in">
								<?php if(has_post_thumbnail()){
									the_post_thumbnail('showcase');
								} ?>
							<div class="galleryHover hover">
								<div class="catAndTitle">
									<span class="category"><?php echo $post_terms; ?></span>
									<span class="title"><?php the_title();?></span>
								</div>
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
			
	
	<?php elseif($type == "custom"): ?>
			
			 <?php $posts = get_field('custom_slelection', get_queried_object_id()); ?>
	
				 <?php if($posts):?>
                  <?php foreach($posts as $post):?>
                        <?php if (!is_numeric($post)):?>
                            <?php setup_postdata($post);?>
    
								<?php
								$post_terms = "";
									$terms = get_the_terms( $post->ID, 'gallery_category' );
									if($terms){
										foreach ($terms as $term){
											$post_terms .= $term->name.', ';
										}
										//removes ', ' from the last category
										$post_terms = substr($post_terms, 0, -2);
									}
								?>
								<li class="col-md-2 col-sm-4 col-xs-12">
									<article class="um_in">
										<?php if(has_post_thumbnail()){
											the_post_thumbnail('showcase');
										} ?>
										<div class="galleryHover hover">
											<div class="catAndTitle">
												<span class="category"><?php echo $post_terms; ?></span>
												<span class="title"><?php the_title();?></span>
											</div>
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
						  
                        <?php endif;?>
                  <?php endforeach;?>
			<?php endif;?>
	
	
	<?php endif; ?>	<!--Type-->
	
	<?php wp_reset_postdata();?>
	
	</ul>

</section>

<script>
jQuery(document).ready(function($){
	showcase();
});
</script>

<?php get_footer(); ?>