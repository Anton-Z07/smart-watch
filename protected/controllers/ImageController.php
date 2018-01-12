<?php

class ImageController extends Controller
{
	private static $base_path = '/img/products/';
	private static $processed_path = '/img/products_processed/';
	private static $logo_path = '/img/watermark.png';

	public function actionIndex($id)
	{
		$fn = $_SERVER['DOCUMENT_ROOT'] . self::$base_path . $id;
		$processed_fn = $_SERVER['DOCUMENT_ROOT'] . self::$processed_path . $id;
		Image::ProcessImage(self::$base_path, self::$processed_path, $id, self::$logo_path);
		Image::Render($processed_fn);

	}
}