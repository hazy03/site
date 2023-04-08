/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function($){
	// Site title and description.
	wp.customize('blogname', function(value){
		value.bind(function(to){
			$('.site-title a').text(to);
		});
	});
	wp.customize('blogdescription', function(value){
		value.bind(function(to){
			$('.site-description').text(to);
		});
	});

	// Header text color.
	wp.customize('header_textcolor', function(value){
		value.bind(function(to){
			if ('blank' === to) {
				$('.site-title, .site-description').css({
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			}else{
				$('.site-title, .site-description').css({
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				});
			}
		});
	});

	//Header Sections
	wp.customize('top_header_option', function(value){
		value.bind(function(to) {
			if(to === true) {
				$('.top-header-wrapper').fadeOut();
			}else{
				$('.top-header-wrapper').fadeIn();
			}
		});
	});

	wp.customize('top_header_email', function(value){
		value.bind(function(to){
			$('.top-header-wrapper .mt-mail a').html('<i class="fa fa-envelope"></i>'+ to);
		});
	});

	wp.customize('top_header_phone', function(value){
		value.bind(function(to){
			$('.top-header-wrapper .mt-phone a').html('<i class="fa fa-phone"></i>'+ to);
		});
	});
    
    // Service Section
    wp.customize('service_section_control', function(value){
		value.bind(function(to){
			if(to === 'disable') {
				$('#section-services').fadeOut();
			} else {
				$('#section-services').fadeIn();
			}
		});
	});

	wp.customize('service_section_title', function(value){
		value.bind(function(to){
			$('#service-section-title').text(to);
		});
	});
})(jQuery);
