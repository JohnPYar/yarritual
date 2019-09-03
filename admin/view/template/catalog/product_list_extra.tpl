<?php if(!isset($ajaxed)){?>
  <?php echo $header;?>
<div id="content">
<div class="breadcrumb">
        <a></a>
         :: <a><?php echo $heading_title;?></a>
      </div>
  <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
    <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="left"></div>
    <div class="right"></div>
    <div class="heading">
      <h1><?php echo $heading_title; ?></h1>
        <select name="language" class="language-selector" rel="<?php echo $link;?>">
          <?php foreach($languages->rows as $lng){?>
          <option value="<?php echo $lng['language_id'];?>" <?php echo ($lng['language_id'] == $selected_language)?"selected":"";?>><?php echo $lng['name'];?></option>
          <?php };?>
        </select>
      <div class="buttons">
        <a onclick="location = '<?php echo $insert; ?>'" class="button insert"><span><?php echo $button_insert; ?></span></a>
        <a onclick="$('#form-product-extra').attr('action', '<?php echo $copy; ?>'); $('#form-product-extra').submit();" class="button copy"><span><?php echo $button_copy; ?></span></a>
        <a onclick="if (!confirm('<?php echo $button_delete; ?>?')) { return false; } $('#form-product-extra').attr('action', 'index.php?route=catalog/product_extra/delete&token=<?php echo $token; ?>'); $('#form-product-extra').submit();" class="button delete"><span><?php echo $button_delete; ?></span></a>
        <a class="button columns-button"><span><?php echo $column_switch; ?></span></a>
      </div>
    </div>
    <div class="content">
      <div class="column-switcher <?php echo (((isset($_COOKIE['show-column-checkboxes']) && $_COOKIE['show-column-checkboxes'] == 1))?'':'hide-column');?>">
          <input type="checkbox" id="id-column" class="switcher" checked="checked" name="id-column"><label for="id-column">ID</label></br>
          <input type="checkbox" id="image-column" class="switcher" checked="checked" name="image-column"><label for="image-column"><?php echo $image_column_switch;?></label></br>
          <input type="checkbox" id="product-column" class="switcher" checked="checked" name="product-column"><label for="product-column"><?php echo $product_column_switch;?></label></br>
          <input type="checkbox" id="model-column" class="switcher" checked="checked" name="model-column"><label for="model-column"><?php echo $model_column_switch;?></label></br>
          <input type="checkbox" id="category-column" class="switcher" checked="checked" name="category-column"><label for="category-column"><?php echo $category_column_switch;?></label></br>
          <input type="checkbox" id="manufacturer-column" class="switcher" checked="checked" name="manufacturer-column"><label for="manufacturer-column"><?php echo $manufacturer_column_switch;?></label></br>
        <?php if(count($stores) > 0){?>
          <input type="checkbox" id="stores-column" class="switcher" checked="checked" name="stores-column"><label for="stores-column"><?php echo $stores_column_switch;?></label></br>
        <?php };?>
          <input type="checkbox" id="price-column" class="switcher" checked="checked" name="price-column"><label for="price-column"><?php echo $price_column_switch;?></label></br>
          <input type="checkbox" id="frontend-price-column" class="switcher" checked="checked" name="frontend-price-column"><label for="frontend-price-column"><?php echo $frontend_price_column_switch;?></label></br>
          <input type="checkbox" id="qty-column" class="switcher" checked="checked" name="qty-column"><label for="qty-column"><?php echo $qty_column_switch;?>v</br>
          <input type="checkbox" id="status-column" class="switcher" checked="checked" name="status-column"><label for="status-column"><?php echo $status_column_switch;?></label></br>
          <input type="checkbox" id="order-column" class="switcher" checked="checked" name="order-column"><label for="order-column"><?php echo $order_column_switch;?></label></br>
          <input type="checkbox" id="discounts-column" class="switcher" checked="checked" name="discounts-column"><label for="discounts-column"><?php echo $discounts_column_switch;?></label></br>
          <input type="checkbox" id="specials-column" class="switcher" checked="checked" name="specials-column"><label for="specials-column"><?php echo $specials_column_switch;?></label></br>
          <input type="checkbox" id="edit-column" class="switcher" checked="checked" name="edit-column"><label for="edit-column"><?php echo $edit_column_switch;?></label></br>
          <input type="checkbox" id="date-column" class="switcher" checked="checked" name="date-column"><label for="date-column"><?php echo $date_column_switch;?></label></br>
          <input type="checkbox" id="popup-edit" class="switcher" checked="checked" name="popup-edit"><label for="popup-edit"><?php echo $edit_column_popup_switch;?></label>
        </div>
      </div>
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-product-extra" current="index.php?route=catalog/product_extra&token=<?php echo $token; ?>">
<?php } /*End ajaxed */?>
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;">
			  <input type="checkbox" id="checkNormal" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
			  </div>
			  </td>
              <td class="left id-column <?php echo ((isset($_COOKIE['id-column']) && $_COOKIE['id-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.id') { ?>
                <a href="<?php echo $sort_id; ?>" class="<?php echo strtolower($order); ?>">ID</a>
                <?php } else { ?>
                <a href="<?php echo $sort_id; ?>" class="<?php echo strtolower($order); ?>">ID</a>
                <?php } ?></td>
              <td class="center image-column <?php echo ((isset($_COOKIE['image-column']) && $_COOKIE['image-column'] == 1)?'':'hide-column');?>"><?php echo $column_image; ?></td>
              <td class="left product-column <?php echo ((isset($_COOKIE['product-column']) && $_COOKIE['product-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'pd.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>" class="sorting"><?php echo $column_name; ?></a>
                <?php } ?></td>
              <td class="left model-column <?php echo ((isset($_COOKIE['model-column']) && $_COOKIE['model-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.model') { ?>
                <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_model; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_model; ?>" class="sorting"><?php echo $column_model; ?></a>
                <?php } ?></td>
              <td class="category-column <?php echo ((isset($_COOKIE['category-column']) && $_COOKIE['category-column'] == 1)?'':'hide-column');?>">
                <?php echo $column_category; ?>
              </td>
              <td class="left manufacturer-column <?php echo ((isset($_COOKIE['manufacturer-column']) && $_COOKIE['manufacturer-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'm.name') { ?>
                <a href="<?php echo $sort_manufacturer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_manufacturer; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_manufacturer; ?>" class="sorting"><?php echo $column_manufacturer; ?></a>
                <?php } ?></td>
              <?php if(count($stores) > 0){?>
              <td class="stores-column <?php echo ((isset($_COOKIE['stores-column']) && $_COOKIE['stores-column'] == 1)?'':'hide-column');?>">
                <?php echo $column_store; ?>
              </td>
              <?php };?>
              <td class="right price-column <?php echo ((isset($_COOKIE['price-column']) && $_COOKIE['price-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.price') { ?>
                <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_price; ?>" class="sorting"><?php echo $column_price; ?></a>
                <?php } ?></td>
              <td class="right frontend-price-column <?php echo ((isset($_COOKIE['frontend-price-column']) && $_COOKIE['frontend-price-column'] == 1)?'':'hide-column');?>">
                <?php echo $frontend_price; ?></a>
              </td>
              <td class="right qty-column <?php echo ((isset($_COOKIE['qty-column']) && $_COOKIE['qty-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.quantity') { ?>
                <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_quantity; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_quantity; ?>" class="sorting"><?php echo $column_quantity; ?></a>
                <?php } ?></td>
              <td class="left status-column <?php echo ((isset($_COOKIE['status-column']) && $_COOKIE['status-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>" class="sorting"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="left sort_order order-column <?php echo ((isset($_COOKIE['order-column']) && $_COOKIE['order-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.sort_order') { ?>
                <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_sort_order; ?>" class="sorting"><?php echo $column_sort_order; ?></a>
                <?php } ?></td>
              <td class="center date-column <?php echo ((isset($_COOKIE['date-column']) && $_COOKIE['date-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.date_added') { ?>
                <a href="<?php echo $sort_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date; ?>" class="sorting"><?php echo $column_date; ?></a>
                <?php } ?></td>
              <td class="right actions"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td class="id-column <?php echo ((isset($_COOKIE['id-column']) && $_COOKIE['id-column'] == 1)?'':'hide-column');?>"><input type="text" name="filter_id" class="filter" style="width: 20px;" value="<?php echo $filter_id; ?>" /></td>

              <td class="image-column <?php echo ((isset($_COOKIE['image-column']) && $_COOKIE['image-column'] == 1)?'':'hide-column');?>"><select name="filter_image" class="filter">
                  <option value="*"></option>
                  <?php if ($filter_image) { ?>
                  <option value="1" selected="selected"><?php echo $text_image; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_image; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_image) && !$filter_image) { ?>
                  <option value="-1" selected="selected"><?php echo $text_no_image; ?></option>
                  <?php } else { ?>
                  <option value="-1"><?php echo $text_no_image; ?></option>
                  <?php } ?>
                </select></td>

              <td class="product-column <?php echo ((isset($_COOKIE['product-column']) && $_COOKIE['product-column'] == 1)?'':'hide-column');?>"><input type="text" name="filter_name" class="filter" style="margin-right: 25px;" value="<?php echo $filter_name; ?>" /></td>
              <td class="model-column <?php echo ((isset($_COOKIE['model-column']) && $_COOKIE['model-column'] == 1)?'':'hide-column');?>"><input type="text" name="filter_model" class="filter" size="10" value="<?php echo $filter_model; ?>" /></td>
              <td class="category-column <?php echo ((isset($_COOKIE['category-column']) && $_COOKIE['category-column'] == 1)?'':'hide-column');?>">
                <select name="filter_category" class="filter">
                  <option value="*"></option>
                  <?php if ($filter_category == -1) { ?>
                    <option value="-1" selected="selected" ><?php echo $text_no_category; ?></option>
                  <?php } else { ?>
                    <option value="-1"><?php echo $text_no_category; ?></option>
                  <?php } ?>

                  <?php foreach($categories as $key=>$category){?>
                    <?php if ($filter_category == $key) { ?>
                      <option value="<?php echo $key;?>" selected="selected" ><?php echo $category;?></option>
                    <?php } else {?>
                      <option value="<?php echo $key;?>"><?php echo $category;?></option>
                    <?php }?>
                  <?php }?>
                </select>
              </td>
              <td class="manufacturer-column <?php echo ((isset($_COOKIE['manufacturer-column']) && $_COOKIE['manufacturer-column'] == 1)?'':'hide-column');?>">
                <select name="filter_manufacturer" class="filter">
                  <option value="*"></option>
                  <?php foreach($manufacturers as $key=>$manufacturer){?>
                    <?php if ($filter_manufacturer == $key) { ?>
                      <option selected="selected" value="<?php echo $key;?>"><?php echo $manufacturer;?></option>
                    <?php } else {?>
                      <option value="<?php echo $key;?>"><?php echo $manufacturer;?></option>
                    <?php }?>
                  <?php }?>
                </select>
              </td>
              <?php if(count($stores) > 0){?>
              <td class="stores-column <?php echo ((isset($_COOKIE['stores-column']) && $_COOKIE['stores-column'] == 1)?'':'hide-column');?>"><select name="filter_store" class="filter">
                  <option value="*"></option>
                  <?php if (is_numeric($filter_store) && $filter_store == 0) { ?>
                    <option value="0" selected="selected"><?php echo $text_default;?></option>
                  <?php } else { ?>
                    <option value="0"><?php echo $text_default;?></option>
                  <?php } ?>
                  
                  <?php foreach($stores as $store){?>
                    <?php if ($filter_store == $store['store_id']) { ?>
                      <option selected="selected" value="<?php echo $store['store_id'];?>"><?php echo $store['name'];?></option>
                    <?php } else { ?>
                      <option value="<?php echo $store['store_id'];?>"><?php echo $store['name'];?></option>
                    <?php } ?>
                    
                  <?php };?>
                </select></td>
              <?php };?>
              <td align="right" class="price-column <?php echo ((isset($_COOKIE['price-column']) && $_COOKIE['price-column'] == 1)?'':'hide-column');?>"><input class="filter" type="text" name="filter_price" size="6" value="<?php echo $filter_price; ?>" style="text-align: right;" /></td>
              <td align="right" class="frontend-price-column <?php echo ((isset($_COOKIE['frontend-price-column']) && $_COOKIE['frontend-price-column'] == 1)?'':'hide-column');?>"><span class="gross"><?php echo $frontend_price_gross;?></span><br/><span class="net"><?php echo $frontend_price_net;?></span></td>
              <td align="right" class="qty-column <?php echo ((isset($_COOKIE['qty-column']) && $_COOKIE['qty-column'] == 1)?'':'hide-column');?>"><input class="filter" type="text" name="filter_quantity" size="4" value="<?php echo $filter_quantity; ?>" style="text-align: right;" /></td>
              <td class="status-column <?php echo ((isset($_COOKIE['status-column']) && $_COOKIE['status-column'] == 1)?'':'hide-column');?>"><select name="filter_status" class="filter">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_status) && !$filter_status) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              <td align="right" class="order-column <?php echo ((isset($_COOKIE['order-column']) && $_COOKIE['order-column'] == 1)?'':'hide-column');?>"><input class="filter" type="text" name="filter_sort_order" size="4" value="<?php echo $filter_sort_order; ?>" style="text-align: right;" /></td>
              <td align="center" class="date-column <?php echo ((isset($_COOKIE['date-column']) && $_COOKIE['date-column'] == 1)?'':'hide-column');?>">
                <input class="filter date" type="text" name="filter_date_added" size="4" value="<?php echo $filter_date_added; ?>" style="text-align: center;" />
              </td>
              <td align="right"><a onclick="filter();" class="button bfilter"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($products) { ?>
            <?php foreach ($products as $product) { ?>
            <tr class="product-row">
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
                <input style="display: none;" type="text" orig="<?php echo $product['name']; ?>" rel="<?php echo $link;?>&type=change_name&product_id=<?php echo $product['product_id'];?>&language=<?php echo $selected_language;?>" name="model" value="<?php echo $product['name']; ?>"/>

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
              <td class="right nobr">
 			      <div class="nobr">
                  <span class="edit-column <?php echo ((isset($_COOKIE['edit-column']) && $_COOKIE['edit-column'] == 1)?'':'hide-column');?>"><a class="edit_link pe_action" href="<?php echo $product['action']; ?>" title="<?php echo $edit_link;?>"></a></span>
				  <span class="specials-column <?php echo ((isset($_COOKIE['specials-column']) && $_COOKIE['specials-column'] == 1)?'':'hide-column');?>"><a class="<?php echo ($product['hasSpecial'] == true)?'has_special ':'';?>special_link pe_action" href="<?php echo $link;?>&type=special_prices&product_id=<?php echo $product['product_id'];?>&t=special" title="<?php echo $special_link; ?>"></a></span>
				  <span class="discounts-column <?php echo ((isset($_COOKIE['discounts-column']) && $_COOKIE['discounts-column'] == 1)?'':'hide-column');?>"><a class="<?php echo ($product['hasDiscount'] == true)?'has_discount ':'';?>discount_link pe_action" href="<?php echo $link;?>&type=special_prices&product_id=<?php echo $product['product_id'];?>&t=discount" title="<?php echo $discount_link; ?>">%</a></span>
                  </div> </td>
              
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="14"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <div class="pagination">
		 <?php echo $pagination; ?>
          <div class="rows">
            <?php $page_rows = array(20,50,100);?>
            <?php echo $rows_in_table;?><select name="rows-per-page" id="rows-per-page">
              <?php foreach($page_rows as $row){;?>
                <option <?php echo (isset($current_rows) && $current_rows == $row)?'selected="selected"':'';?> value="<?php echo $row;?>"><?php echo $row;?></option>
              <?php };?>
            </select>
          </div>
        </div>
<?php if(!isset($ajaxed)) {?>
      </form>
    </div>
    
  </div>
<script type="text/javascript"><!--
$('.colorbox').colorbox({
	overlayClose: true,
	opacity: 0.5
});
//--></script>
<script type="text/javascript"><!--
function filter() {

    url = 'index.php?route=catalog/product_extra&token=<?php echo $token; ?>';

    var filter_id = $('input[name=\'filter_id\']').attr('value');
    if (filter_id) {
        url += '&filter_id=' + encodeURIComponent(filter_id);
    }

    var filter_image = $('select[name=\'filter_image\']').val();
    if (typeof(filter_image) != 'undefined' && filter_image != '*') {
        url += '&filter_image=' + encodeURIComponent(filter_image);
    }

    var filter_name = $('input[name=\'filter_name\']').attr('value');
    if (filter_name) {
        url += '&filter_name=' + encodeURIComponent(filter_name);
    }

    var filter_model = $('input[name=\'filter_model\']').attr('value');
    if (filter_model) {
        url += '&filter_model=' + encodeURIComponent(filter_model);
    }

    var filter_quantity = $('input[name=\'filter_quantity\']').attr('value');
    if (filter_quantity) {
        url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
    }
          
    var filter_status = $('select[name=\'filter_status\']').attr('value');
    if (filter_status != '*') {
        url += '&filter_status=' + encodeURIComponent(filter_status);
    }

    var filter_store = $('select[name=\'filter_store\']').val();
    if (typeof(filter_store) != 'undefined' &&filter_store != '*') {
        url += '&filter_store=' + encodeURIComponent(filter_store);
    }

    var filter_category = $('select[name=\'filter_category\']').val();
    if (typeof(filter_category) != 'undefined' &&filter_category != '*') {
        url += '&filter_category=' + encodeURIComponent(filter_category);
    }
          
    var filter_manufacturer = $('select[name=\'filter_manufacturer\']').val();
    if (typeof(filter_manufacturer) != 'undefined' &&filter_manufacturer != '*') {
        url += '&filter_manufacturer=' + encodeURIComponent(filter_manufacturer);
    }

    var filter_price = $('input[name=\'filter_price\']').attr('value');
    if (filter_price) {
        url += '&filter_price=' + encodeURIComponent(filter_price);
    }

    var filter_sort_order = $('input[name=\'filter_sort_order\']').attr('value');
    if (filter_sort_order) {
        url += '&filter_sort_order=' + encodeURIComponent(filter_sort_order);
    }

    var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');
    if (filter_date_added) {
        url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
    }

    //Handling ajaxed filter
    ajaxified(url);
    $('#form').attr('current', url);
    //location = url;

}
//--></script>
  
  <script type="text/javascript"><!--
  var token = '<?php echo $token; ?>';
  var no_image = '<?php echo $no_image; ?>';
  var text_product_manager = '<?php echo $text_product_manager; ?>';
  $(document).ready(function() {
    $('.add-category').live('click', function(e){
      e.preventDefault();
      var a = $(this);
      var td = a.parents('td');
      var product_id = $(this).parents('tr').find(':input:first').val();
      var title = $(this).parents('tr').find('.product-name').text();
      var model = $(this).parents('tr').find('.product-model').text();
      var categorySelect = $('select[name="filter_category"]').clone();
      categorySelect.attr({'multiple':true});
	  categorySelect.attr("style", "height: 100%;");
      categorySelect.find('option:first').remove();
      var popupLink = $(this).attr('href')+'&rand='+Math.floor(Math.random()*1100000);
      var cdialog = $('<div id="popup-window" class="hidden"></div>').append(categorySelect).appendTo('body');
      cdialog.dialog({
        title: title+' &raquo; '+model,
        modal: true,
        draggable: true,
        resizable: true,
        width: 600,
        height: 400,
        buttons: [{
          text: "<?php echo $s_button;?>",
	  class: "uibutton_s",	  
	  click: function() {
            var dialog = $(this);
            var cat_id = $('#popup-window select :selected').map(function(){return $(this).val();}).get();
            var cat_name = $('#popup-window select :selected').map(function(){return $(this).text();}).get();
            $.post(popupLink+'&category_id='+cat_id.toString(), function(response){
              var cat_node_template = $('#cat-node-template').clone().html();
              for(i in cat_id){
                if($('#product-'+product_id+'-category-'+cat_id[i]).length === 0){
                  var cat_node = cat_node_template.replace(/--p--/gi, product_id).replace(/--c--/gi, cat_id[i]).replace(/--cc--/gi, cat_name[i]);
                  $('#categories-for-'+product_id+' ul').append(cat_node);
                }
              }
              dialog.dialog("close"); dialog.remove();
              td.addClass('updated');
              setTimeout(function(){td.removeClass('updated')}, 1500);
            })
            //$(this).dialog("close"); $(this).remove();
          }},{
          text: "<?php echo $c_button;?>",
	  click: function(){
            $(this).dialog("close"); $(this).remove();
          },
        }],
        close: function(){$(this).remove();}
      });
    })
    
    $("li.cat-list").live("mouseover mouseout", function(event) {
      if ( event.type == "mouseover" ) {
        $(this).find('.remove-category').show();
      } else {
        $(this).find('.remove-category').hide();
      }
    });
    $("td.categories").live("mouseover mouseout", function(event) {
      if ( event.type == "mouseover" ) {
        $(this).find('.add-category').show();
      } else {
        $(this).find('.add-category').hide();
      }
    });
    $('.remove-category').live('click', function(e){
      var a = $(this);
      var td = a.parents('td');
      e.preventDefault();
      $.get($(this).attr('href'), function($response){
        a.parent().fadeOut(null, function(){
          a.parent().remove();
          td.addClass('updated');
          setTimeout(function(){td.removeClass('updated')}, 1500);
        });
      })
    })
  });

    $('tr.filter input').live('keydown', function(e) {
        if (e.keyCode == 13) {
            filter();
        }
    });

    $('tr.filter input[name!=\'filter_date_added\']').live('focusout', function(e) {
        filter();
    });

    $('tr.filter input[name=\'filter_date_added\']').live('focus', function(){
        $(this).datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    $('.product-row :input').live('keydown', function(e) {
        if (e.keyCode == 13) {
            $(this).trigger('blur');
            $(this).focus();
            return false;
        }
    });

  $('a.special_link, a.discount_link').live('click', function(e){
    e.preventDefault();
    var title = $(this).parents('tr').find('.product-name').text();
    var model = $(this).parents('tr').find('.product-model').text();
    var popupLink = $(this).attr('href')+'&popup=true&rand='+Math.floor(Math.random()*1100000);
    $('<div id="popup-window" class="hidden"></div>').appendTo('body')
        .load(popupLink,null, function(){
          $(this).dialog({
            title: title+' &raquo; '+model,
            modal: true,
            draggable: true,
            resizable: true,
            width: 950,
            height: 500,
            buttons: [{
                text: "<?php echo $s_button;?>",
		class: "uibutton_s",
		click: function() {
                $.post(popupLink, $('#popup-form').serialize(), function(response){
                  $('#popup-window').dialog({title:'<span style="color:red"><?php echo $saved;?></span>'});
                  setTimeout(function(){
                    $('#popup-window').dialog({title:title+' &raquo; '+model});
                                       }, 1500)
                  
                  $('#popup-window').html(response);
                         })
                //$(this).dialog("close"); $(this).remove();
              } },{
              text: "<?php echo $c_button;?>",
              click: function(){
                $(this).dialog("close"); $(this).remove();
                               },
                 }],

           close: function(){$(this).remove();}
          });
        });
  });
  //--></script>

<script type="text/javascript"><!--
$(document).ready(function() {
    $('.date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>

  <ul style="display: none;" id="cat-node-template">
    <li class="cat-list" id="product---p---category---c--">
      <a href="<?php echo $link;?>&type=remove_category&product_id=--p--&category_id=--c--" class="remove-category" style="display: none;"></a>
      --cc--
    </li>
  </ul>
</div>
<?php echo $footer;?>
<?php }?>
