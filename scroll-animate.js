$(document).ready(function(){



//Animate triangles
jQuery('.col4').one('inview', function (event, visible) {
    if (visible == true) {
        jQuery(this).addClass("animated fadeInDown");
    } else {
        //jQuery(this).removeClass("animated fadeInDown");
    }
});


jQuery('.fa').bind('inview', function (event, visible) {
    if (visible == true) {
        jQuery(this).addClass("animated fadeInUp");
    } else {
        //jQuery(this).removeClass("animated fadeInUp");
    }
});


jQuery('.col3').bind('inview', function (event, visible) {
    if (visible == true) {
        jQuery(this).addClass("animated swing");
    } else {
        //jQuery(this).removeClass("animated swing");
    }
});

jQuery('.col5').one('inview', function (event, visible) {
    if (visible == true) {
        jQuery(this).addClass("animated flipInX");
    } else {
        //jQuery(this).removeClass("animated fadeInDown");
    }
});

/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
//particlesJS.load('particles-js', 'js/particles.json', function() {
  //console.log('callback - particles.js config loaded');
//});


/* Scroll to class, div */
$("#button").click(function() {
$('html, body').animate({
    scrollTop: $("#target-element").offset().top
}, 1000);
});



$(window).scroll(function () {
     
    var x = $(this).scrollTop();

    // freezze div background
    $('.banner0').css('background-position', '0px ' + x +'px');

    // from left to right
    $('.banner0').css('background-position', x+'px ' +'0px');

    // from right to left
    $('.banner0').css('background-position', -x+'px ' +'0px');

    // from bottom to top
    $('#skills').css('background-position', '0px ' + -x + 'px');

    // move background from top to bottom
    $('.skills1').css('background-position', '0% ' + parseInt(-x / 1) + 'px' + ', 0% ' + parseInt(-x / 1) + 'px, center top');
  //alert(x);

  if ( x > 100 ) {
    $( ".menu" ).addClass( 'menushow' );
    $( ".menu" ).fadeIn("slow");
    $( ".menu" ).animate({opacity: 0.75}, 1500);
  } else {
    $( ".menu" ).removeClass( 'menushow' );
    $( ".menu" ).animate({opacity: 1}, 1500);
  }

});



// progres bar animation simple
$('.bar1').each(function(i) {
  var width = $(this).data('width');  
  $(this).animate({'width' : width + '%' }, 900, function(){
    // Animation complete
  });  
});


  //Animate skill bars adwanced
  jQuery('#skills').one('inview', function (event, visible) {

      if (visible == true) {
          jQuery('.bar').each(function () {   
              jQuery(this).animate({
                  width: $(this).attr('data-width')},
                  {
                    duration: 5000,
                    step: function(n){
                      var txt = $(this).children('span').text();    
                      txt = $(this).attr('data-txt');
                      $(this).html( "<span>" + txt + "</span>" + parseInt(n) + "% ");
                  }
              });
          });
      }
  });

$('.banner0').click(function(){
  //alert("dd");
  var w = $('.banner').width();
  $('.banner').stop().animate({ backgroundPosition: '+='+w+'px'  }, 1000);
  //$('.banner').stop().animate({ backgroundPosition: '+=100%'  }, 1000);
});



// slide to top of the page
$('.up').click(function () {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
    return false;
});


// menu button show hide
$(".menubtn").click(function(){
            $("html, body").animate({scrollTop: 0}, 300);
           $(".menutop").slideDown( "fast", function() {
          // Animation complete.
          });
});



//$(document.body).animate({    'scrollTop':   $('#anchorName2').offset().top}, 2000);

// slide page to anchor
$('.menutop b').click(function(){
    //event.preventDefault();
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 600);
    return false;
});





});



/* validate email and name */

function validateText(nameField){
    var reg = /^[A-Za-z0-9][A-Za-z0-9 -ĹźĹşÄĹĂłĹÄĹĹťĹšÄĹĂĹÄĹ]*$/i;     
       if (reg.test(nameField.value) == false)
        {
            //alert('Podaj ImiÄ');
            document.example.text.value = "Wpisz wiadomoĹÄ";
            document.example.text.setAttribute("style", "color: #ff0000; border-color: #ff0000");
            return false;
        }
        document.example.text.setAttribute("style", "color: #f26621; border-color: #f26621");
        return true;
}

function validateName(nameField){
    var reg = /^[A-Za-z0-9][A-Za-z0-9 -ĹźĹşÄĹĂłĹÄĹĹťĹšÄĹĂĹÄĹ]*$/i;     
       if (reg.test(nameField.value) == false)
        {
            //alert('Podaj ImiÄ');
            document.example.name.value = "Podaj swoje imiÄ";
            document.example.name.setAttribute("style", "color: #ff0000; border-color: #ff0000");
            return false;
        }
        document.example.name.setAttribute("style", "color: #f26621; border-color: #f26621");
        return true;
}

function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(emailField.value) == false) 
        {
            //alert('Podaj poprawny adres email');
            document.example.email.value = "Podaj poprawny adres email";
            document.example.email.setAttribute("style", "color: #ff0000; border-color: #ff0000");
            return false;
        }
        document.example.email.setAttribute("style", "color: #f26621; border-color: #f26621");
        return true;
}



/* scroll page to anchor */
  $(function() {
    $('a[href*="#"]:not([href="#"])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top-125
          }, 1000);
          return false;
        }
      }
    });
  });
