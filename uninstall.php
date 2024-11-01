<?php
// If uninstall not called from WordPress, then exit.
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();

// delete all options for that plugin
delete_option ( 'fblcs_s_href_auto' );
delete_option ( 'fblcs_s_href' );		
delete_option ( 'fblcs_s_layout' );
delete_option ( 'fblcs_s_sizes' );
delete_option ( 'fblcs_l_href_auto' );
delete_option ( 'fblcs_l_href' );
delete_option ( 'fblcs_l_color' );
delete_option ( 'fblcs_l_layout' );
delete_option ( 'fblcs_l_size' );
delete_option ( 'fblcs_l_faces' );
delete_option ( 'fblcs_l_share' );
delete_option ( 'fblcs_l_action' );
delete_option ( 'fblcs_l_width' );
delete_option ( 'fblcs_l_height' );
delete_option ( 'fblcs_l_border' );
delete_option ( 'fblcs_l_border_style' );
delete_option ( 'fblcs_l_border_color' );
delete_option ( 'fblcs_l_background' );
delete_option ( 'fblcs_l_padding' );		
delete_option ( 'fblcs_l_margin' );
delete_option( 'fblcs_how_to_show');
delete_option( 'fblcs_hide_post_form' );
delete_option( 'fblcs_hide_page_form' );
delete_option( 'fblcs_disable_comments_and_form' );
delete_option( 'fblcs_c_color' );
delete_option( 'fblcs_c_mobile_optimize' );
delete_option( 'fblcs_c_num_of_post' );
delete_option( 'fblcs_c_order_by' );
delete_option( 'fblcs_c_width' );