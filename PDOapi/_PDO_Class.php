<?php
/**
* Login class
*
* Breakermind Server WebMail (breakermind.com)
* Author: Marcin Łukaszewski
* Contact: hello@breakermind.com
* 2017 All rights reserver
* Copyrights 2017
*/
class Main{	
	
	// pdo connection pointer
	public $db;

	// Konstruktor
	function __construct() {
		$this->db = $this->Conn();
	}

	// Mysql connect	
	function Conn(){
		try{
			// data from config file globals variables
			global $mysqlhost, $mysqluser, $mysqlpass, $mysqlport, $mysqldb;
			// pdo
			$conn = new PDO('mysql:host='.$mysqlhost.';port='.$mysqlport.';dbname='.$mysqldb.';charset=utf8', $mysqluser, $mysqlpass);
			// don't cache query
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			// show warning text
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			// throw error exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// don't colose connecion on script end
			$conn->setAttribute(PDO::ATTR_PERSISTENT, false);
			// set utf for connection utf8_general_ci or utf8_unicode_ci 
			$conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
			// PDO SSL
			// $conn = new PDO('mysql:host='.$mysqlhost.';port='.$mysqlport.';dbname='.$mysqldb.';charset=utf8', $mysqluser, $mysqlpass,array( PDO::MYSQL_ATTR_SSL_KEY    =>'/path/to/client-key.pem', PDO::MYSQL_ATTR_SSL_CERT=>'/path/to/client-cert.pem', PDO::MYSQL_ATTR_SSL_CA    =>'/path/to/ca-cert.pem'));
			// Or
			// $conn->setAttribute(PDO::MYSQL_ATTR_SSL_KEY => '/path/to/client-key.pem');
			// $conn->setAttribute(PDO::MYSQL_ATTR_SSL_CERT => '/path/to/client-cert.pem');
			// $conn->setAttribute(PDO::MYSQL_ATTR_SSL_CA => '/path/to/ca-cert.pem');			
			return $conn;
		}catch(Exception $e){
			echo "Mysql connection error!!!";
			return 0;
		}
		// $rows = $res->fetchAll(PDO::FETCH_ASSOC);
		// $cnt = $res->rowCount();
		// $id = $this->db->lastInsertId();
	}

