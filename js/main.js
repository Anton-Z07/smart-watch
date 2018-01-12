$(function(){
	setInterval(UpdateCart, 1000);
	UpdateMenu();
});

function UpdateCart()
{
	$.getJSON('/cart/GetCartData')
	.done(function(data){
		$('#mycart .items').text(data['items']);
		$('#mycart .prices span').text(data['price']);
	});
}

function UpdateMenu()
{
	$('#navigation ul li').each(function(){
		var a = $(this).find('a');
		if (a.attr('href') == window.location.href)
			a.addClass('active');
	});
}