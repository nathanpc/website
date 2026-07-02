<?php
	// Get the post folder.
	$date = preg_replace('/[^0-9\-]/', '', $_GET['date']);
	$slug = preg_replace('/[^0-9a-zA-Z\-_]/', '', $_GET['slug']);
	$folder = __DIR__ . '/' . $date . '_'  . $slug;
	$exists = file_exists("$folder/content.php");

	// Get post title.
	$title = "Post not found";
	if ($exists) {
		$title = fgets(fopen("$folder/content.php", 'r'));
		$title = preg_replace('/^\s*\<\!--\s+/', '', $title);
		$title = preg_replace('/\s+--\>\s*$/', '', $title);
	} else {
		http_response_code(404);
	}

	// Check if a Gopher version exists.
	$gopher_url = null;
	if (file_exists("$folder/post.txt")) {
		$gopher_url = "gopher://nathancampos.me/0/phlog/$date" .
			"_$slug/post.txt";
	}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../templates/head.php'; ?>
	<?php if ($exists) set_base_url("/log/${date}_${slug}/"); ?>

	<!-- Page information. -->
	<title><?= $title ?></title>
</head>
<body>
	<?php include_template('header'); ?>

	<?php if (!$exists) { ?>
		<div class="section">
			<h2>Post not found</h2>

			<p>Sorry, but we were not able to find the blog post you have asked
				for.</p>

			<!--
				Date: <?= $date ?>
				Slug  <?= $slug ?>
			-->

			<p><?= compat_image('/assets/images/http-status/404.jpg',
				'404 Not Found cat meme') ?></p>
		</div>
	<?php goto footer; } ?>

	<div id="blog-post" class="section">
		<h2><?= $title ?></h2>
		<div id="published-date"><?php
			echo $date;
			if (!is_null($gopher_url)) {
				echo " - <a href=\"$gopher_url\">Also available on Gopher</a>";
			}
		?></div>
	</div>

	<?php include "$folder/content.php"; ?>

	<?php
		footer:	
		include_template('footer');
	?>
</body>
</html>
