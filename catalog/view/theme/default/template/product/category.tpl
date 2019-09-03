
<?php echo $header; ?><?php echo $column_right; ?>
<?php if ($category_view!=="1") { ?><?php echo $content_top; ?><?php } ?>
  <div id="content">
      <div class="breadcrumb">
          <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
          <?php } ?>
      </div>
      <h1 <?php if ($category_view=="1") { ?>style="margin-bottom: 10px;"<?php } ?>><?php echo $heading_title; ?></h1>
      <?php if ($category_id=="65") { ?>
        <?php } elseif (($category_id=="73") || ($category_view=="1")) { ?>
        <?php } elseif ($category_id=="74") { ?>
        <?php } else { ?>
          <div class="categorylist">
            <table>
              <tr>
              <?php if ($category_view!=="1") { ?>
                <?php for ($i = 0; $i < count($categories);) { ?>
                  <?php $j = $i + ceil(count($categories) / 4); ?>
                    <?php for (; $i < $j; $i++) { ?>
                    <?php if (isset($categories[$i])) { ?>
                      <?php if ($categories[$i]['category_id']!=="65") { ?>
                      	<td><a href="<?php echo $categories[$i]['href']; ?>" title="<?php echo $categories[$i]['name']; ?>"><h4><?php echo $categories[$i]['name']; ?></h4></a></td>
                    	<?php } ?> 
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              <?php } else { ?>
                <?php echo $content_top; ?>
              <?php } ?>
              <?php if ($category_view!=="1") { ?><?php echo $column_left; ?><?php } ?>
              </tr>
            </table>
          </div>
      <?php } ?>
      <?php if ($category_view=="1") { ?>
        <?php if ($categories) { ?>
          <div class="categorytovar">
            <?php foreach ($categories as $category) { ?>
              <a href="<?php echo $category['href']; ?>" title="Смотреть подробнее <?php echo $category['name']; ?>">
                <div class="categorytovarcase">
                  <img src="<?php if ($category['thumb']) { ?><?php echo $category['thumb']; ?><?php } else { ?>/image/no_image.jpg<?php } ?>" class="categorytovarcasepr" alt="<?php echo $category['name']; ?>">
                   <a href="<?php echo $category['href']; ?>" title="Смотреть подробнее <?php echo $category['name']; ?>"><h2><?php echo $category['name']; ?></h2>
                  <h5><?php if ($category['seo_h1']) { ?><?php echo $category['seo_h1']; ?><?php } else { ?><?php echo $category['description']; ?><?php } ?></h5>
                </div>
              </a> 
            <?php } ?>   
          </div>
        <?php } ?>
      <?php } else { ?>
        <?php if ($categories) { ?>
          <div class="categorycategory">
          <?php foreach ($categories as $category) { ?>
            <div class="categorycase">
              <a href="<?php echo $category['href']; ?>" alt="Перейти в категорию <?php echo $category['name']; ?>" title="Перейти в категорию <?php echo $category['name']; ?>"><h2><?php echo $category['name']; ?></h2></a>
              <img src="/img/bord.png" class="imgbord" alt="">
              <h5><?php if ($category['seo_h1']) { ?><?php echo $category['seo_h1']; ?><?php } else { ?><?php echo $category['description']; ?><?php } ?></h5>
              <a href="<?php echo $category['href']; ?>" alt="Подробнее" title="Подробнее" class="imgpodra"><img src="/img/podr.png" class="imgpodr" alt="Подробнее" title="Подробнее"></a>
            </div>
          <?php } ?>  
          </div>
        <?php } ?>
      <?php } ?>
      <?php if ($categories && $products) { ?>
        <img src="/img/footer.png" class="imgbord" alt="">
      <?php } ?>
      <?php if ($products) { ?>
        <div class="categorytovar">
        <?php foreach ($products as $product) { ?>
          <a href="<?php echo $product['href']; ?>" title="Смотреть подробнее <?php echo $product['name']; ?>">
            <div class="categorytovarcase">
              <img src="<?php if ($product['thumb']) { ?><?php echo $product['thumb']; ?><?php } else { ?>/image/no_image.jpg<?php } ?>" class="categorytovarcasepr" alt="<?php echo $product['name']; ?>">
               <a href="<?php echo $product['href']; ?>" title="Смотреть подробнее <?php echo $product['name']; ?>"><h2><?php echo $product['name']; ?></h2>
              <h5><?php if ($product['jan']) { ?><?php echo $product['jan']; ?><?php } else { ?><?php echo $product['description']; ?><?php } ?></h5>
              <?php if ($product['price']!=0) { ?>

              <? if (!$product['special']) { ?>
              <span class="price"><?php echo $product['price']; ?></span>

              <?php } else { ?>
              <span class="pod-price">
                
                <span class="old-price"><?php echo $product['price']; ?></span>
                <span class="new-price"><?php echo $product['special'] ?></span>
              </span>
              <?php } ?>


              <?php } else { ?><span style="display: block;margin: 0px auto;width: 228px;font-weight: bold;">Позвоните нам и уточните цену</span><?php } ?>
            </div>
          </a> 
        <?php } ?>   
        </div>
      <?php } ?>
      <?php if (($category_id=="73") || ($category_view=="1")) { ?>
      <?php } elseif ($category_id=="74") { ?>
      <?php } else { ?>
        <?php if (!$categories && !$products) { ?>
          <p style="display: block;color: #5f98c3;top: 0px;left: 0px;text-align: center;">Данная категория пуста!</p>
        <?php } ?>
        <div class="pagination"><?php echo $pagination; ?></div>
        <?php if ($description) { ?>
          <img src="/img/footer.png" class="imgbord" alt="">
        <?php } ?>
      <?php } ?>
        <?php if ($description) { ?>
          <?php echo $description; ?>
        <?php } ?>
    <div>
<?php echo $footer; ?>