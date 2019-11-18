<?php
/**
* The main class for our theme
*
* @package BusyBytes
* @subpackage BusyBytes Theme
* @since BusyBytes Theme 1.0
*/

namespace BusyBytes;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Theme' ) ) {

	class Theme {

		public const THEME_NAME = 'BusyBytes Theme';
		public const MINIMUM_ELEMENTOR_VERSION = '2.5.0';
		public const MINIMUM_PHP_VERSION = '7.0';

		public function __construct() {
			$this->bb_theme_activate();
		}

		private function bb_theme_activate() {
			// check for compatibility and dependencies, store the result
			$is_compatible = $this->bb_theme_check_compatibility();
			if ( $is_compatible ) {
				require_once( 'class-settings.php' );
			}
		}

		private function bb_theme_check_compatibility() {
			// check if Elementor is installed and activated
			if ( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', function() {
					if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
					$message = '<strong>'. self::THEME_NAME . '</strong> ' . __( 'requires <strong>Elementor</strong> to be installed and activated.', 'bb-theme' );
					printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
				});
				return false;
			}

			// check for required Elementor version
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', function() {
					if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
					$message = '<strong>'. self::THEME_NAME . '</strong> ' . __( 'requires <strong>Elementor</strong> version '. self::MINIMUM_ELEMENTOR_VERSION .' or greater.', 'bb-theme' );
					printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
				});
				return false;
			}

			// check for required PHP version
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', function() {
					if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
					$message = '<strong>'. self::THEME_NAME . '</strong> ' . __( 'requires <strong>PHP</strong> version '. self::MINIMUM_PHP_VERSION .' or greater.', 'bb-theme' );
					printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
				});
				return false;
			}

			// check that the user is using a child theme
			if ( self::THEME_NAME != wp_get_theme()->parent_theme ) {
				add_action( 'admin_notices', function() {
					if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
					$message = '<strong>'. self::THEME_NAME . '</strong> ' . __( 'requires a <strong>child theme</strong> to function properly. You should never edit a theme directly!', 'bb-theme' );
					printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
				});
				return false;
			}

			return true;
		}

	}
	// instantiate this class
	new Theme();
}