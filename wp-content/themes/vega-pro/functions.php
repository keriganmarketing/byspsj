<?php
/**
 * Vega WP functions and definitions
 *
 * @package vega
 */
?>
<?php

### THEME DEFAULTS ###

require get_stylesheet_directory() . '/customize/theme-defaults.php';


### SETUP ###

if ( ! function_exists( 'vega_wp_setup' ) ) :
function vega_wp_setup() {

    global $vega_wp_defaults;
    
    #make theme available for translation. Translations can be filed in the /languages/ directory
    load_theme_textdomain( 'vega', get_stylesheet_directory() . '/languages' ); 

    #add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    #let WordPress manage the document title
    add_theme_support( 'title-tag' );

    #support for post thumbnails on posts and pages
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 300, 250, true );
    add_image_size( 'post-thumbnail-recent', 350, 220, true );
    add_image_size( 'post-thumbnail-large', 525, 335, true );

    #navigation menus
    register_nav_menus( array(
        'header'    =>  __( 'Header Menu', 'vega' ),
        'footer'    =>  __( 'Footer Menu', 'vega' ),
        'top_left'  =>  __( 'Top Left', 'vega'),
        'top_right' =>  __( 'Top Right - Social', 'vega'),
    ) );
    
    #custom header support
    $args = array(
        'flex-width'    => true,
        'width'         => 1920,
        'flex-height'    => true,
        'height'        => 250,
        'default-image' => $vega_wp_defaults['vega_wp_custom_header'],
    );
    add_theme_support( 'custom-header', $args );

    #custom logo support
    add_theme_support( 'custom-logo', array('height' => 45, 'width' => 165,'flex-height' => true,'flex-width'  => true ) );
    
    #page excerpts
    add_post_type_support('page', 'excerpt');
    
    $vega_wp_admin_bar = vega_wp_get_option('vega_wp_admin_bar'); 
    if($vega_wp_admin_bar == 'N' && !is_admin()) { show_admin_bar( false ); }
    
    #https://make.wordpress.org/core/2016/11/26/extending-the-custom-css-editor/
    if ( function_exists( 'wp_update_custom_css_post' ) ) {
        $css = vega_wp_get_option('vega_wp_custom_css');
        if ( $css ) {
            $core_css = wp_get_custom_css(); 
            $return = wp_update_custom_css_post( $core_css . $css );
            if ( ! is_wp_error( $return ) ) {
                remove_theme_mod( 'vega_wp_custom_css' );
            }
        }
    }
	
	if ( class_exists( 'WooCommerce' ) ) {
        add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
    
}
endif;
add_action( 'after_setup_theme', 'vega_wp_setup' );


if ( ! isset( $content_width ) ) {
    $content_width = 1200;
}


### FILTERS ###

function vega_wp_filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'vega_wp_filter_media_comment_status', 10 , 2 );


function vega_wp_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'vega_wp_move_comment_field_to_bottom' );

function vega_wp_excerpt_length( $length ) {
	return 65;
}
add_filter( 'excerpt_length', 'vega_wp_excerpt_length', 999 );

//http://wordpress.stackexchange.com/questions/50779/how-to-wrap-oembed-embedded-video-in-div-tags-inside-the-content
add_filter('embed_oembed_html', 'vega_embed_oembed_html', 99, 4);
function vega_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="iframe-video">' . $html . '</div>';
}

#Disable requests to wp.org repository for this theme
# http://wptheming.com/2014/06/disable-theme-update-checks/
function vega_disable_wporg_request( $r, $url ) {
	// If it's not a theme update request, bail.
	if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) { return $r; }

    // Decode the JSON response
    $themes = json_decode( $r['body']['themes'] );

    // Remove the active parent and child themes from the check
    $parent = get_option( 'template' );
    $child = get_option( 'stylesheet' );
    unset( $themes->themes->$parent );
    unset( $themes->themes->$child );

    // Encode the updated JSON response
    $r['body']['themes'] = json_encode( $themes );

    return $r;
}
add_filter( 'http_request_args', 'vega_disable_wporg_request', 5, 2 );

### STYLES AND SCRIPTS ###

