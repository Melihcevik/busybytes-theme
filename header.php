<?php
/**
* The header for our theme
*
* @package BusyBytes
* @subpackage BusyBytes Theme
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>