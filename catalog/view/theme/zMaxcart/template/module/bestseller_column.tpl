<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <div class="box-product">
      <?php foreach ($products as $product) { ?>
      <div class="sidebar">
        
        <table width="100%" border="0">
          <tr>
            <td rowspan="2" width="36px" height="36px">
                <?php if ($product['thumb']) { ?>
                <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
                <?php } ?>
            </td>
            <td><div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div></td>
          </tr>
          <tr>
            <td>
                <?php if ($product['price']) { ?>
                <div class="price">
                  <?php if (!$product['special']) { ?>
                  <?php echo $product['price']; ?>
                  <?php } else { ?>
                  <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                  <?php } ?>
                </div>
                <?php } ?>
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
                <?php if ($product['rating']) { ?>
                <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                <?php } ?>
            </td>
          </tr>
        </table>
        
      </div>
      <?php } ?>
    </div>
  </div>
</div>
