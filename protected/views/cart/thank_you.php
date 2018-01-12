<h1> Спасибо за Ваш заказ! </h1> <br />
Вы заказали: <br />
<? foreach ($cart->items as $item)
	echo $item->goods->name . ' x' . $item->count . ', ' . $item->goods->price * $item->count . ' руб <br />';
?>
<br />Наш оператор скоро с Вами свяжется.<br /><br />
С наилучшими пожеланиями, <br />
команда Твои часы