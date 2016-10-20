<?php
session_start();
error_reporting(0);
if (empty($_SESSION['folder'])) {
  $_SESSION['folder'] = md5(microtime().$_SERVER['REMOTE_ADDR']);
}
// month start date
date_default_timezone_set('UTC');
$zz = date('m-Y');
$month =  (int)strtotime('01-'.$zz.' 00:00:00');

function week(){
$mnt =  (int)strtotime('01-'.date('m-Y').' 00:00:00');
$day = date('w',$mnt);
return $monday = $mnt - $day * (60 *60 *24);
}


function Connect(){
    $h = 'localhost';
    $u = 'root';
    $j = 'toor';
    $db = 'db';
    mysql_connect($h,$u,$j) or die('[DB_ERROR_LOGIN]');
    mysql_select_db($db) or die('[DB_ERROR]');
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
}

function Connect1(){
    $h = 'sql.stan-invest.nazwa.pl:3307';
    $u = 'stan-invest';
    $j = 'Hp3%g2!Ax';
    $db = 'stan-invest';
    mysql_connect($h,$u,$j) or die('[DB_ERROR_LOGIN]');
    mysql_select_db($db) or die('[DB_ERROR]');
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
}
Connect1();

$keywords = "";
$error = "";

$capcode = htmlentities($_POST['captchacode'],ENT_QUOTES, "UTF-8");

