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
		<span class="item"><a href="/">index</a></span>
		<span class="spacer">|</span>
		<span class="item"><a href="gopher://nathancampos.me:70/1/">gopher</a></span>
		<span class="spacer">|</span>
		<span class="item"><a href="/projects">projects</a></span>
		<span class="spacer">|</span>
		<span class="item"><a href="/log">log</a></span>
		<span class="spacer">|</span>
		<span class="item"><a href="/links">links</a></span>
		<span class="spacer">|</span>
		<span class="item"><a href="//wiki.nathancampos.me/">wiki</a></span>
		<span class="spacer">|</span>
		<span class="item"><a href="//innoveworkshop.com/">work</a></span>
		<span class="spacer">|</span>
		<span class="item"><a href="/meta">meta</a></span>
		<span class="spacer">|</span>
		<span class="item"><a href="/contact">contact</a></span>
	</div>

	<hr>
</div>

<div id="content">