require get_stylesheet_directory() . '/color-schemes/custom_css.php'; 
function vega_wp_scripts() {
    
    global $vega_wp_defaults;
    global $custom_css_template; 
    
    ### CSS ###
    
    #bootstrap, fontawesome, bootstrapsocial, animate
    wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_register_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css' );
    wp_register_style('bootstrap-social', get_template_directory_uri().'/assets/css/bootstrap-social.css' );
    
    #animate.css
    wp_enqueue_style('animate-css', get_template_directory_uri().'/assets/css/animate.css');
    
    #jquery.bxslider.css
    wp_enqueue_style('jquery-bxslider', get_template_directory_uri().'/assets/css/jquery.bxslider.css' );
    
    #enqueue fonts
    $font1 = vega_wp_get_option( 'vega_wp_font_1' );
    $font2 = vega_wp_get_option( 'vega_wp_font_2' );
    if($font1 == $vega_wp_defaults['vega_wp_font_1'] && $font2 == $vega_wp_defaults['vega_wp_font_2']) {
        wp_enqueue_style('vega-wp-googlefont1', 
        '//fonts.googleapis.com/css?family=Lato:400,400i,700,700i,900,900i&amp;subset=latin-ext');
    } else {
        if($font1 != $vega_wp_defaults['vega_wp_font_1']) wp_enqueue_style('vega-wp-customgooglefont1', vega_wp_google_font_link($font1));
        if($font2 != $vega_wp_defaults['vega_wp_font_2']) wp_enqueue_style('vega-wp-customgooglefont2', vega_wp_google_font_link($font2));
    }
    
    #default stylesheet
    $vega_wp_theme = wp_get_theme();
    $deps = array('bootstrap', 'font-awesome', 'bootstrap-social');
    wp_enqueue_style('vega-wp-style', get_stylesheet_uri(), $deps, $vega_wp_theme->get( 'Version' ));
        
    #color scheme
    $vega_wp_color_stylesheet = vega_wp_get_option('vega_wp_color_stylesheet');
    if($vega_wp_color_stylesheet != 'Custom') {
        wp_enqueue_style('vega-wp-color', get_template_directory_uri() . '/color-schemes/' . strtolower($vega_wp_color_stylesheet) . '.css');
    } else { 
        $custom_css_colors = '';
        $color_body = vega_wp_get_option( 'vega_wp_color_body' );
        $color1 = vega_wp_get_option( 'vega_wp_color_custom_1' );
        $color2 = vega_wp_get_option( 'vega_wp_color_custom_2' );
        $rgb1 = hex2rgb($color1);
        if($color_body != $vega_wp_defaults['vega_wp_color_body'] || $color1 != $vega_wp_defaults['vega_wp_color_custom_1'] || $color2 != $vega_wp_defaults['vega_wp_color_custom_2'] ) {
            $custom_css_colors = $custom_css_template['colors'];
            $custom_css_colors = str_replace("~color_body~", $color_body, $custom_css_colors);
            $custom_css_colors = str_replace("~color1~", $color1, $custom_css_colors);
            $custom_css_colors = str_replace("~color2~", $color2, $custom_css_colors);
            $custom_css_colors = str_replace("~rgb1~", $rgb1, $custom_css_colors);
            wp_add_inline_style( 'vega-wp-style', $custom_css_colors );
        }
    }
    
    #fonts
    if($font1 != $vega_wp_defaults['vega_wp_font_1'] || $font2 != $vega_wp_defaults['vega_wp_font_2']) {
        $custom_css_fonts = $custom_css_template['fonts'];
        $custom_css_fonts = str_replace("~font1~", vega_wp_google_font_usage($font1), $custom_css_fonts);
        $custom_css_fonts = str_replace("~font2~", vega_wp_google_font_usage($font2), $custom_css_fonts);
        wp_add_inline_style( 'vega-wp-style', $custom_css_fonts );
    }
    
    #nav styling
    $vega_wp_nav_styling = vega_wp_get_option( 'vega_wp_nav_styling' );
    if($vega_wp_nav_styling == 'Custom'){
        $vega_wp_nav_color = vega_wp_get_option( 'vega_wp_nav_color' );
        $vega_wp_nav_opacity = vega_wp_get_option( 'vega_wp_nav_opacity' );
        $vega_wp_nav_position = vega_wp_get_option( 'vega_wp_nav_position' );
        $navbar_color_rgb = hex2rgb($vega_wp_nav_color);
        if($vega_wp_nav_color != $vega_wp_defaults['vega_wp_nav_color'] || $vega_wp_nav_opacity != $vega_wp_defaults['vega_wp_nav_opacity'] || $vega_wp_nav_position != $vega_wp_defaults['vega_wp_nav_position']){
            require get_stylesheet_directory() . '/color-schemes/custom_css.php';
            $custom_css = $custom_css_template['custom_nav'];
            $custom_css = str_replace("~navbar_color_rgb~", $navbar_color_rgb, $custom_css);
            $custom_css = str_replace("~navbar_opacity~", $vega_wp_nav_opacity, $custom_css);
            if($vega_wp_nav_position == 'Top')  $custom_css = str_replace("~body_padding_top~", 'body{padding-top:0px !important;}', $custom_css);
            else $custom_css = str_replace("~body_padding_top~", '', $custom_css);
            wp_add_inline_style( 'vega-wp-style', $custom_css );
            wp_enqueue_script('vega-wp-nav', get_template_directory_uri() . '/assets/js/vega-wp-nav.js', array('jquery'), '', true );
        }
    }
    
    // Load html5shiv.js
	wp_enqueue_script( 'vega-html5', get_template_directory_uri() . '/assets/js/html5shiv.js', array('vega-wp-style'), '3.7.0' );
	wp_script_add_data( 'vega-html5', 'conditional', 'lt IE 9' );
    
    // Load respond.min.js
	wp_enqueue_script( 'vega-respond', get_template_directory_uri() . '/assets/js/respond.min.js', array('vega-wp-style'), '1.3.0' );
	wp_script_add_data( 'vega-respond', 'conditional', 'lt IE 9' );
    
    ### JS ###
    
    #bootstrap
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), '', true );
    wp_enqueue_script('jquery-smartmenus', get_template_directory_uri() . '/assets/js/jquery.smartmenus.min.js', array('jquery'), '', true );
    wp_enqueue_script('jquery-smartmenus-bootstrap', get_template_directory_uri() . '/assets/js/jquery.smartmenus.bootstrap.min.js', array('jquery'), '', true );
        
    #animation
    $vega_wp_animations = vega_wp_get_option('vega_wp_animations');
    if($vega_wp_animations == 'Y') {
        wp_enqueue_script('wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '', true );
        wp_enqueue_script('vega-wp-anim', get_template_directory_uri() . '/assets/js/vega-wp-anim.js', array('jquery'), '', true );
    }
    
    #video
    wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.6.2.min.js', array('jquery'), '', true );
    wp_enqueue_script('video-js', get_template_directory_uri() . '/assets/js/video.js', array('jquery'), '', true );
    wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array('jquery'), '', true );
    wp_enqueue_script('bigvideo', get_template_directory_uri() . '/assets/js/bigvideo.js', array('jquery','video-js','imagesloaded'), '', true );
    wp_enqueue_script('bxslider', get_template_directory_uri() . '/assets/js/jquery.bxslider.min.js', array('jquery'), '', true );
    
    #parallax
    wp_enqueue_script('parallax', get_template_directory_uri() . '/assets/js/parallax.min.js', array('jquery'), '', true );
    
    #theme javascript
    wp_enqueue_script('vega-wp-themejs', get_template_directory_uri() . '/assets/js/vega-wp.js', array('jquery'), '', true );
    
    #comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    
}
add_action( 'wp_enqueue_scripts', 'vega_wp_scripts' );


