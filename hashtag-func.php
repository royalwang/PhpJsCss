<?php
// PDO Connection
function Conn(){
// if utf8 del 'mb4' and set utf8_general_ci	
$connection = new PDO('mysql:host=localhost;dbname=xmail;mysql:charset=utf8mb4', 'root', 'toor');
// don't cache query
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// show warning text
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// throw error exception
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// don't colose connecion on script end
$connection->setAttribute(PDO::ATTR_PERSISTENT, false);
// set utf8mb4 or utf8 for connection and results
$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
return $connection;
}

// połącz do bazy danych PDO
$db = Conn();
// text
$srt = "#ForexHolyGrail graj na #GBPJPY #US30 #WTI poziomy #500Pips (np. 105,110,115 gbpjpy) lub poziomy #WeekOpen, #MonthOpen. Maksymalnie pozycja 0.01 na każde 100$. And do not stress just relax :]. Have a good fun ...";
// use
hashtag($str, 'id456', $db);

function hashtag($str = '', $postid ,$PDO = 'PDO connection', $pl = '1'){		
       if($pl == '1'){
	 // hashtag z polskimi literami
	 preg_match_all("/#[^\s]*/i", $str, $tagall);
	}else{
	 // hashtag bez polskich liter
	  preg_match_all("/#(\w+[0-9-_a-zA-Z]\w+)/", $str, $tagall);	
	}
	
	// zamień hastagi na linki
	foreach (array_unique($tagall[0]) as $v) {
	  $out .= str_replace($v, '<a class="hashtag" href="//hashtag.php?hash='.$v.'" >'.$v.'</a>', $str);
	}
	echo $out;
	
	// zapisz hashtagi do bazy danych
	foreach (array_unique($tagall[0]) as $v) {
	  $q = "INSERT INTO hashtag(hashtag,post) VALUES('$v','$postid')";		
	  $sth = $PDO->exec($q);
	}
}
?>
