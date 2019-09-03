<?php if(!empty($tabs)){ ?>
<?php
$this->language->load('module/category');
$heading_title = $this->language->get('heading_title');
$this->language->load('module/univertheme');
$button_quick = $this->language->get('entry_quickview');
?>


<div class="box dropdown_category <?php if ( (isset($position)) && ($position == 'column_right')){ ?>position_right<?php } ?>
                                  <?php if ( (isset($position)) && ($position != 'column_right') && ($position != 'column_left')){ ?>position_center<?php } ?>">
    <div class="box-heading"><?php echo $heading_title; ?></div>
	<div class="box-content">
		<div class="box-category accordeon_categ" id="categmenu<?php echo $module; ?>">
        
         <?php 
              if (count($tabs) < 5) {
              $numb_li = 1;
              $col_numb = count($tabs);
              } else if ((ceil(count($tabs) / 3)) == (floor(count($tabs) / 3))) {
              $numb_li = (ceil(count($tabs) / 3));
              $col_numb = 3;
              } else if ((ceil(count($tabs) / 4)) == (floor(count($tabs) / 4))) {
              $numb_li = (ceil(count($tabs) / 4));
              $col_numb = 4;
              } else {
               $numb_li = (ceil(count($tabs) / 3));
                $col_numb =  ceil(count($tabs)/ $numb_li );
              }
          ?>
         
         <?php for ($k = 0; $k < count($tabs);) { ?>
        <ul class="col_numb_<?php echo $col_numb; ?>">
       
		<?php $j = $k + $numb_li; ?>
        <?php for (; $k < $j; $k++) { ?>
          <?php  if (isset($tabs[$k]['name'])) { ?>
		  <li <?php  if ($tabs[$k]['image'] ) { ?>class="display_img"<?php } ?>> 
          
          	
              <a href="<?php echo $tabs[$k]['href']; ?>" 
                      <?php  if (($tabs[$k]['title']) || ($tabs[$k]['image']) || (($tabs[$k]['children']) && ($tabs[$k]['subcateg'] == '1' )) ) { ?> 
                        class="dropdown_arr" 
                      <?php } ?>>
                       
                        
                       
                       
                       <span><?php echo $tabs[$k]['name']; ?></span></a>
          
                       

            <!--Drowp down-->            
           <div class="all_subcat">
             
             <?php  if ($tabs[$k]['image'] ) { ?>
             <a href="<?php echo $tabs[$k]['href']; ?>" ><img src="<?php echo $tabs[$k]['image']; ?>" alt="<?php echo $tabs[$k]['name']; ?>" class="img_categ"></a>
             <?php } ?>
          
             <?php  if ($tabs[$k]['title'])  { ?>
             <div class="description_categ"><?php echo html_entity_decode($tabs[$k]['title']); ?></div> 
             <?php } ?> 
           
             <!--Sucategory--> 
             <?php if (($tabs[$k]['children']) && ($tabs[$k]['subcateg'] == '1' )) { ?>

              <div class="sub_category_child  <?php if ($tabs[$k]['column'] == '0' ){ ?>two_column <?php } ?>"> 

         
         <ul class="subcateg_show_box"> 
          <?php for ($i = 0; $i < count( $tabs[$k]['children']); $i++) { ?>
                 <?php if (isset($tabs[$k]['children'][$i])) { ?>
                  <li>  
                  <a href="<?php echo $tabs[$k]['children'][$i]['href']; ?>"><?php echo $tabs[$k]['children'][$i]['name']; ?></a>
                  <?php if( $tabs[$k]['children'][$i]['children'] ) { ?>
                  <span class="dropdown_arr"></span>
                  <div>
                    <ul>
                    <?php foreach( $tabs[$k]['children'][$i]['children'] as $menu3item ) { ?>
                    <li><a href="<?php echo $menu3item['href']; ?>"><?php echo $menu3item['name']; ?></a></li>
                    <?php } ?>
                    </ul>
                  </div>
                <?php } ?>
                </li>
             
          <?php } ?>
          <?php } ?>
        </ul>
         <?php if (isset($tabs[$k]['children'][0])) { ?>
        <div class="subcateg_show"><a class="minus readmore"><?php echo $text_hide; ?></a><a class="plus readmore">+</a></div>
        <?php } ?>

          </div>
             <?php } ?> 
             <!--end Subcategory-->
             
           
             </div>
             <!--end Drowp down-->  
       
        
        
        </li>
         <?php } ?>
        
		<?php } ?>
	 </ul>
      <?php } ?>	
  </div>
  </div>

  </div>

 


<?php } ?>