	// Create new user mailbox
	function Register(){
		global $enableRegister, $registerDomain;
		// if allowed
		if($enableRegister && isset($_POST['adduser'])){
			// Add new mailbox here
			if (!empty($_POST['email']) && strlen($_POST['pass1']) >= 6 && ($_POST['pass1'] == $_POST['pass2'])) {
				// Main domain email
				$email = preg_replace('/[^a-z0-9-.]/', '', strtolower($_POST['email']));
				$email = $email.'@'.$registerDomain;
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					// Add mailbox
					$uid = $this->CreateMailbox($email, $_POST['pass1'], $_POST['name']);
					// Error or ok
					if($uid > 0){ echo '<div class="notice borderb color animated flipInX">You have got new account now ! Mailbox name: <b><a href="index.php?email='.$email.'">'.$email.'</a></b></div>'; }	
					if($uid == 0){ echo '<div class="notice borderb color animated flipInX">Error! Try again leater.</div>';	}
					if($uid == -1){ echo '<div class="notice borderb color animated flipInX">Account with this name exist.</div>'; }
				}else{
					echo '<div class="notice animated flipInX">Register error! Invalid username. Password min. 6 characters.</div>';
				}
			}else{
				echo '<div class="notice animated flipInX">Register error! Fill all fields. Username (Only letters,numbers,- and .(dot)) Password min. 6 characters.</div>';
			}
		}
		// If not allowed
		if(!$enableRegister && isset($_POST['adduser'])){
			echo '<div class="notice">You can\'t create new account. Registration disabled.</div>';
		}		
	}

	// Create new mailbox
	function CreateMailbox($email, $pass, $name){
		try{
			$name = htmlentities($name,ENT_QUOTES,'utf-8');
			$email = htmlentities($email,ENT_QUOTES,'utf-8');
			$pass = md5($pass);
			// if valid email
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$r = $this->db->query("INSERT INTO mailbox(email,pass,name) VALUES ('$email','$pass','$name')");
				return $id = $this->db->lastInsertId();
			}else{
				return 0;
			}
		}catch(Exception $e){			
			if ($e->getCode() == '23000'){
				return -1;
			}
			if ($e->getCode() == '2A000'){
        		// echo "Syntax Error: ".$e->getMessage();
			}
			return 0;
		}
		return 0;
	}

	function Login(){
		try{
			if(!empty($_POST['login'])){
				if(!empty($_POST['email']) && !empty($_POST['pass'])) {
					$email = htmlentities($_POST['email'],ENT_QUOTES,'utf-8');
					$pass = md5($_POST['pass']);
					// select
					$r = $this->db->query("SELECT id,email,name FROM mailbox WHERE email = '$email' AND pass = '$pass' AND active = 1 AND ban = 0");
					// get email,name,id
					$rows = $r->fetchAll(PDO::FETCH_ASSOC);
					// cnt
					$cnt = $r->rowCount();
					if($cnt > 0){
						// Set in session
						$_SESSION['mailboxid'] = (int)$rows[0]['id'];
						$_SESSION['mailboxemail'] = $rows[0]['email'];
						$_SESSION['mailboxname'] = $rows[0]['name'];
					}else{
						echo '<div class="notice animated flipInX">Mailbox with this name does not exist.</div>';	
					}
					return $cnt;
				}else{
					echo '<div class="notice animated flipInX">Email or password incorrect.</div>';
				}
			}			
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function Messages($folder, $page, $perpage){
		try{
			if($page <= 0){ $page = 1; }
			if($perpage <= 0){ $perpage = 10; }			
			$offset = (int)(($perpage * $page)-$perpage);
			// messages
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');
			$folder = (int)$folder;

			// policz wiadomości
			$r = $this->db->query("SELECT id FROM messages WHERE email_to = '$mailbox' AND folder = '$folder' AND active = 1 AND ban = 0 AND send = 0");
			$allmessages = $r->rowCount();
			// get all pages number
			global $allpages;
			if(($allmessages%$perpage) > 0){
				$allpages = (int)($allmessages/$perpage)+1;
			}else{
				$allpages = (int)($allmessages/$perpage);				
			}
			// if page > max pages number
			if($page > $allpages){ 
				$page = $allpages; 
				$offset = (int)(($perpage * $page)-$perpage); 
			} 

			// select
			$r = $this->db->query("SELECT id,email_from,email_to,email_subject,time,folder,seen,flaged,favorite,spf,size,send,spam FROM messages WHERE email_to = '$mailbox' AND folder = '$folder' AND active = 1 AND ban = 0 AND send = 0 ORDER BY id DESC LIMIT $offset,$perpage");
			// get email,name,id
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			// cnt
			$cnt = $r->rowCount();
			if($cnt > 0){
				return $rows;
			}
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function MessagesSent($folder, $page, $perpage){
		try{
			if($page <= 0){ $page = 1; }
			if($perpage <= 0){ $perpage = 10; }			
			$offset = (int)(($perpage * $page)-$perpage);
			// messages
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');
			$folder = (int)$folder;

			// policz wiadomości
			$r = $this->db->query("SELECT id FROM messages WHERE email_from = '$mailbox' AND folder = '$folder' AND active = 1 AND ban = 0 AND send = 1");
			$allmessages = $r->rowCount();
			// get all pages number
			global $allpages;
			if(($allmessages%$perpage) > 0){
				$allpages = (int)($allmessages/$perpage)+1;
			}else{
				$allpages = (int)($allmessages/$perpage);				
			}
			// if page > max pages number
			if($page > $allpages){ 
				$page = $allpages; 
				$offset = (int)(($perpage * $page)-$perpage); 
			} 

			// select
			$r = $this->db->query("SELECT id,email_from,email_to,email_subject,time,folder,seen,flaged,favorite,spf,size,send FROM messages WHERE email_from = '$mailbox' AND folder = '$folder' AND active = 1 AND ban = 0 AND send = 1 ORDER BY id DESC LIMIT $offset,$perpage");
			// get email,name,id
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			// cnt
			$cnt = $r->rowCount();
			if($cnt > 0){
				return $rows;
			}
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function MessagesFavorites($folder, $page, $perpage){
		try{
			if($page <= 0){ $page = 1; }
			if($perpage <= 0){ $perpage = 10; }			
			$offset = (int)(($perpage * $page)-$perpage);
			// messages
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');
			$folder = (int)$folder;

			// policz wiadomości
			$r = $this->db->query("SELECT id FROM messages WHERE email_to = '$mailbox' AND active = 1 AND ban = 0 AND send = 0 AND favorite = 1");
			$allmessages = $r->rowCount();
			// get all pages number
			global $allpages;
			if(($allmessages%$perpage) > 0){
				$allpages = (int)($allmessages/$perpage)+1;
			}else{
				$allpages = (int)($allmessages/$perpage);				
			}
			// if page > max pages number
			if($page > $allpages){ 
				$page = $allpages; 
				$offset = (int)(($perpage * $page)-$perpage); 
			} 

			// select
			$r = $this->db->query("SELECT id,email_from,email_to,email_subject,time,folder,seen,flaged,favorite,spf,size FROM messages WHERE email_to = '$mailbox' AND active = 1 AND ban = 0 AND send = 0 AND favorite = 1 ORDER BY id DESC LIMIT $offset,$perpage");
			// get email,name,id
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			// cnt
			$cnt = $r->rowCount();
			if($cnt > 0){
				return $rows;
			}
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function MessagesFlagged($folder, $page, $perpage){
		try{
			if($page <= 0){ $page = 1; }
			if($perpage <= 0){ $perpage = 10; }			
			$offset = (int)(($perpage * $page)-$perpage);
			// messages
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');
			$folder = (int)$folder;

			// policz wiadomości
			$r = $this->db->query("SELECT id FROM messages WHERE email_to = '$mailbox' AND active = 1 AND ban = 0 AND send = 0 AND flaged = 1");
			$allmessages = $r->rowCount();
			// get all pages number
			global $allpages;
			if(($allmessages%$perpage) > 0){
				$allpages = (int)($allmessages/$perpage)+1;
			}else{
				$allpages = (int)($allmessages/$perpage);				
			}
			// if page > max pages number
			if($page > $allpages){ 
				$page = $allpages; 
				$offset = (int)(($perpage * $page)-$perpage); 
			} 

			// select
			$r = $this->db->query("SELECT id,email_from,email_to,email_subject,time,folder,seen,flaged,favorite,spf,size FROM messages WHERE email_to = '$mailbox' AND active = 1 AND ban = 0 AND send = 0 AND flaged = 1 ORDER BY id DESC LIMIT $offset,$perpage");
			// get email,name,id
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			// cnt
			$cnt = $r->rowCount();
			if($cnt > 0){
				return $rows;
			}
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function MessageID($id){
		try{
			// mid			
			$id = (int)$id;
			// message email to
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');			

			// policz wiadomości
			$r = $this->db->query("SELECT * FROM messages WHERE email_to = '$mailbox' AND id = '$id' AND active = 1 AND ban = 0 AND send = 0");
			$row = $r->fetchAll(PDO::FETCH_ASSOC);			
			$cnt = $r->rowCount();
			if($cnt > 0){
				return $row;
			}
		}catch(Exception $e){						
			return $row;
		}
		return $row;
	}

	function MessageIDSent($id){
		try{
			// mid			
			$id = (int)$id;
			// message email to
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');			

			// policz wiadomości
			$r = $this->db->query("SELECT * FROM messages WHERE email_from = '$mailbox' AND id = '$id' AND active = 1 AND ban = 0 AND send = 1");
			$row = $r->fetchAll(PDO::FETCH_ASSOC);			
			$cnt = $r->rowCount();
			if($cnt > 0){
				return $row;
			}
		}catch(Exception $e){						
			return $row;
		}
		return $row;
	}

	function MessagesSetRead($id){
		try{
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');
			$id = (int)$id;
			// unrewaded messages
			$r = $this->db->query("UPDATE messages SET seen = 1 WHERE email_to = '$mailbox' AND id = '$id' AND active = 1 AND ban = 0  AND send = 0");
			return $id = $r->rowCount();
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function MessagesSetFavorite($id){
		try{
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');
			$id = (int)$id;
			// unrewaded messages
			$r = $this->db->query("UPDATE messages SET favorite = IF(favorite > 0,'0','1') WHERE email_to = '$mailbox' AND id = '$id' AND active = 1 AND ban = 0 AND send = 0");
			return $id = $r->rowCount();
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function MessagesSetFlagged($id){
		try{
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');
			$id = (int)$id;
			// unrewaded messages
			$r = $this->db->query("UPDATE messages SET flaged = IF(flaged > 0,'0','1') WHERE email_to = '$mailbox' AND id = '$id' AND active = 1 AND ban = 0 AND send = 0");
			return $id = $r->rowCount();
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function MessagesSetFolder($messageid, $folderid){
		try{
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');
			$id = (int)$messageid;
			$folder = (int)$folderid;
			if ($folder < 1) { $folder = 1; }
			// unrewaded messages
			$r = $this->db->query("UPDATE messages SET folder = '$folder' WHERE email_to = '$mailbox' AND id = '$id' AND active = 1 AND ban = 0 AND send = 0");
			return $id = $r->rowCount();
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	// Set ban = 1 delete message
	function MessagesDelete($messageid){
		try{
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');
			$id = (int)$messageid;
			$folder = (int)$folderid;
			if ($folder < 1) { $folder = 1; }
			// set message as deleted ban = 1
			$r = $this->db->query("UPDATE messages SET ban = 1 WHERE email_from = '$mailbox' AND id = '$id' AND active = 1 AND ban = 0 AND send = 1");
			return $id = $r->rowCount();
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	// Move to folder 0 not visible
	function MessagesDeleteInbox($messageid){
		try{
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');
			$id = (int)$messageid;
			$folder = (int)$folderid;
			if ($folder < 1) { $folder = 1; }
			// unrewaded messages
			$r = $this->db->query("UPDATE messages SET folder = 0 WHERE email_to = '$mailbox' AND id = '$id' AND active = 1 AND ban = 0 AND send = 0");
			return $id = $r->rowCount();
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function MessagesUnread($folder){
		try{
			$mailbox = htmlentities($_SESSION['mailboxemail'],ENT_QUOTES,'utf-8');
			$folder = (int)$folder;
			// unrewaded messages
			$r = $this->db->query("SELECT id FROM messages WHERE email_to = '$mailbox' AND folder = '$folder' AND active = 1 AND ban = 0 AND send = 0 AND seen = 0");
			$cnt = $r->rowCount();
		}catch(Exception $e){						
			return $cnt;
		}
		return $cnt;
	}

	// user ip
	function IP() {
	    $ipa = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipa = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipa = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipa = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipa = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipa = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipa = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipa = $_SERVER['REMOTE_ADDR'];
	    return $ipa;
	}

	// Wyślij email potwierdzający subscrybcję newsletter.php
	function AktywacjaNewslettera($email, $code, $domena = 'qflash.pl') {
		$subject = 'Aktywacja newslettera Qflash.pl'; 
		$from_user = "Qflash.pl Email Newsletter";
		$from_email = "info@qflash.pl";   	
   		$msg = 'Witaj na qflash.pl! <br> Twój link aktywujący newsletter <a href="https://'.$domena.'/aktywacja-newslettera.php?code='.$code.'"> Aktywacja newslettera </a> <br> Pozdrawiamy <br> Qflash.pl';

   		ini_set("sendmail_from", $from_email);
      	$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
      	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
      	$headers = "From: $from_user <$from_email>" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n" . "Reply-to: <$from_email>" . "\r\n";
    	return mail($email, $subject, $msg , $headers);
   	}	
}

/*
// javascript filter
function strip_javascript($filter, $allowed=0){
if($allowed == 0) // 1 href=...
$filter = preg_replace('/href=([\'"]).*?javascript:.*?\\1/i', "'", $filter);

if($allowed == 0) // 2 <script....
$filter = preg_replace("/<script.*?>.*?<\/script>/i", "", $filter);

if($allowed == 0) // 4 <tag on.... ---- useful for onlick or onload
$filter = preg_replace("/<(.*)?\son.+?=\s*?(['\"]).*?\\2/i", "<$1", $filter);
return $filter;
}
*/
