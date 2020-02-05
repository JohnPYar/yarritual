<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><?php echo $breadcrumb['text']; ?><?php } ?>

    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <div class="product-info">
    <?php if ($thumb || $images) { ?>
        <div class="left">
     <?php if ($thumb) { ?>
      <div class="image">
       <a title="<?php echo $heading_title; ?>"  <?php if ($this->config->get('product_zoom') !== '1') { ?> href="<?php echo $popup; ?>" class="colorbox" <?php } ?>>
       <img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>"
        <?php if ($this->config->get('product_zoom') == '1') { ?>  id="main-image" data-zoom-image="<?php echo $popup; ?>"  <?php } ?> >
        
       </a></div>
      <?php } ?>
      
     <?php $i=1; if ($images) { ?>
					
						<div class="image-additional owl-carousel" id="add-gallery">
							<?php if (($thumb) && (isset($smallimg)) && ($this->config->get('product_zoom') == '1')) { ?>
							<div data-index="0">
								<a title="<?php echo $heading_title; ?>" data-image="<?php echo $thumb; ?>" data-zoom-image="<?php echo $popup; ?>">
                                <img src="<?php echo $smallimg; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" ></a>
							</div>
							<?php } ?>
                            
                            
							<?php foreach ($images as $image) { ?>
                            <?php if (isset($image['thumb1'])) { ?>
							<div data-index="<?php echo $i; ?>">
								<a title="<?php echo $heading_title; ?>" 
                                 <?php if ($this->config->get('product_zoom') == '1') { ?>
                                data-image="<?php echo $image['thumb1']; ?>" data-zoom-image="<?php echo $image['popup']; ?>"
                                 <?php } else { ?>
                                href="<?php echo $image['popup']; ?>" class="colorbox"
                                <?php } ?>>
                                <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" ></a>
							</div>
                            <?php } ?>
							<?php $i++; } ?>
                            
						</div>
					
				<?php } ?>
     </div>
    <?php } ?>
    <div class="right">
   
     
     <div class="general_info"> 
           <?php if ($price) { ?>
      <div class="price">
        <?php if (!$special) { ?>
        <?php echo $price; ?>
        <?php } else { ?>
        <span class="price-old"><?php echo $price; ?></span> <span class="price-new"><?php echo $special; ?></span>
         <?php if (isset($saving)) { ?>
           <div  class="savemoney">- <?php echo $saving; ?>%</div>
           <?php } ?> 
        <?php } ?>
        <br />
        <?php if ($tax) { ?>
        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $tax; ?></span><br />
        <?php } ?>
        <?php if ($points) { ?>
        <span class="reward"><small><?php echo $text_points; ?> <?php echo $points; ?></small></span><br />
        <?php } ?>
        <?php if ($discounts) { ?>
        <br />
        <div class="discount">
          <?php foreach ($discounts as $discount) { ?>
          <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?><br />
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
      
      <div class="description">
        <?php if ($manufacturer) { ?>
        
              <?php if (isset($manufacturers_img)) { ?>
            <?php echo ($manufacturers_img) ? '<div class="logobrand"> <a href="'.$manufacturers.'"><img src="'.$manufacturers_img.'"  title="'.$manufacturer.'" /></a></div>' : '' ;?>
              <?php } ?>
            
        <span><?php echo $text_manufacturer; ?></span>
        <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a><br />
        <?php } ?>
        <span><?php echo $text_model; ?></span> <?php echo $model; ?><br />
        <?php if ($reward) { ?>
        <span><?php echo $text_reward; ?></span> <?php echo $reward; ?><br />
        <?php } ?>
        <span><?php echo $text_stock; ?></span> <?php echo $stock; ?></div>
         <?php if ($review_status) { ?>
      <div class="review">
        <div><img src="catalog/view/theme/univer/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />&nbsp;&nbsp;
                <a onclick="$('a[href=\'#tab-review\']').trigger('click'); $('html, body').animate({scrollTop: $('#tabs').offset().top}, 800);"><?php echo $reviews; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click'); $('html, body').animate({scrollTop: $('#tabs').offset().top}, 800);"><?php echo $text_write; ?></a></div>

      </div>
      <?php } ?> 
      </div>  
     

     <?php if ($options) { ?>
      <div class="options">
        <h2><?php echo $text_option; ?></h2>
        <br />
        <?php foreach ($options as $option) { ?>
        <?php if ($option['type'] == 'select') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <select name="option[<?php echo $option['product_option_id']; ?>]">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($option['option_value'] as $option_value) { ?>
            <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
            </option>
            <?php } ?>
          </select>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'radio') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <?php foreach ($option['option_value'] as $option_value) { ?>
          <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
          <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
          </label>
          <br />
          <?php } ?>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'checkbox') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <?php foreach ($option['option_value'] as $option_value) { ?>
          <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
          <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
          </label>
          <br />
          <?php } ?>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'image') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <table class="option-image">
            <?php foreach ($option['option_value'] as $option_value) { ?>
            <tr>
              <td style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
              <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
              <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                  <?php if ($option_value['price']) { ?>
                  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                  <?php } ?>
                </label></td>
            </tr>
            <?php } ?>
          </table>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'text') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'textarea') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'file') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="button">
          <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'date') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'datetime') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'time') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
        </div>
        <br />
        <?php } ?>
        <?php } ?>
      </div>
      <?php } ?>
 <div class="cart">
        
         <table class="gty"><tr><td>
          <input type="button" id="decrease" value="" /></td><td><input type="text" name="quantity" id="htop" size="2" value="<?php echo $minimum; ?>" /></td><td><input type="button" id="increase" value="" />
          <input type="hidden" name="product_id" size="4" value="<?php echo $product_id; ?>" /></td>
         </tr></table> 
          <input type="button" value="<?php echo $button_cart; ?>" id="button-cart" class="button" />
         
          <span class="links">
                   <?php if ($this->config->get('show_wishlist') == '1')  { ?>
                   <div class="wishlist"><a onclick="addToWishList('<?php echo $product_id; ?>');" title="<?php echo $button_wishlist; ?>" ><?php echo $button_wishlist; ?></a></div>
                   <?php } ?>
                   <?php if ($this->config->get('show_compare') == '1')  { ?>
                   <div class="compare"><a onclick="addToCompare('<?php echo $product_id; ?>');" title="<?php echo $button_compare; ?>" ><?php echo $button_compare; ?></a></div>
                   <?php } ?>
            </span>
        
        <?php if ($minimum > 1) { ?>
        <div class="minimum"><?php echo $text_minimum; ?></div>
        <?php } ?>
      </div>
      
   <!--Fast order form--> 
 <?php if( $this->config->get('univer_fastorder') == '1'){	?>
		<?php
$this->language->load('module/fast_order');
$text_order = $this->language->get('text_order');
$text_name = $this->language->get('text_name');
$text_phone = $this->language->get('text_phone');
$text_comment = $this->language->get('text_comment');
$text_captcha = $this->language->get('text_captcha');
$text_helptext = $this->language->get('text_helptext');
$text_send = $this->language->get('text_send');
?> 
<div class="accordeon_description"> 
<div class="accordeon_plus"><h3><?php echo $text_order; ?></h3></div>
 
  <div id="fast_order_form"  class="view">
            <input id="product_name" type="hidden" value="<?php echo $heading_title; ?>">
            <input id="product_price" type="hidden" value="<?php echo ($special ? $special : $price); ?>">
             <p><?php echo $text_helptext; ?></p>  
 
              <div class="customer_name"><div></div><input type="text" id="customer_name" placeholder="<?php echo $text_name; ?>"/></div>
              <div class="customer_phone"><div></div><input type="text" id="customer_phone" placeholder="<?php echo $text_phone; ?>"/></div>
               <textarea  id="customer_message" name="customer_message" rows="3" placeholder="<?php echo $text_comment; ?>"></textarea>	
                <input id="pr" type="text" placeholder="<?php echo $text_captcha; ?>">     
		<?php 
		$i=1;
		do
		{
		$num[$i] = mt_rand(0,9);
		echo "<img src='fastorder/img/".$num[$i].".gif' border='0' align='bottom' vspace='5px'>";
		$i++;
		}
		while ($i<5);
		$captcha = $num[1].$num[2].$num[3].$num[4];
		?>
         
       <input id="captcha" type="hidden" value="<?php echo $captcha ;?>">


              <p id="fast_order_result"></p>
              <button class="fast_order_button button"><span><?php echo $text_send; ?></span></button>
            </div>
 </div>         	
  <?php } ?>