if(isset($_POST['set'])){
  if($_SESSION['cap_code'] == $capcode){
//print_r($_POST);
$cat1 = (int)$_POST['cat1'];
$cat2 = (int)$_POST['cat2'];
$dir = $_SESSION['folder'];
//$cena = htmlentities($_POST['cena'],ENT_QUOTES | ENT_IGNORE, "UTF-8");

// leters and numbers 
// preg_replace("/[^A-Za-z0-9]/", "",$c);

$_POST['pozycja'] = htmlentities($_POST['pozycja'],ENT_QUOTES | ENT_IGNORE, "UTF-8");

$cena1 = (int)$_POST['cena1'];
$cena2 = (int)$_POST['cena2'];
$cena = $cena1.".".$cena2;
$cena = (float)$cena;
$nazwa = htmlentities($_POST['nazwa'],ENT_QUOTES | ENT_IGNORE, "UTF-8");
$opis = htmlentities($_POST['opis'],ENT_QUOTES, "UTF-8");
$adres = htmlentities($_POST['adres'],ENT_QUOTES, "UTF-8");
$str = str_replace("(", "", $_POST['pozycja']);
$str = str_replace(")", "", $str);
$poz = explode(",", $str);
//print_r($poz);
$lat = $poz[0];
$lng = $poz[1];

$name = htmlentities($_POST['name'],ENT_QUOTES, "UTF-8");
$mobile = htmlentities($_POST['mobile'],ENT_QUOTES, "UTF-8");
$mobile = preg_replace("/[^0-9+]/", "",$mobile);
$email = htmlentities($_POST['email'],ENT_QUOTES, "UTF-8");
$time = time();
$ip = $_SERVER['REMOTE_ADDR'];

$res = mysql_query("SELECT name FROM category WHERE cat1 = '$cat1' and cat2 = '$cat2'");
$row1 = mysql_fetch_row($res);

$res = mysql_query("SELECT name FROM category WHERE cat1 = '$cat1'");
$row2 = mysql_fetch_row($res);
$keywords = $row1[0]." ".$row2[0]." ".$_POST['nazwa']." ".$_POST['opis']." ".$_POST['adres']." ".$_POST['name'];
$keywords = htmlentities($keywords, ENT_QUOTES, 'utf-8');

$go = mysql_query("INSERT INTO item (cat1,cat2,dir,cena,nazwa,opis,adres,lat,lng,name,mobile,email,keywords,time,ip) 
             VALUES ('$cat1','$cat2','$dir','$cena','$nazwa','$opis','$adres',$lat,$lng,'$name','$mobile','$email','$keywords',$time,'$ip')");

}else{
$error = '<p style="background: #fff; color: #ff2222; padding: 5px; font-size: 15px; border-bottom: 3px solid #ff2222;"> Wypełnij wszystkie pola i przepisz poprawnie kod z obrazka.</p>';  
}
}
$l = "Location: item.php?id=".$_SESSION['folder'];
if($go == 1){
header($l);
}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>

<!--[if lt IE 9]>
<script type="text/javascript">
window.location = "http://outdatedbrowser.com/pl";
</script>
<![endif] -->

<title>Darmowe ogłoszenia stan-invest.com</title>
<meta charset="utf-8">  
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  
<meta name="keywords" content="przasnysz, stan invest, Darmowe ogłoszenia, ogłoszenia, drobne">
<meta name="description" content="Bezpłatne ogłoszenia drobne. Chcesz coś sprzedać - w prosty sposób dodasz ogłoszenie. Chcesz coś kupić - tutaj znajdziesz ciekawe okazje. Wszystkie ogłoszenia bez konieczności logowania. Ogłoszenia w kategoriach: Samochody, Praca, Nieruchomości, Komputery, Hobby, Muzyka, Moda, Dzieci, Sport, Usługi i inne. Dodaj ogłoszenie już dziś.﻿">
<meta name="author" content="StanInvest">
<meta http-equiv="refresh" content="">

<!-- favicon -->
<link rel="icon" href="favicon.ico">

<!-- mobile settings -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/favicon.ico">

<!-- fonts --> 
<link href="//fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">
<link href='//fonts.googleapis.com/css?family=Roboto:100&subset=latin,latin-ext' rel='stylesheet' type='text/css'>



<!-- js, jquery from file -->
<script src="core/min1.js"></script>
<script src="core/-min2.js"></script>

<script src="core/highstock.js"></script>
<script src="core/exporting.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!--
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
-->
<!-- jquery fron net
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
-->

<!-- jquery google
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
-->

<script type="text/javascript">
  $(document).ready(function(){

    window.addEventListener("beforeunload", function (e) {
    //var confirmationMessage = "\o/";
    //(e || window.event).returnValue = confirmationMessage; //Gecko + IE
    //return confirmationMessage;                            //Webkit, Safari, Chrome
    $.post( "file.html", function( data ) {
      $( ".win" ).html( data );
    });

});

  });
</script>



<!-- stylesheet -->
<link rel="stylesheet" href="core/reset.css" />  
<link rel="stylesheet" href="core/table.css" type="text/css"/> 

<style  type="text/css">

html{background: url('img/stripe.png');}
body{padding: 0px; margin: 0px; font-family: Abel, Arial, Sans-Serif;} 
hr {
    display: block;
    margin-top: 0.2em;
    margin-bottom: 0.2em;
    margin-left: 30px;
    margin-right: 30px;
    border-style: inset;
    border-width: 1px;
    max-width: 70%;
} 

.pasek{
  background: #ff2233; min-height: 3px;
}

.menu{
  background: url('img/-bg.png') #111; color: #fff; height: auto; overflow: hidden; display: none;
}
.menu ul li a{color: #fff;}

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

.top{
  background: #fff; color: #444; min-height: 100px; box-shadow: 0px 0px 0px #999; z-index: 9999;
}

.top .menubtn{
position: relative; float: right;  top: 35px; right: 20px; max-width: 100px;  cursor: pointer;
}

.top .logo{
  position: relative; top: 25px; left: 30px; max-height: 50px; 
}

.banner{
  background: url('img/baner00.jpg') #fff; min-height: 400px; background-position: 50% 0%;
  background-size: 100%;
}

.banner .save{
background: url('img/stripe.png') #fff;
font-size: 40px; text-align: center; font-family: "Abel", sans-serif; font-weight:400;  color: #000; width: auto; padding: 5px; 
width: auto; 
}

.banner .save1{
font-size: 20px; text-align: center; font-family: "Abel", sans-serif; font-weight:400; background: #fdcc90; color: #000; width: auto; padding: 5px; 
width: auto;
}

.users{
  background: #fff; min-height: 400px; width: 100%; height: auto;
  //background: repeating-linear-gradient(  -55deg,  #111,  #222 5px,  #333 5px);
  //box-shadow: 3px 0px 5px #999;
}

.users .title{
 position: relative; font-family: 'Abel', sans-serif; padding-top: 20px; font-size: 20px; text-align: center; color: #222;
 background: url('img/pasek.jpg') #fff no-repeat; background-position: 50% 100%; padding-bottom: 20px;padding-top: 50px; margin-top: 10px;
}


   .user{
      overflow: hidden;
      border: 1px dashed #fff;
      width: 70%;
      min-height: 230px;
      max-height: 310px;
      max-width: 200px;
      text-align: left; 
      margin-bottom: 0px;
      background: url('img/stripe.png') #eee;
      border: 0px dashed #777;
      position: relative;
    }

    .user ul {
      float: right; margin: 0px; padding: 0px; min-width: 100%;
    }
    .user ul li{
      font-family: 'Abel', sans-serif; 
      min-height: auto;
      list-style: none;
      background: #fff; 
      padding: 3px;     
    }

    .user .avatar{
      position: relative;
      background: #fff; max-width: 150px; max-height: 150px;
      overflow: hidden;
      padding: 3px;
      max-height: 200px;
      margin: 20px;      
      box-shadow: 0px 2px 5px #999
      
    }

    .user .name{font-size: 15px; padding-left: 20px; background: #444; color: #fff;}
    .user .profit{font-size: 19px; padding-left: 20px; background: #eee;}

.howto{
  background: #0099cc; min-height: 400px; width: 100%; height: auto;
}

.howto .title{
 position: relative; font-family: 'Abel', sans-serif; padding-top: 55px; font-size: 55px; text-align: center; color: #fff;
}



.zigzag {
    position: relative;
    background: transparent;
}

.zigzag:after {
    background: linear-gradient(-45deg, #fff 16px, transparent 0), linear-gradient(45deg, #fff 16px, transparent 0);
    background-position: left-bottom;
    background-repeat: repeat-x;
    background-size: 32px 32px;
    content: " ";
    display: block;
    position: absolute;
    bottom: 0px;
    left: 0px;
    width: 100%;
    height: 32px;
}



.zigzag1 {
    position: relative;
    background: transparent;
}

.zigzag1:after {
    background: linear-gradient(-45deg, #222 16px, transparent 0), linear-gradient(45deg, #222 16px, transparent 0);
    background-position: left-bottom;
    background-repeat: repeat-x;
    background-size: 32px 32px;
    content: " ";
    display: block;
    position: absolute;
    bottom: 0px;
    left: 0px;
    width: 100%;
    height: 32px;
}

.round{
  border: 5px solid #111;
  border-radius: 500px;
  padding: 20px;
}
.txt{
 font-size: 40px; text-align: center; font-family: "Abel", sans-serif; font-weight:400;  color: #000;
  padding: 35px; font-size: 1.8em
}

#cat{
  background: url('img/stripe.png');
  max-width: 600px;
}
#cat1{
  margin: 20px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  min-width: 550px;

}

.cat1{
  margin: 20px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  min-width: 550px;
max-width: 550px;
}

#cena{
  margin: 20px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  min-width: 262px;
  max-width: 100px;
  float: left;
}
#textarea{
  min-width: 550px; max-width: 550px; min-height: 270px; border-radius: 5px; border: 1px solid #ccc;
}
#szukaj{
  padding: 5px;
  border: 1px solid #444;
  background: #fff;
  border-radius: 5px;
  min-width: 250px;
  cursor: pointer;
}

.add {
  background: #ff2233;
  color: #fff;
  text-decoration: none;
  float: right;
  font-family: Abel;
  padding: 5px;
  top: -1px;
  right: 20px;
  position: relative;  
  font-size: 15px;

}
.add:hover{
  color: #ff2233;
  background: #fff;
  border: 1px solid #ff2233;
  outline: none;
}

.label{
  font-family: Abel;
  color: #fff;
  float: left;
  background: #111;
  margin-left: 20px;
  padding: 5px;
  font-size: 13px;
  max-width: 250px
}

#map_canvas{
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 550px; height:300px; background:url('img/map.png') #fff no-repeat; background-size: 95%;
}

