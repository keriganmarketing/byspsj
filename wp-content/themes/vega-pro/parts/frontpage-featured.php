<?php
/**
 * The template part for displaying the 4 featured columns (with images) on the front page (static)
 *
 * @package vega
 */
?>

<?php 
$vega_wp_frontpage_featured = vega_wp_get_option('vega_wp_frontpage_featured'); 

#show featured pages section?
if($vega_wp_frontpage_featured == 'Y') { 

$vega_wp_frontpage_featured_pages_heading = vega_wp_get_option('vega_wp_frontpage_featured_pages_heading'); 
$vega_wp_frontpage_featured_pages_text = vega_wp_get_option('vega_wp_frontpage_featured_pages_text'); 
$vega_wp_frontpage_featured_pages_n = vega_wp_get_option('vega_wp_frontpage_featured_pages_n');
$vega_wp_frontpage_featured_pages_section_id = vega_wp_get_option('vega_wp_frontpage_featured_pages_section_id'); 

$class = vega_wp_get_col_class($vega_wp_frontpage_featured_pages_n);
$classes = explode('|', $class);

for($i=1;$i<=$vega_wp_frontpage_featured_pages_n;$i++){
    $temp = array();
    $temp['image'] = vega_wp_get_option('vega_wp_frontpage_featured_pages_page_'.$i.'_image'); 
    $temp['url'] = vega_wp_get_option('vega_wp_frontpage_featured_pages_page_'.$i.'_url'); 
    $temp['heading'] = vega_wp_get_option('vega_wp_frontpage_featured_pages_page_'.$i.'_heading'); 
    $temp['text'] = vega_wp_get_option('vega_wp_frontpage_featured_pages_page_'.$i.'_text'); 
    $featured_pages[] = $temp;
}

?>

<!-- ========== Featured Pages ========== -->
<div class="section frontpage-featured-pages" id="<?php echo esc_attr($vega_wp_frontpage_featured_pages_section_id); ?>" <?php vega_wp_section_bg_color('vega_wp_frontpage_featured_pages_bg_color'); ?>>
    <div class="container">
        
        <?php if($vega_wp_frontpage_featured_pages_heading != '') { ?>
        <h2 class="block-title wow zoomIn"><?php echo esc_html($vega_wp_frontpage_featured_pages_heading); ?></h2>
        <?php } ?>
        
        <?php if($vega_wp_frontpage_featured_pages_text != '') { ?>
        <p class="text-center wow fadeIn description"><?php echo wp_kses_post($vega_wp_frontpage_featured_pages_text); ?></p>
        <?php } ?>
        
        <div class="row">
            <?php for($i=0;$i<$vega_wp_frontpage_featured_pages_n;$i++) { ?>
            <div class="<?php echo $classes[$i] ?>">
                
                <div class="featured-page wow fadeInUp">
                
                    <?php if($featured_pages[$i]['image'] != '') { ?>
                    <div class="image center">
                        <?php if($featured_pages[$i]['url'] != '') { ?>
                        <a href="<?php echo esc_url($featured_pages[$i]['url']); ?>"><img src="<?php echo esc_url($featured_pages[$i]['image']); ?>" alt="" /></a>
                        <?php } else { ?>
                        <img src="<?php echo esc_url($featured_pages[$i]['image']); ?>" alt="" />
                        <?php } ?>
                    </div>
                    <?php } ?>
                    
                    <?php if($featured_pages[$i]['url'] != '') { ?>
                    <h5 class="title center"><a href="<?php echo $featured_pages[$i]['url'] ?>"><?php echo esc_html($featured_pages[$i]['heading']); ?></a></h5>
                    <?php } else { ?>
                    <h5 class="title center"><?php echo esc_html($featured_pages[$i]['heading']); ?></h5>
                    <?php } ?>
                    
                    <?php if($featured_pages[$i]['text'] != '') { ?><div class="body center"><?php echo wp_kses_post($featured_pages[$i]['text']); ?></div><?php } ?>
                    
                </div>
                
            </div>
            <?php } ?>
        </div>
        
    </div>
</div>
<!-- ========== /Featured Pages ========== -->
<?php } ?>
