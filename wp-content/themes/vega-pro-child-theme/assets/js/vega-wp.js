  
/*jquery-scrollstop*/
!function(factory){"function"==typeof define&&define.amd?define(["jquery"],factory):"object"==typeof exports?module.exports=factory(require("jquery")):factory(jQuery)}(function($){var dispatch=$.event.dispatch||$.event.handle,special=$.event.special,uid1="D"+ +new Date,uid2="D"+(+new Date+1);special.scrollstart={setup:function(data){var timer,_data=$.extend({latency:special.scrollstop.latency},data),handler=function(evt){var _self=this,_args=arguments;timer?clearTimeout(timer):(evt.type="scrollstart",dispatch.apply(_self,_args)),timer=setTimeout(function(){timer=null},_data.latency)};$(this).bind("scroll",handler).data(uid1,handler)},teardown:function(){$(this).unbind("scroll",$(this).data(uid1))}},special.scrollstop={latency:250,setup:function(data){var timer,_data=$.extend({latency:special.scrollstop.latency},data),handler=function(evt){var _self=this,_args=arguments;timer&&clearTimeout(timer),timer=setTimeout(function(){timer=null,evt.type="scrollstop",dispatch.apply(_self,_args)},_data.latency)};$(this).bind("scroll",handler).data(uid2,handler)},teardown:function(){$(this).unbind("scroll",$(this).data(uid2))}}});
/*jquery-visible*/
!function(t){var i=t(window);t.fn.visible=function(t,e,o){if(!(this.length<1)){var r=this.length>1?this.eq(0):this,n=r.get(0),f=i.width(),h=i.height(),o=o?o:"both",l=e===!0?n.offsetWidth*n.offsetHeight:!0;if("function"==typeof n.getBoundingClientRect){var g=n.getBoundingClientRect(),u=g.top>=0&&g.top<h,s=g.bottom>0&&g.bottom<=h,c=g.left>=0&&g.left<f,a=g.right>0&&g.right<=f,v=t?u||s:u&&s,b=t?c||a:c&&a;if("both"===o)return l&&v&&b;if("vertical"===o)return l&&v;if("horizontal"===o)return l&&b}else{var d=i.scrollTop(),p=d+h,w=i.scrollLeft(),m=w+f,y=r.offset(),z=y.top,B=z+r.height(),C=y.left,R=C+r.width(),j=t===!0?B:z,q=t===!0?z:B,H=t===!0?R:C,L=t===!0?C:R;if("both"===o)return!!l&&p>=q&&j>=d&&m>=L&&H>=w;if("vertical"===o)return!!l&&p>=q&&j>=d;if("horizontal"===o)return!!l&&m>=L&&H>=w}}}}(jQuery);


/* one page scrolling
------------------------------------------------------------------------*/

