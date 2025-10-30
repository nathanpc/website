<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Nathan's Website Information</title>
	<meta name="description" content="Meta information about the website you're currently visiting'.">
</head>
<body>
	<?php include_template('header'); ?>

	<div class="section">
		<h2>meta</h2>

		<p>In this page you will find information about this website. Like it or
		not it's a slow website, not because your internet is slow, but instead
		because of <a href="#why-so-slow">this</a> and the fact it's hosted on
		an <a href="https://www.parkytowers.me.uk/thin/hp/t5740/">HP t5740 thin
		client</a> from 2012, running <a href="https://en.wikipedia.org/wiki/Windows_Server_2008">Windows
		Server 2008</a> (the one based on Vista). The reason for the weird setup
		is the usual "because I could" and as a challenge to myself during
		<a href="gopher://nathancampos.me:70/0/occ/2025/day4.txt">OCC2025</a>.
		</p>

		<p>I'm sure this is not the weirdest setup for a website on the
		internet. Surely someone has something even weirder floating around with
		a public IP, but my website is definitely up there with the weirdos,
		just as I like it.</p>

		<p><?= compat_image('./updating.png',
			'A screenshot of the server while it was doing its initial update')
		?></p>

		<p>If you wish to set something up that's just as weird as my setup, I
		have documented some of this journey on my own
		<a href="https://wiki.nathancampos.me/doku.php?id=start#solar-powered_windows_server">knowledge
		base</a>, including how to get PHP working on IIS and how to setup the
		4G connection to be exposed to the public internet.</p>
	</div>

	<div class="section">
		<h2 id="why-so-slow">why is this website so slow?</h2>

		<p>You may have probably noticed that this website is very slow. By our
		modern standard that every website has to load instantly, this website
		is slow. The reason for this is that it's only connection to the
		internet is via a <a href="https://en.wikipedia.org/wiki/4G">4G</a>
		modem. This is by design, since the website is meant to be
		"self-sufficient" and not require any external resources to operate,
		using the cellular network is the easiest way to achieve this, thus the
		reason why it's so slow.</p>

		<p><?= compat_image('./speedtest.png',
			'Network speed test of the 4G connection') ?></p>

		<p>The connection to the cellular network is currently provided by
		<a href="https://www.digi.pt/">DIGI Portugal</a>, since it's the
		cheapest service currently available in the country, and is thankfully
		putting some pressure on the well-stablished carriers. Competition is
		always welcome!</p>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>
