<?php
$this->language->load('module/univertheme');
$button_quick = $this->language->get('entry_quickview');
?>
    <?php foreach ($products as $product) { ?>
    <div class="item">
       <div class="img_but">
       <?php if ($product['thumb']) { ?> 
                <div class="image"><a href="<?php echo $product['href']; ?>" data-image="<?php echo $product['thumb']; ?>">
                <img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" >
                </a></div>
                 <?php } ?>
           <?php if ($product['special']) { 
            if (isset($product['saving'])) { ?>
              <div  class="savemoney">- <?php echo $product['saving']; ?>%</div>
           <?php }} ?>
           
              <div class="hover_but">
               <?php if ($this->config->get('show_wishlist') == '1')  { ?>
               <div class="wishlist"><a onclick="addToWishList('<?php echo $product['product_id']; ?>');" title="<?php echo $button_wishlist; ?>"><?php echo $button_wishlist; ?></a></div>
               <?php } ?>
               <?php if ($this->config->get('show_compare') == '1')  { ?>
               <div class="compare"><a onclick="addToCompare('<?php echo $product['product_id']; ?>');"  title="<?php echo $button_compare; ?>"><?php echo $button_compare; ?></a></div>
               <?php } ?>
               <?php if  ((isset($product['quickview'])) && ($this->config->get('quick_view') == '1')) { ?>  
               <div class="quickviewbutton"><a class='quickview' href="<?php echo $product['quickview']; ?>" title="<?php echo $button_quick; ?>"><?php echo $button_quick; ?></a></div>
               <?php } ?> 
               </div>

           
     </div>
     
     <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
     
      <div class="description"><?php echo $product['description']; ?></div>
      
      <?php if ($product['price']) { ?>
      <div class="price">
        <?php if (!$product['special']) { ?>
        <?php echo $product['price']; ?>
        <?php } else { ?>
        <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
        <?php } ?>
        <?php if ($product['tax']) { ?>
        <br />
        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
        <?php } ?>
      </div>
      <?php } ?>
     
     <div class="cart"> <input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /> </div>
      <?php if ($this->config->get('config_review_status')) { ?>
      <div class="rating"><img src="catalog/view/theme/univer/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
      <?php } ?>
       
               
        
       
      
        <?php if ((isset($product['dop_img'])) && ($this->config->get('img_additional2') == '1') && ($product['thumb']) ) { ?>  
         <?php $i=1; if ($product['dop_img']) { ?>
					
						<div class="owl-addimagecat owl-carousel">
							
							<div data-index="0">
								<a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>" data-image="<?php echo $product['thumb']; ?>">
                               <img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" ></a>
							</div>
							
                            
                             
							 <?php foreach ($product['dop_img'] as $key => $img) { ?>
                          
							<div data-index="<?php echo $i; ?>" class="image<?php echo $key;?>">
                                <a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>" data-image="<?php echo $img; ?>">
                                <img src="<?php echo $img;?>" alt="<?php echo $product['name']; ?>"></a>
							</div>
                         
							<?php $i++; } ?>
                           
                            
						</div>
					
				<?php } ?> 
                <?php } ?> 
      
             

      
    </div>
    <?php } ?>