<?php
namespace ehsanx64\phplib;

/*
 * Simple Translation System
 */
class Translate {
	/**
	 * @var string $translateDirPath Directory in which translate are located
	 */
	private $translateDirPath;

	/**
	 * @var array $modules Array containing loaded modules details (name, path etc)
	 */
	private $modules = [];

	/**
	 * Constructor. It will automate some tasks if argument provided.
	 *
	 * @param string $translateDir Translate directory absolute path. If this parameter is provided
	 * translations will be loaded automatically.
	 */
	public function __construct($translateDir = '') {
		// If translateDir is given using constructor we'll automate some tasks
		if (!empty($translateDir)) {
			$this->translateDirPath = $translateDir;
		}
	}

	public function getLocale() {
		return 'fa';
		return 'en';
	}

	public function t($key) {
		$targetFile = $this->translateDirPath . '/' . $this->getLocale() . '.php';
		if (file_exists($targetFile)) {
			$values = include $targetFile;
		}

		if (isset($values[$key])) {
			return $values[$key];
		}

		return $key;
	}
}