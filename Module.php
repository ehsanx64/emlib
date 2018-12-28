<?php
namespace ehsanx64\phplib;

class Module {
	private $moduleDirPath;
	private $modules = [];

	public function __construct($modulesDir = '') {
		// If moduleDir is given using constructor we'll automate some tasks
		if (!empty($modulesDir)) {
			$this->setModulesDir($modulesDir);
			$this->loadModules();
		}
	}

	/**
	 * @param $path Absolute path to directory holding the modules
	 */
	public function setModulesDir($path) {
		$this->_moduleDirPath = $path;
	}

	public function getModuleDir() {
		return $this->_moduleDirPath;
	}

	/**
	 * Search for modules in module dir path and load them
	 */
	public function loadModules() {
		$fs = new FileSystem();
		$modules = $fs->getDirectories($this->_moduleDirPath);

		foreach ($modules as $module) {
			$this->loadModule($fs->getLastPart($module), $module);
		}
	}

	public function loadModule($name, $path) {
		$this->modules[$name] = [
			'path' => $path
		];

		$module = sprintf("%s%sindex.php", $path, DIRECTORY_SEPARATOR);
		if (file_exists($module) && is_readable($module)) {
			require $module;
		}
	}
}