<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Plugin test page</title>
	<meta charset="utf-8">
	
	<script src="js/jquery.js"></script>
	<script src="js/inview.js"></script>
	<script src="js/isonscreen.js"></script>
	<script src="js/mixitup.js"></script>
	<script src="js/knob.js"></script>
	<script src="js/brick-by-brick.js"></script>
	<!--
	<script src="//s3-us-west-2.amazonaws.com/s.cdpn.io/130527/brick-by-brick.min.js"></script>
	-->

	<link rel="stylesheet" type="text/css" href="main.css">
	<link href="css/hover.css" rel="stylesheet" media="all">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700&amp;subset=latin-ext" rel="stylesheet"> 
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Owl Carousel Assets -->
    <link href="owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="owl-carousel/owl.theme.css" rel="stylesheet">
    <script src="owl-carousel/owl.carousel.js"></script>
    <link href="owl-carousel/google-code-prettify/prettify.css" rel="stylesheet">
	<!-- Owl Carousel Assets -->

<style type="text/css">
html{
	font-family: 'Ubuntu', sans-serif;
	min-height: 1200px;
}
h1{
	padding: 20px;
	width: 100%;
	overflow: hidden;	
}

.menushow{
  z-index: 9999;
  width: 100%;
  position: fixed;
  left: 0px;
  top: 0px;
  transition: top 0.9s ease-in-out;
}

/* Tabs style */
*{
	font-family: Tahoma;
	font-family: 'Ubuntu', sans-serif;
	margin: 0px;
	padding: 0px;
	box-sizing: border-box;
}
#tabs{max-width: 100%; padding: 5px; margin: 10px;}
#tabs p{
	float: left;
	margin: 5px 0px 5px 0px; }
#tabs p a{
	cursor: pointer;
	border: 1px solid #000;
	padding: 10px; 
	text-transform: uppercase;
}
#tabs p a:first-child{
	background: #000;
	color: #fff;
}
/* select all with name */
[id^="tab-"]{
	float: left;
	color: #000;
	display: none;
	border: 1px solid #000;
	background: #fff;
	padding: 10px 19px 10px 19px;
	text-align: justify;
	text-justify: inter-word;
}
#tab-1{display: inherit;}	
.tabson{
	background: #000 !important;
	color: #fff !important;
}
.tabsoff{		
	background: #fff !important;
	color: #000 !important;
}	


/* accordion style */
#accordion{	
	margin: 15px;
	padding: 0px;
	overflow: hidden;
	box-sizing: border-box;
}
#accordion h3{	
	float: left;
	min-width: 100%;
	margin-top: 10px;		
	padding: 5px;
	cursor: pointer;
	background: #fff;
	border: 1px solid #000;
}
#accordion h3:first-child{
	background: #000;
	color: #fff;
}
#accordion div{
	display: none;
	float: left;
	padding: 5px;
	border: 1px solid #000;
	border-bottom: 2px solid #000;
	box-sizing: border-box;
	transition: width 2s;
	overflow: hidden;
}
#accordion .show{
	display: inherit;	
}
#accordion .showbar{
	background: #000 !important;
	color: #fff !important;
}
#accordion .hidebar{
	background: #fff !important;
	color: #000 !important;
}