@media (min-width: 481px) and (max-width: 768px) {

  #textarea{
  min-width: 250px; max-width: 250px; min-height: 270px; border-radius: 5px; border: 1px solid #ccc;
}

html{background: url('img/stripe.png');}
body{padding: 0px; margin: 0px;}
hr {
    display: block;
    margin-top: 0.2em;
    margin-bottom: 0.2em;
    margin-left: 30px;
    margin-right: 30px;
    border-style: inset;
    border-width: 1px;
    max-width: 70%;
} 

.pasek{
  background: #ff2233; min-height: 3px;
}

.menu{
  background: url('img/-bg.png') #111; color: #fff; height: auto; overflow: hidden; display: none;
}
.menu ul li a{color: #fff;}

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

.top{
  background: #fff; color: #444; min-height: 100px; box-shadow: 0px 2px 3px #999; z-index: 9999;
}

.top .menubtn{
position: relative; float: right;  top: 35px; right: 20px; max-width: 100px;  cursor: pointer;
}

.top .logo{
  position: relative; top: 25px; left: 30px; max-height: 50px; 
}

.banner{
  background: url('img/baner00.jpg') #fff; min-height: 400px; background-position: 50% 0%;
  background-size: 100%;
}

.banner .save{
background: url('img/stripe.png') #fff;
font-size: 40px; text-align: center; font-family: "Abel", sans-serif; font-weight:400;  color: #000; width: auto; padding: 5px; 
width: auto; 
}

.banner .save1{
font-size: 20px; text-align: center; font-family: "Abel", sans-serif; font-weight:400; background: #fdcc90; color: #000; width: auto; padding: 5px; 
width: auto;
}

.users{
  background: #fff; min-height: 400px; width: 100%; height: auto;
  //background: repeating-linear-gradient(  -55deg,  #111,  #222 5px,  #333 5px);
  //box-shadow: 3px 0px 5px #999;
}

.users .title{
 position: relative; font-family: 'Abel', sans-serif; padding-top: 20px; font-size: 20px; text-align: center; color: #222;
 background: url('img/pasek.jpg') #fff no-repeat; background-position: 50% 100%; padding-bottom: 20px;padding-top: 50px; margin-top: 10px;
}


   .user{
      overflow: hidden;
      border: 1px dashed #fff;
      width: 70%;
      min-height: 230px;
      max-height: 310px;
      max-width: 200px;
      text-align: left; 
      margin-bottom: 0px;
      background: url('img/stripe.png') #eee;
      border: 0px dashed #777;
      position: relative;
    }

    .user ul {
      float: right; margin: 0px; padding: 0px; min-width: 100%;
    }
    .user ul li{
      font-family: 'Abel', sans-serif; 
      min-height: auto;
      list-style: none;
      background: #fff; 
      padding: 3px;     
    }

    .user .avatar{
      position: relative;
      background: #fff; max-width: 150px; max-height: 150px;
      overflow: hidden;
      padding: 3px;
      max-height: 200px;
      margin: 20px;      
      box-shadow: 0px 2px 5px #999
      
    }

    .user .name{font-size: 15px; padding-left: 20px; background: #444; color: #fff;}
    .user .profit{font-size: 19px; padding-left: 20px; background: #eee;}

.howto{
  background: #0099cc; min-height: 400px; width: 100%; height: auto;
}

.howto .title{
 position: relative; font-family: 'Abel', sans-serif; padding-top: 55px; font-size: 55px; text-align: center; color: #fff;
}



.zigzag {
    position: relative;
    background: transparent;
}

.zigzag:after {
    background: linear-gradient(-45deg, #fff 16px, transparent 0), linear-gradient(45deg, #fff 16px, transparent 0);
    background-position: left-bottom;
    background-repeat: repeat-x;
    background-size: 32px 32px;
    content: " ";
    display: block;
    position: absolute;
    bottom: 0px;
    left: 0px;
    width: 100%;
    height: 32px;
}



.zigzag1 {
    position: relative;
    background: transparent;
}

.zigzag1:after {
    background: linear-gradient(-45deg, #222 16px, transparent 0), linear-gradient(45deg, #222 16px, transparent 0);
    background-position: left-bottom;
    background-repeat: repeat-x;
    background-size: 32px 32px;
    content: " ";
    display: block;
    position: absolute;
    bottom: 0px;
    left: 0px;
    width: 100%;
    height: 32px;
}

.round{
  border: 5px solid #111;
  border-radius: 500px;
  padding: 20px;
}
.txt{
 font-size: 40px; text-align: center; font-family: "Abel", sans-serif; font-weight:400;  color: #000;
  padding: 35px; font-size: 1.8em
}

#cat{
  background: url('img/stripe.png');
  max-width: 300px;
}
#cat1{
  margin: 20px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  min-width: 250px;

}

.cat1{
  margin: 20px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  min-width: 250px;
max-width: 250px;
}

#cena{
  margin: 20px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  min-width: 110px;
  max-width: 100px;
  float: left;
}

#szukaj{
  padding: 5px;
  border: 1px solid #444;
  background: #fff;
  border-radius: 5px;
  min-width: 250px;
  cursor: pointer;
}

.add {
  background: #ff2233;
  color: #fff;
  text-decoration: none;
  float: right;
  font-family: Abel;
  padding: 5px;
  top: -1px;
  right: 20px;
  position: relative;  
  font-size: 15px;

}
.add:hover{
  color: #ff2233;
  background: #fff;
  border: 1px solid #ff2233;
  outline: none;
}

.label{
  font-family: Abel;
  color: #fff;
  float: left;
  background: #111;
  margin-left: 20px;
  padding: 5px;
  font-size: 13px;
  max-width: 250px
}

#map_canvas{
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 250px; height:200px; background:url('img/map.png') #fff no-repeat; background-size: 95%;

}

} 



