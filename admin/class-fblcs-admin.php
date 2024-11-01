<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// The admin-specific functionality of the plugin.
class Fblcs_Admin {

	// The ID of this plugn
	private $plugin_name;

	// The version of this plugn 
	private $version;

	// load the display
	private $dispaly;	
	
	// initialize the class and set ti's properties
	public function __construct ( $plugin_name, $version ) {
		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;		
		require_once plugin_dir_path(  __FILE__ ) . 'partials/class-fblcs-admin-display.php';
		$this->display = new Fblcs_Admin_Display();			
	}	

	// Register the stylsheets for the admin are
	public function enqueue_styles () {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/fblcs-admin.css', array(), $this->version, 'all' );
	}

	// Register the JavaScript for the admin area.
	public function enqueue_scripts() { 		
		// plugin default JS file
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/fblcs-admin.js', array( 'jquery' ), $this->version, false );
		$ajaxurl 	=	admin_url( 'admin-ajax.php' );
		wp_localize_script( $this->plugin_name, 'urls', array(
			'ajaxurl'	=>	$ajaxurl
		) );
	}
	
	// add menu to the wordpress admin for this plugin settings page
	public function add_admin_setting_menu () {
		add_menu_page( 'WP Like Comment Share', 'WP Like Comment Share', 'manage_options', 'fblcs', array( $this, 'fblcs_comment_setting_menu'), plugin_dir_url( __FILE__) .'/images/fblcs-icon.png' );
		remove_submenu_page( 'fblcs', 'fblcs' );
		add_submenu_page( 'fblcs', 'WP Comment Settings', 'WP Comment Settings', 'manage_options', 'fblcs', array( $this, 'fblcs_comment_setting_menu') );
		add_submenu_page( 'fblcs', 'WP Like Settings', 'WP Like Settings', 'manage_options', 'fblcs-like-settings', array( $this, 'fblcs_like_settings_menu') );		
		add_submenu_page( 'fblcs', 'WP Share Settings', 'WP Share Settings', 'manage_options', 'fblcs-share-settings', array( $this, 'fblcs_share_settings_menu') );
		
	}	

	public function fblcs_like_settings_menu () {

		$fblcs_l_title 			=	get_option ( 'fblcs_l_title' );
		$fblcs_l_title_size		=	get_option ( 'fblcs_l_title_size' );
		$fblcs_l_href_auto 		=	get_option ( 'fblcs_l_href_auto' );
		$fblcs_l_href 			=	get_option ( 'fblcs_l_href' );
		$fblcs_l_color 			=	get_option ( 'fblcs_l_color' );
		$fblcs_l_layout 		= 	get_option ( 'fblcs_l_layout' );
		$fblcs_l_size 			= 	get_option ( 'fblcs_l_size' );
		$fblcs_l_faces 			= 	get_option ( 'fblcs_l_faces' );
		$fblcs_l_share 			= 	get_option ( 'fblcs_l_share' );
		$fblcs_l_action 		=	get_option ( 'fblcs_l_action' );
		$fblcs_l_width 			= 	get_option ( 'fblcs_l_width' );
		$fblcs_l_height 		= 	get_option ( 'fblcs_l_height' );
		$fblcs_l_border 		= 	get_option ( 'fblcs_l_border' );
		$fblcs_l_border_style 	= 	get_option ( 'fblcs_l_border_style' );
		$fblcs_l_border_color 	= 	get_option ( 'fblcs_l_border_color' );
		$fblcs_l_background 	= 	get_option ( 'fblcs_l_background' );		
		$fblcs_l_padding 		= 	get_option ( 'fblcs_l_padding' );		
		$fblcs_l_margin 		=	get_option ( 'fblcs_l_margin' );

		$this->display->fblcs_like_setting_form( $fblcs_l_title, $fblcs_l_title_size, $fblcs_l_href_auto, $fblcs_l_href, $fblcs_l_color, $fblcs_l_layout, $fblcs_l_size, $fblcs_l_faces, $fblcs_l_share, $fblcs_l_action, $fblcs_l_width, $fblcs_l_height, $fblcs_l_border, $fblcs_l_border_style, $fblcs_l_border_color, $fblcs_l_background, $fblcs_l_padding, $fblcs_l_margin );
	}

