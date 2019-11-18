<?php
/**
* The main template file
*
* @package BusyBytes
* @subpackage BusyBytes Theme
* @since BusyBytes Theme 1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

if ( have_posts() ) {
    while( have_posts() ) {
        the_post();
        the_content();
    }
} else {
    echo '<p>Sorry, no posts matched your criteria.</p>';
}

get_footer();