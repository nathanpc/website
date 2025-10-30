<div id="header">
	<!-- Title header block. -->
	<div id="title-head">
		<h1>Nathan Campos</h1>
		<?php
			require_once __DIR__ . '/../src/breadcrumbs.php';
			echo breadcrumbs(isset($crumbs) ? $crumbs : breadcrumbs_fromreq());
		?>
	</div>

	<!-- Navigation bar. -->
	<div id="navbar">
		<?php
			require_once __DIR__ . '/../src/navbar.php';
			echo navbar(array(
				'index' => '/',
				'gopher' => 'gopher://nathancampos.me:70/1/',
				'projects' => '/projects',
				'log' => '/log',
				'links' => '/links',
				'wiki' => '//wiki.nathancampos.me/',
				'work' => '//innoveworkshop.com/',
				'meta' => '/meta',
				'contact' => '/contact'
			));
		?>
	</div>

	<hr>
</div>

<div id="content">