/* skill progress bar */
.box {
	color: #fff;
	float: left;
	margin: 15px;	
  	min-width: 50% !important;  
 	border: 1px solid #000;
}
.bar span {
  color: #fff;
  float: left;
  padding: 1px;  
  font-weight: bold;  
  font-size: 12px;
}
.bar {
	height: 30px;
  	font-size: 13px;
    position: relative !important;
    float: left;	
    position: absolute;    
    text-align: right;
    min-width: 0%;
    background: repeating-linear-gradient(45deg,  #000,  #000 10px,  #222 10px,  #222 20px);
    margin: 0px;
    padding: 2px;    
    padding-top: 7px;
    font-size: 13px;
    display: inline;
    white-space:nowrap;
}	
</style>

<script type="text/javascript">
$(document).ready(function(){

// masonry brick
$('#layout').layout({
    itemMargin : 5,
    itemPadding : 5
});

// slide to top of the page
$('.up').click(function () {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
    return false;
});

$("#owl-demo").owlCarousel({
    items : 4,
    loop:true,
    lazyLoad : true,
    dots: false,
    pagination: false,
  }); 
  // Custom Navigation Events
  var owl = $("#owl-demo");
  $(".btnnext").click(function(){
    owl.trigger('owl.next');
  })
  $(".btnprev").click(function(){
    owl.trigger('owl.prev');
});


/* knoc circle setup */
$('.knob').each(function () {
   var $this = $(this);
   var myVal = $this.attr("rel");
   $this.knob({
    readOnly: true,
        //fgColor: '#339933',
        //bgColor: '#eee'
   });
});

$(window).scroll(function () {
	$('.knobs').one('inview', function (event, visible) {
    if (visible == true) {
		// knob circle animation
		$('.knob').each(function () {
		   var $this = $(this);
		   var myVal = $this.attr("rel");
		   // alert(myVal);
		   $this.knob({
		    readOnly: true,
		        //fgColor: '#339933',
		        //bgColor: '#eee'
		   });
		   $({
		       value: 0
		   }).animate({
		       value: myVal
		   }, {
		       duration: 2000,
		       easing: 'swing',
		       step: function () {
		           $this.val(Math.ceil(this.value)).trigger('change');
		       }
		   })
		});
		// knob circle animation
	}
	});
});
/* knoc circle setup */

/* skill bars progress bar animate */
$(window).scroll(function () {
	if($('.bar').isOnScreen())
	{
	    /* skill bars progress bar animate */
		$('.bar').each(function () {   
		 $(this).animate({
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
		/* skill bars progress bar animate */ 
	}
});
/* skill bars progress bar animate */

/* inview 1 time run */
$(window).scroll(function () {
	jQuery('.bar1').one('inview', function (event, visible) {
	    if (visible == true) {
			/* skill bars progress bar animate */
			$('.bar').each(function () {   
			 $(this).animate({
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
			/* skill bars progress bar animate */
	    }
	 });
});
/* inview 1 time run */


// div background animate
$(window).scroll(function () {     
	// div background animate
	var x = $(this).scrollTop();
	// freezze div background
	$('.banner').css('background-position', '0px ' + x +'px');

	// from left to right
	$('.banner').css('background-position', x+'px ' +'0px');

	// from right to left
	$('.banner').css('background-position', -x+'px ' +'0px');

	// from bottom to top
	$('#skills').css('background-position', '0px ' + -x + 'px');

	// move background from top to bottom
	$('.skills1').css('background-position', '0% ' + parseInt(-x / 1) + 'px' + ', 0% ' + parseInt(-x / 1) + 'px, center top');


	/* hide show menu on scroll */
	if ( x > 100 ) {
	$( ".menu" ).addClass( 'menushow' );
	$( ".menu" ).fadeIn("slow");
	$( ".menu" ).animate({opacity: 0.75}, 500);
	} else {
	$( ".menu" ).removeClass( 'menushow' );
	$( ".menu" ).animate({opacity: 1}, 500);
	}
	/* hide show menu on scroll */
});

/* get request */
function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}
/* get request async */
function httpGetAsync(theUrl, callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("GET", theUrl, true); // true for asynchronous 
    xmlHttp.send(null);
}


/* tabs script */
$('#tabs p a').on("click",function(){
	var tab = $(this).parent().parent();
	$("#tabs p a").addClass('tabsoff');	
	$(this).removeClass('tabsoff');
	$(this).addClass('tabson');
	// var t = '#tab-'+$(this).index();	
	$(".tab").css("display","none");
	$(".tab").eq($(this).index()).css("display","inherit");
});


/* accordion script */
$('#accordion h3').on("click",function(){	
	//$('#accordion div').css("display","none");	
	$('#accordion div').slideUp();	
	$('h3').addClass('hidebar');
	$(this).removeClass('hidebar');
	$(this).addClass('showbar');	
	//$('#accordion').children().eq($(this).index()+1).fadeIn(200);
	$('#accordion').children().eq($(this).index()+1).animate({height:"toggle"},200);
});

/* mixitup script */
$('#Container').mixItUp();

});	
</script>


	</head>
<body>

<h1> Tabs java script </h1>

<div id="tabs">
  <p>
  <a>Tab 1</a> <a>Tab 2</a> <a>Tab 3</a> <a>Tab Name</a> 
  </p>
  <div id="tab-1" class="tab">
  <img src="https://www.google.pl/logos/doodles/2016/poland-national-day-2016-4794393929187328-res.png"> Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd. Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego, że wygląda to „zbyt czytelnie” po polsku. Wielu webmasterów i designerów używa Lorem Ipsum jako domyślnego modelu tekstu i wpisanie w internetowej wyszukiwarce ‘lorem ipsum’ spowoduje znalezienie bardzo wielu stron, które wciąż są w budowie. Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).
  </div>
  <div id="tab-2" class="tab">
Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd. Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego, że wygląda to „zbyt czytelnie” po polsku. Wielu webmasterów i designerów używa Lorem Ipsum jako domyślnego modelu tekstu i wpisanie w internetowej wyszukiwarce ‘lorem ipsum’ spowoduje znalezienie bardzo wielu stron, które wciąż są w budowie. Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).
  </div>
  <div id="tab-3" class="tab">
    Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.
    Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.
  </div>
  <div id="tab-4" class="tab">
Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd. Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego, że wygląda to „zbyt czytelnie” po polsku. Wielu webmasterów i designerów używa Lorem Ipsum jako domyślnego modelu tekstu i wpisanie w internetowej wyszukiwarce ‘lorem ipsum’ spowoduje znalezienie bardzo wielu stron, które wciąż są w budowie. Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).
  </div>  
</div>


<h1> Accordion java script </h1>

<div id="accordion">
  <h3>Section 1</h3>
  <div class="show">
	Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd. Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego, że wygląda to „zbyt czytelnie” po polsku. Wielu webmasterów i designerów używa Lorem Ipsum jako domyślnego modelu tekstu i wpisanie w internetowej wyszukiwarce ‘lorem ipsum’ spowoduje znalezienie bardzo wielu stron, które wciąż są w budowie. Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).
  </div>
  <h3>Section 2</h3>
  <div>
    Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
    purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
    velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
    suscipit faucibus urna.
  </div>
  <h3>Section 3</h3>
  <div>
    Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
    Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
    ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
    lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
    <ul>
      <li>List item one</li>
      <li>List item two</li>
      <li>List item three</li>
    </ul>
  </div>
  <h3>Section 4</h3>
  <div>
    Cras dictum. Pellentesque habitant morbi tristique senectus et netus
    et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
    faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
    mauris vel est.
    Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
    inceptos himenaeos.
  </div>
</div>

<h1> Progress skill bar java script </h1>

<div class="box"><div class="bar" data-width="95%" data-txt="HTML5 / CSS3"><span> </span>95% </div></div>
<div class="box"><div class="bar" data-width="55%" data-txt="Android / C#"><span> </span>95% </div></div>
<div class="box"><div class="bar" data-width="35%" data-txt="PHP / MYSQL"><span> </span>95% </div></div>


<h1>Team style 1</h1>

<style type="text/css">
#team{
	margin: 0 auto;	
	max-width: 90%; 
	overflow: hidden;
	box-sizing: border-box
}	
#team .person{
	width: 25%; 
	padding: 10px;	
	float: left;	
	box-sizing: border-box;
	overflow: hidden;
	border: 0px solid #000;
}
#team .person *{
	float: left;padding: 5px; margin: 0px; width: 100%;text-align: center;
}
#team .person .info{
	text-align: justify;
	font-size: 13px;
}
#team .person .social a{
	float: left;width: 25%;color: #fff;background: #000;border: 1px solid #000;transition: all .5s ease-in;
}
#team .person .social a:hover{
	background: #fff; color: #000;box-sizing: border-box;
}
@media screen and (max-width: 768px) {
#team .person{
	width: 50%;
}
}
</style>

