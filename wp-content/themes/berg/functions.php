<?php 
$theme_name = "Berg";
$theme_version = "1.0.2";
global $theme_name;
global $theme_version;


/*includes*/

define( 'ACF_LITE' , true );
include_once('includes/advanced-custom-fields/acf.php' );
include 'includes/post-types.php';
include 'includes/comment.php';
include 'includes/social-share.php';
include 'includes/branding.php';
include 'includes/shortcodes/shortcodes.php';
include 'includes/custom-fields.php';

/*includes*/


/*ACF*/
// Fields
    add_action('acf/register_fields', 'my_register_fields');
    function my_register_fields()
    {
        include_once('includes/add-ons/acf-repeater/repeater.php');
        include_once('includes/add-ons/acf-gallery/gallery.php');
        include_once('includes/add-ons/acf-flexible-content/flexible-content.php');
        include_once('includes/add-ons/advanced-custom-fields-limiter-field/limiter-v4.php');
       
        include_once('includes/registered-fields/presets/acf-presets.php');
        include_once('includes/registered-fields/google-font/acf-googlefonts.php');
        include_once('includes/registered-fields/googlemap/acf-googlemap.php');
    }

// Options Page

    include_once( 'includes/add-ons/acf-options-page/acf-options-page.php' );


	add_filter('acf/options_page/settings','register_options_page');
    function register_options_page($options)
    {
       $options['title'] = __('Theme Options','um_lang');
       $options['pages'] = array(
            __('Main','um_lang'),
			__('Header','um_lang'),
			__('Footer','um_lang')
        );
       return $options;
    }
   
   
    add_action( 'acf/input/admin_enqueue_scripts', 'acf_collapse_fields' );
    function acf_collapse_fields(){
        wp_enqueue_script('collapse-fields_js', get_template_directory_uri().'/includes/collapse-fields/acf_collapse.js', array(),'',TRUE);
        wp_enqueue_style('collapse-fields_css',  get_template_directory_uri().'/includes/collapse-fields/acf_collapse.css' , false, "1.0");
    }

/*ACF*/

/*Theme supports*/
  if ( ! isset( $content_width ) ) $content_width = 940;

  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'post-formats', array('image','video','audio'));

/*Theme supports*/



/*Image sizes*/
	add_image_size('showcase', 450, 408, true);
	add_image_size('horizontalShowcase', 1800, 300, true);
	add_image_size('clients',201 ,132 , false);
	add_image_size('blogBig',1800 ,851 ,true);
	add_image_size('blogBuckets',477 ,294 ,true);
	add_image_size('galleryBuckets',450 ,450 ,true);
	add_image_size('mapMarker',60 ,71 ,true);
	add_image_size('aboutUs',900 ,500 ,true);
	add_image_size('audioCover',1367 ,500 ,true);
/*Image sizes*/



/*Support Language Translation*/
    add_action('after_setup_theme', 'um_theme_setup');
    function um_theme_setup(){
        load_theme_textdomain('um_lang', get_template_directory().'/lang');
    }
/*Support Language Translation*/


/*Add Menu Support*/

    add_action( 'after_setup_theme', 'register_theme_menus' );
    function register_theme_menus() {
		register_nav_menus(
			array(
				'main_menu' => __( 'Main Menu',"um_lang" )            
			)
		);
	}
/*Add Menu Support*/


/*Excerpt more*/
	   function custom_excerpt_length($length){
        
		if(is_page_template('template-blog_buckets.php')){
			return 25;
		}
		else{
			return 50;
		}
		
    }
    add_filter( 'excerpt_length', 'custom_excerpt_length');

	function new_excerpt_more($more )
    {
        return '...';
    }
    add_filter('excerpt_more', 'new_excerpt_more');
/*Excerpt more*/

	
/* Register Sidebar*/

	add_action( 'after_setup_theme', 'um_registerSidebar' );
	function um_registerSidebar(){

			register_sidebar( array(
			'name' => __( 'Main Sidebar', 'umbrella' ),
			'id' => 'sidebar-1',
			'description' => __('Add widgets to the Main sidebar','um_lang'),
			'before_widget' => '<div id="%1$s" class="widget">',
			'after_widget' => "</div>",
			'before_title' => '<h1>',
			'after_title' => '</h1>'

		) );
	}
/* Register Sidebar*/


/*pagination*/

	function pagination($query, $wp_rewrite){
		?>
		<div class="isCentered">
			<div class="pagination type2">
				<?php
				$format = $wp_rewrite->using_permalinks() ? "/page/%#%" : '?paged=%#%';
				$big = 999999999; // need an unlikely integer
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => $format,
					'current' => max( 1, get_query_var('paged') ),
					'total' => $query->max_num_pages,
					'prev_next'    => true,
					'show_all'     => False,
				) );
				?>
			</div>
		</div>
	<?php
	}
