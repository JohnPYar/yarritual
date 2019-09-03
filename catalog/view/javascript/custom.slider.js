function createSlider(element, options){
	jQuery(document).ready(function(){
		var defaults = {
			prev: '.prev',
			next: '.next',
			duration: 500,
			auto: 3000
		}
		
		var config = $.extend(defaults, options);
		var scroll_deviation = 10; //px
		
		var slider = $(element);
		var slides_list = slider.find('.slide-list');
		var slides = slides_list.find('.slide-item');
		
		var visible_width = slider.width();
		var scroll_step = slider.width();
		var slide_width = slider.width();
		
		//Slider constructing
		slides_list.css("margin-left", "0px");
		slides.css("width", visible_width);
		
		//Slides positioning
		for(var i=0; i<slides.length; i++){
			$(slides[i]).css("left", i * visible_width);
		}
		
		slider.find(config.prev).click(function(){
			var sl_left_margin = parseInt(slides_list.css("margin-left"));
			var first_slide_left_pos = parseInt(slides_list.find('.slide-item:first').css("left"));
			
			if( (sl_left_margin + first_slide_left_pos) >= 0 ){
				var last_slide = slides_list.find('.slide-item:last').detach();
					last_slide.css("left", first_slide_left_pos - slide_width + "px");
					slides_list.prepend(last_slide);
			}
			
			if(!slides_list.is(':animated')) {
			  slides_list.animate({marginLeft: sl_left_margin + scroll_step}, config.duration);
			}
		});
		
		slider.find(config.next).click(function(){
			var sl_left_margin = parseInt(slides_list.css("margin-left"));
			var last_slide_left_pos = parseInt(slides_list.find('.slide-item:last').css("left"));
			
			if( (sl_left_margin + last_slide_left_pos + slide_width) <= visible_width ){
				var first_slide = slides_list.find('.slide-item:first').detach();
					first_slide.css("left", last_slide_left_pos + slide_width + "px");
					slides_list.append(first_slide);
			}
			
			if(!slides_list.is(':animated')) {
			  slides_list.animate({marginLeft: sl_left_margin - scroll_step}, config.duration);
			}			
		});
		
		//if(config.auto != 0){
			setInterval(function(){slider.find(config.next).trigger("click")}, config.auto);
		//}
	});
}

