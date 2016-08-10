<?php
require('pdo.php');
$db = Conn();

$id = (int)$_GET['id'];
if (empty($id)) {
	$id=0;
}
// subscriber id
$s = (int)$_GET['s'];
if (empty($s)) {
	$s=0;
}
$web = $_SERVER ['HTTP_USER_AGENT'];
$from = $_SERVER['HTTP_REFERER'];
$info = $from." #agent ".$web." #ip ".$ip;
$ip = $_SERVER['REMOTE_ADDR'];
// add info to db
$st = $db->query("INSERT INTO trackopen(campaning,subscriberid,info,ip) VALUES($id,$s,'$info','$ip')");
echo file_get_contents('empty.png');
//header("Content-type: image/png");
//echo 'data:image/png;base64,'.base64_encode(file_get_contents('empty.png'));

// HOW USE THIS !!!!
// add this image to all tracking email
// kampaniaid and & subscriber id 
// <img src="linkopen.php?id=21&s=55">

?>
