#!/bin/bash

## make-page.sh
## Builds up and entire page from a content HTML file.
##
## Author: Nathan Campos <hi@nathancampos.me>

# Usage message. $1 is return code.
usage() {
	echo "usage: $0 [-b] contentfile"
	echo ""
	echo "    -b    This page is a blog post and should get a special header"
	exit $1
}

# Check if we have any arguments.
if [ $# -eq 0 ]; then
	usage 1
fi

# Handle command-line arguments.
isblog=false
while getopts "hb" arg; do
	case $arg in
		b)
			isblog=true
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

contentfile="$1"
bindir="$(dirname "$0")"
templatedir="$(dirname $(dirname "$0"))/templates"
bname=$(basename $(dirname "$contentfile"))
postdate=${bname%%_*}

# Get page title and description.
title=$(head -2 "$contentfile" | tail -1)
description=$(head -3 "$contentfile" | tail -1)
cleantitle=$title

# Append name to title if this is a blog post and create description.
if [[ $isblog == true ]]; then
	title="$title - Nathan Campos"
	description="Blog post published on $postdate"
fi

# Print out the DOCTYPE and head tag contents.
cat "$templatedir/doctype.html"
cat "$templatedir/head.html"
printf "\n<!-- Page information. -->\n<title>$title</title>\n"
printf "<meta name=\"description\" content=\"$description\"></head>\n<body>\n"
title=$cleantitle

# Print out the header.
cat "$templatedir/header-top.html"
$bindir/make-breadcrumbs.pl "$contentfile"
cat "$templatedir/header-bottom.html"

# Add blog post header if page is a blog post.
if [[ $isblog == true ]]; then
	printf "is blog post " >&2
	hasgopher=false
	if [ -f "$(dirname "$contentfile")/post.txt" ]; then
		printf "(and phlog) " >&2
		hasgopher=true
	fi

	echo '<div id="blog-post" class="section">'
	printf "\t<h2>$title</h2>\n\t<div id=\"published-date\">$postdate"
	if [[ $hasgopher == true ]]; then
		printf " - <a href=\"gopher://nathancampos.me/0/phlog/$bname/post.txt\""
		printf ">Also available on Gopher</a></div>"
	fi
	printf "\n</div>"
fi

# Print out the content of the page.
awk 'NR>4' "$contentfile"
echo "</div> <!-- .content -->"

# Print out footer and close the HTML file.
$bindir/make-footer.pl "$contentfile"
echo -e "</body>\n</html>"
