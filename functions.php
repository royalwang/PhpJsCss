<?php
header('Content-Type: text/html; charset=utf-8');
ini_set("sendmail_from", "noreply@fxstar.eu");
ini_set('default_charset', 'utf-8');

// no cache, refresh content
session_cache_limiter('');
header('Thu, 01 Jan 1970 00:00:00 GMT');
// session start
session_start();
//error reporting 0 or 'E_ALL'
error_reporting(0);

// sent email like
ini_set("sendmail_from", "email@fxstar.eu");

// max upload file size
ini_set('post_max_size', '200M');
ini_set('upload_max_filesize', '200M');

// get url path
function getUrl(){
$d = $_SERVER['HTTP_HOST'].pathinfo($_SERVER['REQUEST_URI'],PATHINFO_DIRNAME);	
return $d;
}

// allow connection only from ip
function allowIP($vpsip = "1.2.3.4"){
 if (substr($_SERVER['REMOTE_ADDR'], 0, strlen($vpsip)) != $vpsip) {
 die("Wrong ip address!");
 }	
}

function curl_get_contents($url) {
       // Initiate the curl session
 $ch = curl_init();
      // Set the URL
 curl_setopt($ch, CURLOPT_URL, $url);
     // Removes the headers from the output
 curl_setopt($ch, CURLOPT_HEADER, 0);
     // Return the output instead of displaying it directly
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Execute the curl session
 $output = curl_exec($ch);
    // Close the curl session
 curl_close($ch);
    // Return the output as a variable
 return $output;
}
// use 
//echo $output = curl_get_contents('http://fxstar.eu/');

// time from mysql timestamp
// echo date('M j Y g:i A', strtotime('2010-05-29 01:17:35'));
$dayofweek = date('w', strtotime('2016-02-1'));

// usuń http://
function isWWW($s){
$s= str_replace("https://", '', $s);
return $s= str_replace("http://", '', $s);
}

