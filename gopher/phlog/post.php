<?php
	require_once __DIR__ . '/../../src/compat.php';
	require_once __DIR__ . '/../../src/common_utils.php';

	// Get the post parts.
	$parts = explode('_', $argv[1], 2);
	$date = preg_replace('/[^0-9-]+/', '', $parts[0]);
	$slug = preg_replace('/[^a-z_0-9-]+/', '', $parts[1]);
	$folder = __DIR__ . '/' . $date . '_'  . $slug;
	$exists = file_exists("$folder/content.php");

	// Get post title.
	$title = fgets(fopen("$folder/content.php", 'r'));
	$title = preg_replace('/^\s*\<\!--\s+/', '', $title);
	$title = preg_replace('/\s+--\>\s*$/', '', $title);

	// Check if a Gopher version exists.
	$gopher_url = null;
	if (file_exists("$folder/post.txt"))
		$gopher_url = "gopher://nathancampos.me/0/phlog/{$date}_{$slug}/post.txt";
?><!--
<?php
	echo "$title\n";
	echo "Blog post published on $date.";
	if (!is_null($gopher_url))
		echo " Also available on Gopher: $gopher_url";
	echo "\n";
?>
-->

<?php include "$folder/content.php"; ?>