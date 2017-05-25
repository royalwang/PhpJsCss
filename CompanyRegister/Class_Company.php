<?php
/**
* Company_Class.php
*/
class Company
{
	public $db;
	
	function __construct()
	{
		if(empty(session_id()))session_start();
		header('Content-Type: text/html; charset=utf-8');
		$this->db =  $this->Conn();
	}	

	// PDO database connection
	function Conn($user = 'root', $pass = '', $db = 'sms', $host = 'localhost'){
		$c = new PDO('mysql:host='.$host.';dbname='.$db.';mysql:charset=utf8', $user, $pass);
		// don't cache query
		$c->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		// show warning text
		$c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		// throw error exception
		$c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// don't colose connecion on script end
		$c->setAttribute(PDO::ATTR_PERSISTENT, false);
		// set utf for c
		$c->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
		return $c;
	}

	// is user exists
	function Login($login, $pass){
		$login = htmlentities($login, ENT_QUOTES, 'UTF-8');
		$pass =md5($pass);
		try{
			$r = $this->db->query("SELECT * FROM company WHERE login = '$login' AND pass = '$pass' OR email = '$login' AND pass = '$pass'");	
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			if ($r->rowCount() == 1) {	
				$_SESSION['ip']  = $this->IP();
				$_SESSION['loged']  = $rows[0]['id'];
				$_SESSION['id']  = $rows[0]['id'];
				$_SESSION['login']  = $rows[0]['login'];
				$_SESSION['name']  = $rows[0]['name'];
				$_SESSION['address']  = $rows[0]['address'];
				$_SESSION['email']  = $rows[0]['email'];
				$_SESSION['mobile']  = $rows[0]['mobile'];
				$_SESSION['city']  = $rows[0]['city'];
				$_SESSION['nip']  = $rows[0]['nip'];
				$_SESSION['country']  = $rows[0]['country'];
				$_SESSION['www']  = $rows[0]['www'];
				$_SESSION['firstname']  = $rows[0]['firstname'];
				$_SESSION['lastname']  = $rows[0]['lastname'];
				$_SESSION['onlyprefix'] = (int)$rows[0]['onlyprefix'];
				$_SESSION['limit_email_free']  = $rows[0]['limit_email_free'];
				$_SESSION['limit_email']  = $rows[0]['limit_email'];
				return 1;
			}
		}catch(Exception $e){
			return 0;
		}
		return 0;		
	}

	function AddCompany($login,$email,$pass,$firstname,$lastname,$name,$nip,$address,$zip,$city,$country,$www,$mobile,$prefix,$typfirmy){		
		$login = htmlentities($login, ENT_QUOTES, 'UTF-8');
		$email = htmlentities($email, ENT_QUOTES, 'UTF-8');
		$pass = md5($pass);;
		$firstname = htmlentities($firstname, ENT_QUOTES, 'UTF-8');
		$lastname = htmlentities($lastname, ENT_QUOTES, 'UTF-8');
		$name = htmlentities($name, ENT_QUOTES, 'UTF-8');
		$nip = htmlentities($nip, ENT_QUOTES, 'UTF-8');
		$address = htmlentities($address, ENT_QUOTES, 'UTF-8');
		$zip = htmlentities($zip, ENT_QUOTES, 'UTF-8');
		$city = htmlentities($city, ENT_QUOTES, 'UTF-8');
		$country = htmlentities($country, ENT_QUOTES, 'UTF-8');
		$www = htmlentities($www, ENT_QUOTES, 'UTF-8');
		$prefix = (int)$prefix;
		$mobile = htmlentities($mobile, ENT_QUOTES, 'UTF-8');
		$typfirmy = (int)$typfirmy;
		$code = md5(time());
		$time = time();	
		$ip = $this->IP();
		// $ = htmlentities($, ENT_QUOTES, 'UTF-8');
		
		$error = "";
		// validate nip		
		if ($this->nip($nip) == 0) {
			$error = '{"error":"Zły nip"}';
		}

		// validate nip		
		if (strlen($mobile) != 9) {
			$error = '{"error":"Popraw numer telefonu"}';
		}

		// validate regon
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$error = '{"error":"Popraw adres email"}';
		}

