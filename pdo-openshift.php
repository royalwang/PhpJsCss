<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors',1);
ini_set('html_errors', 1);
error_reporting(0);

// PDO
function Conn(){
$connection = new PDO('mysql:host=localhost;dbname=mailo', 'root', 'toor');
// don't cache query
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// show warning text
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// throw error exception
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// don't colose connecion on script end
$connection->setAttribute(PDO::ATTR_PERSISTENT, false);
// set utf for connection utf8_general_ci or utf8_unicode_ci 
$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8' COLLATE 'utf8'");
return $connection;
}

// PDO
function ConnOpenShift(){
define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));

//$connection = new PDO('mysql:host=DB_HOST;port=DB_PORT;dbname=Mailo;charset=utf8', 'adminC1Mw2BX', 'LAnP96PR5Erc');
$connection = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT, DB_USER, DB_PASS);
// don't cache query
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// show warning text
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// throw error exception
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// don't colose connecion on script end
$connection->setAttribute(PDO::ATTR_PERSISTENT, false);
// set utf for connection utf8_general_ci or utf8_unicode_ci 
$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
return $connection;
}

function strip_javascript($filter, $allowed=0){
if($allowed == 0) // 1 href=...
$filter = preg_replace('/href=([\'"]).*?javascript:.*?\\1/i', "'", $filter);

if($allowed == 0) // 2 <script....
$filter = preg_replace("/<script.*?>.*?<\/script>/i", "", $filter);

if($allowed == 0) // 4 <tag on.... ---- useful for onlick or onload
$filter = preg_replace("/<(.*)?\son.+?=\s*?(['\"]).*?\\2/i", "<$1", $filter);
return $filter;
}

?>
