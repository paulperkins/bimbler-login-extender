<?php 
    /*
    Plugin Name: Bimbler Login Extender
    Plugin URI: http://www.bimblers.com
    Description: Plugin to extend the auth cookie.
    Author: Paul Perkins
    Version: 0.1
    Author URI: http://www.bimblers.com
    */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
        die;
} // end if

require_once( plugin_dir_path( __FILE__ ) . 'class-bimbler-login-extender.php' );

Bimbler_LoginExtender::get_instance();
