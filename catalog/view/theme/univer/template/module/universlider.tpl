<?php  if(!empty($tabs)){ ?>

<?php if (($dinamic == '1') || ($dinamic == '2') || ($dinamic == '3')) { ?>
   
    <div id="matban_box<?php echo $module; ?>" class="matban_box
                  <?php if ($dinamic == '1') { ?>maska_text<?php }  
                  elseif ($dinamic == '2') { ?>beforetext<?php } 
                  elseif ($dinamic == '3') { ?>slider_banner<?php } ?>" >



 
    <?php if ($dinamic == '3') { ?> <div class="owl-addbanner owl-carousel">
    <?php } else { ?>
    <div class="box_maska">
    <?php } ?>

     
	<?php foreach ($tabs as $numTab => $tab) { ?>
    
    <div class="stylebanner  <?php if (($dinamic == '1') || ($dinamic == '2')) { ?> count-<?php echo count($tabs); ?><?php } ?>" id="univerbanner-<?php echo $numTab; ?><?php echo $module; ?>" >
    <div class="ramka_box">
    <?php if (($tab['href']) && ($dinamic != '2')) { ?><a href="<?php echo $tab['href']; ?>"> <?php } ?>
        
        
        <div class="one">
        
         <img src="<?php echo $tab['image']; ?>" 
         <?php if (isset($tab['headingtext'][$lang])){ ?>
         alt="<?php echo $tab['headingtext'][$lang]; ?>" 
         title="<?php echo $tab['headingtext'][$lang]; ?>"
         <?php } ?>>
        </div>

        
        <?php if ( (isset($tab['title'][$lang])) && $tab['title'][$lang] !='' ) { ?>
        <div class="two <?php if (isset($tab['color']) && ($tab['color'] == 'light')) { ?> light<?php } else { ?>dark<?php } ?>">
           <div class="textbanner2">
           
                <?php if  ((isset($tab['headingtext'][$lang])) && $tab['headingtext'][$lang] !=''  )  { ?>
                <div class="threeheading"> <?php echo $tab['headingtext'][$lang]; ?></div>
                <?php } ?> 
               
                 <div class="threetext"><?php echo html_entity_decode($tab['title'][$lang]); ?>
               
                <?php if  ((isset($tab['titlelink'][$lang])) && $tab['titlelink'][$lang] !='' )  { ?>
                <br />
                <div class="moreinfo">
                 <?php if (($tab['href']) && ($dinamic == '2')) { ?><a href="<?php echo $tab['href']; ?>"> <?php } ?>
                 <?php echo $tab['titlelink'][$lang]; ?>
                 <?php if (($tab['href']) && ($dinamic == '2')) { ?></a> <?php } ?>
                </div>
                
                <?php } ?>
                </div>
                 
        </div></div>
        <?php } ?>
       
        
     <?php if (($tab['href']) && ($dinamic != '2')) { ?></a> <?php } ?>
           
     </div>
     </div>
     <?php } ?>
     
   </div>
	
   
<script type="text/javascript">	
                $(document).ready(function(){
				 $("#matban_box<?php echo $module; ?>.slider_banner .owl-addbanner").owlCarousel({
                 navigation : true,
                 pagination : false,
				 singleItem : true,
				 	 <?php if ($this->config->get('slider_pauseTime') != '') { ?>
			     autoPlay: <?php echo $this->config->get('slider_pauseTime'); ?>,
			         <?php } else {?>
				 autoPlay: 8000,	 
					 <?php } ?>
				<?php if ($this->config->get('slider_animSpeed') != '') { ?>
			      slideSpeed: <?php echo $this->config->get('slider_animSpeed'); ?>,
			    <?php } ?>
			    });
	
                 });                                                                      
               </script>
</div>   

    
 <?php } else { ?>  
 
 
 <script type="text/javascript">

// Speed of the automatic slideshow
 <?php if ($this->config->get('slider_pauseTime') != '') { ?>
      var slideshowSpeed = <?php echo $this->config->get('slider_pauseTime'); ?>;
  <?php } else {?>
    var slideshowSpeed = 8000;
  <?php } ?>

var photos = [ 
 <?php foreach ($tabs as $tab) { ?>

{
		"title" : '<?php echo $tab['headingtext'][$lang]; ?>',
		"image" : '<?php echo $tab['image']; ?>',
		"cssclass" : '<?php echo $tab['color']; ?>',
		"maintext" : ' <?php echo html_entity_decode($tab['title'][$lang]); ?>',
		"url" : '<?php echo html_entity_decode($tab['href']); ?>',
		"urltext" : '<?php echo $tab['titlelink'][$lang]; ?>'
	},
	<?php } ?>
];

$(document).ready(function(){
 <?php if ($box_height != '') { ?>	
 
  <?php if ($this->config->get('gen_responsive') != '1') { ?>
      $("#fon_slider .containermenu").css('height', <?php echo $box_height; ?>);
   <?php } else { ?>

if ($(window).width() >= '990'){
$("#fon_slider .containermenu").css('height', <?php echo $box_height; ?>);
  };

	 $(window).resize(function (){	
	   if ($(window).width() >= '990'){
	  $("#fon_slider .containermenu").css('height', <?php echo $box_height; ?>);
	   } else if ($(window).width() >= '480'){
	 $("#fon_slider .containermenu").css('height', 250);
	  } else {
	$("#fon_slider .containermenu").css('height', 150);
		 
	  };
 }); 		
 
<?php }
 }?>				 

var page_h = $(window).height();
var page_w = $(window).width();
$(".image_slider").css({ 
                'min-width'  : page_w,
				'min-height'  : page_h} );
			
 $(window).resize(function (){	
 var page_h = $(window).height();
 var page_w = $(window).width();
 $(".image_slider").css({ 
                'min-width'  : page_w,
				'min-height'  : page_h} );
 });
 
 
	// Backwards navigation
	$("#back").click(function() {
		stopAnimation();
		navigate("back");
	});
	
	// Forward navigation
	$("#next").click(function() {
		stopAnimation();
		navigate("next");
	});
	
	var interval;
	$("#control").toggle(function(){
		stopAnimation();
	}, function() {
		// Change the background image to "pause"
		$(this).removeClass('play');
		
		// Show the next image
		navigate("next");
		
		// Start playing the animation
		interval = setInterval(function() {
			navigate("next");
		}, slideshowSpeed);
	});
	
	
	var activeContainer = 1;	
	var currentImg = 0;
	var animating = false;
	var navigate = function(direction) {
		// Check if no animation is running. If it is, prevent the action
		if(animating) {
			return;
		}
		
		// Check which current image we need to show
		if(direction == "next") {
			currentImg++;
			if(currentImg == photos.length + 1) {
				currentImg = 1;
			}
		} else {
			currentImg--;
			if(currentImg == 0) {
				currentImg = photos.length;
			}
		}
		
		// Check which container we need to use
		var currentContainer = activeContainer;
		if(activeContainer == 1) {
			activeContainer = 2;
		} else {
			activeContainer = 1;
		}
		
		showImage(photos[currentImg - 1], currentContainer, activeContainer);
		
	};
	
	var currentZindex = -1;
	var showImage = function(photoObject, currentContainer, activeContainer) {
		animating = true;
		
		// Make sure the new container is always on the background
		currentZindex--;
		
		// Set the background image of the new active container
		$("#headerimg" + activeContainer).css({
			"background-image" : "url(" + photoObject.image + ")",
			"display" : "block",
			"z-index" : currentZindex
		});
		
		// Hide the header text
		$(".navbox").css({"display" : "none"});
		
		// Set the new header text
		$(".sl_center").html(photoObject.maintext);
		
		$("#hreftext")
			.attr("href", photoObject.url)
			
		$("#urlmore")
			.html(photoObject.urltext);	
		$("#navbox h2")
			.html(photoObject.title);
		$("#navbox")
		    .removeClass()
			.addClass(photoObject.cssclass);
		$("#headernav-outer")
		    .removeClass()
			.addClass(photoObject.cssclass);	
		

		// Fade out the current container
		// and display the header text when animation is complete
		$("#headerimg" + currentContainer).fadeOut(function() {
			setTimeout(function() {
				$(".navbox").css({"display" : "block"});
				animating = false;
			}, 500);
		});
	};
	
	var stopAnimation = function() {
		// Change the background image to "play"
		$("#control").addClass('play');
		
		// Clear the interval
		clearInterval(interval);
	};
	
	// We should statically set the first image
	navigate("next");
	
	// Start playing the animation
	interval = setInterval(function() {
		navigate("next");
	}, slideshowSpeed);
	 

		    });   
		</script>
        
      

<div id="fon_slider">	
     <div id="headerimgs">
		<div id="headerimg1" class="image_slider"></div>
        <div id="headerimg2" class="image_slider"></div>
	</div>
    
<div class="containermenu">
	<!-- Slideshow controls -->
	<div id="headernav-outer">
		<div id="headernav">
			<div id="back" class="fon_slider_button"></div>
			<div id="control"></div>
			<div id="next" class="fon_slider_button"></div>
		</div>
	</div>
	<!-- jQuery handles for the text displayed on top of the images -->
    
	<div id="navbox">
      <a href="#" id="hreftext">
         <h2></h2>

		<div class="sl_center"></div>
       
        <div id="urlmore"></div>
        
     </a>
			
		
		
	</div>
  </div>

	</div>


 
  
    
<?php }
} ?>
