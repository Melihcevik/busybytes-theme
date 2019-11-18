<?php

// disallow user without permissions
if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.', 'bb-theme' ) );
}

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="wrap">  
    <h1><?php _e( 'BusyBytes Theme Settings', 'bb-theme' ); ?></h1>
</div>