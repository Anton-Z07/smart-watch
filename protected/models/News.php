<?php

class News extends CActiveRecord
{
	public function tableName()
	{
		return 'news';
	}

	public function rules()
	{
		return array(
			array('date, title, text', 'required'),
			array('id, date, title, text', 'safe', 'on'=>'search'),
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

	public function GetDate()
	{
		return date("d.m.y H:i", strtotime($this->date));
	}

	public function GetText()
	{
		$res = '';
		foreach (explode("\n\r\n", $this->text) as $t)
			$res .= "<p>$t</p>";
		return $res;
	}

	public function GetShortText()
	{
		$max_length = 100;
		$cur_length = 0;
		$res = '';
		foreach (explode("\n\r\n", $this->text) as $t)
		{
			if ( ($cur_length + mb_strlen($t)) > $max_length && $cur_length > 0)
				break;
			$res .= $t;
			$cur_length += mb_strlen($t);
		}
		return $res;
	}

	public static function GetPageData()
	{
		$res = array('title' => $_SERVER['SERVER_NAME'], 'keywords' => '', 'description' => '');
		$arr = explode('/', $_SERVER['REQUEST_URI']);
		$link = $arr[count($arr)-1];
		$news = News::model()->findByAttributes(array('link' => $link));
		if (!$link || !$news) return $res;
		$res['title'] = $news->head_title;
		$res['keywords'] = $news->keywords;
		$res['description'] = $news->head_description;
		return $res;
	}
}
