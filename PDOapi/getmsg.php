<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting('E_ALL');

// PDO
function Conn(){
$connection = new PDO('mysql:host=127.12.109.130;port=3306;dbname=www;charset=utf8', 'admin123456', 'admin123456');
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

// secure string
$nick = htmlentities($_GET['nick'], ENT_QUOTES, 'utf-8');
$pass = md5($_GET['pass']);

// return 1 if exists or 0 user does not exists
function is_user($nick, $pass, $db){
	$res = $db->query("SELECT * FROM users WHERE nick = '$nick' AND pass='$pass'");
	//$rows = $res->fetchAll(PDO::FETCH_ASSOC);
	$cnt = 0;
	$cnt = $res->rowCount();
	return $cnt;
}

function show_msg($db){
	$res = $db->query("SELECT * FROM chat");
	$rows = $res->fetchAll(PDO::FETCH_ASSOC);	
	return json_encode($s['msg'] = $rows);
}


// show errors
try{
	
	// init db
	$db = Conn();

 	if (is_user($nick, $pass, $db) == 1) { 		
 		echo show_msg($db); 		
 	}else{
 		echo "[ERROR_LOGIN]";
 	}

  
} catch (Exception $e) {
    if ($e->getCode() == '2A000'){ echo "Syntax Error: ".$e->getMessage(); }
    //print_r($db->errorInfo());
  	//echo "PDO::errorCode(): ", $db->errorCode();
} 

?>
