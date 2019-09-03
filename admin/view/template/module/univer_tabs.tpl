<?php echo $header; ?>
<link rel="stylesheet" type="text/css" href="view/stylesheet/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="view/stylesheet/adminuniver.css" />

<div id="content" class="matt-mod">

  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  
    <div class="navbar">
        <div class="navbar-inner">
				<span class="brand"><?php echo $heading_title; ?></span>
                
      <div class="buttons pull-right">
      <a onclick="$('#form').submit();" class="btn btn-success btn-large"><?php echo $button_save; ?></a>
       <a onclick="buttonApply();" class="btn btn-success btn-large"><?php echo $text_apply; ?></a>
      <a onclick="location = '<?php echo $cancel; ?>';" class="btn btn-large"><?php echo $button_cancel; ?></a>
      
      </div>
    </div>

      <div class="content categorymodul">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" name="newsform">
      
      <table id="module" class="list all_topmenulink">
          <thead>
            <tr>    <td class="left"><?php echo $entry_limit; ?></td>
                    <td class="left">Carousel</td>
			        <td class="left"><?php echo $entry_image; ?></td>
              <td class="left"><?php echo $entry_layout; ?></td>
              <td class="left"><?php echo $entry_position; ?></td>
              <td class="left"><?php echo $entry_status; ?></td>
              <td class="left"><?php echo $entry_sort_order; ?></td>
              <td></td>
            </tr>
          </thead>

        <!-- start body -->  

   <?php foreach ($modules as $module_row => $module) {?>
         <tbody univer_object="group" index1="<?php echo $module_row; ?>" >
            <tr>
                <td class="left">
                <input type="text" name="univer_tabs_module[<?php echo $module_row; ?>][limit]" value="<?php echo $module['limit']; ?>" class="shortfield" />
			       <?php if (isset($error_numproduct[$module_row])) { ?>
                  <span class="error"><?php echo $error_numproduct[$module_row]; ?></span>
                  <?php } ?></td>
                  <td class="left">
                  <select name="univer_tabs_module[<?php echo $module_row; ?>][carousel]">
                  <?php if ($module['carousel']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select><br />
            Visible limit <input type="text" name="univer_tabs_module[<?php echo $module_row; ?>][v_limit]" value="<?php echo $module['v_limit']; ?>" class="shortfield" />
                  </td>
			        <td class="left"><input type="text" name="univer_tabs_module[<?php echo $module_row; ?>][image_width]" value="<?php echo $module['image_width']; ?>" class="shortfield" />
                  <input type="text" name="univer_tabs_module[<?php echo $module_row; ?>][image_height]" value="<?php echo $module['image_height']; ?>" class="shortfield" />
                  <?php if (isset($error_image[$module_row])) { ?>
                  <span class="error"><?php echo $error_image[$module_row]; ?></span>
                  <?php } ?></td>
              
			        <td class="left"><select name="univer_tabs_module[<?php echo $module_row; ?>][layout_id]">
                  <?php foreach ($layouts as $layout) { ?>
                  <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                  <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
              <td class="left"><select name="univer_tabs_module[<?php echo $module_row; ?>][position]">
                  <?php if ($module['position'] == 'content_top') { ?>
                  <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
                  <?php } else { ?>
                  <option value="content_top"><?php echo $text_content_top; ?></option>
                  <?php } ?>
                  <?php if ($module['position'] == 'content_bottom') { ?>
                  <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
                  <?php } else { ?>
                  <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
                  <?php } ?>
                </select></td>
              <td class="left"><select name="univer_tabs_module[<?php echo $module_row; ?>][status]">
                  <?php if ($module['status']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              <td class="left"><input type="text" name="univer_tabs_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" class="shortfield" /></td>
            <td class="left"><a univer_object="del_group" index1="<?php echo $module_row; ?>" class="btn btn-danger">&times;</a>&nbsp;&nbsp; &nbsp; <a title="<?php echo $view_tab; ?>"><b><?php echo $view_tab; ?></b></a></td>
            </tr>
          </tbody>
          <?php } ?> 
          <tfoot>
            <tr>
              <td colspan="7"></td>
              <td class="left"><a onclick="addModule();" class="btn btn-success"><?php echo $button_add_module; ?></a></td>
            </tr>
          </tfoot>
        </table> 
      
        <!-- start tab -->  
      
        <table id="tab" class="all_topmenulink">
          <thead>
            <tr>
              <td><?php echo $tab_title; ?></td>
              <td style="width:50%"><?php echo $choose_products; ?></td>
              <td></td>
            </tr>
          </thead>

<?php foreach ($modules as $module_row => $module) {?>
    <?php foreach ($module['tabs'] as $tab_row => $tab) { ?>
   
          <tbody univer_object="tab" index1="<?php echo $module_row; ?>" index2="<?php echo $tab_row; ?>"> 
            <tr>	 
			      <td>
                 
   				<?php foreach ($languages as $language) { ?>
			  
				      <input 
				        name="univer_tabs_module[<?php echo $module_row; ?>][tabs][<?php echo $tab_row; ?>][title][<?php echo $language['language_id']; ?>]" 
				        value="<?php echo isset($tab['title'][$language['language_id']]) ? $tab['title'][$language['language_id']] : ''; ?>" />
				      <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br /><br />
				      <?php } ?>
				  </td>

              <td>

              <select 
                     univer_object="choose_products" index1="<?php echo $module_row; ?>" index2="<?php echo $tab_row; ?>"
                     name="univer_tabs_module[<?php echo $module_row; ?>][tabs][<?php echo $tab_row; ?>][filter_type]" >
				    <?php if ($tab['filter_type'] == 'special') { ?>
                  <option value="special" selected="selected"><?php echo $special_products; ?></option>
                  <?php } else { ?>
                  <option value="special"><?php echo $special_products; ?></option>
                  <?php } ?>
				    <?php if ($tab['filter_type'] == 'latest') { ?>
                  <option value="latest" selected="selected"><?php echo $latest_products; ?></option>
                  <?php } else { ?>
                  <option value="latest"><?php echo $latest_products; ?></option>
                  <?php } ?>
               <?php if ($tab['filter_type'] == 'popular') { ?>
                  <option value="popular" selected="selected"><?php echo $popular_products; ?></option>
                  <?php } else { ?>
                  <option value="popular"><?php echo $popular_products; ?></option>
                  <?php } ?>
				    <?php if ($tab['filter_type'] == 'bestseller') { ?>
                  <option value="bestseller" selected="selected"><?php echo $bestseller_products; ?></option>
                  <?php } else { ?>
                  <option value="bestseller"><?php echo $bestseller_products; ?></option>
                  <?php } ?>
				    <?php if ($tab['filter_type'] == 'category') { ?>
                  <option value="category" selected="selected"><?php echo $choose_category; ?></option>
                  <?php } else { ?>
                  <option value="category"><?php echo $choose_category; ?></option>
                  <?php } ?>
                </select>

            <div univer_category=<?php if ($tab['filter_type'] == 'category') { echo "yes"; } else { echo "no"; }; ?>   
                univer_object="choose_category" index1="<?php echo $module_row; ?>" index2="<?php echo $tab_row; ?>"
            >
				    <?php if (isset($error_category[$tab_row])) { ?>
                   <span class="error"><?php echo $error_category[$tab_row]; ?></span>
                <?php } ?>

				    <div class="scrollbox" id="scrollbox<?php echo $tab_row; ?>" style="height:200px !important;">  
					  <?php $class = 'odd'; ?>
					  <?php foreach ($categories as $category) { ?>
					  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					  <div class="<?php echo $class; ?>">
					  <input type="radio"  name="univer_tabs_module[<?php echo $module_row; ?>][tabs][<?php echo $tab_row; ?>][filter_type_category]" 
   					  value="<?php echo $category['category_id']; ?>" 
   					  <?php if (isset($tab['filter_type_category']) && $category['category_id'] == $tab['filter_type_category']) echo 'checked="checked"';  ?> />
					  <?php echo $category['name']; ?>

					  </div>

					  <?php } ?>
				    </div>

				    <?php //} ?>  
				</div>
				    </td>
               <td>
               <a univer_object="del_tab" index1="<?php echo $module_row; ?>" index2="<?php echo $tab_row; ?>" class="btn btn-danger">&times;</a> 
               </td>
            </tr>
          </tbody>
          <?php } ?>
    <?php } ?>
          <tfoot>
            <tr>
              <td colspan="2"></td>
        <tr>
          <td><a univer_object="add_tab" index1="<?php echo $module_row; ?>" class="btn btn-success"><?php echo $add_tab; ?></a></td>
        </tr>
            </tr>
          </tfoot>
        </table>	 
       <input type="hidden" name="buttonForm" value="">
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">

$('[univer_object=del_group]').on('click',function(){   

   var $r = $(this).attr('index1');

   $('[univer_object=group][index1=' + $r + ']').remove();
   $('[univer_object=tab][index1=' + $r + ']').remove();

   var $firstChoose = $('[univer_object=group]').eq(1).attr('index1')
   chooseTab($firstChoose);

});

$('[univer_object=del_tab]').on('click',function(){   

      var i1 = $(this).attr('index1');
      var i2 = $(this).attr('index2');
      var $tab = $('[univer_object = tab][index1=' + i1 + '][index2=' + i2 + ']')

      if ($tab.siblings('tbody').is('tbody')){
         $tab.remove();
      };
});

$('[univer_object=group]').on('click',function(){   
   var $curMod = $(this).attr('index1');
   chooseTab($curMod);
});

function chooseTab($curMod){

      $('[univer_object=group]').removeClass('selectedModule');   
      $('[univer_object=group][index1=' + $curMod + ']').addClass('selectedModule');   

      $('[univer_object=tab]').css("display","none");
      $('[univer_object=tab][index1=' + $curMod + ']').css("display","");   

//      	  if (select.options[select.selectedIndex].value == 'category') {

//      console.dir($('[univer_object=choose_products][index1=' + $curMod + ']').filter(':selected'));
//      console.dir($('[univer_object=choose_products][index1=' + $curMod + '] option').filter(':selected').filter('[value=category]'));

      $('[univer_category=no]').css("display","none");
      $('[univer_category=yes]').css("display","");
      
      $('[univer_object=add_tab]').attr('index1',$curMod);
};
 
 $(document).ready(function(){
	
   var $firstChoose = $('[univer_object=group]').eq(1).attr('index1')

   $('[univer_object=group][index1=0]').css("display","none");
   $('[univer_object=tab][index1=0]').css("display","none");
   chooseTab($firstChoose);

});

function addModule()
{
      var $curMod = Number($('[univer_object=group]').last().attr('index1')) + 1;

// module section
      var $clone = $('[univer_object=group][index1=0]').clone(-1,-1);
      $clone.attr('index1',$curMod);    
      $clone.find('[index1]').attr('index1',$curMod);    
      $clone.css("display","");
      $clone.insertAfter($('[univer_object=group]').last());
      $clone.find('input, select, textarea').each(function(indx){
         var nm = $(this).attr('name');
         $(this).attr('name',nm.replace('univer_tabs_module[0]','univer_tabs_module[' + $curMod + ']'));
      });

//tab section
      $clone = $('[univer_object=tab][index1=0]').clone(-1,-1);
      $clone.attr('index1',$curMod);    
      $clone.find('[index1]').attr('index1',$curMod); 

      $clone.find('input, select, textarea').each(function(indx){
         var nm = $(this).attr('name');
         $(this).attr('name',nm.replace('univer_tabs_module[0]','univer_tabs_module[' + $curMod + ']'));
      });

      $clone.css("display","");
//console.dir($clone);
      $clone.insertAfter($('[univer_object=tab]').last());
      chooseTab($curMod);
};

$('[univer_object=add_tab]').on('click',function(){   

      var $curMod = $(this).attr('index1');
      var $lastTab = $('[univer_object = tab][index1=' + $curMod + ']').last();
      var $curTab = Number($lastTab.attr('index2'))+1;
      var $clone = $('[univer_object = tab][index1=0][index2=0]').clone(-1,-1);

      $clone.find('input, select, textarea').each(function(indx){
         var nm = $(this).attr('name');
         $(this).attr('name',nm.replace('univer_tabs_module[0][tabs][0]','univer_tabs_module[' + $curMod + '][tabs][' + $curTab + ']'));
      });

      $clone.attr('index1',$curMod);
      $clone.attr('index2',$curTab);
      $clone.find('[index1]').attr('index1',$curMod); 
      $clone.find('[index2]').attr('index2',$curTab); 
      
      $clone.css("display","");
      $clone.insertAfter($lastTab);
});

$('[univer_object=choose_products]').on('click',function(){   

      var $curMod = $(this).attr('index1');
      var $curTab = $(this).attr('index2');
//      console.dir($('[univer_object=choose_category][index1=' + $curMod + '][index2=' $curTab + ']'));
      var $obj = $('[univer_object=choose_category][index1=' + $curMod + '][index2=' + $curTab + ']');
//      console.dir ($(this).children("option").filter(":selected").attr("value"));

	  if ($(this).children("option").filter(":selected").attr("value") == 'category') {
      $obj.attr('univer_category','yes')
      $obj.css('display','');
//console.dir($obj.find("input"));
      $obj.find("input").first().attr("checked","checked");
      } else {
      $obj.attr('univer_category','no')
      $obj.css('display','none');
      $obj.find("input").removeAttr("checked");
      }
   });

</script>

<script type="text/javascript">
function buttonApply() {document.newsform.buttonForm.value='apply';$('#form').submit();}
</script>
<?php echo $footer; ?>