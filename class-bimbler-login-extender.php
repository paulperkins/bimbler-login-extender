<?php
/**
 * Bimbler Login Extender
 *
 * @package   Bimbler_LoginExtender
 * @author    Paul Perkins <paul@paulperkins.net>
 * @license   GPL-2.0+
 * @link      http://www.paulperkins.net
 * @copyright 2014 Paul Perkins
 */

/**
 * Include dependencies necessary... (none at present)
 *
 */

/**
 * Bimbler Login Extender
 *
 * @package Bimbler_LoginExtender
 * @author  Paul Perkins <paul@paulperkins.net>
 */
class Bimbler_LoginExtender {

        /*--------------------------------------------*
         * Constructor
         *--------------------------------------------*/

        /**
         * Instance of this class.
         *
         * @since    1.0.0
         *
         * @var      object
         */
        protected static $instance = null;

        /**
         * Return an instance of this class.
         *
         * @since     1.0.0
         *
         * @return    object    A single instance of this class.
         */
        public static function get_instance() {

                // If the single instance hasn't been set, set it now.
                if ( null == self::$instance ) {
                        self::$instance = new self;
                } // end if

                return self::$instance;

        } // end get_instance

        /**
         * Initializes the plugin by setting localization, admin styles, and content filters.
         */
        private function __construct() {

			add_filter( 'auth_cookie_expiration', array ($this, 'extend_login'), 99, 3);
        	         	
		} // End constructor.
	
	/*
	 * Remove extend the auth cookie.
	 *
	 */
	function extend_login ($seconds, $user_id, $remember) {
		// If "remember me" is checked.
    	if ( $remember ) {
        	// WP defaults to 2 weeks. Set to 3 months.
        	$expiration = 3*47*24*60*60;

        	
        	// Work around the UTC bug...
        	date_default_timezone_set('Australia/Brisbane');
        	
        	$date_to = date('Y-m-d  H:i:s',strtotime("+" . $expiration . " seconds"));
        	 
        	error_log ('Extending login cookie for user ID ' . $user_id . ' to ' . $date_to . '.');
    	} else {
        	// WP defaults to 48 hrs/2 days.
        	$expiration = 2*24*60*60; 
    	}

	    // http://en.wikipedia.org/wiki/Year_2038_problem
	    if ( PHP_INT_MAX - time() < $expiration ) {
	        // Fix to a little bit earlier!
	        $expiration =  PHP_INT_MAX - time() - 5;
	    }

	    return $expiration;
	}
	
		
} // End class
