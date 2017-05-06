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


// pagine updated 
$curpage = 0;
function pagine($uid = 1, $table= "subscribe", $perpage = 10){
	if(empty($_GET['page'])){$page = 1;}else{$page = (int)$_GET['page'];}
	$pagenext = $page +1;
	$pageprev = $page -1;
	if ($pageprev < 0){$pageprev = 1;}
	$offset = ($page - 1) * $perpage;
	global $curpage;
	$curpage = $page;
	
	// count messages
	$q = "SELECT COUNT(*) as ile FROM ".$table." WHERE uid = $uid";
	global $db; // get pdo connection Conn()
	$st = $db->query($q);
	$ile = $st->fetchAll(PDO::FETCH_ASSOC)[0]['ile'];		
	$pages = (int)($ile / $perpage) + 1;
	// get messages		
	$sql = "SELECT * FROM ".$table." ORDER BY id DESC LIMIT " . $offset . "," . $perpage;
	
	// get pdo connection Conn()
	global $db; 
	$st = $db->query($sql);
	$row = $st->fetchAll(PDO::FETCH_ASSOC);

	if ($st->rowCount() > 0) {
		echo '<p class="pagine"><a class="pagelink" href="?page='.$pageprev.'"> Poprzednia</a>';
		echo '<a class="pagelink"> '.$page.' </a>';
		if ($page < $pages) {
			echo '<a class="pagelink" href="?page='.$pagenext.'"> Nastepna</a></p>';
		}
	}
	return $row;
}

// use like this
$links = pagine($uid);


// pagine with search
	$curpage = 0;
	function pagine($uid = 1, $search, $table= "subscribe", $perpage = 10){
		if(empty($_GET['page'])){$page = 1;}else{$page = (int)$_GET['page'];}
		$pagenext = $page +1;
		$pageprev = $page -1;
		if ($pageprev < 0){$pageprev = 1;}
		$offset = ($page - 1) * $perpage;
		global $curpage;
		$curpage = $page;
		// count messages
		$q = "SELECT COUNT(*) as ile FROM ".$table." WHERE uid = $uid";
		if (!empty($search)) {
			$search = '%'.$search.'%';
			$q = "SELECT COUNT(*) as ile FROM ".$table." WHERE uid = $uid AND CONCAT_WS(' ',prefix,number,name,lastname,city) LIKE '$search'";
		}
		global $db; // get pdo connection Conn()
		$st = $db->query($q);
		$ile = $st->fetchAll(PDO::FETCH_ASSOC)[0]['ile'];		
		$pages = (int)($ile / $perpage) + 1;
		// get messages		
		$sql = "SELECT * FROM ".$table." WHERE uid = $uid ORDER BY id DESC LIMIT " . $offset . "," . $perpage;
		if (!empty($search)) {
			$search = '%'.$search.'%';
			$sql = "SELECT * FROM ".$table." WHERE uid = $uid AND CONCAT_WS(' ',prefix,number,name,lastname,city) LIKE '$search' ORDER BY id DESC LIMIT " . $offset . "," . $perpage;			
		}		
		global $db; // get pdo connection Conn()
		$st = $db->query($sql);
		$row = $st->fetchAll(PDO::FETCH_ASSOC);

		if ($st->rowCount() > 0) {
			echo '<p class="pagine"><a class="pagelink" href="?page='.$pageprev.'"> Poprzednia</a>';
			echo '<a class="pagelink"> '.$page.' </a>';
			if ($page < $pages) {
				echo '<a class="pagelink" href="?page='.$pagenext.'"> Nastepna</a></p>';
			}
		}
		return $row;
	}

// pobierz linki i wyświetl tabelkę
$links = pagine($uid);

?>
