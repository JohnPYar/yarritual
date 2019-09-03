<?php
           $wayPath = 'catalog/view/theme/univer/template/';
?>
<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($this->config->get('gen_responsive') == '1') { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php } ?>
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/univer/stylesheet/stylesheet.css" />
<link href='http://fonts.googleapis.com/css?family=Calibri:400,300,600&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<!--Color scheme 
*******************************************-->
<?php if ($this->config->get('colorsite') !='') { ?>
     <link rel="stylesheet" type="text/css" href="catalog/view/theme/univer/stylesheet/style<?php echo $this->config->get('colorsite'); ?>.css" />
<?php } else { ?>
     <link rel="stylesheet" type="text/css" href="catalog/view/theme/univer/stylesheet/style1.css" /> 
<?php } ?>
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<!-- JV_Quick_Order -->
<script type="text/javascript" src="catalog/view/javascript/jv_quickorder/jquery.validate.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jv_quickorder/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jv_quickorder/jv_quickorder.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jv_bootstrap/bootstrap.min.js"></script>
<!-- JV_Quick_Order -->

<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
<script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common2.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 7]> 
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<!--JS 
*******************************************-->
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/js/owl.carousel.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/js/main.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common2.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/js/responsive/enquire.min.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/js/newselect.js"></script>

<script language="javascript" src="fastorder/fast_order.js" type="text/javascript"></script>

<!--Top Control 
*******************************************-->
<?php if ($this->config->get('topcontrol') == '1') { ?>
<script src="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/js/scroll/scrolltopcontrol.js" type="text/javascript"></script>
<?php } ?>

<!--Fixed menu 
*******************************************-->
<?php if ($this->config->get('fixmenu') == '1') { ?>
<script src="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/js/fixmenu.js" type="text/javascript"></script>
<?php } ?>

<!--Responsive
*******************************************-->
 <?php if ($this->config->get('gen_responsive') == '1') { ?>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/js/responsive/menu_script.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/univer/stylesheet/responsive.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/stylesheet/topmenu.css" />
<?php } ?>
<!--***************************************-->


<!--CSS 
*******************************************-->
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/stylesheet/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/stylesheet/owl.theme.css" />

<!--***************************************-->
<!-- Theme Fonts
**************************************-->
<?php if ($this->config->get('fonts_status') == '1') { 
		include $wayPath . "common/m_fonts.php";
	} ?>
<!--***************************************-->
<!-- Theme Custom colors
**************************************-->
<?php if ($this->config->get('color_status') == '1') { 
		include $wayPath . "common/m_colors.php";
	} ?>

<!-- Parallax box
**************************************-->
<?php if ($this->config->get('comptext_status') == '1')  { ?>

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
	
	<?php if(($this->config->get('parall_fonts') != '') ||
         ($this->config->get('parall_fonts_size')!='none') ||
		 ($this->config->get('parall_fonts_weight')) ||
		 ($this->config->get('parall_fonts_transf')) ||
		 ($this->config->get('parall_fonts_color')!= ''))  
  {?>
  	
    .custom_box_parallax .bigtext { 
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
    <?php } ?>
	}	
	
<?php } ?>
	</style>
    
<?php } ?>
<!--***************************************-->
    
<?php echo $google_analytics; ?>
</head>
<body>
<?php
           $this->language->load('common/footer');
           $text_information = $this->language->get('text_information');
           $text_manufacturer = $this->language->get('text_manufacturer');
           $text_special = $this->language->get('text_special');
           $text_contact = $this->language->get('text_contact');

           $this->language->load('module/univertheme');
           $text_welcome = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
           $text_menu = $this->language->get('text_menu');
            $text_comparetop = $this->language->get('text_comparetop');

           $this->language->load('information/univernews');
           $link_news =  $this->url->link('information/univernews', '', 'SSL');
           $text_news = $this->language->get('heading_title');
           
           ?> 
           
<!--Move panels--> 
<div class="movepanel">
  <?php include $wayPath ."/common/m_widget.php"; ?>  
  </div>
<!--end move panels-->

