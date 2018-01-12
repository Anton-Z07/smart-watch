<?

class Image
{
	private static $WIDTH_DIVIDER = 2;
	private static $PADDING_DIVIDER = 10;

	public static function ProcessImage($base_path, $processed_path, $img_name, $logo_path)
	{
		$fn = $_SERVER['DOCUMENT_ROOT'] . $base_path . $img_name;
		$processed_fn = $_SERVER['DOCUMENT_ROOT'] . $processed_path . $img_name;

		if (!file_exists($fn) || file_exists($processed_fn) || !file_exists($_SERVER['DOCUMENT_ROOT'].$logo_path))
			return;
		//$img = imagecreatefromjpeg($fn);
		$img = self::PutWatermark($fn, $_SERVER['DOCUMENT_ROOT'].$logo_path);

		self::SaveProcessedImage($img, $processed_fn, 71680);
	}

	public static function RenderBlank()
	{
		$im = imagecreatetruecolor(1, 1);
		header('Content-Type: image/jpeg');
		imagejpeg($im);
	}

	public static function Render($fn)
	{
		if (!file_exists($fn))
			self::RenderBlank();
		else
		{
			$img = imagecreatefromjpeg($fn);

			$headers = apache_request_headers(); 
			if (isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == filemtime($fn))) {
        		header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($fn)).' GMT', true, 304);
		    } else {
		        header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($fn)).' GMT', true, 200);
		        // header('Content-Length: '.filesize($fn));
		        header('Content-Type: image/jpeg');
				imagejpeg($img);
		    }
		}
	}

	public static function PutWatermark($fn, $logo_path)
	{
		$img = imagecreatefromjpeg($fn);
		$watermark_img = imagecreatefrompng($logo_path);

		$file_params = @getimagesize($fn);
		$watermark_params = @getimagesize($logo_path);

		$w = $file_params[0] / self::$WIDTH_DIVIDER;
		$h = round($watermark_params[1] * ($w / $watermark_params[0]));
		$w = round($w);

		$padding_left = round($file_params[0] / self::$PADDING_DIVIDER);
		$padding_bottom = round($file_params[1] / self::$PADDING_DIVIDER);

		$x = $file_params[0] - $padding_left - $w;
		$y = $file_params[1] - $padding_bottom - $h;

		imagecopyresized($img, $watermark_img, $x, $y, 0, 0, $w, $h, $watermark_params[0], $watermark_params[1]);

			// header('Content-Type: image/jpeg');
			// imagejpeg($img);
		return $img;
	}

	public static function SaveProcessedImage($img, $path, $max_size)
	{
		$quality = 100;
		do
		{
			imagejpeg($img, $path, $quality);
			$quality -= 2;
		}
		while ($quality > 50 and filesize($path) > $max_size);
	}
}