<div id="team">
	<div class="person">
	<img src="person1-400x400.png">
	<p><b>Halla Fastero</b></p>
	<small>Account Manager</small>
	<p class="info">Pracuje na stanowisku account managera od 10 lat. Odpowiada za zarządzanie teamem.</p>
	<p class="social">
	<a href="link.com"><i class="fa fa-facebook-official"></i></a>
	<a href="link.com"><i class="fa fa-twitter"></i></a>
	<a href="link.com"><i class="fa fa-pinterest"></i></a>
	<a href="link.com"><i class="fa fa-google-plus"></i></a>
	</p>
	</div>

	<div class="person">
	<img src="person1-400x400.png">
	<p><b>Halla Bingo</b></p>
	<small>Account Manager</small>
	<p class="info">Pracuje na stanowisku account managera od 10 lat. Odpowiada za zarządzanie teamem.</p>
	<p class="social">
	<a href="link.com"><i class="fa fa-facebook-official"></i></a>
	<a href="link.com"><i class="fa fa-twitter"></i></a>
	<a href="link.com"><i class="fa fa-pinterest"></i></a>
	<a href="link.com"><i class="fa fa-google-plus"></i></a>
	</p>
	</div>

	<div class="person">
	<img src="person1-400x400.png">
	<p><b>Halla Buzik</b></p>
	<small>Account Manager</small>
	<p class="info">Pracuje na stanowisku account managera od 10 lat. Odpowiada za zarządzanie teamem.</p>
	<p class="social">
	<a href="link.com"><i class="fa fa-facebook-official"></i></a>
	<a href="link.com"><i class="fa fa-twitter"></i></a>
	<a href="link.com"><i class="fa fa-pinterest"></i></a>
	<a href="link.com"><i class="fa fa-google-plus"></i></a>
	</p>
	</div>

	<div class="person">
	<img src="person1-400x400.png">
	<p><b>Halla Kasione</b></p>
	<small>Account Manager</small>
	<p class="info">Pracuje na stanowisku account managera od 10 lat. Odpowiada za zarządzanie teamem.</p>
	<p class="social">
	<a href="link.com"><i class="fa fa-facebook-official"></i></a>
	<a href="link.com"><i class="fa fa-twitter"></i></a>
	<a href="link.com"><i class="fa fa-pinterest"></i></a>
	<a href="link.com"><i class="fa fa-google-plus"></i></a>
	</p>
	</div>
