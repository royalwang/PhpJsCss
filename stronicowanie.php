<?php 
error_reporting(0);
header('Content-type: text/html; charset=utf-8');

// connect to database function from https://github.com/fxstar/PhpJsCss/blob/master/Default/core/pdo.php
require('pdo.php');
$db = Conn();

if(empty($_GET['page'])){$page = 1;}else{$page = (int)$_GET['page'];}
$pagenext = $page +1;
$pageprev = $page -1;
if ($pageprev < 0)$pageprev = 1;
$perpage = 3;
$offset = ($page - 1) * $perpage;
$table= 'users';
$sql = "SELECT * FROM ".$table." WHERE active != ' ' LIMIT " . $offset . "," . $perpage;
// mysql query
$st = $db->query($sql);
$row = $st->fetchAll(PDO::FETCH_ASSOC);
// page links for current page
echo '<a href="?page='.$pageprev.'"> prev </a>';
echo '<a href="?page='.$pagenext.'"> next </a>';

// show data from array
echo "<pre>";
print_r($row);
?>