### CUSTOM CSS ###

add_action('wp_head','vega_wp_custom_css');
function vega_wp_custom_css() {
    $vega_wp_custom_css = vega_wp_get_option('vega_wp_custom_css'); 
	echo '<!-- Custom CSS -->';
    $output="<style>" . stripslashes($vega_wp_custom_css) . "</style>";
    echo $output;
    echo '<!-- /Custom CSS -->';
}

if ( ! function_exists( 'vega_show_custom_css_field' ) ) :
function vega_show_custom_css_field(){
    if(get_bloginfo('version') >= 4.7){
        $vega_wp_custom_css = vega_wp_get_option('vega_wp_custom_css');
        if($vega_wp_custom_css == '') return false;
        else return true;
    } 
    return true;
}
endif;

function vega_custom_css_banner(){ 
    $vega_wp_frontpage_banner_bg_color = vega_wp_get_option('vega_wp_frontpage_banner_bg_color'); 
    if($vega_wp_frontpage_banner_bg_color != '') {
        echo "
        <style>";
        echo ' .frontpage-banner.frontpage-banner-parallax-bg:before { width: 100%; height: 100%; background-color: ' . esc_attr($vega_wp_frontpage_banner_bg_color) . '; opacity: 0.35; content: ""; position: absolute; left: 0; top: 0; z-index: 2; }';
        echo ' .frontpage-simple-banner:before { width: 100%; height: 100%; background-color: ' . esc_attr($vega_wp_frontpage_banner_bg_color) . '; opacity: 0.35; content: ""; position: absolute; left: 0; top: 0; z-index: 2; } ';
        echo "</style>
        ";
    }
} 
add_action('wp_head','vega_custom_css_banner', 95);

