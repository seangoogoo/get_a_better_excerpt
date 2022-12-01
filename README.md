# get_a_better_excerpt for WordPress

This function is intended to replace the native WordPress function **get_the_excerpt()** wich retrieve the excerpt of a post.

If you are a lazy guy like me, you don't write article excerpt in the dedicated field of WordPress.
Recently using get_the_excerpt() in a custom theme, I noticed that WordPress indistincly retrieves every kind of tags like ```<h2>``` in the automatic generation of excerpts and can produce a misunderstandable content. I wrote this function to get around this default behavior of the WordPress function.  

This script was very quickly written. So, forgive me if you consider the internal logic a bit weird. Anyway, it can be perfected but it does the job, at least for my own usage. Any comments and improvements are welcome.

## Usage
### 1/ Copy the code snippet in your functions.php file.  
2/ Call it from a post loop in index.php, front-page.php or archive.php with : 
```php
<?php echo get_a_better_excerpt(); ?>
```
or  
```php
<?php echo get_a_better_excerpt(null, null, array(), array(), true); ?>
```
where arguments could be :  
```php
<?php echo get_a_better_excerpt($post->post_content, 600, ['h2', 'script', 'style'], ['codepen', 'text-muted'], false); ?>
```

## Arguments

### 1/ $the_post_content  
This argument is not the most useful of all but one can use it to pass a singular HTML string to get an excerpt (not tested).
If an excerpt isn't already defined in the article, default value is :  
```php
$the_post_content = get_post()->post_content;
```

### 2/ $max_char
An integer representing the length of the excerpt in characters, without truncating words, if the excerpt is shorter than the article content.
Default value is :  
```php
$max_char = 320;
```

### 3/ $tags_list
An array representing a list of the HTML tags to remove from the content.
Default value is :  
```php
$tags_list = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'style', 'figure', 'script'];
```

### 4/ $classes_list
An array representing a list of the tags identified by classes to remove from the content.
Default value is :  
```php
$classes_list = ['codepen'];
```

### 5/ $keep_only_p
A boolean that defines whether or not the returned content will retain only the paragraph tags.
Default value is :  
```php
$keep_only_p = true;
```
