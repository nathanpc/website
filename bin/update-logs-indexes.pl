#!/usr/bin/env perl

## update-logs-indexes.pl
## Ensures that the indexes of our blog and phlog are kept up-to-date.
##
## Author: Nathan Campos <hi@nathancampos.me>

use strict;
use warnings;

use File::Basename;
use File::Find;
use Cwd 'abs_path';

# Get the index last modified timestamp.
my $proj_root = dirname(dirname(abs_path($0)));
my $log_folder = "$proj_root/gopher/phlog/";
my $lmod_index = (stat("$log_folder/index.php"))[9];
our $outdated = 0;

# Go through the logs folder looking for updated posts.
find({ wanted => \&process_file, follow => 0, no_chdir => 1 }, $log_folder);
sub process_file {
	if (m/(post\.txt|content\.php)$/i) {
		my $lmod = (stat($_))[9];
		if ($lmod >= $lmod_index) {
			print "[UPDATED] $_\n";
			$outdated = 1;
		}
	}
}

# Check if we have nothing to do.
if (!$outdated) {
	print "Everything is up to date.\n";
	exit 0;
}

# Build indexes and update the sitemap.
print "Rebuilding blog index...\n";
{ require "$proj_root/bin/build-blog-index.pl"; }
print "Rebuilding phlog index...\n";
{ require "$proj_root/bin/build-phlog-index.pl"; }
print "Rebuilding sitemap...\n";
print readpipe("$proj_root/bin/update-sitemap.sh");
print "Updated all indexes.\n";
