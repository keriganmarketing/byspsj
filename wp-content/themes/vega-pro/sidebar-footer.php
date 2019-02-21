<?php
/**
 * The widget area for footer.
 *
 * @package vega
 */
?>

<?php #EXAMPLE CONTENT: If at least one sidebar is active, it will be shown. If no sidebar widgets are defined and demo is on, the example sidebar will be displayed. ?>
<?php $vega_wp_enable_demo = vega_wp_get_option('vega_wp_enable_demo'); ?>

<?php if ( is_active_sidebar( 'footer_1' ) || is_active_sidebar( 'footer_2' ) || is_active_sidebar( 'footer_3' ) || is_active_sidebar( 'footer_4' ) ) { ?>
<!-- ========== Footer Widgets ========== -->
<div class="footer-widgets bg-footer">
    <div class="container">
        <div class="row">
            <?php 
            $i=0;
            if(is_active_sidebar( 'footer_1' )) $i++;
            if(is_active_sidebar( 'footer_2' )) $i++;
            if(is_active_sidebar( 'footer_3' )) $i++;
            if(is_active_sidebar( 'footer_4' )) $i++;
            $class = vega_wp_get_equal_col_class($i);
            ?>
            <?php if ( is_active_sidebar( 'footer_1' ) ) : ?>
            <!-- Footer Col 1 -->
            <div class="<?php echo $class ?> footer-widget footer-widget-col-1 wow">
                <?php dynamic_sidebar( 'footer_1' ); ?>
            </div>
            <!-- /Footer Col 1 -->
            <?php endif; ?>
            
            <?php if ( is_active_sidebar( 'footer_2' ) ) : ?>
            <!-- Footer Col 2 -->
            <div class="<?php echo $class ?> footer-widget footer-widget-col-2 wow">
                <?php dynamic_sidebar( 'footer_2' ); ?>
            </div>
            <!-- /Footer Col 2 -->
            <?php endif; ?>
            
            <?php if ( is_active_sidebar( 'footer_3' ) ) : ?>
            <!-- Footer Col 3 -->
            <div class="<?php echo $class ?> footer-widget footer-widget-col-3 wow">
                <?php dynamic_sidebar( 'footer_3' ); ?>
            </div>
            <!-- /Footer Col 3 -->
            <?php endif; ?>
            
            <?php if ( is_active_sidebar( 'footer_4' ) ) : ?>
            <!-- Footer Col 4 -->
            <div class="<?php echo $class ?> footer-widget footer-widget-col-4 wow" >
                <?php dynamic_sidebar( 'footer_4' ); ?>
            </div>
            <!-- /Footer Col 4 -->
            <?php endif; ?>
            
        </div>
    </div>
</div>
<!-- ========== /Footer Widgets ========== -->
<?php } else if($vega_wp_enable_demo == 'Y') { vega_wp_example_sidebar_footer(); } ?>
