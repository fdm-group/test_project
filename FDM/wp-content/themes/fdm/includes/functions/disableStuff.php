<?php
/**
* Disable the emoji's
*/
function disable_emojis() {
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
* Filter function used to remove the tinymce emoji plugin.
*
* @param array $plugins
* @return array Difference betwen the two arrays
*/
function disable_emojis_tinymce( $plugins ) {
if ( is_array( $plugins ) ) {
return array_diff( $plugins, array( 'wpemoji' ) );
} else {
return array();
}
}

/**
* Remove emoji CDN hostname from DNS prefetching hints.
*
* @param array $urls URLs to print for resource hints.
* @param string $relation_type The relation type the URLs are printed for.
* @return array Difference betwen the two arrays.
*/
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
if ( 'dns-prefetch' == $relation_type ) {
/** This filter is documented in wp-includes/formatting.php */
$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
}

return $urls;
}

//Remove unnecessary menu items from the admin panel
function remove_menus(){
  remove_menu_page( 'edit-comments.php' );  // Comments
}

//add_filter('show_admin_bar', '__return_false');
add_filter('xmlrpc_enabled', '__return_false');
add_action( 'admin_menu', 'remove_menus' );

// Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links_extra');
// Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'feed_links');
// Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'rsd_link');
// Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'wlwmanifest_link' );
// index link
remove_action( 'wp_head', 'index_rel_link' );
// prev link
remove_action( 'wp_head', 'parent_post_rel_link', 10);
// start link
remove_action( 'wp_head', 'start_post_rel_link', 10);
// Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10);
// Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'wp_generator');

?>
