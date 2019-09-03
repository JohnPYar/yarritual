<?php if (($this->config->get('status_menu') == 1 ) && (isset($this->document->Top_m_link))) { ?>

<?php 	

$l_id = $this->config->get('config_language_id');
$Top_m_link = $this->document->Top_m_link;

   foreach ($Top_m_link as $item) { 
   if ((array_key_exists($l_id, $item['namelink'])) && $item['namelink'][$l_id] != ''){ 
      ?>
      <li>
   	  <a href="<?php echo $item['url']; ?>" title="<?php echo $item['namelink'][$l_id]; ?>"><?php echo $item['namelink'][$l_id]; ?></a>
      </li>
   <?php } 
   } ?>
<?php } ?>

						
