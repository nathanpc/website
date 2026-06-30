### Makefile
### Automates everything in the project.
###
### Author: Nathan Campos <nathan@innoveworkshop.com>

# Tools
RM     = rm -f
LN     = ln -s
MKDIR  = mkdir -p
CURL   = curl

# Paths
BINDIR = ./bin
HTDOCS = ./htdocs
PHLOG  = ./gopher/phlog

.PHONY: all update build images blog sitemap

all: update

update: $(HTDOCS)/robots.txt images
	$(BINDIR)/update-logs-indexes.pl

build: $(HTDOCS)/robots.txt images blog sitemap

images:
	$(BINDIR)/update-compat-images.pl

blog:
	$(BINDIR)/build-blog-index.pl
	$(BINDIR)/build-phlog-index.pl

sitemap: blog
	$(BINDIR)/update-sitemap.sh

$(HTDOCS)/robots.txt:
	$(CURL) -o "$(HTDOCS)/robots.txt" 'https://raw.githubusercontent.com/ai-robots-txt/ai.robots.txt/refs/heads/main/robots.txt'
