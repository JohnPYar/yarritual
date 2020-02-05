<?php if (count($languages) > 1) { ?>

<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="language_form">
  <div id="language"><span><?php echo $text_language; ?><b></b></span>
  <ul>
   <?php foreach ($languages as $language) { ?>
   <li> <a title="<?php echo $language['name']; ?>" onclick="$('input[name=\'language_code\']').attr('value', '<?php echo $language['code']; ?>'); $('#language_form').submit();"><img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>"  /> <?php echo $language['name']; ?></a></li>
   
    <?php } ?>
   </ul>
    <input type="hidden" name="language_code" value="" />
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
     
  </div>
</form>



<?php } ?>
