<?php
namespace ehsanx64\libphp\Persian;

class Numeral {
	/**
	 * Convert between Persian\Latin numerals. Stolen from jdf :-D
	 *
	 * @param $latinNumeral Number string to convert
	 * @param string $to Language code to convert numeral to (en or fa)
	 * @param string $dotReplacement Character which specifies decimal point
	 *
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
	 * Convert latin numerals in given string to persian numerals
	 *
	 * @param $string String to convert
	 * @return mixed Converted numeral
	 */
	public static function latinToPersian($string) {
		return self::convertNumeral($string, 'fa');
	}
	
	/**
	 * Convert Persian numerals in given string to Latin numerals
	 *
	 * @param $string String to convert
	 * @return mixed Converted numeral
	 */
	public static function PersianToLatin($string) {
		return self::convertNumeral($string, 'en');
	}
}
