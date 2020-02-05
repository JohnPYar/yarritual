<div class="box">

<?php
	
if ($borderless == FALSE) {
     echo $message;
}
else {
?>

  <div class="box-heading">
	<?php if($title) { echo $title; } else { echo "&nbsp;"; } ?>
  </div>	  
    <div class="box-content">
    <?php echo $message; ?>
  </div>

<?php
}
?>
</div>