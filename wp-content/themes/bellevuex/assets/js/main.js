"use strict";
/**
 * General Custom JS Functions
 *
 * @author     Themovation <themovation@gmail.com>
 * @copyright  2014 Themovation INC.
 * @license    http://themeforest.net/licenses/regular
 * @version    1.2
 */

/*
 # Helper Functions
 # On Window Resize
 # On Window Load
 */

//======================================================================
// Helper Functions
//======================================================================

function UpdateQueryString(key, value, url) {
    if (!url) url = window.location.href;
    var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
        hash;

    if (re.test(url)) {
        if (typeof value !== 'undefined' && value !== null)
            return url.replace(re, '$1' + key + "=" + value + '$2$3');
        else {
            hash = url.split('#');
            url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
            if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                url += '#' + hash[1];
            return url;
        }
    }
    else {
        if (typeof value !== 'undefined' && value !== null) {
            var separator = url.indexOf('?') !== -1 ? '&' : '?';
            hash = url.split('#');
            url = hash[0] + separator + key + '=' + value;
            if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                url += '#' + hash[1];
            return url;
        }
        else
            return url;
    }
}

//-----------------------------------------------------
// NAVIGATION - Adds support for Mobile Navigation
// Detect screen size, add / subtract data-toggle
// for mobile dropdown menu.
//-----------------------------------------------------	
function themo_support_mobile_navigation(){
	
	// If mobile navigation is active, add data attributes for mobile touch / toggle
	if (Modernizr.mq('(max-width: 767px)')) {
		//console.log('Adding data-toggle, data-target');
		jQuery("li.dropdown .dropdown-toggle").attr("data-toggle", "dropdown");
		jQuery("li.dropdown .dropdown-toggle").attr("data-target", "#");
	}
	
	// If mobile navigation is NOT active, remove data attributes for mobile touch / toggle
	if (Modernizr.mq('(min-width:768px)')) {
		//console.log('Removing data-toggle, data-target');
		jQuery("li.dropdown .dropdown-toggle").removeAttr("data-toggle", "dropdown");
		jQuery("li.dropdown .dropdown-toggle").removeAttr("data-target", "#");
	}
}


//-----------------------------------------------------
// Detect if touch device via modernizr, return true
//-----------------------------------------------------	
function themo_is_touch_device(checkScreenSize){

	if (typeof checkScreenSize === "undefined" || checkScreenSize === null) { 
    	checkScreenSize = true; 
	}

	var deviceAgent = navigator.userAgent.toLowerCase();
 

    var isTouch = (deviceAgent.match(/(iphone|ipod|ipad)/) ||
		deviceAgent.match(/(android)/)  || 
		deviceAgent.match(/iphone/i) || 
		deviceAgent.match(/ipad/i) || 
		deviceAgent.match(/ipod/i) || 
		deviceAgent.match(/blackberry/i));
	
	if(checkScreenSize){
		var isMobileSize = Modernizr.mq('(max-width:767px)');
	}else{
		var isMobileSize = false;
	}
	
	if(isTouch || isMobileSize ){
		return true;
	}

	return false;
}


//-----------------------------------------------------
// Disable Transparent Header for Mobile
//-----------------------------------------------------
function themo_no_transparent_header_for_mobile(isTouch){
	
	if (jQuery(".navbar[data-transparent-header]").length) {
		if(isTouch){ 
			jQuery('.navbar').attr("data-transparent-header", "false");		
		}
		else{
			jQuery('.navbar').attr("data-transparent-header", "true");		
		}
	}
}





//-----------------------------------------------------
// Scroll Up
//-----------------------------------------------------
function themo_start_scrollup() {
	
	jQuery.scrollUp({
		animationSpeed: 200,
		animation: 'fade',
		scrollSpeed: 500,
		scrollImg: { active: true, type: 'background', src: '../../images/top.png' }
	});
}



var nice = false;

/**
 * Protect window.console method calls, e.g. console is not defined on IE
 * unless dev tools are open, and IE doesn't define console.debug
 */
(function() {

	if (!window.console) {
		window.console = {};
	}
	// union of Chrome, FF, IE, and Safari console methods
	var m = [
		"log", "info", "warn", "error", "debug", "trace", "dir", "group",
		"groupCollapsed", "groupEnd", "time", "timeEnd", "profile", "profileEnd",
		"dirxml", "assert", "count", "markTimeline", "timeStamp", "clear"
	];
	// define undefined methods as noops to prevent errors
	for (var i = 0; i < m.length; i++) {
		if (!window.console[m[i]]) {
			window.console[m[i]] = function() {};
		}
	}
})();

