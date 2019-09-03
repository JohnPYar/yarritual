
<style type="text/css">
<?php if(($this->config->get('color_bg')!='')||
         ($this->config->get('image_bg')!='')||
		 ($this->config->get('attachment_bg')) ||
		 ($this->config->get('main_btext')!='') ){ ?> 
body { 
	<?php if($this->config->get('color_bg')!='') { ?> 
	background-color: <?php echo $this->config->get('color_bg') ?>;
	<?php } 
	 if($this->config->get('image_bg')!='') { ?> 
	background-image: url(<?php echo $this->config->get('config_url'); ?>image/<?php echo $this->config->get('image_bg') ?>);
	background-position: <?php echo $this->config->get('position_bg') ?>; 
	background-repeat: <?php echo $this->config->get('repeat_bg') ?>;
	<?php } 
	if($this->config->get('attachment_bg')) { ?> 
	background-attachment:fixed;
	<?php } 
	if($this->config->get('main_btext')!='') { ?> 
	color: <?php echo $this->config->get('main_btext') ?>;
	<?php } ?>
	}
<?php } ?>
<?php if($this->config->get('main_smallbtext')!='') { ?> 
	  .product-info .cart .minimum,
      .product-info .price-tax,
      .product-info .price .reward,
      .product-info .price .discount,
      .product-info .description span, small 
      {color: <?php echo $this->config->get('main_smallbtext') ?>;}
<?php } ?>
<?php if ($this->config->get('page_bg_status')) { ?> 
		.main{background: transparent;}	
		.containermenu{ width:1170px;} 
		.full_container .matban_box, .full_container .dropdown_category{ max-width:1170px;}	
			 
<?php } elseif($this->config->get('page_bg')!='') { ?> 
      .main, .main2,.matban_box.beforetext .threeheading, .matban_box.beforetext .stylebanner > .ramka_box{background-color: <?php echo $this->config->get('page_bg') ?>;}
	  .containermenu{ width:1210px;}
	  .full_container .matban_box, .full_container .dropdown_category{ max-width:1210px;}
<?php } ?>

<?php if ($this->config->get('gen_responsive') == '1') { ?>
	  @media only screen and (max-width: 1170px) {
		.containermenu{ width:100%;} 
	  }
<?php } ?>

<?php if($this->config->get('main_link')!='') { ?> 
     a, a:visited, a b {color:  <?php echo $this->config->get('main_link') ?>;}
<?php } ?>
<?php if($this->config->get('main_linkhover')!='') { ?> 
     a:hover, .column_brand li span{color:  <?php echo $this->config->get('main_linkhover') ?>;}
<?php } ?>

<?php if($this->config->get('main_bread')!='') { ?> 
    .breadcrumb, .breadcrumb a{color:  <?php echo $this->config->get('main_bread') ?>;}
<?php } ?>
<?php if($this->config->get('main_bread_hover')!='') { ?> 
    .breadcrumb a:hover{color:  <?php echo $this->config->get('main_bread_hover') ?>;}
<?php } ?>


<?php if($this->config->get('captable_font')!='') { ?> 
    table.list thead td a, .list thead td, .wishlist-info thead td, .cart-info thead td,
	.checkout-product thead td, .attribute thead td, .attribute thead tr td:first-child, 
    .compare-info thead td, .compare-info thead tr td:first-child{
		color:  <?php echo $this->config->get('captable_font') ?>;}
<?php } ?>
<?php if($this->config->get('captable_bg')!='') { ?> 
    table.list thead td, .wishlist-info thead td, .cart-info thead td,
	.checkout-product thead td, .attribute thead td, .attribute thead tr td:first-child,
	.compare-info thead td, .compare-info thead tr td:first-child {
		background-color:  <?php echo $this->config->get('captable_bg') ?>;}
<?php } ?>

<?php if($this->config->get('main_pagetitle')!='') { ?> 
     h1, .welcome{color:  <?php echo $this->config->get('main_pagetitle') ?>;}
<?php } ?>
<?php if($this->config->get('main_pagetitle_h2')!='') { ?> 
     h2{color:  <?php echo $this->config->get('main_pagetitle_h2') ?>;}
<?php } ?>

<?php if (($this->config->get('main_headermod')!='')) { ?>  
     .box-heading, .box-heading a, .position_center .box-content .accordeon_categ > ul > li > a, .matban_box.beforetext .threeheading{
		 color:  <?php echo $this->config->get('main_headermod') ?>;
		 border-color: <?php echo $this->config->get('main_headermod') ?>;
		 }
		 <?php } ?>

