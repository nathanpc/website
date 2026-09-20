/**
 * treeview.js
 * Handles the directory tree view component.
 *
 * @author Nathan Campos <hi@nathancampos.me>
 */

"use strict";

/**
 * Toggles the expansion of a directory in the tree view.
 *
 * @param {HTMLElement} elem Directory element that called this.
 */
function toggleExpandDirectory(elem) {
	var ul = elem.parentElement.getElementsByTagName("ul")[0];
	ul.classList.toggle("collapsed");
}

/**
 * Opens a file for editing using the web editor.
 *
 * @param {HTMLElement} elem Element that fired this event.
 * @param {string}      file File path, relative to the website's root, to be
 *                           opened.
 */
function openFile(elem, file) {
	$('#content-cell iframe').attr('src', 'editor.php?file=' +
		encodeURIComponent(file));
}

/**
 * Resizes the layout of the entire view depending on the size of the window.
 */
function resizeLayout() {
	// Resize table.
	var table = $('#main-table');
	var header = $('#header-row');
	table.outerHeight(window.innerHeight - table.offsetTop, true);

	// Resize the tree view and content cells.
	var treeView = $('#treeview-cell');
	var contentCell = $('#content-cell');
	treeView.outerHeight(window.innerHeight - header.outerHeight(true) - 5,
		true);

	// Determine the horizontal sizing of the table based on window width.
	if (window.innerWidth > 1000) {
		$('#header-row > td').attr('colspan', 4);
		contentCell.attr('colspan', 3);
	} else {
		$('#header-row > td').attr('colspan', 3);
		contentCell.attr('colspan', 2);
	}

	// Resize the content area iframe.
	var iframe = $('#content-cell iframe');
	iframe.outerHeight(contentCell.height() - 5, true);
	iframe.outerWidth(contentCell.width(), true);
}
window.addEventListener("resize", resizeLayout);
