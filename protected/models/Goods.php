<?php

class Goods extends CActiveRecord
{
	public function tableName()
	{
		return 'goods';
	}

	public function rules()
	{
		return array(
			array('name, url', 'length', 'max'=>100),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function GetPageData()
	{
		$res = array('title' => $_SERVER['SERVER_NAME'], 'keywords' => '', 'description' => '');
		$url = Yii::app()->request->getParam('url');
		$product = Goods::model()->findByAttributes(array('url' => $url));
		if (!$url || !$product) return $res;
		$res['title'] = $product->title;
		$res['keywords'] = $product->keywords;
		$res['description'] = $product->head_description;
		return $res;
	}
}
