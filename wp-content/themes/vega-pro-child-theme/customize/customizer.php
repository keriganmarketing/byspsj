<?php
/**
 * Customizer functionality
 *
 * @package vega
 */
?>
<?php
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function vega_wp_customize_register( $wp_customize ) {

    global $vega_wp_defaults;
    
    $wp_customize->add_section( 'vega_wp_info_section' , array( 'title' => __( 'THEME INFO', 'vega' ), 'priority' => 2, 'description' => '<h3>Documentation and Sample Data</h3>
    <ul><li>&raquo; Click <a href="https://www.lyrathemes.com/documentation/vega-pro.pdf" target="_blank">here</a> to view the documentation.</li><li>&raquo; Click <a href="https://www.lyrathemes.com/sample-data/vega-pro-sample-data.zip" target="_blank">here</a> to download some sample data.</li></ul>', 'vega') );

    $wp_customize->add_setting( 'vega_wp_info', array( 'default' => $vega_wp_defaults['vega_wp_info'] ) );
    $wp_customize->add_control( 'vega_wp_info', array( 
                                    'section' => 'vega_wp_info_section',
                                    'settings' => 'vega_wp_info', 
                                    'type' => 'hidden',
                                    'description' => __('&nbsp;', 'vega') ) );
                                    
    /*** vega_wp_general_settings_section ***/
    
    $wp_customize->add_section( 'vega_wp_general_settings_section' , array( 'title' => __( 'General Setup', 'vega' ), 'priority' => 3, 'description' => '', ) );

    $wp_customize->add_setting( 'vega_wp_enable_demo', array( 'default' => $vega_wp_defaults['vega_wp_enable_demo'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_enable_demo', array( 
                                    'label' => __( 'Enable Demo?', 'vega' ), 
                                    'section' => 'vega_wp_general_settings_section',
                                    'settings' => 'vega_wp_enable_demo', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('When the theme is first installed, the demo mode would be turned on. This will display some sample/example content to show you how the website can be possibly set up. When you are comfortable with the theme options, you should turned this off.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_animations', array( 'default' => $vega_wp_defaults['vega_wp_animations'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_animations', array( 
                                    'label' => __( 'Enable Animations?', 'vega' ), 
                                    'section' => 'vega_wp_general_settings_section',
                                    'settings' => 'vega_wp_animations', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('By default, animations are enabled.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_admin_bar', array( 'default' => $vega_wp_defaults['vega_wp_admin_bar'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_admin_bar', array( 
                                    'label' => __( 'Enable Admin Bar on Frontend?', 'vega' ), 
                                    'section' => 'vega_wp_general_settings_section',
                                    'settings' => 'vega_wp_admin_bar', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('By default, admin bar is enabled.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_footer_copyright_message', array( 'default' => $vega_wp_defaults['vega_wp_footer_copyright_message'], 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_footer_copyright_message', array( 
                                    'label' => 'Copyright Text', 
                                    'section' => 'vega_wp_general_settings_section',
                                    'type' => 'textarea', 
                                    'description' => __('Copyright text. Accepts HTML.', 'vega') ));
    
    /*** vega_wp_logo_section ***/
    
    /* $wp_customize->add_section( 'vega_wp_logo_section' , array( 'title' => __( 'Logo Options', 'vega' ), 'priority' => 35, 'description' => '', ) ); */

    $wp_customize->add_setting( 'vega_wp_show_logo_image', array( 'default' => $vega_wp_defaults['vega_wp_show_logo_image'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_show_logo_image', array( 
                                    'label' => __( 'Show Image Logo?', 'vega' ), 
                                    'section' => 'title_tagline',
                                    'settings' => 'vega_wp_show_logo_image', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether to display the logo image set up under `Site Identity`', 'vega') ) );

    
    $wp_customize->add_setting( 'vega_wp_logo_text', array( 'default' => $vega_wp_defaults['vega_wp_logo_text'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_logo_text', array( 
                                    'label' => 'Text Logo', 
                                    'section' => 'title_tagline',
                                    'type' => 'text', 
                                    'description' => __('Displayed when `Show Image Logo?` is `No` or if there is no logo image uploaded.', 'vega') ));
    
    
    /*** vega_wp_colors_section ***/


    $wp_customize->add_setting( 'vega_wp_color_stylesheet', array( 'default' => $vega_wp_defaults['vega_wp_color_stylesheet'], 'sanitize_callback' => 'vega_wp_sanitize_radio_colors' ) );
    $wp_customize->add_control( 'vega_wp_color_stylesheet', array( 
                                    'label' => __( 'Select Color Scheme', 'vega' ), 
                                    'section' => 'colors',
                                    'settings' => 'vega_wp_color_stylesheet', 
                                    'type' => 'radio', 
                                    'choices' => array('Orange'=>'Orange (Default)', 'Blue'=>'Blue', 'Green'=>'Green', 'Custom'=>'Custom'),
                                    'description' => __('Choose a color scheme. Default color scheme is Orange. Choose "Custom" to choose your own colors below.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_color_body', array( 'default' => $vega_wp_defaults['vega_wp_color_body'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_color_body', array(
                                    'label' => __( 'Text/body Color', 'vega' ),
                                    'description' => __( 'Text color.', 'vega' ),
                                    'section'     => 'colors' ) ) );
    
    $wp_customize->add_setting( 'vega_wp_color_custom_1', array( 'default' => $vega_wp_defaults['vega_wp_color_custom_1'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_color_custom_1', array(
                                    'label' => __( 'Main Color', 'vega' ),
                                    'description' => __( 'Applied to most links, buttons.', 'vega' ),
                                    'section'     => 'colors' ) ) );
    
    $wp_customize->add_setting( 'vega_wp_color_custom_2', array( 'default' => $vega_wp_defaults['vega_wp_color_custom_2'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_color_custom_2', array(
                                    'label' => __( 'Hover Color', 'vega' ),
                                    'description' => __( 'Appears on hover for most elements.', 'vega' ),
                                    'section'     => 'colors' ) ) );
    
    $wp_customize->add_setting( 'vega_wp_font_1', array( 'default' => $vega_wp_defaults['vega_wp_font_1'], 'sanitize_callback' => 'vega_wp_sanitize_font' ) );
    $wp_customize->add_control( 'vega_wp_font_1', array( 
                                    'label' => __( 'Select Main Font', 'vega' ), 
                                    'section' => 'colors',
                                    'settings' => 'vega_wp_font_1', 
                                    'type' => 'select', 
                                    'choices' => vega_wp_google_fonts(),
                                    'description' => __('Choose a main body text font. Default is `Lato`.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_font_2', array( 'default' => $vega_wp_defaults['vega_wp_font_2'], 'sanitize_callback' => 'vega_wp_sanitize_font' ) );
    $wp_customize->add_control( 'vega_wp_font_2', array( 
                                    'label' => __( 'Select Secondary Font', 'vega' ), 
                                    'section' => 'colors',
                                    'settings' => 'vega_wp_font_2', 
                                    'type' => 'select', 
                                    'choices' => vega_wp_google_fonts(),
                                    'description' => __('Choose a font for headings, menu. Default is `Lato`.', 'vega') ) );
    
    /*** vega_wp_nav_section ***/
    
    $wp_customize->add_section( 'vega_wp_nav_section' , array( 'title' => __( 'Top Navigation', 'vega' ), 'priority' => 60, 'description' => '', ) );

    $wp_customize->add_setting( 'vega_wp_nav_styling', array( 'default' => $vega_wp_defaults['vega_wp_nav_styling'], 'sanitize_callback' => 'vega_wp_sanitize_radio_nav_styling' ) );
    $wp_customize->add_control( 'vega_wp_nav_styling', array( 
                                    'label' => __( 'Top Navigation Bar Styling', 'vega' ), 
                                    'section' => 'vega_wp_nav_section',
                                    'settings' => 'vega_wp_nav_styling', 
                                    'type' => 'radio', 
                                    'choices' => array('Default'=>'Default', 'Custom'=>'Custom'),
                                    'description' => __('Choose `Custom` to change the top nav bar styling.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_nav_color', array( 'default' => $vega_wp_defaults['vega_wp_nav_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_nav_color', array(
                                    'label' => __( 'Nav Bar Color', 'vega' ),
                                    'section'     => 'vega_wp_nav_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_nav_opacity', array( 'default' => $vega_wp_defaults['vega_wp_nav_opacity'], 'sanitize_callback' => 'vega_wp_sanitize_float' ) );
    $wp_customize->add_control( 'vega_wp_nav_opacity', array( 
                                    'label' => __( 'Nav Bar Opacity', 'vega' ), 
                                    'section' => 'vega_wp_nav_section',
                                    'settings' => 'vega_wp_nav_opacity', 
                                    'description' => __('Enter a floating point number to control the opacity of the bar.', 'vega'),
                                    'type' => 'text' ) );
    $wp_customize->add_setting( 'vega_wp_nav_position', array( 'default' => $vega_wp_defaults['vega_wp_nav_position'], 'sanitize_callback' => 'vega_wp_sanitize_radio_nav_position' ) );
    $wp_customize->add_control( 'vega_wp_nav_position', array( 
                                    'label' => __( 'Nav Bar Position', 'vega' ), 
                                    'section' => 'vega_wp_nav_section',
                                    'settings' => 'vega_wp_nav_position', 
                                    'type' => 'radio', 
                                    'description' => __('If `top left` or `top right` menus have been set, this setting will have no effect and the main navigation will always show above the banner/slideshow.', 'vega'),
                                    'choices' => array('Above'=>'Above the Banner/Slideshow', 'Top'=>'On Top of Banner/Slideshow') ) );                                
    $wp_customize->add_setting( 'vega_wp_nav_parent_node_enable', array( 'default' => $vega_wp_defaults['vega_wp_nav_parent_node_enable'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_nav_parent_node_enable', array( 
                                    'label' => __( 'Enable Parent Node', 'vega' ), 
                                    'section' => 'vega_wp_nav_section',
                                    'settings' => 'vega_wp_nav_parent_node_enable', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No (Default)', 'vega') ) ,
                                    'description' => 'If enabled,  parent nodes of dropdown menus in the main navigation bar will go to the designated URL on click. Default behavior is to not link the main node anywhere to facilitate usage on touch screens.') ); 
                                    
    /*** vega_wp_frontpage_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_section' , array( 'title' => __( 'Front Page', 'vega' ), 'priority' => 61, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_banner', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_banner'], 'sanitize_callback' => 'vega_wp_sanitize_radio_banner' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_banner', array( 
                                    'label' => __( 'Front Page Header', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_banner', 
                                    'type' => 'radio', 
                                    'choices' => array( 'Image Banner' => __('Image Banner (Default)', 'vega'), 
                                                        'Full Screen Image' => __('Full Screen Image', 'vega'), 
                                                        'Simple Banner' => __('As-is Simple Responsive Image Banner (No Parallax)', 'vega'),
                                                        'Video Banner' => __('Video Banner', 'vega'), 
                                                        'Full Screen Video' => __('Full Screen Video', 'vega'), 
                                                        'Image/Video Slideshow' => __('Image/Video Slideshow', 'vega'), 
                                                        'Full Screen Image/Video Slideshow' => __('Full Screen Image/Video Slideshow', 'vega'), ),
                                    'description' => __('Image Banner is shown by default. Go into `Front page - Banner` to set up the banner.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_content', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_content'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_content', array( 
                                    'label' => __( 'Show Main Content Area?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_content', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to display the page content area on front page - applies when the front page is set to display a static page under Settings->Reading. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark', array( 
                                    'label' => __( 'Show Call to Action Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_cta_dark', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to display the dark CTA section on the front page - applies when the front page is set to display a static page under Settings->Reading. Shown by default. Go into `Front Page - CTA Section` to set up this section.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark2'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark2', array( 
                                    'label' => __( 'Show Call to Action #2 Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_cta_dark2', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to display the second Call to Action section on the front page - applies when the front page is set to display a static page under Settings->Reading. Shown by default.', 'vega') ) );                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_4cols', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4cols'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4cols', array( 
                                    'label' => __( 'Show the 4 Icon Columns Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_4cols', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether to display the section containing 4 columns, each linking to a page - applies when the front page is set to display a static page under Settings->Reading. Shown by default. Go into `Front Page - Icon Columns` to set up this section.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_open1', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_open1'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_open1', array( 
                                    'label' => __( 'Show Open Content Area?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_open1', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether to display the open content section - applies when the front page is set to display a static page under Settings->Reading. You can enter HTML and/or shortcodes in this area. Shown by default. Go into `Front Page - Open Content` to set up this section.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_featured', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_featured'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_featured', array( 
                                    'label' => __( 'Show the Featured Pages Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_featured', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether to display the featured pages section - applies when the front page is set to display a static page under Settings->Reading. Shown by default. Go into `Front Page - Featured Pages` to set up this section.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_testimonials', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_testimonials'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_testimonials', array( 
                                    'label' => __( 'Show the Testimonials Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_testimonials', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether to display the testimonials section - applies when the front page is set to display a static page under Settings->Reading. Shown by default. Go into `Front Page - Testimonials` to set up this section.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_team', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team', array( 
                                    'label' => __( 'Show the Team Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_team', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether to display the team section - applies when the front page is set to display a static page under Settings->Reading. Shown by default. Go into `Front Page - Team` to set up this section.', 'vega') ) );    
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_logos', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_logos'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_logos', array( 
                                    'label' => __( 'Show the Logos Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_logos', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether to display the partners/clients/logo section - applies when the front page is set to display a static page under Settings->Reading. Shown by default. Go into `Front Page - Logos` to set up this section.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_latest_posts', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_latest_posts'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_latest_posts', array( 
                                    'label' => __( 'Show the Latest Posts Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_latest_posts', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether to display the latest blog posts - applies when the front page is set to display a static page under Settings->Reading. Shown by default. Go into `Front Page - Latest Posts` to set up this section.', 'vega') ) );
                                    
    /*** vega_wp_frontpage_positions_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_positions_section' , array( 'title' => __('&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Row Positions', 'vega' ), 'priority' => 62, 'description' => 'Enter numbers for each of these sections. The sections will be sorted from the lowest number to the highest.', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_content', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_content'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_content', array( 
                                    'label' => __( 'Main Content', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_content', 
                                    'type' => 'number' ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_cta_dark', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_cta_dark'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_cta_dark', array( 
                                    'label' => __( 'Call to Action (Dark)', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_cta_dark', 
                                    'type' => 'number' ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_position_cta_dark2', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_cta_dark2'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_cta_dark2', array( 
                                    'label' => __( 'Call to Action #2', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_cta_dark2', 
                                    'type' => 'number' ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_position_4cols', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_4cols'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_4cols', array( 
                                    'label' => __( 'Icon Columns', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_4cols', 
                                    'type' => 'number' ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_open1', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_open1'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_open1', array( 
                                    'label' => __( 'Open Content', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_open1', 
                                    'type' => 'number' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_featured', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_featured'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_featured', array( 
                                    'label' => __( 'Featured Pages', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_featured', 
                                    'type' => 'number' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_testimonials', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_testimonials'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_testimonials', array( 
                                    'label' => __( 'Testimonials', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_testimonials', 
                                    'type' => 'number' ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_team', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_team'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_team', array( 
                                    'label' => __( 'Team', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_team', 
                                    'type' => 'number' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_logos', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_logos'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_logos', array( 
                                    'label' => __( 'Logos/Partners', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_logos', 
                                    'type' => 'number' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_latest_posts', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_latest_posts'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_latest_posts', array( 
                                    'label' => __( 'Latest Posts', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_latest_posts', 
                                    'type' => 'number' ) );
                                    
    /*** vega_wp_frontpage_banner_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_banner_section' , array( 'title' => __( '&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Banner', 'vega' ), 'priority' => 63, 'description' => 'The settings in the `Frontpage` section will decide how the banner displays. <br /><br />If you chose an image or video banner, this is the place to select the image or video you want to display in the header. <br /><br />Please note: if you choose to display a video banner, you will need to specify a fallback image for touch/mobile devices - the video will not be displayed on mobile/touch devices. <br /><br />Also, if your settings here have no effect on the banner display, please make sure that the demo mode is disabled by setting `Enable Demo` to `No` under `General Setup`.', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_banner_image', array( 'sanitize_callback' => 'vega_wp_sanitize_url' ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_banner_image', array( 
                                    'label' => __( 'Upload Frontpage Banner', 'vega' ),
                                    'section'  => 'vega_wp_frontpage_banner_section', 
                                    'settings' => 'vega_wp_frontpage_banner_image',
                                    'description' => __('If not uploaded, the Header Image will be displayed (if available).', 'vega') ) ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_banner_video', array( 'sanitize_callback' => 'vega_wp_sanitize_url' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_banner_video', array( 
                                    'label' => 'Video Banner', 
                                    'section' => 'vega_wp_frontpage_banner_section',
                                    'type' => 'text', 
                                    'description' => __('Enter the absolute URL for the video banner file.', 'vega') ));
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_banner_video_fallback', array( 'sanitize_callback' => 'vega_wp_sanitize_url' ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_banner_video_fallback', array( 
                                    'label' => __( 'Upload Fallback Banner/Image', 'vega' ),
                                    'section'  => 'vega_wp_frontpage_banner_section', 
                                    'settings' => 'vega_wp_frontpage_banner_video_fallback',
                                    'description' => __('Must be specified if a video banner is chosen. This fallback image will show up in place of the video on touch and mobile devices.', 'vega') ) ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_banner_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_banner_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_banner_heading', array( 
                                    'label' => 'Banner Heading', 
                                    'section' => 'vega_wp_frontpage_banner_section',
                                    'type' => 'text', 
                                    'description' => __('Displayed as a heading on the frontpage banner image.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_banner_text', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_banner_text'], 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_banner_text', array( 
                                    'label' => 'Banner Text', 
                                    'section' => 'vega_wp_frontpage_banner_section',
                                    'type' => 'textarea', 
                                    'description' => __('Displayed under the main heading on the frontpage banner image. Accepts HTML.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_banner_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_banner_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_banner_bg_color', array(
                                    'label' => __( 'Background / Filter Color', 'vega' ),
                                    'description' => __( 'This color will be used as the overlay/filter. Leave this as blank to remove the filter.', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_banner_section' ) ) );
                                    
    /*** vega_wp_frontpage_slideshow_panel ***/
    
    $wp_customize->add_panel( 'vega_wp_frontpage_slideshow_panel', array( 'priority' => 64, 'capability' => 'edit_theme_options', 'theme_supports' => '', 'title' => '&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Slideshow', 'description'    => 'Select the images for your slideshow here. If any of the slides is a video, please also specify the image - it will serve as a fallback image to be displayed on touch/mobile devices.' ) );

    $wp_customize->add_section( 'vega_wp_frontpage_slideshow_section' , array( 'title' => __( 'General', 'vega' ), 'priority' => 65, 'description' => '', 'panel'=>'vega_wp_frontpage_slideshow_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_slideshow_n', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_slideshow_n'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_slideshow_n', array( 
                                    'label' => __( 'Number of Slides', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_slideshow_section',
                                    'settings' => 'vega_wp_frontpage_slideshow_n', 
                                    'type' => 'select',
                                    'choices' => array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', 
                                                       '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'),
                                    'description' => __('Default = 5.', 'vega') ) );
                                    
    #start loop for slides
    for($i=1;$i<=10;$i++) { 
    
    $wp_customize->add_section( 'vega_wp_frontpage_slideshow_slide_'.$i.'_section' , array( 'title' => __('Slide ' . $i, 'vega' ), 'priority' => 65, 'description' => '', 'panel'=>'vega_wp_frontpage_slideshow_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_slideshow_slide_'.$i.'_image', array( 'sanitize_callback' => 'vega_wp_sanitize_url' ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_slideshow_slide_'.$i.'_image', array( 
                                    'label' => __( 'Slide '.$i.' Image', 'vega' ),
                                    'section'  => 'vega_wp_frontpage_slideshow_slide_'.$i.'_section', 
                                    'settings' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_image',
                                    'description' => __('Slide image. Will serve as fallback image if a video is specified in the next field.', 'vega') ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_slideshow_slide_'.$i.'_video', array( 'sanitize_callback' => 'vega_wp_sanitize_url' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_slideshow_slide_'.$i.'_video', array( 
                                    'label' => 'Slide '.$i.' Video', 
                                    'section' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Slide video.', 'vega') ));

    $wp_customize->add_setting( 'vega_wp_frontpage_slideshow_slide_'.$i.'_heading', array('sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_slideshow_slide_'.$i.'_heading', array( 
                                    'label' => 'Slide '.$i.' Heading', 
                                    'section' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Slide main heading.', 'vega') ));
    
    $wp_customize->add_setting( 'vega_wp_frontpage_slideshow_slide_'.$i.'_text', array( 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_slideshow_slide_'.$i.'_text', array( 
                                    'label' => 'Slide '.$i.' Text', 
                                    'section' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_section',
                                    'type' => 'textarea', 
                                    'description' => __('Displayed under the main heading on the slide. Accepts HTML.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_slideshow_slide_'.$i.'_button_label', array('sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_slideshow_slide_'.$i.'_button_label', array( 
                                    'label' => 'Slide '.$i.' Button Label', 
                                    'section' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Slide button label.', 'vega') ));
    
    $wp_customize->add_setting( 'vega_wp_frontpage_slideshow_slide_'.$i.'_button_url', array('sanitize_callback' => 'vega_wp_sanitize_url' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_slideshow_slide_'.$i.'_button_url', array( 
                                    'label' => 'Slide '.$i.' Button Link/URL', 
                                    'section' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Link for the slide button.', 'vega') ));
    
    $wp_customize->add_setting( 'vega_wp_frontpage_slideshow_slide_'.$i.'_align', array('sanitize_callback' => 'vega_wp_sanitize_alignment' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_slideshow_slide_'.$i.'_align', array( 
                                    'label' => __( 'Slide '.$i.' Caption Alignment', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_section',
                                    'settings' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_align', 
                                    'type' => 'select', 
                                    'choices' => array('left'=>'Left', 'right'=>'Right', 'center'=>'Center'),
                                    'description' => __('Alignment for the slide heading, text, and button.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_slideshow_slide_'.$i.'_heading_animate_css', array( 'sanitize_callback' => 'vega_wp_sanitize_animate_css' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_slideshow_slide_'.$i.'_heading_animate_css', array( 
                                    'label' => __( 'Slide '.$i.' Heading Animation', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_section',
                                    'settings' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_heading_animate_css', 
                                    'type' => 'select', 
                                    'choices' => vega_wp_animate_css(),
                                    'description' => __('The animate.css class for the slide heading.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_slideshow_slide_'.$i.'_text_animate_css', array( 'sanitize_callback' => 'vega_wp_sanitize_animate_css' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_slideshow_slide_'.$i.'_text_animate_css', array( 
                                    'label' => __( 'Slide '.$i.' Text Animation', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_section',
                                    'settings' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_text_animate_css', 
                                    'type' => 'select', 
                                    'choices' => vega_wp_animate_css(),
                                    'description' => __('The animate.css class for the slide text.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_slideshow_slide_'.$i.'_button_animate_css', array( 'sanitize_callback' => 'vega_wp_sanitize_animate_css' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_slideshow_slide_'.$i.'_button_animate_css', array( 
                                    'label' => __( 'Slide '.$i.' Button Animation', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_section',
                                    'settings' => 'vega_wp_frontpage_slideshow_slide_'.$i.'_button_animate_css', 
                                    'type' => 'select', 
                                    'choices' => vega_wp_animate_css(),
                                    'description' => __('The animate.css class for the slide button.', 'vega') ) );
    
    } #end loop for slides
    
    /*** vega_wp_frontpage_cta_dark_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_cta_dark_section' , array( 'title' => __( '&nbsp;&nbsp;&nbsp;&nbsp; Front Page - CTA Section', 'vega' ), 'priority' => 66, 'description' => '', ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark_content', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark_content'], 'sanitize_callback' => 'vega_wp_sanitize_page' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark_content', array( 
                                    'label' => 'CTA Section Content', 
                                    'section' => 'vega_wp_frontpage_cta_dark_section',
                                    'type' => 'dropdown-pages', 
                                    'allow_addition' => true,
                                    'description' => __('Select the page where you have entered the text to display on the frontpage call to action section.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark_parallax', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark_parallax'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark_parallax', array( 
                                    'label' => __( 'Enable Parallax?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_cta_dark_section',
                                    'settings' => 'vega_wp_frontpage_cta_dark_parallax', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Turn this on to show an image in the background of this section with the parallax effect. Requires an image to be uploaded in the next setting.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark_bg_image', array( 'default'=>$vega_wp_defaults['vega_wp_frontpage_cta_dark_bg_image'], 'sanitize_callback' => 'vega_wp_sanitize_url' ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_cta_dark_bg_image', array( 
                                    'label' => __( 'Background Image', 'vega' ),
                                    'section'  => 'vega_wp_frontpage_cta_dark_section', 
                                    'settings' => 'vega_wp_frontpage_cta_dark_bg_image',
                                    'description' => __('Background image for this section.', 'vega') ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_cta_dark_bg_color', array(
                                    'label' => __( 'Background / Filter Color', 'vega' ),
                                    'description' => __( 'If no background image is provided, this background color will be used for the CTA. If a background image is provided, then this color will be used as the overlay/filter. Leave this as blank to remove the filter.', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_cta_dark_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark_section_id', array( 
                                    'label' => 'Section ID', 
                                    'section' => 'vega_wp_frontpage_cta_dark_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
                                    
    /*** vega_wp_frontpage_cta_dark2_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_cta_dark2_section' , array( 'title' => __( '&nbsp;&nbsp;&nbsp;&nbsp; Frontpage - CTA Section #2', 'vega' ), 'priority' => 66, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2_content', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark2_content'], 'sanitize_callback' => 'vega_wp_sanitize_page' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark2_content', array( 
                                    'label' => 'CTA Section Content', 
                                    'section' => 'vega_wp_frontpage_cta_dark2_section',
                                    'type' => 'dropdown-pages', 
                                    'allow_addition' => true,
                                    'description' => __('Select the page where you have entered the text to display on the frontpage call to action section.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2_parallax', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark2_parallax'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark2_parallax', array( 
                                    'label' => __( 'Enable Parallax?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_cta_dark2_section',
                                    'settings' => 'vega_wp_frontpage_cta_dark2_parallax', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Turn this on to show an image in the background of this section with the parallax effect. Requires an image to be uploaded in the next setting.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2_bg_image', array( 'default'=>$vega_wp_defaults['vega_wp_frontpage_cta_dark_bg_image'], 'sanitize_callback' => 'vega_wp_sanitize_url' ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_cta_dark2_bg_image', array( 
                                    'label' => __( 'Background Image', 'vega' ),
                                    'section'  => 'vega_wp_frontpage_cta_dark2_section', 
                                    'settings' => 'vega_wp_frontpage_cta_dark2_bg_image',
                                    'description' => __('Background image for this section.', 'vega') ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark2_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_cta_dark2_bg_color', array(
                                    'label' => __( 'Background / Filter Color', 'vega' ),
                                    'description' => __( 'If no background image is provided, this background color will be used for the CTA. If a background image is provided, then this color will be used as the overlay/filter. Leave this as blank to remove the filter.', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_cta_dark2_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark2_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark2_section_id', array( 
                                    'label' => 'Section ID', 
                                    'section' => 'vega_wp_frontpage_cta_dark2_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));

    /*** vega_wp_frontpage_4_cols_panel ***/

    $wp_customize->add_panel( 'vega_wp_frontpage_4_cols_panel', array( 'priority' => 67, 'capability' => 'edit_theme_options', 'theme_supports' => '', 'title' => '&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Icon Columns', 'description' => '' ) );
    
    $wp_customize->add_section( 'vega_wp_frontpage_4_cols_section' , array( 'title' => __( 'General', 'vega' ), 'priority' => 68, 'description' => '', 'panel'=>'vega_wp_frontpage_4_cols_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_4cols_n', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4cols_n'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4cols_n', array( 
                                    'label' => __( 'Number of Columns', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_4_cols_section',
                                    'settings' => 'vega_wp_frontpage_4cols_n', 
                                    'type' => 'select',
                                    'choices' => array('1'=>'1', '2'=>'2','3'=>'3','4'=>'4'),
                                    'description' => __('Default = 4.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_heading', array( 
                                    'label' => 'Heading', 
                                    'section' => 'vega_wp_frontpage_4_cols_section',
                                    'type' => 'text', 
                                    'description' => __('Heading to be displayed for this section.', 'vega') ));
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_text', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_text'], 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_text', array( 
                                    'label' => 'Text/Description', 
                                    'section' => 'vega_wp_frontpage_4_cols_section',
                                    'type' => 'textarea', 
                                    'description' => __('Text to be displayed under the heading. Accepts HTML.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_read_more', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_read_more'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_read_more', array( 
                                    'label' => __('`Read More` Label', 'vega'), 
                                    'section' => 'vega_wp_frontpage_4_cols_section',
                                    'type' => 'text', 
                                    'description' => __('The label for the `Read More` button. Leave blank to hide button.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_4_cols_bg_color', array(
                                    'label' => __( 'Background Color', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_4_cols_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_section_id', array( 
                                    'label' => 'Section ID', 
                                    'section' => 'vega_wp_frontpage_4_cols_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
                                    
    #start loop for icons
    for($i=1;$i<=4;$i++) { 
    $wp_customize->add_section( 'vega_wp_frontpage_4_cols_col_'.$i.'_section' , array( 'title' => __( 'Icon Column ' . $i, 'vega' ), 'priority' => 69, 'description' => '', 'panel'=>'vega_wp_frontpage_4_cols_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_'.$i.'_icon', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_'.$i.'_icon'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_'.$i.'_icon', array( 
                                    'label' => 'Column '.$i.' Icon', 
                                    'section' => 'vega_wp_frontpage_4_cols_col_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Icon for column '.$i.'. See http://fontawesome.io/icons/ for full list of supported icons.', 'vega') ));

    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_'.$i, array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_'.$i], 'sanitize_callback' => 'vega_wp_sanitize_page' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_'.$i, array( 
                                    'label' => 'Column '.$i.' Page', 
                                    'section' => 'vega_wp_frontpage_4_cols_col_'.$i.'_section',
                                    'type' => 'dropdown-pages', 
                                    'allow_addition' => true,
                                    'description' => __('Select the page for the column '.$i.'.', 'vega') ));
    } #end loop for columns
    
    /*** vega_wp_frontpage_open1_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_open1_section' , array( 'title' => __( '&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Open Content', 'vega' ), 'priority' => 70, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_open1_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_open1_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_open1_heading', array( 
                                    'label' => 'Section Heading', 
                                    'section' => 'vega_wp_frontpage_open1_section',
                                    'type' => 'text', 
                                    'description' => __('Heading to display for this section.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_open1_content', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_open1_content'], 'sanitize_callback' => 'vega_wp_sanitize_page' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_open1_content', array( 
                                    'label' => 'Section Content', 
                                    'section' => 'vega_wp_frontpage_open1_section',
                                    'type' => 'dropdown-pages', 
                                    'allow_addition' => true,
                                    'description' => __('Select the page where you have entered the text to display on the frontpage open content section. ', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_open1_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_open1_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_open1_bg_color', array(
                                    'label' => __( 'Background Color', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_open1_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_open1_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_open1_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_open1_section_id', array( 
                                    'label' => 'Section ID', 
                                    'section' => 'vega_wp_frontpage_open1_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
                                    
    /*** vega_wp_frontpage_featured_pages_panel ***/

    $wp_customize->add_panel( 'vega_wp_frontpage_featured_pages_panel', array( 'priority' => 71, 'capability' => 'edit_theme_options', 'theme_supports' => '', 'title' => '&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Featured Pages', 'description' => '' ) );
    
    $wp_customize->add_section( 'vega_wp_frontpage_featured_pages_section' , array( 'title' => __( 'General', 'vega' ), 'priority' => 72, 'description' => '', 'panel'=>'vega_wp_frontpage_featured_pages_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_featured_pages_n', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_featured_pages_n'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_featured_pages_n', array( 
                                    'label' => __( 'Number of Featured Pages', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_featured_pages_section',
                                    'settings' => 'vega_wp_frontpage_featured_pages_n', 
                                    'type' => 'select',
                                    'choices' => array('1'=>'1', '2'=>'2','3'=>'3','4'=>'4'),
                                    'description' => __('Default = 3.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_featured_pages_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_featured_pages_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_featured_pages_heading', array( 
                                    'label' => 'Heading', 
                                    'section' => 'vega_wp_frontpage_featured_pages_section',
                                    'type' => 'text', 
                                    'description' => __('Heading to be displayed for the featured pages section.', 'vega') ));
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_featured_pages_text', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_featured_pages_text'], 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_featured_pages_text', array( 
                                    'label' => 'Text/Description', 
                                    'section' => 'vega_wp_frontpage_featured_pages_section',
                                    'type' => 'textarea', 
                                    'description' => __('Text to be displayed under the heading. Accepts HTML.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_featured_pages_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_featured_pages_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_featured_pages_bg_color', array(
                                    'label' => __( 'Background Color', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_featured_pages_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_featured_pages_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_featured_pages_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_featured_pages_section_id', array( 
                                    'label' => 'Section ID', 
                                    'section' => 'vega_wp_frontpage_featured_pages_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
                                    
    #start loop for pages
    for($i=1;$i<=4;$i++) { 
    $wp_customize->add_section( 'vega_wp_frontpage_featured_pages_page_'.$i.'_section' , array( 'title' => __( 'Featured Page ' . $i, 'vega' ), 'priority' => 73, 'description' => '', 'panel'=>'vega_wp_frontpage_featured_pages_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_featured_pages_page_'.$i.'_image', array( 'default'=>$vega_wp_defaults['vega_wp_featured_pages'][$i-1], 'sanitize_callback' => 'vega_wp_sanitize_url' ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_featured_pages_page_'.$i.'_image', array( 
                                    'label' => __( 'Page '.$i.' Image', 'vega' ),
                                    'section'  => 'vega_wp_frontpage_featured_pages_page_'.$i.'_section', 
                                    'settings' => 'vega_wp_frontpage_featured_pages_page_'.$i.'_image',
                                    'description' => __('Page/column image.', 'vega') ) ) );

    $wp_customize->add_setting( 'vega_wp_frontpage_featured_pages_page_'.$i.'_url', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_featured_pages_page_'.$i.'_url'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_featured_pages_page_'.$i.'_url', array( 
                                    'label' => 'Page '.$i.' URL', 
                                    'section' => 'vega_wp_frontpage_featured_pages_page_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Enter URL you want to link the page to. Leave blank if you do not wish to link it.', 'vega') ));
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_featured_pages_page_'.$i.'_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_featured_pages_page_'.$i.'_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_featured_pages_page_'.$i.'_heading', array( 
                                    'label' => 'Page '.$i.' Heading', 
                                    'section' => 'vega_wp_frontpage_featured_pages_page_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Enter the heading for this page.', 'vega') ));
    
    $wp_customize->add_setting( 'vega_wp_frontpage_featured_pages_page_'.$i.'_text', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_featured_pages_page_'.$i.'_text'], 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_featured_pages_page_'.$i.'_text', array( 
                                    'label' => 'Page '.$i.' Text/Description', 
                                    'section' => 'vega_wp_frontpage_featured_pages_page_'.$i.'_section',
                                    'type' => 'textarea', 
                                    'description' => __('Enter the text/description to show under the heading for this page. Accepts HTML.', 'vega') ));
    } #end loop for featured pages
    
    /*** vega_wp_frontpage_testimonials_panel ***/
    
    $wp_customize->add_panel( 'vega_wp_frontpage_testimonials_panel', array( 'priority' => 74, 'capability' => 'edit_theme_options', 'theme_supports' => '', 'title' => '&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Testimonials', 'description'    => '' ) );
    
    $wp_customize->add_section( 'vega_wp_frontpage_testimonials_section' , array( 'title' => __( 'General', 'vega' ), 'priority' => 75, 'description' => '', 'panel'=>'vega_wp_frontpage_testimonials_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_testimonials_n', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_testimonials_n'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_testimonials_n', array( 
                                    'label' => __( 'Number of Testimonials', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_testimonials_section',
                                    'settings' => 'vega_wp_frontpage_testimonials_n', 
                                    'type' => 'select',
                                    'choices' => array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5',
                                                       '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'),
                                    'description' => __('Default = 5.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_testimonials_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_testimonials_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_testimonials_heading', array( 
                                    'label' => __( 'Heading', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_testimonials_section',
                                    'settings' => 'vega_wp_frontpage_testimonials_heading', 
                                    'type' => 'text',
                                    'description' => __('Heading to be displayed for the testimonials section.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_testimonials_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_testimonials_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_testimonials_bg_color', array(
                                    'label' => __( 'Background Color', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_testimonials_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_testimonials_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_testimonials_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_testimonials_section_id', array( 
                                    'label' => 'Section ID', 
                                    'section' => 'vega_wp_frontpage_testimonials_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
    #start loop for testimonials
    for($i=1;$i<=10;$i++) { 
    
    $wp_customize->add_section( 'vega_wp_frontpage_testimonial_'.$i.'_section' , array( 'title' => __('Testimonial ' . $i, 'vega' ), 'priority' => 75, 'description' => '', 'panel'=>'vega_wp_frontpage_testimonials_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_testimonial_'.$i.'_image', array( 'sanitize_callback' => 'vega_wp_sanitize_url', 'default'=>$vega_wp_defaults['vega_wp_testimonials'][$i-1] ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_testimonial_'.$i.'_image', array( 
                                    'label' => __( 'Testimonial '.$i.' Image', 'vega' ),
                                    'section'  => 'vega_wp_frontpage_testimonial_'.$i.'_section', 
                                    'settings' => 'vega_wp_frontpage_testimonial_'.$i.'_image',
                                    'description' => __('Testimonial image. Recommended size 165x165.', 'vega') ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_testimonial_'.$i.'_company', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_testimonial_'.$i.'_company'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_testimonial_'.$i.'_company', array( 
                                    'label' => 'Testimonial '.$i.' Company Name', 
                                    'section' => 'vega_wp_frontpage_testimonial_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Testimonial company name.', 'vega') ));
    
    $wp_customize->add_setting( 'vega_wp_frontpage_testimonial_'.$i.'_client', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_testimonial_'.$i.'_client'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_testimonial_'.$i.'_client', array( 
                                    'label' => 'Testimonial '.$i.' Client Name', 
                                    'section' => 'vega_wp_frontpage_testimonial_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Testimonial client name.', 'vega') ));
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_testimonial_'.$i.'_text', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_testimonial_'.$i.'_text'], 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_testimonial_'.$i.'_text', array( 
                                    'label' => 'Testimonial '.$i.' Content/Text', 
                                    'section' => 'vega_wp_frontpage_testimonial_'.$i.'_section',
                                    'type' => 'textarea', 
                                    'description' => __('Testimonial content/text.', 'vega') ));
    } #end loop for testimonials
    
    
    /*** vega_wp_frontpage_team_panel ***/

    $wp_customize->add_panel( 'vega_wp_frontpage_team_panel', array( 'priority' => 76, 'capability' => 'edit_theme_options', 'theme_supports' => '', 'title' => '&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Team', 'description' => '' ) );
    
    $wp_customize->add_section( 'vega_wp_frontpage_team_section' , array( 'title' => __( 'General', 'vega' ), 'priority' => 77, 'description' => '', 'panel'=>'vega_wp_frontpage_team_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_team_n', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_n'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team_n', array( 
                                    'label' => __( 'Number of Team Members', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_team_section',
                                    'settings' => 'vega_wp_frontpage_team_n', 
                                    'type' => 'select',
                                    'choices' => array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5',
                                                       '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'),
                                    'description' => __('Default = 4.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_team_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team_heading', array( 
                                    'label' => 'Heading', 
                                    'section' => 'vega_wp_frontpage_team_section',
                                    'type' => 'text', 
                                    'description' => __('Heading to be displayed for the team section.', 'vega') ));
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_team_text', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_text'], 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team_text', array( 
                                    'label' => 'Text/Description', 
                                    'section' => 'vega_wp_frontpage_team_section',
                                    'type' => 'textarea', 
                                    'description' => __('Text to be displayed under the heading. Accepts HTML.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_team_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_team_bg_color', array(
                                    'label' => __( 'Background Color', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_team_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_team_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team_section_id', array( 
                                    'label' => 'Section ID', 
                                    'section' => 'vega_wp_frontpage_team_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
                                    
    #start loop for team
    for($i=1;$i<=10;$i++) { 
    $wp_customize->add_section( 'vega_wp_frontpage_team_member_'.$i.'_section' , array( 'title' => __( 'Team Member ' . $i, 'vega' ), 'priority' => 78, 'description' => '', 'panel'=>'vega_wp_frontpage_team_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_team_member_'.$i.'_image', array( 'sanitize_callback' => 'vega_wp_sanitize_url', 'default'=>$vega_wp_defaults['vega_wp_team_member'][$i-1] ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_team_member_'.$i.'_image', array( 
                                    'label' => __( 'Team Member '.$i, 'vega' ),
                                    'section'  => 'vega_wp_frontpage_team_member_'.$i.'_section', 
                                    'settings' => 'vega_wp_frontpage_team_member_'.$i.'_image',
                                    'description' => __('Team member photo.', 'vega') ) ) );

    $wp_customize->add_setting( 'vega_wp_frontpage_team_member_'.$i.'_name', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_member_'.$i.'_name'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team_member_'.$i.'_name', array( 
                                    'label' => 'Team Member '.$i.' Name', 
                                    'section' => 'vega_wp_frontpage_team_member_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Enter the team member\'s name.', 'vega') ));
    
    $wp_customize->add_setting( 'vega_wp_frontpage_team_member_'.$i.'_position', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_member_'.$i.'_position'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team_member_'.$i.'_position', array( 
                                    'label' => 'Team Member '.$i.' Position', 
                                    'section' => 'vega_wp_frontpage_team_member_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Enter the team member\'s position.', 'vega') ));
    
    $wp_customize->add_setting( 'vega_wp_frontpage_team_member_'.$i.'_url', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_member_'.$i.'_url'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team_member_'.$i.'_url', array( 
                                    'label' => 'Team Member '.$i.' URL', 
                                    'section' => 'vega_wp_frontpage_team_member_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Enter URL you want to link the team member to. Leave blank if you do not wish to link the team member.', 'vega') ));
    
    $wp_customize->add_setting( 'vega_wp_frontpage_team_member_'.$i.'_social_link_1', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_member_'.$i.'_social_link_1'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team_member_'.$i.'_social_link_1', array( 
                                    'label' => 'Team Member '.$i.' Social Media Link 1', 
                                    'section' => 'vega_wp_frontpage_team_member_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Enter the social media link for this team member, for example Facebook page, Twitter URL, LinkedIn page, etc.', 'vega') ));
    
    $wp_customize->add_setting( 'vega_wp_frontpage_team_member_'.$i.'_social_link_1_icon', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_member_'.$i.'_social_link_1_icon'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team_member_'.$i.'_social_link_1_icon', array( 
                                    'label' => 'Team Member '.$i.' Social Media Link Icon 1', 
                                    'section' => 'vega_wp_frontpage_team_member_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Enter the icon to display for this social media link. See http://fontawesome.io/icons/ for full list of supported icons.', 'vega') ));
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_team_member_'.$i.'_social_link_2', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_member_'.$i.'_social_link_2'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team_member_'.$i.'_social_link_2', array( 
                                    'label' => 'Team Member '.$i.' Social Media Link 2', 
                                    'section' => 'vega_wp_frontpage_team_member_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Enter another social media link for this team member, for example Facebook page, Twitter URL, LinkedIn page, etc.', 'vega') ));
    
    $wp_customize->add_setting( 'vega_wp_frontpage_team_member_'.$i.'_social_link_2_icon', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_team_member_'.$i.'_social_link_2_icon'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_team_member_'.$i.'_social_link_2_icon', array( 
                                    'label' => 'Team Member '.$i.' Social Media Link Icon 2', 
                                    'section' => 'vega_wp_frontpage_team_member_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Enter the icon to display for this social media link. See http://fontawesome.io/icons/ for full list of supported icons.', 'vega') ));
    }
    
    /*** vega_wp_frontpage_logos_panel ***/

    $wp_customize->add_panel( 'vega_wp_frontpage_logos_panel', array( 'priority' => 79, 'capability' => 'edit_theme_options', 'theme_supports' => '', 'title' => '&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Logos', 'description' => '' ) );
    
    $wp_customize->add_section( 'vega_wp_frontpage_logos_section' , array( 'title' => __( 'General', 'vega' ), 'priority' => 80, 'description' => '', 'panel'=>'vega_wp_frontpage_logos_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_logos_n', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_logos_n'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_logos_n', array( 
                                    'label' => __( 'Number of Logos', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_logos_section',
                                    'settings' => 'vega_wp_frontpage_logos_n', 
                                    'type' => 'select',
                                    'choices' => array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5',
                                                       '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'),
                                    'description' => __('Default = 6.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_logos_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_logos_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_logos_heading', array( 
                                    'label' => 'Heading', 
                                    'section' => 'vega_wp_frontpage_logos_section',
                                    'type' => 'text', 
                                    'description' => __('Heading to be displayed for the logos/partners section.', 'vega') ));
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_logos_text', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_logos_text'], 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_logos_text', array( 
                                    'label' => 'Text/Description', 
                                    'section' => 'vega_wp_frontpage_logos_section',
                                    'type' => 'textarea', 
                                    'description' => __('Text to be displayed under the heading. Accepts HTML.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_logos_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_logos_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_logos_bg_color', array(
                                    'label' => __( 'Background Color', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_logos_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_logos_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_logos_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_logos_section_id', array( 
                                    'label' => 'Section ID', 
                                    'section' => 'vega_wp_frontpage_logos_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
    #start loop for logos
    for($i=1;$i<=10;$i++) { 
    $wp_customize->add_section( 'vega_wp_frontpage_logos_logo_'.$i.'_section' , array( 'title' => __( 'Logo ' . $i, 'vega' ), 'priority' => 81, 'description' => '', 'panel'=>'vega_wp_frontpage_logos_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_logo_'.$i.'_image', array( 'sanitize_callback' => 'vega_wp_sanitize_url', 'default'=>$vega_wp_defaults['vega_wp_logo'][$i-1] ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_logo_'.$i.'_image', array( 
                                    'label' => __( 'Logo '.$i.' Image', 'vega' ),
                                    'section'  => 'vega_wp_frontpage_logos_logo_'.$i.'_section', 
                                    'settings' => 'vega_wp_frontpage_logo_'.$i.'_image',
                                    'description' => __('Logo image.', 'vega') ) ) );

    $wp_customize->add_setting( 'vega_wp_frontpage_logo_'.$i.'_url', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_logo_'.$i.'_url'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_logo_'.$i.'_url', array( 
                                    'label' => 'Logo '.$i.' URL', 
                                    'section' => 'vega_wp_frontpage_logos_logo_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Enter URL you want to link the logo to. Leave blank if you do not wish to link the logo.', 'vega') ));
    } #end loop for logos
    
    /*** vega_wp_frontpage_latest_posts_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_latest_posts_section' , array( 'title' => __( '&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Latest Posts', 'vega' ), 'priority' => 82, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_latest_posts_n', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_latest_posts_n'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_latest_posts_n', array( 
                                    'label' => __( 'Number of Posts', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_latest_posts_section',
                                    'settings' => 'vega_wp_frontpage_latest_posts_n', 
                                    'type' => 'select',
                                    'choices' => array('1'=>'1', '2'=>'2','3'=>'3'),
                                    'description' => __('Default = 3.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_latest_posts_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_latest_posts_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_latest_posts_heading', array( 
                                    'label' => 'Heading', 
                                    'section' => 'vega_wp_frontpage_latest_posts_section',
                                    'type' => 'text', 
                                    'description' => __('Heading to display for section.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_latest_posts_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_latest_posts_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_latest_posts_bg_color', array(
                                    'label' => __( 'Background Color', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_latest_posts_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_latest_posts_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_latest_posts_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_latest_posts_section_id', array( 
                                    'label' => 'Section ID', 
                                    'section' => 'vega_wp_frontpage_latest_posts_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
    
    
    
    /*** vega_wp_blog_feed_section ***/
    
    $wp_customize->add_section( 'vega_wp_blog_feed_section' , array( 'title' => __( 'Blog Feed', 'vega' ), 'priority' => 83, 'description' => '', ) );

    $wp_customize->add_setting( 'vega_wp_blog_feed_meta', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_meta'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_meta', array( 
                                    'label' => __( 'Show Meta Information?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_meta', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to show the date, author, and category for each post in the blog feed. Shown by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_blog_feed_meta_date', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_meta_date'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_meta_date', array( 
                                    'label' => __( 'Show Date?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_meta_date', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to show the date for each post in the blog feed. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_blog_feed_meta_category', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_meta_category'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_meta_category', array( 
                                    'label' => __( 'Show Category?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_meta_category', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to show the category for each post in the blog feed. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_blog_feed_meta_author', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_meta_author'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_meta_author', array( 
                                    'label' => __( 'Show Author?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_meta_author', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to show the author for each post in the blog feed. Hidden by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_blog_feed_sidebar', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_sidebar'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_sidebar', array( 
                                    'label' => __( 'Show Sidebar?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_sidebar', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Sidebar is shown by default. If the sidebar is hidden, then the blog will be shown in a two-column layout.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_blog_feed_display', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_display'], 'sanitize_callback' => 'vega_wp_sanitize_radio_blog_feed_display' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_display', array( 
                                    'label' => __( 'Select Post Display Format', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_display', 
                                    'type' => 'radio', 
                                    'choices' => array('Small Image Left, Excerpt Right'=>'Small Image Left, Excerpt Right', 'Large Image Top, Full Content Below'=>'Large Image Top, Full Content Below', 'No Image, Excerpt'=>'No Image, Excerpt'),
                                    'description' => __('Choose how you want to display each post in the blog feed. `Small Image Left, Excerpt Right` by default. This setting only applies when `Show Sidebar?` is set to `Yes` above.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_blog_feed_banner', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_banner'], 'sanitize_callback' => 'vega_wp_sanitize_radio_banner' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_banner', array( 
                                    'label' => __( 'Blog Feed Banner', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_banner', 
                                    'type' => 'radio', 
                                    'choices' => array('Custom Header'=>'Custom Header', 'None'=>'None'),
                                    'description' => __('The Custom Header can be set from the `Header Image` section. Custom Header is shown as the banner by default.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_blog_feed_animations', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_animations'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_animations', array( 
                                    'label' => __( 'Enable Animations?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_animations', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Whether or not to enable animations for the blog page. Requires that the animations be turned on in the `General Setup` section. By default, animations are enabled.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_blog_feed_buttons', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_buttons'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_buttons', array( 
                                    'label' => __( 'Show Post Buttons?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_buttons', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Select No to hide the `Read More`, `Comments` buttons for posts. Shown by default.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_blog_feed_readmore_text', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_readmore_text'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_readmore_text', array( 
                                    'label' => __('`Read Me` Button Label', 'vega'), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'type' => 'text', 
                                    'description' => __('The words to show on the `Read More` button for posts.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_blog_feed_comment_text', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_comment_text'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_comment_text', array( 
                                    'label' => __('`Comment` Button Label', 'vega'), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'type' => 'text', 
                                    'description' => __('The words to show on the `Comment` (singular) button for posts.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_blog_feed_comments_text', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_comments_text'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_comments_text', array( 
                                    'label' => __('`Comments` Button Label', 'vega'), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'type' => 'text', 
                                    'description' => __('The words to show on the `Comments` (plural) button for posts.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_blog_feed_nocomments_text', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_nocomments_text'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_nocomments_text', array( 
                                    'label' => __('`Leave Comment` Button Label', 'vega'), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'type' => 'text', 
                                    'description' => __('The words to show on the `Leave Comment` (when there are no comments) button for posts.', 'vega') ));
    
    /*** vega_wp_post_section ***/
    
    $wp_customize->add_section( 'vega_wp_post_section' , array( 'title' => __( 'Blog Post', 'vega' ), 'priority' => 84, 'description' => '', ) );

    $wp_customize->add_setting( 'vega_wp_post_title', array( 'default' => $vega_wp_defaults['vega_wp_post_title'], 'sanitize_callback' => 'vega_wp_sanitize_radio_post_page_titles' ) );
    $wp_customize->add_control( 'vega_wp_post_title', array( 
                                    'label' => __( 'Heading/Title Location:', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_title', 
                                    'type' => 'radio', 
                                    'choices' => array('Both'=>__('Inside Banner + Above Content (Default)', 'vega'), 'Banner'=>__('Just Inside Banner', 'vega'), 'Content'=>__('Just Above Content', 'vega')),
                                    'description' => __('Choose where you want to show the post title.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_post_meta', array( 'default' => $vega_wp_defaults['vega_wp_post_meta'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_meta', array( 
                                    'label' => __( 'Show Meta Information?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_meta', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to show the date, author, and category on the posts page. Shown by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_post_meta_date', array( 'default' => $vega_wp_defaults['vega_wp_post_meta_date'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_meta_date', array( 
                                    'label' => __( 'Show Date?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_meta_date', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to show the date on the post page. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_post_meta_category', array( 'default' => $vega_wp_defaults['vega_wp_post_meta_category'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_meta_category', array( 
                                    'label' => __( 'Show Category?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_meta_category', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to show the category on the post page. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_post_meta_author', array( 'default' => $vega_wp_defaults['vega_wp_post_meta_author'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_meta_author', array( 
                                    'label' => __( 'Show Author?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_meta_author', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to show the author on the post page. Hidden by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_post_tags', array( 'default' => $vega_wp_defaults['vega_wp_post_tags'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_tags', array( 
                                    'label' => __( 'Show Tags?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_tags', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Choose whether you want to show the tags on the post page. Hidden by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_post_banner', array( 'default' => $vega_wp_defaults['vega_wp_post_banner'], 'sanitize_callback' => 'vega_wp_sanitize_radio_banner' ) );
    $wp_customize->add_control( 'vega_wp_post_banner', array( 
                                    'label' => __( 'Post Banner', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_banner', 
                                    'type' => 'radio', 
                                    'choices' => array('Custom Header'=>'Custom Header', 'Featured Image'=>'Featured Image', 'None'=>'None'),
                                    'description' => __('The Custom Header can be set from the `Header Image` section. Custom Header is shown as the banner by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_post_sidebar', array( 'default' => $vega_wp_defaults['vega_wp_post_sidebar'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_sidebar', array( 
                                    'label' => __( 'Show Sidebar?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_sidebar', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Sidebar is shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_post_featured_image', array( 'default' => $vega_wp_defaults['vega_wp_post_featured_image'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_featured_image', array( 
                                    'label' => __( 'Show Featured Image?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_featured_image', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Whether to show the featured image at the beginning of the post.', 'vega') ) );

    /*** vega_wp_page_section ***/
    
    $wp_customize->add_section( 'vega_wp_page_section' , array( 'title' => __( 'Pages', 'vega' ), 'priority' => 85, 'description' => '', ) );

    $wp_customize->add_setting( 'vega_wp_page_title', array( 'default' => $vega_wp_defaults['vega_wp_page_title'], 'sanitize_callback' => 'vega_wp_sanitize_radio_post_page_titles' ) );
    $wp_customize->add_control( 'vega_wp_page_title', array( 
                                    'label' => __( 'Heading/Title Location:', 'vega' ), 
                                    'section' => 'vega_wp_page_section',
                                    'settings' => 'vega_wp_page_title', 
                                    'type' => 'radio', 
                                    'choices' => array('Both'=>__('Inside Banner + Above Content (Default)', 'vega'), 'Banner'=>__('Just Inside Banner', 'vega'), 'Content'=>__('Just Above Content', 'vega')),
                                    'description' => __('Choose where you want to show the page title.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_page_banner', array( 'default' => $vega_wp_defaults['vega_wp_page_banner'], 'sanitize_callback' => 'vega_wp_sanitize_radio_banner' ) );
    $wp_customize->add_control( 'vega_wp_page_banner', array( 
                                    'label' => __( 'Page Banner', 'vega' ), 
                                    'section' => 'vega_wp_page_section',
                                    'settings' => 'vega_wp_page_banner', 
                                    'type' => 'radio', 
                                    'choices' => array('Custom Header'=>'Custom Header', 'Featured Image'=>'Featured Image', 'None'=>'None'),
                                    'description' => __('The Custom Header can be set from the `Header Image` section. Custom Header is shown as the banner by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_page_sidebar', array( 'default' => $vega_wp_defaults['vega_wp_page_sidebar'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_page_sidebar', array( 
                                    'label' => __( 'Show Sidebar?', 'vega' ), 
                                    'section' => 'vega_wp_page_section',
                                    'settings' => 'vega_wp_page_sidebar', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>'Yes', 'N'=>'No'),
                                    'description' => __('Sidebar is shown by default.', 'vega') ) );
                                                                        
    /*** vega_advanced_section ***/
    if(vega_show_custom_css_field()) {
    $wp_customize->add_section( 'vega_wp_advanced_section' , array( 'title' => __( 'Advanced Settings', 'vega' ), 'priority' => 86, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_custom_css', array( 'default' => $vega_wp_defaults['vega_wp_custom_css'], 'sanitize_callback' => 'wp_filter_nohtml_kses' ) );
    $wp_customize->add_control( 'vega_wp_custom_css', array( 
                                    'label' => __( 'Custom CSS', 'vega' ), 
                                    'section' => 'vega_wp_advanced_section',
                                    'settings' => 'vega_wp_custom_css', 
                                    'type' => 'textarea', 
                                    'description' => __('Custom CSS code.', 'vega') ) );
    }
    
    //$wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_control('header_textcolor');
    $wp_customize->get_section('colors')->title = __( 'Colors and Fonts', 'vega' );
}
add_action( 'customize_register', 'vega_wp_customize_register' );



/*** Sanitize ***/

function vega_wp_sanitize_html( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function vega_wp_sanitize_text( $input ) {
    return sanitize_text_field( $input );
}

function vega_wp_sanitize_radio_yn( $input ) {
    $valid = array(
        'Y' => 'Yes',
        'N' => 'No'
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'Y';
    }
}

function vega_wp_sanitize_radio_nav_styling($input) {
    $valid = array(
        'Default' => 'Default',
        'Custom'  => 'Custom'
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'Default';
    }
}

function vega_wp_sanitize_radio_nav_position($input) {
    $valid = array(
        'Above' => 'Above',
        'Top'  => 'Top'
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'Default';
    }
}

function vega_wp_sanitize_radio_frontpage_banner( $input ) {
    $valid = array(
        'Full Screen',
        'Banner'
    );
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return 'Banner';
    }
}

function vega_wp_sanitize_radio_colors( $input ) {
    $valid = array(
        'Green',
        'Orange',
        'Blue',
        'Custom'
    );
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return 'Orange';
    }
}
function vega_wp_sanitize_radio_blog_feed_display( $input ) {
    $valid = array(
        'Small Image Left, Excerpt Right',
        'Large Image Top, Full Content Below', 
        'No Image, Excerpt'
    );
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return 'Small Image Left, Excerpt Right';
    }
}

function vega_wp_sanitize_radio_blog_feed_sidebar_position($input) {
    $valid = array(
        'Left',
        'Right'
    );
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return 'Right';
    }
}

function vega_wp_sanitize_alignment($input) {
    $valid = array(
        'left',
        'right',
        'center'
    );
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return 'left';
    }
}

function vega_wp_sanitize_radio_banner( $input ) {
    $valid = array(
        'Image Banner',
        'Full Screen Image',
        'Video Banner',
        'Full Screen Video',
        'Image/Video Slideshow',
        'Full Screen Image/Video Slideshow',
        'Custom Header',
        'None',
        'Featured Image',
        'Simple Banner'
    );
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return 'None';
    }
}

function vega_wp_sanitize_number( $input ) {
    $input = (int)$input;
    $input = absint($input);
    if(is_int($input))
        return $input;
    else
        return '0';
} 
function vega_wp_sanitize_float( $input ) {
    if(is_numeric($input))
        return $input;
    else
        return '1';
} 

function vega_wp_sanitize_page($input) {
    $input = (int)$input;
    $input = absint($input);
    if(is_int($input))
        return $input;
    else
        return '0';
} 
function vega_wp_sanitize_url($input) {
    return esc_url_raw($input);
} 
function vega_wp_sanitize_font($input) {
    global $google_fonts;
    if ( array_key_exists ( $input, $google_fonts ) ) {
        return $input;
    } else {
        return '';
    }
}
function vega_wp_sanitize_animate_css($input) {
    global $animate_css;
    if ( in_array ( $input, $animate_css ) ) {
        return $input;
    } else {
        return '';
    }
}

function vega_wp_sanitize_html_class($input) {
    return sanitize_html_class($input);
}
/*** Lists ***/   

function vega_wp_google_fonts(){
    global $google_fonts;
    foreach ($google_fonts as $k=>$v){
        $arr[$k] = $k;
    }
    return $arr;
}

function vega_wp_animate_css(){
    global $animate_css;
    sort($animate_css);
    foreach ($animate_css as $css){
        $arr[$css] = $css;
    }
    return $arr;
}
function vega_wp_sanitize_radio_post_page_titles( $input ) {
    $valid = array(
        'Both'=>'Both', 
        'Banner'=>'Banner', 
        'Content'=>'Content'
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'Both';
    }
}
?>