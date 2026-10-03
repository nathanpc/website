### Makefile
### Automates everything in the project.
###
### Author: Nathan Campos <nathan@innoveworkshop.com>

# Tools
RM     = rm -f
LN     = ln -s
MKDIR  = mkdir -p
CURL   = curl
MAKE   = make

# Paths
BINDIR = ./bin
HTDOCS = ./htdocs
PHLOG  = ./gopher/phlog

.PHONY: all build images blog sitemap

all: build

build: images website blog sitemap

images:
	$(BINDIR)/update-compat-images.pl

website:
	find $(HTDOCS)/ -iname '*.cnt.html' -type f -exec $(BINDIR)/update-page.sh {} \;
	$(CURL) -o "$(HTDOCS)/robots.txt" 'https://raw.githubusercontent.com/ai-robots-txt/ai.robots.txt/refs/heads/main/robots.txt'

blog:
	find $(PHLOG)/ -iname '*.cnt.html' -type f -exec $(BINDIR)/update-page.sh -b {} \;
	$(BINDIR)/update-logs-indexes.pl

sitemap: blog
	$(BINDIR)/update-sitemap.sh

$(HTDOCS)/robots.txt:
	$(CURL) -o "$(HTDOCS)/robots.txt" 'https://raw.githubusercontent.com/ai-robots-txt/ai.robots.txt/refs/heads/main/robots.txt'
