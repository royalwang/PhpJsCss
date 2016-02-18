<?php

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
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
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
	
	// :) secure strings if need  $txt =  $_POST['string'] or $_GET['string']
	$txt = htmlentities($txt, ENT_QUOTES, "UTF-8");
	
	// sortowanie
	if($desc == '1'){$val = 'DESC';}else{$val = 'ASC';}
	
	// zapytanie do bazy
	$query = $pdo->prepare("SELECT * FROM coments WHERE coment_article_id = '$id' AND title = '$txt' ORDER BY coment_time ".$val);
	$query->execute();
	return $query->fetchAll();
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

  //your email adress 
  $emailTo ="yourmail@yoursite.com"; //"yourmail@yoursite.com";

  //from email adress
  $emailFrom ="contact@yoursite.com"; //"contact@yoursite.com";

  //email subject
  $emailSubject = "Mail from Company";

  $name = $_POST["name"];
  $email = $_POST["email"];
  $comment = $_POST["comment"];
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

?>
