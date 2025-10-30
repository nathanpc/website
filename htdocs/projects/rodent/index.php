<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Rodent - Gopher Client</title>
	<meta name="description" content="A modern, native, Gopher client for new and old computers.">
</head>
<body>
	<?php include_template('header'); ?>

	<div class="section">
		<h2>Rodent</h2>

		<p>
			A modern, native, and GUI-based,
			<a href="https://gopher.floodgap.com/gopher/gw?a=gopher%3A%2F%2Fgopher.floodgap.com%2F1%2Fgopher">Gopher</a>
			client for new and old computers. Bringing you the joys of glorious
			plain text along icons, a modern user interface, and full
			integration with your operating systems other applications.
		</p>

		<p>
			The idea for this client came about during the <a href="http://occ.sdf.org/#2024">2024
			edition of The Old Computer Challenge</a> when was looking for a
			native client to browse gopherspace, since <a href=http://gopher.floodgap.com/overbite/">OverbiteFF</a>
			was feeling a bit too slow on my Power Mac G5, and was shocked to
			know that there were no newer graphical clients available, so I
			decided I should make one. You can follow some of this project's
			history via <a href="http://bb.deadnet.se/viewtopic.php?t=94">a
			series of posts I made during OCC</a> documenting a bit of the
			process.
		</p>

		<p>
			<b>Warning:</b> Due to a busy life and other projects getting on the
			way, this hasn't been finished, although on Windows it's basically
			finished, it's just missing a lot of polishing.
		</p>
	</div>

	<div class="section">
		<h3>screenshots</h3>

		<?= compat_image_gallery(array(
			array('loc' => "./screenshots/overbite-orig.png", 'alt' => "Application showing Floodgap's Overbite menu")
		)); ?>
	</div>

	<div class="section">
		<h3>requirements</h3>

		<p>
			The main target of this application is Windows, although some
			efforts have been made to port it to UNIX variants, but have since
			stalled.
		</p>

		<p>
			For the Windows port the application, it's designed to be compatible
			with Windows 95 all the way to the latest AI garbage from Microsoft,
			which is currently Windows 11. It comes with a project for Visual
			Studio 6 (requires the <a href="https://archive.org/details/MSDN_-_No_0004.7_-_May_2003">Windows
			Server 2003 PSDK</a>) and a solution for Visual Studio 2010.
		</p>

	<div class="section">
		<h3>downloads</h3>

		<ul>
			<li><a href="https://github.com/nathanpc/rodent">Source code</a></li>
		</ul>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>
