<?php
/**
 * The front page template file.
 * 
 * @package vega
 */
?>
<?php get_header(); ?>
<?php get_template_part('parts/banner'); ?>

<?php $vega_wp_enable_demo = vega_wp_get_option('vega_wp_enable_demo'); ?>

<?php if(get_option('show_on_front') == 'page' || $vega_wp_enable_demo == 'Y') { ?>

<?php 
$vega_wp_frontpage_position_content = vega_wp_get_option('vega_wp_frontpage_position_content'); 
$vega_wp_frontpage_position_4cols = vega_wp_get_option('vega_wp_frontpage_position_4cols'); 
$vega_wp_frontpage_position_cta_dark = vega_wp_get_option('vega_wp_frontpage_position_cta_dark'); 
$vega_wp_frontpage_position_cta_dark2 = vega_wp_get_option('vega_wp_frontpage_position_cta_dark2'); 
$vega_wp_frontpage_position_open1 = vega_wp_get_option('vega_wp_frontpage_position_open1'); 
$vega_wp_frontpage_position_latest_posts = vega_wp_get_option('vega_wp_frontpage_position_latest_posts'); 

$vega_wp_frontpage_position_featured = vega_wp_get_option('vega_wp_frontpage_position_featured'); 
$vega_wp_frontpage_position_testimonials = vega_wp_get_option('vega_wp_frontpage_position_testimonials'); 
$vega_wp_frontpage_position_team = vega_wp_get_option('vega_wp_frontpage_position_team'); 
$vega_wp_frontpage_position_logos = vega_wp_get_option('vega_wp_frontpage_position_logos'); 

$arr[$vega_wp_frontpage_position_content] = 'content';
$arr[$vega_wp_frontpage_position_4cols] = '4cols';
$arr[$vega_wp_frontpage_position_cta_dark] = 'cta_dark';
$arr[$vega_wp_frontpage_position_cta_dark2] = 'cta_dark2';
$arr[$vega_wp_frontpage_position_latest_posts] = 'latest_posts';
$arr[$vega_wp_frontpage_position_open1] = 'open1';
$arr[$vega_wp_frontpage_position_featured] = 'featured';
$arr[$vega_wp_frontpage_position_testimonials] = 'testimonials';
$arr[$vega_wp_frontpage_position_team] = 'team';
$arr[$vega_wp_frontpage_position_logos] = 'logos';

ksort($arr);

foreach($arr as $k=>$v){
    if($v == 'content')     {   get_template_part('parts/frontpage', 'content'); }
    if($v == '4cols')       {   get_template_part('parts/frontpage', '4cols'); }
    if($v == 'cta_dark')    {   get_template_part('parts/frontpage', 'cta-dark'); }
    if($v == 'cta_dark2')   {   get_template_part('parts/frontpage', 'cta-dark2'); }
    if($v == 'latest_posts'){   get_template_part('parts/frontpage', 'latest-posts'); }
    if($v == 'open1')       {   get_template_part('parts/frontpage', 'open1'); }
    
    if($v == 'featured')    {   get_template_part('parts/frontpage', 'featured'); }
    if($v == 'testimonials'){   get_template_part('parts/frontpage', 'testimonials'); }
    if($v == 'team')        {   get_template_part('parts/frontpage', 'team'); }
    if($v == 'logos')       {   get_template_part('parts/frontpage', 'logos'); }
}

?>

<?php } else { ?>

    <!-- ========== Content Starts ========== -->
    <div class="section blog-feed bg-white">
        <div class="container">
            <div class="row">
            
                <?php 
                $vega_wp_blog_feed_sidebar = vega_wp_get_option('vega_wp_blog_feed_sidebar'); 
                if($vega_wp_blog_feed_sidebar == 'Y') { 
                    $col1_class = 'col-md-9'; $col2_class='col-md-3'; 
                } else { 
                    $col1_class = 'col-md-12'; $col2_class=''; 
                }
                ?>
            
                <div class="<?php echo $col1_class ?> blog-feed-column">
                
                    <!-- Loop -->
                    <?php $i = 0;
                    if ( have_posts() ) { 
                        while ( have_posts() ) : the_post();
                        if($vega_wp_blog_feed_sidebar == 'Y') { 
                            get_template_part( 'parts/content', get_post_format() );
                        } else {
                            ?>
                            <?php if($i%2==0) { ?><div class="row"><?php } ?>
                                <div class="col-md-6"><?php get_template_part( 'parts/content', get_post_format() ); $i++; ?></div>
                            <?php if($i%2 == 0) { ?></div><?php } ?>
                            <?php
                        }
                        endwhile;
                        if(($i+1)%2 == 0) { ?><div class="col-md-6">&nbsp;</div></div><?php }
                    } 
                    else { ?>
                    <div class="no-results"><p><?php _e('No posts found.', 'vega'); ?></p></div>
                    <?php } ?>
                    <!-- /Loop -->
                    
                    <!-- Pagination -->
                    <div class="posts-pagination">
                        <div class="posts-pagination-block">
                            <?php if( get_next_posts_link() ) { next_posts_link('<span class="ic ic-angle-left"></span>'); }?>
                            <?php if( get_previous_posts_link() ) { previous_posts_link('<span class="ic ic-angle-right"></span>'); } ?>
                        </div>
                    </div>
                    <!-- /Pagination -->
                    
                </div> 
                
                <?php if($vega_wp_blog_feed_sidebar == 'Y') { ?>
                <!-- Sidebar -->
                <div class="<?php echo $col2_class ?> sidebar">
                    <?php get_sidebar(); ?>
                </div> 
                <!-- /Sidebar -->
                <?php } ?>
                
            </div> 
        </div> 
    </div> 
    <!-- ========== /Content Ends ========== -->
    
<?php } ?>

<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>