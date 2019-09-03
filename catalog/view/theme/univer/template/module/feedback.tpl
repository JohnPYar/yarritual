<div class="box">

	<div class="box-heading"><?php echo $heading_title; ?></div>

	<div class="box-content sidebar_feedback">
	
		<div id="webme_sidebar_feedback<?php echo $i; ?>" class="feedback_box">
			<div id="tmp_<?php echo $i; ?>"></div>
			<div id="wsf_enquiry_send_result<?php echo $i; ?>"></div>
		<div id="sidebar_feedback_div<?php echo $i; ?>">
		<form action="<?php echo str_replace('&', '&amp;', $action); ?>" method="post" enctype="multipart/form-data" id="sidebar_feedback<?php echo $i; ?>">
		<input type="hidden" id="form_id<?php echo $i; ?>" name="form_id" value="<?php echo $i; ?>" />
			
			<?php if (isset($setting['name'])) { ?>
			  <div class="field_feed1  field_name">
					
						<div></div>
						<input type="text" id="wsf_name<?php echo $i; ?>" name="wsf_name" title="<?php echo $entry_name; ?>" value="<?php echo (empty($name) ? $entry_name : $name); ?>" />
					
				  <span id="wsf_error_name<?php echo $i; ?>" class="warning" style="display:none;"></span>
				  </div>
			<?php } ?>
			<?php if (isset($setting['phone'])) { ?>
			  <div class="field_feed1 field_phone">
					
						<div></div>
						<input type="text" id="wsf_phone<?php echo $i; ?>" name="wsf_phone" title="<?php echo $entry_phone; ?>" value="<?php echo (empty($phone) ? $entry_phone : $phone); ?>" />
					
					<span id="wsf_error_phone<?php echo $i; ?>" class="warning" style="display:none;"></span>
				 </div>
			<?php } ?>
			<?php if (isset($setting['email'])) { ?>
			  <div class="field_feed1  field_email">
					
						<div></div>
						<input type="text" id="wsf_email<?php echo $i; ?>" name="wsf_email" title="<?php echo $entry_email; ?>" value="<?php echo (empty($email) ? $entry_email : $email); ?>" />
					
					<span id="wsf_error_email<?php echo $i; ?>" class="warning" style="display:none;"></span>
				  </div>
			<?php } ?>
			<?php if (isset($setting['text'])) { ?>
			  <div class="field_feed2">
					
						<textarea id="wsf_enquiry<?php echo $i; ?>"  title="<?php echo $entry_enquiry; ?>" name="wsf_enquiry"><?php echo (empty($enquiry) ? $entry_enquiry : $enquiry); ?></textarea>
					
				  <span id="wsf_error_enquiry<?php echo $i; ?>" class="warning" style="display:none;"></span>
				  </div>
			<?php } ?>
            <div class="field_feed3">
			<?php if (isset($setting['captcha'])) { ?>
            <div class="field_captcha">
             <input type="text" id="wsf_captcha<?php echo $i; ?>" name="wsf_captcha" class="captcha_feed" value="<?php echo $captcha; ?>" placeholder="<?php echo $entry_captcha; ?>" />  
             <div class="captcha_feed_image_div">
						<img id="wsf_captcha_image_img<?php echo $i; ?>" src="">
					</div>
             <a class="reload_captcha" id="reload_captcha<?php echo $i; ?>" title="<?php echo $reload_captcha; ?>"></a>
            <input type="hidden" id="wsf_captcha_id<?php echo $i; ?>" title="" name="wsf_captcha_id" value="<?php echo $captcha_id; ?>" />
          
             
					<span id="wsf_error_captcha<?php echo $i; ?>" class="warning" style="display:none;"></span>
					
				</div>
			<?php } ?>
			  <a class="button feedb" id="feedback_submitter<?php echo $i; ?>"><?php echo $button_send_enquiry; ?></a>
       
			  </div>

		</form>
		</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
