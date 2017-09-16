<?php


namespace ehsanx64\libphp\Persian;

include __DIR__ . '/jdf-2.70.php';

//  Date class
class Date {
	public static $standardDateFormat = 'j F Y';

	public static function getStandardDate($timestamp) {
		echo Jdate::jdate(self::$standardDateFormat, $timestamp);
	}
}
