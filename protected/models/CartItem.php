<?php

class CartItem extends CActiveRecord
{
	public function tableName()
	{
		return 'cart_item';
	}

	public function rules()
	{
		return array(
			array('id_cart, id_goods', 'required'),
			array('id_cart, id_goods, count', 'numerical', 'integerOnly'=>true),
		);
	}

	public function relations()
	{
		return array(
			'goods'=>array(self::BELONGS_TO, 'Goods', 'id_goods'),
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
