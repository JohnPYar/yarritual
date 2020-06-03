<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
	<meta charset="UTF-8"/>

	<!--	<meta name="viewport" content="maximum-scale=1, user-scalable=yes, width=1100">-->
<!--	была эта строчка. не давала работать адаптиву -->

	<meta name="viewport" content="maximum-scale=1, user-scalable=yes, width=device-width">

	<title><?php echo $title; ?></title>
	<base href="<?php echo $base; ?>"/>
    <?php if ($description) { ?>
		 <meta name="description" content="<?php echo $description; ?>"/>
    <?php } ?>
    <?php if ($keywords) { ?>
		 <meta name="keywords" content="<?php echo $keywords; ?>"/>
    <?php } ?>
	<meta name="author" Content="opencart-cms.ru"/>
    <?php if ($icon) { ?>
		 <link href="<?php echo $icon; ?>" rel="icon"/>
    <?php } ?>
    <?php foreach ($links as $link) { ?>
		 <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>"/>
    <?php } ?>

	<!-- responsive style file -->
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/responsive/stylesheet/style-responsive.css"/>
    <?php foreach ($styles as $style) { ?>
		 <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>"
				 media="<?php echo $style['media']; ?>"/>
    <?php } ?>
	<link rel="author" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/humans.txt"/>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
	<meta name="copyright" content="http://opencart-cms.ru/">
	<meta name="author" content="http://opencart-cms.ru/">
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
	<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen"/>
	<script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>
	<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
	<script src="catalog/view/javascript/plugin.js" type="text/javascript"></script>


    <?php if (!isset($this->request->get['route'])) {
        $this->request->get['route'] = 'common/home';
    } ?>
    <?php if ($this->request->get['route'] == 'common/home') { ?>

	 <link rel="stylesheet" href="../../../../../../css/style_response.css" type="text/css"/>
		 <script type="text/javascript">
           $(document).ready(function () {
               $('.slidewrap').carousel({
                   slider: '.slider',
                   slide: 'li',
                   nextSlide: '.next',
                   prevSlide: '.prev',
                   auto: 3000,
                   speed: 300 // ms.
               });
           });
		 </script>

    <?php } else { ?>

		 <script type="text/javascript" src="catalog/view/javascript/jv_quickorder/jquery.validate.js"></script>
		 <script type="text/javascript"
					src="catalog/view/javascript/jv_quickorder/jquery.maskedinput-1.3.min.js"></script>
		 <script type="text/javascript" src="catalog/view/javascript/jv_quickorder/jv_quickorder.js"></script>
		 <script type="text/javascript" src="catalog/view/javascript/jv_bootstrap/bootstrap.min.js"></script>
    <?php } ?>
    <?php foreach ($scripts as $script) { ?>
		 <script type="text/javascript" src="<?php echo $script; ?>"></script>
    <?php } ?>
	<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie7.css"/>
	<![endif]-->
	<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie6.css"/>
	<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">
		DD_belatedPNG.fix('#logo img');
	</script>
	<![endif]-->
    <?php echo $google_analytics; ?>
	<link rel="stylesheet" type="text/css" href="/colorbox/colorbox.css" media="screen"/>
	<script type="text/javascript" src="/colorbox/jquery.colorbox-min.js"></script>
</head>
<body>
<div style="max-width: 1087px; margin: 0 auto;">
	<div id="global">
		<div class="header">
			<div class="container">
				<div class="head">
					<div itemscope itemtype="http://schema.org/Organization" class="head__top">
						<div class="head__left">
							<div class="company-name">
								<span itemprop="name">Похоронный дом "ЯрРитуалСервис"</span>
							</div>
							<div class="adress">
								<!--				  		<span style="-->
								<!--							 display: block;-->
								<!--							 position: relative;-->
								<!--							 top: -27px;-->
								<!--							 /* float: left; */-->
								<!--							 left: -41px;-->
								<!--							 font-size: 18px;-->
								<!--							 color: #E4E4E4;-->
								<!--							 text-shadow: 1px 1px 3px #000;-->
								<!--							">Похоронный дом "ЯрРитуалСервис"</span>-->
								<span itemprop="address"> <!--style="
							 position: relative;
							 top: -8px;
							 left: -18px;
							 color: #E4E4E4; text-shadow: 1px 1px 3px #000;
							 display: block;
							"-->г. Ярославль, ул. Салтыкова-Щедрина, 3 <br></span>
								<span itemprop="address"><!--style="
							 position: relative;
							 top: -8px;
							 left: -18px;
							 color: #E4E4E4;
							 text-shadow: 1px 1px 3px #000;
							 display: block;
							"-->г. Ярославль, Суздальское шоссе, 39</br>
									г. Ярославль, ул. Чкалова, 4 А (Траурный зал)</span>
							</div>
						</div>
                        <div class="head__logo">
							<div class="logo">
								<a href="/" title="Перейти на главную" class="logoheaderurl">
									<img src="catalog/view/theme/default/image/logo_new.png">
								</a>
							</div>
						</div>
						<div class="head__right">
							<span class="phone" style="
							 display: block;
							 /*height: 16px;*/
							 color: #E4E4E4; text-shadow: 1px 1px 3px #000;">
								<span style="
										 display: block;
										 /*text-align: end;*/
										 /*position: relative;*/
										 /*top: -77px;*/
										 /*left: 283px;*/
										 /* float: left; */
									">
									<span class="phone-code" style="
										 /*color: #E4E4E4; text-shadow: 1px 1px 3px #000;*/
										 /*position: relative;*/
										 /*left: -41px;*/
										 /*top: 60px;*/
										 /*font-size: 16px;*/
										 /*margin-right: 18px;*/
									">(4852)</span>
									<span itemprop="telephone" style="
										 /*color: #E4E4E4; text-shadow: 1px 1px 3px #000;*/
										 /*font-size: 37px;*/
										 /*position: relative;*/
										 /*top: 63px;*/
										 /*left: -23px;*/
									"><a class="phone-number" href="tel:+79019944449">944-449</a></span>
								</span>
								<span class="work-time" style="
									 /*color: #E4E4E4; text-shadow: 1px 1px 3px #000;*/
									 /*position: relative;*/
									 /*top: -10px;*/
									 /*left: 220px;*/
									 /*font-size: 18px;*/
									 /*margin-top: 10px;*/
									 /*display: block;*/
									 /*margin-top: 5px;*/
									">Работаем круглосуточно</span>
							</span>
						</div>
					</div>
					<div class="headmenu">
						<input type="checkbox" id="menu-checkbox">
						<div class="headmenu__wrapper">
							<label for="menu-checkbox" class="headmenu__trigger"></label>
							<div class="headmenu__container">
								<ul class="menu1">
									<li><a href='/' title="Перейти на главную">Главная</a></li>
									<li><a href='/yslugi' title="Организация похорон">Организация похорон</a></li>
								</ul>
								<ul class="menu2">
									<li><a href='/pamjatniki/' title="Памятники">Памятники</a></li>
									<li><a href='/contact-us/' title="Посмотреть наши контакты">Контакты</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="notification"></div>


</html>