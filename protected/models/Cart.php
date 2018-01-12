<?php

class Cart extends CActiveRecord
{
	public function tableName()
	{
		return 'cart';
	}

	public function rules()
	{
		return array(
			array('status', 'length', 'max'=>15),
			array('id, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'items'=>array(self::HAS_MANY, 'CartItem', 'id_cart'),
			'track'=>array(self::HAS_ONE, 'Track', 'id_cart'),
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave() {
        if ($this->isNewRecord)
        {
            $this->hash = sha1(sha1(time() . rand(0, 10000)));
        }
        return parent::beforeSave();
    }


	private static function CreateCart()
	{
		$cart = new Cart;
		$cart->save();
		Yii::app()->session['id_cart'] = $cart->id;
		return $cart;
	}

	public static function AddItem($id_goods)
	{
		$cart = self::Get();
		$goods = Goods::model()->findByPk($id_goods);
		if (!$goods) return;
		$item = new CartItem;
		$item->id_cart = $cart->id;
		$item->id_goods = $goods->id;
		$item->save();
		$cart->UpdateCost();
	}

	public static function Get($dont_create = false)
	{
		$cart = null;
		if (isset(Yii::app()->session['id_cart']) && Yii::app()->session['id_cart'])
			$cart = Cart::model()->findByPk(Yii::app()->session['id_cart']);
		if (!$cart && !$dont_create)
			$cart = self::CreateCart();
		return $cart;
	}

	public static function GetData()
	{
		$cart = self::Get(true);
		if (!$cart) return array('items' => '0 товаров', 'price' => '0 руб');
		$k = $cart->CountItems();
		$arr = array('items' =>  'В корзине: ' . $k , 'price' => $cart->cost . ' руб');
		if ($k == 0)
			$arr['items'] = 'Корзина пуста';
		return $arr;
	}

	public static function ClearSession()
	{
		if (isset(Yii::app()->session['id_cart']))
			unset(Yii::app()->session['id_cart']);
	}

	public function UpdateCost()
	{
		$this->cost = 0;
		foreach ($this->items as $item)
			$this->cost += $item->count * $item->goods->price;
		
		$this->save();
	}

	public function CountItems()
	{
		$k = 0;
		foreach ($this->items as $item)
			$k += $item->count;
		return $k;
	}

	public function Paid()
	{
		$this->status = 'paid';
		$this->pay_date = date('Y-m-d H:i:s');
		$this->save();
	}

	public function ToWork()
	{
		$this->status = 'work';
		$this->save();
	}

	public function GetNotificationText()
	{
		$text = "Заказ. ";
		$cart = self::Get(true);
		$form = ClientForm::model()->findByAttributes(array('id_cart' => $cart->id));
		if (!$form) return false;
		$text .= "$form->first_name. $form->phone";
		foreach ($cart->items as $item)
			$text .= ' .' . $item->goods->name . ' x' . $item->count;
		return $text;
	}
}
