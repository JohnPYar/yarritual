
<?php if (count($currencies) > 1) { ?>

    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="currency_form">
		<div id="currency"><span><?php echo $text_currency; ?><b></b></span>
        <ul>
			<?php foreach ($currencies as $currency) { ?>
    <?php if ($currency['code'] == $currency_code) { ?>
    <?php if ($currency['symbol_left']) { ?>
    <li><a title="<?php echo $currency['title']; ?>"><b><?php echo $currency['symbol_left']; ?> - <?php echo $currency['title']; ?></b></a></li>
    <?php } else { ?>
    <li><a title="<?php echo $currency['title']; ?>"><b><?php echo $currency['symbol_right']; ?> - <?php echo $currency['title']; ?></b></a></li>
    <?php } ?>
    <?php } else { ?>
    <?php if ($currency['symbol_left']) { ?>
    <li><a title="<?php echo $currency['title']; ?>" onclick="$('input[name=\'currency_code\']').attr('value', '<?php echo $currency['code']; ?>'); $('#currency_form').submit();"><?php echo $currency['symbol_left']; ?> - <?php echo $currency['title']; ?></a></li>
    <?php } else { ?>
   <li> <a title="<?php echo $currency['title']; ?>" onclick="$('input[name=\'currency_code\']').attr('value', '<?php echo $currency['code']; ?>'); $('#currency_form').submit();"><?php echo $currency['symbol_right']; ?> - <?php echo $currency['title']; ?></a></li>
    <?php } ?>
    <?php } ?>
    <?php } ?>
     </ul>
            <input type="hidden" name="currency_code" value="" />
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
           
		</div>
	</form>
 
    
<?php } ?>
				
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').customStyle12();
  });
 </script>  