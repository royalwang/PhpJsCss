<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<style type="text/css">
.menu{
  background: url('img/kratka.png-') <?php echo $color1; ?>; color: #fff; height: auto; overflow: hidden; display: none;
}
.menu ul li a{color: #fff; min-width: 100%; min-height: 100%; float: left;}

.menu ul{
      font-family: 'Abel', sans-serif; 
      margin: 0px;
      padding: 0px;
      width: 100%;
      float: left;  
}

.menu ul li{
        float: right;
      padding-top: 15px;
      min-width: 100px;
      min-height: 30px;
      display: inline;
}   

.menu ul li {
      float: right;
      padding-top: 15px;
      min-width: 100%;
      min-height: 30px;
      text-align: center;
      text-decoration: none;
      border-bottom: 1px dashed #fff;
}
.menu ul li a{ text-decoration: none; color: #fff; font-size: 12px;}
.menu ul li:hover{ color: #000; background: #333;}

</style>
<div class="menu">
<ul>
  <li><a href="gmt.php" title="GMT Time"><i class="fa fa-clock-o"></i> GMT Time</a></li>
  <li><a href="signin.php" title="Zaloguj"><i class="fa fa-sign-in"></i> Sign in</a></li> 
  <li><a href="Indicators.zip" title="Wskaźniki"> <i class="fa fa-cloud-download"></i> Indicators </a></li>      
  <li><a href="signals.php" title="Sygnały"><i class="fa fa-signal"></i> Signals</a></li> 
  <li><a href="index.php" title="Wykresy"><i class="fa fa-line-chart"></i> Charts</a></li>
</ul>  
</div>

<div id="top" style="margin-bottom: 5px;">
<style type="text/css">
#lines {
    border-bottom: 10px double #ff2233;
    border-top: 3px solid #ff2233;
    content: "";
    height: 4px;
    width: 25px;
}
.menubtn {
    position: relative;
    float: right;
    top: 7px;
    right: 10px;
    max-width: 20px;
    cursor: pointer;
}
</style>
	
	<div id="lines" class="menubtn color1"></div>   

	<!-- 
    <i class="fa fa-bars" aria-hidden="true"></i>
	<a href="#menu" style="color: #ff2233; font-size: 13px;"> &#9776; Menu </a>
	<a href="index.php" style="padding: 0px; margin: 0px;"><img src="img/logo.jpg" class="logo"> </a> 
	-->
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $(window).scroll(function () {
    //$('.banner').css('backgroundPosition', 5 =+ 'px 0');

    //$('.banner').stop().animate({ backgroundPosition: '10px'  }, 1000);

    var x = $(this).scrollTop();
    $('.banner').css('background-position', '50% ' + parseInt(-x / 1) + 'px' + ', 0% ' + parseInt(-x / 5) + 'px, center top');

    });

    var open;
    $(".menubtn").click(function(){
        if (open == 1) {
           $(".menu").slideUp( "fast", function() {
          // Animation complete.
          $('.menubtn').css('transform','rotate(0deg)');
          open = 0;
          });            
        }else{
           $(".menu").slideDown( "fast", function() {
          // Animation complete.
          $('.menubtn').css('transform','rotate(90deg)');
          open = 1;
          });
       }
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

    /* Scroll to class, div */
    $("#button").click(function() {
    $('html, body').animate({
        scrollTop: $("#target-element").offset().top
    }, 1000);
    });

    // slide to top of the page
    $('.up').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    });
</script>
