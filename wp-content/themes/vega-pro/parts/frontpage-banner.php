<?php
/**
* The template part for displaying the banner for the front page (static)
*
* @package vega
*/
?>

<?php global $vega_wp_defaults; ?>
<?php 
$vega_wp_frontpage_banner = vega_wp_get_option('vega_wp_frontpage_banner'); 

switch($vega_wp_frontpage_banner){
    
    case 'Image Banner':
    case 'Full Screen Image':
    case 'Simple Banner':
    ?>
    
    <!-- ========== Front Page - Image Banner ========== -->
    
    <?php 
    $vega_wp_frontpage_banner_image = vega_wp_get_option('vega_wp_frontpage_banner_image');

    $vega_wp_frontpage_banner_heading = vega_wp_get_option('vega_wp_frontpage_banner_heading');
    $vega_wp_frontpage_banner_text = vega_wp_get_option('vega_wp_frontpage_banner_text');

    $header_image = get_header_image(); 

    if($vega_wp_frontpage_banner_image != '' || $header_image != '') { 
        #header image uploaded, no frontpage banner uploaded
        if($vega_wp_frontpage_banner_image == $vega_wp_defaults['vega_wp_frontpage_banner_image'] && $header_image != '') 
            $frontpage_banner = $header_image;
        else #header image uploaded, frontpage banner uploaded then removed
        if($vega_wp_frontpage_banner_image == '' && $header_image != '') 
            $frontpage_banner = $header_image;
        #no header image uploaded, no frontpage banner uploaded
        else if($header_image == '' && $vega_wp_frontpage_banner_image == $vega_wp_defaults['vega_wp_frontpage_banner_image'])
            $frontpage_banner = $vega_wp_frontpage_banner_image;
        #frontpage banner uploaded
        else if ($vega_wp_frontpage_banner_image != '')
            $frontpage_banner = $vega_wp_frontpage_banner_image;
    ?>
    
    <?php if($vega_wp_frontpage_banner != 'Simple Banner') { ?>

    <div class="image-banner frontpage-banner frontpage-banner-parallax-bg <?php if($vega_wp_frontpage_banner == 'Full Screen Image') { ?>full-screen<?php } ?>" data-parallax="scroll" data-image-src="<?php echo esc_url($frontpage_banner) ?>">
        <div class="container">
            <?php if( display_header_text() ) { ?>
            <div class="inner">
                <h1 class="block-title wow zoomIn"><?php echo esc_html($vega_wp_frontpage_banner_heading) ?></h1>
                <div class="text-center hidden-xs wow zoomIn description"><?php echo wp_kses_post($vega_wp_frontpage_banner_text) ?></div>
            </div><div class="helper"></div>
            <?php } else { ?>
            
            <?php } ?>
        </div>
    </div>

    <?php } else { ?>

    <div class="image-banner frontpage-banner frontpage-simple-banner">
    <img src="<?php echo esc_url($frontpage_banner) ?>" class="img-responsive" />
    <div class="caption">
        <div class="container">
            <?php if( display_header_text() ) { ?>
            <div class="inner">
                <h1 class="block-title wow zoomIn"><?php echo esc_html($vega_wp_frontpage_banner_heading) ?></h1>
                <div class="text-center hidden-xs wow zoomIn description"><?php echo wp_kses_post($vega_wp_frontpage_banner_text) ?></div>
            </div><div class="helper"></div>
            <?php } else { ?>
            
            <?php } ?>
        </div>
    </div>
</div>
    
    <?php }
    
    } 
    break;
    ?>
    
    <!-- ========== /Front Page - Image Banner ========== -->

    <?php
    case 'Video Banner':
    case 'Full Screen Video':
    
    $frontpage_banner = vega_wp_get_option('vega_wp_frontpage_banner_video');
    $frontpage_banner_fallback = vega_wp_get_option('vega_wp_frontpage_banner_video_fallback');
    $vega_wp_frontpage_banner_heading = vega_wp_get_option('vega_wp_frontpage_banner_heading');
    $vega_wp_frontpage_banner_text = vega_wp_get_option('vega_wp_frontpage_banner_text');
    ?>
    
    <!-- ========== Front Page - Video Banner ========== -->
    
    <div class="jumbotron video-banner frontpage-video-banner <?php if($vega_wp_frontpage_banner == 'Full Screen Video') { ?>full-screen<?php } ?>" style="background:url('<?php echo esc_url($frontpage_banner_fallback); ?>') no-repeat 0 0 #ffffff;background-size:cover;background-position:center center" data-video="<?php echo esc_url($frontpage_banner); ?>">
        <div class="container">
            <?php if( $vega_wp_frontpage_banner_heading == '' && $vega_wp_frontpage_banner_text == '' ) { ?>
            <?php } else { ?>
            <div class="inner">
                <?php if($vega_wp_frontpage_banner_heading != '') { ?><h1 class="block-title wow zoomIn"><?php echo esc_html($vega_wp_frontpage_banner_heading); ?></h1><?php } ?>
                <?php if($vega_wp_frontpage_banner_text != '') { ?><p class="text-center hidden-xs wow zoomIn"><?php echo wp_kses_post($vega_wp_frontpage_banner_text); ?></p><?php } ?>
            </div><div class="helper"></div>
            <?php } ?>
        </div>
    </div>
    
    <!-- ========== /Front Page - Video Banner ========== -->
    
    <?php
    break;
    
    case 'Image/Video Slideshow':
    case 'Full Screen Image/Video Slideshow':
    
    $vega_wp_frontpage_slideshow_n = vega_wp_get_option('vega_wp_frontpage_slideshow_n');
    if($vega_wp_frontpage_slideshow_n == '' || $vega_wp_frontpage_slideshow_n < 1 || $vega_wp_frontpage_slideshow_n > 10) $vega_wp_frontpage_slideshow_n = 10;
    
    for($i=1;$i<=$vega_wp_frontpage_slideshow_n;$i++) { 
        $temp = array();
        $temp['image'] = vega_wp_get_option('vega_wp_frontpage_slideshow_slide_' .$i. '_image');
        $temp['video'] = vega_wp_get_option('vega_wp_frontpage_slideshow_slide_' .$i. '_video');
        $temp['heading'] = vega_wp_get_option('vega_wp_frontpage_slideshow_slide_' .$i. '_heading');
        $temp['text'] = vega_wp_get_option('vega_wp_frontpage_slideshow_slide_' .$i. '_text');
        $temp['button_label'] = vega_wp_get_option('vega_wp_frontpage_slideshow_slide_' .$i. '_button_label');
        $temp['button_url'] = vega_wp_get_option('vega_wp_frontpage_slideshow_slide_' .$i. '_button_url');
        $temp['align'] = vega_wp_get_option('vega_wp_frontpage_slideshow_slide_' .$i. '_align');
        $temp['heading_animate_css'] = vega_wp_get_option('vega_wp_frontpage_slideshow_slide_' .$i. '_heading_animate_css');
        $temp['text_animate_css'] = vega_wp_get_option('vega_wp_frontpage_slideshow_slide_' .$i. '_text_animate_css');
        $temp['button_animate_css'] = vega_wp_get_option('vega_wp_frontpage_slideshow_slide_' .$i. '_button_animate_css');
        $slideshow_images[$i] = $temp;
    }
    ?>
    
    <!-- ========== Image/Video Slideshow ========== -->
    <div class="section section_slideshow">
        <div id="vega-wp-carousel<?php if($vega_wp_frontpage_banner == 'Full Screen Image/Video Slideshow') { ?>-full-screen<?php } ?>">
            <ul>
                <?php for($i=1;$i<=$vega_wp_frontpage_slideshow_n;$i++) {  ?>
                <!-- Slide <?php echo $i ?> -->
                <li class="item <?php if($i == 1) { ?>active<?php } ?>" style="background-image:url(<?php echo esc_url($slideshow_images[$i]['image']); ?>)" <?php if($slideshow_images[$i]['video'] != '') { ?>data-video="<?php echo esc_url($slideshow_images[$i]['video']); ?>" <?php } ?>>
                    <div class="carousel-caption <?php echo esc_attr($slideshow_images[$i]['align']); ?> white">
                        <div class="container">
                            <div class="inner">
                                <?php if($slideshow_images[$i]['heading'] != '') { ?>
                                <h1 <?php if($slideshow_images[$i]['heading_animate_css']!='None') { ?>data-animation="animated <?php echo esc_attr($slideshow_images[$i]['heading_animate_css']); ?>" <?php } ?>><?php echo esc_html($slideshow_images[$i]['heading']); ?></h1>
                                <?php } ?>
                                
                                <?php if ( $slideshow_images[$i]['text'] != '') { ?>
                                <p <?php if($slideshow_images[$i]['text_animate_css']!='None') { ?>data-animation="animated <?php echo esc_attr($slideshow_images[$i]['text_animate_css']); ?>"<?php } ?>><?php echo wp_kses_post($slideshow_images[$i]['text']); ?></p>
                                <?php } ?>
                                
                                <?php if ($slideshow_images[$i]['button_url'] != '' && $slideshow_images[$i]['button_label'] != '') { ?>
                                <p <?php if($slideshow_images[$i]['button_animate_css']!='None') { ?>data-animation="animated <?php echo esc_attr($slideshow_images[$i]['button_animate_css']); ?>"<?php } ?>>
                                <a class="btn btn-primary-custom" href="<?php echo esc_url($slideshow_images[$i]['button_url']); ?>"><?php echo esc_html($slideshow_images[$i]['button_label']); ?></a></p>
                                <?php } ?>
                                
                            </div>
                            <div class="helper"></div>
                        </div>
                    </div>
                </li>
                <!-- /Slide <?php echo $i ?> -->
                <?php } ?>
            </ul>
        </div>
    </div>
    <!-- ========== /Image/Video Slideshow ========== -->
    
    <?php
    break;
}



?>