@media (min-width: 1px) and (max-width: 480px) { 
    #textarea{
  min-width: 250px; max-width: 250px; min-height: 270px; border-radius: 5px; border: 1px solid #ccc;
}

html{background: url('img/stripe.png');}
body{padding: 0px; margin: 0px;}
hr {
    display: block;
    margin-top: 0.2em;
    margin-bottom: 0.2em;
    margin-left: 30px;
    margin-right: 30px;
    border-style: inset;
    border-width: 1px;
    max-width: 70%;
} 

.pasek{
  background: #ff2233; min-height: 3px;
}

.menu{
  background: url('img/-bg.png') #111; color: #fff; height: auto; overflow: hidden; display: none;
}
.menu ul li a{color: #fff;}

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

.top{
  background: #fff; color: #444; min-height: 100px; box-shadow: 0px 2px 3px #999; z-index: 9999;
}

.top .menubtn{
position: relative; float: right;  top: 35px; right: 20px; max-width: 100px;  cursor: pointer;
}

.top .logo{
  position: relative; top: 25px; left: 30px; max-height: 50px; 
}

.banner{
  background: url('img/baner00.jpg') #fff; min-height: 400px; background-position: 50% 0%;
  background-size: 100%;
}

.banner .save{
background: url('img/stripe.png') #fff;
font-size: 40px; text-align: center; font-family: "Abel", sans-serif; font-weight:400;  color: #000; width: auto; padding: 5px; 
width: auto; 
}

.banner .save1{
font-size: 20px; text-align: center; font-family: "Abel", sans-serif; font-weight:400; background: #fdcc90; color: #000; width: auto; padding: 5px; 
width: auto;
}

.users{
  background: #fff; min-height: 400px; width: 100%; height: auto;
  //background: repeating-linear-gradient(  -55deg,  #111,  #222 5px,  #333 5px);
  //box-shadow: 3px 0px 5px #999;
}

.users .title{
 position: relative; font-family: 'Abel', sans-serif; padding-top: 20px; font-size: 20px; text-align: center; color: #222;
 background: url('img/pasek.jpg') #fff no-repeat; background-position: 50% 100%; padding-bottom: 20px;padding-top: 50px; margin-top: 10px;
}


   .user{
      overflow: hidden;
      border: 1px dashed #fff;
      width: 70%;
      min-height: 230px;
      max-height: 310px;
      max-width: 200px;
      text-align: left; 
      margin-bottom: 0px;
      background: url('img/stripe.png') #eee;
      border: 0px dashed #777;
      position: relative;
    }

    .user ul {
      float: right; margin: 0px; padding: 0px; min-width: 100%;
    }
    .user ul li{
      font-family: 'Abel', sans-serif; 
      min-height: auto;
      list-style: none;
      background: #fff; 
      padding: 3px;     
    }

    .user .avatar{
      position: relative;
      background: #fff; max-width: 150px; max-height: 150px;
      overflow: hidden;
      padding: 3px;
      max-height: 200px;
      margin: 20px;      
      box-shadow: 0px 2px 5px #999
      
    }

    .user .name{font-size: 15px; padding-left: 20px; background: #444; color: #fff;}
    .user .profit{font-size: 19px; padding-left: 20px; background: #eee;}

.howto{
  background: #0099cc; min-height: 400px; width: 100%; height: auto;
}

.howto .title{
 position: relative; font-family: 'Abel', sans-serif; padding-top: 55px; font-size: 55px; text-align: center; color: #fff;
}



.zigzag {
    position: relative;
    background: transparent;
}

.zigzag:after {
    background: linear-gradient(-45deg, #fff 16px, transparent 0), linear-gradient(45deg, #fff 16px, transparent 0);
    background-position: left-bottom;
    background-repeat: repeat-x;
    background-size: 32px 32px;
    content: " ";
    display: block;
    position: absolute;
    bottom: 0px;
    left: 0px;
    width: 100%;
    height: 32px;
}



.zigzag1 {
    position: relative;
    background: transparent;
}

.zigzag1:after {
    background: linear-gradient(-45deg, #222 16px, transparent 0), linear-gradient(45deg, #222 16px, transparent 0);
    background-position: left-bottom;
    background-repeat: repeat-x;
    background-size: 32px 32px;
    content: " ";
    display: block;
    position: absolute;
    bottom: 0px;
    left: 0px;
    width: 100%;
    height: 32px;
}

.round{
  border: 5px solid #111;
  border-radius: 500px;
  padding: 20px;
}
.txt{
 font-size: 40px; text-align: center; font-family: "Abel", sans-serif; font-weight:400;  color: #000;
  padding: 35px; font-size: 1.8em
}

#cat{
  background: url('img/stripe.png');
  max-width: 300px;
}
#cat1{
  margin: 20px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  min-width: 250px;

}

.cat1{
  margin: 20px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  min-width: 250px;
max-width: 250px;
}

#cena{
  margin: 20px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  min-width: 110px;
  max-width: 100px;
  float: left;
}

#szukaj{
  padding: 5px;
  border: 1px solid #444;
  background: #fff;
  border-radius: 5px;
  min-width: 250px;
  cursor: pointer;
}

.add {
  background: #ff2233;
  color: #fff;
  text-decoration: none;
  float: right;
  font-family: Abel;
  padding: 5px;
  top: -1px;
  right: 20px;
  position: relative;  
  font-size: 15px;

}
.add:hover{
  color: #ff2233;
  background: #fff;
  border: 1px solid #ff2233;
  outline: none;
}

.label{
  font-family: Abel;
  color: #fff;
  float: left;
  background: #111;
  margin-left: 20px;
  padding: 5px;
  font-size: 13px;
  max-width: 250px
}

#map_canvas{
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 250px; height:200px; background:url('img/map.png') #fff no-repeat; background-size: 95%;
}


}


