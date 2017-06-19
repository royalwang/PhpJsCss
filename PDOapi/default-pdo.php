<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

// load config
require('config.php');

// sent email like
ini_set("sendmail_from", $sendmail_from);

// max upload file size
ini_set('post_max_size', '200M');
ini_set('upload_max_filesize', '200M');

// PDO
function Conn(){
global $mhost,$mport,$muser,$mpass,$mdatabase;
$connection = new PDO('mysql:host='.$mhost.';port='.$mport.';dbname='.$mdatabase.';charset=utf8', $muser, $mpass);
// don't cache query
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// show warning text
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// throw error exception
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// don't colose connecion on script end
$connection->setAttribute(PDO::ATTR_PERSISTENT, false);
// set utf for connection utf8_general_ci or utf8_unicode_ci 
$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
return $connection;
}

function Clear(){
  foreach ($_GET as $key => $val) { 
      if (is_string($val)) { 
          $_GET[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
      } else if (is_array($val)) { 
          $_GET[$key] = Clear($val); 
      } 
  } 
  foreach ($_POST as $key => $val) { 
      if (is_string($val)) { 
          $_POST[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
      } else if (is_array($val)) { 
          $_POST[$key] = Clear($val); 
      } 
  } 
}

// db connection
$db = Conn();

// clear POST and GET
Clear();

// dodaj wiadomość
function AddKontaktMessage($imie,$email,$mobile,$opis){
	global $db, $sunemail;
	$id = 0;
	$time = time();
	if (validEmail($email)) {
		$r = $db->query("INSERT INTO kontakt_messages(imie,email,mobile,opis,time) VALUES('$imie','$email','$mobile','$opis',$time)");
		$id = $db->lastInsertId();
		// $row = $r->fetch(PDO::FETCH_ASSOC);
		// $r->rowCount();
		if ($id > 0) {
			mail($sunemail, "Nowa wiadomość od klienta (kontakt)", "Otrzymałeś/aś nową wiadomość od klienta.");
		}
		return $id;
	}else{
		return 0;
	}
}

// zveryfikuj adres email
function validEmail($email){
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	 return 1;
	} else {
	  return 0;
	}
}

// dodaj wiadomość
echo AddKontaktMessage("Bax","email@email.com","+48000666999","Hello from kontakt form");

echo "OK";
?>