function vega_custom_css_cta1(){ 
    $vega_wp_frontpage_cta_dark_parallax = vega_wp_get_option('vega_wp_frontpage_cta_dark_parallax'); 
    $vega_wp_frontpage_cta_dark_bg_color = vega_wp_get_option('vega_wp_frontpage_cta_dark_bg_color');
    $vega_wp_frontpage_cta_dark_bg_image = vega_wp_get_option('vega_wp_frontpage_cta_dark_bg_image');
    echo "
    <style>";
    if($vega_wp_frontpage_cta_dark_bg_image != '' && $vega_wp_frontpage_cta_dark_parallax != 'Y'){
        echo ".frontpage-cta1.image-bg {background-image:url(". esc_url($vega_wp_frontpage_cta_dark_bg_image) . "); -webkit-background-size:cover; -moz-background-size:cover; -o-background-size:cover; background-size:cover; background-repeat:no-repeat; z-index:0; background-position: center center;} ";
    }
    if ($vega_wp_frontpage_cta_dark_bg_color != '') {
        echo ".frontpage-cta1.parallax-bg:before, .frontpage-cta1.image-bg:before {background-color:" . esc_attr($vega_wp_frontpage_cta_dark_bg_color) . "} ";
        echo ".frontpage-cta1.color-bg{background-color:" . esc_attr($vega_wp_frontpage_cta_dark_bg_color) . "} ";
    }
    echo "</style>
    ";
} 
add_action('wp_head','vega_custom_css_cta1', 96);

function vega_custom_css_cta2(){ 
    $vega_wp_frontpage_cta_dark2_parallax = vega_wp_get_option('vega_wp_frontpage_cta_dark2_parallax'); 
    $vega_wp_frontpage_cta_dark2_bg_color = vega_wp_get_option('vega_wp_frontpage_cta_dark2_bg_color');
    $vega_wp_frontpage_cta_dark2_bg_image = vega_wp_get_option('vega_wp_frontpage_cta_dark2_bg_image');
    echo "
    <style>";
    if($vega_wp_frontpage_cta_dark2_bg_image != '' && $vega_wp_frontpage_cta_dark2_parallax != 'Y'){
        echo ".frontpage-cta2.image-bg {background-image:url(". esc_url($vega_wp_frontpage_cta_dark2_bg_image) . "); -webkit-background-size:cover; -moz-background-size:cover; -o-background-size:cover; background-size:cover; background-repeat:no-repeat; z-index:0; background-position: center center;} ";
    }
    if ($vega_wp_frontpage_cta_dark2_bg_color != '') {
        echo ".frontpage-cta2.parallax-bg:before, .frontpage-cta2.image-bg:before {background-color:" . esc_attr($vega_wp_frontpage_cta_dark2_bg_color) . "} ";
        echo ".frontpage-cta2.color-bg{background-color:" . esc_attr($vega_wp_frontpage_cta_dark2_bg_color) . "} ";
    }
    echo "</style>
    ";
} 
add_action('wp_head','vega_custom_css_cta2', 97);


### CUSTOMIZER STYLES ("Upgrade to Pro") ###

add_action( 'customize_controls_enqueue_scripts', 'vega_wp_custom_customize_enqueue' );
function vega_wp_custom_customize_enqueue() {
    wp_enqueue_style( 'customizer-css', get_stylesheet_directory_uri() . '/customize/style.css' );
}


