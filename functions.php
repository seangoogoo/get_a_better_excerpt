//************************************************************************
//* Replace the native WordPress function get_the_excerpt() by returning :
//* - a string filtered from title, script, style, figure tags and Codepen references
//* - only paragraph tags
function get_a_better_excerpt($the_post_content = null, $max_char = null, $tags_list = array(), $keep_only_p = true) {

	//* If the post already contains a specific excerpt, return it
	if(has_excerpt()) return get_post()->post_excerpt;

	//* If no post content is passed as argument
	if($the_post_content === null) $the_post_content = get_post()->post_content;

	$custom_post_content = new DOMDocument();
	libxml_use_internal_errors(true);
	$custom_post_content->loadHTML(mb_convert_encoding($the_post_content, 'HTML-ENTITIES', "UTF-8"));
	libxml_clear_errors(); //* <= avoid warnings

	//* Remove script and title tags from content
	if(empty($tags_list)) $tags_list = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'style', 'figure', 'script'];
	foreach($tags_list as $tag_to_remove) {
		foreach (iterator_to_array($custom_post_content->getElementsByTagName($tag_to_remove)) as $tag) $tag->parentNode->removeChild($tag);
	}

	//* Remove specific Codepen paragraphs
	$xpath = new DOMXPath($custom_post_content);
	foreach ($xpath->query("//*[contains(@class, 'codepen')]") as $tag) $tag->parentNode->removeChild($tag);

	//* Debug
	// return $custom_post_content->saveHTML();
	// echo $custom_post_content->textContent;
	// return false;
	if($keep_only_p) {
		//* Select and return paragraph tags only and convert their HTML entities
		$p_nodes = $custom_post_content->getElementsByTagName('p');
		$clean_content = '';
		foreach ($p_nodes as $p_node) {
			$clean_content .= $p_node->nodeValue . ' ';
		}
	} else {
		$clean_content = $custom_post_content->textContent;
	}

	$clean_content = trim(htmlspecialchars($clean_content, ENT_QUOTES));

	//* build excerpt from cleaned content
	if($max_char === null) $max_char = 320;
	$blog_excerpt = (strlen($clean_content) > $max_char) ? substr($clean_content, 0, strpos($clean_content, ' ', $max_char)) . ' ...' : $clean_content;
	return $blog_excerpt;
}
