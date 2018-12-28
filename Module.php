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
		$this->registerAutoloader($path);
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
			$this->loadModule($fs->getLastPart($module), $module, true);
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

	public function registerAutoloader($path) {
		spl_autoload_register(function($class) use ($path) {
			// Use current directory as root to start referencing
			$parentDir = $path;

			// Convert namespace path to file system path
			$className = str_replace("\\", '/', $class);

			if (!is_array($className)) {
				if (empty($class)) {
					return false;
				}
			} else {
				$className = array_pop($className);
			}

			// If file path exists include it
			if (file_exists($parentDir . '/' . $className . '.php')) {
				require $parentDir . '/' . $className . '.php';
			}
		});
	}
}