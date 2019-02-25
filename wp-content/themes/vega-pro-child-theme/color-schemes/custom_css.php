<?php

$custom_css_template['custom_nav'] = "
/* Custom Nav Bar Start */
~body_padding_top~
.navbar-custom.navbar-altered{ background-color:rgba(~navbar_color_rgb~, ~navbar_opacity~); -webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}
.navbar-custom.navbar-altered-scrolled{ background-color:rgba(~navbar_color_rgb~, 1);  -webkit-transition: background 0.4s linear; -moz-transition: background 0.4s linear; -ms-transition: background 0.4s linear; -o-transition: background 0.4s linear; transition: background 0.4s linear; -webkit-box-shadow:0 0 5px rgba(0,0,0,0.2); -moz-box-shadow:0 0 5px rgba(0,0,0,0.2); box-shadow:0 0 5px rgba(0,0,0,0.2);}
/* Custom Nav Bar End */
";

$custom_css_template['colors'] = 
"
/* Custom Color Scheme Start */

/* Body 
------------------------------------------------------------------------*/
body{ color:~color_body~; }

/* Special Headings
------------------------------------------------------------------------*/
.block-title:after{ border-bottom:2px solid ~color1~; }

/* Links
------------------------------------------------------------------------*/
a{ color:~color1~; }
a:hover,
a:focus{ color:~color2~;}

