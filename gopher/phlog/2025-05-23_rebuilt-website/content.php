<!-- Rebuilt the website (again) -->
<!-- Also available on Gopher: gopher://nathancampos.me/0/phlog/2025-05-23_rebuilt-website/post.txt -->

<pre id="plain-text">I guess the only I do with this website is rebuild it... Once again I decided to
redo the entire thing. In less than a year this website has been built from
scratch, and rebuilt completely twice.

The reason for the rebuild this time was out of frustration. Even though I was
fairly happy with the static website I had built [<a href="http://nathancampos.me/log/2024-11-15_this-as-static-website/">1</a>], I couldn't really edit it
and test my changes on any of my old computers, largely because of the
requirement on PHP 8. This made me very frustrated, since one of the joys of
having such a simple and minimalistic website is to use it and edit it on older
machines.

After much frustration I did decide to pull the trigger on the rewrite and
basically reverted everything to how things were before the static rewrite [<a href="https://github.com/nathanpc/portfolio/tree/97b1234e2da81719dd5fa9142bd4c7779162def2">2</a>],
although I made a whole bunch of changes to make it more maintainable in the
long run, especially since the old code for the website was littered with
special functions for blog posts that I had to look up every time I made a post.

All in all the website is now in a much better state, the code for it is
cleaner, it's easier to maintain, many of the processes used to administer it
adhere to the UNIX philosophy, and I can basically work on it on any machine I
desire.

Maybe one day I will implement an RSS feed generator for the blog and actually
make use of those compat_&ast; functions [<a href="https://github.com/nathanpc/portfolio/blob/52b256478712c2d6552bb1d93e0095c2aabea71c/src/compat.php">3</a>] that are supposed to make the website
work on older web browsers.

[1]: <a href="http://nathancampos.me/log/2024-11-15_this-as-static-website/">http://nathancampos.me/log/2024-11-15_this-as-static-website/</a>
[2]: <a href="https://github.com/nathanpc/portfolio/tree/97b1234e2da81719dd5fa9142bd4c7779162def2">https://github.com/nathanpc/portfolio/tree/97b1234e2da81719dd5fa9142bd4c7779162def2</a>
[3]: <a href="https://github.com/nathanpc/portfolio/blob/52b256478712c2d6552bb1d93e0095c2aabea71c/src/compat.php">https://github.com/nathanpc/portfolio/blob/52b256478712c2d6552bb1d93e0095c2aabea71c/src/compat.php</a>
</pre>

