<?php if($this->config->get('parall_fonts')!='') {
		$reg2fonts = array('Arial', 'Verdana', 'Helvetica', 'Lucida Grande', 'Trebuchet MS', 'Times New Roman', 'Tahoma', 'Georgia' );
         if (in_array($this->config->get('parall_fonts'), $reg2fonts)==false && $this->config->get('parall_fonts')!='') { ?>
         <link href='//fonts.googleapis.com/css?family=<?php echo $this->config->get('parall_fonts') ?>&v1' rel='stylesheet' type='text/css'>
       <?php } } ?>

   <style type="text/css">
	<?php if($this->config->get('parallax_bg')!='' ){ ?> 
    #center_custom_box {
	background-image: url(<?php echo $this->config->get('config_url'); ?>image/<?php echo $this->config->get('parallax_bg') ?>);
	}
    <?php } ?>
	<?php if($this->config->get('parallax_bg2')!='' ){ ?> 
    .parallax_img {
	background-image: url(<?php echo $this->config->get('config_url'); ?>image/<?php echo $this->config->get('parallax_bg2') ?>);
	}
    <?php } ?>
	<?php if($this->config->get('parallax_height')!='' ){ ?> 
	 #center_custom_box, .parallax_img{
	height: <?php echo $this->config->get('parallax_height') ?>px;
	}
    <?php } ?>
	
	<?php if(($this->config->get('parall_fonts') != '') ||
         ($this->config->get('parall_fonts_size')!='none') ||
		 ($this->config->get('parall_fonts_weight')) ||
		 ($this->config->get('parall_fonts_transf')) ||
		 ($this->config->get('parall_fonts_color')!= '') ||
		 ($this->config->get('parall_p_width')!= '')  
  ){?>
  	
    #center_custom_box article > div { 
    <?php if($this->config->get('parall_fonts') != '') { 
     $fontpre =  $this->config->get('parall_fonts'); $font1 = str_replace("+", " ", $fontpre); ?>
	font-family: <?php echo $font1 ?>;
	<?php } 
	 if($this->config->get('parall_fonts_size')!='none') { ?> 
	font-size: <?php echo $this->config->get('parall_fonts_size') ?>px;
	<?php } 
	 if($this->config->get('parall_fonts_weight')) { ?>
	font-weight:bold;
	<?php } 
	 if($this->config->get('parall_fonts_transf')) { ?>
	text-transform:uppercase;
    <?php }
	if($this->config->get('parall_fonts_color') != '') { ?>
	color:<?php echo $this->config->get('parall_fonts_color') ?>;
    <?php }
	if($this->config->get('parall_p_width') != '') { ?>
	width:<?php echo $this->config->get('parall_p_width') ?>px;
    <?php } ?>
	}
<?php } ?>
	</style>