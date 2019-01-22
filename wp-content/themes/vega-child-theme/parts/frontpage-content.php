<?php
/**
 * The template part for displaying the front page content 
 *
 * @package vega
 */
?>

<?php 
$vega_wp_frontpage_content = vega_wp_get_option('vega_wp_frontpage_content'); 
?>

<?php #EXAMPLE CONTENT: If a static front page has been defined, the content from that page will be shown. Otherwise IF demo is on, the content from a random page will be displayed. ?>
<?php if($vega_wp_frontpage_content == 'Y' && get_option('show_on_front') == 'page') {  ?>
<!-- ========== Page Content ========== -->
<div class="frontpage-content bg-white">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
        <div><?php the_content(); ?></div>
        <?php endwhile; ?>
    </div>
</div> 
<!-- ========== /Page Content ========== -->
<?php } ?>