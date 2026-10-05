#!/usr/bin/env perl

## build-blog-index.pl
## Builds the blog index page.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

use strict;
use warnings;
use autodie;

use File::Basename;
use Cwd 'abs_path';

print STDERR "Building blog index\n";

# Print header part of the file.
print <<'HEADER';
<!--
Nathan's random musings
Nathan's personal blog. Where you can follow his adventures in the world of technology.
-->

HEADER

# Get list of entries in blog directory.
my $blog_folder = dirname(dirname(abs_path($0))) . '/gopher/phlog/';
opendir(my $blog_dir, $blog_folder);
my @entries = reverse(sort(readdir($blog_dir)));
closedir($blog_dir);

# Go through entries to create the index.
my $last_year = '';
foreach (@entries) {
	# Filter only directories.
	my $dir = "$blog_folder/$_";
	if (-d $dir) {
		# Ignore dot folders.
		if (m/^\./) {
			next;
		}

		# Ignore folders without a blog post.
		my $post_file = "$dir/index.cnt.html";
		next if ((!-e $post_file) or (!-e "$dir/index.html"));

		# Get parts.
		if (m/^(?<year>[0-9]{4})-(?<month>[0-9]{2})-(?<day>[0-9]{2})_(?<slug>.+)/i) {
			my $date = $+{year} . '-' . $+{month} . '-' . $+{day};
			my $slug = $+{slug};

			# Print year section if needed.
			if ($+{year} ne $last_year) {
				$last_year = $+{year};
				print "\n\t<h3 class=\"post-year\">$last_year</h3>\n\n";
			}

			# Get post title.
			open(my $fh, '<', $post_file);
			<$fh>;
			my $title = <$fh>;
			chomp $title;
			close($fh);

			# Print post entry.
			print STDERR "Adding $date - $title... ";
			print <<"POST";
	<div class="post-listing">
		<span class="published-date">$date</span>
		<a class="title" href="/log/$date/$slug">
			$title
		</a>
	</div>
POST
			print STDERR "ok\n";
		}
	}
}

print STDERR "Done!\n";
