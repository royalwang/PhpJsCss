<?php
error_reporting(E_ALL);
ini_set("default_charset", "UTF-8");

//ini_set("display_errors", 1);
//mb_internal_encoding('UTF-8');
//mb_http_output('UTF-8');
//iconv_set_encoding("internal_encoding", "UTF-8");
//iconv_set_encoding("output_encoding", "UTF-8");

// PDO
function Conn(){
$connection = new PDO('mysql:host=localhost;dbname=user;mysql:charset=utf8mb4', 'root', '');
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connection->setAttribute(PDO::ATTR_PERSISTENT, true);
$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
return $connection;
}

//CONNECT
$db = Conn();

// GET POST DATA
$u = htmlentities($_POST['user'], ENT_QUOTES, 'UTF-8');
$e = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
$p = htmlentities($_POST['pass'], ENT_QUOTES, 'UTF-8');


// INSERT TO MYSQL
// INSERT INTO user(user) VALUES (N'శ్రీనివాస్ తామాడా'), (N'新概念英语第');
$res = $db->exec("INSERT INTO user(user) VALUES(N'$u')");

// OR LONG VERSION prepare and bind
//$sth = $db->prepare("INSERT INTO example (firstname, lastname, email) VALUES (?, ?, ?)");
//$sth->bind_param("sss", $name, $pass, $email);
//$name ="jon"; $pass="pass"; $email = "email@email.ooo";
//$sth->execute();
// OR
//$sth->bindParam(1, $name, PDO::PARAM_STR, 4000); 
//$sth->bindParam(2, $pass, PDO::PARAM_PARAM_INT , 21); 
//$sth->bindParam(3, $email, PDO::PARAM_BOOL, 4000); 
//$sth->execute();

// GET FROM MYSQL
$sth = $db->prepare("SELECT * FROM user");
$sth->execute();
// PDO::FETCH_ASSOC PDO::FETCH_NUM PDO::FETCH_OBJ PDO::FETCH_BOTH
$rows = $sth->fetchAll(PDO::FETCH_ASSOC);

// count num rows
$sth->rowCount();

// DISPLAY IN BROWSER
print_r($rows);

?>
<form method="post" action="">
	<input type="text" name="user">
	<input type="text" name="email">
	<input type="password" name="pass">
	<input type="submit" name="submit">

</form>
