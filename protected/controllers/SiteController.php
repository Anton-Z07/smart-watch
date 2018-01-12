<?php

class SiteController extends Controller
{
	public function actionA() {
		echo 1;
	}

	public function actionProduct() {
		$url = Yii::app()->request->getParam('url');

		$product = Goods::model()->findByAttributes(array('url' => $url));
		if (!$product) 
			throw new CHttpException(404);

		$this->render('product', array('product' => $product));
	}
	
	public function actionIndex()
	{
		$goods = Goods::model()->findAll(array('condition' => '`show`=1'));
		$this->render('index', array('goods' => $goods));
	}
	
	public function actionReviews() {
		$message = '';
		$review = new Review;
		if (Yii::app()->request->isPostRequest)
		{

			$review->name = Yii::app()->request->getParam('name');
			$review->text = Yii::app()->request->getParam('text');
			$review->title = Yii::app()->request->getParam('title');
			$review->ip = $_SERVER['REMOTE_ADDR'];
			if ($review->save())
				$this->redirect('/site/reviews?success');
			else
				$message = 'Заполнены не все поля';
		}

		if (isset($_GET['success'])) 
			$message = 'Спасибо! Ваш отзыв скоро появится на сайте.';
		
		$reviews = Review::model()->findAll(array('condition' => 'status="approved"', 'order' => 'date desc'));
		
		$this->render('reviews', array('message' => $message, 'review' => $review, 'reviews' => $reviews));
	}

	public function actionDelivery() {
		$this->render('delivery');
	}

	public function actionContact() {
		$this->render('contact');
	}

	public function actionAbout() {
		$this->render('about');
	}

	public function actionCatalog() {
		$goods = Goods::model()->findAll(array('condition' => '`show`="1"'));
		$this->render('catalog', array('goods' => $goods));
	}

	public function actionWarranty() {
		$this->render('warranty');
	}

	public function actionSendMessage()
	{
		$message = new Message;
		$message->ip = $_SERVER['REMOTE_ADDR'];
		$message->name = Yii::app()->request->getParam('name');
		$message->phone = Yii::app()->request->getParam('phone');
		$message->email = Yii::app()->request->getParam('email');
		$message->text = Yii::app()->request->getParam('text');
		$message->save();
		$this->redirect('/contact?success');
	}

	public function actionQuickOrder()
	{
		$order = new QuickOrder;
		$order->name = Yii::app()->request->getParam('name');
		$order->phone = Yii::app()->request->getParam('phone');
		$order->item = Yii::app()->request->getParam('item');
		$order->price = Yii::app()->request->getParam('price');
		$order->date = date('Y-m-d H:i:s');
		$order->save();

		$text = 'Перезвон%20или%20быстрый%20заказ:%20' . Yii::app()->request->getParam('phone');
		$body=file_get_contents('http://sms.ru/sms/send?api_id=a47b1f10-f1ad-1a44-fdf0-f9483abe7f13&multi[79853381428]=' . $text . '&multi[79261464262]=' . $text);
	}

	public function actionSitemap()
	{
		Page::RenderSitemap();
	}

	public function action404()
	{
		header('HTTP/1.0 404 Not Found');
		$this->render('404');
	}

	public function actionError()
	{
		if (Yii::app()->errorHandler->error['code'] == 404)
            $this->redirect('/404');
		if($error=Yii::app()->errorHandler->error)
		{
			echo $error['message'];
		}
	}
	
}