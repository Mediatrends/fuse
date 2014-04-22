<div class="imageContent audioFormat">
	<?php 
		 if(has_post_thumbnail()){
		the_post_thumbnail('audioCover');
		}
		if(get_field('audio_type')== "url"){

			$media = get_field('url');
		}
		else{

			$media = get_field('audio_file');
		}
	?>
		<div class="audioWrapper">
			<span class="um_helper"></span>
			<div class="audioContent">
				<h3 class="audioArtist"><?php the_field('audio_artist'); ?></h3>
				<p class="audioTitle"><?php the_field('audio_title')?></p>
				<div class="um_audio">
					<audio id="audioPlayer" src="<?php echo $media;?>" type="audio/mp3" controls="controls">
				</div>
			</div>
		</div>
</div> 