<div id="container">
   <div id="all_header">
   <div id="header">
     <div class="header_topbox">
     <div class="containermenu">
     <!--Top menu box-->
 
     <?php echo $currency; ?>
     <?php echo $language; ?>
  

  <div class="navButton menuResp links">
  <!--Link Home-->
  <?php if ($this->config->get('top_m_home') == '1') { ?>
 <div> <a href="<?php echo $home; ?>"><?php echo $text_home; ?></a></div>
  <?php }?>
  
  <!--Login or Registere-->
  <?php if ($this->config->get('top_m_welcome') == '1') { ?>
   <div id="welcome"> <?php if (!$logged) { ?><?php echo $text_welcome; ?><?php } else { ?><?php echo $text_logged; ?><?php } ?></div>
  <?php }?>
  
   <!--Link Wishlist-->
  <?php if ($this->config->get('top_m_wish') == '1') { ?>
 <div> <a href="<?php echo $wishlist; ?>" id="wishlist-total"><?php echo $text_wishlist; ?></a></div>
  <?php }?>
  
   <!--Link Compare-->
  <?php if (($this->config->get('top_m_compare') == '1') && (isset($compare))) { ?>
 <div> <a href="<?php echo $compare; ?>"><?php echo $text_comparetop; ?></a></div>
  <?php }?>
  
   <!--Link Account-->
  <?php if ($this->config->get('top_m_account') == '1') { ?>
 <div> <a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></div>
  <?php }?>
  
   <!--Link Cart-->
  <?php if ($this->config->get('top_m_cart') == '1') { ?>
 <div> <a href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a></div>
  <?php }?>
  
   <!--Link Checkout-->
  <?php if ($this->config->get('top_m_checkout') == '1') { ?>
 <div> <a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></div>
  <?php }?>
  
   <!--Link Brand-->
   <?php if (($this->config->get('top_m_brand') == '1') && (isset($brands))) { ?>
    <div><a href="<?php echo $href_manufacturer; ?>"><?php echo $text_manufacturer; ?></a></div>
   <?php }?>
   
    <!--Link Specials-->
   <?php if (($this->config->get('top_m_spec') == '1') && (isset($special))) { ?>
       <div><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></div>
   <?php } ?>
   
    <!--Link News-->
   <?php if (($this->config->get('top_news') == '1')&& (isset($link_news))) { ?>
 <div> <a href="<?php echo $link_news; ?>"><?php echo $text_news; ?></a></div>
  <?php }?>
   
    <!--Custom Link-->
    <?php 
			include $wayPath ."/common/m_header_customlink.php";
	 ?>
  </div>
  <!--end Top menu box-->
  </div>
  </div>
  
  <div class="header_middle containermenu">
  <!--Logo-->
   <?php if ($logo) { ?>
  <div id="logo">
  <?php if (isset($this->request->get['route']) && $this->request->get['route'] != 'common/home') { ?> 
  <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" ></a>
    <?php } else { ?>
   <a> <img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" > </a>
    <?php } ?>
  </div>
  <?php } ?>
  <!--end Logo-->

  
     <!--Cart-->
    <?php echo $cart; ?>
  <!--end Cart-->
  

  <?php if ((isset($this->document->cusom_header)) &&($this->config->get('h_contact_status') == '1')) { ?> 
   <!--Contact info-->
  <div class="header_contact matban_box beforetext">
   <?php
      $cusom_header = $this->document->cusom_header;
       foreach ($cusom_header as $item) { ?>
        <div class="stylebanner count-<?php echo count($cusom_header); ?>">
            <?php if ($item['href']) { ?><a href="<?php echo $item['href']; ?>" ><?php } ?>
           <?php if ($item['image']) { ?> <div class="one">
           <img src="<?php echo $item['image']; ?>" title="<?php echo strip_tags(html_entity_decode($item['title'], ENT_QUOTES, 'UTF-8')); ?>" alt="<?php echo strip_tags(html_entity_decode($item['title'], ENT_QUOTES, 'UTF-8')); ?>" /></div><?php } ?>
           <div class="two"><?php echo htmlspecialchars_decode( $item['title'], ENT_QUOTES ); ?></div>
           <?php if ($item['href']) { ?></a><?php } ?>
           </div>
      <?php }?>
    </div>
     
  <!--end Contact info--> 
 <?php }?>
 
  </div>
<div class="cont_bottom"></div>  
</div>


