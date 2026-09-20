<?php

/**
 * Base class for a tree node in the directory listing.
 */
abstract class SourceTreeNode {
	protected $root;
	protected $loc;

	/**
	 * Constructs a source tree node object.
	 *
	 * @param string $root Location of the website's root directory.
	 * @param string $loc  Absolute location of the path.
	 */
	public function __construct($root, $loc) {
		$this->root = $root;
		$this->loc = $loc;
	}

	/**
	 * Gets the base HTML tree node representation of this object.
	 *
	 * @param string $type    Type of node class.
	 * @param string $icon    Object's icon.
	 * @param string $onclick Javascript onclick event handler.
	 *
	 * @return string HTML tree node.
	 */
	protected function baseTreeNode($type, $icon, $onclick) {
		if (!empty($onclick))
			$onclick = "onclick=\"$onclick\"";

		return "<li class='$type'><span class='node' $onclick>" .
			"<img src='$icon' alt='" . $this->getBasename() . "' /> " .
			"<span class='label'>" . $this->getBasename() . "</span></span>" .
			"</li>";
	}

	/**
	 * Gets the HTML tree node representation of this object.
	 *
	 * @param string $onclick Javascript onclick event handler.
	 * @param int    $depth   Depth of the node in the tree.
	 *
	 * @return string HTML tree node.
	 */
	public abstract function asTreeNode($onclick = '', $depth = 0);

	/**
	 * Gets the basename from the location.
	 *
	 * @return string Basename of the location.
	 */
	public function getBasename() {
		return basename($this->loc);
	}

	/**
	 * Gets the path of the object relative to the website's root folder.
	 *
	 * @return string Path of the object relative to the website's root.
	 */
	public function getRelativeLocation() {
		// Normalize path.
		$path = substr($this->loc, strlen($this->root));
		if (DIRECTORY_SEPARATOR == "\\")
			$path = str_replace("\\", '/', $path);

		return $path;
	}

	/**
	 * Gets the absolute location of the object in the filesystem.
	 *
	 * @return string Absolute filesystem object location.
	 */
	public function getLocation() {
		return $this->loc;
	}
}

/**
 * Representation of a file in the website.
 */
class SourceFile extends SourceTreeNode {
	public function asTreeNode($onclick = '', $depth = 0) {
		if (empty($onclick))
			$onclick = "openFile(this, '" . $this->getRelativeLocation() . "')";

		return $this->baseTreeNode('file', href('/assets/icons/document.png'),
			$onclick);
	}
}

/**
 * Representation of a directory in the website.
 */
class SourceDirectory extends SourceTreeNode {
	protected $items;

	/**
	 * Constructs a source tree directory object.
	 *
	 * @param string $root  Location of the website's root directory.
	 * @param string $loc   Absolute location of the directory's path.
	 * @param array  $items Items inside the directory.
	 */
	public function __construct($root, $loc, $items = []) {
		parent::__construct($root, $loc);
		$this->items = $items;
		$this->sortItems();
	}

	public function asTreeNode($onclick = '', $depth = 0) {
		if (empty($onclick))
			$onclick = 'toggleExpandDirectory(this)';

		// Determine if the node should be collapsed due to its depth.
		$classes = '';
		if ($depth > 1)
			$classes = 'class="collapsed"';

		// Build up the HTML tree.
		$html = $this->baseTreeNode('dir',
			href('/assets/icons/folder_closed.png'), $onclick);
		$html = substr($html, 0, -5) . "\n<ul $classes>\n";
		foreach ($this->items as $item)
			$html .= $item->asTreeNode('', $depth + 1) . "\n";
		$html .= "</ul>\n</li>\n";

		return $html;
	}

	/**
	 * Sorts the items in this directory.
	 */
	public function sortItems() {
		usort($this->items, function ($a, $b) {
			return strcmp($a->getBasename(), $b->getBasename());
		});
	}

	/**
	 * Pushes a directory item into the items array.
	 *
	 * @param SourceTreeNode $item Directory item.
	 */
	public function pushItem($item) {
		array_push($this->items, $item);
	}

	/**
	 * Gets the list of files and folders in the directory.
	 *
	 * @return array Directory listing.
	 */
	public function getItems() {
		return $this->items;
	}
}
