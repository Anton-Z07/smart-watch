$(document).ready(function() {
	$('.image').click(function() {
		var url = $(this).find('img').attr('src');

		$('#prImage img').first().fadeOut(200, function() {
			$('#prImage img').first().attr('src', url);
			$('#prImage img').first().attr('large', url);
			$('#prImage img').first().fadeIn(200);
		});
	});

	$('#gallery .image:first-child').click();

	$('#color_selector .color').click(function(){
		$('#color_selector .color').removeClass('active');
		$(this).addClass('active');
		var img = $('#gallery #prImage img').first().get(0);
		if ($(this).attr('color') == 'black')
		{
			$('#gallery .images .image img').each(function() {
				this.src = this.src.replace('w.jpg', 'b.jpg');
			});
			img.src = img.src.replace('w.jpg', 'b.jpg');
		}
		if ($(this).attr('color') == 'white')
		{
			$('#gallery .images .image img').each(function(){
				this.src = this.src.replace('b.jpg', 'w.jpg');
			});
			img.src = img.src.replace('b.jpg', 'w.jpg');
		}
		$(img).attr('large', img.src);
	});
});

function back() {
	window.history.back();
}

function addToCart(product_id) {
	yaCounter27298619.reachGoal('add_to_cart_click');
	window.location.href = 'http://s-ws.ru/cart?id_goods=' + product_id;
}