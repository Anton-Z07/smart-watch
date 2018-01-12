<?php

class Track extends CActiveRecord
{
	public function tableName()
	{
		return 'track';
	}

	public function rules()
	{
		return array(
			array('id_cart, id_client_form', 'required'),
			array('id_cart, id_client_form', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>15),
			array('track_id', 'length', 'max'=>40),
			array('id, id_cart, id_client_form, status, track_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'form'=>array(self::BELONGS_TO, 'ClientForm', 'id_client_form'),
			'cart'=>array(self::BELONGS_TO, 'Cart', 'id_cart'),
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave() {
        if ($this->isNewRecord)
        {
            $this->track_id = sha1(sha1(time() . rand(0, 10000) . '|' . $this->id_cart . '|' . $this->id_client_form));
        }
        return parent::beforeSave();
    }

    public function SendInfo()
    {
    	$text = '<h1> Спасибо за Ваш заказ! </h1> <br />';
    	$text .= 'Вы заказали: <br />';
    	foreach ($this->cart->items as $item)
    		$text .= $item->goods->name . ' x' . $item->count . ', ' . $item->goods->price * $item->count . ' руб <br />';
    	$link = "http://".$_SERVER['SERVER_NAME']."/track?id=$this->track_id";
    	$text .= "<br />Ссылка для отслеживания заказа: <a href='$link'>$link</a><br /><br />";
    	$text .= 'С наилучшими пожеланиями, <br />команда Твои часы';

    	return Email::SendEmail($this->form->email, 'Ваш заказ отлачен', $text);
    }

    public static function GetStatuses()
    {
    	return array('new' => 'В обработке');
    }

    public function GetStatus()
    {
    	$statuses = self::GetStatuses();
    	return $statuses[$this->status];
    }
}
