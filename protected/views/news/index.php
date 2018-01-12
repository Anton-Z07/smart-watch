<div class="title">
	<h1>Новости</h1>
</div>

<? 
	foreach ($news as $n) { 
?>

	<div class="piece_of_news">
		
		<? if ($n->image): ?>
			<div class="image_holder">
				<img src="http://s-ws.ru/img/news_images/<?=$n->image;?>" alt="<?$n->img_alt;?>" />
			</div>
		<? endif; ?>

		<h2 class="title"><?=$n->title;?></h2>

		<span class="news_date"><?=$n->GetDate();?></span>

		<noindex>
			<div class="news_content"><?=$n->GetShortText();?></div>
		</noindex>

		<? if ($n->link): ?>
			<div class="read_all"> <a class="link" href="http://s-ws.ru/news/<?=$n->link;?>">Читать полностью</a> </div>
		<? else: ?>
			<div class="read_all"> <a class="link" href="http://s-ws.ru/news/view/<?=$n->id;?>">Читать полностью</a> </div>
		<? endif; ?>

	</div>

<? } ?>