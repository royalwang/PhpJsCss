<?php
$filename = 'C:\Users\Administrator\Documents\Visual Studio 2012\Projects\SslServerMax\SslClient\bin\Debug\bg.jpg';
$ctype =  mime_content_type($filename);
header('Content-type: ' . $ctype);
echo $f = file_get_contents($filename);
?>
