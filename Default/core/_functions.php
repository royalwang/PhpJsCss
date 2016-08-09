<?php
header('Content-Type: text/html; charset=utf-8');
ini_set("sendmail_from", "noreply@fxstar.eu");
ini_set('default_charset', 'utf-8');

$dayofweek = date('w', strtotime('2016-02-1'));
// date from mysql timestamp
// print_r(date_parse("2006-12-12 10:00:00.5"));


// connect mysql
function Connect(){
    $h = 'localhost';
    $u = 'root';
    $j = 'toor';
    $db = 'fxstar-menu';
    mysql_connect($h,$u,$j) or die('[DB_ERROR_LOGIN]');
    mysql_select_db($db) or die('[DB_ERROR]');
    //SET names utf8, SET CHARACTER SET UTF8, 
    // SET names `utf8`; SET character_set `utf8`
    //ALTER TABLE tbl_name CONVERT TO CHARACTER SET charset_name;
    //ALTER DATABASE <database_name> CHARACTER SET utf8 COLLATE utf8_general_ci;
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    //mysql_query("SET collation_connection = utf8_polish_ci");
    mysql_query("SET collation_connection = utf8_general_ci");
}


// PDO
function Conn(){
$connection = new PDO('mysql:host=localhost;dbname=NAMEDB;mysql:charset=utf8mb4', 'root', 'toor');
// don't cache query
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// show warning text
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// throw error exception
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// don't colose connecion on script end
$connection->setAttribute(PDO::ATTR_PERSISTENT, false);
// set utf for connection
$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
return $connection;
}

//resize image
function resizeImage($file = 'image.png', $maxwidth = 1366){
  error_reporting(0);  
  $image_info = getimagesize($file);
  $image_width = $image_info[0];
  $image_height = $image_info[1];
  $ratio = $image_width / $maxwidth;
  $info = getimagesize($file);
  if ($image_width > $maxwidth) {
    // GoGoGo
    $newwidth = $maxwidth;
    $newheight = (int)($image_height / $ratio);
      
    if ($info['mime'] == 'image/jpg') {    
      $thumb = imagecreatetruecolor($newwidth, $newheight);
      $source = imagecreatefrompng($file);
      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
      imagejpeg($thumb,$file,90);
    }
    
    if ($info['mime'] == 'image/png') {
      echo "PNG";
      $im = imagecreatefrompng($file);
      $im_dest = imagecreatetruecolor($newwidth, $newheight);
      imagealphablending($im_dest, false);
      imagecopyresampled($im_dest, $im, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
      imagesavealpha($im_dest, true);
      imagepng($im_dest, $file, 9);
    }
    if ($info['mime'] == 'image/gif') {
      $im = imagecreatefromgif($file);
      $im_dest = imagecreatetruecolor($newwidth, $newheight);
      imagealphablending($im_dest, false);
      imagecopyresampled($im_dest, $im, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
      imagesavealpha($im_dest, true);
      imagegif($im_dest, $file);
    }
  }
}

// log database
function logDB(){
    // create database first
    // CREATE TABLE IF NOT EXISTS `logs` (`link` text, `ip` text) ENGINE=MyISAM DEFAULT CHARSET=utf8;
    $log = $_SERVER['HTTP_HOST']." ".$_SERVER['REQUEST_URI'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $log = htmlentities($log,ENT_QUOTES, 'utf-8');    
    mysql_query("INSERT INTO logs(link,ip) VALUE('$log','$ip')");    
}

function Youtube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe width=\"100%\" height=\"auto\" src=\"//www.youtube.com/embed/$2\" allowfullscreen frameborder=\"0\"></iframe>",
        $string
    );
}

function Vimeo($string) {	
	//extract the ID
	preg_match('/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',$string,$matches);
	//the ID of the Vimeo URL: 71673549 
	$id = $matches[2];	
	//set a custom width and height
	$width = '100%';
	$height = '';		
	return '<iframe src="http://player.vimeo.com/video/'.$id.'?title=1&byline=1&portrait=0&badge=1&color=ff0000" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
}

function isEmailValid($email){
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
   return true;
}else{
	return false;
}
}

// random password
function randomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