<!--Menu-->
<div class="ma-nav-mobile-container hidden-desktop default <?php if ($this->config->get('menu_width') !== '1') { ?>containermenu <?php }?>
<?php if ($this->config->get('gen_topmenu') == '1') { ?>displaymenu<?php }?>">

                            <div class="navbar containermenu ">

 
  <div id="search" class="<?php if ($this->config->get('check_view')) { ?>open-search<?php } else {?>sb-search<?php }?>">
  
                             <?php if ($filter_name) { ?>
                            <input class="sb-search-input" placeholder="<?php echo $text_search; ?>"  type="text" name="filter_name" value="<?php echo $filter_name; ?>" />
                             <?php } else { ?>
                             <input class="sb-search-input" placeholder="<?php echo $text_search; ?>"  type="text" name="filter_name" value="<?php echo $text_search; ?>" onclick="this.value = '';" onkeydown="this.style.color = '#000000';" />
						      <?php }?>
							<input class="sb-search-submit button-search" type="submit" value="">
							<a class="sb-icon-search"></a>
						
					</div>

  <!--end search-->
                               
                            
                            
                                <div id="navbar-inner" class="navbar-inner navbar-inactive">
                                 
                                     <a class="btn btn-navbar"><div><?php echo $text_menu; ?></div>
                                        <span class="icon-bar">  </span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        
                                    </a>

  <div id="menu" class="menu">
  <ul  id="ma-mobilemenu" class="mobilemenu nav-collapse collapse">
   
  <?php if ($this->config->get('gen_m_home') == '1') { ?>
  <!--Link home--> 
  <li>
   <?php if (isset($this->request->get['route']) && $this->request->get['route'] != 'common/home') { ?> 
   <a href="<?php echo $home; ?>"><span><?php echo $this->language->get('text_home'); ?></span></a>
   <?php } else { ?> 
   <a><span><?php echo $this->language->get('text_home'); ?></span></a>
   <?php }?>
   </li>
   <!--end Link home-->
    <?php }?>
    
         <?php if ($this->config->get('gen_topmenu') == '2') {
             include $wayPath ."/common/menudefault.php";  
             
             } elseif ($this->config->get('gen_topmenu') == '3') {
             include $wayPath ."/common/menudefault2.php"; } 
             
          else {
          
           include $wayPath ."/common/menutheme.php";}
		    ?>  
                      
           
          <?php if ($this->config->get('gen_m_account') == '1') { ?>
         <!--Link Account-->
          <li>
	     <a href="<?php echo $account; ?>"><?php echo $this->language->get('text_account'); ?></a>
          <?php if (isset($entry_email)) { ?>
	     <div class="topmenu" id="topmenuaccount">
		   <ul>
            
            <?php if (!$logged) { ?>
            <?php } else { ?>
            <li><?php echo $text_logged; ?></li>
            <?php } ?>
           
   
          <?php if (!$this->customer->isLogged()) { ?>
          <li id="enterkabinet">
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
          <div><input type="text" name="email" value="<?php echo $entry_email; ?>" onclick="this.value = '';" onkeydown="this.style.color = '#000000';" /> </div>
          <div><input type="password" name="password" value="<?php echo $entry_password; ?>" onclick="this.value = '';" onkeydown="this.style.color = '#000000';" /></div>
          <div><input type="submit" value="<?php echo $button_login; ?>" class="button login" /></div>
          <div><a href="<?php echo $forgotten; ?>" ><?php echo $text_forgotten; ?></a><br>
          <a href="<?php echo $register; ?>" class="button registr"><?php echo $text_register; ?></a></div>
          </form> </li>   
         
          <?php } ?>
		  </ul>
	      </div>
          <?php } ?>
      </li>
          
          <!--end Link Account--> 
           <?php }?>
        
        
          
          <?php if (($this->config->get('gen_m_info') == '1') && (isset($this->document->Information_menu))) { ?>
          <!--Link information-->  
          <li class="parent linkinfo"><a><?php echo $this->language->get('text_information'); ?></a>
	     <div class="topmenu default">
	    	<ul>
		      <?php foreach ($this->document->Information_menu as $information) { ?>
		      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
		      <?php } ?>
		   </ul>
	     </div>
         </li> 
         <!--end Link information-->
         <?php } ?>
        
         
          
          <?php if (($this->config->get('gen_m_brand') == '1') && (isset($brands))) { ?>
          <!--Link Brand-->  
          <li><a href="<?php echo $href_manufacturer; ?>"><?php echo $text_manufacturer; ?></a>
          
          <?php $k = ceil(count($brands)/3); ?>
           <div class="topmenu br_<?php echo $k; ?>" id="topbrand">
           
              <?php foreach ($brands as $brand) { ?>
                <ul>
                <li><span><?php echo $brand['name']; ?></span>
                <?php if ($brand['manufacturer']) { ?>

                <?php foreach ($brand['manufacturer'] as $letter) { ?>
                <a href="<?php echo $letter['href']; ?>"><?php echo $letter['name']; ?></a>
                <?php } ?>

                <?php } ?>
               </li>
                </ul>

              <?php } ?>
      
    </div>
           </li>
          <!--end Link Brand-->
           <?php }?>
         
         
           
          <?php if (($this->config->get('gen_m_spec') == '1') && (isset($special))) { ?>
           <!--Link Special--> 
          <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
          <!--end Special-->
          <?php } ?>
        
         
        
         <?php if (($this->config->get('gen_news') == '1')&& (isset($link_news))) { ?>
         <!--Link News-->
         <li> <a href="<?php echo $link_news; ?>"><?php echo $text_news; ?></a></li>
         <!--end Link News-->
         <?php }?>
         
          <?php if ($this->config->get('gen_topcontact') == '1') { ?>
          <!--Link Contact--> 
          <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a>
	      <div class="topmenu" id="topcontact">

                  <div class="address_h"><?php echo $address; ?></div>
                  <?php if ($telephone) { ?><div class="phone_h"> <?php echo $telephone; ?></div><?php } ?>
                  <?php if ($fax) { ?><div class="fax_h"> <?php echo $fax; ?></div><?php } ?>
                  <?php if ($email) { ?><div class="email_h"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div><?php } ?>

          </div>
          </li>
           <!--end Link Contact-->   
          <?php }?>
          
        <?php 
			include $wayPath ."/common/m_customlink.php";
	 ?>  
        
         <?php 
			include $wayPath ."/common/m_htmlmenu.php";
		   ?>
 </ul>
</div>

</div>
</div>
</div>

<!--end menu-->



</div>
<div class="main topmain">
<div class="container">

<div id="notification"></div>
