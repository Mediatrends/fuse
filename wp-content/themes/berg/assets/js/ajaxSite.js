
var history_count = 0;

var historyLinks = new Array();
historyLinks.push(document.URL);
currentLink = 0;

 

jQuery(document).ready(function($){

		removeShadow();

    //ajax on click menu and buttons
    
	$("body").on("click","nav a, .um_ajaxLink, .um_ajaxLink a",function(e){

        if(ajaxDisabled){
            return true;
        }
		jQuery('.um_shadow').addClass('active');
        $('.content').fadeOut('slow');
		
        e.preventDefault();
		
		//History Add link
		currentLink++;
		historyLinks[currentLink] = jQuery(this).attr("href");
		
		
        var url = jQuery(this).attr("href");
        var this_item = $(this);

        $.post(url, { um_ajax_load_site: true }, function (data) {
     
        		 $('.um_menuContainer').removeClass('open');
	             $(".current_page_item").removeClass("current_page_item");
	            this_item.addClass("current_page_item");

                changeURL(url);

            $("div.main_container").html(data);
			
			setDefaults();
			
			removeShadow();

            history_count = 1;
			

        }).error(function () {
                window.location = url;
        });
    });
	
	/*Ajax For Back Button*/
    window.onpopstate = function (event) {
	
        if (history_count) {
		
		 if(jQuery(this).attr("target")){
                return true;
            }
		
			//History go to link
			if(currentLink > 0){
				currentLink--;
			}
			if (historyLinks.length > 0){
				var url = historyLinks[currentLink];	
			}
			else{
				 window.history.go(-1);
			}
			
            var this_item = $(this);
			 
			 jQuery('.um_shadow').addClass('active');
			  $('.content').fadeOut('slow');
            $.post(url, { um_ajax_load_site: true }, function (data) {
              
			   

	              $(".current_page_item").removeClass("current_page_item");
	            this_item.addClass("current_page_item");

                changeURL(url);
           

            $("div.main_container").html(data);
			
			setDefaults();
		
			removeShadow();
            history_count = 1;
	
            }).error(function () {
                    window.location = url;
            });
        }
    };

     //IF - IE hash is included than redirect to
    if(window.location.hash != ''){
        var hash = window.location.hash;
        hash = hash.replace('#!', " ")
        window.location = hash;
    }
	
	
	
	
	
	/*Umbrella Light Box*/
	$('body').on('click','.liteBoxLink',function(e){
		e.preventDefault();
		
		jQuery('.um_shadow').addClass('active');
		
		var postId = $(this).attr('dataId');
		var ajaxData = {
			 "action" : "um_light_box",
             "post_id" : postId
		}; 
		
		$.post(ajax_url,  ajaxData , function (data) {

     
				$('.main_container').append(data).promise().then(function (){
					singleGallery();
					removeShadow();	
				});
	
				

        }).error(function () {
			$(this).parent().find('.singlePageLink').trigger('click');				
        });	
	});
	/*Umbrella Light Box*/
	
	$('body').on('click','.um_close',function(e){
		e.preventDefault();
		$('.um_lightbox').remove();
	});

});

function changeURL(path){
    window.scrollTo(0, 0);

    if (typeof(window.history.pushState) == 'function') {
        window.history.pushState(null, path, path);
    }else{
        window.location.hash = '#!' + path;
    }
}

function setDefaults(){
	if(typeof(galleryClickedCat) != "undefined"){
		galleryClickedCat = "*";
	}
	if(typeof(blogClickedCat) != "undefined"){
		blogClickedCat = "*";
	}
}

function removeShadow(){
    jQuery('.um_shadow').removeClass('active');
}



