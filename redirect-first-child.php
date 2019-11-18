<?php
/**
* Template Name: Redirect To First Child
*
* @package BusyBytes
* @subpackage BusyBytes Theme
* @since BusyBytes Theme 1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    $children = get_pages( "child_of=" . $post->ID . "&sort_column=menu_order" );
    $first = $children[0];
    wp_redirect( get_permalink( $first->ID ) );
  }
}
