<div class="form-horizontal">
<h4><?php echo $text_header; ?></h4>
<hr />


 <div class="row-fluid">
   <div class="span2"><b><?php echo $text_contact_header; ?></b></div>
		<div class="span10">
			<?php 
			$valueq 	= $h_contact_status; $name	= 'h_contact_status'; $id = 'h_contact_status';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><br />
    
				
				 <table id="headericons">
    <?php 
	if(isset($mattheaders)){
	foreach($mattheaders as $header_row => $mattheader){  ?>
     <tbody  id="header<?php echo $header_row; ?>">
     <tr><td><div class="image">
              <img src="<?php echo $mattheader['thumb']; ?>" alt="" id="thumbheader<?php echo $header_row; ?>">
                <?php 
				$valueq 			= isset($mattheader['image']) ? $mattheader['image'] : '';
				$name			= 'mattheader[' . $header_row . '][image]';
				$id				= 'imageheader' . $header_row;
   			?>
	        		<input type="hidden" class='input-medium' placeholder="<?php echo $text_top_url; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $valueq; ?>">

                  <br>
                  <a onclick="image_upload('imageheader<?php echo $header_row; ?>', 'thumbheader<?php echo $header_row; ?>');"><?php echo $text_browse; ?>
                  </a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumbheader<?php echo $header_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#imageheader<?php echo $header_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a>
                </div></td>
                <td>
               <?php 
             foreach ($languages as $langId => $lang) {
               
                  if (!array_key_exists($lang['language_id'], $mattheader['title']))
                      $valueq = '';
                  else 
                    $valueq = isset($mattheader['title'][$lang['language_id']]) ? $mattheader['title'][$lang['language_id']] : '';
      				$name			= 'mattheader[' . $header_row . '][title][' . $lang['language_id'] . ']';
      				$id				= 'header-' . $header_row . '-title' . '-' . $lang['language_id'];
      			   ?>
                     <textarea  class="input-medium" placeholder="Text" name="<?php echo $name; ?>" ><?php echo $valueq; ?></textarea>
                     <img src="view/image/flags/<?php echo $lang['image']; ?>" title="<?php echo $lang['name']; ?>" ><br /><br />
                      <?php } ?>
                
                </td>
                <td><input  class="input-medium" type="text" name="mattheader[<?php echo $header_row; ?>][href]" value="<?php echo $mattheader['href']; ?>" /></td>
                <td><a onclick="$('#header<?php echo $header_row; ?>').remove();" class="btn btn-danger">&times;</a></td>
                </tr>
     </tbody>    
     <?php $header_row++; ?>
     <?php 
	   } 
	   } else  $header_row=0; ?>
             <tfoot>
            <tr>
              <td><label class="addHeader"><a class="btn btn-success"><?php echo $footer_add_icon; ?></a></label></td>
            </tr>
          </tfoot>
        </table>	   
        <br /><hr />
        
        <!--Top menu-->
<b><?php echo $text_menu_topmenu; ?></b><br /><br />
          <div class="row-fluid">
		<div class="span2"><?php echo $text_m_home; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $top_m_home; $name = 'top_m_home'; $id = 'top_m_home';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	   </div><hr />
       <div class="row-fluid">
		<div class="span2"><?php echo $text_m_welcome; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $top_m_welcome; $name = 'top_m_welcome'; $id = 'top_m_welcome';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	   </div><hr />
       <div class="row-fluid">
		<div class="span2"><?php echo $text_m_wishlist; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $top_m_wish; $name = 'top_m_wish'; $id = 'top_m_wish';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	   </div> <hr />
       <div class="row-fluid">
		<div class="span2"><?php echo $text_m_compare; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $top_m_compare; $name = 'top_m_compare'; $id = 'top_m_compare';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	   </div> <hr />
        <div class="row-fluid">
		<div class="span2"><?php echo $text_m_account; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $top_m_account; $name	= 'top_m_account'; $id = 'top_m_account';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><hr />       
      <div class="row-fluid">
		<div class="span2"><?php echo $text_m_cart; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $top_m_cart; $name	= 'top_m_cart'; $id = 'top_m_cart';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><hr /> 
     <div class="row-fluid">
		<div class="span2"><?php echo $text_m_checkout; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $top_m_checkout; $name	= 'top_m_checkout'; $id = 'top_m_checkout';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><hr />                        
        
       <div class="row-fluid">
		<div class="span2"><?php echo $text_m_brand; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $top_m_brand; $name	= 'top_m_brand'; $id = 'top_m_brand';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	   </div><hr />
       <div class="row-fluid">
		<div class="span2"><?php echo $text_m_spec; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $top_m_spec; $name = 'top_m_spec'; $id = 'top_m_spec';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	   </div><hr />
        <div class="row-fluid">
		<div class="span2"><?php echo $text_news; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $top_news; $name = 'top_news'; $id = 'top_news';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	   </div><hr />
        <table class="all_topmenulink2">
         <thead>
         <tr><td><?php echo $text_top_cusomlink; ?></td><td><?php echo $text_top_url; ?></td><td><?php echo $entry_sort_order; ?></td><td></td></tr></thead>
        	<?php	
          if(isset($mattlink2['Header_m_links'])){
	          foreach($mattlink2['Header_m_links'] as $linkId2 => $link){ 
      	       ?>
                <tbody id="numberlink2<?php echo $linkId2; ?>">
                <tr><td>
      			
      			<?php 
             foreach ($languages as $langId => $lang) {
               
                  if (array_key_exists($lang['language_id'], $link['namelink']))
                     $valueq = isset($link['namelink'][$lang['language_id']]) ? $link['namelink'][$lang['language_id']] : '';
                  else 
                     $valueq = '';
      				$name			= 'univerlinkheader[Header_m_links][' . $linkId2 . '][namelink][' . $lang['language_id'] . ']';
      				$id				= 'Header_m_links-' . $linkId2 . '-namelink' . '-' . $lang['language_id'];
      			   ?>
                     <input  type="text" class='input-medium' placeholder="<?php echo $text_top_cusomlink; ?>" name="<?php echo $name; ?>" value="<?php echo $valueq; ?>" >
                     <img src="view/image/flags/<?php echo $lang['image']; ?>" title="<?php echo $lang['name']; ?>" >
                      <?php } ?>
                     </td>
                     <td>
      			   <?php 
           
				$valueq 			= isset($link['url']) ? $link['url'] : '';
				$name			= 'univerlinkheader[Header_m_links][' . $linkId2 . '][url]';
				$id				= 'Header_m_links-' . $linkId2 . '-url';
   			?>
	        		<input type="text" class='input-medium' placeholder="<?php echo $text_top_url; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $valueq; ?>"></td>
                    <td>
            <?php 
				$valueq 			= isset($link['sort']) ? $link['sort'] : '';
				$name			= 'univerlinkheader[Header_m_links][' . $linkId2 . '][sort]';
				$id				= 'Header_m_links-' . $linkId2 . '-sort';
   			?>
	        		<input type="text" class='input-medium' placeholder="<?php echo $entry_sort_order; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $valueq; ?>">
           </td>
           <td>  
			   <a title="Remove" onclick="$('#numberlink2<?php echo $linkId2; ?>').remove();" class="btn btn-danger">&times;</a>

			   </td></tr>
            </tbody>
            	<?php  
            }     
			}
        	else $linkId2=0;
   	?>
            <tfoot>
            <tr><td><label class="control-label addNew2"><a class="btn btn-success"><?php echo $text_addlink; ?></a></label></td></tr>
            </tfoot>            </table> 
        
        
        
        </div>
        

