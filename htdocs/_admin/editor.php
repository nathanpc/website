<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php require_once __DIR__ . '/../../templates/includes.php'; ?>

	<!-- Character set. -->
	<meta charset="UTF-8">

	<!-- Page information. -->
	<title>Web Editor (<?php if (isset($_GET['file'])) echo $_GET['file']; ?>)
        - Nathan Campos</title>
	<meta name="description" content="Online editor to be embedded within another page.">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?= href('./admin.css') ?>">

	<!-- Scripts -->
	<script type="application/javascript"
	        src="<?= href('/assets/libs/jquery-1.12.4.min.js') ?>"></script>
    <script type="application/javascript">
	    function resizeEditor() {
		    // Resize editor textarea.
		    var editor = $('#editor');
		    editor.outerHeight(window.innerHeight - editor.offset().top, true);
			console.log(editor.outerHeight(true));
	    }
	    window.addEventListener("resize", resizeEditor);
    </script>
</head>
<body onload="resizeEditor()">
    <?php
        // Check if the file parameter was passed.
        $contents = '';
        if (!isset($_GET['file'])) {
            echo '<p>ERROR: File argument not provided.</p>';
            goto footer;
        }

        // Check if the file is in a valid folder.
        $path = realpath(__DIR__ . '/../../' . $_GET['file']);
        if (empty($path)) {
	        echo '<p>ERROR: File ' . $_GET['file'] . ' <code>realpath</code> does not exist.</p>';
	        goto footer;
        }

        // Check if the file exists.
        if (!file_exists($path)) {
	        echo '<p>ERROR: File ' . $_GET['file'] . ' does not exist.</p>';
	        goto footer;
        }

        // Check if the file is text.
        if (!isset($_GET['force']) || !(bool)$_GET['force']) {
            // Get the MIME type of the file.
	        $finfo = finfo_open(FILEINFO_MIME);
            $mime = finfo_file($finfo, $path);
	        @finfo_close($finfo);

            // Check if it starts with text.
	        if (substr($mime, 0, 4) != 'text') {
                $url = $_SERVER['SCRIPT_NAME'] . '?' .
                    http_build_query(array_merge($_GET, array('force' => '1')));
                echo '<p>WARNING: File ' . $_GET['file'] . " is of type <code>$mime</code>, " .
                    'and probably does not contain plain text, thus cannot be edited.</p>';
                echo "<p>If you are sure about editing this file, you can <a href='$url'>force " .
                    'it to be opened</a>, but only if you are 100% sure about it.</p>';
                goto footer;
            }
        }

        // Get the contents of the file.
        $contents = file_get_contents($path);
    ?>

    <div id="editor-controls">
        <span class="filename"><?= $_GET['file'] ?></span>
        <button>Test</button>
    </div>

	<textarea id="editor" cols="80" rows="25"><?= $contents ?></textarea>

    <?php footer: ?>
</body>
</html>