</div>	



<h1>Team style 2</h1>

<style type="text/css">
#team{
	margin: 0 auto;	
	max-width: 90%; 
	overflow: hidden;
	box-sizing: border-box
}	
#team .person1{
	width: 25%; 
	padding: 10px;	
	float: left;	
	box-sizing: border-box;
	overflow: hidden;
	border: 0px solid #000;
}
#team .person1 *{
	float: left;padding: 5px; margin: 0px; width: 100%;text-align: center;
}
#team .person1 .info{
	text-align: justify;
	font-size: 13px;
}
#team .person1 .social{
	width: 20%;
}
#team .person1 img{
	width: 80%;
}
#team .person1 .social a{
	float: left;width: 100%;color: #fff;background: #000;border: 1px solid #000;transition: all .5s;
}
#team .person1 .social a:hover{
	background: #fff; color: #000;box-sizing: border-box;
}
@media screen and (max-width: 768px) {
#team .person1{
	width: 50%;
}
}
</style>

<div id="team">
	<div class="person1">
	<p class="social">
	<a href="link.com"><i class="fa fa-facebook-official"></i></a>
	<a href="link.com"><i class="fa fa-twitter"></i></a>
	<a href="link.com"><i class="fa fa-pinterest"></i></a>
	<a href="link.com"><i class="fa fa-google-plus"></i></a>
	</p>
	<img src="person1-400x400.png">
	<p><b>Halla Fastero</b></p>
	<small>Account Manager</small>
	<p class="info">Pracuje na stanowisku account managera od 10 lat. Odpowiada za zarządzanie teamem.</p>
	</div>
	<div class="person1">
	<p class="social">
	<a href="link.com"><i class="fa fa-facebook-official"></i></a>
	<a href="link.com"><i class="fa fa-twitter"></i></a>
	<a href="link.com"><i class="fa fa-pinterest"></i></a>
	<a href="link.com"><i class="fa fa-google-plus"></i></a>
	</p>
	<img src="person1-400x400.png">
	<p><b>Halla Fastero</b></p>
	<small>Account Manager</small>
	<p class="info">Pracuje na stanowisku account managera od 10 lat. Odpowiada za zarządzanie teamem.</p>
	</div>	<div class="person1">
	<p class="social">
	<a href="link.com"><i class="fa fa-facebook-official"></i></a>
	<a href="link.com"><i class="fa fa-twitter"></i></a>
	<a href="link.com"><i class="fa fa-pinterest"></i></a>
	<a href="link.com"><i class="fa fa-google-plus"></i></a>
	</p>
	<img src="person1-400x400.png">
	<p><b>Halla Fastero</b></p>
	<small>Account Manager</small>
	<p class="info">Pracuje na stanowisku account managera od 10 lat. Odpowiada za zarządzanie teamem.</p>
	</div>	<div class="person1">
	<p class="social">
	<a href="link.com"><i class="fa fa-facebook-official"></i></a>
	<a href="link.com"><i class="fa fa-twitter"></i></a>
	<a href="link.com"><i class="fa fa-pinterest"></i></a>
	<a href="link.com"><i class="fa fa-google-plus"></i></a>
	</p>
	<img src="person1-400x400.png">
	<p><b>Halla Fastero</b></p>
	<small>Account Manager</small>
	<p class="info">Pracuje na stanowisku account managera od 10 lat. Odpowiada za zarządzanie teamem.</p>
	</div>	
</div>	

