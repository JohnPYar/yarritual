 $(document).ready(function() {
 
//Top menu	
	 $('div.topmenu_theme').removeAttr('style');
	
//Addition images


	  
//Images in modules	  
	     var galleryClass = '.itemcolumns';
	     $(galleryClass).hover(function(){
         var $gallery = $(this);
	       $('.owl_modul div a',$gallery).hover(function(){
		   $('.owl_modul div',$gallery).removeClass('active');
		   $(this).parent().addClass('active');
		   $('.image img',$gallery).attr('src', $(this).attr('data-image'));});
	       $('.owl_modul div:first',$gallery).addClass('active');
		   if ( $('.owl_modul',$gallery).parents('.itemcolumns').length ) { $gallery.addClass('itemwd')};	
	    });
  
	  
	 
// Categories module 
	$(".box-category .accordeon_plus").each(function(index, element) {
	
		if($(this).parent().hasClass('cat-active') == true){
			$(this).addClass('open');
			$(this).next().addClass('active');
		}	
	});
	$(".box-category .accordeon_plus").click(function(){ 
		if($(this).next().is(':visible') == false) {
			$('.box-category .accordeon_subcat').slideUp(300, function(){
				$(this).removeClass('active');
				$('.accordeon_plus').removeClass('open');
			});
		}
		if($(this).hasClass('open') == true) {
			$(this).next().slideUp(300, function(){
				$(this).removeClass('active');
				$(this).prev().removeClass('open');
			});
		}else{
			$(this).next().slideDown(300, function(){
				$(this).addClass('active');
				$(this).prev().addClass('open');
			});
		}
	}); 
	
//Page of Categories	
	$(".accordeon_description .accordeon_plus").each(function(index, element) {
	
		if($(this).parent().hasClass('cat-active') == true){
			$(this).addClass('open');
			$(this).next().addClass('active');
		}	
	});
	$(".accordeon_description .accordeon_plus").click(function(){ 
		if($(this).next().is(':visible') == false) {
			$('.accordeon_description .view').slideUp(300, function(){
				$(this).removeClass('active');
				$('.accordeon_plus').removeClass('open');
			});
		}
		if($(this).hasClass('open') == true) {
			$(this).next().slideUp(300, function(){
				$(this).removeClass('active');
				$(this).prev().removeClass('open');
			});
		}else{
			$(this).next().slideDown(300, function(){
				$(this).addClass('active');
				$(this).prev().addClass('open');
			});
		}
	}); 
	
	
//full slidershow
if ($("div").is(".full_container")){	
   $(".main.topmain").css('padding',0);
    $(".main.topmain").css('background','transparent');
}

		   
//plus mines button in qty

		  var elm = $('#htop');
				  function spin( vl ) {
					elm.val( parseInt( elm.val(), 10 ) + vl );
				  }
				  $('#increase').click( function() { spin( 1 );  } );
				  $('#decrease').click( function() { if (elm.val () > 0 ){spin( -1 ); } });	   
		   
// success
	$("body").click(function(e) {
	if($(e.target).closest('#notification .success').length==0) $('#notification .success').remove();
     });
	 
//mobile menu
$('.btn-navbar').click(function() {
		
		var chk = 0;
		if ( $('#navbar-inner').hasClass('navbar-inactive') && ( chk==0 ) ) {
			$('#navbar-inner').removeClass('navbar-inactive');
			$('#navbar-inner').addClass('navbar-active');
			$('#ma-mobilemenu').css('display','block');
			chk = 1;
		}
		if ($('#navbar-inner').hasClass('navbar-active') && ( chk==0 ) ) {
			$('#navbar-inner').removeClass('navbar-active');
			$('#navbar-inner').addClass('navbar-inactive');			
			$('#ma-mobilemenu').css('display','none');
			chk = 1;
		}
			
	});    
	
	
//no responsive
	       enquire.register("only screen and (min-width: 1170px)", {
			  match : function() {
            $(".full_container").removeClass("fixwidth"); 

			  }
		    }).register("only screen and (max-width: 1169px)", {
			  match : function() {
           $(".full_container").addClass("fixwidth");

			  }
		    }); 	

//move panels
	
	$("#box-facebook .icon-facebook").toggle(function(){
		$("#box-facebook").animate({right:'280px'},500);}, function() {
		$("#box-facebook").animate({right:'0px'},500);
	});
	
	$("#box-twitter .icon-twitter").toggle(function(){
		$("#box-twitter").animate({right:'280px'},500);}, function() {
		$("#box-twitter").animate({right:'0px'},500);
	});
	
		$("#box-vkt .icon-vkt").toggle(function(){
		$("#box-vkt").animate({right:'280px'},500);}, function() {
		$("#box-vkt").animate({right:'0px'},500);
	});  
	
	
         $(".box-heading").wrap('<div class="box-heading-new"></div>');
		 
//wall categories		 
 var showClass = '.sub_category_child';
     $(showClass + ' .subcateg_show a').click(function () {
		var $showM = $(this).parents(showClass);
	    $('.subcateg_show_box ',$showM).slideToggle("slow");
		 $('.subcateg_show .minus ',$showM).toggle();
		 $('.subcateg_show .plus ',$showM).toggle();
    });	
		 
// menu account
   $("#topmenuaccount").click(function() {
	 $(this).css({
		 'top':'auto',
		 'opacity':1,
	 });
     });
	$("body").click(function(e) {
	if($(e.target).closest('#topmenuaccount').length==0) $('#topmenuaccount').removeAttr('style');
     });
	 
//brand topmenu
 var $c = $('#topbrand');
 while($c.children('ul:not(.wrap)').length)
 $c.children('ul:not(.wrap):lt(3)').wrapAll('<div class="column_brand">');	
 
//Language and Currency Dropdowns
$('#currency, #language').click(function() {
			$(this).find('> ul').slideDown('fast');
		});

  $(document).click( function(event){
      if( $(event.target).closest("#currency, #language").length ) 
        return;
        $('#currency ul, #language ul').removeAttr('style');
      event.stopPropagation();
    });	
 $(".sb-icon-search").click(function() {
	 $(this).css({'display':'none'});
	  $('.sb-search-submit').css({ 'display':'block'});
	   $('.sb-search-input').css({'display':'block'});
     });

	 
	  $(document).click( function(event){
      if( $(event.target).closest(".sb-search").length ) 
        return;
        $('.sb-icon-search').removeAttr('style');
		$('.sb-search-input').removeAttr('style');
		$('.sb-search-submit').removeAttr('style');
      event.stopPropagation();
    });
	 
 	 		 
	
});

