<?php
/**
 * The Header for the theme.
 *
 * Displays all of the <head> section and logo and navigation
 *
 * @package vega
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
    <?php wp_head(); ?>

    <?php get_template_part('parts/header', 'analytics'); ?>
</head>
<?php $navbar_fixed_top = ''; $body_padding = ''; 
if( !vega_has_top_bar() ) { $navbar_fixed_top = ' navbar-fixed-top'; $body_padding = 'body_padding'; } 
$vega_wp_nav_position = vega_wp_get_option( 'vega_wp_nav_position' );
if($vega_wp_nav_position == 'Top' && !vega_has_top_bar()) $body_padding = 'body_padding_zero'; ?>
<body <?php body_class($body_padding); ?>>
    
    <?php get_template_part('parts/header', 'top'); ?>
    
