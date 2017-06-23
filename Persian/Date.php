<?php


namespace ehsanx64\libphp\Persian;

include __DIR__ . '/jdf-2.70.php';

//  Date class
class Date {
	public static function getTime() {
		echo Jdate::jdate('j F Y', time());
	}
}
