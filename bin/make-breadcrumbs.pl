#!/usr/bin/env perl

## make-breadcrumbs.pl
## Writes the HTML breadcrumbs section for a given a file.
##
## Author: Nathan Campos <hi@nathancampos.me>

use strict;
use warnings;
use autodie;

use File::Basename;
use Term::ANSIColor;
use Cwd qw(abs_path);

# Get the base htdocs folder path
our $htdocs = abs_path(dirname(__FILE__) . '/../htdocs/');

# Makes the breadcrumbs HTML from a normalized string (relative to htdocs).
sub make_crumbs {
	my ($relpath) = @_;
	my @crumbs = split /\//, $relpath;
	my $sep = '<span class="sep">/</span>';

	# Are we dealing with the website's homepage?
	if ($relpath =~ /^\/index\.(php|html?)/) {
		print "<div id=\"breadcrumbs\">\n\t$sep\n\t<span class=\"label\">" .
			"index</span>\n</div>\n";
		return;
	}

	# Go through the path splits and build the crumbs.
	my $html = '';
	while (scalar(@crumbs) > 0) {
		my $href = join '/', @crumbs;
		my $label = pop @crumbs;

		# Ignore some instances.
		next if (length $label == 0);
		next if ($label =~ /^index\.(php|html?)/);
		
		$html = " $sep <a class=\"label\" href=\"$href\">$label</a>" . $html;
	}

	# Print out the built HTML.
	$html = substr $html, 1;
	print "<div id=\"breadcrumbs\">\n\t$html\n</div>\n";
}

# Ensure we have a filename to get the relative path from.
if (scalar(@ARGV) < 1) {
	print "usage: $0 fname\n";
	exit 1;
}
my $fname = abs_path($ARGV[0]);

# Check if the path is not a subfolder of htdocs.
if (rindex($fname, $htdocs, 0) < 0) {
	print STDERR colored("ERROR: Path $ARGV[0] is not a subfolder of htdocs.",
		'red'), "\n";
	exit 1;
}

# Remove the template suffix.
$fname =~ s/\.cnt\././;

# Build up the breadcrumbs HTML.
make_crumbs(substr $fname, length($htdocs));
