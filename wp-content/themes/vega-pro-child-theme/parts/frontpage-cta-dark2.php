<?php
/**
 * The template part for displaying the dark CTA section on the front page (static)
 *
 * @package vega
 */
?>
<?php 
$vega_wp_frontpage_cta_dark2 = vega_wp_get_option('vega_wp_frontpage_cta_dark2'); 

if($vega_wp_frontpage_cta_dark2 == 'Y') { 

global $post; //SiteOrign Page Builder fix
$cta_page = get_post(vega_wp_get_option('vega_wp_frontpage_cta_dark2_content')); 
$post = $cta_page ;
$vega_wp_frontpage_cta_dark2_content = apply_filters( 'the_content', $cta_page->post_content );

$vega_wp_frontpage_cta_dark2_parallax = vega_wp_get_option('vega_wp_frontpage_cta_dark2_parallax'); 
$vega_wp_frontpage_cta_dark2_bg_image = vega_wp_get_option('vega_wp_frontpage_cta_dark2_bg_image'); 
$vega_wp_frontpage_cta_dark2_bg_color = vega_wp_get_option('vega_wp_frontpage_cta_dark2_bg_color'); 
$vega_wp_frontpage_cta_dark2_section_id = vega_wp_get_option('vega_wp_frontpage_cta_dark2_section_id'); 

if($vega_wp_frontpage_cta_dark2_bg_image != ''){
    if($vega_wp_frontpage_cta_dark2_parallax == 'Y'){ 
        $class = 'parallax-bg';  
        $parallax_str = 'data-parallax="scroll" data-image-src="' . esc_url($vega_wp_frontpage_cta_dark2_bg_image) . '"'; 
    }
    else {
        $class = 'image-bg';
        $parallax_str = '';
    }
} else if ($vega_wp_frontpage_cta_dark2_bg_color != '') {
    $class = 'color-bg'; 
    $parallax_str = '';
}
?>
<!-- ========== Call to Action ========== -->
<div class="shadow"></div>
<div class="p-0 <?php echo $class ?>" <?php echo $parallax_str; ?> id="<?php echo esc_attr($vega_wp_frontpage_cta_dark2_section_id); ?>">
    <div>
        <?php echo $vega_wp_frontpage_cta_dark2_content; ?>
    </div>
</div>
<!-- ========== /Call to Action ========== -->
<?php 
wp_reset_postdata();
} ?>