		if ($error == "") {		
			try{
				$this->db->query("INSERT INTO company(`login`,`email`,`pass`,`firstname`,`lastname`,`name`,`nip`,`address`,`zip`,`city`,`country`,`www`,`mobile`,`prefix`,`code`,`active`,`time`,`ip`,`typfirmy`) VALUES('$login','$email', '$pass','$firstname','$lastname','$name','$nip','$address','$zip','$city','$country','$www','$mobile',$prefix,'$code',0, $time, '$ip', $typfirmy)");
				$lid = $this->db->lastInsertId();
				if ($lid > 0) {
					$msg = 'Witaj na qflash.pl! <br> Twój link aktywujący konto <a href="https://qflash.pl/aktywacja.php?code='.$code.'&time='.$time.'"> Aktywuj konto </a> <br> Pozdrawiamy <br> Qflash.pl';
					if ($this->SendEmail($email, $msg) > 0) {
						return $lid;
					}
				}
				return $lid;
			}catch(Exception $e){
				if ($e->errorInfo[1] == 1062) {
				  	// duplicate entry, do something else
					return '{"error":"Konto z takim adresem email już istnieje."}';
				} else {			  	
					return '{"error":"ERR_0"}';
				}	
			}
		}
		return $error;
	}

	function ActivateAccount($code,$time){
		$c = htmlentities($code, ENT_QUOTES, 'UTF-8');
		$t = htmlentities($time, ENT_QUOTES, 'UTF-8');
		try{
			$r = $this->db->query("SELECT * FROM company WHERE code = '$c' AND time = '$t' AND active = 0");			
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			if ($r->rowCount() == 1) {					
				$r = $this->db->query("UPDATE company SET active = 1 WHERE code = '$c' AND time = '$t'");	
				return 1;
			}else{
				return 0;
			}	
		}catch(Exception $e){
			return -1;
		}	
	}

	// OK testowane
	function ResendActivationEmail($email, $domena = 'qflash.pl'){
		$e = htmlentities($email, ENT_QUOTES, 'UTF-8');		
		try{
			$r = $this->db->query("SELECT code,time FROM company WHERE email = '$e' and active = 0");			
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			if ($r->rowCount() == 1) {		
				$code = $rows[0]['code'];
				$time = $rows[0]['time'];
				$msg = 'Witaj na qflash.pl! <br> Twój link aktywujący konto <a href="https://'.$domena.'/aktywacja.php?code='.$code.'&time='.$time.'"> Aktywuj konto </a> <br> Pozdrawiamy <br> Qflash.pl';
				if ($this->SendEmail($email, $msg) > 0) {
					return 1;
				}else{
					return 0;
				}
			}else{
				return 0;
			}	
		}catch(Exception $e){
			return -1;
		}	
	}

	// OK sprawdzone
	function ResetPassword($email, $domena = 'qflash.pl'){
		$e = htmlentities($email, ENT_QUOTES, 'UTF-8');		
		try{
			$r = $this->db->query("SELECT code,time FROM company WHERE email = '$e'");			
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			if ($r->rowCount() == 1) {		
				$pas = rand(123456,987987);				
				$md5 = md5($pas);
				$msg = 'Witaj na qflash.pl! <br> Nowe hasło do konta: '.$pas.' <br> <a href="https://'.$domena.'/login.php"> Zaloguj się </a> <br> Pozdrawiamy <br> Qflash.pl';
				if ($this->SendEmail($email, $msg) > 0) {
					$r = $this->db->query("UPDATE company SET pass = '$md5' WHERE email = '$e'");
					if ($r->rowCount() == 1) {	
						return 1;
					}else{
						return 0;
					}
				}else{
					return 0;
				}
			}else{
				return 0;
			}	
		}catch(Exception $e){
			return -1;
		}	
	}	

	function ApiCreateUser(){
		global $ApiPass;
		global $ApiUser;		
		$url = 'https://api.smsapi.pl/user.do?username='.$ApiUser.'&password='.$ApiPass.'&add_user=heniek_1&pass='.md5('pass').'&limit=1&active=1&format=json';
		echo file_get_contents($url);	
	}

	// Wyślij email
	function SendEmail($email, $msg, $subject = 'Aktywacja konta Qflash.pl', $from_user = "Qflash.pl SMS Newsletter", $from_email = "info@qflash.pl")
   	{
   		ini_set("sendmail_from", $from_email);
      	$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
      	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";      	
      	$headers = "From: $from_user <$from_email>" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n" . "Reply-to: <$from_email>" . "\r\n";
    	return mail($email, $subject, $msg , $headers);
   	}

   	// send help message
	function HelpMsg($email,$name,$msg){		
		$msg = htmlentities($msg, ENT_QUOTES, 'UTF-8');
		$email = htmlentities($email, ENT_QUOTES, 'UTF-8');
		$name = htmlentities($name, ENT_QUOTES, 'UTF-8');
		$time = time();	
		$ip = $this->IP();
		// $ = htmlentities($, ENT_QUOTES, 'UTF-8');
		
		$error = "";
		// validate nip		
		if (empty($email) || empty($msg) || empty($name) ) {
			$error = '{"error":"Uzupełnij wszystkie pola formularza."}';
		}else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$error = '{"error":"Popraw adres email"}';
		}

		if ($error == "") {		
			$time = time() - 60*5;
			$r = $this->db->query("SELECT * FROM help WHERE email = '$email' AND msg = '$msg' AND time < $time");	
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			if ($r->rowCount() == 0) {	
				try{
					$sessid = md5(session_id());
					$this->db->query("INSERT INTO help(`email`,`name`,`msg`,`time`,`ip`,`sessid`) VALUES('$email','$name','$msg', $time, '$ip', '$sessid')");
					return $this->db->lastInsertId();
				}catch(Exception $e){
					if ($e->errorInfo[1] == 1062) {				  	
						return '{"error":"USER_EXISTS"}';
					} else {			  	
						return '{"error":"ERR_0"}';
					}	
				}
			}else{
				return '{"error":"Wiadomość już została wysłana!"}';
			}
		}
		return $error;
	}

	// search text firmy
	function GetCompany($word){		
		try{
			$r = $this->db->query("SELECT * FROM company WHERE CONCAT_WS('', login, name, email, city, address, www, mobile ) LIKE '%$word%'");	
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			if ($r->rowCount() > 0) {	
				return json_encode($rows);
			}
		}catch(Exception $e){
			return 0;
		}		
		return 0;
	}

	function Show($s){
		$s = json_decode($s,true);
		foreach ($s as $k => $v) {
			echo $v['email']. ' ' .$v['name'] . ' '.$v['address'] . '<br>';
		}
	}

	// validate nip
	function nip($str)
	{
		if (strlen($str) != 10){return 0;}
		$arrSteps = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
		$intSum=0;
		for ($i = 0; $i < 9; $i++){
			$intSum += $arrSteps[$i] * $str[$i];
		}
		$int = $intSum % 11;
		$intControlNr=($int == 10)?0:$int;
		if ($intControlNr == $str[9]){ return 1; }
			return 0;
	}

	// Check nip number
	function nip2($nip) {
		if ($nip == '') return false;
		$chr_to_replace = array('-', ' '); // get rid of these characters
		$nip = str_replace($chr_to_replace, '', $nip);
		if (! is_numeric($nip)) return false;
		$weights = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
		$digits = str_split($nip);
		$digits_length = count($digits);
		for ($i = 1; $i < $digits_length; $i++) {
		if ($digits[0] != $digits[$i]) break;
		if ($digits[0] == $digits[$i] && $i == $digits_length - 1) return false;
		}//end for
		$in_control_number = intval(array_pop($digits));
		$sum = 0;
		$weights_length = count($weights);
		for ($i = 0; $i < $weights_length; $i++) {
		$sum += $weights[$i] * intval($digits[$i]);
		}//end for
		$modulo = $sum % 11;
		$control_number = ($modulo == 10) ? 0 : $modulo;
		return $in_control_number == $control_number;
	}

	// Send confirmation email
	function mail_register($email, $from_user = "Breakermind.com", $from_email = "mail@breakermind.com", $subject = 'Witaj! Potwierdź swój adres email.')
   	{
   		ini_set("sendmail_from", $from_email);
      	$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
      	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";      	
      	$headers = "From: $from_user <$from_email>" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n" . "Reply-to: <$from_email>" . "\r\n";
    	return mail($email, $subject, 'Witaj! Twoje konto zostało utworzone. Jeśli to nie Ty usuń tego emaila.' , $headers);
   	}	

   	// Get user ip address
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

try{
	// Create object
	//$com = new Company();

	// Add company fi not exist return ID or error
	// echo $com->AddCompany('breakermind','hello@breakermind.com','pass','Marcin','Marcinkowski','Breakermind.com','0000000000','Złota 4','00300','Warszawa','PL','https://breakermind.com','000000000',48);

	// Get companies with text
	//$s = $com->GetCompany('brea');
	// Show companies
	//$com->Show($s);

	// Login return 1 if exist and add info to session
	//$com->Login('breakermind','pass');
	// print_r($_SESSION);

}catch(Exception $e){
	echo "Syntax Error: ".$e->getMessage();
}

?>
