<?php

	// PDO mysql database connection
	function Conn(){
		global $mhost,$mport,$muser,$mpass,$mdatabase;
		$connection = new PDO('mysql:host='.$mhost.';port='.$mport.';dbname='.$mdatabase.';charset=utf8', $muser, $mpass);
		$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connection->setAttribute(PDO::ATTR_PERSISTENT, false);
		$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
		return $connection;
	}

	// Prevent Sql injection
	function Clear(){
	  foreach ($_GET as $key => $val) { 
	  	$val = clearPHP($val);
	      if (is_string($val)) { 
	          $_GET[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
	      } else if (is_array($val)) { 
	          $_GET[$key] = Clear($val); 
	      } 
	  } 
	  foreach ($_POST as $key => $val) { 
	  	$val = clearPHP($val);
	      if (is_string($val)) { 
	          $_POST[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
	      } else if (is_array($val)) { 
	          $_POST[$key] = Clear($val); 
	      } 
	  } 
	}
  
  // Clear php tags
	function clearPHP($php){				
		/* return preg_replace('/^<\?php(.*)(\?>)?$/s', '$1', $php); */
		$s = str_replace('<?php', '', $php);
		$s = str_replace('<?', '', $s);
		$s = str_replace('<%', '', $s);
		$s = str_replace('?>', '', $s);
		return $s = str_replace('<script', '', $s);		
	}
  
// use this function before insert variable to mysql query
Clear();
$db = Conn();
// POST, GET
$nazwa = $_POST['nazwa'];
...
$time = (int)$_POST['time'];
// Query strings
$db->query("INSERT INTO ceny(nazwa,cena,opis,time) VALUES('$nazwa',$czas,$cena,'$opis',$time)");

// Thats all bye.
?>