<!-- pricing list 3 -->
<style type="text/css">
#pricing{
	float: left;
	width: 100%;
	margin-top: 60px;
	margin-bottom: 50px;
	box-sizing: border-box;
}
.ptab{
	position: relative;
	float: left;
	width: 28.33%;
	margin-left: 2.5%;
	margin-right: 2.5%;
	box-sizing: border-box;
	border: 1px solid #000;
}
.ptab *{ text-align: center; padding: 10px;}
.ptab i{
	background: #000; color: #fff; padding: 10px 20px 10px 20px;
}
.ptab h3{font-size: 25px; font-weight: bold}
.ptab h5{font-size: 29px;font-weight: bold; text-align: center; min-width: 100%; transition: all .8s}
.ptab h6 a{font-size: 20px; width: 100%; background: #000; color: #fff; float: left;padding: 20px;text-decoration: none;}
.ptab h2{position: absolute; left: 0px; top: -50px; text-align: center; background: #000; color: #fff; height: 50px; border: 1px solid #000; min-width: 100%;}
.ptab h6:hover h5{color: #ff6600 !important;}
</style>
<h1>Pricing table 3</h1>
<div id="pricing">
	<div class="ptab">
		<p><i class="fa fa-diamond" aria-hidden="true"></i></p>
		<h3>DIAMOND</h3>
		<p>10 Users</p>
		<p>Free Setup</p>
		<p>10GB Storage</p>
		<p>API Integration</p>
		<h5 class="hvr-pulse-grow">97.00€</h5>
		<h6><a href="" class="hvr-bounce-to-bottom">KUP</a></h6>
	</div>

	<div class="ptab">
		<h2> Best For you </h2>
		<p><i class="fa fa-star" aria-hidden="true"></i></p>
		<h3>STAR</h3>
		<p>50 Users</p>
		<p>Free Setup</p>
		<p>100GB Storage</p>
		<p>API Integration</p>
		<h5 class="hvr-pulse-grow">187.00€</h5>
		<h6><a href="" class="hvr-bounce-to-bottom">KUP</a></h6>
	</div>

	<div class="ptab">
		<p><i class="fa fa-rocket" aria-hidden="true"></i></p>
		<h3>ROCKET</h3>
		<p>100 Users</p>
		<p>Free Setup</p>
		<p>1TB Storage</p>
		<p>API Integration</p>
		<h5 class="hvr-pulse-grow">321.00€</h5>
		<h6><a href="" class="hvr-bounce-to-bottom">KUP</a></h6>
	</div>
</div>


<!-- pricing list 4 -->
<style type="text/css">
#pricing{
	float: left;
	width: 100%;
	margin-top: 60px;
	margin-bottom: 50px;
	box-sizing: border-box;
}
.ptab4{
	position: relative;
	float: left;
	width: 20%;
	margin-left: 2.5%;
	margin-right: 2.5%;
	margin-bottom: 50px;
	box-sizing: border-box;
	border: 1px solid #000;
}
.ptab4 *{ text-align: center; padding: 10px;}
.ptab4 i{
	background: #000; color: #fff; padding: 10px 20px 10px 20px;
}
.ptab4 h3{font-size: 25px; font-weight: bold}
.ptab4 h5{font-size: 29px;font-weight: bold; text-align: center; min-width: 100%; transition: all .8s}
.ptab4 h6 a{font-size: 20px; width: 100%; background: #000; color: #fff; float: left;padding: 20px;text-decoration: none;}
.ptab4 h2{position: absolute; left: 0px; top: -50px; text-align: center; background: #000; color: #fff; height: 50px; border: 1px solid #000; min-width: 100%;}
@media (max-width: 1024px) {
.ptab4{
	width: 45%;
	margin-left: 2.5%;
	margin-right: 2.5%;	
}  
}
.ptab4 h6:hover h5{color: #ff6600 !important;}
</style>
<h1>Pricing table 4</h1>
<div id="pricing">
	<div class="ptab4">
		<p><i class="fa fa-diamond" aria-hidden="true"></i></p>
		<h3>DIAMOND</h3>
		<p>10 Users</p>
		<p>Free Setup</p>
		<p>10GB Storage</p>
		<p>API Integration</p>
		<h5 class="hvr-pulse-grow">97.00€</h5>
		<h6><a href="" class="hvr-bounce-to-bottom">KUP</a></h6>
	</div>

	<div class="ptab4">
		<h2> NA START </h2>
		<p><i class="fa fa-star" aria-hidden="true"></i></p>
		<h3>STAR</h3>
		<p>50 Users</p>
		<p>Free Setup</p>
		<p>100GB Storage</p>
		<p>API Integration</p>
		<h5 class="hvr-pulse-grow">187.00€</h5>
		<h6><a href="" class="hvr-bounce-to-bottom">KUP</a></h6>
	</div>

	<div class="ptab4">
		<p><i class="fa fa-rocket" aria-hidden="true"></i></p>
		<h3>ROCKET</h3>
		<p>100 Users</p>
		<p>Free Setup</p>
		<p>1TB Storage</p>
		<p>API Integration</p>
		<h5 class="hvr-pulse-grow">321.00€</h5>
		<h6><a href="" class="hvr-bounce-to-bottom">KUP</a></h6>
	</div>
	<div class="ptab4">
		<p><i class="fa fa-flash" aria-hidden="true"></i></p>
		<h3>FLASH</h3>
		<p>Unlimited Users</p>
		<p>Free Setup</p>
		<p>5TB Storage</p>
		<p>API Integration</p>
		<h5 class="hvr-pulse-grow">999.00€</h5>
		<h6><a href="" class="hvr-bounce-to-bottom">KUP</a></h6>
	</div>	
</div>



<!-- info box -->
<style type="text/css">
#infobox{
	float: left;
	width: 100%;
	margin-top: 60px;
	margin-bottom: 50px;
	box-sizing: border-box;
}
.pinfo{
	position: relative;
	float: left;
	width: 20%;
	margin-left: 2.5%;
	margin-right: 2.5%;
	margin-bottom: 50px;
	box-sizing: border-box;
	border: 1px solid #000;
}
.pinfo *{ text-align: center; padding: 10px; text-align: justify; text-justify: inter-word; font-size: 13px;}
.pinfo i{ background: #000; color: #fff; padding: 10px 20px 10px 20px; font-size: 19px;}
.pinfo h3{font-size: 25px; font-weight: bold}
@media (max-width: 1024px) {
.pinfo{	width: 45%;	margin-left: 2.5%;	margin-right: 2.5%;	}  
}
.ptab4 h6:hover h5{color: #ff6600 !important;}
</style>
<h1>Info box</h1>
<div id="infobox">
	<div class="pinfo">
		<p><i class="fa fa-code" aria-hidden="true"></i></p>
		<h3>CODE</h3>
		<p>
			Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd. Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego, że wygląda to „zbyt czytelnie” po polsku. Wielu webmasterów i designerów używa Lorem Ipsum jako domyślnego modelu tekstu
		</p>
	</div>
	<div class="pinfo">
		<p><i class="fa fa-html5" aria-hidden="true"></i></p>
		<h3>HTML5</h3>
		<p>
			Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd. Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego, że wygląda to „zbyt czytelnie” po polsku. Wielu webmasterów i designerów używa Lorem Ipsum jako domyślnego modelu tekstu
		</p>
	</div>
	<div class="pinfo">
		<p><i class="fa fa-css3" aria-hidden="true"></i></p>
		<h3>CSS3</h3>
		<p>
			Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd. Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego, że wygląda to „zbyt czytelnie” po polsku. Wielu webmasterów i designerów używa Lorem Ipsum jako domyślnego modelu tekstu
		</p>
	</div>
	<div class="pinfo">
		<p><i class="fa fa-heart" aria-hidden="true"></i></p>
		<h3>WEB DEV</h3>
		<p>
			Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd. Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego, że wygląda to „zbyt czytelnie” po polsku. Wielu webmasterów i designerów używa Lorem Ipsum jako domyślnego modelu tekstu
		</p>
	</div>	
</div>

<!-- circle knob -->
<h1>Knob circle</h1>
<style type="text/css">
.knobs{
	list-style: none;
}
  .knob{
  	color: #000;
    min-width: 100px !important;
    max-width: 100px !important;    
    font-size: 33px !important;
    box-shadow: none !important;
  }
  .col3knob{
    float: left;
    min-width: 33%;
    max-width: 33%;
    text-align: center;
    margin-bottom: 25px;
    font-size: 17px !important;    
  }
  .col3knob .txt{
    font-size: 27px !important;
    margin: 20px;
    font-weight: bold;
  }
@media screen and (max-width: 768px) {
.knobs .col3knob{
	min-width: 100% !important;
}
}  
</style>
<ul class="knobs">    
    <li class="col3knob">      
      <p class="txt"> Html5/CSS3 </p> 
      <p> <input class="knob animated" value="0" rel="95" data-bgColor="#eee" data-fgColor="#000" data-thickness=".2" data-min="0"> </p>
    </li>
    <li class="col3knob">      
      <p class="txt"> Php/Mysql </p> 
      <p> <input class="knob  animated" value="0" rel="91" data-bgColor="#eee" data-fgColor="#000" data-thickness=".2" data-min="0"> </p>
    </li>
    <li class="col3knob">      
      <p class="txt"> E-Commerce </p> 
      <p> <input class="knob  animated" value="0" rel="79" data-bgColor="#eee" data-fgColor="#000" data-thickness=".2" data-min="0"> </p>
    </li>    
</ul> 


<!-- owl carousel -->
<h1>Image slider</h1>
<style type="text/css">
    #owl-demo .item{
      margin: 3px;
    }
    #owl-demo .item img{
      display: block;
      width: 100%;
      height: auto;
    }
    .owl-next, .owl-prev{
    	background: #000 !important;
    	content: '>' !important;
    }	
	.customNavigation{
	  text-align: center;
	  margin: 10px;
	}
	.customNavigation .btnprev, .btnnext{
	  background: #000;color: #fff;padding: 5px 10px 5px 10px;text-align: center;vertical-align: middle;cursor: pointer;
	  -webkit-user-select: none;
	  -khtml-user-select: none;
	  -moz-user-select: none;
	  -ms-user-select: none;
	  user-select: none;
	  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	  overflow: hidden;box-sizing: border-box;
	}    
</style>
<div id="owl-demo" class="owl-carousel">
<div class="item"><img class="lazyOwl" data-src="assets/owl1.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl2.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl3.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl4.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl5.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl6.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl7.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl8.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl1.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl2.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl3.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl4.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl5.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl6.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl7.jpg" alt="Lazy Owl Image"></div>
<div class="item"><img class="lazyOwl" data-src="assets/owl8.jpg" alt="Lazy Owl Image"></div>
</div>
<div class="customNavigation">
  <a class="btnprev"><</a>
  <a class="btnnext">></a>
</div>


<!-- gallery scripts -->
<h1>Gallery mix</h1>
<style type="text/css">
#Container{
	float: left;
	width: 100%;
	margin: 0px; padding: 0px;
	box-sizing: border-box;
	margin-top: 10px;
	overflow: hidden;
}
#Container .mix{
	float: left;
    display: none;
    border: 0px solid #000;
    box-sizing: border-box;
    overflow: hidden;
}
#Container div{
	position: relative;
	margin: 0px; padding: 0px;
	width: 25%; height: 250px; box-sizing: border-box;
	overflow: hidden;
}
#Container div p{
	float: left;
	position: absolute; top: 0px; left: 0px;	
	width: 0px;
	height: 0px;
	opacity: .8;
	background: #000;
	color: #fff;
	transition: all .5s;
	z-index: 9;
	overflow: hidden;
}
#Container div:hover p{
width: 100%; height: 100%; display: inherit;
}
#Container div p a{
	padding: 10px;
	background: #393;
	color: #fff;
	text-align: center;	
	text-decoration: none;
	position: absolute;         
	top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
    transition: all .5s;
}
#Container div p a:hover{
	background: #f60;
}
#Container img{
	padding: 1px;
	float: left; width: 100%; height: 100%; box-sizing: border-box;	
	transition: all 1s ease;	
	z-index: 1;
}
#Container img:hover{
cursor: pointer;
width: 150%; height: 150%;
}
#ContainerBtn{
	margin: 0 auto;
	text-align: center;
}
#ContainerBtn button.filter{
	cursor: pointer;
	padding: 10px;
	border: 1px solid #000;	
	background: #fff;
}
#ContainerBtn button.filter:hover{
	background: #000; color: #fff;
}
@media all and (max-width: 768px){
#Container div{
	margin: 0px; padding: 0px;
	width: 50%; height: 250px; box-sizing: border-box;
}	
}

