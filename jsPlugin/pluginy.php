<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Plugin test page</title>
	<meta charset="utf-8">
	
	<script src="js/jquery.js"></script>
	<script src="js/inview.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">


	<style type="text/css">
	html{
		min-height: 1200px;
	}
	h1{
		margin-left: 20px;
	}

	/* Tabs style */
	*{
		font-family: Tahoma;
		margin: 0px;
		padding: 0px;
		box-sizing: border-box;
	}
	#tabs{max-width: 100%; padding: 5px; margin: 10px;}
	#tabs p{margin: 10px 0px 10px 0px; }
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

	/* accordion */
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
	.showbar{
		background: #000 !important;
		color: #fff !important;
	}
	.hidebar{
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


jQuery('.bar').one('inview', function (event, visible) {
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

/* get request */
function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}
/* get request */
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
    Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. <img src="https://www.google.pl/logos/doodles/2016/poland-national-day-2016-4794393929187328-res.png"> Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.
  </div>
  <div id="tab-2" class="tab">
    Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.
    <img src="https://www.google.pl/logos/doodles/2016/poland-national-day-2016-4794393929187328-res.png">
  </div>
  <div id="tab-3" class="tab">
    Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.
    Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.
  </div>
  <div id="tab-4" class="tab">
    Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. t.
  </div>  
</div>


<h1> Accordion java script </h1>

<div id="accordion">
  <h3>Section 1</h3>
  <div class="show">
    Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
    ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
    amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
    odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
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

</body>
</html>
