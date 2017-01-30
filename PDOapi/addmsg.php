<?php
header('Content-Type: text/html; charset=utf-8');
// allow use js from another host
header('Access-Control-Allow-Origin: *');

error_reporting('E_ALL');

// PDO
function Conn(){
$connection = new PDO('mysql:host=127.4.5.6;port=3306;dbname=CoolName;charset=utf8', 'admi123456', 'pass123456');
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
$msg = htmlentities($_GET['msg'], ENT_QUOTES, 'utf-8');
$tid = 0;
if (!empty($_GET['privid'])) {
	echo $tid = (int)$_GET['privid'];
}

// return 1 if exists or 0 user does not exists
function is_user($nick, $pass, $db){
	$res = $db->query("SELECT * FROM users WHERE nick = '$nick' AND pass='$pass'");
	//$rows = $res->fetchAll(PDO::FETCH_ASSOC);
	$cnt = 0;
	$cnt = $res->rowCount();
	return $cnt;
}

function send_msg_old($nick, $pass, $msg, $db){
	$res = $db->query("SELECT * FROM users WHERE nick = '$nick' AND pass='$pass'");
	$rows = $res->fetchAll(PDO::FETCH_ASSOC);
	$fid = (int)$rows[0]['id'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$time = time();
	if ($fid > 0) {
		$s = $db->query("INSERT INTO chat(fid,msg,ip,time) VALUES($fid, '$msg', '$ip', $time)");
		return $db->lastInsertId();
	}
	return 0;
}

function send_msg($nick, $pass, $msg, $tid = 0, $db){
	$res = $db->query("SELECT * FROM users WHERE nick = '$nick' AND pass='$pass'");
	$rows = $res->fetchAll(PDO::FETCH_ASSOC);
	$fid = (int)$rows[0]['id'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$time = time();
	if ($fid > 0 && $tid == 0) {
		$s = $db->query("INSERT INTO chat(fid,msg,ip,time) VALUES($fid, '$msg', '$ip', $time)");
		return $db->lastInsertId();
	}
	if ($fid > 0 && $tid > 0) {
		$s = $db->query("INSERT INTO priv(fid,tid,msg,ip,time) VALUES($fid, $tid, '$msg', '$ip', $time)");
		return $db->lastInsertId();
	}	
	return 0;
}


// show errors
try{
	
	// init db
	$db = Conn();

 	if (is_user($nick, $pass, $db) == 1) { 		
 		if(send_msg($nick, $pass, $msg, $tid, $db) > 0){
 			echo "[SEND]";
 		}
 	}else{
 		echo "[ERROR_LOGIN]";
 	}

  
} catch (Exception $e) {
    if ($e->getCode() == '2A000'){ echo "Syntax Error: ".$e->getMessage(); }
    //print_r($db->errorInfo());
  	//echo "PDO::errorCode(): ", $db->errorCode();
} 

?>

# sql www-fxstar.rhcloud.com

CREATE TABLE IF NOT EXISTS users (
`id` bigint(22) NOT NULL AUTO_INCREMENT,
`email` varchar(200),
`nick` varchar(50),
`pass` varchar(32),
`about` text,	
`ip` varchar(100),
`time` int(21) DEFAULT 0,
`active` char(1) DEFAULT '1',
PRIMARY KEY (`id`),
UNIQUE KEY `nick` (`nick`)
);

CREATE TABLE IF NOT EXISTS chat (
`id` bigint(22) NOT NULL AUTO_INCREMENT,
`fid` bigint(22) NOT NULL DEFAULT 0,	
`msg` varchar(200),	
`ip` varchar(100),
`time` int(21) DEFAULT 0,
`active` char(1) DEFAULT '1',
PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS priv (
`id` bigint(22) NOT NULL AUTO_INCREMENT,
`fid` bigint(22) NOT NULL DEFAULT 0,	
`tid` bigint(22) NOT NULL DEFAULT 0,	
`msg` varchar(200),	
`ip` varchar(100),
`active` char(1) DEFAULT '1',
`time` int(21) DEFAULT 0,
PRIMARY KEY (`id`)
);

INSERT INTO `www`.`users` (`id`, `nick`, `pass`, `email`, `about`, `ip`, `time`, `active`) VALUES (NULL, 'Boom', MD5('pass123456'), 'hello@xxxxxxx.com', 'Hello from Max :)', '127.0.0.1', '0', '1');
