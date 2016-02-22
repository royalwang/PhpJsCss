  $(document).ready(function(){

	function decimal(s) {
	    var rgx = /^[0-9]*\.?[0-9]*$/;
	    return s.match(rgx);
	}
	
	// Only decimal numbers with two points
	
	$(".half").on("keypress", function (evt) {
	    var $txtBox = $(this);
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    // backspace allow
	    if (charCode == 8)return true;
	    // numbers allow
	    if ( charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
	        return false;
	    else {
	        var len = $txtBox.val().length;
	        var index = $txtBox.val().indexOf('.');

	        if (index > 0 && charCode == 46) {
	            return false;
	        }
	        if (index > 0) {
	            var charAfterdot = (len + 1) - index;
	            if (charAfterdot > 3) {
				return false;
	            }
	        }
	    }
	    return $txtBox;
	});
	
	
    $(window).scroll(function() {
      // do whatever you need here.
          //var heights = window.innerHeight;
          var body = document.body,
          html = document.documentElement;
          var height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );
          document.getElementById("map").style.height = height + "px";
    });


    $(window).scroll(function () {
    //$('.banner').css('backgroundPosition', 5 =+ 'px 0');

    //$('.banner').stop().animate({ backgroundPosition: '10px'  }, 1000);

        var x = $(this).scrollTop();
        $('.banner').css('background-position', '50% ' + parseInt(-x / 1) + 'px' + ', 0% ' + parseInt(-x / 5) + 'px, center top');

    });

    $(".menubtn").click(function(){
           $(".menu").slideDown( "fast", function() {
          // Animation complete.
          });
    });

      $( "#login" ).click(function() {
      $( "#loginbox" ).animate({
      opacity: 0.95,
      position: "+=50",
      height: "toggle"
      }, 100, function() {
      // Animation complete.
      });
    });

    $( ".banner1" ).click(function() {
      $( ".banner1" ).animate({
      //opacity: 0.25,
      position: "+=50",
      //height: "toggle"
      }, 100, function() {
      // Animation complete.
      });
    });

    $('.username').keypress(function (e) {
          var regex = new RegExp("^[a-zA-Z0-9\b]+$");
          var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
          if (regex.test(str)) {
              return true;
          }
          e.preventDefault();
          return false;
    });

    // load sub cat id
    $('.username').keyup(function(){
      var id = this.value;
      $.post( "../core/user.php", { user: id, time: "0" }).done(function( data ) {
        //alert( "Data Loaded: " + data );
        //$( ".setid" ).html( data );
        //$("body").prepend(data);
        var s = data;

        if (s == 1 || id.length == 0) {
          //alert("Użytkownik istnieje! Podaj inną nazwę.");
           $('.username').css('background-color', '#ffd6d6');
           $('#error').text('Użytkownik o takiej nazwie już istnieje!');
           $('#error').css('color', '#ff0000');
        }else{
          $('.username').css('background-color', '#dff0d8');
          $('#error').text('');
          $('#error').css('color', '#000');
        };
      });
    });

    // load sub cat id
    $('.email').keyup(function(){
      var id = this.value;
      $.post( "../core/email.php", { email: id, time: "0" }).done(function( data ) {
        //alert( "Data Loaded: " + data );
        //$( ".setid" ).html( data );
        //$("body").prepend(data);
        var s = data;
        if (s == 1) {
          //alert("Błędny adres email lub taki email istnieje! Podaj inną nazwę.");
           $('.email').css('background-color', '#ffd6d6');
           $('#error').text('Adres email istnieje lub jest niepoprawny.');
           $('#error').css('color', '#ff0000');
        }else{
          $('.email').css('background-color', '#dff0d8');
          $('#error').text('');
          $('#error').css('color', '#000');
        };
      });
    });

    // load sub cat id
    $('.password').keyup(function(){
        var s = $('.password').val();
        if (s.length < 8) {
          //alert("Błędny adres email lub taki email istnieje! Podaj inną nazwę.");
           $('.password').css('background-color', '#ffd6d6');
           $('#error').text('Hasło musi zawierać minimum 8 znaków');
           $('#error').css('color', '#ff0000');
        }else{
          $('.password').css('background-color', '#dff0d8');
          $('#error').text('');
          $('#error').css('color', '#000');
        };
    });
    

 });
