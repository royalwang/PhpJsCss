<?php
// PDO
function Conn(){
$connection = new PDO('mysql:host=localhost;dbname=xmail;mysql:charset=utf8mb4', 'root', 'toor');
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


?>
<?php
// start mysql connection
$db = Conn();

$s = "this has a #hashtag a  #badha-shtag99 and a #goodf-hash_tag1";
preg_match_all("/#(\w+[0-9-_a-zA-Z]\w+)/", $s, $tag);

echo "<pre>";
print_r($tag);

$postid = md5(microtime());

foreach ($tag[0] as $v) {
	//echo $v;
	$q = "INSERT INTO hashtag(hashtag,post) VALUES('$v','$postid')";		
	$sth = $db->exec($q);
	if ($sth = 1) {
		echo "ok ";
	}else{

	}
}

// policz hashtagi
//$sth = $db->query("SELECT * FROM hashtag WHERE hashtag = '#hashtag'");	
$sth = $db->query("SELECT COUNT(hashtag),hashtag FROM hashtag GROUP BY hashtag ORDER BY time DESC");	
$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);
echo $sth->rowCount();

die();
$q = "UPDATE public SET like = like + 1 WHERE ha = '$h' AND id='$id'";
$sth = $db->exec($q);

