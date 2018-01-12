<?

class NewsController extends Controller
{
	public function actionIndex()
	{
		$news = News::model()->findAll(array('order' => 'date desc'));
		$this->render('index', array('news' => $news));
	}

	// public function actionView($id)
	// {
	// 	$n = News::model()->findByPk($id);
	// 	if (!$n)
	// 		$this->redirect('/404');
	// 	$this->render('view', array('n' => $n));
	// }

	public function actionNewsByName($id)
	{
		$n = News::model()->findByAttributes(array('link' => $id));
		if (!$n)
			$this->redirect('/404');
		$this->render('view', array('n' => $n));
	}
}