button {
  border: 0;
  background: #000;
  border-radius: 4px;
  box-shadow: 0 5px 0 #111;
  color: #000;
  cursor: pointer;
  font: inherit;
  margin: 0;
  outline: 0;
  padding: 12px 20px;
  transition: all .1s linear;
}
button:active {
  box-shadow: 0 2px 0 #111;
  transform: translateY(3px);
}
</style>

<div id="ContainerBtn">
<button class="filter" data-filter=".mix">All</button>
<button class="filter" data-filter=".category-1">Dziewczyny</button>
<button class="filter" data-filter=".category-2">Samochody</button>
</div>
<div id="Container">
    <div class="mix category-1" data-my-order="1"> <p> <a href="link.com" class="hvr-bounce-to-right"> SHOW </a> </p> <img src="http://pop.h-cdn.co/assets/cm/15/05/54cb1d27a519c_-_analog-sports-cars-01-1013-de.jpg">  </div>
    <div class="mix category-1" data-my-order="2"> <p> <a href="link.com" class="hvr-bounce-to-right"> SHOW </a> </p> <img src="https://portal.restomontreal.ca/hooters/gallery/images/09_hooters-4145.jpg"> </div>
    <div class="mix category-2" data-my-order="3"> <p> <a href="link.com" class="hvr-bounce-to-right"> SHOW </a> </p> <img src="http://blog.caranddriver.com/wp-content/uploads/2015/11/Chevrolet-Corvette1.jpg"> </div>
    <div class="mix category-2" data-my-order="4"> <p> <a href="link.com" class="hvr-bounce-to-right"> SHOW </a> </p> <img src="https://static.pexels.com/photos/24353/pexels-photo.jpg"> </div>
    <div class="mix category-1" data-my-order="5"> <p> <a href="link.com" class="hvr-bounce-to-right"> SHOW </a> </p> <img src="http://pop.h-cdn.co/assets/cm/15/05/54cb1d27a519c_-_analog-sports-cars-01-1013-de.jpg"> </div>
    <div class="mix category-1" data-my-order="6"> <p> <a href="link.com" class="hvr-bounce-to-right"> SHOW </a> </p> <img src="https://portal.restomontreal.ca/hooters/gallery/images/09_hooters-4145.jpg"> </div>
    <div class="mix category-2" data-my-order="7"> <p> <a href="link.com" class="hvr-bounce-to-right"> SHOW </a> </p> <img src="http://blog.caranddriver.com/wp-content/uploads/2015/11/Chevrolet-Corvette1.jpg"> </div>
    <div class="mix category-2" data-my-order="8"> <p> <a href="link.com" class="hvr-bounce-to-right"> SHOW </a> </p> <img src="https://static.pexels.com/photos/24353/pexels-photo.jpg"> </div>    
