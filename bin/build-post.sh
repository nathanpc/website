#!/bin/sh

## build-post.sh
## Performs all the necessary steps to build up a (ph|b)log post.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

if [ $# -ne 1 ]; then
	echo "usage: $0 postdir"
	exit 1
fi
postdir="$1"
bindir="$(dirname "$0")"

# Convert images.
echo 'Creating compatible images...'
$bindir/img-compat-dir.sh "$postdir"

# Make blog post page.
echo 'Building HTML version...'
$bindir/render-post.pl "$postdir/post.txt" > "$postdir/index.php"

echo "Don't forget to run make to build indexes and the sitemap!"
echo 'Done.'
