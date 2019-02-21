<?php
/**
 * The main template file.
 * 
 * @package vega
 */
?>
<?php get_header(); ?>
<?php get_template_part('parts/banner'); ?>

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

<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>