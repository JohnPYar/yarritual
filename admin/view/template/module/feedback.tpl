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
  <?php if (isset($success)) { ?>
  <div class="success"><?php echo $success; ?></div>
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
    <div class="content  categorymodul">
	

	
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" name="newsform">
	  <div id="tab-modules">
        <table id="module"  class="all_topmenulink feed">
          <thead>
            <tr>
              <td><?php echo $entry_layout; ?></td>
              <td><?php echo $entry_position; ?></td>
              <td><?php echo $entry_status; ?></td>
			  <td><?php echo $entry_fields; ?></td>
			  <td><?php echo $entry_title; ?></td>
              <td class="right"><?php echo $entry_sort_order; ?></td>
              <td></td>
            </tr>
          </thead>
          <?php $module_row = 0; ?>
          <?php foreach ($modules as $module) { ?>
		  
          <tbody id="module-row<?php echo $module_row; ?>">
            <tr>
              <td>
			  <input type="hidden" value="<?php echo $module_row; ?>" name="feedback_module[<?php echo $module_row; ?>][id]" />
			  <select name="feedback_module[<?php echo $module_row; ?>][layout_id]">
                  <?php foreach ($layouts as $layout) { ?>
                  <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                  <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
              <td><select name="feedback_module[<?php echo $module_row; ?>][position]">
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
              <td><select name="feedback_module[<?php echo $module_row; ?>][status]">
                  <?php if ($module['status']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
				<td>
					<table class="ramka_name">
					<tr><td>
					<?php echo $txt_first_name; ?> </td><td><input type="checkbox" <?php echo (isset($module['name']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][name]" value="on" />
					</td></tr>
                    <tr>
					<td><?php echo $txt_email; ?></td> <td><input type="checkbox" <?php echo(isset($module['email']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][email]" value="on" />
                    </td></tr>
					<tr><td>
					<?php echo $txt_phone; ?></td> <td><input type="checkbox" <?php echo(isset($module['phone']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][phone]" value="on" />
                    </td></tr>
                    <tr>
					<td>
					<?php echo $txt_textarea; ?></td> <td><input type="checkbox" <?php echo(isset($module['text']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][text]" value="on" />
                    </td>
                    </tr>
					<tr><td>
					<?php echo $txt_captcha; ?></td> <td><input type="checkbox" <?php echo(isset($module['captcha']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][captcha]" value="on" />
					</td></tr></table>
				
					<table class="ramka_name" style="display:none;">
					<tr><td>
					<?php echo $txt_first_name; ?> <td><input type="checkbox" <?php echo(isset($module['r']['name']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][r][name]" value="on" />
					<tr><td>
					<?php echo $txt_email; ?> <td><input type="checkbox" <?php echo(isset($module['r']['email']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][r][email]" value="on" />
					<tr><td>
					<?php echo $txt_phone; ?> <td><input type="checkbox" <?php echo(isset($module['r']['phone']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][r][phone]" value="on" />
					<tr><td>
					<?php echo $txt_textarea; ?> <td><input type="checkbox" <?php echo(isset($module['r']['text']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][r][text]" value="on" />
					<tr><td>
					<?php echo $txt_captcha; ?> <td><input type="checkbox" checked disabled name="feedback_module[<?php echo $module_row; ?>][r][captcha]" value="on" />
					</table>
				</td>
			  <td>
				<?php foreach ($languages as $language) { ?>
					<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <input type="text" name="feedback_module[<?php echo $module_row; ?>][module_title][<?php echo $language['language_id']; ?>]" value="<?php echo $module['module_title'][$language['language_id']]; ?>" /><div class="clear"></div>
				<?php } ?>
			  </td>
              <td class="right"><input type="text" name="feedback_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" class="shortfield" /></td>
              <td><a onclick="$('#module-row<?php echo $module_row; ?>').remove();"  class="btn btn-danger">&times;</a></td>
            </tr>
          </tbody>
          <?php $module_row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="6"></td>
              <td><a onclick="addModule();" class="btn btn-success"><?php echo $button_add_module; ?></a></td>
            </tr>
          </tfoot>
        </table>
		</div>
		<div id="tab-settings">
		 <table class="form">
			<tr>
				<td><?php echo $txt_settings_min_phone; ?> - <?php echo $txt_settings_max_phone; ?>
				</td>
				<td><input type="text" name="feedback_settings[settings_min_phone]" value="<?php echo $settings['settings_min_phone']; ?>" class="shortfield"> - <input type="text" name="feedback_settings[settings_max_phone]" value="<?php echo $settings['settings_max_phone']; ?>" class="shortfield"></td>
			</tr>
			
			<tr>
				<td><?php echo $txt_settings_min_text; ?> - <?php echo $txt_settings_max_text; ?>
				</td>
				<td><input type="text" name="feedback_settings[settings_min_text]" value="<?php echo $settings['settings_min_text']; ?>" class="shortfield"> - <input type="text" name="feedback_settings[settings_max_text]" value="<?php echo $settings['settings_max_text']; ?>" class="shortfield"></td>
			</tr>
		
			<tr>
				<td><?php echo $txt_settings_success; ?>
				</td>
				<td>
				<?php foreach ($languages as $language) { ?>
				<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?>:
				<div class="clear"></div>
				<textarea name="feedback_settings[settings_success][<?php echo $language['language_id']; ?>]" rows=4 style="width: 400px;"><?php echo $settings['settings_success'][$language['language_id']]; ?></textarea>
				<div class="clear"></div>
				<?php } ?>
				</td>
			</tr>
		 </table>
		</div>
         <input type="hidden" name="buttonForm" value="">
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td>';
	html += '<input type="hidden" value="' + module_row + '" name="feedback_module[' + module_row + '][id]" />';
	html += '<select name="feedback_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td><select name="feedback_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td><select name="feedback_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '	<td>'+
					'<table class="ramka_name">'+
					'<tr><td>'+
					'<?php echo $txt_first_name; ?></td> <td><input type="checkbox" <?php echo(isset($module['name']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][name]" value="on" /></td></tr>'+
					'<tr><td>'+
					'<?php echo $txt_email; ?></td> <td><input type="checkbox" <?php echo(isset($module['email']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][email]" value="on" /></td></tr>'+
					'<tr><td>'+
					'<?php echo $txt_phone; ?></td> <td><input type="checkbox" <?php echo(isset($module['phone']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][phone]" value="on" /></td></tr>'+
					'<tr><td>'+
					'<?php echo $txt_textarea; ?></td> <td><input type="checkbox" <?php echo(isset($module['text']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][text]" value="on" /></td></tr>'+
					'<tr><td>'+
					'<?php echo $txt_captcha; ?></td> <td><input type="checkbox" <?php echo(isset($module['captcha']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][captcha]" value="on" /></td></tr>'+
					'</table>'+
					
					'<table class="ramka_name"  style="display:none;">'+
					'<tr><td>'+
					'<?php echo $txt_first_name; ?> <td><input type="checkbox" <?php echo(isset($module['r']['name']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][r][name]" value="on" />'+
					'<tr><td>'+
					'<?php echo $txt_email; ?> <td><input type="checkbox" <?php echo(isset($module['r']['email']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][r][email]" value="on" />'+
					'<tr><td>'+
					'<?php echo $txt_phone; ?> <td><input type="checkbox" <?php echo(isset($module['r']['phone']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][r][phone]" value="on" />'+
					'<tr><td>'+
					'<?php echo $txt_textarea; ?> <td><input type="checkbox" <?php echo(isset($module['r']['text']) ? 'checked' : '')?> name="feedback_module[<?php echo $module_row; ?>][r][text]" value="on" />'+
					'<tr><td>'+
					'<?php echo $txt_captcha; ?> <td><input type="checkbox" checked disabled name="feedback_module[<?php echo $module_row; ?>][r][captcha]" value="on" />'+
					'</table>'+
				'</td>';
				
	html += '	<td>';
	<?php foreach ($languages as $language) { ?>
	html += '	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />'+
			'	<input type="text" name="feedback_module['+ module_row +'][module_title][<?php echo $language['language_id']; ?>]" value="<?php echo $entry_feedback; ?>" /><div class="clear"></div>';
	<?php } ?>
	html += '	</td>';
	html += '    <td class="right"><input type="text" name="feedback_module[' + module_row + '][sort_order]" value=""  class="shortfield" /></td>';
	html += '    <td><a onclick="$(\'#module-row' + module_row + '\').remove();"  class="btn btn-danger">&times;</a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}


//--></script> 
<script type="text/javascript">
function buttonApply() {document.newsform.buttonForm.value='apply';$('#form').submit();}
</script>

 
<?php echo $footer; ?>