</style>
  <div class="pasek"></div>
</head>
<body>
  
  <div class="menu">
    <ul>
      <li><a href="index.php" title="Welcome"><strong>HOME</strong></a></li>
      <li><a href="login.php" title="Sign In">SIGN IN</a></li>
      <!--
      <li><a href="register.php" title="Sign In">SIGN UP</a></li>
      -->
      <li><a href="contact.php" title="Contact">CONTACT</a></li>
    </ul>
  </div>

  <div class="top"> 
    <a href="index.php"><img src="img/staninvest0.png" width="155" style="position: relative; top: 33px; left: 10px;"></a>
  </div>

  <br>
  <div class="users">  
  <br>
  <p class="title" style="font-family: 'Roboto', Abel, Tahoma; font-weight: 100; ">Dodaj ogłoszenie za darmo</p>


<br><br>
<center>
<div id="cat">
 <?php echo $error; ?>
  
  <script src="js/upload.js"></script>

  <p class="label" >Dodaj zdjęcia (maks. 5 x 5MB)</p>
  <div id="pictures">
    
  </div>
  <form id="uploadimage" action="" method="post" enctype="multipart/form-data">  
  <div id="selectImage">
  <input class="cat1" style="background: #fff; color: #000;" type="file" name="file" id="file" required />
  <div id="image_preview"><img id="previewing" src="img/noimage.png" style="min-width: 260px; max-width: 260px; background: #fff; border: 1px solid #ccc;" /></div>
  <input id="szukaj" type="submit" value="Dodaj zdjęcie" class="submit" />

  </div>
  </form>
  
  <div id="message" class="cat1" style="background: #fff;">
  <?php
  foreach(glob("upload/".$_SESSION['folder']."/*") as $file){        
        if(file_exists($file)) echo '<img style="width: 90px; border: 1px solid #ccc; margin: 5px;" src="'.$file.'"/>';
  }
  ?>

