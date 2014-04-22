var blogClickedCat = '*';

function blogCheckFilter(){
	
	if(blogClickedCat == "*"){
		blogShowAllGallery();
	}
	else{
		
		$('.filter li').each(function(){
		
			if($(this).find('a').attr('data-filter') == blogClickedCat){
					$(this).find('a').trigger('click');
				}
		});
	}
}


function blogShowAllGallery(){
	
	$('.articleWrapper').each(function(){
	
		$(this).removeClass('um_unActive');
	});
}

function blogFilter(){
	
	$('.filter li').on('click',function(e){
		
		e.preventDefault();
	
		blogShowAllGallery();
	
		
		blogClickedCat = $(this).find('a').attr('data-filter');
		$('.filter li a').removeClass('filterActive');
		$(this).find('a').addClass('filterActive');
		
		if(blogClickedCat == '*'){
			blogShowAllGallery();
		}
		else{
			$('.articleWrapper').each(function(){
				
				var liCategories = $(this).find('article').attr('cat');
				if(liCategories)
				{
					liCategories = liCategories.split(' ');
				
					var exist = false;
					$.each(liCategories,function(index,item){
							if(item == blogClickedCat){
									exist = true;
								return -1;
							}
					});
					if(!exist){
						$(this).addClass('um_unActive');
					}
				}
			});
		}
	});
}