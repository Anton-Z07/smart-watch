<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?= Page::GetHeadMetaString(); ?>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<style type="text/css">
			@import "/css/general.css";
			@import "/css/demo.css";
			@import "/css/inputs.css";
			@import "/css/dialog.css";
		</style>
		<style>
			<?= Page::getStyle() ?>
		</style>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/jquery.hoverIntent.js"></script>
		<script type="text/javascript" src="/js/superfish.js"></script>
		<script type="text/javascript" src="/js/cufon.js"></script>
		<script type="text/javascript" src="/js/jquery.maskedinput.js"></script>
		<script type="text/javascript" src="/js/dialog.js"></script>
		<script type="text/javascript" src="/js/jquery.form.js"></script>
    	<script type="text/javascript" src="/js/main.js"></script>
	</head>
	<body>
		<!-- BEGIN LAYOUT -->
		<div id="conteiner">
			<!-- BEGIN HEADER -->
			<div id="header">
				<button type="button" id="recall_button" class="button" onclick="ShowDialog('recall');">Заказать обратный звонок</button>
				<div class="left">
					<noindex>
						<div id="logo"><a href="http://s-ws.ru/"><img src="http://s-ws.ru/img/logo.png" alt="logo" /></a></div>
					</noindex>
					<span class="delimiter"></span>
					<noindex>
						<div id="slogan"><img src="http://s-ws.ru/img/approved.png" alt="Умные часы Smart Watches" /> Первый авторизованный магазин Uwatch в России</div>
					</noindex>
				</div>
				<? $cartData = Cart::GetData(); ?>
				<div class="right"> 
					<div id="phone"><div id="work_time">пн. - вс. 8:00 - 22:00</div> 8 985 338 14 28</div>
					<div id="mycart">
						<noindex>
							<a href="/cart" class="items"><?= $cartData['items']; ?></a><span class="prices"><span><?= $cartData['price']; ?></span> <a href="/cart" class="image"><img src="/css/images/myitems.jpg" width="22" height="18" alt="mycart" /></a></span> 
						</noindex>
					</div>
				</div>
				<div class="sp"></div>
			</div>
			<!-- END HEADER -->
			<!-- BEGIN NAVIGATION -->
			<div id="navigation">
				<?= isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== '/' ? '<noindex>' : '' ?>
					<ul>
						<li><a href="http://s-ws.ru/" class="item">Главная</a></li>
						<li><a href="http://s-ws.ru/delivery" class="item">Доставка</a> </li>
						<li><a href="http://s-ws.ru/warranty" class="item">Гарантия</a> </li>
						<li><a href="http://s-ws.ru/reviews" class="item">Отзывы</a> </li>
						<li><a href="http://s-ws.ru/about" class="item">О магазине</a>
						<li><a href="http://s-ws.ru/contact" class="item">Контакты</a>
					 	<li><a href="http://s-ws.ru/news" class="item">Новости</a>
					</ul>
				<?= isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== '/' ? '</noindex>' : '' ?>
			</div>
			<div id="main">
				<?= $content ?>
			</div>
			<div class="sp"></div>
		</div>
		<!-- BEGIN FOOTER -->
		<div id="footer">
			<div class="center">© 2015 s-ws.ru</div>
		</div>
		<!-- END FOOTER -->

		<div id="recall_dialog" class="dialog">
			<form method="POST" action="/site/QuickOrder" id="recall_form">
					<input type="hidden" name="item" value="Заказ обратного звонка" />
					<h4> Заказ обратного звонка </h4> <br />

					<div class="form_row">
						Укажите, пожалуйста, Ваш телефон и мы перезвоним Вам в <b>течение 3 минут</b>!
					</div>

					<br>

					<div class="form_row">
							<label> Телефон </label>
							<input type="text" name="phone" class="phone"/>
					</div>
					
					<br />
					<div class="dialog_buttons">
							<button type="button" onclick="HideDialog();" class="button button-gray">
									Отмена
							</button>
							<button type="button" onclick="Send('recall');" class="button">
									Заказать
							</button>
					</div>
			</form>
		</div>

		<div id="request_thank_dialog" class="dialog">
				<h4> Заказ отправлен </h4> <br />
				Спасибо за Ваш заказ! Мы свяжемся с Вами в ближайшее время.
		</div>

		<!-- Yandex.Metrika counter -->
		<script type="text/javascript">
			(function (d, w, c) {
					(w[c] = w[c] || []).push(function() {
							try {
									w.yaCounter27298619 = new Ya.Metrika({id:27298619,
													webvisor:true,
													clickmap:true,
													trackLinks:true,
													accurateTrackBounce:true});
							} catch(e) { }
					});

					var n = d.getElementsByTagName("script")[0],
							s = d.createElement("script"),
							f = function () { n.parentNode.insertBefore(s, n); };
					s.type = "text/javascript";
					s.async = true;
					s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

					if (w.opera == "[object Opera]") {
							d.addEventListener("DOMContentLoaded", f, false);
					} else { f(); }
			})(document, window, "yandex_metrika_callbacks");
		</script>
		<noscript><div><img src="//mc.yandex.ru/watch/27298619" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->

		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-60780933-1', 'auto');
			ga('send', 'pageview');
		</script>

	</body>
</html>