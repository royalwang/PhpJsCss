<?php
/// Show here
/// https://github.com/phpWhois/idna-convert
// lub
// https://github.com/fxstar/idna-convert
header('Content-Type: text/html; charset=utf-8');
require('idna_convert.class.php');
$idn_version = isset($_REQUEST['idn_version']) && $_REQUEST['idn_version'] == 2003 ? 2003 : 2008;
$IDN = new idna_convert(array('idn_version' => $idn_version));
$city = explode('.', urldecode($_SERVER['HTTP_HOST']))[0];
//$input = utf8_encode($_SERVER['HTTP_HOST']);
$city = ucfirst(explode('.', $IDN->decode($_SERVER['HTTP_HOST']))[0]);
?>
