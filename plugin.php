<?php
/*
Plugin Name: Post Randomizer
Plugin URI: http://mr.hokya.com/
Description: It will automatically randomize the displayed post on your homepage and on the feed. It will be useful for site or blog that not daily updated so when the visitor come stopping by on your homepage, he won't see same posts or contents twice. I hope it will help you keep your blogrank when you don't have time to manage it.
Version: 2.03
Author: Julian Widya Perdana
Author URI: http://mr.hokya.com/
*/


if(!get_option("post_randomize")) update_option("post_randomize","true");

function post_randomizer () {
	if (get_option("post_randomize")=="true") {
		if (is_home() || is_feed()) query_posts("orderby=rand");
	}
}
function postrandomizer_widget_initial () {
	wp_add_dashboard_widget("Post Randomizer","Post Randomizer","postrandomizer_widget");
}
function postrandomizer_widget() {
	global $wpdb;
	if ($_POST["postrandom"]<>"") {update_option("post_randomize","true");echo "<div class='updated fade'>Setting saved</div>";}
	if ($_POST["postunrandom"]<>"") {update_option("post_randomize","false");echo "<div class='updated fade'>Setting saved</div>";}
	$stat = get_option("post_randomize");
	if ($stat=="true") $current="Randomized";
	else $current = "Normal Order";
	echo "Current Status: <div align='center'><h1>$current</h1> Randomize the displayed post on your homepage and on the feed. It will be useful for site or blog that not daily updated so when the visitor come stopping by on your homepage, he won't see same posts or contents twice. <a href='http://mr.hokya.com/post-randomizer/' target='_blank'>See more</a>";
	echo "<p><form method='post'><input name='postrandom' type='submit' value='Randomize' class='button-primary'/><input name='postunrandom' type='submit' value='Do not Randomize' class='button-primary'/></form></p></div>";
}

add_action('wp_dashboard_setup', 'postrandomizer_widget_initial');
add_action('get_header', 'post_randomizer');
add_action('atom_head', 'post_randomizer');
add_action('rss_head', 'post_randomizer');
add_action('rss2_head', 'post_randomizer');

?>