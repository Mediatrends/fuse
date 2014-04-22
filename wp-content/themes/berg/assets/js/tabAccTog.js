jQuery(document).ready(function(){

  $("body").on("click",".toggle li a",function(e){
        e.preventDefault();
        var section_content = $(this).siblings(".section_content");
        if($(this).hasClass("active")){
            $(this).removeClass("active").find('i').addClass('fa-plus').removeClass('fa-minus');
        }else{
            $(this).addClass("active").find('i').removeClass('fa-plus').addClass('fa-minus');
        }
        section_content.stop(true,true).slideToggle({
            easing : "easeInOutSine",
            duration : 200
        });
    });

});
function loadTabsShortcode(){
    /*Tabs*/
    jQuery('.tabs').each(function(){
        jQuery(this).find('.tab_buttons li a').eq(0).addClass('active');
    });

    jQuery('.tabs .tab_buttons li a').click(function(e){
        e.preventDefault();
        var index = jQuery(this).parent().index();
        jQuery(this).closest('.tabs').find('.tab_buttons li a').removeClass('active');
        jQuery(this).addClass('active');
        jQuery(this).closest('.tabs').find('.tab_content').children().hide();
        jQuery(this).closest('.tabs').find('.tab_content li').eq(index).fadeIn();
    });
}

function loadAccordionsShortcode(){

    jQuery('ul.accordion').each(function(){
        jQuery(this).find('li').eq(0).children('a').addClass('active');
        jQuery(this).find('li').eq(0).find(".section_content").addClass('active').slideDown({
            easing : "easeInSine"
        });
    });

    jQuery('ul.accordion li:first-child > a > i').removeClass('fa-plus').addClass('fa-minus');

    jQuery("body").on("click","ul.accordion li a",function(e){
        e.preventDefault();
        var parent = jQuery(this).closest("ul.accordion");
        var this_element = jQuery(this);
        parent.find("a.active").removeClass("active").find('i').addClass('fa-plus').removeClass('fa-minus').parent().siblings(".section_content").stop(true,true).slideUp({
            duration : 200 ,
            easing:"easeOutSine",
            complete : function(){ this_element.addClass("active").find('i').removeClass('fa-plus').addClass('fa-minus').parent().siblings(".section_content").stop(true,true).slideDown({
                    easing : "easeInSine"
                });
            }
        });
    });
}
