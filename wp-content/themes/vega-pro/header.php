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
    
    <!-- ========== Navbar ========== -->
    <?php 
    global $vega_wp_defaults; $navbar_altered = ''; ;
    $vega_wp_nav_styling = vega_wp_get_option( 'vega_wp_nav_styling' );
    $vega_wp_nav_color = vega_wp_get_option( 'vega_wp_nav_color' );
    $vega_wp_nav_opacity = vega_wp_get_option( 'vega_wp_nav_opacity' );
    $vega_wp_nav_position = vega_wp_get_option( 'vega_wp_nav_position' );    
    if( ($vega_wp_nav_styling == 'Custom') && ($vega_wp_nav_color != $vega_wp_defaults['vega_wp_nav_color'] || $vega_wp_nav_opacity != $vega_wp_defaults['vega_wp_nav_opacity'] || $vega_wp_nav_position != $vega_wp_defaults['vega_wp_nav_position']) ){ $navbar_altered = 'navbar-altered'; }
    ?>
    <div class="nav-wrapper">
    <div class="navbar navbar-custom <?php echo $navbar_altered, $navbar_fixed_top ?>" role="navigation" id="navbar-custom">
        <div class="container">
            
            <!-- Logo -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
                <?php get_template_part('parts/header', 'logo'); ?>
            </div>
            <!-- /Logo -->
            
            <?php #EXAMPLE CONTENT: If a `header` nav has been defined, it will show up even if demo is turned on. If no `header` nav is defined and demo is on, the demo nav will show up. ?>
            <?php if ( has_nav_menu( 'header' ) ) :  ?>
            <!-- Navigation -->
            <?php wp_nav_menu( array(
                    'theme_location'    => 'header',
                    'depth'             => 3,
                    'container'         => 'div',
                    'container_class'   => 'navbar-collapse collapse',
                    'menu_class'        => 'nav navbar-nav navbar-right menu-header',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker()
                    )
                );
            ?>
            <!-- /Navigation -->
            <?php else: ?>
            
            <?php $vega_wp_enable_demo = vega_wp_get_option('vega_wp_enable_demo'); if($vega_wp_enable_demo == 'Y') { vega_wp_example_nav_header(); }  ?>
            
            <?php endif; ?>
            
            
        </div>
        <div class="clearfix"></div>
    </div>
    </div>
    <!-- ========== /Navbar ========== --> 
