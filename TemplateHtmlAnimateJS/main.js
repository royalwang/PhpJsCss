$(document).ready(function () {

    /* Scroll div background */
    $(window).scroll(function () {        
        var x = $(this).scrollTop();

        // freezze div background
        $('#skills1').css('background-position', '0px ' + x +'px');

        // from left to right
        $('#skills2').css('background-position', x+'px ' +'0px');

        // from right to left
        $('#skills3').css('background-position', -x+'px ' +'0px');

        // from bottom to top
        $('#skills4').css('background-position', '0px ' + -x + 'px');

        // move background from top to bottom
        $('#skills').css('background-position', '0% ' + parseInt(-x / 1) + 'px' + ', 0% ' + parseInt(-x / 1) + 'px, center top');
    });


    /* Scroll to top */
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {

            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    /* Scroll to anchor */
    $("a").on('click', function(event) {
        if (this.hash !== "") {
          event.preventDefault();
          var hash = this.hash;
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){
            window.location.hash = hash;
          });
        } 
    });

    /* scroll a link to anchor div*/
    $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
    });

    /* menu scale on scroll worst solution */
    $(window).scroll(function(){
    var top=$(window).scrollTop();
    if(top > 10){
    $(".my-navbar").stop().animate({height: '50px'}, 200);
    }else{
    $(".my-navbar").stop().animate({height: '100px'}, 200);
    }
    });

    /* menu scale on scroll better solution */
    $(window).scroll(function(){
    var top=$(window).scrollTop();
    if(top > 10){
    $(".my-navbar").addClass('NavBar2');
    }else{
    $(".my-navbar").removeClass('NavBar2');
    }
    });

    /* menu scale on scroll better solution with css transition: all 0.5s ease*/
    $(window).scroll(function() {
    if ($(this).scrollTop() > 1){  
        $('header').addClass("sticky");
      }
      else{
        $('header').removeClass("sticky");
      }
    });

    /* menu hide on scroll */
    $(window).scroll(function() {
    if ($(this).scrollTop() > 1){  
            $( ".menu" ).addClass( 'menushow' );
            //$( ".menu" ).fadeIn(600);
            $( ".menu" ).animate({opacity: 0.5}, 1500);
        } else {
            $( ".menu" ).removeClass( 'menushow' );
            //$( ".menu" ).fadeOut(600);
            $( ".menu" ).animate({opacity: 2.0}, 500);
        }
    });

    // progres bar animation simple
    $('.bar').each(function(i) {
        var width = $(this).data('width');  
        $(this).animate({'width' : width + '%' }, 900, function(){
        // Animation complete
        });  
    });


    /* scroll up or down direction */
    var lastScrollTop = 0;
    $(window).scroll(function(event){
       var st = $(this).scrollTop();
       if (st > lastScrollTop){
           // downscroll code
       } else {
          // upscroll code
       }
       lastScrollTop = st;
    });

// end
});

/* scroll in clear js */
var cbpAnimatedHeader = (function() {

    var docElem = document.documentElement,
        header = document.querySelector( '.cbp-af-header' ),
        didScroll = false,
        changeHeaderOn = 300;

    function init() {
        window.addEventListener( 'scroll', function( event ) {
            if( !didScroll ) {
                didScroll = true;
                setTimeout( scrollPage, 250 );
            }
        }, false );
    }

    function scrollPage() {
        var sy = scrollY();
        if ( sy >= changeHeaderOn ) {
            classie.add( header, 'cbp-af-header-shrink' );
        }
        else {
            classie.remove( header, 'cbp-af-header-shrink' );
        }
        didScroll = false;
    }

    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }

    init();

})();


/* scroll jquery */
$(function(){
 var shrinkHeader = 300;
  $(window).scroll(function() {
    var scroll = getCurrentScroll();
      if ( scroll >= shrinkHeader ) {
           $('.header').addClass('shrink');
        }
        else {
            $('.header').removeClass('shrink');
        }
  });
function getCurrentScroll() {
    return window.pageYOffset || document.documentElement.scrollTop;
    }
});
