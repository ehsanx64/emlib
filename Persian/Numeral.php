<?php
namespace ehsanx64\libphp\Persian;

include __DIR__ . '/jdf-2.70.php';

class Numeral {
	/**
	 * @param $latinNumeral Number string to convert
	 * @param string $to Language code to convert numeral to (en or fa)
	 * @param string $dotReplacement Character which specifies decimal point
	 *
	 * Convert between Persian\Latin numerals. Stolen from jdf :-D
	 * @return mixed
	 */
	public static function convertNumeral($numeral, $to = 'en', $dotReplacement = '،') {
		$num_a = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
		$key_a = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', $dotReplacement);

		return ($to == 'fa')
			? str_replace($num_a, $key_a, $numeral)
			: str_replace($key_a, $num_a, $numeral);
	}

	/**
	 * Convert latin numeral to persian numeral
	 * @param $number Number to convert
	 * @return mixed Converted numeral
	 */
	public static function latinToPersian($number) {
		return self::convertNumeral($number, 'fa');
	}
}