// rozstrzel text po 3 od końca
function isTel($t = "111222333"){
return substr($t, -15 ,-12)." ".substr($t, -12 ,-9)." ".substr($t, -9 ,-6)." ".substr($t, -6 ,-3)." ".substr($t, -3);
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

// if image exist return path to image
function isLogo($id){
	$p = '../media/_ludek.jpg';
	if (file_exists('../media/'.$id.'_logo.gif')) {	$p = '../media/'.$id.'_logo.gif';}
	if (file_exists('../media/'.$id.'_logo.png')) {	$p = '../media/'.$id.'_logo.png';}
	if (file_exists('../media/'.$id.'_logo.jpeg')){ $p = '../media/'.$id.'_logo.jpeg';}
	if (file_exists('../media/'.$id.'_logo.jpg')) { $p = '../media/'.$id.'_logo.jpg';}	
	return $p;
}

// is background exist
function isWall($id){
	$p = '../media/_wall.jpg';
	if (file_exists('../media/'.$id.'_wall.gif')) {	$p = '../media/'.$id.'_wall.gif';}
	if (file_exists('../media/'.$id.'_wall.png')) {	$p = '../media/'.$id.'_wall.png';}
	if (file_exists('../media/'.$id.'_wall.jpeg')){ $p = '../media/'.$id.'_wall.jpeg';}
	if (file_exists('../media/'.$id.'_wall.jpg')) { $p = '../media/'.$id.'_wall.jpg';}	
	return $p;
}

// secure input data 
function Clear(){
	foreach ($_GET as $key => $val) { 
	    if (is_string($val)) { 
	        $_GET[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
	    } else if (is_array($val)) { 
	        $_GET[$key] = Clear($val); 
	    } 
	} 
	foreach ($_POST as $key => $val) { 
	    if (is_string($val)) { 
	        $_POST[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
	    } else if (is_array($val)) { 
	        $_POST[$key] = Clear($val); 
	    } 
	} 
}


// log to database
function logDB(){
    // create database first
    // CREATE TABLE IF NOT EXISTS `logs` (`link` text, `ip` text) ENGINE=MyISAM DEFAULT CHARSET=utf8;
    $log = $_SERVER['HTTP_HOST']." ".$_SERVER['REQUEST_URI'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $log = htmlentities($log,ENT_QUOTES, 'utf-8');
    mysql_query("CREATE TABLE IF NOT EXISTS `logs` (`link` text, `ip` text) ENGINE=MyISAM DEFAULT CHARSET=utf8");
    mysql_query("INSERT INTO logs(link,ip) VALUE('$log','$ip')");    
}

// log request
function logrequest($pathdir = "_logs"){    
    if(!is_dir($pathdir)){
    mkdir($pathdir, 0700, true);
    }
    $file = $pathdir.'/log-UTC'.date('Y-m-d-h', time()).'.txt';
    file_put_contents($file, time()." ".$_SERVER['REMOTE_ADDR']." ".$_SERVER['REQUEST_URI']."\r\n", FILE_APPEND | LOCK_EX);
}

// connect mysql
function Connect(){
    $h = 'localhost';
    $u = 'root';
    $j = 'pass';
    $db = 'dbname';
    mysql_connect($h,$u,$j) or die('[DB_ERROR_LOGIN]');
    mysql_select_db($db) or die('[DB_ERROR]');
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
}

// PDO connection 
try{
$pdo = new PDO('mysql:host=localhost;dbname=cms;charset=utf8', 'root', 'pass');
$pdo->query("set names utf8");
$pdo->query("set character_set_results='utf8'");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// default mode 
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// column name array
$pdo->setAttribute(PDO::FETCH_ASSOC);
// column number array
//$pdo->setAttribute(PDO::FETCH_NUM);
}catch (PDOException $e){
	echo $e->getMessage();
	exit('Database error!');
	//echo $pdo>errorCode();
	//echo $pdo->errorInfo();
}

// how use pdo connection - fetch all articles from database 
public function fetch_all_coments($id = '1', $desc = '1', $txt = 'tring'){
	global $pdo;
	
	// secure only numbers
	$id = (int)$id;
	
	// alllow only letters numbers and . (dot char) else replace to empty - tylko litery i znaki
	$onlyAllowedChars = preg_replace("/[^a-zA-Z0-9.]/", "", $txt);
	
	// secure passwords hash md5()
	$pass = md5($txt);
	
	// :) secure strings if needed  $txt =  $_POST['string'] or $_GET['string']
	$txt = htmlentities($txt, ENT_QUOTES, "UTF-8");
	
	// sortowanie
	if($desc == '1'){$val = 'DESC';}else{$val = 'ASC';}
	
	// zapytanie do bazy
	$query = $pdo->prepare("SELECT * FROM coments WHERE coment_article_id = '$id' AND title = '$txt' ORDER BY coment_time ".$val);
	$query->execute();
	return $query->fetchAll();
}

// fetch example row by row works with while
public function fetch_example($nr = '100'){
	// SELECT * FROM articles LIMIT 1
	$query = $pdo->prepare("SELECT * FROM articles ORDER BY article_id DESC LIMIT 1,:nr");
	$query->bindValue(':nr', $nr, PDO::PARAM_INT);
	//$query->bindValue(':nr', $nr, PDO::PARAM_STR);
	//if use ? not :nr
	//$query->bindValue(1, $nr, PDO::PARAM_INT);
	//$query->bindValue(2, $nr, PDO::PARAM_STR);
	$query->execute();

	//print("Return next row as an array indexed by column number from 0 \n"); 
	return $query->fetch(PDO::FETCH_NUM);

	//print("Return next row as an array indexed by column name\n");
	//return $query->fetch(PDO::FETCH_ASSOC);

	//print("Return next row as an array indexed by both column name and number\n");
	//return $query->fetch(PDO::FETCH_BOTH);

	//print("Return next row as an anonymous object with column names as properties\n");
	//return $query->fetch(PDO::FETCH_OBJ);

	// query only fetch results SIMPLE VERSION
	// $query = $pdo->query('SELECT * FROM `mytable` WHERE true', PDO::FETCH_ASSOC);
	// return $query->fetchAll(); 
	
	// Returns a single column from the next row of a result set
	// $query = $pdo->query("SELECT COUNT(id) FROM pics");	
	// return $query->fetchColumn(); 
}

// fetch all articles from database pagination example
public function fetch_all_pagine($desc = '1', $start = '0', $perpage = '2'){
	global $pdo;
	$query = $pdo->prepare('SELECT * FROM articles');
	$query->execute();
	$total = $query->rowCount();
	$start = (int)$start;
	$perpage = (int)$perpage;
	if($start <= 0){$start = 0;}
	$maxpage = ceil($total / $perpage);
	if($start > $maxpage){$start = $maxpage;}
	$start = $start - 1;
	if($start > 0){$start = $start + $perpage;}
	$start = $start - 1;
	if($start <= 0){$start = 0;}
	if($desc == '1'){$val = 'DESC';}else{$val = 'ASC';}
	$query = $pdo->prepare('SELECT * FROM articles ORDER BY article_id '.$val.' LIMIT '.$start.','.$perpage);
	$query->execute();
	return $query->fetchAll();
}

//Valid String POST / GET / REQUEST
function inputSecurity($validate=null) { 
    if ($validate == null) { 
        foreach ($_REQUEST as $key => $val) { 
            if (is_string($val)) { 
                $_REQUEST[$key] = htmlentities($val); 
            } else if (is_array($val)) { 
                $_REQUEST[$key] = inputSecurity($val); 
            } 
        } 
        foreach ($_GET as $key => $val) { 
            if (is_string($val)) { 
                $_GET[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
            } else if (is_array($val)) { 
                $_GET[$key] = inputSecurity($val); 
            } 
        } 
        foreach ($_POST as $key => $val) { 
            if (is_string($val)) { 
                $_POST[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
            } else if (is_array($val)) { 
                $_POST[$key] = inputSecurity($val); 
            } 
        } 
    } else { 
        foreach ($validate as $key => $val) { 
            if (is_string($val)) { 
                $validate[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
            } else if (is_array($val)) { 
                $validate[$key] = inputSecurity($val); 
            } 
            return $validate; 
        } 
    } 
}

// Strips nasty tags from code
function cleanEvilTags($data) {
  $data = preg_replace("/javascript/i", "j&#097;v&#097;script",$data);
  $data = preg_replace("/alert/i", "&#097;lert",$data);
  $data = preg_replace("/about:/i", "&#097;bout:",$data);
  $data = preg_replace("/onmouseover/i", "&#111;nmouseover",$data);
  $data = preg_replace("/onclick/i", "&#111;nclick",$data);
  $data = preg_replace("/onload/i", "&#111;nload",$data);
  $data = preg_replace("/onsubmit/i", "&#111;nsubmit",$data);
  $data = preg_replace("/<body/i", "&lt;body",$data);
  $data = preg_replace("/<html/i", "&lt;html",$data);
  $data = preg_replace("/document\./i", "&#100;ocument.",$data);
  $data = preg_replace("/<script/i", "&lt;&#115;cript",$data);
  return strip_tags(trim($data));
}

// Cleans output data
function cleanData($data) {
  $data = str_replace(' & ', ' &amp; ', $data);
  return (get_magic_quotes_gpc() ? stripslashes($data) : $data);
}

// clean for array
function multiDimensionalArrayMap($func,$arr) {
  $newArr = array();
  if (!empty($arr)) {
    foreach($arr as $key => $value) {
      $newArr[$key] = (is_array($value) ? multiDimensionalArrayMap($func,$value) : $func($value));
    }
  }
  return $newArr;
}

// send email
if (isset($_POST["email"]) && isset($_POST["comment"]) && isset($_POST["name"])){

  $data['success'] = true;
  $_POST  = multiDimensionalArrayMap('cleanEvilTags', $_POST);
  $_POST  = multiDimensionalArrayMap('cleanData', $_POST);
  
  $name = $_POST["name"];
  $email = $_POST["email"];
  $comment = $_POST["comment"];
  
  //your email adress 
  $emailTo ="to@yoursite.com";

  //from email adress
  $emailFrom ="from@yoursite.com";

  //email subject
  $emailSubject = "Mail from Company";
  
  //email subject polskie znaki w tytule dla utf
  $emailSubject = "=?UTF-8?B?".base64_encode("Temat z ogonkami ęóąśłżźćń")."?=";
  
  // dla iso podobno
  // $emailSubject = "=?iso-8859-2?B?".base64_encode($temat)."?=";

  if($name == "") $data['success'] = false;
 
 if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) $data['success'] = false;
 if($comment == "")$data['success'] = false;

 if($data['success'] == true){
  $message = "NAME: $name<br>  EMAIL: $email<br>  COMMENT: $comment";

  $headers = "MIME-Version: 1.0" . "\r\n"; 
  $headers .= "Content-type:text/html; charset=utf-8" . "\r\n"; 
  $headers .= "From: <$emailFrom>" . "\r\n";
  mail($emailTo, $emailSubject, $message, $headers);

  $data['success'] = true;
  echo json_encode($data);
}
}

// save email newsletter address to file
if($_POST['email']){
    $fileName = 'newsletter.txt'; //set 700 permision for this file: chmod($fileName, 0700); or 755
    $error = false;
    $email = $_POST['email'];
    
    // if email valid
    if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) $error = true;
    
    //If all ok, save emali adress in file
    if($error == false){
        $file = fopen($fileName, a);
        fwrite($file, "$email,");
        fclose($file);
        echo 'OK';
    }
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

function strip_javascript($filter, $allowed=0){
if($allowed == 0) // 1 href=...
$filter = preg_replace('/href=([\'"]).*?javascript:.*?\\1/i', "'", $filter);
if($allowed == 0) // 2 <script....
$filter = preg_replace("/<script.*?>.*?<\/script>/i", "", $filter);
if($allowed == 0) // 4 <tag on.... ---- useful for onlick or onload
$filter = preg_replace("/<(.*)?\son.+?=\s*?(['\"]).*?\\2/i", "<$1", $filter);
return $filter;
}
// cut hastags and insert to database with pdo connection
function hashtag($str = '', $postid ,$PDO = 'PDO connection'){		
	//preg_match_all("/#(\w+[0-9-_a-zA-Z]\w+)/", $str, $tagall);	
	preg_match_all("/#[^\s]*/i", $str, $tag);	
	foreach (array_unique($tag[0]) as $v) {
		$v = strtolower($v);
		$q = "INSERT INTO hashtag(hashtag,post) VALUES('$v','$postid')";		
		echo $sth = $PDO->exec($q);
	}
}
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
    if ($info['mime'] == 'image/jpeg') {    
      $thumb = imagecreatetruecolor($newwidth, $newheight);
      $source = imagecreatefromjpeg($file);
      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
      echo imagejpeg($thumb,$file,90);
    }   
     if ($info['mime'] == 'image/jpg') {    
      $thumb = imagecreatetruecolor($newwidth, $newheight);
      $source = imagecreatefromjpeg($file);
      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
      echo imagejpeg($thumb,$file,90);
    }   
    if ($info['mime'] == 'image/png') {
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
function status($id=0, $uid=0, $status = 1, $db = 0){
	// 1 - powiadomienie polubiono profil, 2 - dodano komentarz, 3 - polubiono post, 4 - wspomniano o tobie
	if ($id != 0 && $uid != 0 && $status >= 0 && $status < 10) {
		$q = "INSERT INTO notify(id,uid,status) VALUES('$id','$uid','$status')";
		$sth = $db->exec($q);
		return 1;
	}
	return 0;
};
function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe  width=\"100%\" height=\"auto\" src=\"//www.youtube.com/embed/$2\" allowfullscreen frameborder=\"0\"></iframe>",
        $string
    );
}
function replace_url_img($content){
  $urls = "";
  // get all urls images links clear tekst no tags
  preg_match_all("/\b(?:(?:https?|ftp|ftps):\/\/|\s\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$content,$urls);
  foreach ($urls[0] as $url) {
    // file extension
    $ext = pathinfo($url,PATHINFO_EXTENSION);
    if (strpos($url, 'embed') > 0 || strpos($url, 'vimeo') > 0 || strpos($url, 'youtube') > 0 || strpos($url, 'youtu') > 0) {
       // do nothing embed url embed urls like youtube
    }else if ($ext == 'jpg' || $ext == 'gif' || $ext == 'png' || $ext == 'jpeg') {
        //$out = preg_replace('#(https?://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<img src="$1.$2" alt="$1.$2" style="color: #09c" />', $url);   
        //$e = end(explode('/', $url));
        //$dir = pathinfo($url, PATHINFO_DIRNAME);
        //$name = pathinfo($url, PATHINFO_BASENAME);
        //$path = $dir."/".$name;
        //$a = '<a class="img-out" href="'.$path.'" target="_blank"><img src="'.$path.'" alt="'.$path.'"></a>';
        //$content = str_replace($path, $a, $content);
    }else {
        $out = preg_replace('|([\w\d]*)\s?(https?://([\d\w\.-]+\.[\w\.]{2,6})[^\s\]\[\<\>]*/?)|i', '$1 <a href="$2" target="_blank" class="link-out">$0</a>', $url);
        $content = str_replace($url, $out, $content);
    }
  }
  return $content;
}
  function closetags ( $html )
      {
      #put all opened tags into an array
      preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
      $openedtags = $result[1];
      #put all closed tags into an array
      preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
      $closedtags = $result[1];
      $len_opened = count ( $openedtags );
      # all tags are closed
      if( count ( $closedtags ) == $len_opened )
      {
      return $html;
      }
      $openedtags = array_reverse ( $openedtags );
      # close tags
      for( $i = 0; $i < $len_opened; $i++ )
      {
          if ( !in_array ( $openedtags[$i], $closedtags ) )
          {
          $html .= "</" . $openedtags[$i] . ">";
          }
          else
          {
          unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
          }
      }
      return $html;
  }
?>