<!--end--> 










 <div class="share">
		<!-- AddThis Button BEGIN -->
			<div class="share42init" data-image="<?php echo $thumb; ?>"></div>
			<script type="text/javascript" src="catalog/view/javascript/jquery/share42/share42.js"></script> 
		<!-- AddThis Button END --> 
        </div>        

  <!--Custom product information-->            
    <?php if (($this->config->get('status_product') == '1') && (isset($this->document->cusom_p)) ){ ?> 
    <div class="product_custom"><?php echo htmlspecialchars_decode( $this->document->cusom_p[$this->config->get('config_language_id')]['product_text'], ENT_QUOTES ); ?></div> 
    <?php } ?> 
     
   <!--end Custom product information-->  
  
  
   </div> 
  </div>
  
  <div id="tabs" class="htabs card_prod"><a href="#tab-description"><?php echo $tab_description; ?></a>
    <?php if ($attribute_groups) { ?>
    <a href="#tab-attribute"><?php echo $tab_attribute; ?></a>
    <?php } ?>
    <?php if ($review_status) { ?>
    <a href="#tab-review"><?php echo $tab_review; ?></a>
    <?php } ?>
     <?php if (($this->config->get('status_product_tab') == '1') && (isset($this->document->cusom_p_tab)) ){ ?> 
    <a href="#tab-custom"><?php echo htmlspecialchars_decode( $this->document->cusom_p_tab[$this->config->get('config_language_id')]['product_title_tab'], ENT_QUOTES ); ?></a>
    <?php } ?>
  </div>
  <div id="tab-description" class="tab-content"><?php echo $description; ?></div>
  <?php if ($attribute_groups) { ?>
  <div id="tab-attribute" class="tab-content">
    <table class="attribute">
      <?php foreach ($attribute_groups as $attribute_group) { ?>
      <thead>
        <tr>
          <td colspan="2"><?php echo $attribute_group['name']; ?></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
        <tr>
          <td><?php echo $attribute['name']; ?></td>
          <td><?php echo $attribute['text']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php } ?>
    </table>
  </div>
  <?php } ?>
  <?php if ($review_status) { ?>
  <div id="tab-review" class="tab-content">
    <div id="review"></div>
    <h2 id="review-title"><?php echo $text_write; ?></h2>
    <b><?php echo $entry_name; ?></b><br />
    <input type="text" name="name" value="" />
    <br />
    <br />
    <b><?php echo $entry_review; ?></b>
    <textarea name="text" cols="40" rows="8" style="width: 98%;"></textarea>
    <span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
    <br />
    <b><?php echo $entry_rating; ?></b> <span><?php echo $entry_bad; ?></span>&nbsp;
    <input type="radio" name="rating" value="1" />
    &nbsp;
    <input type="radio" name="rating" value="2" />
    &nbsp;
    <input type="radio" name="rating" value="3" />
    &nbsp;
    <input type="radio" name="rating" value="4" />
    &nbsp;
    <input type="radio" name="rating" value="5" />
    &nbsp;<span><?php echo $entry_good; ?></span><br />
    <br />
    <b><?php echo $entry_captcha; ?></b><br />
    <input type="text" name="captcha" value="" />
    <br /><br />
    <img src="index.php?route=product/product/captcha" alt="" id="captcha" /><br />
    <br />
    <div class="buttons">
      <div class="right"><a id="button-review" class="button"><?php echo $button_continue; ?></a></div>
    </div>
  </div>
  <?php } ?>
  
  
 <?php if (($this->config->get('status_product_tab') == '1') && (isset($this->document->cusom_p_tab)) ){ ?> 
    <div id="tab-custom" class="tab-content"><?php echo htmlspecialchars_decode( $this->document->cusom_p_tab[$this->config->get('config_language_id')]['product_text_tab'], ENT_QUOTES ); ?></div>
    <?php } ?>
    
    <!--Related Products-->
 <?php if ($products) { ?>
 <div class="box">
 <div class="box-heading"><?php echo $tab_related; ?> (<?php echo count($products); ?>)</div>
   <div class="box-content">
   <div class="box-product">
   
   
      <?php foreach ($products as $product) { ?>
      <div class="itemcolumns">
      <div>
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
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
         <?php if ($this->config->get('config_review_status')) { ?>
      <div class="rating"><img src="catalog/view/theme/univer/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
      <?php } ?>
        </div>
        </div>
      <?php } ?>

      
      </div>
  </div>
  </div>
  <?php } ?>
