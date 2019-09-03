<?php if ($commentpages) { ?>
<?php foreach ($commentpages as $commentpage) { ?>
<div class="content"><b><?php echo $commentpage['author']; ?></b> | <img src="catalog/view/theme/default/image/stars-<?php echo $commentpage['rating'] . '.png'; ?>" alt="<?php echo $commentpage['commentpages']; ?>" /><br />
  <?php echo $commentpage['date_added']; ?><br />
  <br />
  <?php echo $commentpage['text']; ?></div>
<?php } ?>
<div class="pagination"><?php echo $pagination; ?></div>
<?php } else { ?>
<div class="content"><?php echo $text_no_commentpages; ?></div>
<?php } ?>