/* Background Colors for Sections
------------------------------------------------------------------------*/
.bg-primary{ background-color:~color1~; color:#fff; }

/* Buttons
------------------------------------------------------------------------*/
.btn-primary-custom{ background-color:~color1~; border-color:~color1~; color:#fff; }
.btn-primary-custom{ background-color:~color1~; color:#fff; }
.btn-primary-custom:hover,
.btn-primary-custom:active,
.btn-primary-custom:focus{ background-color:~color2~; color:#fff; }

/* Forms
------------------------------------------------------------------------*/
.form-control:focus { border-color: ~color1~; -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(~rgb1~, 0.6); -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(~rgb1~, 0.6); box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(~rgb1~, 0.6); }

/* Header Navigation 
------------------------------------------------------------------------*/

.header{background-color: ~color1~;}

/* Top Navigation
------------------------------------------------------------------------*/
.navbar-nav .dropdown-menu{ border-top:2px solid ~color1~; }
.navbar-custom .dropdown-menu > li > a:hover,
.navbar-custom .dropdown-menu > li:hover > a,
.navbar-custom .dropdown-menu > .open > a{ background:transparent; color:~color1~; }
.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover { color:~color1~ !important; background-color: transparent; }
.navbar-custom .nav > li > a:hover,
.navbar-custom .nav > li > a:focus,
.navbar-custom .nav > .current > a,
.navbar-custom .nav > .active > a,
.navbar-custom .nav > .current-menu-ancestor > a,
.navbar-custom .nav > .open > a{ background-color:transparent; color:~color1~; }
.navbar-custom .nav > .page-scroll > a:hover,
.navbar-custom .nav > .page-scroll > a.showing{color:~color1~ !important;}

/* Carousel / Slideshow
------------------------------------------------------------------------*/
/* Carousel Controls */
.bx-wrapper .bx-controls-direction a{ background:~color1~; color:#fff; }

/* Page Banner 
------------------------------------------------------------------------*/
.jumbotron p span{ background-color:~color1~; }

/* Blog Feed
------------------------------------------------------------------------*/
.blog-feed .entry .entry-content-right:after{ border-bottom:1px solid ~color1~; }

/* Pagination
------------------------------------------------------------------------*/
.posts-pagination-block a:focus,
.posts-pagination-block a:hover{ outline:none; z-index:2; -webkit-box-shadow:0 0 0 0 ~color1~; -moz-box-shadow:0 0 0 0 ~color1~; box-shadow:0 0 0 0 ~color1~; color:#fff; background-color:~color1~;}

/* Post 
------------------------------------------------------------------------*/
.post-content .post .entry-title:after{ border-bottom:1px solid ~color1~; }

/* Page
------------------------------------------------------------------------*/
.page-content .page .page-title:after{ border-bottom:1px solid ~color1~; }

/* Widgets
------------------------------------------------------------------------*/
.widget-title{ border-bottom:1px solid ~color1~; }
.widget ul li a:focus,
.widget ul li a:hover{ color:~color1~; }

/* Tag Cloud Widget
------------------------------------------------------------------------*/
.tagcloud a:focus,
.tagcloud a:hover{ background-color:~color1~; color:#fff; }

/* Icon List
------------------------------------------------------------------------*/

/* Featured Icons / 4 Columns with Icons
------------------------------------------------------------------------*/
.content-icon .icon{ color:~color1~; }
.content-icon:hover .btn{ background-color:~color2~; }

/* Front Page - Testimonials
------------------------------------------------------------------------*/
.testimonial .company{ color:~color1~; }
.testimonial .name:after{ border-bottom:1px solid ~color1~; }
#testimonial-carousel .carousel-control-block a:focus,
#testimonial-carousel .carousel-control-block a:hover{-webkit-box-shadow:0 0 0 0 ~color1~; -moz-box-shadow:0 0 0 0 ~color1~; box-shadow:0 0 0 0 ~color1~; background-color:~color1~; }

/* Front Page - Logos
------------------------------------------------------------------------*/
.box-logo:focus,.box-logo:hover{ text-decoration:none; outline:none; background-color:#f4f4f4; border-color:~color1~; }

/* Front Page - Team 
------------------------------------------------------------------------*/

/* Front Page - Recent Posts
------------------------------------------------------------------------*/
.recent-entry .recent-entry-image .caption{ background-color:~color1~; background-color:rgba(~rgb1~,0.54); }
.recent-entry .recent-entry-content:after{  border-bottom:1px solid ~color1~; }

/* Comments
------------------------------------------------------------------------*/
h3#comments{ color: ~color1~; }
#respond h3{color: ~color1~;}

/* Footer Widgets
------------------------------------------------------------------------*/
.footer-widgets .widget-title:after{ border-bottom:1px solid ~color1~; }

/* Footer
------------------------------------------------------------------------*/
.footer{ background-color: ~color1~; }

/* MAX WIDTH 767
------------------------------------------------------------------------*/
@media (max-width:767px){
	.navbar-custom .dropdown-menu > li > a:hover,
    .navbar-custom .dropdown-menu > li:hover > a ,
    .navbar-custom .dropdown-menu > .open > a{ color:#fff; background:~color1~ }
    /*.navbar-custom .nav > li > a:hover, 
    .navbar-custom .nav > li > a:focus, */
    .navbar-custom .nav > .current > a, 
    .navbar-custom .nav > .open > a{ background-color:~color1~; color:#fff; }
}

/* Custom Color Scheme End */
";

$custom_css_template['fonts'] = 
"
/* Custom Fonts Start */

body{ font-family: ~font1~  }

/* Headings
------------------------------------------------------------------------*/
h1,h2,h3,h4,h5,h6{ font-family: ~font2~; }

/* Special Headings
------------------------------------------------------------------------*/
.block-title{ font-family: ~font2~ }

/* Buttons
------------------------------------------------------------------------*/
.btn{ font-family: ~font1~ }

/* Top Navigation
------------------------------------------------------------------------*/
.navbar-custom .navbar-nav > li > a{ font-family: ~font2~ }
.navbar-custom .dropdown-menu > li > a{ font-family: ~font1~ }

/* Blog Feed
------------------------------------------------------------------------*/
.blog-feed .entry .entry-meta{ font-family: ~font2~ }

/* Post 
------------------------------------------------------------------------*/
.post-content .type-attachment .entry-meta{ font-family: ~font2~ }

/* Front Page - CTA 
------------------------------------------------------------------------*/
.frontpage-cta p{ font-family: ~font2~; }
.frontpage-cta p.small{ font-family: ~font2~ }

/* Front Page - Recent Posts
------------------------------------------------------------------------*/
.recent-entry .recent-entry-meta{ font-family: ~font2~  }

/* Comments
------------------------------------------------------------------------*/
h3#comments{ font-family: ~font2~}
.commentlist .comment-author .fn a,
.commentlist .comment-author .fn{font-family: ~font2~}
#respond h3{font-family: ~font2~}

/* Footer Nav
------------------------------------------------------------------------*/
.nav-foot li{ font-family: ~font2~ }

/* Custom Fonts End */

";
?>