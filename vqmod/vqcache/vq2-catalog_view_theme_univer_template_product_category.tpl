<?php
$this->language->load('module/univertheme');
$category_details = $this->language->get('category_details');
$button_quick = $this->language->get('entry_quickview');

$this->language->load('module/fast_order');
$text_order = $this->language->get('text_order');
?>
<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><?php echo $breadcrumb['text']; ?><?php } ?>

    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
   <?php echo $content_top; ?>
 <!--Category description--> 

  
  <?php if ($thumb || $description) { ?>

  <div class="category-info">
    <?php if ($thumb) { ?>
    <div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
    <?php } ?>
    <?php if ($description) { ?>
    <?php echo $description; ?>
    <?php } ?>
  </div>
  <?php } ?>
  
  <?php if ($categories) { ?>
   <div class="accordeon_description">
   
  <?php if  ($this->config->get('detail_view')) { ?>  <div class="accordeon_plus"><h3><?php echo $text_refine; ?></h3></div> <?php } ?>
  <div <?php if  ($this->config->get('detail_view')) { ?> class="view"  <?php } ?>>
   <div class="box-heading"><?php echo $text_refine; ?></div>
  <div class="category-list">
  
   <?php 
              if (count($categories) < 5) {
              $n_li = 1;
              } else {
               $n_li = (ceil(count($categories) / 3));
              }
          ?>
    
    <?php for ($i = 0; $i < count($categories);) { ?>
    <ul>
      <?php $j = $i + $n_li; ?>
      <?php for (; $i < $j; $i++) { ?>
      <?php if (isset($categories[$i])) { ?>
      <li <?php if ((isset($categories[$i]['pic'])) && ($categories[$i]['pic']) ) { ?>class="otstupleft" <?php } ?>>
      
          <?php if ((isset($categories[$i]['pic'])) && ($categories[$i]['pic']) ) { ?> 
          <a href="<?php echo $categories[$i]['href']; ?>">
          <img src="<?php echo $categories[$i]['pic']; ?>" title="<?php echo $categories[$i]['name']; ?>" alt="<?php echo $categories[$i]['name']; ?>"  width="80px;"/>
          </a>
          <?php } ?>
        
       <a href="<?php echo $categories[$i]['href']; ?>"><h3><?php echo $categories[$i]['name']; ?></h3> </a>
           
        <?php if(!empty( $categories[$i]['children'] ) && (isset($categories[$i]['children']) ) ) { ?>
        <div>
        <?php foreach( $categories[$i]['children'] as $menu3item ) { ?>
              <a href="<?php echo $menu3item['href']; ?>"><?php echo $menu3item['name']; ?></a><br />
        <?php } ?>
        </div>
         <?php } ?> 
      
      </li>
      <?php } ?>
      <?php } ?>
    </ul>
    <?php } ?>

  </div>
  
   </div>
   </div>
   
  <?php } ?>

  <!--end Category description-->
  
  <?php if ($products) { ?>
  <div class="product-filter">
     <div class="display"><span class="iconlist"></span> <a onclick="display('grid');" class="icongrid"></a></div>
    <div class="limit"><?php echo $text_limit; ?>
      <select onchange="location = this.value;" class="select1">
        <?php foreach ($limits as $limits) { ?>
        <?php if ($limits['value'] == $limit) { ?>
        <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
    <div class="sort">
      <select onchange="location = this.value;" class="select1">
        <?php foreach ($sorts as $sorts) { ?>
        <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
        <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
     <?php if ($this->config->get('show_compare') == '1')  { ?>
    <div class="product-compare"><a href="<?php echo $compare; ?>" id="compare-total"><div></div><?php echo $text_compare; ?></a></div>
    <?php } ?>
  </div>
 
  <div class="product-list">
       <?php foreach ($products as $product) { ?>
   
        <div class="item">
         <div class="left">
          <?php if ($product['special']) { 
            if (isset($product['saving'])) { ?>
              <div  class="savemoney">- <?php echo $product['saving']; ?>%</div>
           <?php }} ?>
           
           
   <?php if ((isset($product['dop_img'])) || ($product['thumb']) ) { ?>  
         
					  <?php if ((isset($product['dop_img'])) && ($this->config->get('img_additional2') == '1') ) { ?>   
						<div class="owl-addimagecat owl-carousel">
					<?php } ?> 
                    
                    		<?php if ($product['thumb'])  { ?>  
							<div class="image">
								<a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>" data-image="<?php echo $product['thumb']; ?>">
                               <img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" ></a>
							</div>
							<?php } ?> 
                            
                            
                         <?php if ((isset($product['dop_img'])) && ($this->config->get('img_additional2') == '1') ) { ?>       
							
                             <?php foreach ($product['dop_img'] as $key => $img) { ?>
                             <div class="image image<?php echo $key;?>">
                                <a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>" data-image="<?php echo $img; ?>">
                                <img src="<?php echo $img;?>" alt="<?php echo $product['name']; ?>"></a>
							</div>
                            <?php  } ?>
                            
                         </div>
                         
							<?php  } ?>
                           
					
				<?php } ?>    
               
           

         </div>
          <div class="centr"> 
          
           <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
            <div class="right">
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
            </div>
           
           <?php if ($this->config->get('config_review_status')) { ?>
      <div class="rating"><img src="catalog/view/theme/univer/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
      <?php } ?>
            <div class="description"><?php echo $product['description']; ?></div>
           
         
           
              <div class="hover_but">
              <?php if ($this->config->get('univer_fastorder') == '1')  { ?>
			<div class="singleclick_wrapper"><a class="singleclick" title="<?php echo $text_order; ?>"><?php echo $text_order; ?></a></div>
			<?php } ?>
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


      
    </div>
    <?php } ?>

  </div>
  
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } ?>
  <?php if (!$categories && !$products) { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php } ?></div>
  <div class="cont_bottom"></div>
  <?php echo $content_bottom; ?>
<script type="text/javascript"><!--
function display(view) {
	if (view == 'list') {
		$('.product-grid').attr('class', 'product-list');
		
		$('.product-list > div').each(function(index, element) {
			
			
			html  = '<div class="left">';
			
			<?php if  ((isset($product['quickview'])) && ($this->config->get('quick_view') == '1')) { ?>  
             html += ' <div class="quickviewbutton">' + $(element).find('.quickviewbutton').html() + '</div>';
            <?php } ?>
			
				var savemoney = $(element).find('.savemoney').html();
             if (savemoney != null) {
				html += '<div class="savemoney">' + savemoney  + '</div>';
			}
			 <?php if  ($this->config->get('img_additional2') == '1') { ?> 
			html += '<div class="owl-addimagecat owl-carousel">';
		   <?php } ?>
			
			var image = $(element).find('.image').html();
			if (image != null) { 
				html += '<div class="image">' + image + '</div>';
			}
			
			<?php if  ($this->config->get('img_additional2') == '1') { 
			for ($key = 0; $key < 3; $key++) { ?>
			var image2 = $(element).find('.image<?php echo $key;?>').html();
			if (image2 != null) { 
			html += ' <div class="image image<?php echo $key;?>">' + image2 + '</div>';
			
			}
			<?php } ?>
			
			html += '</div>';
			<?php } ?>
			
			html += '</div>';
			
			
			
			html += '<div class="centr">';

			html += ' <div class="name">' + $(element).find('.name').html() + '</div>';
			
			 html += '<div class="right">';
			
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}		
			
			html += '  <div class="cart">' + $(element).find('.cart').html() + '</div>';
	
			html += '</div>';

			var rating = $(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
			
			html += '  <div class="description">' + $(element).find('.description').html() + '</div>';
			<?php if ($this->config->get('univer_fastorder') == '1')  { ?>
			html += '  <div class="singleclick_wrapper"><a class="singleclick" title="<?php echo $text_order; ?>"><?php echo $text_order; ?></a></div>';
			<?php } ?>
			<?php if ($this->config->get('show_wishlist') == '1')  { ?>
			html += '  <div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
			<?php } ?>
			<?php if ($this->config->get('show_compare') == '1')  { ?>
			html += '  <div class="compare">' + $(element).find('.compare').html() + '</div>';
			<?php } ?>
			
			html += '</div>';
				
						
			$(element).html(html);
		});	
		 $(".owl-addimagecat").owlCarousel({ navigation : true, pagination : false, singleItem : true });	
		
		$('.display').html('<span class="iconlist"></span> <a onclick="display(\'grid\');" class="icongrid"></a>');
		
		$.cookie('display', 'list'); 
	} else {
		$('.product-list').attr('class', 'product-grid');
		
		$('.product-grid > div').each(function(index, element) {
			html = '';
            
			 <?php if ($this->config->get('img_additional2') == '1') { ?> 
			  var image0 = $(element).find('.image0').html();
			 if (image0 != null) {
				 
				 
			  html += ' <div class="owl_modul">'; 
				  
	           html += '<div data-index="0">';
			   var image = $(element).find('.image').html();
			   if (image != null) { 
				html +=  image;
			     }
			    html += '</div>';
				
 
			<?php $i= 1; for ($key = 0; $key < 3; $key++) { ?>
			var image2 = $(element).find('.image<?php echo $key;?>').html();
			if (image2 != null) { 
			html += ' <div data-index="<?php echo $i;?>" class="image<?php echo $key;?>">' + image2 + '</div>';
			
			}
			<?php  $i++; } ?>
			}
         
			html += '</div>'; 
		 <?php } ?>	

           html += '<div class=imgbut>'; 
			var image = $(element).find('.image').html();
			if (image != null) { 
				html += '<div class="image">' + image + '</div>'; 
			}
			 <?php if  ((isset($product['quickview'])) && ($this->config->get('quick_view') == '1')) { ?>  
                 html += ' <div class="quickviewbutton">' + $(element).find('.quickviewbutton').html() + '</div>';
                <?php } ?>
			html += '</div>'; 
			var savemoney = $(element).find('.savemoney').html();
             if (savemoney != null) {
				html += '<div class="savemoney">' + savemoney  + '</div>';
			}
			
			
			html += '<div class="name">' + $(element).find('.name').html() + '</div>';
			html += '  <div class="description">' + $(element).find('.description').html() + '</div>';
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
		
			html += '<div class="cart">' + $(element).find('.cart').html() + '</div>'; 
			
			  html += ' <div class="hover_but">';
			  
			 <?php if ($this->config->get('univer_fastorder') == '1')  { ?>
			html += '  <div class="singleclick_wrapper"><a class="singleclick" title="<?php echo $text_order; ?>"><?php echo $text_order; ?></a></div>';
			<?php } ?> 
			<?php if ($this->config->get('show_wishlist') == '1')  { ?>
			html += '  <div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
			<?php } ?>
			<?php if ($this->config->get('show_compare') == '1')  { ?>
			html += '  <div class="compare">' + $(element).find('.compare').html() + '</div>';
			<?php } ?>
			html += '</div>'; 
			
	
			var rating = $(element).find('.rating').html();
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
			

			$(element).html(html);
		});	
		 $(".owl-addimagecat").owlCarousel({ navigation : true, 
		            pagination : false, 
					items : 3,
					itemsDesktop : false,
	                itemsDesktopSmall: false,
	                itemsTablet :false,
	                itemsMobile: false, });
		  $('.item').hover(function(){
           var $gallery = $(this);
	       $('.owl_modul div a',$gallery).hover(function(){
		   $('.owl_modul div',$gallery).removeClass('active');
		   $(this).parent().addClass('active');
		   $('.image img',$gallery).attr('src', $(this).attr('data-image'));});
	       $('.owl_modul div:first',$gallery).addClass('active'); 
		   
		   if ( $('.owl_modul',$gallery).parents('.item').length ) { $gallery.addClass('itemwd')};	
	    });	
		
		$('.display').html('<a onclick="display(\'list\');" class="iconlist"></a> <span class="icongrid"></span>');
		
		$.cookie('display', 'grid');
	}
}

view = $.cookie('display');


if (view) {
	display(view);
} else {
	display('list');
}
//--></script>
<script type="text/javascript"><!--
  $(document).ready(function(){
 $(".owl-addimagecat").owlCarousel({ navigation : true, 
		            pagination : false, 
					itemsDesktop : false,
	                itemsDesktopSmall: false,
	                itemsTablet :false,
	                itemsMobile: false, });
		});			
//--></script>
         
   
<?php echo $footer; ?>
<?php
require 'catalog/view/theme/univer/template/module/singleclick.tpl';
?>