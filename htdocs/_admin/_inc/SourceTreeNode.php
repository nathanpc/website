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
			$onclick = "onclick='$onclick'";

		return "<li class='$type' $onclick><img src='$icon' /> " .
			$this->getBasename() . "</li>";
	}

	/**
	 * Gets the HTML tree node representation of this object.
	 *
	 * @param string $onclick Javascript onclick event handler.
	 *
	 * @return string HTML tree node.
	 */
	public abstract function asTreeNode($onclick = '');

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
		return substr($this->loc, strlen($this->root));
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
	public function asTreeNode($onclick = '') {
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
	}

	public function asTreeNode($onclick = '') {
		if (empty($onclick))
			$onclick = 'toggleExpandDirectory(this)';

		// Build up the HTML tree.
		$html = $this->baseTreeNode('dir',
			href('/assets/icons/folder_closed.png'), $onclick);
		$html = substr($html, 0, -5) . "\n<ul>\n";
		foreach ($this->items as $item)
			$html .= $item->asTreeNode() . "\n";
		$html .= "</ul>\n</li>\n";

		return $html;
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
