<?php
           $wayPath = 'catalog/view/theme/univer/template/';
?>

<?php echo $header; ?>
<?php if (isset($topcontent)) { ?>
<?php echo $topcontent; ?>
<?php } ?>

<?php if ($this->config->get('site_position') !== '1') { ?>
<?php echo $content_top; ?>
<?php } ?>


<?php echo $column_left; ?>
<?php echo $column_right; ?>
<div id="content">

<?php if ($this->config->get('site_position') == '1') { ?>
<?php echo $content_top; ?>
<?php } ?>

<h1 style="display: none;"><?php echo $heading_title; ?></h1>


<?php if ($this->config->get('site_position') !== '1') { ?>
  <?php echo $content_bottom; ?>
<?php } ?>
</div>

<?php if ($this->config->get('site_position') == '1') { ?>

  <div class="cont_bottom"></div>
  <?php echo $content_bottom; ?>

<?php } ?>


 
 <?php if ($this->config->get('comptext_status') == '1')  {
 include $wayPath ."/common/m_custombox.php"; 
 } ?>

<?php echo $footer; ?>