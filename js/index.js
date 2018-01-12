var slide_interval = 0;

$(document).ready(function() {
	$('.glow').click(function() {
		window.location.href = $(this).find('a').attr('href');
	});

	$('.wmuSlider').wmuSlider({
		animation: 'slide',
		items: 1
	});

	$('.wmuSliderPagination li:first-child a').click();

	autoSlide();

	$('.wmuSliderNext, .wmuSliderPrev, .wmuSliderPagination>li').click(function() {
		clearInterval(slide_interval);
	});
});

function autoSlide() {
	slide_interval = setInterval(function() {
		$('.wmuSliderNext').click();
	}, 5000);
}