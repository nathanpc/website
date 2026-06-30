#!/bin/sh

proj=$(dirname $(dirname $(realpath "$0")))

"$proj/bin/list-page-paths.pl" | "$proj/bin/build-sitemap.pl" "$proj" > "$proj/htdocs/sitemap.xml"
echo "Done!"
