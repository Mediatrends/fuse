<?php
/*
Template Name:Contact
*/
?>

<?php 
		
	if(isset($_REQUEST["um_name"]) && isset($_REQUEST["um_email"]) && isset($_REQUEST["um_message"])){
		$name = $_REQUEST["um_name"];
		$email = $_REQUEST["um_email"];
		$message = $_REQUEST["um_message"];
		$to_email = get_field("email_receiver");
		if(!$to_email){
			$to_email = get_option('admin_email');
		}
		$subject = "[".get_bloginfo('name')."] - ".$email;
		
			$message = "
				Name : {$name},
				Email : {$email}

				$message
			";
	  
		if(wp_mail($to_email,$subject,$message))
		{
			echo  get_field('success_message');
		}
		else{
			echo get_field('fail_message');
		}

		die;
	}

?>

<?php get_header(); ?>

<?php
    	$latLng = get_field('google_map');
    	$zoomLevel = get_field('zoom_level');
		$marker = get_field('custom_marker');
		$zoomIn = get_field('disable_zoom_in');
		
		if(!$zoomIn){
			$zoomIn = 'true';
		}else{
			$zoomIn = 'false';
		}
		$markerImage = '';
		if($marker){
			$markerImage = wp_get_attachment_image_src( $marker, 'mapMarker');
			$markerImage = $markerImage[0]; 
		}
?>

<?php if($latLng != ""): ?> 
    <script>
        jQuery(document).ready(function ($) {

            var myCenter = new google.maps.LatLng(<?php echo $latLng['coordinates']; ?>);
			var customMarker = "<?php echo $markerImage; ?>";
			
            function initialize()
            {
                var mapProp = {
                    center:myCenter,
                    zoom: <?php echo $zoomLevel; ?>,
					scrollwheel: <?php echo $zoomIn;?>,
                    mapTypeId:google.maps.MapTypeId.ROADMAP
                };

				if($('#googleMap').length == 1){
					
					var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
					
					if(customMarker != ''){
						var marker = new google.maps.Marker({
							position:myCenter,
							icon: customMarker
						});
					}
					else{
						   marker = new google.maps.Marker({
                                position:myCenter
                            });
					}
					marker.setMap(map);
				}
            }
            initialize();
        });

    </script>
<?php endif; ?>

<section class="content contactPage">
	<div class="container">
		
		<?php wp_reset_postdata(); ?>
		<?php if(get_the_content()): ?>
			<section class="theContent hasMarginB">
				<h3 class="pageTitle"><?php the_title();?> </h3>
				<?php the_content(); ?>
			</section>
		<?php endif; ?>	


		<?php if(!get_field('disable_map')): ?>
			<section id="googleMap" class="map"></section>
		<?php endif; ?>

		<section class="contactFormWrapper">	
			<h3 class="contactTitle"><?php the_field('contact_form_name'); ?></h3>
			<h4 class="contactSlug"><?php the_field('contact_form_slogan'); ?></h4>

			<form class="contactForm" action="" method="post">
				<div class="col-md-6 col-xs-12">
					<input class="col-md-12 col-xs-12" id='full_name' name='full_name'  type="text" placeholder="<?php the_field('name_label'); ?>">
				</div>
				<div class="col-md-6 col-xs-12">
					<input class="col-md-12 col-xs-12" id='email' name='email' type="email" placeholder="<?php the_field('email_label'); ?>">
				</div>
				<div class="col-md-12 col-xs-12">	
					<textarea rows="8" id="comment" name='comment' class="col-md-12 col-xs-12"  placeholder="<?php the_field('message_label'); ?>"></textarea>
				</div>
				<div class="col-md-12 col-xs-12">	
					<button  type="submit" class="btn col-md-12 col-xs-12 contactSend"><?php the_field('send_button_label'); ?></button>
				</div>
			</form>
			<div class="um_message">
				<h1></h1>
			</div>

				<?php $details = get_field('details'); ?>
				<?php if($details): ?>
					<section class="contactInfo col-md-12">
						<?php foreach($details as $detail): ?>
							<address class="col-md-4">
								<h4 class="addressTitle"><?php echo $detail['detail_title']; ?></h4>
								<p><?php echo $detail['detail_content']; ?></p>
							</address>
						<?php endforeach; ?>
					</section>
				<?php endif;?>
		</section>	

	</div>
</section>

<?php get_footer(); ?>