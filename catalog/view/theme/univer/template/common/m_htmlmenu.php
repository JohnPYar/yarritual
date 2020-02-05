<?php 
if (($this->config->get('status_menu2') == '1') && (isset($this->document-> htmlmenu_t)) ){ ?>

<?php 
$topmenulink1 = $this->document-> htmlmenu_t[$this->config->get('config_language_id')]['topmenulink_lang'];
$topmenulink2 = $this->document-> htmlmenu_t[$this->config->get('config_language_id')]['topmenulink_custom'];
 ?> 

    <?php if ((isset($topmenulink1)) && ($topmenulink1 != '')){?>
    
<li class="custombox">
	<a><?php echo $topmenulink1; ?></a>

    <?php  if((isset($topmenulink2)) && ($topmenulink2 != '')){?>
    
		<div><?php echo htmlspecialchars_decode($topmenulink2, ENT_QUOTES ); ?></div>
        
    <?php } ?>
    
</li>

   <?php } ?>
   
<?php } ?>