/*pagination*/

/*Errors for contact*/
	function throwError($fieldName)
	{
		wp_die(__('Error: please fill the Field "'.$fieldName.'"!','um_lang' ) .
			__('<a onclick="history.go(-1)"><p style="cursor: hand; cursor: pointer;">Back</p></a>','um_lang'));
	}
/*Errors for contact*/




/*External java-script*/
  add_action( 'wp_enqueue_scripts', 'add_external_js' );

  function add_external_js(){
    //jQyery
        wp_enqueue_script('jquery');
	//BOOTSTRAP
		wp_enqueue_script("Bootstrap", get_template_directory_uri()."/assets/bootstrap/js/bootstrap.min.js" , array(),'',TRUE);
	// Modernizr
		wp_enqueue_script("modernizr", get_template_directory_uri()."/assets/js/modernizr.custom.97074.js" , array(),'',TRUE);
	// Ajax
		wp_enqueue_script("AjaxSite", get_template_directory_uri()."/assets/js/ajaxSite.js" , array(),'',TRUE);
	//Gallery Filter
		wp_enqueue_script("galleryFilter", get_template_directory_uri()."/assets/js/galleryFilter.js" , array(),'',TRUE);	
	//Blog Filter
		wp_enqueue_script("blogFilter", get_template_directory_uri()."/assets/js/blogFilter.js" , array(),'',TRUE);	
	//SuperSlides
        wp_enqueue_script("SuperSlides", get_template_directory_uri()."/assets/SuperSlides/js/jquery.superslides.min.js" , array(),'',TRUE);
    //mousewheel
        wp_enqueue_script("mousewheel", get_template_directory_uri()."/assets/mCustomScrollbar/js/jquery.mousewheel.min.js" , array(),'',TRUE);
    //jQueryUI
        wp_enqueue_script("jQueryUI", get_template_directory_uri()."/assets/js/jquery-ui.min.js" , array(),'',TRUE);
    //mCustomScrollbar
        wp_enqueue_script("mCustomScrollbar", get_template_directory_uri()."/assets/mCustomScrollbar/js/jquery.mCustomScrollbar.min.js" , array(),'',TRUE);		
	//GoogleMap
		wp_enqueue_script("google_map","https://maps.googleapis.com/maps/api/js?sensor=true",'','',TRUE);
	//owlSlider
		wp_enqueue_script("owlSlider",get_template_directory_uri()."/assets/js/owl.carousel.min.js" , array(),'',TRUE);
	//responsiveslides
		wp_enqueue_script("responsiveslides",get_template_directory_uri()."/assets/js/responsiveslides.min.js" , array(),'',TRUE);
	// Main Script
		wp_enqueue_script("mainScript", get_template_directory_uri()."/assets/js/mainScript.js" , array(),'',TRUE); 
	//Tab, accordion, toggle ShortCodes	
		wp_enqueue_script("tabAccTog", get_template_directory_uri()."/assets/js/tabAccTog.js" , array(),'',TRUE); 
	//Comment Replay
	   if ( is_singular() ){
			wp_enqueue_script( 'comment-reply','',array(),'',TRUE );
		}

  }
/*External java-script*/


