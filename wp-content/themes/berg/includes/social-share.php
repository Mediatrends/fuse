<?php function addSocialShareButtons($socialBox) {
        global $post;
        setup_postdata($post);

        if(!$socialBox){
             $socialBox = array();
        }
    ?>
    <?php if(in_array("facebook",$socialBox)):?>
		<a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" class="um_socialButton animated" id="facebook"><i class="fa fa-facebook fa-2x"></i></a>
    <?php endif;?>
    
	<?php if(in_array('twitter',$socialBox)):?>
		<a href="http://twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink(); ?>" target="_blank" class="um_socialButton animated" id="twitter"><i class="fa fa-twitter fa-2x"></i></a>
	<?php endif;?>
    
	<?php if(in_array('google',$socialBox)):?>
		<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="um_socialButton animated" id="google"><i class="fa fa-google-plus fa-2x"></i></a>
    <?php endif;?>
    
	<?php if(in_array('linkedIn',$socialBox)):?>
		<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" class="um_socialButton animated" id="linkedin"><i class="fa fa-linkedin fa-2x"></i></a>
    <?php endif;?>
    
	<?php if(in_array('stumble',$socialBox)):?>
		<a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" class="um_socialButton animated" id="stumble"><i class="icon-stumbleupon"></i></a>
	<?php endif;?>
	
	<?php if(in_array('pinit',$socialBox)):?>
		<a href="http://pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>" target="_blank" class="um_socialButton animated" id="pinit"><i class="fa fa-pinterest fa-2x"></i></a>
	<?php endif;?>

<?php } ?>