$(document).ready(function() {
     	$('#webme_sidebar_feedback<?php echo $i; ?> input, #webme_sidebar_feedback<?php echo $i; ?> textarea').focus(function() {
		if ($(this).val() == $(this).attr('title')) {
			$(this).val('');
		}
	});
	$('#webme_sidebar_feedback<?php echo $i; ?> input, #webme_sidebar_feedback<?php echo $i; ?> textarea').blur(function() {
		if ($(this).val() == '') {
			$(this).val($(this).attr('title'));
		}
	});
	
	$('#webme_sidebar_feedback<?php echo $i; ?>').on('focus', 'input, textarea', function() {
		$(this).parent().find('.warning').delay(1000).fadeOut('slow');
	});
	
	$('#webme_sidebar_feedback<?php echo $i; ?>').on('click', '.warning', function() {
		$(this).fadeOut('slow');
	});
	
	jQuery.ajax({
		type: "GET",
		url: "<?php echo $captchaURLreload; ?>",
		data: {captcha_id: '<?php echo $captcha_id; ?>'},
		cache: false
	}).done(function( image ) {
		jQuery("#wsf_captcha_image_img<?php echo $i; ?>").attr('src', 'data:image/jpeg;base64,' + image);
	});
	
});

$('#wsf_captcha_image_img<?php echo $i; ?>').click(function(){
	var captcha_id = parseInt((Math.random() * 1000) + 1);
	jQuery('#wsf_captcha_id<?php echo $i; ?>').val(captcha_id);
	jQuery.ajax({
		type: "GET",
		url: "<?php echo $captchaURLreload; ?>",
		data: {captcha_id: captcha_id},
		cache: false
	}).done(function( image ) {
		jQuery("#wsf_captcha_image_img<?php echo $i; ?>").attr('src', 'data:image/jpeg;base64,' + image);
	});
});

$('#reload_captcha<?php echo $i; ?>').click(function(){
	var captcha_id = parseInt((Math.random() * 1000) + 1);
	jQuery('#wsf_captcha_id<?php echo $i; ?>').val(captcha_id);
	jQuery.ajax({
		type: "GET",
		url: "<?php echo $captchaURLreload; ?>",
		data: {captcha_id: captcha_id},
		cache: false
	}).done(function( image ) {
		jQuery("#wsf_captcha_image_img<?php echo $i; ?>").attr('src', 'data:image/jpeg;base64,' + image);
	});
});

$('#one_more_msg_href<?php echo $i; ?>').live('click', function(){
	$('#wsf_enquiry_send_result<?php echo $i; ?>').hide('fast', function() {; 
		$('#sidebar_feedback_div<?php echo $i; ?>').show('fast');
	});
});