<?php if($this->config->get('checkout_color_text')!='') { ?> 
  .checkout-heading{
		color: <?php echo $this->config->get('checkout_color_text') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('checkout_color_bg')!='') { ?> 
  .checkout-heading{
		background: <?php echo $this->config->get('checkout_color_bg') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('filter_color')!='') { ?> 
   #slider .ui-widget-header{
		background: <?php echo $this->config->get('filter_color') ?>;
		 }	
<?php } ?> 
 
		 
<?php if (($this->config->get('pagin_bg')!='') ||
          ($this->config->get('pagin_font')!='')) { ?>  
     .pagination .links a {
		<?php if($this->config->get('pagin_font')!='') { ?>  
		 color:  <?php echo $this->config->get('pagin_font') ?>;
		<?php }  
		if($this->config->get('pagin_bg')!='') { ?>  
		 background-color:  <?php echo $this->config->get('pagin_bg') ?>;
		<?php } ?> 
		 }
		 <?php } ?>	
		 
 <?php if (($this->config->get('pagin2_bg')!='') ||
          ($this->config->get('pagin2_font')!='')) { ?>  
     .pagination .links b, .pagination .links a:hover {
		<?php if($this->config->get('pagin2_font')!='') { ?>  
		 color:  <?php echo $this->config->get('pagin2_font') ?>;
		<?php }  
		if($this->config->get('pagin2_bg')!='') { ?>  
		 background-color:  <?php echo $this->config->get('pagin2_bg') ?>;
		<?php } ?> 
		 }
		 <?php } ?>		 
		 
<?php if ($this->config->get('header_bg')) { ?> 
		#all_header{
		background: transparent;
		 }	 		 
<?php } elseif(($this->config->get('color_header_bg')!='')||
         ($this->config->get('image_header_bg')!='') ){ ?> 
#all_header { 
	<?php if($this->config->get('color_header_bg')!='') { ?> 
	background-color: <?php echo $this->config->get('color_header_bg') ?>;
	<?php } 
	 if($this->config->get('image_header_bg')!='') { ?> 
	background-image: url(<?php echo $this->config->get('config_url'); ?>image/<?php echo $this->config->get('image_header_bg') ?>);
	background-position: <?php echo $this->config->get('position_header_bg') ?>; 
	background-repeat: <?php echo $this->config->get('repeat_header_bg') ?>;
	<?php } ?>
	}
<?php } ?>	

<?php if ($this->config->get('top_header_bg')) { ?> 
		#header .header_topbox{
		background: transparent;
		 }	 		 
<?php } elseif ($this->config->get('color_top_header_bg')!='') { ?> 
#header .header_topbox { 
	background-color: <?php echo $this->config->get('color_top_header_bg') ?>;
	}
<?php } ?>	

<?php if($this->config->get('top_link')!='') { ?> 
   #header .links > div a, #header .links > div, #currency a, #language span, #currency span {
		color:<?php echo $this->config->get('top_link') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('top_link_hover')!='') { ?> 
  #header .links > div:hover a, #header .links > div:hover{
		color:<?php echo $this->config->get('top_link_hover') ?>;
		 }	
<?php } ?> 	
<?php if($this->config->get('top_link_bg')!='') { ?> 
  #header .links > div:hover{
		background-color:<?php echo $this->config->get('top_link_bg') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('header_cart_link')!='') { ?> 
    #header #cart .heading a, #header #cart .heading h4 {
		color:<?php echo $this->config->get('header_cart_link') ?>;
		 }	
<?php } ?>   
<?php if($this->config->get('top_headertext')!='') { ?> 
    #header .matban_box.beforetext .two{
		color:<?php echo $this->config->get('top_headertext') ?>;
		 }
