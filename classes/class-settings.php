<?php
/**
* The main class for the settings page
*
* @package BusyBytes
* @subpackage BusyBytes Theme
* @since 1.0.0
*/

namespace BusyBytes;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Settings' ) ) {

	class Settings {

		function __construct() {

			// add the settings options page
			add_action( 'admin_menu', function() {
				add_options_page(
					__( 'BusyBytes', 'bb-theme' ),
					__( 'BusyBytes', 'bb-theme' ),
					'manage_options',
					'bb-theme-settings',
					function() {
						require_once( get_template_directory() . '/views/options-page.php' );
					}
				);
			});
			
		}
	}
	// instantiate this class
	new Settings;
}
