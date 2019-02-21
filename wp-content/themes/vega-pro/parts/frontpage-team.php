<?php
/**
 * The template part for displaying the team members on the front page (static)
 *
 * @package vega
 */
?>

<?php 
$vega_wp_frontpage_team = vega_wp_get_option('vega_wp_frontpage_team');

#show team section?
if($vega_wp_frontpage_team == 'Y') { 

$vega_wp_frontpage_team_heading = vega_wp_get_option('vega_wp_frontpage_team_heading');
$vega_wp_frontpage_team_text = vega_wp_get_option('vega_wp_frontpage_team_text');
$vega_wp_frontpage_team_n = vega_wp_get_option('vega_wp_frontpage_team_n');
$vega_wp_frontpage_team_section_id = vega_wp_get_option('vega_wp_frontpage_team_section_id');

$vega_wp_frontpage_team_n_1 = 0;
$vega_wp_frontpage_team_n_2 = 0;
if($vega_wp_frontpage_team_n > 5) { 
    $vega_wp_frontpage_team_n_1 = (int)($vega_wp_frontpage_team_n / 2); 
    $vega_wp_frontpage_team_n_2 = $vega_wp_frontpage_team_n - $vega_wp_frontpage_team_n_1;
} else {
    $vega_wp_frontpage_team_n_1 = $vega_wp_frontpage_team_n;
}

$class = vega_wp_get_col_class($vega_wp_frontpage_team_n_1);
$classes_1 = explode('|', $class);

if($vega_wp_frontpage_team_n_2 != 0) {
    $class = vega_wp_get_col_class($vega_wp_frontpage_team_n_2);
    $classes_2 = explode('|', $class);
}

for($i=1;$i<=$vega_wp_frontpage_team_n;$i++){
    $temp = array();
    $temp['image'] = vega_wp_get_option('vega_wp_frontpage_team_member_'.$i.'_image'); 
    $temp['name'] = vega_wp_get_option('vega_wp_frontpage_team_member_'.$i.'_name'); 
    $temp['position'] = vega_wp_get_option('vega_wp_frontpage_team_member_'.$i.'_position'); 
    $temp['url'] = vega_wp_get_option('vega_wp_frontpage_team_member_'.$i.'_url'); 
    $temp['social_link_1'] = vega_wp_get_option('vega_wp_frontpage_team_member_'.$i.'_social_link_1'); 
    $temp['social_link_1_icon'] = vega_wp_get_option('vega_wp_frontpage_team_member_'.$i.'_social_link_1_icon'); 
    $temp['social_link_2'] = vega_wp_get_option('vega_wp_frontpage_team_member_'.$i.'_social_link_2'); 
    $temp['social_link_2_icon'] = vega_wp_get_option('vega_wp_frontpage_team_member_'.$i.'_social_link_2_icon'); 
    $team[] = $temp;
}

?>


<!-- ========== Team ========== -->
<div class="section frontpage-team" id="<?php echo esc_attr($vega_wp_frontpage_team_section_id); ?>" <?php vega_wp_section_bg_color('vega_wp_frontpage_team_bg_color'); ?>>
    <div class="container">
    
        <?php if($vega_wp_frontpage_team_heading != '') { ?>
        <h2 class="block-title wow zoomIn"><?php echo esc_html($vega_wp_frontpage_team_heading); ?></h2>
        <?php } ?>
        
        <?php if($vega_wp_frontpage_team_text != '') { ?>
        <p class="text-center wow fadeIn description"><?php echo wp_kses_post($vega_wp_frontpage_team_text); ?></p>
        <?php } ?>
        
        <div class="team-members">
            <div class="row">
                <?php for($i=0;$i<$vega_wp_frontpage_team_n_1;$i++) { ?>
                <div class="<?php echo $classes_1[$i] ?>">
                    <div class="item wow zoomIn">
                        <?php if($team[$i]['image']!='') { ?>
                        <div class="image"><?php if($team[$i]['url'] != '') { ?><a href="<?php echo esc_url($team[$i]['url']); ?>"><?php } ?><img src="<?php echo esc_url($team[$i]['image']); ?>" alt="" class="img-responsive" /><?php if($team[$i]['url'] != '') { ?></a><?php } ?></div>
                        <?php } ?>
                        <div class="info">
                            <?php if($team[$i]['name'] != '') { ?>
                                <?php if($team[$i]['url'] == '') { ?><h4 class="name"><?php echo esc_html($team[$i]['name']); ?></h4>
                                <?php } else { ?><h4 class="name"><a href="<?php echo esc_url($team[$i]['url']); ?>"><?php echo esc_html($team[$i]['name']); ?></a><?php } ?>
                            <?php } ?>
                            <?php if($team[$i]['position'] != '') { ?><h5 class="position"><?php echo esc_html($team[$i]['position']); ?></h5><?php } ?>
                            <ul class="list-inline social">
                                <?php if($team[$i]['url'] != '') { ?><li><a href="<?php echo esc_url($team[$i]['url']); ?>" ><i class="rounded-x fa fa-link"></i></a></li><?php } ?>
                                <?php if($team[$i]['social_link_1'] != '') { ?><li><a href="<?php echo esc_url($team[$i]['social_link_1']); ?>" ><i class="rounded-x fa <?php echo esc_attr($team[$i]['social_link_1_icon']); ?>"></i></a></li><?php } ?>
                                <?php if($team[$i]['social_link_2'] != '') { ?><li><a href="<?php echo esc_url($team[$i]['social_link_2']); ?>" ><i class="rounded-x fa <?php echo esc_attr($team[$i]['social_link_2_icon']); ?>"></i></a></li><?php } ?>
                            </ul>
                        </div>
                        <div class="helper"></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        
        <?php if($vega_wp_frontpage_team_n_2 > 0) { ?>
        <div class="team-members">
            <div class="row">
                <?php for($i=0;$i<$vega_wp_frontpage_team_n_2;$i++) { ?>
                <div class="<?php echo $classes_2[$i] ?>">
                    <div class="item wow zoomIn">
                        <?php if($team[$i]['image']!='') { ?>
                        <div class="image"><?php if($team[$i]['url'] != '') { ?><a href="<?php echo esc_url($team[$i]['url']); ?>"><?php } ?><img src="<?php echo esc_url($team[$i]['image']); ?>" alt="" class="img-responsive" /><?php if($team[$i]['url'] != '') { ?></a><?php } ?></div>
                        <?php } ?>
                        <div class="info">
                            <?php if($team[$i]['name'] != '') { ?>
                                <?php if($team[$i]['url'] == '') { ?><h4 class="name"><?php echo esc_html($team[$i]['name']); ?></h4>
                                <?php } else { ?><h4 class="name"><a href="<?php echo esc_url($team[$i]['url']); ?>"><?php echo esc_html($team[$i]['name']); ?></a><?php } ?>
                            <?php } ?>
                            <?php if($team[$i]['position'] != '') { ?><h5 class="position"><?php echo esc_html($team[$i]['position']); ?></h5><?php } ?>
                            <ul class="list-inline social">
                                <?php if($team[$i]['url'] != '') { ?><li><a href="<?php echo esc_url($team[$i]['url']); ?>" ><i class="rounded-x fa fa-link"></i></a></li><?php } ?>
                                <?php if($team[$i]['social_link_1'] != '') { ?><li><a href="<?php echo esc_url($team[$i]['social_link_1']); ?>" ><i class="rounded-x fa <?php echo esc_attr($team[$i]['social_link_1_icon']); ?>"></i></a></li><?php } ?>
                                <?php if($team[$i]['social_link_2'] != '') { ?><li><a href="<?php echo esc_url($team[$i]['social_link_2']); ?>" ><i class="rounded-x fa <?php echo esc_attr($team[$i]['social_link_2_icon']); ?>"></i></a></li><?php } ?>
                            </ul>
                        </div>
                        <div class="helper"></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        
    </div>
</div>
<!-- ========== /Team ========== -->


<?php } ?>
