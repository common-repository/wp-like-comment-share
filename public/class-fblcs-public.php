<?php
// define class for public facing functionality
class Fblcs_Public {

	// The ID of this plugin
	private $plugin_name;
	// The version of this plugin
	private $version;
	// set the public display
	private $display;

	// initialize the class and set it's properties
	public function __construct ( $plugin_name, $version ) {		
		$this->plugin_name 			=	$plugin_name;
		$this->version 				=	$version;

		require_once plugin_dir_path( __FILE__ ) . 'partials/class-fblcs-public-display.php';
		$this->display 				= new Fblcs_Public_Display();

		$fblcs_c_width 				=	get_option ( 'fblcs_c_width' ); 
		$fblcs_c_mobile_optimize 	=	get_option ( 'fblcs_c_mobile_optimize' ); 

		if ( $fblcs_c_mobile_optimize == 'false' && $fblcs_c_width ) {
			$data 				=".fb-comments.fblcs-front.fb_iframe_widget.fb_iframe_widget_fluid_desktop > span > iframe { width: {$fblcs_c_width} !important; }";

			wp_register_style( 'fblcs-wp-comment-css', false );
			wp_enqueue_style( 'fblcs-wp-comment-css' );
			wp_add_inline_style( 'fblcs-wp-comment-css', $data );		
		}
	}	

	// register the stylesheet
	public function enqueue_styles () {		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/fblcs-public.css', array(), $this->version, 'all' );		
	}

	// register the javascript 
	public function enqueue_scripts () {
		// for wp comments
		wp_enqueue_script( $this->plugin_name . '-fblcs-comment', '//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0', array( 'jquery' ), $this->version, true );		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/fblcs-public.js', array('jquery'), $this->version, true);
		$ajax_url = admin_url( 'admin-ajax.php' );
		wp_localize_script( $this->plugin_name, 'urls', array(
			'ajaxurl'	=>	$ajax_url
		) );
	}	

	// add div for the wp comment
	public function fblcs_fb_div () {
		echo '<div id="fb-root"></div>';
	}
	// fcebook comment shortcode callback
	public function fblcs_comment_shortcode () {
		return $this->fblcs_comment_box();
	}

	// wp share shortcode callback
	public function fblcs_share_shortcode () {	

		$fblcs_s_title 			=	get_option ( 'fblcs_s_title' );
		$fblcs_s_title_size 	=	get_option ( 'fblcs_s_title_size' );
		$fblcs_s_href_auto 		=	get_option ( 'fblcs_s_href_auto' );
		$fblcs_s_href 			=	get_option ( 'fblcs_s_href' );		
		$fblcs_s_layout 		= 	get_option ( 'fblcs_s_layout' );
		$fblcs_s_size 			= 	get_option ( 'fblcs_s_size' );
		
		global $wp, $post;

		if ( $fblcs_s_href_auto == 'auto' ) {
			if( is_single() ) {
				$settings 			=	get_the_permalink( $post );
			} else {			
				$settings 			=	home_url( $wp->request );
			}
		} elseif ( $fblcs_s_href_auto == 'given' ) {
			$settings 				=	$fblcs_s_href;
		}	

		if ( $fblcs_s_layout ) {
			$settings			.=	"&layout=".$fblcs_s_layout;
		}

		if ( $fblcs_s_size ) {
			$settings			.=	"&size=".$fblcs_s_size;
		}	

		if ( $fblcs_s_layout == 'button_count' && $fblcs_s_size == 'small' ) {
			$fblcs_s_height 	=	'22';
			$fblcs_s_width 		=	'71';
		} elseif ( $fblcs_s_layout == 'box_count' && $fblcs_s_size == 'small' ) {
			$fblcs_s_height		=	'42';
			$fblcs_s_width 		=	'61';
		} elseif ( $fblcs_s_layout == 'button' && $fblcs_s_size == 'small' ) {
			$fblcs_s_height		=	'22';
			$fblcs_s_width 		=	'61';
		} elseif ( ( $fblcs_s_layout == 'box_count' || $fblcs_s_layout == 'button' || $fblcs_s_layout == 'button_count' ) && $fblcs_s_size == 'large' ) {
			$fblcs_s_height		=	'58';
			$fblcs_s_width 		=	'72';
		}

		$data 					=	'';
		if ( $fblcs_s_title ) {
			if ( $fblcs_s_title_size ) {
				$data 		.=	'<'.$fblcs_s_title_size.'>';
			}
			$data 			.=	$fblcs_s_title;
			if ( $fblcs_s_title_size ) {
				$data 			.=	'</'.$fblcs_s_title_size.'>';
			}
		}

		$data 					.=	"<iframe src='https://www.facebook.com/plugins/share_button.php?href={$settings}' width='$fblcs_s_width' height='$fblcs_s_height' style='border : none; overflow : hidden;' scrolling='no' frameborder='0' allowTransparency='true' allow='encrypted-media'></iframe>";

		return $data;
	}

