<?
class Service
{
	public static function SendSmsNotification($text)
	{
		self::SendSms('79261464262', $text);
		self::SendSms('79853381428', $text);
	}

	public static function SendSms($phone, $text)
	{
		$url = 'https://gate.smsaero.ru/send/?to=' . $phone;
		$url .= '&user=' . urlencode('anton.a.zotov@gmail.com');
		$url .= '&password=' . urlencode('d122c03899c669590ba60088c4c9905e');
		$url .= '&from=' . urlencode('S-ws');
		$url .= '&text=' . urlencode($text);

		self::CurlRequest($url);
	}

	public static function CurlRequest($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}