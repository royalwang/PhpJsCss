<?php
session_start();
error_reporting(0);
if ($_SESSION['ok'] != 1) {
  header('Location: login.php');
}

// if empty id
if (empty($_GET['id'])) {
	$_GET['id'] = 0;
}

// clear if need
$_GET['id'] = str_replace('../', "", $_GET['id']);
$_GET['id'] = str_replace('./', "", $_GET['id']);

// create folder
// ande secure only int from get
$f = "folder/".(int)$_GET['id'].'user.html';
$type = mime_content_type($f);
  
  // no file shoe error
	if (!file_exists($f)) {
	header('Content-Type: text/html; charset=utf-8');
	header('HTTP/1.1 403 Forbidden');
	echo "Nie masz dostępu do tej zawartości";
	exit();		
	}

// check content type
if ($type == 'text/html' || $type == 'text/plain') {
	header("Content-type: ".$type."; ".'charset=utf-8');
	echo file_get_contents($f);		
	exit();
}else{
	header('Content-Type: text/html; charset=utf-8');
	header('HTTP/1.1 403 Forbidden');
	echo "Nie masz dostępu do tej zawartości";
	exit();
}

?>
