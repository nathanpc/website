#!/bin/bash

## update-page.sh
## Updates a page based on its content HTML and only if it has been changed
## recently compared to the outputfile.
##
## Author: Nathan Campos <hi@nathancampos.me>

if [ $# -ne 1 ] && [ $# -ne 2 ]; then
	echo "usage: $0 [-f] contentfile"
	echo ""
	echo "    -f    Forces the update of all files"
	exit 1
fi

# Get the content file path.
contentfile="$1"
force=false
if [ $# -eq 2 ]; then
	# Are we forcing the update?
	if [ $1 = "-f" ]; then
		contentfile="$2"
		force=true
	else
		echo "error: first argument must be -f if force is needed"
		exit 1
	fi
fi

outfile=$(echo "$contentfile" | sed -e 's/\.cnt\.html$/.html/')
bindir="$(dirname "$0")"
templatedir="$(dirname $(dirname "$0"))/templates"

# ANSI colors.
BLUE='\033[0;34m'
RED='\033[0;31m'
NC='\033[0m'

# Check if an update is needed.
echo -n "$contentfile: "
if [ $force = false ] && [ "$contentfile" -ot "$outfile" ]; then
	printf "${BLUE}not modified${NC}\n"
	exit 0
fi

# Update the file.
$bindir/make-page.sh "$contentfile" > "$outfile"
printf "${RED}updated${NC}\n"
