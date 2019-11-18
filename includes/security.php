<?php
/**
*  Security hooks
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add random and non-specific error messages when login fails
add_filter( 'login_errors', function() {
    return __( 'Unknown username or password.', 'bb-theme' );
});
