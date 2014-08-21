
$(document).ready(function(){


/* ==========================================================================
   Preload
========================================================================== */
    
    
    $("html").queryLoader2({
        barColor: "#111",
        backgroundColor: "#fff",
        percentage: true,
        barHeight: 3,
        completeAnimation: "fade",
        minimumTime: 200
    });

    $("body").fadeIn('slow')

/* ==========================================================================
   Scroll about page
========================================================================== */
$(".learn-more").click(function(event){     
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top}, 1000);
    });
    

/* ==========================================================================
   For Bootstrap current state on portfolio sorting
========================================================================== */


    $('ul.nav-pills li a').click(function (e) {
        $('ul.nav-pills li.active').removeClass('active')
        $(this).parent('li').addClass('active')
    })


/* ==========================================================================
  Parallax
========================================================================== */

    $('#parallax-quote').parallax("50%", 0.8);
    $('#parallax-connect').parallax("50%", 0.8);
    $('.parallax-content').parallax("50%", 0.3);



   

/* ==========================================================================
  Portfolio sorting 
========================================================================== */

  $(window).load(function(){
    var $container = $('.grid-wrapper');
    $container.isotope({
        filter: '*',
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });
 
    $('.grid-controls li a').click(function(){
        $('.grid-controls .current').removeClass('current');
        $(this).addClass('current');
 
        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
         });
         return false;
    });
});


     $('.mix a').hover(
               function(){ 
                         $(this).find('.overlay').stop().slideDown(500);
                         return false;
               },
               function(){
                         $(this).find('.overlay').stop().slideUp(500);
                         return false;
               }
     );



/* ==========================================================================
  Team
========================================================================== */

  $(".team-footer").mouseenter(function() {
            $(".follow", this).stop().animate({top:70},'fast');
            $(".follow", this).next().fadeIn()
    });

    $(".team-footer").mouseleave(function() {
            $(".follow", this).stop().animate({top:0},'fast');
            $(".follow", this).next().fadeOut()

    });


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