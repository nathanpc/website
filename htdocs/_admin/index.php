<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php require_once __DIR__ . '/../../templates/includes.php'; ?>

	<!-- Character set. -->
	<meta charset="UTF-8">

	<!-- Page information. -->
	<title>Administration - Nathan Campos</title>
	<meta name="description" content="My personal website's backoffice.">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?= href('./admin.css') ?>">

	<!-- Scripts -->
	<script type="application/javascript"
			src="<?= href('/assets/libs/jquery-1.12.4.min.js') ?>"></script>
	<script type="application/javascript" src="<?= href('./treeview.js') ?>"></script>
</head>
<body onload="resizeLayout()">
	<table id="main-table" border="1" cellpadding="1" cellspacing="1">
		<tbody>
			<tr id="header-row">
				<td colspan="4">
					<h1>Backoffice</h1>
				</td>
			</tr>
			<tr>
				<td id="treeview-cell">
					<?php
					// Setup directory traversal for listing.
					require_once __DIR__ . '/_inc/DirectoryTree.php';
					$tree = new DirectoryTree(__DIR__ . '/../../', ['gopher', 'htdocs']);
					$listing = $tree->traverse();
					?>

					<ul id="treeview">
						<?= $listing->asTreeNode() ?>
					</ul>
				</td>
				<td id="content-cell" colspan="3">
					<h2>content</h2>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>