</div>
<br>
</div>
</center>
<br>

<script type="text/javascript">
function IsEmpty(){
  if(document.forms['form'].name.value == "" || document.forms['form'].nazwa.value == "" || document.forms['form'].opis.value == "" || document.forms['form'].adres.value == "" || document.forms['form'].mobile.value == "" || document.forms['form'].email.value == "" )
  {
    alert("Wypełnij wszystkie pola! Pamietaj - ogłoszenia naruszające prawo i niekompletne bedą usuwane!");
    return false;
  }
    return true;
};

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

IsEmpty();
</script>


<form method="post" action="" name="form" onsubmit="return IsEmpty()">
<center>
<div id="cat">
<p class="label">Kategoria*</p>
<select id="cat1" class="getid" name="cat1">
<?php

  echo '<option value="0">Wszystkie</option>';

$res = mysql_query("SELECT * from category where cat1 != '0' and cat2 = '0' ORDER BY name ASC");
$i = 0;
while ($row = mysql_fetch_assoc($res)){
  
  if ($i % 2 == 0) echo '<option style="background: #eee; color: #000; padding: 5px; border-top: 1px dotted #999;" value="'.$row['cat1'].'">'.$row['name'].'</option>';
  if ($i % 2 != 0) echo '<option style="background: #fff; color: #000; padding: 5px; border-top: 1px dotted #999;" value="'.$row['cat1'].'">'.$row['name'].'</option>';

$i++;
}

