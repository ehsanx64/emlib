<?php
namespace ehsanx64\phplib\General;

/**
 * Class PHP
 *
 * This class contains general PHP utilities.
 * @package ehsanx64\phplib\General
 */
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
