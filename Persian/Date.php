<?php


namespace ehsanx64\libphp\Persian;

include __DIR__ . '/jdf-2.70.php';

//  Date class
class Date {
	public static $standardDateFormat = 'j F Y';
	public static $shortDateFormat = 'Y-m-d';

	public static function getStandardDate($timestamp) {
		echo Jdate::jdate(self::$standardDateFormat, $timestamp);
	}
	
	/**
	 * Convert Gregorian standard date (1985-12-01) to unix timestamp
	 *
	 * @param $gregorianDate Date string in format (1985-12-01)
	 * @return int Unix timestamp casted as an integer
	 */
	public static function gregorianDateToTimestamp($gregorianDate) {
		$p = explode('-', $gregorianDate);

		if (count($p) == 3) {
			return (int) mktime(null, null, null, $p[1], $p[2], $p[0]);
		}

		return '';
	}
	
	/**
	 * Convert Gregorian standard date (1985-12-01) into Jalali standard date (1364-12-22)
	 */
	public static function gregorianDateToJalaliDate($gregorianDateString) {
		return Jdate::jdate(self::$shortDateFormat, self::gregorianDateToTimestamp($gregorianDateString));
	}
}
