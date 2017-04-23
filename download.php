<?php
session_start();
include('core/func.php');
isToken();

  // Required for some browsers
  if(ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off'); 

$file1 = $_GET['f'];
//$file1 = str_replace(array('"',"'",'\\','/'), '', $_GET['f']);

$ext = strtolower(substr(strrchr($file1,"."),1));

if($ext == 'txt'){

$file = 'x.php';
$data = date('d-m-Y'); //10
echo $file = 'przelewy/'.$data.'/'.$file1;

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: private');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}

}else{echo "Błędny plik!";}

// wycinanie znaków od poczatku bez - od końca
//$string = substr($string, 0, -15);


?>