jQuery(document).ready(function($){
    
    $(window).scroll(function() {
		var header_height = $('.header').height()+$('.header-toggle').height();
        var scroll = $(window).scrollTop();
        var navbar = $(".navbar-custom");
        if(header_height > 0) {
            if (scroll >= header_height) {
                navbar.addClass("navbar-fixed-top");
            } else {
                navbar.removeClass("navbar-fixed-top");
            }
        }
    });
    
    $(window).resize(function(){
		resize_nav_wrapper();
	});
	resize_nav_wrapper();
    
    $('#testimonial-carousel').carousel({
        interval: 10000
    });
    
	$('.menu-header .page-scroll a').click(function(){
		jQuery('.menu-header .page-scroll>a').removeClass('showing');
		jQuery(this).addClass('showing');
		var href = jQuery(this).attr('href').split('#');
		if(jQuery('.navbar-custom .navbar-toggle').css('display')!='none'){
			jQuery('.navbar-custom .navbar-toggle').click();
		}
		var Header_height = jQuery('.nav-wrapper').innerHeight();
        
		if(href[1]){
			if(jQuery('#'+href[1]).length>0){
				var posEle =jQuery('#'+href[1]).offset().top - Header_height;
				jQuery('html,body').animate({scrollTop:posEle},600);
				return false;
			}
		}
	});
	$(window).load(function(){
		var hash = window.location.hash;
        var Header_height = jQuery('.navbar-custom').innerHeight();
		if(hash){
			if(jQuery(hash).length>0){
				var posEle =jQuery(hash).offset().top - Header_height;
				jQuery('html,body').animate({scrollTop:posEle},600);
				return false;
			}
		}
	});
	$(window).scroll(function(){
		$('.section').each(function(){
			//var visible = jQuery(this).visible('false'); 
            var visible = isScrolledIntoView(jQuery(this));
			if(visible){
				var id = jQuery(this).attr('id');
				if (jQuery(".menu-header .page-scroll > a[href*='"+id+"']").length>0) {
					jQuery('.menu-header .page-scroll > a').removeClass('showing');
					jQuery(".menu-header .page-scroll > a[href*='"+id+"']").addClass('showing');
				}
			} 
		});
	});
    
    $(".header-toggle").click(function(){
		$(this).toggleClass('open');
		$('.header').toggleClass('open');
		return false;
	});
	$(window).scroll();
    
});

function isScrolledIntoView(elem)
{
    var $elem = jQuery(elem);
    var $window = jQuery(window);
    var $navbar = jQuery(".navbar-custom");

    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();

    var elemTop = $elem.offset().top-$navbar.innerHeight()-20;

    var elemBottom = elemTop + $elem.height();
    return ((docViewTop >= elemTop)); 
}

function resize_nav_wrapper(){
	var header_height = jQuery('.header').height()+jQuery('.header-toggle').height();
    var navbar_custom_height = jQuery('.navbar-custom').height();
    //if(header_height > 0 && jQuery( window ).width() >= 768) {
        //console.log('navbar_custom_height=' + navbar_custom_height);
        jQuery('.nav-wrapper').height(navbar_custom_height);
    //} else jQuery('.body_padding').css("padding-top", navbar_custom_height); 
}

/* back to top, window resizing, animated carousel
------------------------------------------------------------------------*/

