<?php

class Page extends CActiveRecord
{
	public function tableName()
	{
		return 'page';
	}

	public function rules()
	{
		return array(
			array('url', 'required'),
			array('sitemap', 'numerical', 'integerOnly'=>true),
			array('weight', 'numerical'),
			array('url', 'length', 'max'=>50),
			array('title', 'length', 'max'=>200),
			array('keywords, description', 'length', 'max'=>400),
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
		$arr = explode('?', $_SERVER['REQUEST_URI'], 2);
		$url = str_replace('/', '', $arr[0]);
		if ($url == '')
			$url = 'index';
		if (strpos($url, 'newsview') === 0)
			$url = 'news/view';
		$res = array('title' => $_SERVER['SERVER_NAME'], 'keywords' => '', 'description' => '');

		if (Yii::app()->controller->getAction()->getId() == 'product')
			$res = Goods::GetPageData();
		elseif (Yii::app()->controller->getAction()->getId() == 'newsbyname')
			$res = News::GetPageData();
		else
		{
			$page = Page::model()->findByAttributes(array('url' => $url));
			if (!$page)
				$page = Page::model()->findByAttributes(array('url' => '_default'));
			if ($page)
			{
				$res['title'] = $page->title;
				$res['keywords'] = $page->keywords;
				$res['description'] = $page->description;
				$res['style'] = $page->style;
			}
		}
		return $res;
	}

	public static function GetHeadMetaString()
	{
		$pageData = self::GetPageData();
		return '<title>' . $pageData['title'] . '</title>
				<meta name="keywords" content="' . $pageData['keywords'] . '" />
				<meta name="description" content="' . $pageData['description'] . '" />';
	}

	public static function RenderSitemap()
	{
		header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$pages = Page::model()->findAll('url NOT LIKE "\_%" and url NOT LIKE "catalog" and sitemap=1');
		foreach ($pages as $page)
		{
			$url = ($page->url=='index' ? '' : $page->url);
			echo '<url>';
			echo "<loc>http://s-ws.ru/$url</loc>";
			echo '<changefreq>daily</changefreq>';
			echo "<priority>$page->weight</priority>";
			echo '</url>';
		}
		$pages = Goods::model()->findAll();
		foreach ($pages as $page)
		{
			$url = $page->url;
			echo '<url>';
			echo "<loc>http://s-ws.ru/$url</loc>";
			echo '<changefreq>daily</changefreq>';
			echo "<priority>1</priority>";
			echo '</url>';
		}
		$news = News::model()->findAll();
		foreach ($news as $n)
		{
			$url = 'news/' . $n->link;
			echo '<url>';
			echo "<loc>http://s-ws.ru/$url</loc>";
			echo '<changefreq>weekly</changefreq>';
			echo "<priority>0.3</priority>";
			echo '</url>';
		}
		echo '</urlset>';
	}

	public static function getStyle() {
		$pageData = self::GetPageData();

		return isset($pageData['style']) ? $pageData['style'] : ''; 
	}
}