?>
</select>
<select id="cat1" class="setid" name="cat2">
<option value="0">Wszystkie</option>
</select>
</div>
</center>
<br>

<center>
<div id="cat">

<p class="label">Nazwa(Tytuł)* (maks. 250 znaków)</p>
<input id="cat1" name="nazwa" value="" maxlength="250" placeholder="Nazwa przedmiotu" style="margin: 5px;"/>



<p class="label">Cena* / Wynagrodzenie* (brutto PLN)</p>
<div style="float: left; margin-left: 15px;">
<input id="cena" name="cena1" value="" maxlength="10" placeholder="0 złoty" onkeypress="return isNumber(event)" style="margin: 5px; max-width: 33px;"/>
<input id="cena" name="cena2" value="" maxlength="2" placeholder="0 groszy" onkeypress="return isNumber(event)" size="numeric" style="margin: 5px; max-width: 33px;"/>
</div>




<p class="label">Opis* (maks. 5000 znaków)</p>
<textarea name="opis" maxlength="5000"  id="textarea">Opis</textarea>
<br><br>
</div>
</center>
<br>

<center>
<div id="cat">

<p class="label">Miasto Ulica (ustaw marker) *</p>
<input class="cat1" id="address" type="text" name="adres" value="Polska Warszawa Centrum" onkeyup="addAddress()">
<input id="pozycja" type="text"  name="pozycja" value="52.000,21.000" style="display: none">

