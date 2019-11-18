<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add security hooks
require_once( 'includes/security.php' );

// theme's initial setup
add_action( 'after_setup_theme', function() {

	// instantiate the theme's main class
    require_once( 'classes/class-theme.php' );
    
	// disable gutenberg editor
    add_filter( 'use_block_editor_for_post', '__return_false', 10 );
    
	// register standard nav menus
	register_nav_menu( 'bb-primary', 'Primary Menu' );
	register_nav_menu( 'bb-legal', 'Legal Menu' );
    register_nav_menu( 'bb-language', 'Language Menu' );
    
});

// remove default wordpress' default actions that are a securtiy threat or inconvinient
add_action( 'init', function() {

    // remove wordpress version from frontend
	remove_action('wp_head', 'wp_generator');                                       
    add_filter( 'the_generator', function() { return ''; } );
    
    // remove emojis
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );         
    remove_action( 'wp_print_styles', 'print_emoji_styles' );                       
    remove_action( 'admin_print_styles', 'print_emoji_styles' );                    	
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );                      
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );                      	
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );                     
    
    // remove xmlrpc (could have security issues)
    add_filter( 'xmlrpc_enabled', '__return_false' );
    remove_action( 'wp_head', 'rsd_link' );

    // remove Windows Live Writer Manifest Link	
    remove_action( 'wp_head', 'wlwmanifest_link' );

    // remove feed head links
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'feed_links_extra', 3 );

});

// enqueue / dequeue standard stylesheets & scripts
add_action( 'wp_enqueue_scripts', function() {
	// adding
	wp_enqueue_style( 'bb-styles', get_stylesheet_uri() ); // global standard busybytes stylesheet
	// removing
	wp_dequeue_style( 'wp-block-library' ); // remove gutenberg's stylesheet
});

// add svg as an item for uploading
add_filter( 'upload_mimes', function( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
    return $mimes;
});