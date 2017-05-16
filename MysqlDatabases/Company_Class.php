<?php
/**
* Company_Class.php
*/
class Company
{
	public $db;
	
	function __construct()
	{
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

	function AddCompany($login,$email,$pass,$firstname,$lastname,$name,$nip,$address,$zip,$city,$country,$www,$mobile){		
		$code = md5(time());
		$time = time();									
		$this->db->query("INSERT INTO company(`login`,`email`,`pass`,`firstname`,`lastname`,`name`,`nip`,`address`,`zip`,`city`,`country`,`www`,`mobile`,`code`,`active`,`time`) VALUES('$login','$email', '$pass','$firstname','$lastname','$name','$nip','$address','$zip','$city','$country','$www','$mobile','$code',1, $time);");
		return $this->db->lastInsertId();
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
}

$pass = md5("pass");

try{
// Create object
$com = new Company();

// Add company fi not exist
$com->AddCompany('breakermind1','hello1@breakermind.com',$pass,'Marcin','Łukaszewski','Breakermind.com','000000000','Dębowa 4','06300','Warszawa','PL','https://breakermind.com','+48732977888');

// Get companies with text
$s = $com->GetCompany('brea');

// Show companies
$com->Show($s);

}catch(Exception $e){
	echo "Syntax Error: ".$e->getMessage();
}

?>
