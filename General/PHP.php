<?php
namespace ehsanx64\libphp\General;

class PHP {
    /**
	 * Enable displaying of all errors
	 */
	public static function enableFullErrorReporting() {
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	}

	/**
	 * Enable displaying of only fatal errors
	 */
	public static function enableErrorReporting() {
		ini_set('display_errors', 1);
		error_reporting(E_ERROR);
	}
}
