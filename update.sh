#!/bin/sh

echo "*** Website Updater ***"
echo ""
root=$(dirname $(realpath "$0"))

echo "Updating robots.txt against new AI crawlers..."
curl -o "$root/htdocs/robots.txt" \
	'https://raw.githubusercontent.com/ai-robots-txt/ai.robots.txt/refs/heads/main/robots.txt'
echo ""

echo "Updating compatible images for older browsers..."
$root/bin/update-compat-images.pl
echo ""

echo "Updating blog and phlog indexes..."
$root/bin/update-logs-indexes.pl
echo ""

echo "*** Website updated! ***"
