<?php

require_once __DIR__ . '/SourceTreeNode.php';

/**
 * Traverses all public directories and builds a file tree.
 */
class DirectoryTree {
	private $root;
	private $dirs;

	/**
	 * Sets up the directory traversal.
	 *
	 * @param string $root Root directory of the file listing.
	 * @param array  $dirs List of directories in root to traverse.
	 */
	public function __construct($root, $dirs) {
		$this->root = realpath($root);
		$this->dirs = $dirs;
	}

	/**
	 * Traverses the root directory and builds up a directory tree.
	 *
	 * @return SourceDirectory Directory listing.
	 *
	 * @throws ErrorException if an error occurred during directory traversal.
	 */
	public function traverse() {
		$listing = array();

		// Go through root subdirectories.
		foreach ($this->dirs as $subdir) {
			$dir = realpath($this->root . DIRECTORY_SEPARATOR . $subdir);
			$listing[] = new SourceDirectory($this->root, $dir,
				$this->getListing($dir));
		}

		return new SourceDirectory($this->root, $this->root, $listing);
	}

	/**
	 * Recursively lists the contents of a directory.
	 *
	 * @param string $loc  Path to the directory to be listed.
	 *
	 * @return array Directory listing.
	 *
	 * @throws ErrorException if an error occurred during directory traversal.
	 */
	protected function getListing($loc) {
		$items = array();

		// Open the directory for listing.
		$dir = opendir($loc);
		if (!$dir)
			throw new ErrorException("Failed to open directory " . $loc);

		// Go through the directory's items.
		while ($fname = readdir($dir)) {
			// Ignore parent and current entries as well as dotfiles.
			if (substr($fname, 0, 1) == '.')
				continue;

			// Build up the full path and determine if it's a directory or file.
			$fname = realpath($loc . DIRECTORY_SEPARATOR . $fname);
			$items[] = is_dir($fname) ?
				new SourceDirectory($this->root, $fname,
					$this->getListing($fname)) :
				new SourceFile($this->root, $fname);
		}

		// Finish listing the directory.
		closedir($dir);
		return $items;
	}
}
