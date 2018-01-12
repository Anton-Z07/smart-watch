 <script>
 	$(function(){
 		$('#send_button').click(function(){
 			var errors = false;
 			$('#contact_form input[type=text], #contact_form textarea').each(function(){
 				if (!$(this).val())
 				{
 					errors = true;
 					$(this).addClass('error');
 				}
 				else
 					$(this).removeClass('error');
 			});
 			if (!errors)
 				$('#contact_form').submit();
 		});
 	});
 </script>

<div itemscope itemtype="http://schema.org/Organization">

	<div class="title"> <h1> Контакты </h1> </div>

	<div class="contacts">

		<span class="like_h2" itemprop="name">Умные часы Smart Watches</span>

		<p>
			Электронная почта: <span itemprop="email">info@s-ws.ru</span><br>
			Телефон:  <span itemprop="telephone">8 985 338 14 28</span><br>
			Время работы: пн. - вс.: 8.00 - 22.00
		</p>

		<h2> Где мы находимся </h2>

		<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<p style="width: 286px !important">
				<span itemprop="postalCode">115522</span>
				<span itemprop="streetAddress">Каширское шоссе, 26</span>, 
				<span itemprop="addressLocality">Москва</span>
			</p>
		</div>
		<br>
		<p>
			<a href="http://s-ws.ru" class="link"> Купить умные часы</a> Вы сможете и приехав к нам. Где мы находимся:
		</p>
		<br>
		<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=yOSIVTn-zaEpQsKhs0rfK44xA1cJXNME&amp;height=450"></script>

		<? if (isset($_GET["success"])) 
			echo "<h6>Ваше сообщение отправление, спасибо</h6>	<br />";
		?>

		<h2> У Вас появились вопросы? Напишите нам! </h2>

		<form id="contact_form" method="POST" action="/site/SendMessage">
			<div>
				<input type="text" name="name" placeholder="Ваше имя"/>
			</div>
			<div>
				<input type="text" name="phone" placeholder="Телефон"/>
			</div>
			<div>
				<input type="text" name="email" placeholder="Email"/>
			</div>
			<div>
				<textarea name="text" placeholder="Текст сообщения"></textarea>
			</div>
			<div>
				<button type="button" id="send_button" class="submit">Отправить</button>
			</div>
		</form>
	</div>
</div>