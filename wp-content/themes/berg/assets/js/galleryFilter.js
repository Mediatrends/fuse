var galleryClickedCat = '*';

function galleryCheckFilter(){
	
	if(galleryClickedCat == "*"){
		galleryShowAllGallery();
	}
	else{
		
		$('.filter li').each(function(){
		
			if($(this).find('a').attr('data-filter') == galleryClickedCat){
					$(this).find('a').trigger('click');
				}
		});
	}
}

function galleryShowAllGallery(){
	
	$('.da-thumbs li').each(function(){
	
		$(this).removeClass('um_unActive');
	});
}

function galleryFilter(){
	
	$('.filter li').on('click',function(e){
	
	
		e.preventDefault();
		
		
		galleryShowAllGallery();
	
		
		 galleryClickedCat = $(this).find('a').attr('data-filter');
	
		$('.filter li a').removeClass('filterActive');
		$(this).find('a').addClass('filterActive');
			
		if(galleryClickedCat == '*'){
			galleryShowAllGallery();
		}
		else{
			$('.da-thumbs li').each(function(){
				
				var liCategories = $(this).find('article').attr('cat');
				if(liCategories)
				{
					liCategories = liCategories.split(' ');
				
					var exist = false;
					$.each(liCategories,function(index,item){
							if(item == galleryClickedCat){
									exist = true;
								return -1;
							}
					});
					if(!exist){
						$(this).addClass('um_unActive');
					}
				}
				else{
					if(!$(this).find('article').hasClass('loadMore')){
						$(this).addClass('um_unActive');
					}
				}
			});
		}
	});
}