$('#feedback_submitter<?php echo $i; ?>').click(function(){
	
	$("input, textarea").blur();
     if ($('#comment_feed<?php echo $i; ?>').val() == '<?php echo $entry_enquiry; ?>') {
			$('#wsf_error_enquiry<?php echo $i; ?>').html('<?php echo $entry_error_enquiry; ?>');
			$('#wsf_error_enquiry<?php echo $i; ?>').show();
			var error = true;
		}
		if ($('#wsf_name<?php echo $i; ?>').val() == '<?php echo $entry_name; ?>') {
			$('#wsf_error_name<?php echo $i; ?>').html('<?php echo $entry_error_name; ?>');
			$('#wsf_error_name<?php echo $i; ?>').show();
			var error = true;
		}
		if ($('#wsf_phone<?php echo $i; ?>').val() == '<?php echo $entry_phone; ?>') {
			$('#wsf_error_phone<?php echo $i; ?>').html('<?php echo $entry_error_phone; ?>');
			$('#wsf_error_phone<?php echo $i; ?>').show();
			var error = true;
		}
		if ($('#wsf_email<?php echo $i; ?>').val() == '<?php echo $entry_email; ?>') {
			$('#wsf_error_email<?php echo $i; ?>').html('<?php echo $entry_error_email; ?>');
			$('#wsf_error_email<?php echo $i; ?>').show();
			var error = true;
		}
		if (error == true) {
			return false;
		}
	
	$.ajax({
		type: 'post',
		url: '<?php echo $action; ?>',
		dataType: 'json',
		data: $('#sidebar_feedback<?php echo $i; ?>').serialize(),
		beforeSend: function() {
			$('#feedback_submitter<?php echo $i; ?>').after('<img src="<?php echo HTTP_SERVER; ?>/catalog/view/theme/univer/image/loading.gif" id="ajax_loading_form<?php echo $i; ?>" />');
		},
		complete: function() {
			$('#ajax_loading_form<?php echo $i; ?>').remove();
		},
		success: function(data) {
		
			if (data.error) {
			
				if (!data.error_name) { $('#wsf_error_name<?php echo $i; ?>').hide(); }
				if (!data.error_phone) { $('#wsf_error_phone<?php echo $i; ?>').hide(); }
				if (!data.error_email) { $('#wsf_error_email<?php echo $i; ?>').hide(); }
				if (!data.error_enquiry) { $('#wsf_error_enquiry<?php echo $i; ?>').hide(); }
				if (!data.error_captcha) { $('#wsf_error_captcha<?php echo $i; ?>').hide(); }
				
				if (data.error_required) { 
					alert(data.error_required); 
				}
				if (data.error_name) {
					$('#wsf_error_name<?php echo $i; ?>').html(data.error_name);
					$('#wsf_error_name<?php echo $i; ?>').show();
				}
				if (data.error_phone) {
					$('#wsf_error_phone<?php echo $i; ?>').html(data.error_phone);
					$('#wsf_error_phone<?php echo $i; ?>').show();
				}
				if (data.error_email) {
					$('#wsf_error_email<?php echo $i; ?>').html(data.error_email);
					$('#wsf_error_email<?php echo $i; ?>').show();
				}
				if (data.error_enquiry) {
					$('#wsf_error_enquiry<?php echo $i; ?>').html(data.error_enquiry);
					$('#wsf_error_enquiry<?php echo $i; ?>').show();
				}
				if (data.error_captcha) {
					$('#wsf_error_captcha<?php echo $i; ?>').html(data.error_captcha);
					$('#wsf_error_captcha<?php echo $i; ?>').show();
				}
			}
			
			if (data.success) {
				$('#wsf_error_name<?php echo $i; ?>').hide();
				$('#wsf_error_phone<?php echo $i; ?>').hide();
				$('#wsf_error_email<?php echo $i; ?>').hide();
				$('#wsf_error_enquiry<?php echo $i; ?>').hide();
				$('#wsf_error_captcha<?php echo $i; ?>').hide();
				
				$('#wsf_name<?php echo $i; ?>').val('');
				$('#wsf_phone<?php echo $i; ?>').val('');
				$('#wsf_email<?php echo $i; ?>').val('');
				$('#wsf_enquiry<?php echo $i; ?>').val('');
				$('#wsf_captcha<?php echo $i; ?>').val('');
				
				$('#sidebar_feedback_div<?php echo $i; ?>').hide();
				
				$('#wsf_enquiry_send_result<?php echo $i; ?>').html('<div class="success">' + data.result + '</div>');
				$('#wsf_enquiry_send_result<?php echo $i; ?>').show();
				
			}
			
			var captcha_id = parseInt((Math.random() * 1000) + 1);
			jQuery('#wsf_captcha_id<?php echo $i; ?>').val(captcha_id);
			jQuery.ajax({
				type: "GET",
				url: "<?php echo $captchaURLreload; ?>",
				data: {captcha_id: captcha_id},
				cache: false
			}).done(function( image ) {
				jQuery("#wsf_captcha_image_img<?php echo $i; ?>").attr('src', 'data:image/jpeg;base64,' + image);
			});
	
		}
	});
	

});
//--></script>