</div>



<!--
<h1>Card flip</h1>
<style type="text/css">
.card-container {
  position: relative;
  cursor: pointer;
  height: 250px;
  width: 250px;
  overflow: hidden;
  border: 1px solid #000;
  float: left;
  box-sizing: border-box;
}
.card {
	top: 0px; left: 0px;
  height: 100%;
  position: absolute;
  transform-style: preserve-3d;
  transition: all 1s ease-in-out;
  width: 100%;
}
.card:hover {
  transform: rotateY(180deg);
}
.card .side {
  backface-visibility: hidden;
  border-radius: 6px;
  height: 100%;
  position: absolute;
  overflow: hidden;
  width: 100%;
}
.card .back {
  background: #eaeaed;
  color: #0087cc;
  line-height: 150px;
  text-align: center;
  transform: rotateY(180deg);
}	
</style>
<div class="card-container">
  <div class="card">
    <div class="side"><img src="https://portal.restomontreal.ca/hooters/gallery/images/09_hooters-4145.jpg" alt="Jimmy Eat World"></div>
    <div class="side back">Jimmy Eat World</div>
  </div>
</div>
-->


<!-- brick by brick masonry -->
<h1>Masonry grid</h1>
<style type="text/css">
.single-column .b-by-b-item {
  width: 100%!important;
  padding: 0px !important;
  margin: 5px !important;
}
#layout div img{
	float: left;width: 100%; height: 100%; overflow: hidden;padding: 0px;margin: 0px; transition: all .5s ease-out
}
#layout div img:hover{
	cursor: pointer;
	width: 150%; height: 150%;
}

