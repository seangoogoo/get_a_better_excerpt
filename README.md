# get_a_better_excerpt

This function is intended to replace the native WordPress function get_the_excerpt() wich retrieve the excerpt of a post.

If you are a lazy guy like me, you don't write specific excerpt in articles.
Recently using get_the_excerpt() in a custom theme, I noticed that WordPress indistincly retrieves every kind of tags like ```<h2>``` in the automatic generation of excerpts and can produce a misunderstandable content. I wrote this function to get around this default behavior of the WordPress function.

<h2>Usage</h2>
1/ Copy the code snippet in your functions.php file.\n
2/ Call it from a post loop in index.php, front-page.php or archive.php with :\n
<?php echo get_a_better_excerpt(null, null, array(), true); ?>
