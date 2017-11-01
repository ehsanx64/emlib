<?php
namespace ehsanx64\libphp\General;

class Date {
    /**
	 * Convert Gregorian standard date (1985-12-01) to unix timestamp
	 *
	 * @param $gregorianDate Date string in format (1985-12-01)
	 * @return int Unix timestamp casted as an integer
	 */
	public static function ToTimestamp($gregorianDate) {
		// Following lines commented in favor of PHP's strtotime
		/*
		$p = explode('-', $gregorianDate);

		if (count($p) == 3) {
			return (int) mktime(null, null, null, $p[1], $p[2], $p[0]);
		}
		*/

		return strtotime($gregorianDate);
	}
    
    /**
     * Convert SQL DATETIME string (2017-04-23 11:59:10 etc) to Unix timestamp
	 *
	 * @param $sqlDatetimeString mixed The SQL DATETIME
	 * @return integer Unix timestamp
	 */
    public static function sqlDatetimeToTimestamp($sqlDatetimeString) {
        return self::ToTimestamp($sqlDatetimeString);
    }
	
	/**
	 * Check if the given string parameter is a valid date representation
	 *
	 * @param $datestring string|mixed The date string to validate
	 * @return boolean True if the string is a valid date string false otherwise.
	 */
	public static function isDateString($datestring) {
		$d = DateTime::createFromFormat('Y-m-d', $date);
    	return $d && $d->format('Y-m-d') === $date;
	}
}
