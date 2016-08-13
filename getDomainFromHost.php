<?php
$host = $_SERVER['HTTP_HOST'];

// get domain from host
function getDomain($host){
$e = explode('.', $host);
$c = count($e);
return $h = $e[$c-2].'.'.$e[$c-1];
}

// set SMTP domain
ini_set('sendmail_from', 'noreply@'.getDomain($host));
echo mail('xyz@domain.com', 'Tewst mail function', 'Helloe ....');

?>
