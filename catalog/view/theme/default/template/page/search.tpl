<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content" style="width: 690px; margin-left: 10px;  float:left; margin-bottom: 120px; "><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <b><?php echo $text_critea; ?></b>
  <div class="content">
    <p><?php echo $entry_search; ?>
      <?php if ($filter_name) { ?>
      <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" />
      <?php } else { ?>
      <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" />
      <?php } ?>
      <select name="filter_article_id">
        <option value="0"><?php echo $text_article; ?></option>
        <?php foreach ($categories as $article_1) { ?>
        <?php if ($article_1['article_id'] == $filter_article_id) { ?>
        <option value="<?php echo $article_1['article_id']; ?>" selected="selected"><?php echo $article_1['name']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $article_1['article_id']; ?>"><?php echo $article_1['name']; ?></option>
        <?php } ?>
        <?php foreach ($article_1['children'] as $article_2) { ?>
        <?php if ($article_2['article_id'] == $filter_article_id) { ?>
        <option value="<?php echo $article_2['article_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $article_2['name']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $article_2['article_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $article_2['name']; ?></option>
        <?php } ?>
        <?php foreach ($article_2['children'] as $article_3) { ?>
        <?php if ($article_3['article_id'] == $filter_article_id) { ?>
        <option value="<?php echo $article_3['article_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $article_3['name']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $article_3['article_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $article_3['name']; ?></option>
        <?php } ?>
        <?php } ?>
        <?php } ?>
        <?php } ?>
      </select>
      <?php if ($filter_sub_article) { ?>
      <input type="checkbox" name="filter_sub_article" value="1" id="sub_article" checked="checked" />
      <?php } else { ?>
      <input type="checkbox" name="filter_sub_article" value="1" id="sub_article" />
      <?php } ?>
      <label for="sub_article"><?php echo $text_sub_article; ?></label>
    </p>
    <?php if ($filter_description) { ?>
    <input type="checkbox" name="filter_description" value="1" id="description" checked="checked" />
    <?php } else { ?>
    <input type="checkbox" name="filter_description" value="1" id="description" />
    <?php } ?>
    <label for="description"><?php echo $entry_description; ?></label>
  </div>
  <div class="buttons">
    <div class="right"><a id="button-search" class="button"><span><?php echo $button_search; ?></span></a></div>
  </div>
  <h2><?php echo $text_search; ?></h2>
  <?php if ($pages) { ?>


  <div class="page-list">
    <?php foreach ($pages as $page) { ?>
    <div>
      <?php if ($page['thumb']) { ?>
      <div class="image"><a href="<?php echo $page['href']; ?>"><img src="<?php echo $page['thumb']; ?>" title="<?php echo $page['name']; ?>" alt="<?php echo $page['name']; ?>" /></a></div>
      <?php } ?>
      <div class="name"><a href="<?php echo $page['href']; ?>"><?php echo $page['name']; ?></a></div>
      <div class="description"><?php echo $page['description']; ?></div>
      <?php if ($page['rating']) { ?>
      <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $page['rating']; ?>.png" alt="<?php echo $page['reviews']; ?>" /></div>
      <?php } ?>
 </div>
    <?php } ?>
  </div>

  <div class="page-filter" style="clear: both;">
    <div class="limit" style="float:left;"><?php echo $text_limit; ?>
      <select onchange="location = this.value;">
        <?php foreach ($limits as $limits) { ?>
        <?php if ($limits['value'] == $limit) { ?>
        <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
    <div class="sort" style="margin-left: 5px; float:left;"><?php echo $text_sort; ?>
      <select onchange="location = this.value;">
        <?php foreach ($sorts as $sorts) { ?>
        <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
        <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
  </div>


  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <?php }?>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript">
$('#content input[name=\'filter_name\']').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('#button-search').bind('click', function() {
	url = 'index.php?route=page/search';

	var filter_name = $('#content input[name=\'filter_name\']').attr('value');

	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_category_id = $('#content select[name=\'filter_category_id\']').attr('value');

	if (filter_category_id > 0) {
		url += '&filter_category_id=' + encodeURIComponent(filter_category_id);
	}

	var filter_sub_category = $('#content input[name=\'filter_sub_category\']:checked').attr('value');

	if (filter_sub_category) {
		url += '&filter_sub_category=true';
	}

	var filter_description = $('#content input[name=\'filter_description\']:checked').attr('value');

	if (filter_description) {
		url += '&filter_description=true';
	}

	location = url;
});

</script>
<?php echo $footer; ?>