//======================================================================
// Executes when HTML-Document is loaded and DOM is ready
//======================================================================
jQuery(document).ready(function($) {
	"use strict";


   if (jQuery(".datepick").length)
    {
        //console.log('TEST '+jQuery(".datepick").width());
        //var th_current_width = jQuery(".datepick").width();
        //var the_new_witdh = th_current_width + 200;
        //jQuery(".datepick-month-row").width(the_new_witdh);
        //.datepick-nav
    }







        // Add class for WPBS to fix anchor overshoot
    jQuery(".wpbs-form-and-legend").each(function(){
        // or you can also add a class
        jQuery(this).find('a[name=wpbs-form-start]').addClass("wpbs-form-start");
    });

	// Get and set the default colour for WPBS.

    var wpbs_color =  jQuery('.th-book-cal-small .wpbs-calendar-1 .status-default').css("background-color");


    jQuery('.th-book-cal-small div.wpbs-calendar ul li.status-2, .th-book-cal-small div.wpbs-calendar ul li.status-3 ').css('background-color', wpbs_color);

    // Preloader : Is really only used for the flexslider but is added to the body tag.
    // If flex is detected, we put a timeout on it (5s( so it does not get stuck spinning.
    // If no flex, then disable.
    if (jQuery("#main-flex-slider")[0]){
        // Do nothing / flex will figure it out.
        setTimeout(function(){
            jQuery('body').addClass('loaded');
        }, 10000);
    }else{
        jQuery('body').addClass('loaded');
    }

    // add body class for touch devices.
    if (themo_is_touch_device()) {
        jQuery('body').addClass('th-touch');
    }

	// Add support for mobile navigation
	themo_support_mobile_navigation($);

    // Support for sub menu navigation / also works with sticky header.

    jQuery("body").on("click", "ul.dropdown-menu .dropdown-submenu > a[data-toggle='dropdown']", function(event){
        //console.log($(this).text());
        event.preventDefault();
        event.stopPropagation();
        jQuery(this).parents('ul.dropdown-menu .dropdown-submenu').toggleClass('open');
    });

    // Sticky Header - Set options
    var options = {
        // Scroll offset. Accepts Number or "String" (for class/ID)
        offset: 125, // OR — offset: '.classToActivateAt',

        classes: {
            clone:   'headhesive--clone',
            stick:   'headhesive--stick',
            unstick: 'headhesive--unstick'
        },

        // If the top nav bar menu is open, close it.
        onStick:   function () {

            //jQuery( "header:not('.headhesive--stick') .navbar-toggle").not( ".collapsed" ).trigger( "click" );
			jQuery('.navbar-collapse').css('height', '0');
			jQuery('.navbar-collapse').removeClass('in');
        },
        // If the top nav bar menu is open, close it.
        onUnstick:   function () {

            //jQuery( "header:not('.headhesive--stick') .navbar-toggle").not( ".collapsed" ).trigger( "click" );
			jQuery('.navbar-collapse').css('height', '0');
			jQuery('.navbar-collapse').removeClass('in');
        },
        // Throttle scroll event to fire every 250ms to improve performace
        throttle: 250,
    };


    try
    {
        // Initialise with options
        var banner = new Headhesive('body.th-sticky-header .banner', options);
        jQuery('body.th-sticky-header').addClass('headhesive');
    }
    catch (err) {
        console.log('Sticky header deactivated. WP Dash / Appearance / Customize / Theme Options / Menu & Header');
    }

    // Close sticky header on menu item click.
    jQuery('.navbar-collapse a:not(.dropdown-toggle)').live( "click", function() {
        //jQuery( ".navbar-toggle").not( ".collapsed" ).trigger( "click" );
        jQuery('.navbar-collapse').css('height', '0');
        jQuery('.navbar-collapse').removeClass('in');
    });

    /**
     * Check a href for an anchor. If exists, and in document, scroll to it.
     * If href argument ommited, assumes context (this) is HTML Element,
     * which will be the case when invoked by jQuery after an event
     */
    function scroll_if_anchor(href) {
        href = typeof(href) == "string" ? href : jQuery(this).attr("href");

        var fromTop = 0;
        if (jQuery("header").hasClass("headhesive--clone")) {
            fromTop = jQuery(".headhesive--clone").height() ;
        }

        // You could easily calculate this dynamically if you prefer
        //var fromTop = 50;

        // If our Href points to a valid, non-empty anchor, and is on the same page (e.g. #foo)
        // Legacy jQuery and IE7 may have issues: http://stackoverflow.com/q/1593174
        if(href.indexOf("#") == 0) {
            var $target = jQuery(href);

            // Older browser without pushState might flicker here, as they momentarily
            // jump to the wrong position (IE < 10)
            if($target.length) {
                //console.log('STRATUS Anchor detected - Scroll  ' + $target.offset().top);
                //console.log('STRATUS Anchor detected - Offset ' + fromTop);
                jQuery('html, body').animate({ scrollTop: $target.offset().top - fromTop }, 500, 'linear', function() {
                    //alert("Finished animating");
                });
                if(history && "pushState" in history) {
                    history.pushState({}, document.title, window.location.pathname + href);
                    return false;
                }
            }
        }
    }

    // When our page loads, check to see if it contains and anchor
    scroll_if_anchor(window.location.hash);


    // Detect and set isTouch for touch screens
    //	var isTouch = themo_is_touch_device();

    // Set off set for waypoints
    //if(!isTouch){
        //Setup waypoints plugin

        var th_offset = 0;
        if (jQuery("header").hasClass("headhesive--clone")) {
            th_offset = jQuery(".headhesive--clone").height() ;
        }

        // Add space for Elementor Menu Anchor link
        jQuery( window ).on( 'elementor/frontend/init', function() {
            elementorFrontend.hooks.addFilter( 'frontend/handlers/menu_anchor/scroll_top_distance', function( scrollTop ) {
            	//console.log('ELEM HOOK - Scroll offset ' + th_offset);
                return scrollTop - th_offset;
            } );
        } );
    //}


	if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
		console.log('Smooth Scroll Off (Safari).');
	}else{
		try 
		{
			// Initialise with options
			nice = jQuery("html").niceScroll({
			zindex:20000,
			scrollspeed:60,
			mousescrollstep:60,
			cursorborderradius: '10px', // Scroll cursor radius
			cursorborder: '1px solid rgba(255, 255, 255, 0.4)',
			cursorcolor: 'rgba(0, 0, 0, 0.6)',     // Scroll cursor color
			//autohidemode: 'true',     // Do not hide scrollbar when mouse out
			cursorwidth: '10px',       // Scroll cursor width
			autohidemode: false,
			
				});
		} 
		catch (err) {
			console.log('Smooth Scroll Off.');
		}
	}

});

