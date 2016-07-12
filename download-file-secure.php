<?php
session_start();
error_reporting(0);
if ($_SESSION['userlogin'] != 1) {
  header('Location: login.php');
}

$_GET['id'] = str_replace('../', "", $_GET['id']);
$_GET['id'] = str_replace('./', "", $_GET['id']);

$id = (int)$_SESSION['userid'];
$hash = $_SESSION['hash'];
$fid = htmlentities($_GET['id'], ENT_QUOTES, 'utf-8');

// File to download.
$file = "mailbox/".$id.'/'.$hash.'/'.$fid;

if (file_exists($file)) {

// Maximum size of chunks (in bytes).
$maxRead    = 1 * 1024 * 1204; // 1MB

// Give a nice name to your download.
$fileName   = basename($file);

// Open a file in read mode.
$fh         = fopen($file, 'r');

// These headers will force download, and set the
// custom file name for the download, respectively.
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $fileName . '"');

// Run this until we have read the whole file.
// feof (end of file) returns true when the handler
// has reached the end of file.
while (!feof($fh)) {
    // Read and output the next chunk.
    echo fread($fh, $maxRead);

    // Flush the output buffer to free memory.
    ob_flush();
}

// Exit to make sure not to output anything else.
exit;
}
