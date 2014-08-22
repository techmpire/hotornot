
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
        $('html,body').animate({scrollTop:$("#page-contact").offset().top}, 700);
    });
    
/*
$("#button").click(function() {
    $('html, body').animate({
        scrollTop: $("#elementtoScrollToID").offset().top
    }, 2000);
});
*/


/*==========================================================================
VEGAS Home Slider
========================================================================== */   

  
    $.vegas('slideshow', {
        backgrounds:[
        
        { src:'/public/img/header_alternate.jpg', fade:500 }
        ]
      })('overlay', {
        src:'/public/img/16.png'
      });
    
   

});