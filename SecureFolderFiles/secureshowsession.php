<?php
session_start();
error_reporting(0);
if ($_SESSION['ok'] != 1) {
  header('Location: login.php');
}
$id = (int)$_SESSION['idsecret'];

$f = "folder/".$id.'user.html';
$type = mime_content_type($f);

	if (!file_exists($f)) {
	header('Content-Type: text/html; charset=utf-8');
	header('HTTP/1.1 403 Forbidden');
	echo "Nie masz dostępu do tej zawartości";
	exit();		
	}

if ($type == 'text/html' || $type == 'text/plain' || $type == 'text/x-php') {
	// secure php content
	if ($type == 'text/x-php') {
		$type = 'text/html';
	}
	header("Content-type: ".$type."; ".'charset=utf-8');
	echo file_get_contents($f);		
	exit();
}else{
	header('Content-Type: text/html; charset=utf-8');
	header('HTTP/1.1 403 Forbidden');
	echo "Nie masz dostępu do tej zawartości";
	exit();
}