	// show settings form
	public function fblcs_comment_setting_menu () {
		// get existing comment settings data
		$fblcs_c_title 						=	get_option( 'fblcs_c_title');
		$fblcs_c_title_size 				=	get_option( 'fblcs_c_title_size');
		$fblcs_how_to_show 					=	get_option( 'fblcs_how_to_show');
		$fblcs_hide_post_form				=	get_option( 'fblcs_hide_post_form' );
		$fblcs_hide_page_form				=	get_option( 'fblcs_hide_page_form' );
		$fblcs_disable_comments_and_form	=	get_option( 'fblcs_disable_comments_and_form' );

		$fblcs_c_color 						=	get_option( 'fblcs_c_color' );
		$fblcs_c_mobile_optimize 			=	get_option( 'fblcs_c_mobile_optimize' );
		$fblcs_c_num_of_post 				=	get_option( 'fblcs_c_num_of_post' );
		$fblcs_c_order_by 					=	get_option( 'fblcs_c_order_by' );
		$fblcs_c_width						=	get_option( 'fblcs_c_width' );

		$this->display->show_setting_form( $fblcs_c_title, $fblcs_c_title_size, $fblcs_how_to_show, $fblcs_hide_post_form, $fblcs_hide_page_form, $fblcs_disable_comments_and_form, $fblcs_c_color, $fblcs_c_mobile_optimize, $fblcs_c_num_of_post, $fblcs_c_order_by, $fblcs_c_width );
	}

	// process the comment setting form using ajax
	public function fblcs_c_setting_action () {
		if ( check_admin_referer( 'fblcs_c_setting_action', 's' ) ) {

			$fblcs_c_title				=	sanitize_text_field ( $_POST['fblcs_c_title'] );
			$fblcs_c_title_size			=	sanitize_text_field ( $_POST['fblcs_c_title_size'] );
			$fblcs_how_to_show			=	isset ( $_POST['fblcs_how_to_show'] ) ?  absint ( $_POST['fblcs_how_to_show'] ) : 2;
    		$fblcs_hide_post_form		=	isset ( $_POST['fblcs_hide_post_form'] ) ? absint ( $_POST['fblcs_hide_post_form'] ) : 2;
    		$fblcs_hide_page_form		=	isset ( $_POST['fblcs_hide_page_form'] ) ? absint ( $_POST['fblcs_hide_page_form'] ) : 2;
    		$fblcs_disable_comments_and_form 			=	isset ( $_POST['fblcs_disable_comments_and_form'] ) ? absint ( $_POST['fblcs_disable_comments_and_form'] ) : 2;
    		
			$fblcs_c_color				=	sanitize_text_field ( $_POST['fblcs_c_color'] );
			$fblcs_c_mobile_optimize	=	sanitize_text_field ( $_POST['fblcs_c_mobile_optimize'] );
			$fblcs_c_num_of_post		=	absint ( $_POST['fblcs_c_num_of_post'] );
			$fblcs_c_order_by			=	sanitize_text_field ( $_POST['fblcs_c_order_by'] );
			$fblcs_c_width				=	sanitize_text_field ( $_POST['fblcs_c_width'] );
			$fblcs_errors 				=	array();

			if ( empty ( $fblcs_c_color ) && empty ( $fblcs_c_mobile_optimize ) && empty ( $fblcs_c_num_of_post )  &&  empty ( $fblcs_c_order_by ) && empty ( $fblcs_c_width ) ) {
				$fblcs_errors[] 	=	__( 'All fields are required', 'wp-like-comment-share' );
			} else {
				if( empty( $fblcs_c_color ) ) {
					$fblcs_errors[]	=	__( 'Choose the color', 'wp-like-comment-share' );
				}
				if( empty( $fblcs_c_mobile_optimize ) ) {
					$fblcs_errors[]	=	__( 'Choose mobile optimize', 'wp-like-comment-share' );
				}
				if( empty( $fblcs_c_num_of_post ) ) {
					$fblcs_errors[]	=	__( 'Choose number of post', 'wp-like-comment-share' );
				}
				if( empty( $fblcs_c_order_by ) ) {
					$fblcs_errors[]	=	__( 'Choose order by', 'wp-like-comment-share' );
				}				
			}

			if ( !empty ( $fblcs_errors ) ) {
				foreach ( $fblcs_errors as $fblcs_error ) {
					echo "<p class='notice notice-error'>$fblcs_error</p>";
				}
			} else {		
					
				update_option( 'fblcs_c_title', $fblcs_c_title );
				update_option( 'fblcs_c_title_size', $fblcs_c_title_size );
				update_option( 'fblcs_how_to_show', $fblcs_how_to_show );
				update_option( 'fblcs_hide_post_form', $fblcs_hide_post_form );
				update_option( 'fblcs_hide_page_form', $fblcs_hide_page_form );
				update_option( 'fblcs_disable_comments_and_form', $fblcs_disable_comments_and_form );				
				update_option( 'fblcs_c_color', $fblcs_c_color );
				update_option( 'fblcs_c_mobile_optimize', $fblcs_c_mobile_optimize );

				if ( $fblcs_c_mobile_optimize == 'true' ) {
					$fblcs_c_width 		=	'';					
				} elseif ( $fblcs_c_mobile_optimize == 'false' ) {
					$fblcs_c_width 		=	$fblcs_c_width;
				}
				update_option( 'fblcs_c_width', $fblcs_c_width );				
				update_option( 'fblcs_c_num_of_post', $fblcs_c_num_of_post );
				update_option( 'fblcs_c_order_by', $fblcs_c_order_by );			
				
				echo "<p class='notice notice-success'>" . __( 'Successfully Updated', 'wp-like-comment-share' ) . "</p>";
			}
			wp_die();	
		}
	}	

