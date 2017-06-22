	<script type="text/javascript">
	$(document).ready(function() {
		
    // ajax search
		$('.findtxt').keyup(function() {			
  			var txt = $(this).val();
			$.get( "ajax.php",{ q: txt } ,function( data ) {
			  $( "#ajax" ).html( data );
			});
		});
		
    // show hide
		$( "#findbtn" ).click(function() {			
		  // $( "#findbox" ).toggle( "slow" );
		  $( "#findbox" ).slideToggle( "slow" );
		});

    // Add remove class
		$('.c1').click(function(){
			var id = $(this).index();
			$('.c1').removeClass('c1active');
			$(this).addClass('c1active');
			$('.box1 ul').hide();
			$('.box1 ul').eq(id).show();
		});
	});

  // menu top on scroll
	$(window).scroll(function () {
		var top = $(this).scrollTop();
		if (top > 100) {
			$( ".top" ).addClass("fixed");
		    $( ".top" ).fadeIn("slow");
			$( ".top" ).animate({opacity: 0.9}, 500);
		}else {
			$( ".top" ).removeClass( 'fixed' );    			
			$( ".top" ).animate({opacity: 1}, 500);
		}			
	});	
	</script>
  <style>
  .fixed{float: left; width: 100%; background: rgba(255,255,255,0.9); position: fixed; top: 0px; left: 0px; z-index: 9999;}
  </style>
