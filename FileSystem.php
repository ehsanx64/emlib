<?php
namespace ehsanx64\phplib;

class FileSystem {
	/**
	 * Return array of directories in a given directory
	 * @param $basePath The directory to return its subdirectories
	 */
	public function getDirectories($basePath) {
		$dirs = array_filter(glob($basePath . DIRECTORY_SEPARATOR . '*'), 'is_dir');
		return $dirs;
	}

	public function getLastPart($path) {
		$parts = explode(DIRECTORY_SEPARATOR, $path);
		return $parts[count($parts) - 1];
	}
}