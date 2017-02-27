$(document).ready(function(){

// slide to top of the page
	$('.up').click(function () {
	    $("html, body").animate({
	        scrollTop: 0
	    }, 600);
	    return false;
	});

	// slide page to anchor
	$('.menutop b').click(function(){
	    //event.preventDefault();
	    $('html, body').animate({
	        scrollTop: $( $(this).attr('href') ).offset().top
	    }, 600);
	    return false;
	});

	// Scroll to class, div
	$("#button").click(function() {
		$('html, body').animate({
		    scrollTop: $("#target-element").offset().top
		}, 1000);
	});

	// div background animate
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

		// Show hide mtop menu  
		if ( x > 100 ) {
		$( ".menu" ).addClass( 'menushow' );
		$( ".menu" ).fadeIn("slow");
		$( ".menu" ).animate({opacity: 0.75}, 500);
		} else {
		$( ".menu" ).removeClass( 'menushow' );
		$( ".menu" ).animate({opacity: 1}, 500);
		}

	});

	// progres bar animation simple
	$('.bar1').each(function(i) {
	  var width = $(this).data('width');  
	  $(this).animate({'width' : width + '%' }, 900, function(){
	    // Animation complete
	  });  
	});
  
});
