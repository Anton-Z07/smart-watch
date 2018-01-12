<?php

class Review extends CActiveRecord
{
	public function tableName()
	{
		return 'review';
	}

	public function rules()
	{
		return array(
			array('name, text, ip', 'required'),
			array('name, ip', 'length', 'max'=>50),
			array('status', 'length', 'max'=>15),
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
}
