
<!-- вместо slideshow.tpl почему то слайдер сделан через blog.tpl-->

  <div class="slider">
        <section class="first">
		 <div class="slides-wrapper">
          <div class="slide-list">
			<?php foreach ($blogies as $blog) { ?>
			  <div class="slide-item" style="background: url('<?php echo $blog['thumb']; ?>');height: 475px;background-repeat: no-repeat;background-position: center;">
				<h2 style="width: 520px;margin: 0 auto;position: relative;top: 96px;font-size: 34px;font-weight: bold;right: 78px;color: #<?php echo $blog['color']; ?>;text-decoration: underline;"><?php echo $blog['name']; ?></h2>
                <div class="copy col-3"  style="width: 300px;margin: 0 auto;height: 205px;position: relative;top: 120px;right: 188px;color: #<?php echo $blog['color']; ?>;">
                  <span><?php echo $blog['description']; ?></span>
                </div>
                <div style="position: relative;top: 69px;"><a href="<?php echo $blog['meta']; ?>" title="Смотреть подробнее"><span style="background: url('/img/podr.png');width: 340px;height: 40px;display: block;margin: 0 auto;"></span></a></div>
			  </div>
			<?php } ?>
          </div>
		 </div>
		 <div class="clear-both"></div>
		 <div class="next-slide">Вперед</div>
		 <div class="prev-slide">Назад</div>
        </section>  
  </div>
	<script type="text/javascript" src="../catalog/view/javascript/custom.slider.js"></script>
	<script type="text/javascript">
		createSlider('.slider', {prev: '.prev-slide', next: '.next-slide', duration: 300, auto: 5000});
	</script>