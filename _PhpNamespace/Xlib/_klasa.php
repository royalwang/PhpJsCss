<?php
// Autoload class
require('classes/_autoload.php');

use Xlib\Pdo\MysqlPdo;

// Get pdo connection
$pdo = new MysqlPdo();

// clear POST/GET data only once
$pdo->clearSqlInjection();

if(empty($_GET)){
	echo "Add url GET id parametr: ?id=username";
	die();
}

// Get from database
echo $id = $_GET['id'];
$r = $pdo->db->query("SELECT * FROM users WHERE username = '$id'");
$rows = $r->fetchAll(PDO::FETCH_ASSOC);

// Show database fields
print_r($rows);

echo "<br> Current namespace " . __NAMESPACE__ . " (root app file empty)";
?>