<?php if ($products) { ?>
<?php $product = $products[0];?>
              <td style="text-align: center;">
			  <?php if ($product['selected']) { ?>
                <input type="checkbox" id="<?php echo $product['product_id']; ?>" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" id="<?php echo $product['product_id']; ?>" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                <?php } ?>
				<label  for="<?php echo $product['product_id']; ?>" </label>
				</td>
              <td class="center id-column <?php echo ((isset($_COOKIE['id-column']) && $_COOKIE['id-column'] == 1)?'':'hide-column');?>"><?php echo $product['product_id']; ?></td>
              <td class="center product-image image-column <?php echo ((isset($_COOKIE['image-column']) && $_COOKIE['image-column'] == 1)?'':'hide-column');?>" rel="<?php echo $link;?>&type=change_image&product_id=<?php echo $product['product_id'];?>">

                <div class="image-wrapper">
                <a href="<?php echo $product['popup']; ?>" title="<?php echo $product['name']; ?>" class="colorbox" rel="colorbox">
                  <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" id="thumb-<?php echo $product['product_id'];?>"/>
                </a>
                <input type="hidden" name="image" value="<?php echo $product['image']; ?>" id="image-<?php echo $product['product_id'];?>" />								  
                </div>
				  <ul class="img_btns">
                    <li class="img_btn_edit"><a class="change-image"></a></li>
                    <li class="img_btn_clear"><a class="remove-image"></a></li>
                  </ul>
              </td>
              <td class="left product-name product-column <?php echo ((isset($_COOKIE['product-column']) && $_COOKIE['product-column'] == 1)?'':'hide-column');?>">
                <span class="product-name-wrapper"><?php echo $product['name']; ?></span>
                <input style="display: none;" type="text" size="20" orig="<?php echo $product['name']; ?>" rel="<?php echo $link;?>&type=change_name&product_id=<?php echo $product['product_id'];?>&language=<?php echo $selected_language;?>" name="model" value="<?php echo $product['name']; ?>"/>

                <a class="img_btn_goto" href="<?php echo $product['frontend']; ?>" target="_blank"></a>

              </td>
              <td class="left product-model model-column <?php echo ((isset($_COOKIE['model-column']) && $_COOKIE['model-column'] == 1)?'':'hide-column');?>">
                <input type="text" size="10" orig="<?php echo $product['model']; ?>" rel="<?php echo $link;?>&type=change_model&product_id=<?php echo $product['product_id'];?>" name="model" value="<?php echo $product['model']; ?>"/>
              </td>
              <td class="left categories category-column <?php echo ((isset($_COOKIE['category-column']) && $_COOKIE['category-column'] == 1)?'':'hide-column');?>" id="categories-for-<?php echo $product['product_id'];?>">
                <div class="category-cell">
                  <ul>
                  <?php if($product['categories']){?>
                    <?php foreach($product['categories'] as $k=>$category){?>
                      <?php if(isset($categories[$category])){;?>
                        <li class="cat-list" id="product-<?php echo $product['product_id'];?>-category-<?php $category;?>">
                          <a href="<?php echo $link;?>&type=remove_category&product_id=<?php echo $product['product_id'];?>&category_id=<?php echo $category;?>" class="remove-category" style="display: none;"></a>
                          <?php echo $categories[$category];?>
                        </li>
                      <?php };?>
                    <?php };?>
                  <?php };?>
                  </ul>
				  <a href="<?php echo $link;?>&type=add_category&product_id=<?php echo $product['product_id'];?>" class="add-category" style="display:none"></a>
                </div>
              </td>
              <td class="left product-manufacturer manufacturer-column <?php echo ((isset($_COOKIE['manufacturer-column']) && $_COOKIE['manufacturer-column'] == 1)?'':'hide-column');?>" rel="<?php echo $product['manufacturer_id'];?>" loc="<?php echo $link;?>&type=change_manufacturer&product_id=<?php echo $product['product_id'];?>"><?php echo (isset($manufacturers[$product['manufacturer_id']]))?$manufacturers[$product['manufacturer_id']]:''; ?></td>
              <?php if(count($stores) > 0){?>
              <td class="left stores stores-column <?php echo ((isset($_COOKIE['stores-column']) && $_COOKIE['stores-column'] == 1)?'':'hide-column');?>">
                <div>
                  <a href="<?php echo $link;?>&type=change_store&product_id=<?php echo $product['product_id'];?>&store_id=0" class="<?php echo (in_array(0, $product['stores']))?"included":"excluded";?>">
                    <?php echo $text_default;?>
                  </a>
                </div>
                <?php foreach($stores as $store){?>
                  <div>
                    <a href="<?php echo $link;?>&type=change_store&product_id=<?php echo $product['product_id'];?>&store_id=<?php echo $store['store_id'];?>" class="<?php echo (in_array($store['store_id'], $product['stores']))?"included":"excluded";?>">
                      <?php echo $store['name'];?>
                    </a>
                  </div>
                <?php };?>
              </td>
              <?php };?>
              <td class="right price price-column <?php echo ((isset($_COOKIE['price-column']) && $_COOKIE['price-column'] == 1)?'':'hide-column');?>">
                <input type="text" size="6" orig="<?php echo $product['price'];?>" rel="<?php echo $link;?>&type=change_price&product_id=<?php echo $product['product_id'];?>" name="quantity" value="<?php echo $product['price'];?>"/>
              </td>
              <td class="right frontend-price frontend-price-column <?php echo ((isset($_COOKIE['frontend-price-column']) && $_COOKIE['frontend-price-column'] == 1)?'':'hide-column');?>">
                <span class="gross"><?php echo number_format($product['frontend_price'][1], 4);?></span><br/>
                <span class="net"><?php echo number_format($product['frontend_price'][0], 4);?></span>
              </td>
              <td class="right quantity qty-column <?php echo ((isset($_COOKIE['qty-column']) && $_COOKIE['qty-column'] == 1)?'':'hide-column');?>">
                <?php if ($product['quantity'] <= 0) {
                  $class = "red";
                } elseif ($product['quantity'] <= 5) {
                  $class = "yellow";
                } else {
                  $class = "green";
                }?>
                <input type="text" size="4" orig="<?php echo $product['quantity'];?>" rel="<?php echo $link;?>&type=change_quantity&product_id=<?php echo $product['product_id'];?>" name="quantity" class="<?php echo $class;?>" value="<?php echo $product['quantity'];?>"/>
              </td>
              <td class="status left status-column <?php echo ((isset($_COOKIE['status-column']) && $_COOKIE['status-column'] == 1)?'':'hide-column');?>"><a href="<?php echo $link;?>&type=change_status&product_id=<?php echo $product['product_id'];?>&store_id=0" class="<?php echo ($product['status_int'] == 1 )?"included":"excluded";?>"></a></td>
              <td class="right sort_order order-column <?php echo ((isset($_COOKIE['order-column']) && $_COOKIE['order-column'] == 1)?'':'hide-column');?>">
                <input type="text" size="4" orig="<?php echo $product['sort_order'];?>" rel="<?php echo $link;?>&type=change_sort_order&product_id=<?php echo $product['product_id'];?>" name="sort_order" value="<?php echo $product['sort_order'];?>"/></td>
              <td class="center date date-column <?php echo ((isset($_COOKIE['date-column']) && $_COOKIE['date-column'] == 1)?'':'hide-column');?>">
                <?php echo $product['date_added'];?></td>
              <td class="right ">
			      <div class="nobr">
                  <span class="edit-column <?php echo ((isset($_COOKIE['edit-column']) && $_COOKIE['edit-column'] == 1)?'':'hide-column');?>"><a class="edit_link pe_action" href="<?php echo $product['action']; ?>" title="<?php echo $edit_link;?>"></a></span>
				  <span class="specials-column <?php echo ((isset($_COOKIE['specials-column']) && $_COOKIE['specials-column'] == 1)?'':'hide-column');?>"><a class="<?php echo ($product['hasSpecial'] == true)?'has_special ':'';?>special_link pe_action" href="<?php echo $link;?>&type=special_prices&product_id=<?php echo $product['product_id'];?>&t=special" title="<?php echo $special_link; ?>"></a></span>
				  <span class="discounts-column <?php echo ((isset($_COOKIE['discounts-column']) && $_COOKIE['discounts-column'] == 1)?'':'hide-column');?>"><a class="<?php echo ($product['hasDiscount'] == true)?'has_discount ':'';?>discount_link pe_action" href="<?php echo $link;?>&type=special_prices&product_id=<?php echo $product['product_id'];?>&t=discount" title="<?php echo $discount_link; ?>">%</a></span>
                  </div>
			  </td>
<?php } ?>