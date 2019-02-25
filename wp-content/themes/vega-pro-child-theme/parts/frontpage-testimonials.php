<?php
/**
 * The template part for displaying the 4 featured columns (with images) on the front page (static)
 *
 * @package vega
 */
?>

<?php 
$vega_wp_frontpage_testimonials = vega_wp_get_option('vega_wp_frontpage_testimonials'); 

if($vega_wp_frontpage_testimonials == 'Y') { 

$vega_wp_frontpage_testimonials_heading = vega_wp_get_option('vega_wp_frontpage_testimonials_heading'); 
$vega_wp_frontpage_testimonials_n = vega_wp_get_option('vega_wp_frontpage_testimonials_n');
$vega_wp_frontpage_testimonials_section_id = vega_wp_get_option('vega_wp_frontpage_testimonials_section_id'); 

for($i=1;$i<=$vega_wp_frontpage_testimonials_n;$i++){
    $temp = array();
    $temp['image'] = vega_wp_get_option('vega_wp_frontpage_testimonial_'.$i.'_image'); 
    $temp['company'] = vega_wp_get_option('vega_wp_frontpage_testimonial_'.$i.'_company'); 
    $temp['client'] = vega_wp_get_option('vega_wp_frontpage_testimonial_'.$i.'_client'); 
    $temp['text'] = vega_wp_get_option('vega_wp_frontpage_testimonial_'.$i.'_text'); 
    $testimonials[] = $temp;
}

?>

<!-- ========== Testimonials ========== -->
<div class="section frontpage-testimonials" id="<?php echo esc_attr($vega_wp_frontpage_testimonials_section_id); ?>" <?php vega_wp_section_bg_color('vega_wp_frontpage_testimonials_bg_color'); ?>>
    <div class="container">
        
        <?php if($vega_wp_frontpage_testimonials_heading != '') { ?>
        <h2 class="block-title wow zoomIn"><?php echo esc_html($vega_wp_frontpage_testimonials_heading); ?></h2>
        <?php } ?>
        
        <div class="row">
            <div class="col-md-8 col-md-offset-2 wow fadeIn">
        
                <!-- Testimonials Carousel -->
                <div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php for($i=0;$i<$vega_wp_frontpage_testimonials_n;$i++) { ?>
                        <div class="item <?php if($i==0) { ?>active<?php } ?>">
                            <div class="testimonial">
                                <div class="details">
                                    <?php if($testimonials[$i]['text'] != '') { ?><div class="text"><?php echo esc_html($testimonials[$i]['text']); ?></div><?php } ?>
                                    <?php if($testimonials[$i]['image'] != '') { ?><div class="image"><img src="<?php echo esc_url($testimonials[$i]['image']); ?>" alt="" /></div><?php } ?>
                                    <?php if($testimonials[$i]['client'] != '') { ?><h3 class="name"><?php echo esc_html($testimonials[$i]['client']); ?></h3><?php } ?>
                                    <?php if($testimonials[$i]['company'] != '') { ?><h5 class="company"><?php echo esc_html($testimonials[$i]['company']); ?></h5><?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="carousel-control-block">
                        <a class="carousel-control-left" href="#testimonial-carousel" data-slide="prev"><span class="fa fa-chevron-left"></span></a>
                        <a class="carousel-control-right" href="#testimonial-carousel" data-slide="next"><span class="fa fa-chevron-right"></span></a>
                    </div>
                </div>
                <!-- /Testimonials Carousel -->
                
            </div>
        </div>
        
    </div>
</div>
<!-- ========== /Testimonials ========== -->
<?php } ?>
