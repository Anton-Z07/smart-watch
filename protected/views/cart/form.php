<script>
	$(function(){
		$('#submit_button').click(function(){
			if (Validate('checkout_form'))
			{
				$('#submit_button').hide();
				$('#processing').show();
				$('#checkout_form').submit();
			}
		});
		$('.phone').mask('8(999)999-99-99');
	});

	function Validate(id) 
	{
		var errors = false;
		$('#checkout_form .required').each(function(){
			if ($(this).val() == '')
			{
				errors = true;
				$(this).addClass('error');
			}
		});
		$('input.error,textarea.error').click(function(){ $(this).removeClass('error'); });
		return !errors;
	}
</script>

<style>
	#checkout_form {
		margin-top: 50px;
	}
	#processing {
		display: none;
	}
</style>

<h1>Ваши данные</h1>

<form id="checkout_form" action="/cart/SubmitForm" method="POST" class="form">
<!-- 	<div class="form-row">
		<label> Фамилия </label>
		<div> <input type="text" name="last_name" class="required"/> </div>
	</div> -->

	<div class="form-row">
		<label> Имя </label>
		<div> <input type="text" name="first_name" class="required" /> </div>
	</div>

<!-- 	<div class="form-row">
		<label> Отчество </label>
		<div> <input type="text" name="middle_name" class="required" /> </div>
	</div> -->

	<div class="form-row">
		<label> Телефон </label>
		<div> <input type="text" name="phone" class="phone required"/> </div>
	</div>

<!-- 	<div class="form-row">
		<label> Email </label>
		<div> <input type="text" name="email" class="required" /> </div>
	</div> -->

<!-- 	<div class="form-row textarea">
		<label> Адрес доставки </label>
		<div> <textarea name="address" rows="5" class="required"></textarea> </div>
	</div> -->

	<div class="form-buttons">
		<button id="submit_button" type="button" class="button"> Продолжить </button>
		<span id="processing">Данные обрабатываются, пожалуйста, подождите...</span>
	</div>
</form>