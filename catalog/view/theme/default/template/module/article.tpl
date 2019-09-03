<div class="box">
  <div class="box-content">
    <div class="box-category">
      <ul>
        <?php foreach ($articleies as $article) { ?>
        <li>
          <?php if ($article['article_id'] == $article_id) { ?>
          <img alt="" class="imgbord" src="/img/strelkale.png" style="position: absolute;margin-top: 14px;margin-left: 13px;"><a href="<?php echo $article['href']; ?>" class="active"><?php echo $article['name']; ?></a>
          <?php } else { ?>
          <a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a>
          <?php } ?>
          <ul>
            <?php if ($article['article_id']=="67") { ?>
             <li><a href="/catalogall/">Ритуальные принадлежности</a></li>
            <?php } ?>
          <?php if ($article['children']) { ?>
            <?php foreach ($article['children'] as $child) { ?>
            <li>
              <?php if ($child['article_id'] == $child_id) { ?>
              <a href="<?php echo $child['href']; ?>" class="active"><?php echo $child['name']; ?></a>
              <?php } else { ?>
              <a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>
              <?php } ?>
            </li>
            <?php } ?>
          <img alt="" class="imgbord" src="/img/linemenu.png" style="position: relative;left: 27px;">
          <?php } ?>
          </ul>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>

</div>
<img alt="" class="imgbord" src="/img/bord.png" style="position: relative;left: 85px;">