<!--end Related Products-->
  
    
  <?php if ($tags) { ?>
  <div class="tags"><b><?php echo $text_tags; ?></b>
    <?php for ($i = 0; $i < count($tags); $i++) { ?>
    <?php if ($i < (count($tags) - 1)) { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
    <?php } else { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
    <?php } ?>
    <?php } ?>
  </div>
  <?php } ?></div>
   <div class="cont_bottom"></div>
  <?php echo $content_bottom; ?>
<script type="text/javascript"><!--
$(document).ready(function() {
	
	 <?php if ($this->config->get('product_zoom') == '1') { ?>
	   // additional images
	   $('.image-additional div a').click(function(){
		$('.image-additional div').removeClass('active');
		$(this).parent().addClass('active');
		$('.product-info .image img').attr('src', $(this).attr('data-image'));
	});
	$('.image-additional div:first').addClass('active');
	  
		// zoom
		
		$("#main-image").elevateZoom({
		gallery:'add-gallery',  
		galleryActiveClass: 'active',
		zoomType: "inner",
		cursor: "pointer"
		});	
		
		//popup
		$('.left .image a').magnificPopup({
			items: [
			
				<?php if ($thumb) { ?>
				{src: '<?php echo $popup; ?>'},
				<?php } ?>
				<?php if ($images) { ?>
				<?php foreach ($images as $image) { ?>
				{src: '<?php echo $image['popup']; ?>'},
				<?php } ?>
			<?php } ?>
			],
			gallery: { enabled: true, preload: [0,2] },
			type: 'image',
			mainClass: 'mfp-fade',
		   <?php if ($images) { ?>
			callbacks: {
				open: function() {
					var activeIndex = parseInt($('.image-additional div.active').attr('data-index'));
					var magnificPopup = $.magnificPopup.instance;
					magnificPopup.goTo(activeIndex);
				}
			}
			<?php } ?>
		});	
		
		<?php } else { ?>
		
		 //Colorbox
        $('.colorbox').colorbox({
		maxWidth:'95%', 
		maxHeight:'95%',
		overlayClose: true,
		opacity: 0.5,
		current: "{current} of {total}",
		rel: "colorbox"
	    });

  <?php if ($this->config->get('gen_responsive') == '1') { ?>
      // Colorbox resize function 
      var resizeTimer;
      function resizeColorBox()
      {
       if (resizeTimer) clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (jQuery('#cboxOverlay').is(':visible')) {
                      jQuery.colorbox.load(true);
            }
        }, 300);
     }
 
    // Resize Colorbox when resizing window or changing mobile device orientation
    jQuery(window).resize(resizeColorBox);
    window.addEventListener("orientationchange", resizeColorBox, false);
	
	    <?php } ?>	
		<?php } ?>
		
		
		 $('.image-additional').owlCarousel({
                 navigation : true,
                 pagination : false,
	             items 	 : 3,
                  itemsDesktop : false,
				 itemsDesktopSmall: false,
				 itemsTablet :false,
				 itemsMobile: false,
      });


});
//--></script>  
<script type="text/javascript"><!--
$('#button-cart').bind('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();
			
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}
				}
			} 
			
			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
					
				$('.success').fadeIn('slow');
				setTimeout ("$('.success').fadeOut('slow');", 5000);
					
				$('#cart-total').html(json['total']);

			}	
		}
	});
});
//--></script>
<?php if ($options) { ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php foreach ($options as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript"><!--
new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
	action: 'index.php?route=product/product/upload',
	name: 'file',
	autoSubmit: true,
	responseType: 'json',
	onSubmit: function(file, extension) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
	},
	onComplete: function(file, json) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);
		
		$('.error').remove();
		
		if (json['success']) {
			alert(json['success']);
			
			$('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
		}
		
		if (json['error']) {
			$('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
		}
		
		$('.loading').remove();	
	}
});
//--></script>
<?php } ?>
<?php } ?>
<?php } ?>
<script type="text/javascript"><!--
$('#review .pagination a').live('click', function() {
	$('#review').fadeOut('slow');
		
	$('#review').load(this.href);
	
	$('#review').fadeIn('slow');
	
	return false;
});			

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').bind('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-review').attr('disabled', true);
			$('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				$('#review-title').after('<div class="warning">' + data['error'] + '</div>');
			}
			
			if (data['success']) {
				$('#review-title').after('<div class="success">' + data['success'] + '</div>');
								
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	if ($.browser.msie && $.browser.version == 6) {
		$('.date, .datetime, .time').bgIframe();
	}

	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	$('.datetime').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'h:m'
	});
	$('.time').timepicker({timeFormat: 'h:m'});
});
//--></script> 
<?php echo $footer; ?>