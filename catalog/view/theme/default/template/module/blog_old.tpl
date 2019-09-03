
  <div class="slider" style="width: 1088px;margin: 0 auto;height: 475px;padding-left: 0px;">  
        <section class="first">
        <div>
          <span><a href="#slider1" class="next">Вперед</a></span>

          <span><a href="#slider1" class="prev">Назад</a></span>
          <div class="slidewrap">
            <ol class="slider" id="slider1">
            <?php foreach ($blogies as $blog) { ?>
              <li class="intro" id="slide" style="background: url('<?php echo $blog['thumb']; ?>');height: 475px;background-repeat: no-repeat;background-position: center;">
                <h2 style="width: 520px;margin: 0 auto;position: relative;top: 96px;font-size: 34px;font-weight: bold;right: 78px;color: #<?php echo $blog['color']; ?>;text-decoration: underline;"><?php echo $blog['name']; ?></h2>
                <div class="copy col-3"  style="width: 300px;margin: 0 auto;height: 205px;position: relative;top: 120px;right: 188px;color: #<?php echo $blog['color']; ?>;">
                  <span><?php echo $blog['description']; ?></span>

                </div>
                <div style="position: relative;top: 69px;"><a href="<?php echo $blog['meta']; ?>" title="Смотреть подробнее"><span style="background: url('/img/podr.png');width: 340px;height: 40px;display: block;margin: 0 auto;"></span></a></div>
              </li>
            <?php } ?>
            </ol>
          </div>
        </div>  
        </section>  
    </div>