	// process the like setting form using ajax
	public function fblcs_l_setting_action () {

		if ( check_admin_referer( 'fblcs_l_setting_action', 's' ) ) {

			$fblcs_l_title 			=		sanitize_text_field ( $_POST['fblcs_l_title'] );
			$fblcs_l_title_size		=		sanitize_text_field ( $_POST['fblcs_l_title_size'] );
			$fblcs_l_href_auto 		=		sanitize_text_field ( $_POST['fblcs_l_href_auto'] );
			$fblcs_l_href 			=		sanitize_text_field ( $_POST['fblcs_l_href'] );
			$fblcs_l_color 			=		sanitize_text_field ( $_POST['fblcs_l_color'] );
			$fblcs_l_layout 		=		sanitize_text_field ( $_POST['fblcs_l_layout'] );
			$fblcs_l_size 			=		sanitize_text_field ( $_POST['fblcs_l_size'] );
			$fblcs_l_faces 			=		sanitize_text_field ( $_POST['fblcs_l_faces'] );
			$fblcs_l_share 			=		sanitize_text_field ( $_POST['fblcs_l_share'] );
			$fblcs_l_action 		=		sanitize_text_field ( $_POST['fblcs_l_action'] );
			$fblcs_l_width 			=		sanitize_text_field ( $_POST['fblcs_l_width'] );
			$fblcs_l_height 		=		sanitize_text_field ( $_POST['fblcs_l_height'] );
			$fblcs_l_border 		=		sanitize_text_field ( $_POST['fblcs_l_border'] );
			$fblcs_l_border_style 	=		sanitize_text_field ( $_POST['fblcs_l_border_style'] );
			$fblcs_l_border_color 	=		sanitize_text_field ( $_POST['fblcs_l_border_color'] );
			$fblcs_l_background 	=		sanitize_text_field ( $_POST['fblcs_l_background'] );

			$fblcs_l_padding 		=		array ();
			foreach ( $_POST['fblcs_l_padding'] as $key => $value ) {
				$fblcs_l_padding[] 	=	sanitize_text_field ( $value );				
			}			

			$fblcs_l_margin 		=		array ();
			foreach ( $_POST['fblcs_l_margin'] as $key => $value) {				
				$fblcs_l_margin[] 	=	sanitize_text_field ( $value );
			}
						
			$fbcls_errors 			=		array();

			if( isset ( $fblcs_l_title, $fblcs_l_title_size, $fblcs_l_href_auto, $fblcs_l_href, $fblcs_l_color, $fblcs_l_layout, $fblcs_l_size, $fblcs_l_faces, $fblcs_l_share, $fblcs_l_action, $fblcs_l_width, $fblcs_l_height, $fblcs_l_border, $fblcs_l_border_style, $fblcs_l_border_color, $fblcs_l_background, $fblcs_l_padding, $fblcs_l_margin) ) {

				if ( empty( $fblcs_l_href_auto ) && empty( $fblcs_l_href ) && empty( $fblcs_l_layout ) && empty( $fblcs_l_action ) ) {
					$fblcs_errors[] 		=	__( 'Layout and action fields must be required', 'wp-like-comment-share' );
				} else {

					if ( empty( $fblcs_l_href_auto ) ) {
						$fblcs_errors[] 	=	__( 'Select URL', 'wp-like-comment-share' );
					} else {
						if ( $fblcs_l_href_auto == 'given' && empty ( $fblcs_l_href ) ) {
							$fblcs_errors[]	=	__( 'Enter the URL', 'wp-like-comment-share' );
						}
					}
					
					if ( empty ( $fblcs_l_layout ) ) {
						$fblcs_errors[] 	=	__( 'Select layout', 'wp-like-comment-share' );
					}

					if( empty ( $fblcs_l_size ) ) {
						$fblcs_errors[] 	=	__( 'Size is required', 'wp-like-comment-share' );
					}

					if ( empty ( $fblcs_l_action ) ) {
						$fblcs_errors[] 	=	__( 'Select action', 'wp-like-comment-share' );
					}
				}

				if ( !empty ( $fblcs_errors ) ) {
					foreach ( $fblcs_errors as $fblcs_error ) {
						echo "<p class='notice notice-error'>$fblcs_error</p>";
					}
				}  else {
					update_option ( 'fblcs_l_title', $fblcs_l_title );
					update_option ( 'fblcs_l_title_size', $fblcs_l_title_size );
					update_option ( 'fblcs_l_href_auto', $fblcs_l_href_auto );

					if ( $fblcs_l_href_auto == 'given' ) {
						$parsed = parse_url( $fblcs_l_href );
						if ( empty ( $parsed['scheme'] ) ) {
							$fblcs_l_href = 'http://' . ltrim( $fblcs_l_href, '/' );
						}
						update_option ( 'fblcs_l_href', $fblcs_l_href );				
					} elseif ( $fblcs_l_href_auto == 'auto' ) {						
						update_option ( 'fblcs_l_href', '' );
					}
					
					update_option ( 'fblcs_l_color', $fblcs_l_title );
					update_option ( 'fblcs_l_color', $fblcs_l_color );
					update_option ( 'fblcs_l_layout', $fblcs_l_layout );
					update_option ( 'fblcs_l_size', $fblcs_l_size );
					update_option ( 'fblcs_l_faces', $fblcs_l_faces );
					update_option ( 'fblcs_l_share', $fblcs_l_share );
					update_option ( 'fblcs_l_action', $fblcs_l_action );
					update_option ( 'fblcs_l_width', $fblcs_l_width );
					update_option ( 'fblcs_l_height', $fblcs_l_height );
					update_option ( 'fblcs_l_border', $fblcs_l_border );
					update_option ( 'fblcs_l_border_style', $fblcs_l_border_style );
					update_option ( 'fblcs_l_border_color', $fblcs_l_border_color );
					update_option ( 'fblcs_l_background', $fblcs_l_background );
					update_option ( 'fblcs_l_padding', $fblcs_l_padding );
					update_option ( 'fblcs_l_margin', $fblcs_l_margin );					

					echo "<p class='notice notice-success'>" . __( 'Successfully Updated', 'wp-like-comment-share' ) . "</p>";
				}
			}

		
			wp_die();
		}
	}