/*External Css*/
    add_action( 'wp_enqueue_scripts', 'add_external_stylesheets' );
	
    function add_external_stylesheets(){

	//style.css
        wp_enqueue_style("main", get_stylesheet_uri() , false, "1.0");
	//Bootstrap
		wp_enqueue_style("bootstrap", get_template_directory_uri().'/assets/bootstrap/css/bootstrap.min.css', false, "1.0");
	//showcaseStyle
		wp_enqueue_style("showcaseStyle", get_template_directory_uri().'/assets/css/style.css', false, "1.0");
	//iCONS
        wp_enqueue_style("font-awesome", get_template_directory_uri().'/assets/fonts/FontAwesome/css/font-awesome.min.css' , false, "1.0");
	//icomoon
        wp_enqueue_style("icomoon", get_template_directory_uri().'/assets/fonts/icomoon/style.css' , false, "1.0");
	//Animate
        wp_enqueue_style("animate", get_template_directory_uri().'/assets/css/animate.css' , false, "1.0");
	//Roboto Font
        wp_enqueue_style("roboto-font", get_template_directory_uri().'/assets/fonts/roboto/stylesheet.css' , false, "1.0");
	//SuperSlides
        wp_enqueue_style("SuperSlides", get_template_directory_uri().'/assets/SuperSlides/css/superslides.css' , false, "1.0");
	//mCustomScrollbar
        wp_enqueue_style("mCustomScrollbar", get_template_directory_uri().'/assets/mCustomScrollbar/css/jquery.mCustomScrollbar.css' , false, "1.0");
    //responsiveSlides
        wp_enqueue_style("responsiveSlides", get_template_directory_uri().'/assets/css/responsiveslides.css' , false, "1.0");
    //owlSlider    
		wp_enqueue_style("owlSlider", get_template_directory_uri().'/assets/css/owl.carousel.css' , false, "1.0");
	//Global
        wp_enqueue_style("global", get_template_directory_uri().'/assets/css/global.css', false, "1.0");
	//logo custom font
        $logo_font = get_field('logo_font','option');
        if($logo_font){
            wp_enqueue_style("logo_font","http://fonts.googleapis.com/css?family=".$logo_font['family']."&subset=latin,cyrillic", false, "1.0");
        }
	//Web site fonts	
		$siteFont = get_field('website_font','options');
		if($siteFont){
			 wp_enqueue_style("website_font","http://fonts.googleapis.com/css?family=".$siteFont['family']."&subset=latin,cyrillic", false, "1.0");
		}
    }
/*External Css*/

/*External Admin css*/
  add_action( 'admin_enqueue_scripts', 'load_custom_admin_css' );
    function load_custom_admin_css()
    {
		//iCONS
			 wp_enqueue_style("font-awesome", get_template_directory_uri().'/assets/fonts/FontAwesome/css/font-awesome.min.css' , false, "1.0");	 
		//admin Styles
			wp_enqueue_style("um_adminStyle", get_template_directory_uri()."/assets/css/adminStyle.css" , false, "1.0");
    }
/*External Admin css*/



/*Umbrella light Box*/

add_action('wp_ajax_um_light_box', 'um_lightBox');
add_action('wp_ajax_nopriv_um_light_box', 'um_lightBox');

function um_lightBox(){ ?>
<div class="um_lightbox"> 
	<?php 	
	
	$post_id = $_POST["post_id"];
	
	$type = get_field('slider_type', $post_id); 
	$className = "";
	
	if($type == 'bg'){ 	
		$className = 'hasBackground';
		$bgImage = get_field('background_image',$post_id); 
		if($bgImage){ 
			$bgImage = wp_get_attachment_image_src($bgImage,'full'); 
			$bgImage = $bgImage[0];	
		}
	}
	elseif($type == 'pattern'){
			$bgImage = get_field('background_image',$post_id); 
			$className = 'hasPattern';
			if($bgImage){ 
				$bgImage = wp_get_attachment_image_src($bgImage,'full'); 
				$bgImage = $bgImage[0];	
				?> 
					<style>
						.hasPattern{
							background: url(<?php  echo $bgImage; ?>);
						}
					</style>
				<?php
			}
	}	
		$slider = get_field('gallery', $post_id); 
		 if($slider): ?>
		 
			<div class="titleAndbuttons">
				<a href="<?php echo get_permalink($post_id); ?>" class="um_lightboxBtn um_ajaxLink col-md-2 um_expand"><i class="fa fa-plus"></i><?php _e('Expand','um_lang'); ?></a>
				<div class="titleAndCategory col-md-8">
					<h3 class="title"><?php echo get_the_title($post_id); ?></h3>
					<?php 
								$terms = get_the_terms( $post_id, 'gallery_category' );
								$post_terms = '';
								if($terms){
									foreach ($terms as $term){
										$post_terms .= $term->name.', ';
									}
									$post_terms = substr($post_terms, 0, -2);
								}
							?>
					<h4 class="category"><?php echo $post_terms; ?></h4>
				</div>
				<a href="#" class="um_lightboxBtn col-md-2 um_close"><?php _e('Close','um_lang'); ?><i class="rotateClose fa fa-plus"></i></a>
			</div>
				<div class="imageContent <?php echo $className; ?>">
					<ul class="rslides">
						<?php foreach($slider as $slide): ?>
							<li><span class="um_helper"></span><img src="<?php echo $slide['url']; ?>" alt="<?php echo $slide['alt']; ?>"></li>
						<?php endforeach; ?>
					</ul>
				   
					<?php if($type == "bg"): ?>
							<img src="<?php  echo $bgImage; ?>">
					<?php endif; ?>
				</div>
			</div>
<?php
		endif;
die();
}
/*Umbrella light Box*/

 ?>