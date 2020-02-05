<!--Custom box-->
<?php
$this->language->load('module/category');
$button_compare = $this->language->get('button_compare');
$button_wishlist = $this->language->get('button_wishlist');
$button_cart = $this->language->get('button_cart');
$this->language->load('module/univertheme');
$button_quick = $this->language->get('entry_quickview');
?>

	<?php if ($this->config->get('parallax_width') == '1') { ?><div class="cont_bottom"></div></div></div><?php } ?> 
     
	    <div id="center_custom_box" >

        <div class="custom_box_parallax">
        <div class="container">
         <?php if (isset($this->document->cusom_f) ){ ?>
			<div class="bigtext"><?php echo htmlspecialchars_decode( $this->document->cusom_f[$this->config->get('config_language_id')]['comptext_text'], ENT_QUOTES ); ?></div> 
         <?php } ?> 
         

        
        <!--Featured product--> 
    <?php if(isset($this->document->featured_product2)) { ?>

      <div  class="verticaltab">
 
       <div class="owl-addblock-parall owl-carousel">
     <?php
      $featured_product = $this->document->featured_product2;
      foreach ($featured_product as $product) { ?>
         <div class="block2">
          <div class="img_but">
        
          <?php if ($product['thumb']) { ?>
         <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" ></a>
         
              <?php if  ((isset($product['quickview'])) && ($this->config->get('quick_view') == '1')) { ?>  
               <div class="quickviewbutton"><a class='quickview' href="<?php echo $product['quickview']; ?>" title="<?php echo $button_quick; ?>"><?php echo $button_quick; ?></a></div>
               <?php } ?> 
         
         
         </div>
         <?php } ?>
         
                     <?php if ((isset($product['saving']))&& $product['special'] ) { ?>
                      <div  class="savemoney">- <?php echo $product['saving']; ?>%</div>
                     <?php } ?>
                     
                     
                   <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
               <?php if ($product['price']) { ?>
               <div class="price">
               <?php if (!$product['special']) { ?>
               <?php echo $product['price']; ?>
               <?php } else { ?>
               <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
               <?php } ?>
               </div>
               <?php } ?>     
                     
                 <div class="cart"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div>   
                    
               <div class="hover_but">
               <?php if ($this->config->get('show_wishlist') == '1')  { ?>
               <div class="wishlist"><a onclick="addToWishList('<?php echo $product['product_id']; ?>');" title="<?php echo $button_wishlist; ?>" ></a></div>
               <?php } ?>
               <?php if ($this->config->get('show_compare') == '1')  { ?>
               <div class="compare"><a onclick="addToCompare('<?php echo $product['product_id']; ?>');"  title="<?php echo $button_compare; ?>"></a></div>
               <?php } ?>
                </div>
                  <?php if ($this->config->get('config_review_status')) { ?>
               <div class="rating"><img src="catalog/view/theme/univer/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
               <?php } ?> 
         
         
         </div>
       
  
               
        </div>       
    
      <?php }?>
      </div>
   </div>

   <?php }?>
    <!--end Featured product-->  
        
   <script type="text/javascript">	
                $(document).ready(function(){
				 $(".owl-addblock-parall").owlCarousel({
                 navigation : true,
                 pagination : false,
				  items 	 :4,
				<?php if ($this->config->get('gen_responsive') == '1') { ?>
				itemsDesktop 			: [1199,3],
		        itemsDesktopSmall 		: [979,2],
		        itemsTablet 			: [768,1],
				 <?php } else { ?>
				 itemsDesktop : false,
				 itemsDesktopSmall: false,
				 itemsTablet :false,
				 itemsMobile: false,
				<?php } ?>
				 <?php if ($this->config->get('slider_pauseTime') != '') { ?>
			     autoPlay: <?php echo $this->config->get('slider_pauseTime'); ?>,
			         <?php } else {?>
				 autoPlay: 8000,	 
					 <?php } ?>
			    });
	
                
	         <?php if ($this->config->get('parall_p_width') != '') { ?>
	         var widthimg1 = <?php echo $this->config->get('parall_p_width'); ?> + 20;
	         <?php } else { ?>
	         var widthimg1 = 220;
	         <?php } ?>
	
	 <?php if ($this->config->get('gen_responsive') == '1') { ?>
	 enquire.register("only screen and (min-width: 790px)", {
			  match : function() {
		   $('.right_desc').css('margin-left',widthimg1);
			  }
		    }).register("only screen and (max-width: 789px)", {
			  match : function() {
		   $('.right_desc').css('margin-left',0);
			  }
		    }); 

		<?php } else { ?>
	 $('.right_desc').css('margin-left',widthimg1);
	 
	<?php } ?>
	   	   
 });
</script>
  </div>
  </div>  

 </div>  
	<?php if ($this->config->get('parallax_width') == '1') { ?><div class="main bottom_main"><div><?php } ?>
    
              

<!--end custom box-->