<script type="text/javascript">
$('.addNew2 .btn').live('click', function(){
	addNewlink2();
});
var numberlink2 = <?php echo ++$linkId2; ?>;
function addNewlink2(){
		
	     html = '     <tbody id="numberlink2' + numberlink2 + '">';
		 html += '    <tr>'; 
		 html += '    <td>';
         <?php foreach ($languages as $language) { ?>
		
		 html += '    <input class="input-medium"  placeholder="<?php echo $text_top_cusomlink; ?>" type="text" name="univerlinkheader[Header_m_links][' + numberlink2 + '][namelink][<?php echo $language['language_id']; ?>]"  value="">';
		 html += '    <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" >';
		 
		  <?php } ?>
		 html += '	  </td>'; 
		 html += '	  <td>';
         html += '	  <input class="input-medium" title="URL" placeholder="<?php echo $text_top_url; ?>" type="text" name="univerlinkheader[Header_m_links][' + numberlink2 + '][url]"  value="">';
		 html += '	  </td>';
		 html += '	  <td>';
         html += '	  <input class="input-medium" title="Sort order" placeholder="<?php echo $entry_sort_order; ?>" type="text" name="univerlinkheader[Header_m_links][' + numberlink2 + '][sort]"  value="">';
	     html += '	  </td>';
		 html += '	  <td>';
	     html += '	<a title="Remove" onclick="$(\'#numberlink2' + numberlink2 + '\').remove();" class="btn btn-danger">&times;</a>';
		 html += '	</td></tr>';
		 html += '	</tbody>';
	
	$('.all_topmenulink2 tfoot').before(html);
	numberlink2++;
}

$('.addHeader .btn').live('click', function(){
	addHeaderIcon();
});
var header_row = <?php echo $header_row; ?>;

function addHeaderIcon(){
	   html  = '<tbody id="header' + header_row + '">';
       html += '<tr>';
       html += '<td><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumbheader' + header_row + '" /><input type="hidden" name="mattheader[' + header_row + '][image]" value="" id="imageheader' + header_row + '" ><br ><a onclick="image_upload(\'imageheader' + header_row + '\', \'thumbheader' + header_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumbheader' + header_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#imageheader' + header_row + '\').attr(\'value\', \'\');"><?php   echo $text_clear; ?></a></div></td>';
	    html += '	  <td>';
	     <?php foreach ($languages as $language) { ?>
	  html += '<textarea  class="input-medium" name="mattheader[' + header_row + '][title][<?php echo $language['language_id']; ?>]" placeholder="Text"></textarea>';
	  html += '    <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" ><br><br>';
	  	  <?php } ?>
		 html += '</td>';
	  html += '<td><input  class="input-medium" type="text" name="mattheader[' + header_row + '][href]" value="" placeholder="Link"></td>';
      html += '<td><a onclick="$(\'#header' + header_row  + '\').remove();" class="btn btn-danger">&times;</a></td>';
      html += '</tr>';
      html += '</tbody>'; 
	  
	  $('#headericons tfoot').before(html);
	header_row++;
}

</script>	

