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
/* Add category to single post pages */
add_filter('body_class','add_category_to_single');
function add_category_to_single($classes) {
	if (is_single() ) {
		global $post;
		foreach((get_the_category($post->ID)) as $category) {
			echo $category->cat_name . ' ';
			// add category slug to the $classes array
			$classes[] = 'category-'.$category->slug;
		}
	}
	// return the $classes array
	return $classes;
}
/* Add custom field image-link to featured image as external link */
add_filter('post_thumbnail_html', 'custom_thumbnail_tag_filter', 10, 3);
function custom_thumbnail_tag_filter($html, $postid, $thumbnailid) {
	/* print_r ("html = " . $html,true); */
    if ($thumbnailid) {
		/* $id = get_post_thumbnail_id(); */
		/* $src = wp_get_attachment_url($id, $size); */
        $src = get_post_meta($postid, 'image_link', true);
		if ($src) {
			if ($html) {
				// $show_var = 'html = ' . print_r($html,1);
				// error_log($show_var);
				$html = '<a href="' . $src . '"> <img "' . $html . '</a>';}
		}
    }
    return $html;
}
/* Get rid of secondary hamburger menu */
add_action( 'wp_enqueue_scripts', 'generate_dequeue_secondary_nav_mobile', 999 );
function generate_dequeue_secondary_nav_mobile() {
   wp_dequeue_style( 'generate-secondary-nav-mobile' );
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