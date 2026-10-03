#!/bin/bash

## update-page.sh
## Updates a page based on its content HTML and only if it has been changed
## recently compared to the outputfile.
##
## Author: Nathan Campos <hi@nathancampos.me>

# Usage message. $1 is return code.
usage() {
	echo "usage: $0 [-f] [-b] contentfile"
	echo ""
	echo "    -f    Forces the update of all files"
	echo "    -b    Pages to be updated are blog posts (adds special header)"
	exit $1
}

# Check if we have any arguments.
if [ $# -eq 0 ]; then
	usage 1
fi

# Handle command-line arguments.
isblog=""
force=false
while getopts "hbf" arg; do
	case $arg in
		b)
			isblog="-b"
			;;
		f)
			force=true
			;;
		h)
			usage 0
			;;
		*)
			usage 1
			;;
		esac
done

# Ignore all parsed arguments.
shift $((OPTIND - 1))

# Get the content file path and other paths.
contentfile="$1"
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
$bindir/make-page.sh $isblog "$contentfile" > "$outfile"
printf "${RED}updated${NC}\n"