### THEME UPDATES ###


$theme = get_template();
require_once 'theme-updates/theme-update-checker.php';
$checker = new ThemeUpdateChecker( $theme, 'https://s3.amazonaws.com/lyrathemes.com/themes/versions/vega-pro.json');
//$checker->checkForUpdates();


### WIDGETS ###

function vega_wp_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Default Sidebar', 'vega' ),
		'id'            => 'sidebar',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'vega' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Pages Sidebar', 'vega' ),
		'id'            => 'page-sidebar',
		'description'   => __( 'Add widgets here to appear in the sidebar on pages.', 'vega' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Posts Sidebar', 'vega' ),
		'id'            => 'post-sidebar',
		'description'   => __( 'Add widgets here to appear in the sidebar on posts.', 'vega' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Col 1', 'vega' ),
		'id'            => 'footer_1',
		'description'   => __( 'Add widgets here to appear in the first column of the footer.', 'vega' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Col 2', 'vega' ),
		'id'            => 'footer_2',
		'description'   => __( 'Add widgets here to appear in the second column of the footer.', 'vega' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Col 3', 'vega' ),
		'id'            => 'footer_3',
		'description'   => __( 'Add widgets here to appear in the third column of the footer.', 'vega' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Col 4', 'vega' ),
		'id'            => 'footer_4',
		'description'   => __( 'Add widgets here to appear in the fourth column of the footer.', 'vega' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'vega_wp_widgets_init' );


### INCLUDES ###

#bootstrap nav walker
require get_stylesheet_directory() . '/includes/wp_bootstrap_navwalker.php';
#customizer
require get_stylesheet_directory() . '/customize/animate-css.php';
require get_stylesheet_directory() . '/customize/google-fonts.php';
require get_template_directory() . '/customize/customizer.php';


### FUNCTIONS ###

function vega_wp_show_banner_title(){
    $vega_show_banner_title = true;
    $vega_wp_post_title = vega_wp_get_option('vega_wp_post_title');
    $vega_wp_page_title = vega_wp_get_option('vega_wp_page_title');
    if(is_page()){
        if($vega_wp_page_title == 'Both' || $vega_wp_page_title == 'Banner') $vega_show_banner_title = true;
        else $vega_show_banner_title = false;
    }
    if(is_single()){
        if($vega_wp_post_title == 'Both' || $vega_wp_post_title == 'Banner') $vega_show_banner_title = true;
        else $vega_show_banner_title = false;
    }
    return $vega_show_banner_title;
}

function vega_wp_show_content_title(){
    $vega_show_content_title = true;
    $vega_wp_post_title = vega_wp_get_option('vega_wp_post_title');
    $vega_wp_page_title = vega_wp_get_option('vega_wp_page_title');
    if(is_page()){
        if($vega_wp_page_title == 'Both' || $vega_wp_page_title == 'Content') $vega_show_content_title = true;
        else $vega_show_content_title = false;
    }
    if(is_single()){
        if($vega_wp_post_title == 'Both' || $vega_wp_post_title == 'Content') $vega_show_content_title = true;
        else $vega_show_content_title = false;
    }
    return $vega_show_content_title;
}

function vega_wp_section_bg_color($key){
    $bg_color = vega_wp_get_option($key);
    if($bg_color == '') return;
    
    echo ' style="background-color:' . esc_attr($bg_color) . '" ';
}

#vega_has_top_bar
if ( ! function_exists( 'vega_has_top_bar' ) ) :
function vega_has_top_bar(){
    if ( has_nav_menu( 'top_left' ) || has_nav_menu('top_right') ) {return true;}
    return false;
}
endif;

#vega_wp_copyright
if ( ! function_exists( 'vega_wp_copyright' ) ) :
function vega_wp_copyright() {
    $vega_wp_footer_copyright_message = vega_wp_get_option('vega_wp_footer_copyright_message'); 
    ?>
    <div class="copyright"><?php echo $vega_wp_footer_copyright_message ?></div>
    <?php 
}
endif;


#vega_wp_title
if ( ! function_exists( 'vega_wp_title' ) ) :
function vega_wp_title() {
    $title = '';
    if( is_home() && get_option('page_for_posts') ) {
        $title = get_page( get_option('page_for_posts') )->post_title;
    }
    else if ( is_page() ) {
        $title = get_the_title(); if($title == '') $title = __("Page ID: ", 'vega') . get_the_ID();
    }
    else if ( is_single() ){
        $title = get_the_title(); if($title == '') $title = __("Post ID: ", 'vega') . get_the_ID();
    }
    else if ( is_category() ) {
        $title = single_cat_title('', false);
    }
    else if ( is_tag() ) {
        $title = single_tag_title(__('Tag: ', 'vega'), false);
    }
    else if ( is_author() ) {
        $title = __('Author: ', 'vega') .  get_the_author();
    }
    else if ( is_day() ) {
        $title = __('Day: ', 'vega') . get_the_date() ;
    }
    else if ( is_month() ) {
        $title = __('Month: ', 'vega') . get_the_date( _x( 'F Y', 'monthly archives date format', 'vega' ) );
    }
    else if ( is_year() ) {
        $title = __('Year: ', 'vega') . get_the_date( _x( 'Y', 'yearly archives date format', 'vega' ) );
    }
    else if ( is_404() ) {
        $title = __('Not Found!', 'vega');
    }
    else if ( is_search() ) {
        $title = __('Search Results: ', 'vega') . get_search_query();
    } else if(function_exists('is_shop')) {
        if(is_shop()) $title = __('Shop', 'vega');
        if(is_product_category()) $title = single_term_title('', false);
    } else {
        $title = __( 'Archives', 'vega' );
    }
    
    return $title;
} 
endif;

#vega_wp_get_col_class
if ( ! function_exists( 'vega_wp_get_col_class' ) ) :
function vega_wp_get_col_class($n){
    switch($n){
        case 1: return 'col-xs-4 col-xs-offset-4'; break;
        case 2: return 'col-sm-3 col-sm-offset-3' . '|' . 'col-sm-3'; break;
        case 3: return 'col-sm-4|col-sm-4|col-sm-4'; break;
        case 4: return 'col-sm-3|col-sm-3|col-sm-3|col-sm-3'; break;
        case 5: return 'col-sm-2 col-sm-offset-1|col-sm-2|col-sm-2|col-sm-2|col-sm-2'; break;
        case 6: return 'col-sm-2 col-xs-6|col-sm-2 col-xs-6|col-sm-2 col-xs-6|col-sm-2 col-xs-6|col-sm-2 col-xs-6|col-sm-2 col-xs-6'; break;
    }
}
endif;

#vega_wp_get_equal_col_class
if ( ! function_exists( 'vega_wp_get_equal_col_class' ) ) :
function vega_wp_get_equal_col_class($n){
    switch($n){
        case 1: return 'col-md-12'; break;
        case 2: return 'col-lg-6 col-md-6 col-sm-6 col-xs-12'; break;
        case 3: return 'col-lg-4 col-md-4 col-sm-4 col-xs-12'; break;
        case 4: return 'col-lg-3 col-md-3 col-sm-6 col-xs-12'; break;
    }
}
endif;


#vega_wp_get_option
if ( ! function_exists( 'vega_wp_get_option' ) ) :
function vega_wp_get_option($key){
    global $vega_wp_defaults;
    if (array_key_exists($key, $vega_wp_defaults)) 
        $value = get_theme_mod($key, $vega_wp_defaults[$key]); 
    else
        $value = get_theme_mod($key);
    return $value;
}
endif;

#vega_wp_google_font_link
if ( ! function_exists( 'vega_wp_google_font_link' ) ) :
function vega_wp_google_font_link($font_name){
    global $google_fonts;
    return '//fonts.googleapis.com/css?family=' . $google_fonts[$font_name]['link'];
}
endif;

#vega_wp_google_font_usage
if ( ! function_exists( 'vega_wp_google_font_usage' ) ) :
function vega_wp_google_font_usage($font_name) {
    global $google_fonts;
    $serif = $google_fonts[$font_name]['serif'] == 'No' ? 'sans-serif' : 'serif';
    return "'$font_name', $serif";
}
endif;

#hex2rgb
function hex2rgb($hex) {
    #credits: http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}


### EXAMPLE CONTENT ###

#vega_wp_random_thumbnail
function vega_wp_random_thumbnail($size='default'){
    global $vega_wp_defaults;
    if($size == 'post-thumbnail-recent')
        $images = $vega_wp_defaults['vega_wp_recent_post_image'];
    else if($size == 'post-thumbnail-large')
        $images = $vega_wp_defaults['vega_wp_featured_image_large'];
    else 
        $images = $vega_wp_defaults['vega_wp_featured_image'];
    $rand_key = array_rand($images, 1);
    echo $images[$rand_key];
}

#vega_wp_sequential_thumbnail
function vega_wp_sequential_thumbnail($size, $n){
    global $vega_wp_defaults;
    if($size == 'post-thumbnail-recent')
        $images = $vega_wp_defaults['vega_wp_recent_post_image'];
    else 
        $images = $vega_wp_defaults['vega_wp_featured_image'];
    echo $images[$n]; 
}

#vega_wp_example_nav_header
function vega_wp_example_nav_header(){
    $args = array('parent'=>0);
    $pages = get_pages($args);
    echo '<div class="navbar-collapse collapse"><ul class="nav navbar-nav navbar-right menu-header">';
    #one page items    
    $vega_wp_frontpage_position_content = vega_wp_get_option('vega_wp_frontpage_position_content'); 
    $vega_wp_frontpage_position_4cols = vega_wp_get_option('vega_wp_frontpage_position_4cols'); 
    $vega_wp_frontpage_position_cta_dark = vega_wp_get_option('vega_wp_frontpage_position_cta_dark'); 
    $vega_wp_frontpage_position_open1 = vega_wp_get_option('vega_wp_frontpage_position_open1'); 
    $vega_wp_frontpage_position_latest_posts = vega_wp_get_option('vega_wp_frontpage_position_latest_posts'); 
    $arr[$vega_wp_frontpage_position_content] = 'content';
    $arr[$vega_wp_frontpage_position_4cols] = '4cols';
    $arr[$vega_wp_frontpage_position_cta_dark] = 'cta_dark';
    $arr[$vega_wp_frontpage_position_latest_posts] = 'latest_posts';
    $arr[$vega_wp_frontpage_position_open1] = 'open1';
    ksort($arr);
    foreach($arr as $k=>$v){
        if($v == 'content') {   echo '<li class="page-scroll"><a href="#welcome">' . __('Welcome', 'vega') . '</a></li>'; }
        if($v == '4cols')   {   $vega_wp_frontpage_4_cols_section_id = vega_wp_get_option('vega_wp_frontpage_4_cols_section_id');  
                                echo '<li class="page-scroll"><a href="#'.$vega_wp_frontpage_4_cols_section_id.'">' . $vega_wp_frontpage_4_cols_section_id . '</a></li>'; }
        if($v == 'cta_dark'){   $vega_wp_frontpage_cta_dark_section_id = vega_wp_get_option('vega_wp_frontpage_cta_dark_section_id');  
                                echo '<li class="page-scroll"><a href="#'.$vega_wp_frontpage_cta_dark_section_id.'">' . $vega_wp_frontpage_cta_dark_section_id . '</a></li>'; }
        if($v == 'latest_posts') {  $vega_wp_frontpage_latest_posts_section_id = vega_wp_get_option('vega_wp_frontpage_latest_posts_section_id');  
                                echo '<li class="page-scroll"><a href="#'.$vega_wp_frontpage_latest_posts_section_id.'">' . $vega_wp_frontpage_latest_posts_section_id . '</a></li>'; }
        if($v == 'open1')   {   $vega_wp_frontpage_open1_section_id = vega_wp_get_option('vega_wp_frontpage_open1_section_id');  
                                echo '<li class="page-scroll"><a href="#'.$vega_wp_frontpage_open1_section_id.'">' . $vega_wp_frontpage_open1_section_id . '</a></li>'; }
    }
    
    #all top level pages
    foreach($pages as $page) 
        echo '<li><a href="'.get_permalink($page->ID).'">'.$page->post_title.'</a></li>';
    echo '</ul>';
    echo '</div>';
}

#vega_wp_example_banner
function vega_wp_example_banner(){
    $image = esc_url( get_template_directory_uri() ) . '/sample/images/header.jpg';
    echo '<div class="jumbotron image-banner banner-custom-header" style="background:url(\''.$image.'\') no-repeat 0 0 #ffffff;background-size:cover;background-position:center center"><div class="container"><h1 class="block-title wow zoomIn">Your Awesome Tagline</h1></div></div>';
}

#vega_wp_example_fullscreen_banner
function vega_wp_example_fullscreen_banner(){
    $image = esc_url( get_template_directory_uri() ) . '/sample/images/fullscreen.jpg';
    echo '<div class="jumbotron image-banner frontpage-banner full-screen example-fullscreen-banner" style="background:url(\''.$image. '\') no-repeat 0 0 #ffffff;background-size:cover;background-position:center center"><div class="container"><div class="inner"><h1 class="block-title wow zoomIn">Clean Responsive Wordpress Theme</h1><p class="text-center hidden-xs wow zoomIn">Vega Pro is an easy-to-use, responsive theme. It comes with<br />awesome animation effects, and super clean code.</p><p><br /><a class="btn btn-primary-custom" href="#" role="button">DOWNLOAD NOW</a></p></div><div class="helper"></div></div></div>';
}

#vega_wp_example_nav_footer
function vega_wp_example_nav_footer(){
    $args = array('parent'=>0);
    $pages = get_pages($args);
    echo '<ul id="menu-footer" class="nav-foot">';
    foreach($pages as $page) 
        echo '<li><a href="'.get_permalink($page->ID).'">'.$page->post_title.'</a></li>';
    echo '</ul>';
}

#vega_wp_example_frontpage_content
function vega_wp_example_frontpage_content(){
    echo '<h2 class="block-title wow zoomIn">Welcome to Vega Pro</h2><div class="wow fadeInUp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nibh eros, varius eu luctus at, fermentum in magna. Suspendisse augue nulla, facilisis ut nisl eget, malesuada sodales massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam commodo fermentum dui vitae gravida. Ut vitae nisi gravida diam scelerisque pharetra. Aliquam ac sapien id lacus semper egestas quis at ante. In dolor dui, placerat eget consectetur sit amet, lacinia id quam. </div>';
}

#vega_wp_example_sidebar_footer
function vega_wp_example_sidebar_footer(){
    echo '<div class="footer-widgets bg-grey-light-3"><div class="container"><div class="row"><div class="col-md-3 footer-widget footer-widget-col-1"><div class="widget widget_text"><h3 class="widget-title">About Vega Lite</h3><div class="textwidget">These are example widgets. Turn off demo data to set up your own.<br /><br /><a href="#" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>&nbsp;<a href="#" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>&nbsp;<a href="#" class="btn btn-social-icon btn-flickr"><i class="fa fa-flickr"></i></a>&nbsp;<a href="#" class="btn btn-social-icon btn-google"><i class="fa fa-google"></i></a></div></div></div>';
    echo '<div class="col-md-3 footer-widget footer-widget-col-2">';
    the_widget('WP_Widget_Recent_Posts', 'title=Recent Posts', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="widget">&after_widget=</div>');
    echo '</div>';
    echo '<div class="col-md-3 footer-widget footer-widget-col-3">';
    the_widget('WP_Widget_Categories', 'title=Categories', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="widget">&after_widget=</div>');
    echo '</div>';
    echo '<div class="col-md-3 footer-widget footer-widget-col-3">';
    the_widget( 'WP_Widget_Meta', 'title=Meta', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="widget">&after_widget=</div>');
    echo '</div></div></div></div>';
}

#vega_wp_example_sidebar
function vega_wp_example_sidebar(){
    echo '<div class="sidebar-widgets" >';
    the_widget('WP_Widget_Pages', 'title=Pages', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="widget">&after_widget=</div>');
    the_widget('WP_Widget_Recent_Posts', 'title=Recent Posts', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="widget">&after_widget=</div>');
    the_widget('WP_Widget_Recent_Comments', 'title=Recent Comments', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="widget">&after_widget=</div>');
    the_widget( 'WP_Widget_Archives', 'title=Archives', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="widget">&after_widget=</div>');
    the_widget( 'WP_Widget_Categories', 'title=Categories', 'before_title=<h3 class="widget-title">&after_title=</h3>&before_widget=<div class="widget">&after_widget=</div>');
    echo '</div>';
}


?>