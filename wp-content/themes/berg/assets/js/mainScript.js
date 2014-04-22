//jQuery easy declaration
var $ = jQuery;

function client() {
	um_in_effect('article',150,150);
	jQuery('.clientHover').mCustomScrollbar();	
}

function service() {

	um_in_effect('article',150,150);	
	jQuery("#owl-example").owlCarousel({
		items: 4, 
		navigation: true, 
		navigationText: ["<i class='fa fa-angle-left fa-4x'></i>", "<i class='fa fa-angle-right fa-4x'></i>"]
	});

	jQuery('.service').mCustomScrollbar();
}

function singleGallery() {

	jQuery(".rslides").responsiveSlides({
  		auto: false, 
  		nav: true, 
  		prevText: "<i class='fa fa-angle-left fa-4x'></i>",
  		nextText: "<i class='fa fa-angle-right fa-4x'></i>"
	});
	

	var socialOpen = false;
	

	jQuery(".shareIt").on('click',function(){

		

		if(!socialOpen) {
			socialButtonEffect('.um_socialButton',50,50);
			socialOpen = true;
		}
		else {
			socialRemoveEffect('.um_socialButton' ,5,5);
			socialOpen = false;
		}
		
		jQuery(this).toggleClass('um_active');
		jQuery('.shareButtons').toggleClass('um_active');

	});
}

function showcase(){

	um_in_effect('article',150,150);
	
}

function aboutUs(){
	
		$(".wrapper").mCustomScrollbar();
		$('#slides').superslides({
			inherit_width_from: '.sliderContent',
			inherit_height_from: '.sliderContent',
			pagination: false
		});

		$('#slides').on('animating.slides', function() {
			var current = $(this).superslides('current');
			$('.aboutPage .textContent').children('li').eq(current).removeClass().addClass('um_none');
		});
	
		$('#slides').on('animated.slides', function() {
		var current = $(this).superslides('current');

		var currentLi = $('.aboutPage .textContent').children('li').eq(current);
		        currentLi.removeClass().addClass('um_show fadeIn animated');	
	 			currentLi.find('.wrapper').mCustomScrollbar("update");
	 			currentLi.find('.wrapper').mCustomScrollbar("scrollTo","top");
		});
		
		um_in_effect('.fact',150,150);
}

function um_in_effect(className,startTime,nextTime){

	
	if($(className).length > 0)
		{
			var timer = startTime;
				$(className).each(function(){
					var article = $(this);
					setTimeout(function(){
						article.addClass('animated');
					},timer);
					timer = timer + nextTime;
				});	
		}		
}


function socialButtonEffect(className,startTime,nextTime){

	if($(className).length > 0)
		{
			var timer = startTime;
				$(className).each(function(){
					var article = $(this);
					setTimeout(function(){
						article.removeClass('um_out');
						article.addClass('um_in');
					},timer);
					timer = timer + nextTime;
				});	
		}
		
}

function socialRemoveEffect(className,startTime,nextTime){


	if($(className).length > 0)
		{
			var timer = startTime;
				$($(className).get().reverse()).each(function(){
					var article = $(this);
					setTimeout(function(){
						article.removeClass('um_in');
						article.addClass('um_out');
					},timer);
					timer = timer + nextTime;
				});	
				
		}
		
}



function blogBuckets(){
	
	blogFilter();

	$(".loadMore").click(function(e){
 
		e.preventDefault();
		$(this).addClass('isLoading');

        page++;
        var ajax_data = {
            paged : page,
            um_page : true,
			count : postCount
        };
        $.post(document.URL,ajax_data,function(data){
            if(data){
			
					$(".loadMore").removeClass('isLoading');
					
					$('.blogContent').append(data);
						
					blogCheckFilter();	
					if(last_page == page ){
						$(".loadMore").fadeOut();
					}
				}
			
		
        }).error(function(){
                jQuery("a.loadMoreBtn").fadeOut();
        });
    });

}



function galleryTemplate(){
	

				
	

	
	loadMore('.da-thumbs','gallery');
	galleryFilter();
	

}

function blog(){
	loadMore('.blogContent .inner-content','blog')
}

