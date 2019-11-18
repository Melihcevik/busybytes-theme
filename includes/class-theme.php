<?php

namespace BusyBytes;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Theme {

	public const THEME_NAME = 'BusyBytes Theme';
	public const MINIMUM_ELEMENTOR_VERSION = '2.5.0';
	public const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {
		$this->bb_theme_activate();
	}

	private function bb_theme_activate() {
		$this->bb_theme_check_compatibility();
	}

	private function bb_theme_check_compatibility() {
		// check if Elementor is installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'bb_admin_notice_missing_elementor_plugin' ) );
			return false;
		}

		// check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'bb_admin_notice_minimum_elementor_version' ) );
			return false;
		}

		// check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'bb_admin_notice_minimum_php_version' ) );
			return false;
		}

		// check that the user is using a child theme
		if ( self::THEME_NAME != wp_get_theme()->parent_theme ) {
			add_action( 'admin_notices', array( $this, 'bb_admin_notice_missing_child_theme' ) );
			return false;
		}

		return true;
	}

	#region ADMIN NOTICES

	public function bb_admin_notice_missing_elementor_plugin() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = '<strong>'. self::THEME_NAME . '</strong> ' . __( 'requires <strong>Elementor</strong> to be installed and activated.', 'bb-theme' );
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function bb_admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = '<strong>'. self::THEME_NAME . '</strong> ' . __( 'requires <strong>Elementor</strong> version '. self::MINIMUM_ELEMENTOR_VERSION .' or greater.', 'bb-theme' );
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function bb_admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = '<strong>'. self::THEME_NAME . '</strong> ' . __( 'requires <strong>PHP</strong> version '. self::MINIMUM_PHP_VERSION .' or greater.', 'bb-theme' );
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function bb_admin_notice_missing_child_theme() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = '<strong>'. self::THEME_NAME . '</strong> ' . __( 'requires a <strong>child theme</strong> to function properly. You should never edit a theme directly!', 'bb-theme' );
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	#endregion
}

// instantiate this class
new Theme();