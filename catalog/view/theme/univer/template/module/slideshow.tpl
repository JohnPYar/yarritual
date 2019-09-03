<?php if ($this->config->get('slider_status')) { ?>

<div class="slideshow">
  <div id="slideshow<?php echo $module; ?>" class="owl-carousel mattSlider">
    <?php foreach ($banners as $banner) { ?>
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>
    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" />
    <?php } ?>
    <?php } ?>
  </div>
</div>
<script type="text/javascript">	
                $(document).ready(function(){
				 $("#slideshow<?php echo $module; ?>").owlCarousel({
				<?php if ($this->config->get('slider_directionNav') != '1') { ?>
			     navigation:true,
			     <?php } ?>
			     <?php if ($this->config->get('slider_controlNav') != '1') { ?>
			     pagination: true,
			     <?php } else { ?>	
				  pagination: false,
				 <?php } ?>	 

				 singleItem : true,
				 	 <?php if ($this->config->get('slider_pauseTime') != '') { ?>
			     autoPlay: <?php echo $this->config->get('slider_pauseTime'); ?>,
			         <?php } else {?>
				 autoPlay: 8000,	 
					 <?php } ?>
				<?php if ($this->config->get('slider_animSpeed') != '') { ?>
			      slideSpeed: <?php echo $this->config->get('slider_animSpeed'); ?>,
			    <?php } ?>
				 items 	 : 1 
			    });
	
                 });                                                                      
               </script>



<?php } else { ?>

 <?php  
    $this->document->addScript('catalog/view/theme/' . $this->config->get('config_template') . '/js/jquery.nivo.slider.pack.js');
    $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/nivo-slider.css');
 ?>



<div class="slideshow slider-wrapper">
  <div id="slideshow<?php echo $module; ?>" class="nivoSlider mattSlider">
    <?php foreach ($banners as $banner) { ?>
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>
    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" />
    <?php } ?>
    <?php } ?>
  </div>
</div>

<script type="text/javascript"><!--
 $(document).ready(function(){
	$('#slideshow<?php echo $module; ?>').animate({opacity:1}, 50, function(){
		$(this).nivoSlider({
			<?php if (($this->config->get('slider_effect') != 'SELECT') && ($this->config->get('slider_effect') != '')) { ?>
			effect: '<?php echo $this->config->get('slider_effect'); ?>',
			<?php } ?>
			<?php if ($this->config->get('slider_animSpeed') != '') { ?>
			animSpeed: <?php echo $this->config->get('slider_animSpeed'); ?>,
			<?php } ?>
			<?php if ($this->config->get('slider_pauseTime') != '') { ?>
			pauseTime: <?php echo $this->config->get('slider_pauseTime'); ?>,
			<?php } ?>
			<?php if ($this->config->get('slider_directionNav') == '1') { ?>
			directionNav:false,
			<?php } ?>
			<?php if ($this->config->get('slider_controlNav') == '1') { ?>
			controlNav: false,
			<?php } ?>
			<?php if ($this->config->get('slider_pauseOnHover') == '1') { ?>
			pauseOnHover: false,
			<?php } ?>
			randomStart: false,
			});	
	});
	
	});
--></script> 
<?php } ?>
