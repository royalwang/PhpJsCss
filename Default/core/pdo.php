<?php
// PDO
function Conn(){
$connection = new PDO('mysql:host=localhost;dbname=NAMEDB;mysql:charset=utf8mb4', 'root', 'toor');
// don't cache query
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// show warning text
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// throw error exception
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// don't colose connecion on script end
$connection->setAttribute(PDO::ATTR_PERSISTENT, false);
// set utf for connection
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


// cut hastags and insert to database with pdo connection
function hashtag($str = '', $postid ,$PDO = 'PDO connection'){		
	//preg_match_all("/#(\w+[0-9-_a-zA-Z]\w+)/", $str, $tagall);	
	preg_match_all("/#[^\s]*/i", $str, $tag);	
	foreach (array_unique($tag[0]) as $v) {
		$v = strtolower($v);
		$q = "INSERT INTO hashtag(hashtag,post) VALUES('$v','$postid')";		
		echo $sth = $PDO->exec($q);
	}
}


function status($id=0, $uid=0, $status = 1, $db = 0){
	// 1 - powiadomienie polubiono profil, 2 - dodano komentarz, 3 - polubiono post, 4 - wspomniano o tobie
	if ($id != 0 && $uid != 0 && $status >= 0 && $status < 10) {
		$q = "INSERT INTO notify(id,uid,status) VALUES('$id','$uid','$status')";
		$sth = $db->exec($q);
		return 1;
	}
	return 0;
};

?>
