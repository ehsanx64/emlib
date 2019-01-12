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

	/**
	 * Set modules directory path. An autoloader is also registered.
	 *
	 * @param string $path Absolute path to directory holding the modules
	 */
	public function setModulesDir($path) {
		$this->registerAutoloader($path);
		$this->_moduleDirPath = $path;
	}

	/**
	 * Get the modules directory path.
	 *
	 * @return string Returns the modules directory path
	 */
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

	/**
	 * Load a module.
	 *
	 * @param string $name The module name
	 * @param string $path Absolute path to module directory
	 */
	public function loadModule($name, $path) {
		$this->modules[$name] = [
			'path' => $path
		];

		$module = sprintf("%s%sindex.php", $path, DIRECTORY_SEPARATOR);

		if (file_exists($module) && is_readable($module)) {
			require $module;
		}
	}

	/**
	 * Register an autoloader for a given path
	 *
	 * @param string $path Absolute path to directory which should be used as root for autoloading
	 */
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