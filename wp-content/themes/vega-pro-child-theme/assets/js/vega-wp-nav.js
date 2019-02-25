jQuery(document).ready(function(){       
    var scroll_start = 0;
    var startchange = jQuery('.section').not('.section_slideshow'); 
    var offset = startchange.offset();
    var Header_height = jQuery('.navbar-custom').innerHeight();
    if (startchange.length){
        jQuery(document).scroll(function() { 
            scroll_start = jQuery(this).scrollTop();
            if((scroll_start) > (offset.top)) {
                jQuery(".navbar-custom").addClass('navbar-altered-scrolled');
            } else {
                jQuery(".navbar-custom").removeClass('navbar-altered-scrolled');
                jQuery(".navbar-custom").addClass('navbar-altered');
            }
        });
    }
});
