<?php
/**
 * Plugin Name: WP Post Redirection
 * Plugin URI::https://xfinitysoft.com/xfinity/advance-wp-redirect/
 * Description:  Redirect Pages, Posts or Custom Post Types to another location quickly (for internal or external URLs). Includes individual non-existant 301 Redirects , New Window functionality, and rel=nofollow functionality.
 * Version: 0.0.5
 * Requires at least:   4.4.0
 * Tested up to: 6.2.0
 * Author:Xfinity Soft
 * Author URI:https://xfinitysoft.com/
 * Text Domain:xsawrlite-domain
 * Domain Path: /languages
*/

// Exit if directly access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Define  XSAWRLITE_PLUGIN_FILE
if ( ! defined( 'XSAWRLITE_PLUGIN_FILE' ) ) {
    define( 'XSAWRLITE_PLUGIN_FILE' , __FILE__ );
}

// Includes main class of xsawrlite
if ( ! class_exists( 'XSAWRLITE_Main' ) ) {
    include_once dirname( __FILE__ ) . '/includes/classes/class-xsawrlite-main.php';
}

/**
 * Main instance of XSAWRLITE_Main.
 *
 * Returns the main instance of XSAWRLITE_Main to prevent the need to use globals.
 *
 *
 * @return XSAWRLITE_Main
 */
function xsawrlite_main() {
	return XSAWRLITE_Main::xsawrlite_instance();
}

// Global for backwards compatibility.
$GLOBALS['advance-wp-redirect'] = xsawrlite_main();
?>
