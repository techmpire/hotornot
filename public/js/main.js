
$(document).ready(function(){


/* ==========================================================================
   Preload
========================================================================== */
    
    
    /*$("html").queryLoader2({
        barColor: "#111",
        backgroundColor: "#fff",
        percentage: true,
        barHeight: 3,
        completeAnimation: "fade",
        minimumTime: 200
    });*/

    $("body").fadeIn('fast');

/* ==========================================================================
   Scroll about page
========================================================================== */
$(".learn-more").click(function(event){     
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
    });
    

/* ==========================================================================
   For Bootstrap current state on portfolio sorting
========================================================================== */


    $('ul.nav-pills li a').click(function (e) {
        $('ul.nav-pills li.active').removeClass('active')
        $(this).parent('li').addClass('active')
    })




/* ==========================================================================
  Magnific Popup
========================================================================== */
/*  */
$('.grid-wrapper').magnificPopup({
      delegate: 'a', 
      type: 'image',
      gallery:{
      enabled:true
      }
    });

/* ==========================================================================
 Sticky menu
========================================================================== */
$(".navbar").sticky({topSpacing: 0});

/* ==========================================================================
 Scroll spy and scroll filter
========================================================================== */

    $('#main-menu').onePageNav({
        currentClass: "active",
        changeHash: false,
        scrollThreshold: 0.5,
        scrollSpeed: 750,
        filter: "",
        easing: "swing" 
     });



/*==========================================================================
VEGAS Home Slider
========================================================================== */   

  
    $.vegas('slideshow', {
        backgrounds:[
        
        { src:'/public/img/header.jpg', fade:1000 }
        ]
      });
      $( "#vegas-next" ).click(function() {
        $.vegas('next');
      });
      $( "#vegas-prev" ).click(function() {
        $.vegas('previous');
    });

/*==========================================================================
Contact form 
========================================================================== */  

      $('#contact-form').validate({
        rules: {
            name: {
                minlength: 2,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            message: {
                minlength: 2,
                required: true
            }
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function (element) {
            element.text('OK!').addClass('valid')
                .closest('.control-group').removeClass('error').addClass('success');
        }
    });

/*==========================================================================
Count to timer
========================================================================== */ 

 $('.counter').waypoint(function() {
    $(this).countTo();
     }, {
     triggerOnce: true,
     offset: 'bottom-in-view'
});       
         
                   

});