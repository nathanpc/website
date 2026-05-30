#!/bin/bash

## make-page.sh
## Builds up and entire page from a content HTML file.
##
## Author: Nathan Campos <hi@nathancampos.me>

if [ $# -ne 1 ]; then
	echo "usage: $0 contentfile"
	exit 1
fi
contentfile="$1"
bindir="$(dirname "$0")"
templatedir="$(dirname $(dirname "$0"))/templates"

# Get page title and description.
title=$(head -2 "$contentfile" | tail -1)
description=$(head -3 "$contentfile" | tail -1)

# Print out the DOCTYPE and head tag contents.
cat "$templatedir/doctype.html"
cat "$templatedir/head.html"
echo -e "\n<!-- Page information. -->"
echo "<title>$title</title>"
echo -e "<meta name=\"description\" content=\"$description\">"
echo -e "</head>\n<body>"

# Print out the header.
cat "$templatedir/header-top.html"
$bindir/make-breadcrumbs.pl "$contentfile"
cat "$templatedir/header-bottom.html"

# Print out the content of the page.
awk 'NR>4' "$contentfile"
echo "</div> <!-- .content -->"

# Print out footer and close the HTML file.
$bindir/make-footer.pl "$contentfile"
echo -e "</body>\n</html>"
