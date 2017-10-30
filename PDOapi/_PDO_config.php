<?php
/* Headers session */
ob_start();

/* show errors */
// error_reporting(E_ALL & ~E_NOTICE);
// No warnings
error_reporting(E_ERROR | E_PARSE | E_STRICT); 
// display errors
ini_set('display_errors',1);
ini_set('html_errors', 1);

/* Mysql Settings */

$mysqlhost = "localhost";
$mysqluser = "root";
$mysqlpass = "toor";
$mysqlport = "3306";
$mysqldb = "BreakermindSMTP";
?>
