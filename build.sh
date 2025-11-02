#!/bin/sh

echo "Building web blog index..."
perl ./bin/build-blog-index.pl
echo "Building Gopher phlog index..."
perl ./bin/build-phlog-index.pl

echo "Building sitemap..."
find ./htdocs/ ./gopher/phlog/ -type f -name '*.php' -not -path \
	'./htdocs/errors/*' | ./bin/build-sitemap.pl > ./htdocs/sitemap.xml
