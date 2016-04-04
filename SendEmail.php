<?php
error_reporting('E_ALL');
$vpsip = "1.2.3.4";
if (substr($_SERVER['REMOTE_ADDR'], 0, strlen($vpsip)) != $vpsip) {
die("Wrong ip address!");
}
ini_set("sendmail_from", "email@fxstar.eu");
echo mail('hello@breakermind.com', 'Check email Wycena !!!', 'Sprawdz folder wyceny fxstar.eu');
?>
<!--
// how send email from vps without SMTP
// use from another server
file_get_contents("https://domain.com/SendEmail.php");
-->
