<?php
namespace ehsanx64\libphp\Persian;

use \ehsanx64\libphp\General;
use \ehsanx64\libphp\Persian;
use Exception;

include __DIR__ . '/jdf-2.70.php';

//  Date class
class Date {
	public static $dateFormat = 'j F Y';
	public static $timeFormat = 'H:i';
	public static $gDateFormat = 'Y-m-d';
	public static $gTimeFormat = 'H:i';
	
	/*
	 * Get current Jalali date string
	 *
	 * @param $timestamp mixed Optional. timestamp for date generation. Current timestamp will be used if not specified.
	 * @param $format string Optional. The format used for date string generation if not specified default class format is used.
	 *
	 * @return string Date string
	 */
	public static function getDate($timestamp = '', $format = '') {
		$ts = $timestamp;

		if (empty($timestamp)) {
			$ts = time();
		}

		$f = $format;
		if (empty($format)) {
			$f = self::$dateFormat;
		}

		return Jdate::jdate($f, $ts);
	}

	
	/**
	 * Convert Gregorian standard date (1985-12-01) into Jalali standard date (1364-12-22)
	 *
	 * @param $gregorianDateString mixed The Gregorian date for conversion
	 * @return string Jalali date
	 */
	public static function toJalaliDate($gregorianDateString, $format = '') {
		$t = General\Date::toTimestamp($gregorianDateString);

		return self::getDate($t, $format);
	}

	public static function toGregorianDate($jalaliDate, $format = '') {
		if (!self::isJalaliDate($jalaliDate)) {
			return $jalaliDate;
		}

		$f = $format;

		if (empty($format)) {
			$f = self::$gDateFormat;
		}

		$t = self::toTimestamp($jalaliDate);

		return date($f, $t);
	}

	/**
	 * Convert given Jalali date string to Unix timestamp
	 *
	 * @param $datestring string Jalali date string to convert
	 * @return int Unix timestamp
	 */
	public static function toTimestamp($datestring) {
		$latinized = Numeral::toLatin($datestring);
		$dateparts = explode(General\Date::guessDateDelimiter($latinized), $latinized);

		if (count($dateparts) != 3) {
			throw new Exception('Invalid date');
		}
		$gtimestamp = \ehsanx64\libphp\Persian\Jdate::jmktime(0, 0, 0, $dateparts[1], $dateparts[2], $dateparts[0]);
		return $gtimestamp;
	}

	/**
	 * Check if the given parameter looks like a date and if it is in Jalali sensible range
	 *
	 * @param $dateString string Date string
	 */
	public static function isJalaliDate($dateString) {
		$d = Numeral::toLatin($dateString);
		$delimiter = General\Date::guessDateDelimiter($d);

		if ($delimiter == false) {
			throw new Exception('Invalid dates supplied');
		}

		$dateparts = explode($delimiter, $d);

		if ($dateparts[0] < 1900 && count($dateparts) == 3) {
			return true;
		}

		return false;
	}
}
