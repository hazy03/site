jQuery(document).ready(function($){

    $(".search-main i").click(function(){
   		$(".search-form-main").slideToggle('slow');
    });
   
    $('#testimonials-slider .bx-slider').bxSlider({
        adaptiveHeight: true,
        pager:false,
    });
   
    $('#site-navigation .menu-toggle').click(function(){
        $("#site-navigation .main-menu-wrapper").slideToggle('slow');
    });
   
   	$('#site-navigation .main-menu-wrapper .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');

	$('#site-navigation .main-menu-wrapper .sub-toggle').click(function() {
		$(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
		$(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
	});
    
    // Scroll To Top
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
    
});