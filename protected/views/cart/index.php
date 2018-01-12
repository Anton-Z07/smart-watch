<style type="text/css">
	@import "/css/cart.css";
</style>

<style>
	.less, .plus, .admin {
		cursor: pointer;
	}
</style>

<script>
	$(function(){
		Update();
	});

	function ChangeCount(val, el)
	{
		var countEl = $(el).closest('.quantity').find('.top');
		var c = parseInt(countEl.text());
		c += val;
		if (c < 1) c = 1;
		countEl.text(c);

		var price = parseInt( $(el).closest('ul').find('.price').text() );
		var totalEl = $(el).closest('ul').find('.total');
		totalEl.text((price * c) + ' руб');

		var id_item = parseInt($(el).closest('div.row').attr('id_item'));
		$.ajax({url: '/cart/ChangeCartItem', data: {'id_item': id_item, 'count': c}})
		.done(function(data){
			if (data)
				$('#total .value').text(data + ' руб');
		});
		UpdateCart();
	}

	function DeleteItem(el)
	{
		var id_item = parseInt($(el).closest('div.row').attr('id_item'));
		$.ajax({url: '/cart/ChangeCartItem', data: {'id_item': id_item, 'delete': 1}})
		.done(function(data){
			if (data)
				$('#total .value').text(data + ' руб');
		});
		$(el).closest('div.row').fadeOut(300, function() { $(this).remove(); Update();});
		UpdateCart();
	}

	function Update()
	{
		if ($('.product').size() == 0)
		{
			$('#checkout').hide();
			$('#cart_is_empty').show();
		}
		else
			$('#cart_is_empty').hide();
	}
</script>

	<div id="titleExt">
		<div class="left">Корзина</div>
		<div class="sp"></div>
	</div>
	<div id="table">
		<div class="head">
			<ul>
				<li class="preview">&nbsp;</li>
				<li class="title">Название</li>
				<li class="price">Цена</li>
				<li class="quantity">Количество</li>
				<li class="total">Итого</li>
			</ul>
			<div class="sp"></div>
		</div>
		<div class="rows sp">
			<div class="row" id="cart_is_empty">
				Корзина пуста
			</div>
			<? foreach ($cart->items as $item) { ?>
				<div class="row product" id_item="<?= $item->id; ?>">
					<ul>
						<li class="preview"> <a href="/product/<?= $item->goods->url; ?>"><img src="/img/products/<?= $item->goods->url; ?>_1.jpg" border="0" alt="image"/></a> </li>
						<li class="title"><a href="/product/<?= $item->goods->url; ?>"><?= $item->goods->name; ?></a></li>
						<li class="price"><?= $item->goods->price ?> руб</li>
						<li class="quantity">
							<div class="top"><?= $item->count; ?></div>
							<div class="bottom"> <a class="less" onclick="ChangeCount(-1, this)"></a> <a class="plus" onclick="ChangeCount(1, this)"></a> </div>
						</li>
						<li class="total"><?= $item->goods->price * $item->count; ?> руб</li>
						<li class="admin"><a onclick="DeleteItem(this)">X</a></li>
					</ul>
					<div class="sp"></div>
				</div>
			<? } ?>
		</div>
	</div>
	<div id="total"> <span class="value"><?= $cart->cost; ?> руб</span><span class="label">Итоговая цена</span></div>
	<div class="sp"></div>
	<div id="buttons"><a href="/cart/form" id="checkout">Оформить заказ</a><a href="/" class="">Вернуться к товарам</a></div>
</div>