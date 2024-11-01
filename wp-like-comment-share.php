<?php
/*
Plugin Name: WP Like Comment Share
Plugin URI:  http://creativeartbd.com/wordpress-plugin/
Description: Using this plugin you can like, comment and share any post and page easily. 
Version:     1.0.0
Author:      Sibbir Ahmed
Author URI:  http://creativeartbd.com/about/
Text Domain: wp-like-comment-share
Domain Path: /languages
License:     GPL2
*/

// if the file is called directly 
if( ! defined( 'WPINC' ) ) {
	die;
}

// plugin version 
define( 'WP_LIKE_COMMENT_SHARE_VERSION', '1.0.0' );

// plugin activation hook
function active_fblcs () {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fblcs-activator.php';
	Fblcs_Activator::activate();
}
register_activation_hook( __FILE__, 'active_fblcs' );

// plugin de-activation hook
function deactive_fblcs () {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fblcs-deactivator.php';
	Fblcs_Deactivator::deactivate();
}
register_deactivation_hook( __FILE__, 'deactive_fblcs' );

// include core plugin class
require plugin_dir_path( __FILE__ ) . 'includes/class-fblcs.php';

// begin execution of the plugin
function run_fblcs () {
	$plugin 	=	new Fblcs();
	$plugin->run();
}
run_fblcs();