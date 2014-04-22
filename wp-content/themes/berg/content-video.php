<div class="imageContent videoFormat">
	<?php if(get_field('video_type') == "youtube"):?>
		<div class="um_video youtube">

			 <iframe width="1024" height="720" src="https://www.youtube.com/embed/<?php the_field('video_id');?>" frameborder="0" allowfullscreen></iframe>
			 
		</div>
	<?php elseif(get_field('video_type') == "vimeo"):?>
		<div class="um_video vimeo">			
				<iframe src="//player.vimeo.com/video/<?php the_field('video_id');?>" width="1024" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		</div>
	<?php else:?>
		 <div class="um_video selfHosted">
			<video width="1024" height="720" controls><source src="<?php the_field('video_file'); ?>" type="video/mp4">Your browser does not support the video tag.</video>
		</div>
	<?php endif;?>
</div>