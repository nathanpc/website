# My website

This is the source code of my website and showcases how little we need in order
to have a sustainable and accessible web presence.

## Blogging

The usual workflow when composing a new log is to create a new directory inside
the `/gopher/phlog` directory with a name that conforms to the `date_slug`
format. Inside this directory you must create a `post.txt` with its contents in
[Almost Plain Text](https://github.com/nathanpc/almost-plain-text), where the
first header will become the post's title.

Next you should build the HTML version of the post for the main website, this
can be done by running the following command from the project's root:

```sh
./bin/build-post.sh gopher/phlog/date_slug
```

You should now have a proper blog post ready to be viewed from a web browser.
The last step in this chain is to build the sitemap and blog/phlog indexes. This
is done by simply running `make` from the root of the project.

## License

This library is free software; you may redistribute and/or modify it under the
terms of the [Mozilla Public License 2.0](https://www.mozilla.org/en-US/MPL/2.0/).
