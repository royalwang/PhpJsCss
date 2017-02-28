<?php
//
// RUN FROM BAT FILE
// 

// ini_set('display_error', 1);
// error_reporting(E_ALL);
// log file
$dir = (__DIR__);
$file = $dir.'\CronLog-'.date('Y-m-d', time()).'.txt';
file_put_contents($file, time());

try{
	$db = Conn();
	
	$res = $db->query("SELECT * from users");
	$rows = $res->fetchAll();
	$out = serialize($rows);


	// file_put_contents($file, time() . $out);
}catch(Exception $e){
	echo $e;
}

// PDO
function Conn(){
	$c = new PDO('mysql:host=localhost;port=3306;dbname=fex;charset=utf8', 'root', 'toor');
	// don't cache query
	$c->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	// show warning text
	$c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	// throw error exception
	$c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// don't colose connecion on script end
	$c->setAttribute(PDO::ATTR_PERSISTENT, false);
	// set utf for connection utf8_general_ci or utf8_unicode_ci 
	$c->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
	return $c;
}
?>
