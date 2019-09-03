<?php echo $header; ?>

  <div id="content">
      <div class="breadcrumb"><a href="/">Главная</a> - <a href="">Ритуальные принадлежности</a></div>
      <h1>Ритуальные принадлежности</h1>
      		<div class="categorylist">
				<table>
					<tr>
					<?php  foreach  ($categories as $category) { ?>
            <?php if ($category['category_id']!=="65") { ?>
  						<td><a href="<?php echo $category['href']; ?>" title=""><h4><?php echo $category['name']; ?></h4></a></td>
            <?php } ?>
					<?php } ?>
					</tr>
				</table>
			</div>
      <div class="categorycategory">
        <?php foreach ($categories as $category) { ?>
          <?php if ($category['category_id']!=="65") { ?>
          <div class="categorycase">
             <a href="<?php echo $category['href']; ?>" alt="Перейти в категорию <?php echo $category['name']; ?>" title="Перейти в категорию <?php echo $category['name']; ?>"><h2><?php echo $category['name']; ?></h2></a>
            <img src="/img/bord.png" class="imgbord" alt="">
            <h5><?php if ($category['descriptionshort']) { ?><?php echo $category['descriptionshort']; ?><?php } else { ?><?php echo $category['description']; ?><?php } ?></h5>
            <a href="<?php echo $category['href']; ?>" alt="Подробнее" title="Подробнее" class="imgpodra"><img src="/img/podr.png" class="imgpodr" alt="Подробнее" title="Подробнее"></a>
          </div>
          <?php } ?>
        <?php } ?>
      </div>
        <div>
<?php echo $footer; ?>