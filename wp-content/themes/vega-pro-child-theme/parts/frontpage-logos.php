<?php
/**
 * The template part for displaying the logos on the front page (static)
 *
 * @package vega
 */
?>

<?php 
$vega_wp_frontpage_logos = vega_wp_get_option('vega_wp_frontpage_logos');

#show logos section?
if($vega_wp_frontpage_logos == 'Y') { 

$vega_wp_frontpage_logos_heading = vega_wp_get_option('vega_wp_frontpage_logos_heading');
$vega_wp_frontpage_logos_text = vega_wp_get_option('vega_wp_frontpage_logos_text');
$vega_wp_frontpage_logos_n = vega_wp_get_option('vega_wp_frontpage_logos_n');
$vega_wp_frontpage_logos_section_id = vega_wp_get_option('vega_wp_frontpage_logos_section_id');

$vega_wp_frontpage_logos_n_1 = 0;
$vega_wp_frontpage_logos_n_2 = 0;
if($vega_wp_frontpage_logos_n > 5) { 
    $vega_wp_frontpage_logos_n_1 = (int)($vega_wp_frontpage_logos_n / 2); 
    $vega_wp_frontpage_logos_n_2 = $vega_wp_frontpage_logos_n - $vega_wp_frontpage_logos_n_1;
} else {
    $vega_wp_frontpage_logos_n_1 = $vega_wp_frontpage_logos_n;
}


$class = vega_wp_get_col_class($vega_wp_frontpage_logos_n_1);
$classes_1 = explode('|', $class);

if($vega_wp_frontpage_logos_n_2 != 0) {
    $class = vega_wp_get_col_class($vega_wp_frontpage_logos_n_2);
    $classes_2 = explode('|', $class);
}

for($i=1;$i<=$vega_wp_frontpage_logos_n;$i++){
    $temp = array();
    $temp['image'] = vega_wp_get_option('vega_wp_frontpage_logo_'.$i.'_image'); 
    $temp['url'] = vega_wp_get_option('vega_wp_frontpage_logo_'.$i.'_url'); 
    $logos[] = $temp;
}

?>

<!-- ========== Logos ========== -->
<div class="section frontpage-logos" id="<?php echo esc_attr($vega_wp_frontpage_logos_section_id); ?>" <?php vega_wp_section_bg_color('vega_wp_frontpage_logos_bg_color'); ?>>
    <div class="container">
    
        <?php if($vega_wp_frontpage_logos_heading != '') { ?>
        <h2 class="block-title wow zoomIn"><?php echo esc_html($vega_wp_frontpage_logos_heading); ?></h2>
        <?php } ?>
        
        <?php if($vega_wp_frontpage_logos_text != '') { ?>
        <div class="text-center wow fadeIn description"><?php echo wp_kses_post($vega_wp_frontpage_logos_text); ?></div>
        <?php } ?>
        
        <div class="row">
        
            <?php for($i=0;$i<$vega_wp_frontpage_logos_n_1;$i++) { ?>
            
            <div class="text-center <?php echo $classes_1[$i] ?>"><?php if($logos[$i]['url'] != '') { ?><a href="<?php echo esc_url($logos[$i]['url']); ?>" class="wow zoomIn"><?php } ?><img src="<?php echo esc_url($logos[$i]['image']); ?>" class="img-responsive" alt="" /><i class="helper"></i><?php if($logos[$i]['url'] != '') { ?></a><?php } ?></div>
            
            <?php } ?>
            
        </div>
        
        
        <?php if($vega_wp_frontpage_logos_n_2 > 0) { ?>
        
        <div class="row">
        
            <?php for($i=0;$i<$vega_wp_frontpage_logos_n_2;$i++) { ?>
            
            <div class="text-center <?php echo $classes_2[$i] ?>"><?php if($logos[$i]['url'] != '') { ?><a href="<?php echo esc_url($logos[$i]['url']); ?>" class="wow zoomIn"><?php } ?><img src="<?php echo esc_url($logos[$i]['image']); ?>" class="img-responsive" alt="" /><i class="helper"></i><?php if($logos[$i]['url'] != '') { ?></a><?php } ?></div>
            
            <?php } ?>
            
        </div>
        
        <?php } ?>
        
        
    </div>
</div>
<!-- ========== /Logos ========== -->


<?php } ?>
