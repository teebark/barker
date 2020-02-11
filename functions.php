<?php
/* Adds page name to classes for page */
add_filter('body_class','page_class');
function page_class($classes) {
   global $wp_query;
   $page = '';
   $page = $wp_query->query_vars['pagename'];
   // add 'pagename' to the $classes array
   $classes[] = $page;
   // return the $classes array
   return $classes;
}
/* Add custom field image-link to featured image as external link */
add_filter('post_thumbnail_html', 'custom_thumbnail_tag_filter', 10, 3);
function custom_thumbnail_tag_filter($html, $postid, $thumbnailid, $size) {
	/* print_r ("html = " . $html,true); */
    if ($thumbnailid) {
		/* $id = get_post_thumbnail_id(); */
		/* $src = wp_get_attachment_url($id, $size); */
        $src = get_post_meta($postid, 'image_link', true);
		if ($src) {
			if ($html) {
				$html = '<a href="' . $src . '"> <img src="' . $html . '"></a>';}
		}
    }
    return $html;
}
/* Shows filters
global $wp_filter;
$error_message = var_dump( $wp_filter['body_class'],true ); 
$log_file = "/home/teebarkc/logs/php-errors.log";
$error_message = print_r("Got here",true);
error_log($error_message,3,$log_file);
error_log($error_message,3,$log_file); 
*/
?>