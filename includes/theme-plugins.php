<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 */

require_once get_template_directory() . '/lib/TGM-Plugin-Activation/class-tgm-plugin-activation.php' ;

/**
 * Register the required plugins for this theme.
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
add_action( 'tgmpa_register', function () {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'      => 'SG Optimizer',
			'slug'      => 'sg-cachepress',
			'required'  => false,
		),

		array(
			'name'      => 'Autoptimize',
			'slug'      => 'autoptimize',
			'required'  => false,
		),

		array(
			'name'      => 'WP-SCSS',
			'slug'      => 'wp-scss',
			'required'  => false,
		),
		
		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
			'required'    => false,
		),

		array(
			'name'      => 'Duplicator – WordPress Migration Plugin',
			'slug'      => 'duplicator',
			'required'  => false,
		),

		array(
			'name'      => 'Cookie Notice for GDPR',
			'slug'      => 'cookie-notice',
			'required'  => false,
		),

		array(
			'name'      => 'reSmush.it Image Optimizer',
			'slug'      => 'resmushit-image-optimizer',
			'required'  => false,
		),

	);

	/*
	 * Array of configuration settings.
	 */
	$config = array(
		'id'           => 'bb-theme',              // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

});