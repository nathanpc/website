#!/usr/bin/env perl

## build-sitemap.pl
## Builds the website map for search engines.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

use strict;
use warnings;
use autodie;

use POSIX;
use File::stat;

# Possible extensions for visible pages.
my $page_ext = qr/php|html?|asp/;

# Get the path prefix to be removed from the paths passed to us.
my $path_prefix = './';
if (scalar(@ARGV) > 0) {
	$path_prefix = $ARGV[0];
	chomp $path_prefix;
}

# Define the URL prefix for the sitemap.
my $url_prefix = 'https://nathancampos.me';

# Print header part of the file.
print "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

# Get the list of files to build into the sitemap from STDIN.
while (my $path = <STDIN>) {
	# Clean up weirdness in file path.
	chomp $path;
	$path =~ s|//|/|g;

	# Clean up the path for a URL.
	my $url = $path;
	$url =~ s/^\Q$path_prefix\E//;
	$url =~ s/^.*htdocs\///;
	$url =~ s/index\.($page_ext)$//;

	# Clean up the path for the blog.
	$url =~ s|/gopher/phlog|log|;
	
	# Handle the special case of blog entries.
	if ($url =~ m|log/[^/]+/content\.($page_ext)$|) {
		$url =~ s/content.($page_ext)$//;
		$url = join('/', split(/_/, $url, 2));
	}

	# Get the file's last modified date.
	my $tm = stat($path)->mtime;
	my $lastmod = strftime('%Y-%m-%d', gmtime($tm));

	# Print the URL entry.
	print <<"ENTRY";
	<url>
		<loc>$url_prefix/$url</loc>
		<lastmod>$lastmod</lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.5</priority>
	</url>
ENTRY
}

# Print file footer.
print "</urlset>\n";
