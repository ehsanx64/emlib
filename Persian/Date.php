<?php
namespace ehsanx64\libphp\Persian;

include __DIR__ . '/jdf-2.70.php';

//  Date class
class Date {
	public static $standardDateFormat = 'j F Y';
	public static $shortDateFormat = 'Y-m-d';

	
	/*
	 * Get current Jalali date based on the class standard format
	 *
	 * @param $timestamp mixed Optional. timestamp for date generation. Current timestamp will be used if not specified.
	 *
	 * @return string Date string
	 */
	public static function getStandardDate($timestamp = time()) {
		echo Jdate::jdate(self::$standardDateFormat, $timestamp);
	}

	
	/**
	 * Convert Gregorian standard date (1985-12-01) into Jalali standard date (1364-12-22)
	 *
	 * @param $gregorianDateString mixed The Gregorian date for conversion
	 * @return string Jalali date
	 */
	public static function ToJalali($gregorianDateString) {
		return Jdate::jdate(self::$shortDateFormat, \ehsanx64\libphp\General\Date\Date::toTimestamp($gregorianDateString));
	}
}
