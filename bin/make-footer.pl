#!/usr/bin/env perl

## make-footer.pl
## Writes the HTML footer for a given a file.
##
## Author: Nathan Campos <hi@nathancampos.me>

use strict;
use warnings;
use autodie;

use File::stat;
use Time::Piece;

# Ensure we have a filename to get the modified date from.
if (scalar(@ARGV) < 1) {
	print "usage: $0 fname\n";
	exit 1;
}

# Build up the variables to be used in the template.
my $year = gmtime->strftime('%Y');
my $mdate = gmtime(stat($ARGV[0])->mtime)->strftime('%Y-%m-%d %H:%M');

# Print out the HTML footer.
print <<"FOOTER";
<div id="footer">
	<hr>
	<div class="copyright">
		Nathan Campos &#169; 2024-$year
	</div>
	<div class="last-modified">
		Last modified: $mdate
	</div>
</div>
FOOTER
