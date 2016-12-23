
$(window).load(function() {

	"use strict";

//------------------------------------------------------------------------
//						PRELOADER SCRIPT
//------------------------------------------------------------------------
    $('#preloader').delay(400).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('#preloader .loading-data').fadeOut(); // will first fade out the loading animation


//------------------------------------------------------------------------
//						COUNTDOWN OPTIONS SCRIPT
//------------------------------------------------------------------------    
    if($('div').is('.countdown')){         
        $('.countdown').jCounter({
            date: "14 february 2016 12:00:00", // Deadline date
            timezone: "Europe/Bucharest",
            format: "dd:hh:mm:ss",
            twoDigits: 'on',
            fallback: function() {console.log("count finished!")}
        });
    }


//------------------------------------------------------------------------
//						NAVBAR SLIDE SCRIPT
//------------------------------------------------------------------------ 		
	$(window).scroll(function () {
        if ($(window).scrollTop() > $("nav").height()) {
            $("nav.navbar-slide").addClass("show-menu");
        } else {
            $("nav.navbar-slide").removeClass("show-menu");
			$(".navbar-slide .navMenuCollapse").collapse({toggle: false});
			$(".navbar-slide .navMenuCollapse").collapse("hide");
			$(".navbar-slide .navbar-toggle").addClass("collapsed");
        }
    });

	
//------------------------------------------------------------------------
//						NAVBAR HIDE ON CLICK (COLLAPSED) SCRIPT
//------------------------------------------------------------------------ 		
    $('.nav a').on('click', function(){ 
        if($('.navbar-toggle').css('display') !='none'){
            $(".navbar-toggle").click()
        }
    });
	
})




$(document).ready(function() {

    "use strict";

//------------------------------------------------------------------------
//						FULL HEIGHT SECTION SCRIPT
//------------------------------------------------------------------------
    $(".screen-height").css("min-height", $(window).height());
    $(window).resize(function () {
        $(".screen-height").css("min-height", $(window).height());
    });

    $(window).scroll(function () {
        if ($('body').scrollTop() == 0) {
            $('nav.navbar').removeClass('transparent-nav');
            $('.dropdown-menu').removeClass('transparent-nav');
        } else {
            $('nav.navbar').addClass('transparent-nav');
            $('.dropdown-menu').addClass('transparent-nav');
        }

        if($(window).scrollTop() + $(window).height() > $(document).height() - 300) {
            $('.scroll-down').hide();
        } else {
            $('.scroll-down').show();
        }
    });
});
