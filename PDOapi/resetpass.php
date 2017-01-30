<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting('E_ALL');

// PDO
function Conn(){
$connection = new PDO('mysql:host=127.12.109.130;port=3306;dbname=www;charset=utf8', 'adminD3QJWNS', 'b8Mq2WuFPZ7d');
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

// return 1 if exists or 0 user does not exists
function is_user($nick, $db){
	$res = $db->query("SELECT * FROM users WHERE nick = '$nick'");
	//$rows = $res->fetchAll(PDO::FETCH_ASSOC);
	$cnt = 0;
	$cnt = $res->rowCount();
	return $cnt;
}

function send_password($nick, $db){
	$res = $db->query("SELECT * FROM users WHERE nick = '$nick'");
	$rows = $res->fetchAll(PDO::FETCH_ASSOC);
	$email = $rows[0]['email'];
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$p = rand(123456, 987654);
		$p = 'pass';
		$newpass = md5($p);
		$s = $db->query("UPDATE users SET pass = '$newpass' WHERE nick = '$nick'");
		$m = mail($email, 'New password to chat: ', 'Your new password: '.$p);
		if ($m == 1 && $s->rowCount() > 0) {
			return 1;
		}				
	}
	return 0;
}


// show errors
try{
	
	// init db
	$db = Conn();

 	if (is_user($nick, $db) == 1) { 		
 		if(send_password($nick, $db) > 0){
 			echo "[SEND_MAIL]";
 		}else{
 			echo "[ERROR_SEND_MAIL]";
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