	public function fblcs_share_settings_menu () {

		$fblcs_s_title 			=	get_option ( 'fblcs_s_title' );
		$fblcs_s_title_size 	=	get_option ( 'fblcs_s_title_size' );
		$fblcs_s_href_auto 		=	get_option ( 'fblcs_s_href_auto' );
		$fblcs_s_href 			=	get_option ( 'fblcs_s_href' );		
		$fblcs_s_layout 		= 	get_option ( 'fblcs_s_layout' );
		$fblcs_s_size 			= 	get_option ( 'fblcs_s_size' );

		$this->display->fblcs_share_setting_form ( $fblcs_s_title, $fblcs_s_title_size, $fblcs_s_href_auto, $fblcs_s_href, $fblcs_s_layout, $fblcs_s_size );
	}

	public function fblcs_s_setting_action () {
		if ( check_admin_referer( 'fblcs_s_setting_action', 's' ) ) {

			$fblcs_s_title 			=		sanitize_text_field ( $_POST['fblcs_s_title'] );
			$fblcs_s_title_size 	=		sanitize_text_field ( $_POST['fblcs_s_title_size'] );
			$fblcs_s_href_auto 		=		sanitize_text_field ( $_POST['fblcs_s_href_auto'] );
			$fblcs_s_href 			=		sanitize_text_field ( $_POST['fblcs_s_href'] );			
			$fblcs_s_layout 		=		sanitize_text_field ( $_POST['fblcs_s_layout'] );
			$fblcs_s_size 			=		sanitize_text_field ( $_POST['fblcs_s_size'] );
			$fbcls_errors 			=		array();

			if( isset ( $fblcs_s_title, $fblcs_s_title_size, $fblcs_s_href_auto, $fblcs_s_href, $fblcs_s_layout, $fblcs_s_size ) ) {

				if ( empty( $fblcs_s_href_auto ) && empty( $fblcs_s_href ) && empty( $fblcs_s_layout ) && empty ( $fblcs_s_size ) ) {
					$fblcs_errors[] 		=	__( 'All fields are required', 'wp-like-comment-share' );
				} else {

					if ( empty( $fblcs_s_href_auto ) ) {
						$fblcs_errors[] 	=	__( 'Select URL', 'wp-like-comment-share' );
					} else {
						if ( $fblcs_s_href_auto == 'given' && empty ( $fblcs_s_href ) ) {
							$fblcs_errors[]	=	__( 'Enter the URL', 'wp-like-comment-share' );
						}
					}
					
					if ( empty ( $fblcs_s_layout ) ) {
						$fblcs_errors[] 	=	__( 'Select layout', 'wp-like-comment-share' );
					}

					if ( empty ( $fblcs_s_size ) ) {
						$fblcs_errors[] 	=	__( 'Size required', 'wp-like-comment-share' );
					}					
				}

				if ( !empty ( $fblcs_errors ) ) {
					foreach ( $fblcs_errors as $fblcs_error ) {
						echo "<p class='notice notice-error'>$fblcs_error</p>";
					}
				}  else {
					update_option ( 'fblcs_s_title', $fblcs_s_title );
					update_option ( 'fblcs_s_title_size', $fblcs_s_title_size );
					update_option ( 'fblcs_s_href_auto', $fblcs_s_href_auto );

					if ( $fblcs_s_href_auto == 'given' ) {
						update_option ( 'fblcs_s_href', $fblcs_s_href );
					} elseif ( $fblcs_s_href_auto == 'auto' ) {						
						update_option ( 'fblcs_s_href', '' );
					}					
					update_option ( 'fblcs_s_layout', $fblcs_s_layout );
					update_option ( 'fblcs_s_size', $fblcs_s_size );
					echo "<p class='notice notice-success'>" . __( 'Successfully Updated.', 'wp-like-comment-share' ) . "</p>";
				}
			}
		
			wp_die();
		}
	}
}