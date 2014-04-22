<?php function doBranding(){
	
	/*Logo Text*/
	if(get_field('logo_type','options') == "text"){
		$logo_color = get_field('logo_color','options');
		$logo_size = get_field('logo_size','options');
		$logo_font = get_field('logo_font','options');
		?>
				<style>
					.logo.textLogo a{
						color: <?php echo $logo_color; ?> !important;
						font-size: <?php echo $logo_size; ?>px !important;
						font-family: <?php echo $logo_font['family']; ?> !important;
					}
				</style>
	<?php 
	} 
	/*Logo Text*/ 
	
	
	

	/*Brand Color*/
	$brandColor = get_field('brand_color','options');
	if($brandColor){
		$brandColorArr = sscanf($brandColor, "#%02x%02x%02x");
	?>
	
				<style>
							
							::selection {
								background: <?php echo $brandColor; ?> !important;
							}

							::-moz-selection {
								background: <?php echo $brandColor; ?> !important;
							}

							.serviceIcon:after {
								border-top: 12px solid <?php echo $brandColor; ?> !important;
							}

							.contactFormWrapper .contactInfo .addressTitle {
								border-left:solid 1px <?php echo $brandColor; ?> !important; 
							}

							.aboutPage .fact .iconWrapper {
								border:solid 3px <?php echo $brandColor; ?> !important;
							}	
							.socialIcons li a:hover {
								border-color: <?php echo $brandColor; ?> !important;
							}
								
							.archive_search_box .imgHolder > a, 
							.blogPost .hover, 
							.blog2Post .imageContent .bhover,
							.da-thumbs li article .galleryHover:not(.horisontal){
								 background:rgba(<?php echo $brandColorArr[0].','.$brandColorArr[1].','.$brandColorArr[2]; ?>,0.9) !important; 
							}
								
							header nav li a:hover,
							.blogPost .articleContent h3, 							
							.socialIcons li a:hover, 
							.galleryLinks a:hover, 
							.current_page_item, 
							.current_page_item > a, 
							.clientHover h4 a, 
							article.service .title a, 
							#da-titles li article:hover .textContent .title a,
							#da-titles li article .textContent .title a:hover, 
							.galleryPost .articleContent h3 a:hover, 
							.blogPost .articleContent h3 a:hover, 
							.blog2Post:hover .textContent .title a, 
							.blog2Post .textContent .title a:hover, 
							.contactFormWrapper .contactTitle, 
							.contactFormWrapper .contactInfo .addressTitle, 
							.aboutPage .nameAndSocial h3, 
							.aboutPage .fact .iconWrapper, 
							.aboutPage .fact div h3, 
							.pageTitle,
							.gallerySinglePage  .articleContent h3, 
							.comment-reply-title, 
							.latestComents, 
							.commentBody li .commentText .comment_name,
							.logged-in-as a, 
							.fourOfour .theContent > h1, 
							.widget a:hover, 
							.um_lightbox .title, 
							.articleWrapper article:hover .title, 
							.tagsTitle, 
							.tags a:hover, 
							.slides-navigation a:hover, 
							.sub-menu a:hover, 
							.contactSend:hover, 
							.shareIt:hover, 
							.shareIt.um_active, 
							ul.accordion li > a.active,
							ul.toggle li > a.active, 
							ul.accordion li a:hover,
							ul.toggle li a:hover, 
							.owl-buttons > div:hover, 
							.archive_searchContent a:hover h5,
							.loadMore a,
							.rslides_nav:hover,
							.um_lightbox  .um_lightboxBtn:hover, 
							.galleryBucket #da-titles li article:hover .textContent .title {
								color: <?php echo $brandColor; ?> !important;
							}

							article.service .serviceIcon, 
							.imageOverlay, 
							.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar:hover, 
							.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar, 
							#commentform > .form-submit input,
							.commentBody li .comment-reply-link:hover,
							.commentBody li .edit-link a:hover, 
							.comment-awaiting-moderation, 
							#wp-calendar tbody #today, 
							.um_spinner > div, 
							blockquote::before, 
							.responsiveMenuBtn {
								background:<?php echo $brandColor; ?> !important;
							}
							
				</style>	 
	
	<?php 
	} 
	/*Brand Color*/ 
	
	
	
	
	
	/*Web Font*/
	$siteFont = get_field('website_font','options');
	if($siteFont){
	?>

				<style>
						body{
							font-family: <?php echo $siteFont['family']; ?> !important;
						}
						strong, b, 
						.loadMore a, 
						.clientHover h4 a, 
						article.service .title a, 
						.galleryPost .articleContent h3 a, 
						.blogPost .articleContent h3 a, 
						.tagsTitle, 
						.contactFormWrapper .contactTitle, 
						.contactFormWrapper .contactInfo .addressTitle, 
						.contactSend.btn, 
						.aboutPage .fact div h3, 
						.pageTitle,
						.gallerySinglePage  .articleContent h3, 
						#commentform > .resetWrapper *, 
						#commentform > .form-submit *, 
						.comment-reply-title, 
						.latestComents, 
						.commentBody li .commentText .comment_name, 
						.commentBody li .comment-reply-link,
						.commentBody li .edit-link a, 
						.um_lightbox .title, 
						.um_lightbox  .um_lightboxBtn, 
						.audioContent .audioArtist, 
						.responsiveMenuBtn {
							font-family: <?php echo $siteFont['family']; ?> !important;
						}
				</style>

	<?php
	}	
	/*Web Font*/

	
 }
 ?>