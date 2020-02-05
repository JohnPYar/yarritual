<div class="box">
<?php
$this->language->load('module/category');
$button_compare = $this->language->get('button_compare');
$button_wishlist = $this->language->get('button_wishlist');
$this->language->load('module/univertheme');
$button_quick = $this->language->get('entry_quickview');
$this->language->load('module/fast_order');
$text_order = $this->language->get('text_order');
$text_name = $this->language->get('text_name');
$text_phone = $this->language->get('text_phone');
$text_comment = $this->language->get('text_comment');
$text_captcha = $this->language->get('text_captcha');
$text_helptext = $this->language->get('text_helptext');
$text_send = $this->language->get('text_send');
?>
 <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content featur">
  <div class="box-product">

        
         <?php foreach ($products as $product) { ?>
               <div class="itemcolumns">
               
       <!--hover object-->              
       
       <?php if ((isset($product['dop_img'])) && ($this->config->get('img_additional1') == '1') && ($product['thumb'])) { ?>  
       <?php $i=1; if ($product['dop_img']) { ?>
		 <div class="owl_modul">		
							
							<div data-index="0">
								<a title="<?php echo $product['name']; ?>" data-image="<?php echo $product['thumb']; ?>">
                               <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" ></a>
							</div>
							
                            
                             
							  <?php for ($key = 0; $key < 3; $key++) { ?>
                             
                            <?php if  (!empty($product['dop_img'][$key])) { ?>
							<div data-index="<?php echo $i; ?>">
                                <a title="<?php echo $product['name']; ?>" data-image="<?php echo $product['dop_img'][$key]; ?>">
                                <img src="<?php echo $product['dop_img'][$key];?>" alt="<?php echo $product['name']; ?>" ></a>
							</div>
                              <?php } ?> 
                         
							<?php  $i++; } ?>

				</div>
				<?php } ?> 
                <?php } ?> 
              	  
         
   <!--end hover object-->  
                 
                 
                  <?php if ($product['thumb']) { ?>

                   <div class="image"><a href="<?php echo $product['href']; ?>" data-image="<?php echo $product['thumb']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" ></a>
                    <?php if  ((isset($product['quickview'])) && ($this->config->get('quick_view') == '1')) { ?>  
               <div class="quickviewbutton"><a class='quickview' href="<?php echo $product['quickview']; ?>" title="<?php echo $button_quick; ?>"><?php echo $button_quick; ?></a></div>
               <?php } ?>  
                   
                   </div>

                   <?php } ?>
                <?php if ($product['special']) { 
                 if (isset($product['saving'])) { ?>
               <div class="savemoney">- <?php echo $product['saving']; ?>%</div>
               <?php } } ?> 
  
                             
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
            
		  	   <?php if ($this->config->get('univer_fastorder') == '1')  { ?>
			   <div class="singleclick_wrapper"><a class="singleclick" title="<?php echo $text_order; ?>"><?php echo $text_order; ?></a></div>
			   <?php } ?>
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

      
      <?php } ?>

       
   </div> </div>  
  
   </div>  
<?php
require 'catalog/view/theme/univer/template/module/singleclick.tpl';
?>