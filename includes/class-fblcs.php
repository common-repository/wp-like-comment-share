<?php 
// core plugin class
class Fblcs {

	// maintain and register all hooks for the plugin
	protected $loader;

	// uniquely identify this plugin
	protected $plugin_name;

	// current version of the plugin
	protected $version;

	// core functionality of the plugin 
	public function __construct () {
		if( defined ( 'WP_LIKE_COMMENT_SHARE_VERSION' ) ) {
			$this->version = WP_LIKE_COMMENT_SHARE_VERSION;
		} else {
			$this->version = '1.0.0';			
		}

		$this->plugin_name = 'Fblcs_Newsletter';
		$this->load_dependencies();
		$this->set_local();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	// load the required dependencies for this plugin
	public function load_dependencies () {
		// The class responsible for orchestrating the actions and filters of the core plugin.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-fblcs-loader.php';
		//  The class responsible for defining internationalization functionality of the plugin.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-fblcs-i18n.php';
		// The class responsible for defining all actions that occur in the admin area.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-fblcs-admin.php';
		// The class responsible for defining all actions that occur in the public-facing side of the site.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-fblcs-public.php';
		$this->loader = new Fblcs_Loader();

	}

	// Define the locale for this plugin for internationalization.
	public function set_local () {
		$plugin_i18n 	=	new Fblcs_i18n();		
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	// Register all of the hooks related to the admin area functionality
	public function define_admin_hooks () {
		$plugin_admin = new Fblcs_Admin( $this->get_plugin_name(), $this->get_version() );		
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );	
		// create all menus for this plugin
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_admin_setting_menu' );
		// ajax request for the comment setting form
		$this->loader->add_action( 'wp_ajax_fblcs_c_setting_action', $plugin_admin, 'fblcs_c_setting_action' );		 
		$this->loader->add_action( 'wp_ajax_nopriv_fblcs_c_setting_action', $plugin_admin, 'fblcs_c_setting_action' );		
		// ajax request for the like setting form
		$this->loader->add_action( 'wp_ajax_fblcs_l_setting_action', $plugin_admin, 'fblcs_l_setting_action' );		 
		$this->loader->add_action( 'wp_ajax_nopriv_fblcs_l_setting_action', $plugin_admin, 'fblcs_l_setting_action' );		
		// ajax request for the share setting form
		$this->loader->add_action( 'wp_ajax_fblcs_s_setting_action', $plugin_admin, 'fblcs_s_setting_action' );		 
		$this->loader->add_action( 'wp_ajax_nopriv_fblcs_s_setting_action', $plugin_admin, 'fblcs_s_setting_action' );		
	}

	// Register all of the hooks related to the public-facing functionality of the plugin.
	public function define_public_hooks () {				
		$plugin_public = new Fblcs_Public ( $this->get_plugin_name(), $this->get_version() );	
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'fblcs_fb_div' );		
		// add shortocde
		$this->loader->add_shortcode( 'fb_comment_btn', $plugin_public, 'fblcs_comment_shortcode' );
		$this->loader->add_shortcode( 'fb_like_btn', $plugin_public, 'fblcs_like_shortcode' );
		$this->loader->add_shortcode( 'fb_share_btn', $plugin_public, 'fblcs_share_shortcode' );
		/* Show the wp comment form after the wordpress comment form */
		$fblcs_how_to_show 					=	get_option ( 'fblcs_how_to_show' );
		$fblcs_hide_post_form 				=	get_option ( 'fblcs_hide_post_form' );
		$fblcs_disable_comments_and_form 	=	get_option ( 'fblcs_disable_comments_and_form' );

		if ( $fblcs_how_to_show == 1 ) {
			$this->loader->add_filter( 'comment_form_after', $plugin_public, 'fblcs_comment_form_after' );
		}
		/* Close comments on the front-end */
		if ( $fblcs_hide_post_form  == 1 && $fblcs_how_to_show == 1 && $fblcs_disable_comments_and_form == 2 )  {
			$this->loader->add_filter( 'comments_open', $plugin_public, 'fblcs_close_comments_on_front' );
			$this->loader->add_filter( 'pings_open', $plugin_public, 'fblcs_close_comments_on_front' );	
			$this->loader->add_filter( 'comments_array', $plugin_public, 'fblcs_comments_array' );
		}
		// replacing existing commetns template
		if ( $fblcs_disable_comments_and_form == 1 ) {
			$this->loader->add_filter( 'comments_array', $plugin_public, 'fblcs_comments_array' );
			$this->loader->add_filter( 'comments_template', $plugin_public, 'add_comment_box_custom_template' );
			// Disable support for comments and trackbacks in post types
			$this->loader->add_filter( 'admin_init', $plugin_public, 'fblcs_disable_comments_post_types_support' );
			// Remove comments page in menu
			$this->loader->add_filter( 'admin_menu', $plugin_public, 'fblcs_disable_comments_admin_menu' );
			// Redirect any user trying to access comments page
			$this->loader->add_filter( 'admin_init', $plugin_public, 'fblcs_disable_comments_admin_menu_redirect' );
			// Remove comments metabox from dashboard
			$this->loader->add_filter( 'admin_init', $plugin_public, 'fblcs_disable_comments_dashboard' );
			// Remove comments links from admin bar
			$this->loader->add_filter( 'init', $plugin_public, 'fblcs_disable_comments_admin_bar' );			
		}
	}

	// Run the loader to execute all of the hooks with WordPress
	public function run () {		
		$this->loader->run();
	}

	// The name of the plugin used to uniquely identify it within the context of WordPress and to define internationalization functionality.
	public function get_plugin_name () {
		return $this->plugin_name;
	}

	// The reference to the class that orchestrates the hooks with the plugin.
	public function get_loader () {
		return $this->loader;
	}

	// Retrieve the version number of the plugin.
	public function get_version () {
		return $this->version;
	}	

}