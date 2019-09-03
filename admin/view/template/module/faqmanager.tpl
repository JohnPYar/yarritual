<?php echo $header; ?>
<link rel="stylesheet" type="text/css" href="view/stylesheet/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="view/stylesheet/adminuniver.css" />
<script src="view/javascript/univer/bootstrap.min.js"></script>
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
                <a onclick="location = '<?php echo $cancel; ?>';" class="btn btn-large"><?php echo $button_cancel; ?></a></div>
  </div>
  </div>
 <div id="customcontent">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form"  name="newsform">
   
    
      <div class="vtabs faq-tabs">
        <?php $module_row = 1; ?>
        <?php foreach ($modules as $module) { ?>
        <a href="#tab-module-<?php echo $module_row; ?>" id="module-<?php echo $module_row; ?>"><?php echo $tab_module . ' ' . $module_row; ?>&nbsp;<img src="view/image/delete.png" alt="" onclick="$('.vtabs a:first').trigger('click'); $('#module-<?php echo $module_row; ?>').remove(); $('#tab-module-<?php echo $module_row; ?>').remove(); return false;" /></a>
        <?php $module_row++; ?>
        <?php } ?>
        <span id="module-add"><?php echo $button_add_module; ?>&nbsp;<img src="view/image/add.png" alt="" onclick="addModule();" /></span> </div>
             
        
      <?php $module_row = 1; ?>
      <?php foreach ($modules as $module) { ?>
      <div id="tab-module-<?php echo $module_row; ?>" class="categorymodul vtabs-content">
      
      <div id="language-<?php echo $module_row; ?>" class="htabs htabs1-<?php echo $module_row; ?>">

<?php foreach ($languages as $language) { ?>
                  <a href="#tab-language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
<?php } ?>
</div>

<?php foreach ($languages as $language) { ?>

<div id="tab-language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>" class="tabs-content">
<table class="form">

          <tr>
            <td><?php echo $question_title; ?></td>
<td><input type="text" name="faqmanager_module[<?php echo $module_row; ?>][module_title][<?php echo $language['language_id']; ?>]" value="<?php echo isset($module['module_title'][$language['language_id']]) ? $module['module_title'][$language['language_id']] : ''; ?>" size="40" /></td>
</tr>
</table>
</div>
<?php } ?>
      
        <table class="all_topmenulink">
          <tr>
          
          <tr>
            <td><?php echo $entry_layout; ?></td>
            <td><?php echo $entry_position; ?></td> 
            <td><?php echo $entry_status; ?></td> 
            <td><?php echo $entry_sort_order; ?></td>
          </tr>
          <tr>  
            <td><select name="faqmanager_module[<?php echo $module_row; ?>][layout_id]">
                <?php foreach ($layouts as $layout) { ?>
                <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
         
            <td><select name="faqmanager_module[<?php echo $module_row; ?>][position]">
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
                  <?php if ($module['position'] == 'column_left') { ?>
                  <option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
                  <?php } else { ?>
                  <option value="column_left"><?php echo $text_column_left; ?></option>
                  <?php } ?>
                  <?php if ($module['position'] == 'column_right') { ?>
                  <option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
                  <?php } else { ?>
                  <option value="column_right"><?php echo $text_column_right; ?></option>
                  <?php } ?>
              </select></td>
  
            <td><select name="faqmanager_module[<?php echo $module_row; ?>][status]">
                <?php if ($module['status']) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
  
            <td><input type="text" name="faqmanager_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" class="shortfield"/></td>
          </tr>
        </table>
        <table id="section_<?php echo $module_row; ?>"  class="all_topmenulink">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_title_description; ?></td>
              <td class="left"></td>
            </tr>
          </thead>
          <?php $section_row = 0; ?>
          <?php foreach($module['sections'] as $section){ ?>
          <tbody id="section-row-<?php echo $module_row; ?>-<?php echo $section_row; ?>" class="section">
            <tr>
              
              <td class="left">
                <div id="language-<?php echo $module_row; ?>-<?php echo $section_row; ?>" class="htabs">
                  <?php foreach ($languages as $language) { ?>
                  <a href="#tab-language-<?php echo $module_row; ?>-<?php echo $section_row; ?>-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                  <?php } ?>
                </div>
                <?php foreach ($languages as $language) { ?>
                <div id="tab-language-<?php echo $module_row; ?>-<?php echo $section_row; ?>-<?php echo $language['language_id']; ?>"> <?php echo $text_title; ?>
                  <input  type="text" name="faqmanager_module[<?php echo $module_row; ?>][sections][<?php echo $section_row; ?>][title][<?php echo $language['language_id']; ?>]" id="title-<?php echo $module_row; ?>-<?php echo $section_row; ?>-<?php echo $language['language_id']; ?>" value="<?php echo isset($module['sections'][$section_row]['title'][$language['language_id']]) ? $module['sections'][$section_row]['title'][$language['language_id']] : ''; ?>"  />
                  <br />
                  <br />
                  <textarea name="faqmanager_module[<?php echo $module_row; ?>][sections][<?php echo $section_row; ?>][description][<?php echo $language['language_id']; ?>]" id="description-<?php echo $module_row; ?>-<?php echo $section_row; ?>-<?php echo $language['language_id']; ?>"><?php echo isset($module['sections'][$section_row]['description'][$language['language_id']]) ? $module['sections'][$section_row]['description'][$language['language_id']] : ''; ?></textarea>
                </div>
                <?php } ?></td>
              <td><a class="btn btn-danger" onclick="removeSection(<?php echo $module_row; ?>, <?php echo $section_row; ?>);">&times;</a></td>
            </tr>
          </tbody>
          <?php $section_row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="2"></td>
              <td><a class="btn btn-success" onclick="addSection(<?php echo $module_row; ?>);"><?php echo $button_add_section; ?></a></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <?php $module_row++; ?>
      <?php } ?>
     
    <input type="hidden" name="buttonForm" value="">
    </form>
 </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php $module_row = 1; ?>
<?php foreach ($modules as $module) { ?>
<?php $section_row = 0; ?>
<?php   foreach($module['sections'] as $section) { ?>
<?php      foreach ($languages as $language) { ?>
				CKEDITOR.replace('description-<?php echo $module_row; ?>-<?php echo $section_row;?>-<?php echo $language['language_id']; ?>', {
					filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
					filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
					filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
					filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
					filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
				});
				
				$('#language-<?php echo $module_row; ?>-<?php echo $section_row; ?> a').tabs();
<?php      } ?>
<?php   $section_row++; ?>
<?php   } ?>
<?php $module_row++; ?>
<?php } ?>
//--></script> 
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;
var section_row;

function addModule() {	
	section_row = 0;
	html  = '<div id="tab-module-' + module_row + '" class="categorymodul vtabs-content">';
	html += '    <div id="language-' + module_row + '" class="htabs htabs1-' + module_row + '">';
    <?php foreach ($languages as $language) { ?>
	html += '      <a href="#tab-language-' + module_row + '-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>';
    <?php } ?>
	html += '      </div>';
    <?php foreach ($languages as $language) { ?>
	html += '    <div id="tab-language-' + module_row + '-<?php echo $language['language_id']; ?>" class="tabs-content">';
    html += '    <table class="form">';
    html += '    <tr>';
    html += '    <td><?php echo $question_title; ?></td>';
    html += '    <td><input type="text" name="faqmanager_module[' + module_row + '][module_title][<?php echo $language['language_id']; ?>]" size="40" /></td>';
    html += '    </tr>';
    html += '    </table>';
	html += '      </div>';
    <?php } ?>
	html += '  <table class="all_topmenulink">';

	
	html += '    <tr>';
	html += '      <td><?php echo $entry_layout; ?></td>';
	html += '      <td><?php echo $entry_position; ?></td>';
	html += '      <td><?php echo $entry_status; ?></td>';
	html += '      <td><?php echo $entry_sort_order; ?></td>';	
	html += '    </tr>';
	html += '    <tr>';
	html += '      <td><select name="faqmanager_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '           <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
	<?php } ?>
	html += '      </select></td>';

	html += '      <td><select name="faqmanager_module[' + module_row + '][position]">';
html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '      </select></td>';

	html += '      <td><select name="faqmanager_module[' + module_row + '][status]">';
	html += '        <option value="1"><?php echo $text_enabled; ?></option>';
	html += '        <option value="0"><?php echo $text_disabled; ?></option>';
	html += '      </select></td>';

	html += '      <td><input type="text" name="faqmanager_module[' + module_row + '][sort_order]" value="" class="shortfield" /></td>';
	html += '    </tr>';
	html += '  </table>'; 
	
    html += '  <table id="section_' + module_row + '"  class="all_topmenulink">';
	html += '	 <thead>';
	html += '	    <tr>';
	html += '	       <td class="left"><?php echo $entry_title_description; ?></td>';
	html += '	       <td class="left"></td>';
	html += '	       <td class="left"></td>';
	html += '	    </tr>';
	html += '    </thead>';
	html += '    <tfoot>';
    html += '     <tr>';
	html += '         <td colspan="2"></td>';
    html += '         <td class="left"><a onclick="addSection(' + module_row + ');" class="btn btn-success"><?php echo $button_add_section; ?></a></td>';
    html += '     </tr>';
    html += '    </tfoot>';
    html += '  </table>';
	html += '</div>';
	
	$('#form').append(html);
	
	$('#language-' + module_row + ' a').tabs();
	
	$('#module-add').before('<a href="#tab-module-' + module_row + '" id="module-' + module_row + '"><?php echo $tab_module; ?> ' + module_row + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'.vtabs a:first\').trigger(\'click\'); $(\'#module-' + module_row + '\').remove(); $(\'#tab-module-' + module_row + '\').remove(); return false;" /></a>');
	
	$('.vtabs a').tabs();
	
	$('#module-' + module_row).trigger('click');
	
	module_row++;
}
//--></script> 
<script type="text/javascript"><!--
function addSection( module_number) {
	section_row = $('#tab-module-' + module_number + ' .section').length;
	html  = '<tbody id="section-row-' + module_number + '-' + section_row + '" class="section">';
	html += '  <tr>';
	html += '    <td class="left">';
	html += '  		<div id="language-' + module_row + '-' + section_row + '" class="htabs">';
					<?php foreach ($languages as $language) { ?>
    html += '    		<a href="#tab-language-'+ module_number  + '-' + section_row + '-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>';
					<?php } ?>
	html += '       </div>';
     
					<?php foreach ($languages as $language) { ?>
	html += '    	<div id="tab-language-'+ module_number + '-' + section_row + '-<?php echo $language['language_id']; ?>">';
	html += '          	<?php echo $text_title; ?><input  type="text" name="faqmanager_module[' + module_number + '][sections][' + section_row + '][title][<?php echo $language['language_id']; ?>]" id="title-' + module_number + '-' + section_row +'-<?php echo $language['language_id']; ?>"  /><br /><br />';
	html += '          	<textarea name="faqmanager_module[' + module_number + '][sections][' + section_row + '][description][<?php echo $language['language_id']; ?>]" id="description-' + module_number + '-' + section_row + '-<?php echo $language['language_id']; ?>"></textarea>';
	html += '    	</div>';
					<?php } ?>
	html += '    </td>';
	html += '    <td><a class="btn btn-danger" onclick="removeSection('+ module_number +',' + section_row +');">&times;</a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#section_' + module_number + ' tfoot').before(html);
	
	$('#language-' + module_row + '-' + section_row + ' a').tabs();
	
	
	<?php foreach ($languages as $language) { ?>
	CKEDITOR.replace('description-' + module_number + '-' + section_row + '-<?php echo $language['language_id']; ?>', {
		filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
	});  

	<?php } ?>
	
	section_row++;
}

function removeSection(module_number, section_number){
	$('#section-row-' + module_number + '-' + section_number).remove();
}

function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(text) {
						$('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};

//--></script> 
<script type="text/javascript"><!--
$('.vtabs a').tabs();
 <?php for ($i=0; $i<31; $i++) { ?>
$('.htabs1-<?php echo $i; ?> a').tabs();
   <?php } ?>	
   
 <?php for ($j=1; $j<11; $j++) { ?>
 <?php for ($k=0; $k<11; $k++) { ?>
$('#language-<?php echo $j; ?>-<?php echo $k; ?> a').tabs();
   <?php }
 }?>	   



//--></script> 
<script type="text/javascript"><!--
<?php $module_row = 1; ?>
<?php foreach ($modules as $module) { ?>
$('#language-<?php echo $module_row; ?> a').tabs();
<?php $module_row++; ?>
<?php } ?> 
//--></script> 
 <script type="text/javascript">
function buttonApply() {document.newsform.buttonForm.value='apply';$('#form').submit();}
</script>
<?php echo $footer; ?>