	// wp like shortcode callback
	public function fblcs_like_shortcode () {

		global $post;
		$fblcs_l_title 			=	get_option ( 'fblcs_l_title' );
		$fblcs_l_title_size 	=	get_option ( 'fblcs_l_title_size' );
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

		global $wp, $post;

		if ( $fblcs_l_href_auto == 'auto' ) {
			if( is_single() ) {
				$settings 			=	get_the_permalink( $post );
			} else {			
				$settings 			=	home_url( $wp->request );
			}
		} elseif ( $fblcs_l_href_auto == 'given' ) {
			$settings 				=	$fblcs_l_href;
		}				

		if ( $fblcs_l_color ) {
			$settings			.=	"&colorscheme=".$fblcs_l_color;
		}
		if ( $fblcs_l_layout ) {
			$settings			.=	"&layout=".$fblcs_l_layout;
		} 
		if ( $fblcs_l_size ) {
			$settings			.=	"&size=".$fblcs_l_size;
		} 
		if ( $fblcs_l_faces ) {
			$settings			.=	"&show_faces=".$fblcs_l_faces;
		}
		if ( $fblcs_l_share ) {
			$settings			.=	"&share=".$fblcs_l_share;
		}
		if ( $fblcs_l_action ) {
			$settings			.=	"&action=".$fblcs_l_action;
		} 
		if ( $fblcs_l_width ) {
			$settings			.=	"&width=".$fblcs_l_width;
		}

		$fblcs_style 			=	'overflow : hidden;';
		
		if ( $fblcs_l_border && $fblcs_l_border_style && $fblcs_l_border_color ) {
			$fblcs_style 		.=	" border : {$fblcs_l_border}px {$fblcs_l_border_style} {$fblcs_l_border_color};";
		}

		if( $fblcs_l_padding ) {
			$fblcs_l_padding_i 			=	implode( 'px ', $fblcs_l_padding ) . 'px';
			$fblcs_style 				.=	" padding : {$fblcs_l_padding_i};";

			$fblcs_l_padding_top 		=	$fblcs_l_padding[0];
			$fblcs_l_padding_right 		=	$fblcs_l_padding[1];
			$fblcs_l_padding_bottom		=	$fblcs_l_padding[2];
			$fblcs_l_padding_left		=	$fblcs_l_padding[3];
		}

		if( $fblcs_l_margin ) {
			$fblcs_l_margin_i 	=	implode ('px ', $fblcs_l_margin ) . 'px';;
			$fblcs_style 		.=	" margin : {$fblcs_l_margin_i};";
		}
		
		if( $fblcs_l_background ) {			
			$fblcs_style 		.=	" background-color : {$fblcs_l_background};";
		}	

		if ( $fblcs_l_layout == 'standard' && $fblcs_l_size == 'small' && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'139';
			$fblcs_set_l_height 	=	'30';			
		} elseif ( $fblcs_l_layout == 'standard' && $fblcs_l_size == 'large' && $fblcs_l_faces == 'false' && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'173';
			$fblcs_set_l_height 	=	'30';						
		} elseif ( $fblcs_l_layout == 'standard' && $fblcs_l_size == 'large' && $fblcs_l_faces == 'true' && $fblcs_l_faces == 'false' && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'173';
			$fblcs_set_l_height 	=	'70';			
		} elseif ( $fblcs_l_layout == 'standard' && $fblcs_l_size == 'large' && $fblcs_l_faces == 'true' && $fblcs_l_faces == 'true'  && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'auto';
			$fblcs_set_l_height		=	'70';
		} elseif ( $fblcs_l_layout == 'standard' && $fblcs_l_size == 'large' && $fblcs_l_faces == 'true' && $fblcs_l_faces == 'true' && $fblcs_l_action == 'recommend' ) {
			$fblcs_set_l_width 		=	'auto';
			$fblcs_set_l_height		=	'85';
		} elseif ( $fblcs_l_layout == 'button_count' && $fblcs_l_size == 'small' && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'63';
			$fblcs_set_l_height 	=	'22';			
		} elseif ( $fblcs_l_layout == 'button_count' && $fblcs_l_size == 'large' && $fblcs_l_faces == 'false' && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'75';
			$fblcs_set_l_height 	=	'30';			
		} elseif ( $fblcs_l_layout == 'button_count' && $fblcs_l_size == 'large' && $fblcs_l_faces == 'true' && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'134';
			$fblcs_set_l_height 	=	'30';			
		} elseif ( $fblcs_l_layout == 'button_count' && $fblcs_l_size == 'large' && $fblcs_l_faces == 'true' && $fblcs_l_action == 'recommend' ) {
			$fblcs_set_l_width 		=	'186';
			$fblcs_set_l_height 	=	'30';			
		} elseif ( $fblcs_l_layout == 'button' && $fblcs_l_size == 'small' && $fblcs_l_action == 'like') {
			$fblcs_set_l_width 		=	'53';
			$fblcs_set_l_height 	=	'22';			
		} elseif ( $fblcs_l_layout == 'button' && $fblcs_l_size == 'large' && $fblcs_l_faces == 'false' && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'65';
			$fblcs_set_l_height 	=	'30';			
		} elseif ( $fblcs_l_layout == 'button' && $fblcs_l_size == 'large' && $fblcs_l_faces == 'true' && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'123';
			$fblcs_set_l_height 	=	'30';			
		} elseif ( $fblcs_l_layout == 'button' && $fblcs_l_size == 'large' && $fblcs_l_faces == 'true' && $fblcs_l_action == 'recommend' ) {
			$fblcs_set_l_width 		=	'175';
			$fblcs_set_l_height 	=	'30';			
		} elseif ( $fblcs_l_layout == 'box_count' && $fblcs_l_size == 'small' && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'53';
			$fblcs_set_l_height 	=	'42';			
		} elseif ( $fblcs_l_layout == 'box_count' && $fblcs_l_size == 'large' && $fblcs_l_share == 'false' && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'65';
			$fblcs_set_l_height 	=	'60';			
		} elseif ( $fblcs_l_layout == 'box_count' && $fblcs_l_size == 'large' && $fblcs_l_share == 'true' && $fblcs_l_action == 'like' ) {
			$fblcs_set_l_width 		=	'65';
			$fblcs_set_l_height 	=	'92';			
		} elseif ( $fblcs_l_layout == 'box_count' && $fblcs_l_size == 'large' && $fblcs_l_share == 'true' && $fblcs_l_action == 'recommend'  ) {
			$fblcs_set_l_width 		=	'117';
			$fblcs_set_l_height 	=	'92';			
		} 	

		if( empty ( $fblcs_l_width ) ) {
			$fblcs_set_l_width 		=	$fblcs_set_l_width;
		} else {
			$fblcs_set_l_width 		=	$fblcs_l_width;
		}			

		if( empty ( $fblcs_l_height ) ) {
			$fblcs_set_l_height 		=	$fblcs_set_l_height;			
		} else {
			$fblcs_set_l_height 		=	$fblcs_l_height;
		}	

		if ( $fblcs_l_padding_top ) {
			$fblcs_set_l_height			+=	$fblcs_l_padding_top;
		}

		if ( $fblcs_l_padding_right ) {
			$fblcs_set_l_width			+=	$fblcs_l_padding_right;
		}

		if ( $fblcs_l_padding_bottom ) {
			$fblcs_set_l_height			+=	$fblcs_l_padding_bottom;
		}

		if ( $fblcs_l_padding_left ) {
			$fblcs_set_l_width			+=	$fblcs_l_padding_left;
		}

		$data 				=	'';			
		if ( $fblcs_l_title ) {
			if ( $fblcs_l_title_size ) {
				$data 		.=	'<'.$fblcs_l_title_size.'>';
			}
			$data 			.=	$fblcs_l_title;
			if ( $fblcs_l_title_size ) {
				$data 			.=	'</'.$fblcs_l_title_size.'>';
			}
		}

		$data 				.=	"<iframe src='https://www.facebook.com/plugins/like.php?href={$settings}' width='$fblcs_set_l_width' height='$fblcs_set_l_height' style='$fblcs_style'  scrolling='no' frameborder='0' allowTransparency='true' allow='encrypted-media'></iframe>";

		return $data;
	}

