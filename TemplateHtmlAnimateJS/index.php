<?php
// $items = glob("img/thumb/*.{jpg,png,gif}", GLOB_BRACE)
// usort($items, create_function('$a,$b', 'return filemtime($a) - filemtime($b);'));
// name
// array_multisort(array_map('filemtime', $items), SORT_NUMERIC, SORT_DESC, $items);
// by name
// usort($items, function($a, $b) {return strcmp($b, $a);});
?>
<html lang="pl">
<head>
	<title>TemplateHtmlAnimateJS</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
	<meta name="description" content="">
    <meta name="keywords" content="menu, jedzenie online,jedzenie z dowozem,jedzenie na wynos,pizza,kebab,sushi,obiady domowe,menu online,menuonline,naleśniki,kawiarnie,restauracje,pizza online" />

  <!-- CSS animation -->
  <link rel="stylesheet" type="text/css" href="animate.css">
  <!-- font awesom -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

  <!-- jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>

  <!-- my scripts -->  
	<script src="main.js"></script>


	<script type="text/javascript">
	$(document).ready(function(){
		$(".profilsmall").click(function (){		
			$("#showit").css('display', 'inherit');
		});
   	});
	</script>

  

<style type="text/css">
@font-face {
  font-family: "Open Sans";
  font-style: normal;
  font-weight: 300;
  src: local("Open Sans Light"), local("OpenSans-Light"), url("https://fonts.gstatic.com/s/opensans/v13/DXI1ORHCpsQm3Vp6mXoaTegdm0LZdjqr5-oayXSOefg.woff2") format("woff2");
}
@font-face {
  font-family: "Open Sans";
  font-style: normal;
  font-weight: 400;
  src: local("Open Sans"), local("OpenSans"), url("https://fonts.gstatic.com/s/opensans/v13/cJZKeOuBrn4kERxqtaUH3VtXRa8TVwTICgirnJhmVJw.woff2") format("woff2");
}
@font-face {
  font-family: "Open Sans";
  font-style: normal;
  font-weight: 800;
  src: local("Open Sans Extrabold"), local("OpenSans-Extrabold"), url("https://fonts.gstatic.com/s/opensans/v13/EInbV5DfGHOiMmvb1Xr-hugdm0LZdjqr5-oayXSOefg.woff2") format("woff2");
}

*{
font-family: "Open Sans",sans-serif;
box-sizing: border-box;  
}
html,body{
	min-height: 1500px;
  font-size: 13px;
  font-family:sans-serif;
  -ms-text-size-adjust:100%;
  -webkit-text-size-adjust:100%;
  margin:0;
}
h3{
  color: #f26621;
	text-align: center;	
	font-weight: 800;
}
h3 span {
    width: 20%;
    background: #f26621 none repeat scroll 0% 0%;
    height: 1px;
    display: inline-block;
    vertical-align: middle;
}

span.first {
    margin-right: 1em;
}

span.second {
    margin-left: 1em;
}

label{
	display: none;
	background: #0099cc;
	padding: 5px;
	text-align: center;
	vertical-align: middle;
}
.show{
	padding: 10px;
	background-color: #eee;
  transition: all 0.5s ease;
}
.show:hover label{
	display: inherit;
}

.scrollup{
    width: 40px;
    height: 40px;
    position: fixed;
    bottom: 50px;
    right: 100px;
    display: none;
    text-indent: -9999px;
    background: url('img/to-top.png') no-repeat;
    background-color: #000;
}

.my-navbar{
	min-width: 100%;
	height: 100px;
	display: block;
	position: fixed;
	background-color: #999;
	overflow: hidden;
	transition: all 0.4s ease;
}

header{
  position: fixed;
  width: 100%;
  text-align: center;
  font-size: 32px;
  line-height: 108px;
  height: 208px;
  background: #335C7D;
  color: #fff;
  font-family: 'PT Sans', sans-serif;
  overflow: hidden;
  transition: all 0.4s ease;
  z-index: 999;
}
header.sticky {
  font-size: 14px;
  line-height: 48px;
  height: 88px;
  background: #efc47D;
  text-align: left;
  padding-left: 20px;
}

