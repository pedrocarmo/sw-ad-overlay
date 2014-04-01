<?php
/**
 * @package sw_overlay
 * @version 1.0
 */
/*
Plugin Name: SW Ad overlay
Plugin URI: http://seedworks.pt/wp-plugins/sw-ad-overlay
Description: Show an ad "takeover" overlay in your website
Author: Pedro Carmo
Version: 1.0
Author URI: http://seedworks.pt
*/

/**
 * Main function that initializes the plugin
 *
 * @return void
 */
function __swAdOverlayMain()
{
    require_once plugin_dir_path( __FILE__ ) .'includes/overlay.php';
    $overlay = new SW_Overlay( plugin_dir_path( __FILE__ ) );
}

register_activation_hook( __FILE__, array( 'SW_Overlay', 'installation' ) );
__swAdOverlayMain();
