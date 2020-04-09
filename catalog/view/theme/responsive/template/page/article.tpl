<?php echo $header; ?>
<div id="content"><?php echo $content_top; ?>
	<div class="container">
		<div class="breadcrumb">
          <?php foreach ($breadcrumbs as $breadcrumb) { ?>
              <?php echo $breadcrumb['separator']; ?><a
				 href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
          <?php } ?>
		</div>
		<h1><?php echo $heading_title; ?></h1>
		<img alt="" class="imgbord" src="/img/lenu.png" style="position: relative;margin-bottom: 40px;">
       <?php if ($description) {
           ?>
			 <div class="article-info" style="float: left;width: 640px;">
              <?php if ($thumb && $description) { ?>
					  <div class="image" style="float:left; margin-right: 5px;"><img src="<?php echo $thumb; ?>"
																										  alt="<?php echo $heading_title; ?>"/>
					  </div>
              <?php } ?>
              <?php if ($description) { ?>
                  <?php echo $description; ?>
              <?php } ?>
			 </div>
			 <div
				 style="float: left;width: 280px;margin-left: 20px;"><?php echo $column_right; ?><?php echo $column_left; ?></div>

			 <div style="clear: both; line-height: 1px;">&nbsp;</div>
       <?php } ?>







       <?php if ($pages) { ?>

			 <div class="page-list">
              <?php foreach ($pages as $page) { ?>
					  <div>
                     <?php if ($page['date_added']) { ?>
								<div style="font-size: 11px; color: #aaa;"><?php echo $page['date_added']; ?></div>
                     <?php } ?>

                     <?php if ($page['thumb']) { ?>
								<div class="image" style="float:left; margin-right: 5px;"><a
										href="<?php echo $page['href']; ?>"><img src="<?php echo $page['thumb']; ?>"
																							  title="<?php echo $page['name']; ?>"
																							  alt="<?php echo $page['name']; ?>"/></a></div>
                     <?php } ?>
						  <div class="name"><a href="<?php echo $page['href']; ?>"
													  style="font-size: 16px;"><?php echo $page['name']; ?></a></div>
						  <div class="description"><?php echo $page['description']; ?></div>

                     <?php if ($page['rating']) { ?>
								<div class="rating"><img
										src="catalog/view/theme/default/image/stars-<?php echo $page['rating']; ?>.png"
										alt="<?php echo $page['reviews']; ?>"/></div>
                     <?php } ?>


						  <div
							  style="font-size: 11px; color: #aaa;"><?php echo $text_commentpages; ?><?php echo $page['commentpages']; ?></div>
						  <div
							  style="font-size: 11px; color: #aaa;"><?php echo $text_viewed; ?><?php echo $page['viewed']; ?></div>


						  <div style="clear: both; line-height: 1px; margin-bottom: 5px;  border-bottom: 1px solid #BBB;">
							  &nbsp;
						  </div>

					  </div>
              <?php } ?>
			 </div>


			 <div class="page-filter">
				 <div class="limit" style="float:left;"><b><?php echo $text_limit; ?></b>
					 <select onchange="location = this.value;">
                    <?php foreach ($limits as $limits) { ?>
                        <?php if ($limits['value'] == $limit) { ?>
								  <option value="<?php echo $limits['href']; ?>"
											 selected="selected"><?php echo $limits['text']; ?></option>
                        <?php } else { ?>
								  <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                        <?php } ?>
                    <?php } ?>
					 </select>
				 </div>
				 <div class="sort" style="float:left; margin-left: 10px;"><b><?php echo $text_sort; ?></b>
					 <select onchange="location = this.value;">
                    <?php foreach ($sorts as $sorts) { ?>
                        <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
								  <option value="<?php echo $sorts['href']; ?>"
											 selected="selected"><?php echo $sorts['text']; ?></option>
                        <?php } else { ?>
								  <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                        <?php } ?>
                    <?php } ?>
					 </select>
				 </div>
			 </div>

			 <div class="pagination"><?php echo $pagination; ?></div>
       <?php } ?>
       <?php echo $content_bottom; ?></div></div>

<?php echo $footer; ?>