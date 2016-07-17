<?php
session_start();
error_reporting(0);
if ($_SESSION['ok'] != 1) {
  header('Location: login.php');
}
// secure file name
$_GET['id'] = str_replace('../', "", $_GET['id']);
$_GET['id'] = str_replace('./', "", $_GET['id']);
// message folder with attachments
$id = (int)$_SESSION['msg_userid'];
$hash = $_SESSION['msg_hash'];
$fid = htmlentities($_GET['id'], ENT_QUOTES, 'utf-8');
// File to download.
$file = "folder/".$id.'/'.$hash.'/'.$fid;
// allow only types
$imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "zip" && $imageFileType != "rar" && $imageFileType != "tar" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "txt") {		    
	header('Content-Type: text/html; charset=utf-8');
	header('HTTP/1.1 403 Forbidden');
	echo "Niedozwolony format pliku.";
	exit;
} 
if (file_exists($file)) {
// Maximum size of chunks (in bytes).
$maxRead    = 1 * 1024 * 1204; // 1MB
// or max file size
// $maxRead = filesize($file);
// cut from path file name file.ext
$fileName   = basename($file);
$fh         = fopen($file, 'r');
header("Content-Description: File Transfer"); 
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $fileName . '"');

while (!feof($fh)) {
    echo fread($fh, $maxRead);
    ob_flush();
}
exit;
}
