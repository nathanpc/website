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
</head>
<body>
	<?php
		// Setup directory traversal for listing.
		require_once __DIR__ . '/_inc/DirectoryTree.php';
		$tree = new DirectoryTree(__DIR__ . '/../../', ['gopher', 'htdocs']);
        $listing = $tree->traverse();
	?>
    <ul id="treeview">
        <?= $listing->asTreeNode() ?>
    </ul>
</body>
</html>
