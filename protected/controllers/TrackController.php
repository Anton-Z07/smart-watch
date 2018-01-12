<?php

class TrackController extends Controller
{
	public function actionIndex()
	{
		$id = Yii::app()->request->getParam('id');
		$track = Track::model()->findByAttributes(array('track_id' => $id));
		if (!$track) $this->redirect('/');

		$this->render('index', array('track' => $track));
	}

	public function actionTest()
	{
		echo $_SERVER['SERVER_NAME'];
	}
}