<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
    
    <script type="text/javascript">
        var geocoder;
      var map;
      var marker;
      function initialize() {
                    // add mapOptions here to the values in the input boxes.
        var mapOptions = {
          center: new google.maps.LatLng(52.22, 21.000),
          zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP  
        };
        map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
        //geocoder = new google.maps.Geocoder();

          var myLatlng = new google.maps.LatLng(52.220, 21.000);
          marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title: 'Wyszukaj lokalizację (Miasto ulica) !'
        });

      }


        function addAddress() {
        //marker.setPosition(new google.maps.LatLng(22.397, 21.644));
        //marker.setMap(null);      

        geocoder = new google.maps.Geocoder();      
        var address = document.getElementById('address').value; //input box value
        geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

            document.getElementById('pozycja').value = results[0].geometry.location;
            map.setCenter(results[0].geometry.location);            
            marker.setPosition(results[0].geometry.location);  
            map.setZoom(13);
            map.setTilt(45);
        }
        });  


        //alert(address);


      }
      google.maps.event.addDomListener(window, 'load', initialize);

</script>
 
 <div id="map_canvas" ></div>



<p class="label">Podaj swoje imię* (Maks. 250 znaków)</p>
<input id="cat1" name="name" maxlength="250" placeholder="Imię" style="margin: 5px;"/>

<p class="label">Nr. Telefonu* PL(+48 Numer Telefonu)</p>
<input id="cat1" name="mobile" value="+48" style="margin: 5px;"/>

<p class="label">Adres email* (niewidoczny)</p>
<input id="cat1" name="email" class="email" maxlength="250" placeholder="Adres email" style="margin: 5px;"/>

<p class="label">Przepisz tekst z obrazka <img src="captcha.php"/></p>

<input id="cat1" name="captchacode" class="email" maxlength="20" placeholder="Przepisz tekst z obrazka" style="margin: 5px;"/>


<p class="label" style="background: #ff2233; font-size: 11px;">* - pola wymagane</p>
<input id="cat1" name="tytul" value="ok" style="margin: 5px; visibility: hidden;"/>
<br>
<br>
</div>
</center>
<br>
<center>
  <input id="szukaj" type="submit" name="set" value="dodaj ogłoszenie"/>
</center>
</form>
<br><br><br>
<center>

 

</center>

<br><br><br><br><br><br><br><br>



  <div class="zigzag1"></div>
  
  <div class="footer" style="background: #222; color: #fff; padding: 10px; text-align: center; font-family: 'Abel', sans-serif;">
  <br> Kontakt: <br> hello@stan-invest.com , Tel. 29-752-72-92 <br>  Stan-invest.com Wszystkie prawa zastrzeżone 2015.<br> <br> 

  </div>

</body>
</html>

<?php
/*
        xAxis: {
            plotLines: [{
                color: '#FF0000',
                width: 2,
                value: 5.5
            }],
            plotBands: [{ // mark the weekend
                color: '#ff2233',
                from: Date.UTC(2015, 1, 4),
                to: Date.UTC(2015, 5, 4)
            }],
            tickInterval: 24 * 3600 * 1000, // one day
            type: 'datetime'
        },

*/