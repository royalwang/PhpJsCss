<?php
namespace Xlib\Pdo;

use \PDO;
use Xlib\Pdo\Credentials;

/**
* Pdo
*/
class MysqlPdo extends Credentials
{	

	public $db;

	function __construct()
	{	
        $this->db = $this->Conn();
	}

	// get mysql pdo connection don't allow override function
	final function Conn(){
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
			return $conn;			
		}catch(Exception $e){
			echo "ERROR_MYSQLPDO";
			return null;
		}
		// $rows = $res->fetchAll(PDO::FETCH_ASSOC);
		// $cnt = $res->rowCount();
		// $id = $this->db->lastInsertId();
		// buffered query
		// $stmt = $db->prepare('select * from foo', array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true)
	}

	// Clear POST/GET data
	final function clearSqlInjection(){
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
}

?>