// WP Booking system show
jQuery( ".wpbs-container" ).show('fast','swing');

// WP Booking system Error message.
jQuery( document ).ajaxComplete(function() {
    var $error_msg_div = jQuery(".wpbs-form-item").filter(function() { return !(jQuery(this).find('*').is(':input')); })
    jQuery($error_msg_div.addClass('wpbs-form-error-msg'));

});

//======================================================================
// On Window Load - executes when complete page is fully loaded, including all frames, objects and images
//======================================================================
 jQuery(window).load(function($) {
	 "use strict";

	// Detect and set isTouch for touch screens
	var isTouch = themo_is_touch_device();

	// Disable Transparent Header for Mobile / touch
	themo_no_transparent_header_for_mobile(isTouch);

	// Start Scroll Up
	themo_start_scrollup();

     // #th-portfolio-content-5c0996ec5e66b .p-king



     jQuery('a[data-filter="*"]').trigger( "click" );


	
});
 
//======================================================================
// On Window Resize
//======================================================================
 jQuery(window).resize(function($){
	 "use strict";
	// Detect and set isTouch for touch screens
	var isTouch = themo_is_touch_device();

	// Add support for mobile navigation
	themo_support_mobile_navigation();

	// Disable Transparent Header for Mobile / touch
	themo_no_transparent_header_for_mobile(isTouch);
});


/*
 * Hook ajaxcomplete for WP Booking System.
 * Hijack success message and tag along our buy button.
 *
 * */
