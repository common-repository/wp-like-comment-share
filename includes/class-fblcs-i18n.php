<?php 
// Define the internationalization functionality
class Fblcs_i18n {
	// Load the plugin text domain for translation.
	public function load_plugin_textdomain () {
		load_plugin_textdomain(
			'facebook-like-comment-share', 
			false, 
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' 
		);	
	}	
} 