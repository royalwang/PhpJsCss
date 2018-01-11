<?php
/**
* Account
*/
class Account
{	
	// pdo connection pointer
	public $db;
	public $mysqlhost = "localhost";
	public $mysqluser ="root";
	public $mysqlpass = "";
	public $mysqlport = "3306";
	public $mysqldb = "freeemail";

	// Konstruktor
	function __construct() {
		$this->db = $this->Conn();
		// $dbh->exec("CREATE DATABASE `".$this->$mysqldb."`; CREATE USER 'freemail'@'localhost' IDENTIFIED BY 'toor'; GRANT ALL ON `".$this->$mysqldb."`.* TO 'freemail'@'localhost'; FLUSH PRIVILEGES;") or die(print_r($dbh->errorInfo(), true));
		// $dbh->exec("CREATE DATABASE IF NOT EXISTS `freemail`;") or die(print_r($dbh->errorInfo(), true));
	}

		// Mysql connect	
	function Conn(){
		try{
			// pdo
			$conn = new PDO('mysql:host='.$this->mysqlhost.';port='.$this->mysqlport.';dbname='.$this->mysqldb.';charset=utf8', $this->mysqluser, $this->mysqlpass);
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
			// Buffered querry
			// $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true);
			
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
		// buffered query
		// $stmt = $db->prepare('select * from foo', array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true)
	}

	function Login($email, $pass){
		try{
			if(!empty($_POST['login'])){
				if(!empty($email) && !empty($pass)) {
					$email = htmlentities($_POST['email'],ENT_QUOTES,'utf-8');
					$pass = md5($_POST['pass1']);
					// select
					$r = $this->db->query("SELECT id,email,username FROM users WHERE email = '$email' AND pass = '$pass' AND active = 1 AND ban = 0");
					// get email,name,id
					$rows = $r->fetchAll(PDO::FETCH_ASSOC);
					// cnt
					$cnt = $r->rowCount();
					if($cnt > 0){
						// Set in session
						$_SESSION['userid'] = (int)$rows[0]['id'];
						$_SESSION['useremail'] = $rows[0]['email'];
						$_SESSION['username'] = $rows[0]['username'];
					}else{
						return 0;
					}
					return $cnt;
				}else{
					return 0;
				}
			}			
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	// Create new user
	function Register($email, $pass1, $pass2, $username){	
		if (!empty($email) && !empty($username) && !empty($pass1) && ($pass1 == $pass2)) {
			// Main domain email			
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				// Add User account				
				return $uid = $this->CreateUser($email, $pass1, $username, $this->IP());				
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}

	// Create new user
	function CreateUser($email, $pass, $name, $ip = "0.0.0.0"){
		try{
			// $email = preg_replace('/[^a-z0-9-.]/', '', strtolower($_POST['email']));
			$name = htmlentities($name,ENT_QUOTES,'utf-8');
			$email = htmlentities($email,ENT_QUOTES,'utf-8');
			$pass = md5($pass);
			$ip = htmlentities($ip,ENT_QUOTES,'utf-8');
			// if valid email
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				// $code = $this->getActivateCode($email);
				$code = rand(123456,999999);
				$ok = $this->AktywacjaNewslettera($email, $code);
				if($ok == 1){
					$r = $this->db->query("INSERT INTO users(email,pass,username,ip,active,code) VALUES ('$email','$pass','$name','$ip',0,'$code')");
					return $id = $this->db->lastInsertId();
				}
				return 0;
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

	function Reset($email){
		try{
			$mailbox = htmlentities($email,ENT_QUOTES,'utf-8');
			$pass = rand(123123123,999999999);
			// send email
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$ok = $this->sendEmail($mailbox, $pass);
				if($ok == 1){				
					$r = $this->db->query("UPDATE users SET pass = '$pass' WHERE email = '$mailbox' AND active = 1 AND ban = 0");
					return $r->rowCount();
				}
			}			
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function ActivateUser($code){
		try{
			$code = htmlentities($code,ENT_QUOTES,'utf-8');
			$r = $this->db->query("UPDATE users SET active = 1, code = 0 WHERE code = '$code' AND active = 0 AND ban = 0");
			return $r->rowCount();			
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function getEmailTemplates($userid){
		try{
			// mid			
			$userid = (int)$userid;	
			$r = $this->db->query("SELECT id,uid,title FROM email_template WHERE uid = '$userid' AND active = 1");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			$cnt = $r->rowCount();
			if($cnt > 0){
				return $rows;
			}
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function getTemplateID($id){
		try{
			// template id
			$id = (int)$id;
			// user id
			$userid = (int)$_SESSION['userid'];
			$r = $this->db->query("SELECT html FROM email_template WHERE uid = '$userid' AND id = '$id' AND active = 1");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			$cnt = $r->rowCount();
			if($cnt > 0){
				return $rows;
			}
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function delTemplateID($id){
		try{
			// template id
			$id = (int)$id;
			// user id
			$userid = (int)$_SESSION['userid'];
			$r = $this->db->query("UPDATE email_template SET active = 0 WHERE uid = '$userid' AND id = '$id'");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			return $r->rowCount();
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function AddTemplate($uid, $title, $html){
		try{
			$uid = (int)$uid;
			$title = htmlentities($title,ENT_QUOTES,'utf-8');
			$html = htmlentities($html,ENT_QUOTES,'utf-8');
			$r = $this->db->query("INSERT INTO email_template(uid,title,html) VALUES ($uid,'$title','$html')");
			return $this->db->lastInsertId();
			// return $r->rowCount();
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	function getActivateCode($email){
		try{			
			$email = htmlentities($email,ENT_QUOTES,'utf-8');			
			// policz wiadomości
			$r = $this->db->query("SELECT code FROM users WHERE email = '$email' AND active = 1 AND ban = 0");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			$cnt = $r->rowCount();
			if($cnt > 0){
				return $rows[0]['code'];
			}
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	// Wyślij email potwierdzający subscrybcję newsletter.php
	function AktywacjaNewslettera($email, $code, $domena = 'breakermind.com') {
		$subject = 'Aktywacja newslettera Qflash.pl'; 
		$from_user = "Breakermind.com Email Newsletter";
		$from_email = "freeemail@breakermind.com";   	
   		$msg = 'Hello from Freeemail! <br> Your activation link <a href="https://'.$domena.'/activate.php?code='.$code.'"> Activate free newsletter account! </a> <br> Pozdrawiamy <br> Qflash.pl';
   		ini_set("sendmail_from", $from_email);
      	$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
      	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
      	$headers = "From: $from_user <$from_email>" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n" . "Reply-to: <$from_email>" . "\r\n";
      	$o = mail($email, $subject, $msg, $headers);
      	if (!empty($o)) {
      		return $o;
      	}
    	return 0;
   	}

   	function sendEmail($email, $code) {
		$subject = 'Free email newsletter password'; 
		$from_user = "Freeemail";
		$from_email = "freeemail@breakermind.com";   	
   		$msg = 'Hello ! <br> Your new password: '.$code.' <br> Pozdrawiamy <br> freeemail.breakermind.com';
   		ini_set("sendmail_from", $from_email);
      	$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
      	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
      	$headers = "From: $from_user <$from_email>" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n" . "Reply-to: <$from_email>" . "\r\n";
    	return mail($email, $subject, $msg , $headers);
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

}