jQuery( document ).ajaxComplete(function( event, xhr, settings ) {

    // Check if success message is active / exists, if not exit.
    if (jQuery('.wpbs-woo-payment-request-mgs').length){
        //console.log(settings.data);
        //console.log(xhr.responseText);

        //if( xhr.responseText.toString.call(settings.data) == '[object String]' ) {
        if (xhr.responseText.indexOf("wpbs_clear_selection") >= 0) {

            // pull date from, date to value from query string.
            var getQueryString = function ( field, url ) {
                var href = url ? url : window.location.href;
                var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
                var string = reg.exec(href);
                return string ? string[1] : null;
            };

            var date_now = getQueryString('wpbs-form-start-date',settings.data); // returns 'start date'
            var date_future = getQueryString('wpbs-form-end-date',settings.data); // returns 'end date'

            // If date_future is less than the date now, swap them because the user has selected cal dates in reverse :(
            if(date_future < date_now){
                var date_future = getQueryString('wpbs-form-start-date',settings.data); // returns 'start date'
                var date_now = getQueryString('wpbs-form-end-date',settings.data); // returns 'end date'
            }

            var wpbs_id = getQueryString('wpbs-form-calendar-ID',settings.data); // returns 'cal id'

            // make new date objects.
            date_now = new Date(date_now*1000);
            date_future = new Date(date_future*1000);


            var monthNames = [
                'January', 'February', 'March',
                'April', 'May', 'June', 'July',
                'August', 'September', 'October',
                'November', 'December'
            ];


            var day = date_now.getDate();
            var monthIndex = date_now.getMonth();
            var year = date_now.getFullYear();

            var checkin = monthNames[monthIndex] +' '+ day +', '+ year;

            var day = date_future.getDate();
            var monthIndex = date_future.getMonth();
            var year = date_future.getFullYear();

            var checkout = monthNames[monthIndex] +' '+ day +', '+ year;

            // days inbetween.
            var seconds = Math.floor((date_future - (date_now))/1000);
            var minutes = Math.floor(seconds/60);
            var hours = Math.floor(minutes/60);
            var days = Math.floor(hours/24);

            if (days > 0) {
                var daystobook = days;
            }else{
                var daystobook = 1;
            }
            // Find a way to stuff the quantity into the button.

            //console.log(daystobook);
            //console.log(wpbs_id);

            var bookingCount = 0;

            jQuery(".wpbs-calendar-"+wpbs_id+" .wpbs-form-form").each(function() {

                if ( jQuery( ".wpbs-ID-"+wpbs_id+" .button.ajax_add_to_cart" ).length ) {

                    // Update the quantity
                    jQuery(".wpbs-ID-"+wpbs_id+" .button.ajax_add_to_cart:eq("+bookingCount+")").attr("href", UpdateQueryString("quantity", daystobook, jQuery(".wpbs-ID-"+wpbs_id+" .button.ajax_add_to_cart:eq("+bookingCount+")").attr("href")));

                    // Up the quantity
                    jQuery(".wpbs-ID-"+wpbs_id+" .button.ajax_add_to_cart:eq("+bookingCount+")").attr( "data-quantity", daystobook );

                    // Check-in
                    jQuery(".wpbs-ID-"+wpbs_id+" .button.ajax_add_to_cart:eq("+bookingCount+")").attr( 'data-checkin', checkin);

                    // Check-out
                    jQuery(".wpbs-ID-"+wpbs_id+" .button.ajax_add_to_cart:eq("+bookingCount+")").attr( 'data-checkout', checkout);

                }else{

                    // Update the quantity
                    jQuery(".wpbs-ID-"+wpbs_id+" .add_to_cart_button:eq("+bookingCount+")").attr("href", UpdateQueryString("quantity", daystobook, jQuery(".wpbs-ID-"+wpbs_id+" .add_to_cart_button:eq("+bookingCount+")").attr("href")));

                    // Up the quantity
                    jQuery(".wpbs-ID-"+wpbs_id+" .add_to_cart_button:eq("+bookingCount+")").attr( "data-quantity", daystobook );

                    // Check-in
                    jQuery(".wpbs-ID-"+wpbs_id+" .add_to_cart_button:eq("+bookingCount+")").attr( 'data-checkin', checkin);

                    // Check-out
                    jQuery(".wpbs-ID-"+wpbs_id+" .add_to_cart_button:eq("+bookingCount+")").attr( 'data-checkout', checkout);

                }

                // show button
                jQuery(this).append(jQuery(".wpbs-woo-payment-request.wpbs-woo-pay-req-ID-"+wpbs_id+":eq("+bookingCount+")").html());


                bookingCount=bookingCount+1;


            });

        }
        // }

		/*
		 // Check if setting.data is a string.
		 if( Object.prototype.toString.call(settings.data) == '[object String]' ) {
		 // check if settings.data contains wpbs form id key.
		 if (settings.data.indexOf("wpbs-form-id") >= 0) {
		 // If the rsponse does not contain the wpbs-form-id attribute
		 // print out success message.
		 if (xhr.responseText.indexOf("wpbs_clear_selection") >= 0) {
		 jQuery(".wpbs-form-form").append(jQuery(".wpbs-woo-payment-request").html());
		 }

		 }
		 }*/
    }

});