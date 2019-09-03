<?php
$this->language->load('module/fast_order');
$text_order = $this->language->get('text_order');
$text_name = $this->language->get('text_name');
$text_phone = $this->language->get('text_phone');
$text_comment = $this->language->get('text_comment');
$text_captcha = $this->language->get('text_captcha');
$text_helptext = $this->language->get('text_helptext');
$text_send = $this->language->get('text_send');
$heading_title = '';
$special = '';
$price = '';
?>
 <div style="display:none">
           <div id="fast_order_form"  class="viewcategory">
            <input id="product_name" type="hidden" value="<?php echo $heading_title; ?>">
            <input id="product_price" type="hidden" value="<?php echo ($special ? $special : $price); ?>">
			
			
             <h1 id="singleclick_title"></h1>
             <p><b><?php echo $text_order; ?></b><br>
             <?php echo $text_helptext; ?></p>
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