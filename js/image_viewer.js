$(function(){
	SetMaxSize();
	$('.image_viewer, #expand').click(function(e) {
		e.stopPropagation();
		ShowImage($('.image_viewer img'));
	});
});

function SetMaxSize()
{
	$('#image_viewer_img').css('max-width', ($('html').width() * 0.4) + 'px');
	$('#image_viewer_img').css('max-height', ($('html').height() * 0.4) + 'px');
}

function AddShadow()
{
	if ($('#modal_shadow').size() == 0) {
		$('body').append('<div id="modal_shadow"></div>');
		$('#modal_shadow').click(HideImage);
	}

	$('body').append('<div id="image_viewer_window"></div>');
	$('#image_viewer_window').click(OnImageClick);
}

function ShowImage(img)
{
	var url = img.attr('large');

	AddShadow();
	$('#image_viewer_window').html('<img id="image_viewer_img" src="'+url+'" />')
	SetMaxSize();

	$('#modal_shadow').fadeIn(200);
	$('#image_viewer_window').fadeIn(200);

	setTimeout(CenterViewer, 100);
	$('#image_viewer_img').get(0).onload = CenterViewer;
}

function HideImage() {
	$('#modal_shadow').fadeOut(200, function() {
		$(this).remove();
	});

	$('#image_viewer_window').fadeOut(200, function() {
		$(this).remove();
	});
}

function CenterViewer()
{
	var w = $('#modal_shadow').width()/2 - $('#image_viewer_window').width()/2;
	var h = $('#modal_shadow').height()/2 - $('#image_viewer_window').height()/2;
	$('#image_viewer_window').css('top', h);
	$('#image_viewer_window').css('left', w);
}

function OnImageClick()
{
	var cur_src_arr = $('#image_viewer_img').attr('src').split('_');
	
	var model = cur_src_arr[0];
	var number = ++cur_src_arr[1][0];
	var color = cur_src_arr[1][1];

	$('#image_viewer_img').attr('src', model + '_' + (number > 5 ? 1 : number) + color + '.jpg');
}