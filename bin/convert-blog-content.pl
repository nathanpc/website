#!/usr/bin/env perl

## convert-blog-content.pl
## Converts a blog post page to a blog post content file.
##
## Author: Nathan Campos <hi@nathancampos.me>

use strict;
use warnings;

use File::Basename;

# Check if we want to delete the converted pages.
my $del_converted = (scalar(@ARGV) > 0) && ($ARGV[0] eq "-y");

# Get list of entries in blog directory.
my $phlog_folder = dirname(dirname(__FILE__)) . '/gopher/phlog/';
opendir(my $phlog_dir, $phlog_folder);
my @entries = reverse(sort(readdir($phlog_dir)));
closedir($phlog_dir);

# Go through blog post directories.
foreach (@entries) {
	# Filter only directories.
	my $dir = $phlog_folder . '/' . $_;
	if (-d $dir) {
		# Ignore dot folders.
		next if (m/^\./);
		
		# Ignore folders that don't contain an index.php file.
		next if (!-e "$dir/index.php");

		# Get parts.
		if (m/^(?<date>[^_]+)_(?<slug>.+)/i) {
			my $date = $+{date};
			my $slug = $+{slug};
			my $title = undef;
			my $in_content = 0;
			my $has_gopher = -e "$dir/post.txt";

			# Open files for conversion.
			open(my $page_fh, '<:encoding(UTF-8)', "$dir/index.php");
			open(my $content_fh, '>:encoding(UTF-8)', "$dir/content.php");

			# Go through original page file.
			print "Converting $date $slug...\n";
			while (my $line = <$page_fh>) {
				if (!defined($title)) {
					# Try to get the post's title.
					if ($line =~ m/\<title\>(?<title>[^<]+)/i) {
						$title = $+{title};
						print "    Title: $title\n";

						# Print title and gopher link.
						print $content_fh "<!-- $title -->\n";
						if ($has_gopher) {
							my $gopher_url = "gopher://nathancampos.me/0/" .
								"phlog/$_/post.txt";
							print $content_fh "<!-- Also available on " .
								"Gopher: $gopher_url -->\n";
							print "    Gopher: $gopher_url\n";
						}
						next;
					}
				} elsif (!$in_content) {
					# Check when the blog post content starts.
					if ($line =~ m/^\s+\<\/div\>\s*$/i) {
						$in_content = 1;
						next;
					}
				}

				if ($in_content) {
					# Write content to file until we reach the footer.
					if ($line =~ m/\s*\<\?php include_template\('footer'\);\s*\?\>/) {
						last;
					}
					print $content_fh $line;
				}
			}

			# Close file handles.
			close($page_fh);
			close($content_fh);

			# Delete file if command-line argument was passed.
			if ($del_converted) {
				unlink "$dir/index.php";
				print "    DELETED\n";
			}
		}
	}
}

print "Done!\n";
