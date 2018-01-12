$(document).ready(function() {
	$('.phone').mask('8(999)999-99-99');
});

function ShowDialog( id_dialog ) {
	if (!$('#modal_shadow').size()) {
		$('body').append('<div id="modal_shadow"></div>');
		$('#modal_shadow').fadeIn(200);
		$('#modal_shadow').click(function() {
			HideDialog();
		});
	}

	$('#' + id_dialog + '_dialog').fadeIn(200);

	yaCounter27298619.reachGoal(id_dialog + '_click');
}

function HideDialog(cb)
{
	$('#modal_shadow').fadeOut(200, function() {
		$(this).remove();
	});

	$('.dialog:visible').fadeOut(200, function() {
		if (cb) {
			cb();
		}
	});
}

function Send(id) {
	var errors = false;

	$('#' + id + '_form input[type=text]').each(function(){
		
		if ($(this).val()) {
			$(this).removeClass('error');
		} else {
			$(this).addClass('error');
			errors = true;
		}

	});

	$('.error').click(function() {
		$(this).removeClass('error');
	});

	if (errors) {
		return;
	}

	$('#' + id + '_form').ajaxSubmit();

	HideDialog(function() {
		
		$('#' + id + '_form').find('input').each(function() {
			$(this).val('');
		});

		if (id === 'quick_order' || id === 'recall' ) {
			ShowDialog('request_thank');
	
			setTimeout(function() {
				HideDialog();
			}, 1500);
		}
	});

	yaCounter27298619.reachGoal(id);
}