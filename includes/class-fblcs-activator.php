<?php 
/*
Fired during plugin activation
This class defines all code necessary to run during the plugin's activation.
*/

class Fblcs_Activator {
	
	public static function activate () {

		add_option ( 'fblcs_s_href_auto', 'auto' );		
		add_option ( 'fblcs_s_layout', 'button_count' );
		add_option ( 'fblcs_s_size', 'small' );

		add_option ( 'fblcs_l_href_auto', 'auto' );		
		add_option ( 'fblcs_l_color', 'light' );
		add_option ( 'fblcs_l_layout', 'standard' );
		add_option ( 'fblcs_l_size', 'small' );
		add_option ( 'fblcs_l_action', 'like' );
		
		add_option( 'fblcs_c_color', 'light' );
		add_option( 'fblcs_c_mobile_optimize', 'true' );
		add_option( 'fblcs_c_num_of_post', 10 );
		add_option( 'fblcs_c_order_by', 'social' );		
	}
}