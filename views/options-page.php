<?php

// disallow user without permissions
if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to accesssd this page.', 'bb-theme' ) );
}

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>


<div class="wrap">  
    <h1><?php _e( 'BusyBytes Theme Settings', 'bb-theme' ); ?></h1>
    <p>
        <strong>Welcome to the official BusyBytes' WordPress Theme!</strong><br>
        The goal of this theme is to define and encourage a powerful WordPress workflow.
        For the moment, there is not much to see here, stay in touch with our development at <a href="https://github.com/BusyBytes/busybytes-theme" target="_blank">GitHub.</a>
    </p>
    <p>
        <a href="/wp-admin/themes.php?page=tgmpa-install-plugins">Check out the recommended plugins.</a>
    </p>
</div>