jQuery(document).ready(function($) {
    
    //back to top
    $(window).scroll(function(){
		if($(window).scrollTop()>100){
			if(!$('#back_to_top').hasClass('show'))
				$('#back_to_top').addClass('show');
			if(!$('#back_to_top').hasClass('scroll'))
				$('#back_to_top').addClass('scroll');
		}
		else
			$('#back_to_top').removeClass('show');
	});
	$(window).on('scrollstop',function(){
		$('#back_to_top').removeClass('scroll');
	});
	if($(window).scrollTop()>100) $('#back_to_top').addClass('show');
	else $('#back_to_top').removeClass('show');
	$('#back_to_top').click(function(){
		$('html,body').stop().animate({scrollTop:0},1000);
		return false;
	});

    //window resizing, full screen banners
	$(window).resize(function(){
		EventOnResize();
	});
	EventOnResize();
    
    //animated carousel
    
    //Variables, on page load
	var $m_carousel = $('#vega-wp-carousel'),
		$first_slide_animating_elements = $m_carousel.find('.item:first').find("[data-animation ^= 'animated']");

	//Initialize Carousel
	$m_carousel.carousel();
	
	//Animate captions in first slide on page load 
	do_caption_animations($first_slide_animating_elements);
	
	//Pause carousel  
	$m_carousel.carousel('pause');
	
	//Other slides to be animated on carousel slide event 
	$m_carousel.on('slide.bs.carousel', function (e) {
        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
		do_caption_animations($animatingElems);
	});
    
    
    $(window).resize(function(){
        var $wHeight = $(window).height(); $wHeight = $wHeight/2;
        var header_height = jQuery('.header').height();
        var $wHeight = $(window).height();
        if(jQuery("body").hasClass('body_padding_zero'))
            var $nhHeight = 0;
		else
            var $nhHeight = $('.navbar-custom').height() + header_height;
		var $nnH = $wHeight-$nhHeight;
		$('#vega-wp-carousel-full-screen,#vega-wp-carousel .item').css('height',$nnH+'px');
    });
    
    
    var $wHeight = $(window).height(); $wHeight = $wHeight/2;
    $('#vega-wp-carousel,#vega-wp-carousel .item').css('height',$wHeight+'px');
    
    var header_height = jQuery('.header').height();
    var $wHeight = $(window).height();
    if(jQuery("body").hasClass('body_padding_zero'))
        var $nhHeight = 0;
    else
        var $nhHeight = $('.navbar-custom').height() + header_height;
	var $nnH = $wHeight-$nhHeight;
	$('#vega-wp-carousel-full-screen,#vega-wp-carousel-full-screen .item').css('height',$nnH+'px');
    
    $('#vega-wp-carousel ul').bxSlider({nextText:'<i class="fa fa-chevron-right"></i>',prevText:'<i class="fa fa-chevron-left"></i>',speed:800,pause:8000,pager:false,controls:true,responsive:true,auto:true,mode:'fade',onSliderLoad:function(currentIndex){renderAnimationForBxSlider($('#vega-wp-carousel .item.active'));renderVideo(jQuery('#vega-wp-carousel .item.active'));},onSlideBefore:function($slideElement, oldIndex, newIndex){renderAnimationForBxSlider($slideElement);},onSlideAfter:function($slideElement, oldIndex, newIndex){renderVideo($slideElement);}});
    
    $('#vega-wp-carousel-full-screen ul').bxSlider({nextText:'<i class="fa fa-chevron-right"></i>',prevText:'<i class="fa fa-chevron-left"></i>',speed:800,pause:8000,pager:false,controls:true,responsive:true,auto:true,mode:'fade',onSliderLoad:function(currentIndex){renderAnimationForBxSlider($('#vega-wp-carousel-full-screen .item.active'));renderVideo(jQuery('#vega-wp-carousel-full-screen .item.active'));},onSlideBefore:function($slideElement, oldIndex, newIndex){renderAnimationForBxSlider($slideElement);},onSlideAfter:function($slideElement, oldIndex, newIndex){renderVideo($slideElement);}});
    
});
var TimeOutAnimation = false;
function renderAnimationForBxSlider(wrapp){
	if(TimeOutAnimation) clearTimeout(TimeOutAnimation);
	var $animatingElems = wrapp.find("[data-animation ^= 'animated']");
	$animatingElems.css('visibility','hidden');
	TimeOutAnimation = setTimeout(function(){
		var $animatingElems = wrapp.find("[data-animation ^= 'animated']");
		$animatingElems.css('visibility','visible');
		do_caption_animations($animatingElems);
	},1000);
}


/** Function to animate slider captions  **/
function do_caption_animations( elems ) {
	//Cache the animationend event in a variable
	var animEndEv = 'webkitAnimationEnd animationend';
	elems.each(function () {
		var $this = jQuery(this),
			$animationType = $this.data('animation');
		$this.addClass($animationType).one(animEndEv, function () {
			$this.removeClass($animationType);
		});
	});
}

/*
var wH = window.innerHeight;
var mH = document.getElementById('navbar-custom').innerHeight;
var nnH = wH-mH;
document.getElementById('vega-wp-carousel-full-screen').style.height=nnH+'px';
*/

/* resizing elements
------------------------------------------------------------------------*/

