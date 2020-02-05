<?php
$this->language->load('module/univertheme');
$heading_title = $this->language->get('all_brand');
?>

<div id="carousel<?php echo $module; ?>" class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <ul class="jcarousel-skin-opencart">
    <?php foreach ($banners as $banner) { ?>
    <li><a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" /></a></li>
    <?php } ?>
  </ul>
</div>
<script type="text/javascript"><!--
$('#carousel<?php echo $module; ?> ul').jcarousel({
	vertical: false,
	visible: <?php echo $limit; ?>,
	scroll: <?php echo $scroll; ?>
});
//--></script>