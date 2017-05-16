<?php
/**
* Company_Class.php
*/
class Company
{
	public $db;
	
	function __construct()
	{
		session_start();
		header('Content-Type: text/html; charset=utf-8');
		$this->db =  $this->Conn();
	}	

	// PDO database connection
	function Conn(){
		$c = new PDO('mysql:host=localhost;dbname=sms;mysql:charset=utf8', 'root', '');
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

		$r = $this->db->query("SELECT * FROM company WHERE login = '$login' AND pass = '$pass' OR email = '$login' AND pass = '$pass'");	
		$rows = $r->fetchAll(PDO::FETCH_ASSOC);
		if ($r->rowCount() == 1) {	
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
			return 1;
		}
		return 0;		
	}

	function AddCompany($login,$email,$pass,$firstname,$lastname,$name,$nip,$address,$zip,$city,$country,$www,$mobile){		
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
		$mobile = htmlentities($mobile, ENT_QUOTES, 'UTF-8');
		$code = md5(time());
		$time = time();	
		// $ = htmlentities($, ENT_QUOTES, 'UTF-8');
		$error = "";

		// validate nip
		if ($this->nip($nip) == 0) {
			$error = '{"error":"Zły nip"}';
		}

		// validate regon
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$error = '{"error":"Popraw adres email"}';
		}

		if ($error == "") {		
			try{
				$this->db->query("INSERT INTO company(`login`,`email`,`pass`,`firstname`,`lastname`,`name`,`nip`,`address`,`zip`,`city`,`country`,`www`,`mobile`,`code`,`active`,`time`) VALUES('$login','$email', '$pass','$firstname','$lastname','$name','$nip','$address','$zip','$city','$country','$www','$mobile','$code',1, $time);");
				return $this->db->lastInsertId();
			}catch(Exception $e){
				if ($e->errorInfo[1] == 1062) {
				  	// duplicate entry, do something else
					return '{"error":"USER_EXISTS"}';
				} else {			  	
					return '{"error":"ERR_0"}';
				}	
			}
		}
		return $error;
	}

	function GetCompany($word){		
		$r = $this->db->query("SELECT * FROM company WHERE CONCAT_WS('', login, name, email, city, address, www, mobile ) LIKE '%$word%'");	
		$rows = $r->fetchAll(PDO::FETCH_ASSOC);
		if ($r->rowCount() > 0) {	
			return json_encode($rows);
		}
		return 0;
	}

	function Show($s){
		$s = json_decode($s,true);
		foreach ($s as $k => $v) {
			echo $v['email']. ' ' .$v['name'] . ' '.$v['address'] . '<br>';
		}
	}

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

}

try{
// Create object
$com = new Company();

// Add company fi not exist
echo $com->AddCompany('breakermind','hello@breakermind.com','pass','Marcin','Marcinkowski','Breakermind.com','0000000000','Złota 4','00300','Warszawa','PL','https://breakermind.com','+48000000000');

// Get companies with text
$s = $com->GetCompany('brea');

// Show companies
$com->Show($s);

// Login return 1 if exist and add info to session
echo $com->Login('breakermind','pass');
print_r($_SESSION);

}catch(Exception $e){
	echo "Syntax Error: ".$e->getMessage();
}

?>
