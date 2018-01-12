<?php

class CartController extends Controller
{
	public function actionIndex()
	{
	  	$id_goods = Yii::app()->request->getParam('id_goods');
	  	if ($id_goods)
	  	{
	   		Cart::AddItem($id_goods);
	   		$this->redirect('/cart');
	  	}
	  	$cart = Cart::Get();
	 	$this->render('index', array('cart' => $cart));
	}

	public function actionChangeCartItem()
	{
		if (!Yii::app()->request->isAjaxRequest) return;
		$id_item = Yii::app()->request->getParam('id_item');
		$cart = Cart::Get();
		$item = CartItem::model()->findByPk($id_item);
		if (!$id_item || !$item || $item->id_cart != $cart->id) return;
		$count = Yii::app()->request->getParam('count');
		if ($count)
		{
			$item->count = intval($count);
			$item->save();
		}
		$delete = Yii::app()->request->getParam('delete');
		if ($delete == '1')
			$item->delete();
		$cart->UpdateCost();
		echo $cart->cost;
	}

	public function actionGetCartData()
	{
		echo json_encode(Cart::GetData());
	}

	public function actionForm()
	{
		$this->render('form');
	}

	public function actionSubmitForm()
	{
		if (!Yii::app()->request->isPostRequest) $this->redirect('/cart');

		$cart = Cart::Get(true);
		if (!$cart) $this->redirect('/cart');

		$form = new ClientForm;
		$form->last_name = Yii::app()->request->getParam('last_name', 'нет');
		$form->first_name = Yii::app()->request->getParam('first_name');
		$form->middle_name = Yii::app()->request->getParam('middle_name', 'нет');
		$form->phone = Yii::app()->request->getParam('phone');
		$form->email = Yii::app()->request->getParam('email', 'нет');
		$form->address = Yii::app()->request->getParam('address', 'нет');
		$form->id_cart = $cart->id;
		if ($form->save()) {
			$text = 'Заказ%20оформлен:' . Yii::app()->request->getParam('phone');
			$body=file_get_contents('http://sms.ru/sms/send?api_id=a47b1f10-f1ad-1a44-fdf0-f9483abe7f13&multi[79853381428]=' . $text . '&multi[79261464262]=' . $text);
			$this->redirect('/cart/ThankYou');
		}
		else
		{
			$this->redirect('/cart/form');
		}
	}

	public function actionPay()
	{
		$this->render('pay');
	}

	public function actionCartPaid()
	{
		$hash = Yii::app()->request->getParam('id');
		$cart = Cart::model()->findByAttributes(array('hash' => $hash));
		if (!$cart || $cart->status != 'new') return;

		$form = ClientForm::model()->findByAttributes(array('id_cart' => $cart->id));
		if (!$form) return;

		$cart->Paid();

		$track = new Track;
		$track->id_cart = $cart->id;
		$track->id_client_form = $form->id;
		$track->save();

		$track->SendInfo();

		$this->redirect('/cart/ThankYou');
	}

	public function actionThankYou()
	{
		$cart = Cart::Get(true);
		if (!$cart) $this->redirect('/cart');
		$track = $cart->track;
		$cart->ToWork();
		Service::SendSmsNotification(Cart::GetNotificationText());
		Cart::ClearSession();
		$this->render('thank_you', array('track_id' => null, 'cart' => $cart));
	}
}