//Load more for blog, projects
function loadMore(container, type){

	var container = container;
	
	 $(".loadMore").click(function(e){
        e.preventDefault();

				$(this).addClass('isLoading');

        page++;
        var ajax_data = {
            paged : page,
            um_page : true
        };
        $.post(document.URL,ajax_data,function(data){
            if(data){
					$(".loadMore").removeClass('isLoading');
					
				if(type == 'gallery'){
					if($('.galleryBucket').length == 0)
					{		
						$(container).find('li').last().before(data);
						//hoverDir Here
					}
					else{
						$(container).append(data);
					}
					galleryCheckFilter();
				}else{
						$(container).find('article').last().before(data);
				}
					if(last_page == page ){
						$(".loadMore").hide();
					}
            }
			
		
        }).error(function(){
                jQuery("a.loadMoreBtn").hide();
        });
    });

}

function homeMinimal(effect,autoPlay){

	//superSlides
		
    var $slides = $('#slides');
  
    if(autoPlay){
		$slides.superslides({play: 10000, pagination: false,  animation : effect , animation_speed : 'slow', inherit_height_from: '.minimalSlider' });
    }
    else{

    	$slides.superslides({pagination: false , animation : effect, animation_speed : 'slow', inherit_height_from: '.minimalSlider' });
    }
	
	
 /*Bind To Trigger to add and remove effect of content*/
    jQuery('#slides').on('animated.slides',function(){
	
        jQuery('.animated').removeClass('animated');
        jQuery('.slides-container li').each(function(){
            if(jQuery(this).css('display') == "block"){
					jQuery(this).find('.sliderContent').addClass('animated');
					jQuery(this).find('.slider_button').addClass('animated');
					
			}
        });	
    });
   
   	var first = true;
    //The first effect for the fade slides
    if(effect == "fade" && first == true){
        first = false;
        jQuery('.animated').removeClass('animated');
        
        jQuery('.slides-container li').each(function(){
            if(jQuery(this).css('display') == "block"){
                jQuery(this).find('.sliderContent').addClass('animated');
                jQuery(this).find('.slider_button').addClass('animated');
            }
        })
    }

}

jQuery(window).ready(function($){
    /*Ajax Contact Form*/
	
		   $("body").on("submit","form.contactForm",function(e){

		   
			$('.error').removeClass('error');
			
            var name = $(this).find("#full_name");
            var email = $(this).find("#email");
            var message = $(this).find("#comment");
          
            var url = $(this).attr("action");

            var return_state = true;
            var form = $(this);

            if(name.val() == ""){
                name.addClass("error");
                return_state = false;
            }
            if(email.val() == "" || !validateEmail(email.val())){
                email.addClass("error");
                return_state = false;
            }
            if(message.val() == ""){
                message.addClass("error");
                return_state = false;
            }

            
			if(return_state){
					 var data = {
						 um_name : name.val(),
						 um_email : email.val(),
						 um_message : message.val()
					}
				
					$.post(url,data,function(data){

						form.fadeOut("normal",function(){
							$('.um_message h1').html(data).parent().fadeIn("normal");
						});
					});
			}
			return false;
		});
		/*Ajax Contact Form*/
		
		  $("body").on("submit","form#commentform",function(e){
				
				$('.error').removeClass('error');
				
				var name = $(this).find("#author");
				var email = $(this).find("#email");
				var message = $(this).find("#comment");
				
				 var return_state = true;


				 if(name.val() == ""){
				 
					name.addClass("error");
					return_state = false;
				 }
			   if(email.val() == "" || !validateEmail(email.val())){
					email.addClass("error");
					return_state = false;
				}
			

				if($('.logged-in-as').length > 0){
				 	return_state = true;
				}

			   if(message.val() == ""){
					message.addClass("error");
					return_state = false;
				}
				return return_state;
			
		  });
		
		
	
});

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

jQuery(document).ready(function() {
	
	var menu = $('.um_menuContainer');
	
	menu.removeClass("open");
	
	$('.responsiveMenuBtn').click(function() {
	var open = menu.hasClass('open');
		if(!open) {
			menu.addClass("open");
			open = true;
		}
		else {
			menu.removeClass("open");
			open = false;
		}
	});


});	 