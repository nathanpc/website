#!/bin/sh

## img-compat-dir.sh
## Converts all images in a directory to ultra light versions.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

if [ $# -ne 1 ]; then
	echo "usage: $0 imgdir"
	exit 1
fi
imgdir="$1"
bindir="$(dirname "$0")"

find "$imgdir" -type f \( -name '*.png' -o -name '*.jpg'  -o -name '*.bmp' \
	-o -name '*.jpeg' -o -name '*.JPG' -o -name '*.webp' \) \
	-exec $bindir/img-compat.sh {} \;
