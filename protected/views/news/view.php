<style type="text/css" scoped>
    @import "/css/index.css"; 
    @import "/css/news.css";
    @import "/css/view.css";
</style>

<span class="left">
	<noindex>
		<a class="link" href="http://s-ws.ru/">Умные часы Smart Watches</a> &gt;&gt; <a class="link" href="http://s-ws.ru/news/">Новости</a> &gt;&gt; <span class="ext"><?= $n->title ?></span>
	</noindex>
</span>
<h1><?=$n->title;?></h1>
<div class="piece_of_news">
<? if ($n->image): ?>
<div class="image_holder">
	<img src="/img/news_images/<?=$n->image;?>" alt="<? $n->img_alt; ?>" />
</div>
<? endif; ?>
<div class="news_content"><?=$n->GetText();?>
<span class="news_date"><?=$n->GetDate();?></span>
<noindex>
	<div id="all"> <a class="link" href="/news">Все новости</a> </div>
</noindex>
</div>
</div>