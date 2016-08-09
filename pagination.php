<?php 
error_reporting(0);
header('Content-type: text/html; charset=utf-8');

// PDO
function Conn(){
$connection = new PDO('mysql:host=localhost;dbname=newsletter', 'root', 'toor');
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connection->setAttribute(PDO::ATTR_PERSISTENT, false);
$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8' COLLATE 'utf8'");
return $connection;
}

$db = Conn();

function pagine($table= 'users', $perpage = 5){
	if(empty($_GET['page'])){$page = 1;}else{$page = (int)$_GET['page'];}
	$pagenext = $page +1;
	$pageprev = $page -1;
	if ($pageprev < 0){$pageprev = 1;}
	$offset = ($page - 1) * $perpage;
	$sql = "SELECT * FROM ".$table." WHERE active = '1' AND admin = '0' LIMIT " . $offset . "," . $perpage;
	global $db; // get pdo connection Conn()
	$st = $db->query($sql);
	$row = $st->fetchAll(PDO::FETCH_ASSOC);

	echo '<a href="?page='.$pageprev.'"> prev </a>';
	echo '<a href="?page='.$pagenext.'"> next </a>';
	return $row;
}
// using and get data from mysql
print_r(pagine());
?>