	// add wp comment box to custom template
	public function add_comment_box_custom_template () {
		return dirname( __FILE__ ) . '/partials/extra-template/comments-template.php';
	}
	// close the comment system
	public function fblcs_close_comments_on_front () {
		return false;
	}
	// all comment box before the list of comments
	public function fblcs_comments_array () {
		echo $this->fblcs_comment_box();
	}
	// add comment box after the comments form
	public function fblcs_comment_form_after () {
		echo $this->fblcs_comment_box();	
	}
	// wp comment box
	public function fblcs_comment_box () {
		global $post;
		$fblcs_permalink			=	get_the_permalink( $post );
		$fblcs_c_title 				=	get_option ( 'fblcs_c_title' ); 
		$fblcs_c_title_size			=	get_option ( 'fblcs_c_size' ); 
		$fblcs_c_width 				=	get_option ( 'fblcs_c_width' ); 
		$fblcs_c_num_of_post 		=	get_option ( 'fblcs_c_num_of_post' ); 
		$fblcs_c_mobile_optimize 	=	get_option ( 'fblcs_c_mobile_optimize' ); 
		$fblcs_c_order_by 			=	get_option ( 'fblcs_c_order_by' ); 
		$fblcs_c_color 				=	get_option ( 'fblcs_c_color' ); 

		$data 						=	'';			
		if ( $fblcs_c_title ) {
			if ( $fblcs_c_title_size ) {
				$data 				.=	'<'.$fblcs_c_title_size.'>';
			}
			$data 					.=	$fblcs_c_title;
			if ( $fblcs_c_title_size ) {
				$data 				.=	'</'.$fblcs_c_title_size.'>';
			}
		}	

		$data 						.=	"<div class='fb-comments fblcs-front' data-href='$fblcs_permalink' data-width='$fblcs_c_width' data-numposts='$fblcs_c_num_of_post' data-mobile='$fblcs_c_mobile_optimize' data-order-by='$fblcs_c_order_by' data-colorscheme='$fblcs_c_color'></div>"; 		
		return $data;
	}

	// Disable support for comments and trackbacks in post types
	public function fblcs_disable_comments_post_types_support ( ) {
		$fblcs_post_types 	=	get_post_types();
		foreach ( $fblcs_post_types as $fblcs_post_type) {
			if( post_type_supports ( $fblcs_post_type, 'comments' ) ) {
				remove_post_type_support ( $fblcs_post_type, 'comments' );
				remove_post_type_support ( $fblcs_post_type, 'trackbacks' );
			}
		}
	}
	// Remove comments page in menu
	public function fblcs_disable_comments_admin_menu ( ) {
		remove_menu_page ( 'edit-comments.php' );
	}
	// Redirect any user trying to access comments page
	public function fblcs_disable_comments_admin_menu_redirect ( ) {
		global $pagenow;
		if ( $pagenow === 'edit-comments.php' ) {
			wp_redirect(admin_url()); exit;
		}
	}
	// Remove comments metabox from dashboard
	public function fblcs_disable_comments_dashboard ( ) {
		remove_meta_box ( 'dashboard_recent_comments', 'dashboard', 'normal' );
	}
	// Remove comments links from admin bar
	public function fblcs_disable_comments_admin_bar ( ) {
		if ( is_admin_bar_showing() ) {
			remove_action ( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
		}
	}
}