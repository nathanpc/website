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
