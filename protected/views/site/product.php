<?
function MakeList($str) {
		echo "<ul>";
		foreach (explode('|', $str) as $s) {
				$s = trim($s);
				if (!$s) continue;
				echo "<li>$s</li>";
		}
		echo "</ul>";
}

function RenderChars($product, $limit, $offset=0)
{
	if ($product->grouped_characteristics)
	{
		$arr = json_decode($product->grouped_characteristics, 1);
		foreach ($arr as $title => $a)
		{
			if ($offset)
			{
				$offset--;
				continue;
			}
			echo "<h4>$title</h4>";
			foreach ($a as $k => $v)
			{
				echo "<div><label><div class='sign'>$k</div></label><span>$v</span></div>";
			}
			if (--$limit == 0)
				break;
		}
		$count = (count($arr) - 2 ) / 2 ;
	}
}

function RenderHalfRow($product, $n = 0)
{
	if (!$product->grouped_characteristics)
		return;
	$arr = json_decode($product->grouped_characteristics, 1);
	$count = (count($arr) - 2 ) / 2 ;
	$offset = 2 + $n * $count;
	$limit = 999;
	if (!$n)
		$limit = $count;
	RenderChars($product, $limit, $offset);
}
?>

<style>
	@import "/css/product.css";
	@import "/css/image_viewer.css";
</style>

<script src="/js/image_viewer.js"></script>
<script src="/js/product.js"></script>

<span class="left"><a class="link" href="http://s-ws.ru/">Умные часы Smart Watches</a> &gt;&gt; <span class="ext"><?= $product->name ?></span></span>

<div itemscope itemtype="http://schema.org/Product">

	<div id="titleExt">
		<h1 itemprop="name"><?= $product->name ?></h1>
		<div class="right"><strong style="color: green;">Есть в наличии</strong></div>
		<div class="sp"></div>
	</div>
	<div class="left" id="gallery_container">
		<? if ($product->colors == "black,white"): ?>
			<div id="color_selector">
				<span id="color_label">Цвет:</span>
				<a class="color link active" color="black">Чёрный</a>
				<a class="color link" color="white">Белый</a>
			</div>
		<? endif; ?>
		<div id="gallery">
			<div id="prImage" class="image_viewer" itemscope itemtype="http://schema.org/ImageObject">
				<span style="display: inline-block; height: 262px; vertical-align: middle;"></span>
				<?
					$image = ProductImage::model()->findByAttributes(array('url' => $product->url . '_1.jpg'));
					$alt = $image ? $image->alt : '';
					$title = $image ? $image->title : '';
				?>
				<img itemprop="contentUrl" itemprop="image" src="http://s-ws.ru/image/<?= $product->url . '_1b.jpg' ?>" title="<?= $title ?> - главное фото" alt="<?= $alt ?> - главное фото" large="http://s-ws.ru/image/<?= $product->url . '_1.jpg' ?>"/>
				<img id="expand" src="http://s-ws.ru/img/expand.png" />
			</div>
			<div class="images">
				<div class="image" itemscope itemtype="http://schema.org/ImageObject"><span style="display: inline-block; height: 70px; vertical-align: middle;"></span><img itemprop="contentUrl" src="http://s-ws.ru/image/<?= $product->url . '_1b.jpg' ?>" title="<?= $title ?> - фото №1" alt="<?= $alt ?> - фото №1" /></div>
				<div class="image" itemscope itemtype="http://schema.org/ImageObject"><span style="display: inline-block; height: 70px; vertical-align: middle;"></span><img itemprop="contentUrl" src="http://s-ws.ru/image/<?= $product->url . '_2b.jpg' ?>" title="<?= $title ?> - фото №2" alt="<?= $alt ?> - фото №2" /></div>
				<div class="image" itemscope itemtype="http://schema.org/ImageObject"><span style="display: inline-block; height: 70px; vertical-align: middle;"></span><img itemprop="contentUrl" src="http://s-ws.ru/image/<?= $product->url . '_3b.jpg' ?>" title="<?= $title ?> - фото №3" alt="<?= $alt ?> - фото №3" /></div>
				<div class="image" itemscope itemtype="http://schema.org/ImageObject"><span style="display: inline-block; height: 70px; vertical-align: middle;"></span><img itemprop="contentUrl" src="http://s-ws.ru/image/<?= $product->url . '_4b.jpg' ?>" title="<?= $title ?> - фото №4" alt="<?= $alt ?> - фото №4" /></div>
				<div class="image" itemscope itemtype="http://schema.org/ImageObject"><span style="display: inline-block; height: 70px; vertical-align: middle;"></span><img itemprop="contentUrl" src="http://s-ws.ru/image/<?= $product->url . '_5b.jpg' ?>" title="<?= $title ?> - фото №5" alt="<?= $alt ?> - фото №5" /></div>
			</div>
		</div>
	</div>
	<div class="product right">
			<div class="price" style="z-index: 100;">
				<div itemprop="offers" itemscope itemtype="http://schema.org/Offer"> 
					<span itemprop="price"><?= $product->price ?> руб</span>
					<meta itemprop="priceCurrency" content="RUB">
					<link itemprop="availability" href="http://schema.org/InStock">
				</div>
				<button id="quick_order_button" href='http://s-ws.ru/cart?id_goods=<?= $product->id; ?>' class='button button-blue' onclick="ShowDialog('quick_order');">Быстрый заказ</button> <br>
				<a onclick="addToCart(<?= $product->id; ?>);" class='button'>Добавить в корзину</a>
			</div>
			
			<div class="detail detail_with_border" style="z-index: 0;">
				<span class="title">Характеристики</span> 
				<? RenderChars($product, 2); ?>
			</div>
			
	<!-- 		<div class="detail">
				<span class="title">Дополнительная функциональность</span> 
				<? MakeList($product->functions) ?> 
			</div> -->
	</div>
	<div style="clear:both"></div>
	<div class="detail row small">
		<? RenderChars($product, 999, 5); ?>
	</div>
	<div class="detail row big">
		<? RenderChars($product, 3, 2); ?>
	</div>
	<div class="product">
			<div class="detail" itemprop="description"> <?= $product->description ?> </div>
	</div>
	<div class="spRight"></div>
	<div style="clear:both"></div>

	<div id="quick_order_dialog" class="dialog">
	    <form method="POST" action="/site/QuickOrder" id="quick_order_form">
	    	<input type="hidden" name="item" value="<?= $product->name; ?>" />
	    	<input type="hidden" name="price" value="<?= $product->price; ?>" />
	        <h4> Быстрый заказ </h4> <br />

	        <div class="form_row">
	        	Укажите, пожалуйста, Ваш телефон и мы перезвоним Вам в <b>течение 3 минут</b>!
	        </div>

	        <br>

	        <div class="form_row">
	            <label> Телефон </label>
	            <input type="text" id="request_phone" name="phone" class="phone"/>
	        </div>
	        
	        <br />
	        <div class="dialog_buttons">
	            <button type="button" onclick="HideDialog();" class="button button-gray">
	                Отмена
	            </button>
	            <button type="button" onclick="Send('quick_order');" class="button">
	                Заказать
	            </button>
	        </div>
	    </form>
	</div>
</div>