<?php } ?> 		 	
<?php if($this->config->get('menu_bg_status')) { ?> 
      .ma-nav-mobile-container.default, .navbar .btn-navbar{
		background:transparent;
		 }
	 .ma-nav-mobile-container.fixed{ background-color:#f4f4f4;}	
<?php } elseif($this->config->get('menu_bg_color')!='') { ?> 
 .ma-nav-mobile-container, .navbar .btn-navbar, .ma-nav-mobile-container.fixed{
		background-color:<?php echo $this->config->get('menu_bg_color') ?>;
		 } 	
<?php } ?> 

<?php if($this->config->get('menulink_color')!='') { ?> 
    .menu > ul > li > a,.navbar .btn-navbar div,  .menu1 .mobilemenu a {
		color:<?php echo $this->config->get('menulink_color') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('menulink_hover_color')!='') { ?> 
    .menu > ul > li:hover > a, .menu1 .mobilemenu a:hover, .menu > ul > li.categories > a:hover, .menu > ul > li a.active {
		color:<?php echo $this->config->get('menulink_hover_color') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('menulink_bg_color')!='') { ?> 
    .menu > ul > li:hover,  .menu1 .mobilemenu a:hover, .categories > a:hover, .menu > ul > li a.active {
		background-color:<?php echo $this->config->get('menulink_bg_color') ?>;
		 }	 	
<?php } ?> 
<?php if($this->config->get('menu2_bg_color')!='') { ?> 
 .menu > ul > li > div,
 .menu .topmenu ul li .level3,
 .menu > ul > li > div.topmenu_theme > ul > li > div.topmenu{
		background-color:<?php echo $this->config->get('menu2_bg_color') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('menulink2_color')!='') { ?> 
   .menu > ul > li > div > ul > li > a,
   .menu .topmenu ul li .level3 a,
   .menu > ul > li > div.topmenu_theme > ul > li > div.topmenu a,
   .displaymenu .menu > ul > li > div > ul > li:hover > a,
   .menu > ul div#topbrand ul li a,
   .menu > ul > li.default2 > div > ul >li  a {
		color:<?php echo $this->config->get('menulink2_color') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('menulink2_hover_color')!='') { ?> 
    .menu .topmenu ul li .level3 li:hover a, 
	.menu > ul > li > div > ul > li > a:hover,
	 .menu > ul > li > div > ul > li:hover > a,
	.menu > ul > li > div.topmenu_theme > ul > li > div.topmenu li:hover > a,
	.displaymenu .menu > ul > li > div.topmenu > ul > li:hover > a, 
	.displaymenu .menu > ul > li > div.topmenu_theme > ul > li > a:hover,
	.menu > ul div#topbrand ul li a:hover,
	.menu > ul > li.default2 > div > ul >li a:hover {
		color:<?php echo $this->config->get('menulink2_hover_color') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('menulink2_bg_color')!='') { ?> 
    .menu > ul > li > div > ul > li:hover,
	.menu .topmenu ul li .level3 li:hover a,
    .menu > ul > li > div.topmenu_theme > ul > li > div.topmenu li:hover > a,
	.displaymenu .menu > ul > li > div.topmenu_theme > ul > li > a:hover,
	.menu > ul div#topbrand ul li a:hover,
	.menu > ul > li.default2 > div > ul > li a:hover{
		background-color:<?php echo $this->config->get('menulink2_bg_color') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('button_link_color')!='') { ?> 
    a.button, input.button, input.button.login, a.readmore  {
		color:<?php echo $this->config->get('button_link_color') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('button_bg_color')!='') { ?> 
    a.button, input.button, input.button.login,.hover_but .cart input, a.readmore {
		background-color:<?php echo $this->config->get('button_bg_color') ?>;
		 }	
<?php } ?>
<?php if($this->config->get('button_border_color')!='') { ?> 
    a.button, input.button, .cart input.button, input.button.login, button.button {
		border-color:<?php echo $this->config->get('button_border_color') ?>;
		 }
	.cart input.button{ background-color:<?php echo $this->config->get('button_border_color') ?>;}	 
<?php } ?>
<?php if($this->config->get('button_link2_color')!='') { ?> 
    a.button:hover, input.button:hover,  input.button.login:hover, button.button:hover,  a.button.registr:hover, a.readmore:hover, .cart input.button:hover, .product-info .cart input.button {
		color:<?php echo $this->config->get('button_link2_color') ?>;
		 }	 	
<?php } ?> 
<?php if($this->config->get('button_bg2_color')!='') { ?> 
   a.button:hover, input.button:hover,  input.button.login:hover, button.button:hover,  a.button.registr:hover, 
   .cart input.button:hover, a.readmore:hover, .product-info .cart input.button{
		background-color:<?php echo $this->config->get('button_bg2_color') ?>;
		border-color:<?php echo $this->config->get('button_bg2_color') ?>;
		 }	 	 	 
	.product-info .image-additional .active img{border-color:<?php echo $this->config->get('button_bg2_color') ?>;}	 	
<?php } ?> 
<?php if($this->config->get('arrow_bg_color')!='') { ?> 
    .sb-icon-search, .sb-search-submit, #topcontrol{
		background-color:<?php echo $this->config->get('arrow_bg_color') ?>;
		 }	
<?php } ?> 
              
<?php if($this->config->get('category_bg_color')!='') { ?> 
    .box-content .accordeon_categ > ul > li{
		background-color:<?php echo $this->config->get('category_bg_color') ?>;
		 }	
<?php } ?>
<?php if($this->config->get('category_link_color')!='') { ?> 
    .box-content .accordeon_categ > ul > li > a {
		color:<?php echo $this->config->get('category_link_color') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('category2_bg_color')!='') { ?> 
    .box-content .accordeon_categ > ul > li:hover{
		background-color:<?php echo $this->config->get('category2_bg_color') ?>;
		 }	
<?php } ?>
<?php if($this->config->get('category2_link_color')!='') { ?> 
    .box-content .accordeon_categ > ul > li:hover > a {
		color:<?php echo $this->config->get('category2_link_color') ?>;
		 }	
<?php } ?>
<?php if($this->config->get('category_subbg_color')!='') { ?> 
    .box-content .accordeon_categ > ul > li > ul,
	.dropdown_category  .sub_category_child > ul div,
	.dropdown_category .box-category > ul > li  .all_subcat{
		background-color:<?php echo $this->config->get('category_subbg_color') ?>;
		 }	
<?php } ?>
<?php if($this->config->get('category_sublink_color')!='') { ?> 
	.box-content .accordeon_categ > ul > li ul > li  a, .category-list ul li div a  {
		color:<?php echo $this->config->get('category_sublink_color') ?>;
		 }	
<?php } ?>  
<?php if($this->config->get('categoryactiv_bg_color')!='') { ?> 
    .box-content .accordeon_categ > ul > li.cat-active{
		background-color:<?php echo $this->config->get('categoryactiv_bg_color') ?>;
		 }	
<?php } ?>

<?php if($this->config->get('categoryactiv_link_color')!='') { ?> 
   .box-content .accordeon_categ > ul > li.cat-active > a.active{
		color:<?php echo $this->config->get('categoryactiv_link_color') ?>;
		 }	
<?php } ?>
<?php if($this->config->get('categoryactiv2_link_color')!='') { ?> 
    .box-content .accordeon_categ > ul > li ul.active > li a.active,
	.dropdown_category .box-content .accordeon_categ > ul > li ul > li:hover > a {
		color:<?php echo $this->config->get('categoryactiv2_link_color') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('product_name')!='') { ?> 
	.box-product .name a, .product-list .name a, .product-grid .name a,
	.block2 .name a, .compare-info .name a, .cart-info tbody .name a,
	.wishlist-info tbody .name a   {
		color:<?php echo $this->config->get('product_name') ?>;
		 }	
<?php } ?>  
<?php if($this->config->get('product_name_hover')!='') { ?> 
    .box-product .name a:hover, .product-list .name a:hover, .product-grid .name a:hover,
	.block2 .name a:hover, .compare-info .name a:hover, .cart-info tbody .name a:hover,
	.wishlist-info tbody .name a:hover {
		color:<?php echo $this->config->get('product_name_hover') ?>;
		 }	
<?php } ?>  
<?php if($this->config->get('product_price')!='') { ?> 
	.box-product .price, .product-list .price, .product-grid .price,
	.product-info .price, .compare-info .price, .block2 .price, .checkout-product tfoot td.total,
	.cart-total #total .right.price {
		color:<?php echo $this->config->get('product_price') ?>;
		 }		 	
<?php } ?>  
<?php if($this->config->get('product_oldprice')!='') { ?> 
    .box-product .price-old, .product-list .price-old,
	.product-grid .price-old, .product-info .price-old, .compare-info .price-old,
	.block2 .price-old {
		color:<?php echo $this->config->get('product_oldprice') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('product_sale')!='') { ?> 
.menu > ul > li.categories > a {color:<?php echo $this->config->get('product_sale') ?>; }		 	
<?php } ?>  
<?php if($this->config->get('product_sale_bg')!='') { ?> 
.categories > a {background-color:<?php echo $this->config->get('product_sale_bg') ?>; }		 	
<?php } ?> 

<?php if($this->config->get('product_link')!='') { ?> 
	.hover_but > div a{
		background-color:<?php echo $this->config->get('product_link') ?>;
		 }	
<?php } ?>  
<?php if($this->config->get('product_link_hover')!='') { ?> 
.product-grid .wishlist a:hover, .product-grid .compare a:hover, .product-grid .singleclick_wrapper a:hover,
.box-product .wishlist a:hover, .box-product .compare a:hover, .box-product .singleclick_wrapper a:hover,
.block2 .wishlist a:hover, .block2 .compare a:hover, .block2 .singleclick_wrapper a:hover{
		background-color:<?php echo $this->config->get('product_link_hover') ?>;
		 }	
<?php } ?>    
<?php if($this->config->get('product_bg')!='') { ?> 
	.box-product div.itemcolumns, .verticaltab .owl-item,
    .product-grid  > div, .product-list > div {
		background-color:<?php echo $this->config->get('product_bg') ?>;
		 }	
<?php } ?>  

<?php if($this->config->get('feed_button_bg')!='') { ?> 
    .sidebar_feedback{
		background-color:<?php echo $this->config->get('feed_button_bg') ?>;
		 }	
<?php } ?>
<?php if($this->config->get('footer_custom_bg')!='') { ?> 
    .movebox .content-move{
		background-color:<?php echo $this->config->get('footer_custom_bg') ?>;
		 }	
<?php } ?> 
 
<?php if (($this->config->get('footer_bg')!='') || ($this->config->get('image_footer_bg')!='')) { ?> 
    #footer{
		<?php if($this->config->get('image_footer_bg')!='') { ?> 
	background-image: url(<?php echo $this->config->get('config_url'); ?>image/<?php echo $this->config->get('image_footer_bg') ?>);
	background-position: <?php echo $this->config->get('position_footer_bg') ?>; 
	background-repeat: <?php echo $this->config->get('repeat_footer_bg') ?>;
	<?php } ?>
	<?php if($this->config->get('footer_bg')!='') { ?> 
		background-color:<?php echo $this->config->get('footer_bg') ?>;
		<?php } ?>
		 }	
<?php } ?> 
<?php if ($this->config->get('footer_bg_status')) { ?> 
#footer{ background:transparent;}
<?php } ?> 
<?php if($this->config->get('footer_text')!='') { ?> 
    #footer, #footer .box-product .price-old{
		color:<?php echo $this->config->get('footer_text') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('footer_h3')!='') { ?> 
    #footer h3{
		color:<?php echo $this->config->get('footer_h3') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('footer_link')!='') { ?> 
    #footer a, #footer .box-product .price{
		color:<?php echo $this->config->get('footer_link') ?>;
		 }	
<?php } ?>  
<?php if($this->config->get('footer_link_hover')!='') { ?> 
    #footer a:hover{
		color:<?php echo $this->config->get('footer_link_hover') ?>;
		 }	
<?php } ?>  
<?php if($this->config->get('footer_link_bg')!='') { ?> 
    #footer .column li:hover, #footer .box-product .name:hover{
		background-color:<?php echo $this->config->get('footer_link_bg') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('powered_text')!='') { ?> 
    #powered, #powered a{
		color:<?php echo $this->config->get('powered_text') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('powered_bg')!='') { ?> 
    #powered{
		background-color:<?php echo $this->config->get('powered_bg') ?>;
		 }	
<?php } ?>  
<?php if($this->config->get('other_show1_link')!='') { ?> 
 .htabs a:hover, .htabs a.selected{
		color:<?php echo $this->config->get('other_show1_link') ?>;
		border-color:<?php echo $this->config->get('other_show1_link') ?>;
		 }

 .htabs a.selected:after { border-bottom-color: <?php echo $this->config->get('other_show1_link') ?>;}	 	
<?php } ?> 


<?php if($this->config->get('news_heading')!='') { ?> 
    .heading_news_mod a{
		color:<?php echo $this->config->get('news_heading') ?>;
		 }	
<?php } ?> 
<?php if($this->config->get('news_heading_hover')!='') { ?> 
    .heading_news_mod a:hover{
		color: <?php echo $this->config->get('news_heading_hover') ?>;
		 }	
<?php } ?>		 
<?php if($this->config->get('news_data')!='') { ?> 
    .datepost {
		color: <?php echo $this->config->get('news_data') ?>;
		 }	
<?php } ?>

							                                   		      		 
                           		      		 
</style>

