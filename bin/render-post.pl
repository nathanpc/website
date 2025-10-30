#!/usr/bin/env perl

## render-post.pl
## Renders a blog post to HTML.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

use strict;
use warnings;
use autodie;

use File::Basename;

use FindBin;
use lib $FindBin::Bin;
require 'render-apt.pl';

# Ensure we have the required arguments.
if (scalar(@ARGV) < 1) {
	print "usage: $0 postfile\n";
	exit 1;
}

# Render APT file to HTML.
my @html = Render::APT::render_file($ARGV[0]);

# Get Gopher URL.
my $post_dir = basename(dirname(Cwd::abs_path($ARGV[0])));
my $gopher_url = "gopher://nathancampos.me/0/phlog/$post_dir/post.txt";

# Get title and remove useless lines.
my $title = substr(shift @html, 4);
shift @html;
shift @html;

# Get post published date.
my $date = '?';
if ($post_dir =~ m/^(?<year>[0-9]{4})-(?<month>[0-9]{2})-(?<day>[0-9]{2})/i) {
	$date = $+{year} . '-' . $+{month} . '-' . $+{day};
}

# Print header part of the file.
print <<"HEADER";
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>$title</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>$title</h2>
		<div id="published-date">$date - <a href="$gopher_url">Also available on Gopher</a></div>
	</div>

HEADER

# Print out the post's HTML.
print '<pre id="plain-text">';
for my $line (@html) {
	# Substitute links for ones on the website.
	$line =~ s|gopher://nathancampos\.me/./phlog/|http://nathancampos.me/log/|g;
	$line =~ s|(http://nathancampos\.me/log/[^/]+/)post.txt|$1|g;

	# Print rendered line out.
	print "$line\n";
}
print "</pre>\n";

# Print page footer.
print <<FOOTER;

	<?php include_template('footer'); ?>
</body>
</html>
FOOTER