@media (min-width: 0px) and (max-width: 480px) {
  #layout .b-by-b-item {
    width: 100%;    
  }
}
@media (min-width: 481px) and (max-width: 1024px) {
  #layout .b-by-b-item {
    width: 50%;    
  }
}
@media (min-width: 1025px) {
  #layout .b-by-b-item {
    width: 33.33%;    
  }
}
#layout > div > *{
	padding: 0px !important;
	margin: 0px; !important;
	overflow: hidden;
}
.b-by-b-item {
background: #fff;
border: 0px solid #000;
}	
</style>
<div id="layout">
    <div><img src="http://pop.h-cdn.co/assets/cm/15/05/54cb1d27a519c_-_analog-sports-cars-01-1013-de.jpg"></div>
    <div><img src="https://static.pexels.com/photos/24353/pexels-photo.jpg"> </div>
    <div> <img src="http://pop.h-cdn.co/assets/cm/15/05/54cb1d27a519c_-_analog-sports-cars-01-1013-de.jpg"> </div>
    <div><img src="https://static.pexels.com/photos/24353/pexels-photo.jpg"> </div>    
    <div><img src="https://static.pexels.com/photos/24353/pexels-photo.jpg"> </div>
    <div> <img src="http://pop.h-cdn.co/assets/cm/15/05/54cb1d27a519c_-_analog-sports-cars-01-1013-de.jpg"> </div>
    <div><img src="https://static.pexels.com/photos/24353/pexels-photo.jpg"> </div>    
    <div><img src="https://static.pexels.com/photos/24353/pexels-photo.jpg"> </div>
    <div> <img src="http://pop.h-cdn.co/assets/cm/15/05/54cb1d27a519c_-_analog-sports-cars-01-1013-de.jpg"> </div>
    <div><img src="https://static.pexels.com/photos/24353/pexels-photo.jpg"> </div>   
    <div>Suspendisse quis dapibus tortor, ut tincidunt sem. Vivamus ornare mattis orci sit amet rutrum. Mauris ultricies magna quis diam laoreet commodo. Nullam tellus nisi, maximus at condimentum in, pharetra non metus. Donec nibh lacus, pretium non sollicitudin ac, porta nec est. Nulla laoreet risus semper felis posuere volutpat. Morbi commodo libero enim, nec dictum dolor tempor convallis. Nulla magna sem, varius eget ornare ut, finibus a enim.</div> 
 </div>




<!-- slide up arrow font awesome icons -->
<style type="text/css">
.up{
  position: fixed;
  bottom: 0px;
  right: 0px;
  max-width: 90px;
  background: #000;
  color: #fff;
  padding: 10px;
  margin: 2px;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease 0s;
  border: 1px solid transparent;
  box-shadow: 0 2px 5px #444;
  z-index: 9999;
}
.up:hover{
  background-color: #fff;
  color: #000;
  border: 1px solid #000;
}	
</style>
<div class="up"><i class="fa fa-arrow-up"></i></div>

</body>
</html>