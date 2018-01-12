<script type="text/javascript" src="/js/jquery.wmuGallery.js"></script>
<script type="text/javascript" src="/js/jquery.wmuslider.js"></script>
<script type="text/javascript" src="/js/modernizr.custom.min.js"></script>
<script type="text/javascript" src="/js/index.js"></script>

<div class="title"> <span> Магазин Smart Watches <br> Лучшие </span> <h1> умные часы - купить </h1> <span>Uwatch от 3290 рублей!</span> </div>

<div class="wmuSlider">
	<div class="wmuSliderWrapper">
		<div class="article">
			<a href="http://s-ws.ru/product/uwatchu10">
				<img src="/image/uwatchu10_2b.jpg" title="Uwatch U10" alt="Вы можете купить такие умные часы Uwatch U10" />
			</a>
		</div>
		<div class="article">
			<a href="http://s-ws.ru/product/uwatchuu">
				<img src="/image/uwatchuu_1b.jpg" title="Uwatch UU" alt="Вы можете купить такие умные часы Uwatch UU" />
			</a>
		</div>
		<div class="article">
			<a href="http://s-ws.ru/product/uwatchupro">
				<img src="/image/uwatchupro_3b.jpg" title="Uwatch Upro" alt="Вы можете купить такие умные часы Uwatch Upro" />
			</a>
		</div>						
	</div>
</div>

<? 
	function MakeList($str) {
	    echo "<ul>";
	    foreach (explode('|', $str) as $s)
	    {
	        $s = trim($s);
	        if (!$s) continue;
	        echo "<li>$s</li>";
	    }
	    echo "</ul>";
	} 
?>

<div id="content">

	<span class="like_h2">Новые модели</span>

	<ul class="products">
		<? 
			$k = 1;
			foreach ($goods as $g) {
			
				$alt = $title = '';
				$img = ProductImage::model()->findbyAttributes(array('url' => $g->url . '_1.jpg'));
				
				if ($img) {
					$alt = $img->alt;
					$title = $img->title;
				}

				$g->name = str_replace('Умные часы ', '', $g->name);
				$g->name = str_replace('Фитнес браслет ', '', $g->name);
		?>
				<li itemscope itemtype="http://schema.org/ImageObject" <?= $k%2==0 ? 'class="last glow"' : 'class="glow"'; ?>>
					<a href="http://s-ws.ru/product/<?= $g->url; ?>" class="image">
						<img itemprop="contentUrl" src="/image/<?= $g->url; ?>_1.jpg" alt="<?=$alt?>" title="<?= $title ?>" />
					</a>
					<a class="name like_h2" href="http://s-ws.ru/product/<?= $g->url; ?>" itemprop="name"><?= $g->name; ?></a>
					<div class="description" itemprop="description"><?= ($g->characteristics_on_main_page ? MakeList($g->characteristics_on_main_page) : '' ) ?></div>
					<div class="price"><?= $g->price; ?> руб</div>
				</li>
		<? 
				$k++;
			} 
		?>
	</ul>
	<div class="sp"></div>
</div>

<h2> Умные часы Uwatch - купить, сэкономив деньги </h2>

<div itemscope itemtype="http://schema.org/ImageObject">
	<p itemprop="description">
		<img itemprop="contentUrl" src="http://s-ws.ru/img/index/1.png" alt="Uwatch" id="uwatch_logo_img" />
		<b itemprop="name"> Uwatch </b> - часы с лучшим соотношением цена/качество. <br>
		Эта марка за несколько лет стала популярна на самом крупном рынке электроники - в Китае. <br>
		Теперь и россияне могут приобрести эти часы. <br>
		Выбирая умные часы, <b>купить Uwatch - выгодно</b>, Вы можете быть в этом уверены!
	</p>
</div>

<h2> Отзывы наших клиентов </h2>

<p>
	Часы, представленные в нашем магазине, не имеют такой большой наценки, как ближайшие конкуренты, однако, предлагают такие же функции. <br>
	В этом Вы сможете убедиться, прочитав отзывы наших клиентов в разделе <a href="http://s-ws.ru/reviews" class="link">Отзывы</a>. <br>
	Кроме того, это подтверждается отзывами обладателей Uwatch на форумах и в блогах. 
</p>

<h2> Мы - официальный представитель <b>Uwatch</b> </h2>

<p>
	Наш магазин - <b> первый в России </b> официальный представитель производителя этой марки часов. <br>
	Покупая у нас Вы можете быть уверены в качестве часов. <br>	
	Подробнее о нашем магазине Вы узнаете в разделе <a class="link" href="http://s-ws.ru/about">О магазине</a>.
</p>

<h2> <b>Бесплатная доставка</b> за <b> 4 часа </b>! </h2>

<p>
	<img src="/img/index/4.png" alt="После покупки умных часов доставка в течение 4 часов" id="hours"/>
	Мы предоставляем <b> бесплатную доставку </b> по всей территории России. <br>
	Доставка по Москве - также бесплатная и в течение 4 часов! <br>
	Подробнее о доставке Вы узнаете в разделе <a href="http://s-ws.ru/delivery" class="link">Доставка</a>.
</p>
<br />

<h2> Все модели работают с iOS и Андроид </h2>

<img src="/img/index/2.jpg" alt="Умные часы работают с iOS и Android" id="systems"/>

<br /><br />
<p>
	Наши клиенты часто задают вопрос, будут ли работать та или иная модель с их смартфоном. <br>
	<b> Все модели </b> работают с телефонами на iOS и Android. <br>
	Умные часы моментально синхронизируются с Вашим смартфоном. <br>
	И начинают работать с первых же минут использования.
</p>

<h2> Чем отличаются умные часы? </h2>

<div itemscope itemtype="http://schema.org/ImageObject">
	<img src="/img/index/3.jpg" itemprop="contentUrl" alt="Фото умных часов" id="about_smart_watches"/>
	<br /><br />
	<p itemprop="description"> Такие <span itemprop="name">часы</span> обладают большим количеством функций. Вот некоторые из них: </p>
</div>

<ul class="list">
	<li>Прием звонков</li>
	<li>Передавать уведомления с телефона</li>
	<li>Снимать фото и видео</li>
	<li>Работать независимо от телефона (поддержка SIM)</li>
	<li>Шагомер, барометр, высотомер и др.</li>
</ul>

<p> Выберите умные часы, купите и сможете их использовать как: </p>

<ul class="list">
	<li>Быстрый доступ к информации в телефоне</li>
	<li>Спортивный партнер</li>
	<li>Модный аксессуар</li>
	<li>Замена телефона</li>
</ul>

<h2> Мы всегда рады помочь! </h2>

<p style="text-align: center;">
	Вам нужна консультация или остались вопросы? <br> 
	Задайте их нашим менеджерам в разделе <a href="http://s-ws.ru/contact" class="link">Контакты</a>! <br>
	А также о нашей работе можете прочитать в разделе <a href="http://s-ws.ru/reviews" class="link">Отзывы</a>.
</p>

<div class="sp"></div>