function EventOnResize(){
	var $wHeight = jQuery(window).height();
    var header_height = jQuery('.header').height();
	if(jQuery("body").hasClass('body_padding_zero'))
        var $nhHeight =0;
    else
        var $nhHeight = jQuery('.navbar-custom').height() + header_height;
	var $nnH = $wHeight-$nhHeight;
    
	jQuery('.image-banner.full-screen').css('height',$nnH+'px');
    
    jQuery('.video-banner.full-screen').css('height',$nnH+'px');
    if(jQuery('.video-banner').length>0) 
            renderVideoBanner(jQuery('.video-banner'));
    
	jQuery('.row').each(function(){
		if(jQuery(this).find('.content-icon').length>0){
			jQuery('.content-icon .title',this).css('min-height','inherit')
			jQuery('.content-icon .body',this).css('min-height','inherit')
			var titleH = 0;
			var bodyH = 0;
			jQuery('>div',this).each(function(){
				var titleHn = jQuery('.content-icon .title',this).height();
				var bodyHn = jQuery('.content-icon .body',this).height();
				if(titleHn>titleH) titleH =titleHn;
				if(bodyHn>bodyH) bodyH =bodyHn;
			});
			jQuery('.content-icon .title',this).css('min-height',titleH)
			jQuery('.content-icon .body',this).css('min-height',bodyH)
		}
        
        if(jQuery(this).find('.recent-entry').length>0){
			jQuery('.recent-entry .recent-entry-title',this).css('min-height','inherit')
			jQuery('.recent-entry .recent-entry-content',this).css('min-height','inherit')
			var titleH = 0;
			var bodyH = 0;
			jQuery('>div',this).each(function(){
				var titleHn = jQuery('.recent-entry .recent-entry-title',this).height();
				var bodyHn = jQuery('.recent-entry .recent-entry-content',this).height(); 
				if(titleHn>titleH) titleH =titleHn;
				if(bodyHn>bodyH) bodyH =bodyHn;
			});
			jQuery('.recent-entry .recent-entry-title',this).css('min-height',titleH);
			jQuery('.recent-entry .recent-entry-content',this).css('min-height',bodyH+15); /* 15= recent-entry-content padding-bottom */
		}
	});
    var newHeightTestiText = 0;
	jQuery('#testimonial-carousel .item').each(function(){
		if(!jQuery(this).hasClass('active')) jQuery(this).css({'position':'absolute','visibility':'hidden','display':'block'});
		if(newHeightTestiText<jQuery(this).find('.testimonial .text').height()) newHeightTestiText = jQuery(this).find('.testimonial .text').height();
		if(!jQuery(this).hasClass('active')) jQuery(this).removeAttr('style');
	});
	jQuery('#testimonial-carousel .item .testimonial .text').css('min-height',newHeightTestiText);
}

/* video banner
------------------------------------------------------------------------*/

var BV = false;
function renderVideoBanner(current){ 
	if(BV) BV.dispose();
    var isTouch = Modernizr.touch;
    //by default, videos do not auto play on mobile phones. so detect if device is a touch screen, if so, do not play video - instead show fallback image
    
        if(current.attr('data-video')!='' && current.attr('data-video')){
            var data_video = current.attr('data-video');
            BV = new jQuery.BigVideo({container:current,useFlashForFirefox:false});
            BV.init();
            BV.show(data_video, {ambient:true});
            var player = BV.getPlayer();
            jQuery('#big-video-wrap',current).css('visibility','hidden');
            player.on('loadedmetadata', function(){
                jQuery('#big-video-wrap',current).css('visibility','visible');
            });
        }else{
            BV = false;
        }
    
}



/* video slider
------------------------------------------------------------------------*/

function renderVideo(current){
	var isTouch = Modernizr.touch;
	//if (!isTouch){
		if(current.attr('data-video')!='' && current.attr('data-video')){
			//if(!current.hasClass('rendered')){
				if(BV) BV.remove();
				var data_video = current.attr('data-video');
				BV = new jQuery.BigVideo({container:current,useFlashForFirefox:false});
				BV.init();
				BV.show(data_video,{ambient:true});
				var player = BV.getPlayer();
				jQuery('#big-video-wrap').css('display','none');
				player.on('loadedmetadata', function(){
					jQuery('#big-video-wrap').fadeIn();
				});
				//current.addClass('rendered');
			//}
		}
    //}
}