.header {
    background-color: #FFF;
    box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.22);
    height: 54px;
    position: fixed;
    transition: opacity 1s ease 0s;
    width: 100%;
    z-index: 671;
}
.UserButton {
    background: #F5F5F5 linear-gradient(#FFF, #F5F5F5) repeat scroll 0% 0%;
    border: 1px solid #D4D4D4;
    border-radius: 6px 0px 0px 6px;
    box-sizing: border-box;
    color: #818181;
    cursor: pointer;
    display: inline-block;
    height: 34px;
    outline: medium none;
    padding: 0px;
    position: relative;
    text-align: left;
    z-index: 104;
}
.UserButton:hover {
    background: transparent linear-gradient(#FFF, #EEE) repeat scroll 0% 0%;
    border-color: #C0C0C0;
    border-radius: 6px 0px 0px 6px;
    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.07);
    z-index: 105;
}
:focus {
    outline: 1px auto #D1D1D1;
}
.text{
line-height: normal;  
vertical-align: middle;
white-space: inherit;
text-indent: 0px;  
font-size: 100%;
cursor: pointer;
}
.button{
padding-block-start: 0px;
padding-inline-end: 6px;
padding-block-end: 0px;
padding-inline-start: 6px;
}
.shadow{
  box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.1), 0px 1px 0px 0px rgba(0, 0, 0, 0.1);
}
.pin{
color: #fff;  
background-image: linear-gradient(#E63D44, #C11A22);
box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.22);
border: 1px solid #920C12;
border-color: #AF151B #9A1015 #820A0F;
//background: #B7071B none repeat scroll 0% 0%;
outline: medium none;
}
.pin1 {
background-image: none;
border: 0px none;
border-radius: 4px;
box-shadow: none;
border: 1px solid rgba(0, 0, 0, 0.3);
box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05);
color: #555;
height: 30px;
text-shadow: none;
background-color: #FFF;
font-size: 14px;
opacity: 0.97;
background-clip: padding-box;
outline: medium none;
}
.pin2 {
background: #F0F0F0 linear-gradient(#FFF, #F0F0F0) repeat scroll 0% 0%;
border: 1px solid #CCC;
color: #5F5F5F;
font-weight: bold;
text-shadow: 0px 1px #FFF;
white-space: nowrap;
cursor: pointer;
padding: 7px 13px;
background-clip: padding-box;
outline: medium none;
}
.pin3, :hover, :focus, :active, :visited, :link {
background-image: linear-gradient(#E3262E, #AB171E);
background-color: #AB171E;
border-color: #AF151B #9A1015 #820A0F;
border-style: solid;
border-width: 1px;
box-shadow: 0px 1px 0px 0px rgba(255, 255, 255, 0.34);
color: #FFF;
text-shadow: 0px -1px rgba(0, 0, 0, 0.11);
padding: 5px;
}

.box {
    padding: 0px;
    margin: 5px;
    min-width: 90% !important;
    float: left;
    border: 1px solid #F26621;
    border-radius: 5px;
    background: #EEE none repeat scroll 0% 0%;
}
.bar {
    position: relative !important;
    float: left;
    border-radius: 5px;
    height: 20px;
    text-align: right;
    min-width: 0%;
    max-width: 95%;
    background: transparent url("https://fxstar.eu/img/stripe-orange.png") repeat scroll 0% 0%;
    margin: 0px;
    padding: 7px 2px 2px;
    opacity: 0.9;
    font-size: 13px;
    display: inline;
    white-space: nowrap;
}

#skills {
    background: #EEE url("https://fxstar.eu/img/bg1a.png") repeat scroll left top;
    min-height: 700px;
    max-width: 100%;
    overflow: hidden;
    color: #FFF;
    height: auto;
}

.menu {
    position: fixed;
    background: #F16621 url("img/top.png-") repeat scroll 0% 0%;
    color: #000;
    width: 100%;
    height: 50px;
    z-index: 9999;
    transition: all 0.3s ease-in-out 0s;
}
.menushow {
    z-index: 9999;
    width: 100%;    
    left: 0px;
    top: 0px;   
    height: 10px; 
    line-height: 48px;
    transition: all 0.3s ease-in-out 0s;
}

.logo {
    padding: 5px;
    max-width: 150px;
    border-radius: 10px;
}

.btn {
    background-color: #F5F8FA;
    background-image: linear-gradient(#FFF, #F5F8FA);
}
.btn {
    background-color: #CCD6DD;
    background-repeat: no-repeat;
    border: 1px solid #E1E8ED;
    border-radius: 4px;
    color: #66757F;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    font-weight: bold;
    line-height: normal;
    padding: 8px 16px;
    position: relative;
}

.avatar {
    position: relative;
    width: 48px;
    height: 48px;
    border-radius: 5px;
    -moz-force-broken-image-icon: 1;
    background: #FFF none repeat scroll 0% 0%;
    box-shadow: 0px 1px 1px rgba(136, 153, 166, 0.15);
}
img {
    border: 0px none;
}

</style>

</head>
<body>

<div class="my-navbar">
	<li>LIST!</li><li>LIST!</li><li>LIST!</li><li>LIST!</li><li>LIST!</li><li>LIST!</li>
</div>


<header><h1>Sticky Header</h1></header>

<div class="menu">
<img src="https://fxstar.eu/img/fxstareulogo2.png" class="logo" alt="fxstar.eu">
<div id="lines" class="menubtn"></div>
</div>

<div style="background: #ff2233; padding: 50px; overflow: hidden;">
	<iframe src="test1.php" scrolling="no" frameborder="0" height="200" width="100%" allowtransparency="true"></iframe>
</div>

<a href="#skills">slide down</a>
<a href="#boom1">slide down</a>

<h3>
<span class="first"></span>
SUPER TEXT
<span class="second"></span>
</h3>

<div class="show">
	<label class="animated fadeInLeftBig">HOVER LABEL</label>
</div>

<button class="pin"><i class="fa fa-coffee" aria-hidden="true"></i> SUPER</button>
<button class="pin1"><i class="fa fa-heart" aria-hidden="true"></i> SUPER</button>
<button class="pin2"><i class="fa fa-comment" aria-hidden="true"></i> SUPER</button>
<button class="pin3"><i class="fa fa-phone" aria-hidden="true"></i> SUPER</button>

<button class="btn">SUPER <i class="fa fa-phone" aria-hidden="true"></i></button>

<div class="box"><div style="width: 10%;" class="bar" data-width="70" data-txt="Android"><span>Android</span>70% </div></div>

<div style="background: #ff9900; height: 1234px;">dffd  </div>
<p id="skills">slide here</p>
<div style="background: #009933; height: 1234px;">dffd  </div>
<p id="boom1">slide here boom 1</p>
<div style="background: #ee9933; height: 1234px;">dffd  </div>
<a href="#" class="scrollup"></a>
</body>
</html>

