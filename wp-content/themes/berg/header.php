<?php if(!isset($_REQUEST["um_ajax_load_site"])): ?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset=UTF-8>
	<script>
        var template_directory = "<?php echo get_template_directory_uri(); ?>";
        var ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
        var postId = "<?php echo $post->ID; ?>";
        var ajaxDisabled = "<?php echo get_field("disable_ajax","options");?>";
    </script>

    <?php if(get_field("site_favicon","options")): ?>
        <link rel="icon" type="image/png" href="<?php the_field("site_favicon","options"); ?>" />
    <?php endif; ?>
    <title><?php bloginfo('name') ?><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	
	
	<?php doBranding(); ?>
	
	<?php if(get_field('custom_css','options')):?>
		<style>
			<?php the_field('custom_css','options'); ?>
		</style>
	<?php endif; ?>
	
	<?php if(get_field('custom_java-script','options')):?>
		<script>
			<?php the_field('custom_java-script','options'); ?>
		</script>
	<?php endif; ?>
	
	<?php wp_head(); ?>
</head>
  
<body <?php  body_class(); ?>>

<div class="um_container">
<header>
    <div class="container">
        <section class="logoAndSlug col-md-5 col-xs-12">
            <?php
				$logoWrapperClass = 'col-md-12';
				if(get_field('web_site_slogan','options') != ""){ 
					$logoWrapperClass = 'col-md-6';
				} 
			?>
			
			<div class="logoContainer <?php echo $logoWrapperClass; ?>">

				<span class="um_helper"></span>

        		<?php if(get_field('logo_type','options') == 'text'): ?>

        			<h1 class="logo textLogo"><a href="<?php echo site_url(); ?>"><?php the_field('logo_text','options');?></a></h1>

        		<?php elseif(get_field('logo_type','options') == 'image'): ?>

        			<?php $logoImg = wp_get_attachment_image_src( get_field('logo_image' ,'option'), 'full'); ?>

        			<?php if(get_field('retina_logo','options')){
        				$logoW = $logoImg[1] / 2; 
        				$logoH = $logoImg[2] / 2; 
        			}else{
						$logoW = $logoImg[1]; 
        				$logoH = $logoImg[2];
					}
					
					?>
					<a href="<?php echo site_url(); ?>"><img width="<?php echo $logoW; ?>" height="<?php echo $logoH; ?>" src="<?php echo $logoImg[0]; ?>" class="logo imgLogo <?php echo $retinaLogo; ?>"></a>
        		<?php else: ?>
        			<h1 class="logo textLogo"><a href="<?php echo site_url(); ?>"><?php bloginfo('name');?></a> </h1>
        		<?php endif;?>
    		</div>

			<?php if(get_field('web_site_slogan','options') != ""): ?>

            <div class="slug col-md-6 col-xs-12">
                <span class="um_helper"></span>
    			<h1><?php echo get_field('web_site_slogan','options'); ?></h1>
            </div>

			<?php endif ?>			
        </section>
		<?php $menu = 'vertical'; 

			if(get_field('menus','options')=='horizontal'){
				$menu = 'horizontal'; 
			} 
		?>
		
        <nav class="mainMenu <?php echo $menu; ?> col-md-7 col-xs-12">
                <p class="responsiveMenuBtn"><?php _e('Navigation','um_lang'); ?> <i class="fa fa-bars"></i></p>
        <span class="um_helperHorisontal"></span>
             <?php
                $defaults = array(
                    'theme_location'  => 'main_menu',
                    'menu'            => '',
                    'container'       => 'div',
                    'container_class' => 'um_menuContainer',
                    'container_id'    => '',
                    'menu_class'      => 'nav',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0
                );
                wp_nav_menu( $defaults );
            ?>
        </nav>
    </div>
</header>

<div class="main_container">
<?php endif; ?>

<?php if(!get_field("disable_loading","options")): ?>
    <div class="um_shadow active">
        <div class="um_spinner">
            <div class="um_bounce1"></div>
            <div class="um_bounce2"></div>
            <div class="um_bounce3"></div>
        </div>
    </div>
<?php endif; ?>
 