<?php
/**
 * Advance WP Redirect Setup
 * @package Advance WP Redirect
 * @since 0.0.1
*/

// Exit if directly access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main Class of Advance WP Redirect
 * @class XSAWRLITE_Main
 * @since 0.0.1
 */
class XSAWRLITE_Main {
	// The single instance of class

    protected static $xsawrlite_instance = null;

    /**
    * main instance function of XSAWRLITE_Main
    * @return object
    */

    public static function xsawrlite_instance() {
        if ( is_null( self::$xsawrlite_instance ) ) {
            self::$xsawrlite_instance = new self();
        }
        return self::$xsawrlite_instance;
    }

    /**
    * XSAWRLITE Constructor
    */
    public function __construct() {
        $this->xsawrlite_define_constants();
        $this->xsawrlite_init_hooks();
		$this->xsawrlite_includes();
    }

    /**
    * Define the plugin constants
    */
    function xsawrlite_define_constants() {
    	define( 'XSAWRLITE_ABSPATH' , dirname( XSAWRLITE_PLUGIN_FILE ) );
        define( 'XSAWRLITE_BASENAME' , plugin_basename( XSAWRLITE_PLUGIN_FILE ) );
        define( 'XSAWRLITE_DOMAIN' , 'xsawrlite-domain' );
    }

    /**
    * Hooks into actions and filters
    *
    */
    function xsawrlite_init_hooks() {
        add_action( 'init' , array( 'XSAWRLITE_Init' , 'xsawrlite_load_textdomain') );
    	add_action( 'admin_menu' , array( 'XSAWRLITE_Init' , 'xsawrlite_admin_menu') );
    	add_filter( 'plugin_action_links_' . XSAWRLITE_BASENAME , 'xsawrlite_plugin_link');
    	add_action( 'admin_enqueue_scripts' , array( 'XSAWRLITE_Init' , 'xsawrlite_load_css_js' ) );
        add_action( 'wp_enqueue_scripts' , array( 'XSAWRLITE_Init' , 'xsawrlite_forntend_load_js' ) );
        add_action( 'wp_ajax_nopriv_xsawrlite_get_nf_link' , array( 'XSAWRLITE_Init' , 'xsawrlite_get_nf_link' ) );
    	add_action( 'admin_init' , array( 'XSAWRLITE_Init' , 'xsawrlite_register_settings') );
        add_action( 'wp_ajax_xsawrlite_add_redirects' , array( 'XSAWRLITE_Init' , 'xsawrlite_add_redirects' ) );
        add_action( 'wp_ajax_xsawrlite_del' , array( 'XSAWRLITE_Init' , 'xsawrlite_del' ) );
        add_action( 'wp_ajax_xsawrlite_edit_redirects' , array( 'XSAWRLITE_Init' , 'xsawrlite_edit_redirects' ) );
        add_action( 'wp_ajax_xsawrlite_get_nf_link' , array( 'XSAWRLITE_Init' , 'xsawrlite_get_nf_link' ) );
        add_action( 'init' , array('XSAWRLITE_Init' , 'xsawrlite_redirect_url') );
        add_action( 'wp' , array('XSAWRLITE_Init' , 'xsawrlite_redirect_url_404') );
        
    }

    /**
    * Includes the files
    */
    function xsawrlite_includes() {
    	include_once XSAWRLITE_ABSPATH . '/includes/classes/class-xsawrlite-init.php';
    	include_once XSAWRLITE_ABSPATH . '/includes/functions/xsawrlite-functions.php';
    	include_once XSAWRLITE_ABSPATH . '/templates/xsawrlite-setting-page.php';

    }
    
}
?>