# Mysql polish characters in php

```php
// Add to mysql config file my.ini or my.cnf :	 
// C:/xampp/mysql/bin/my.ini 
// /etc/mysql/my.cnf

	[client]
	default-character-set = utf8mb4

	[mysql]
	default-character-set = utf8mb4

	[mysqld]
	character-set-client-handshake = FALSE
	character-set-server = utf8mb4
	collation-server = utf8mb4_unicode_ci

// PHP pdo add
    
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
			// Buffered querry
			// $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true);
			// PDO SSL
			// $conn = new PDO('mysql:host='.$mysqlhost.';port='.$mysqlport.';dbname='.$mysqldb.';charset=utf8', $mysqluser, $mysqlpass,array( PDO::MYSQL_ATTR_SSL_KEY    =>'/path/to/client-key.pem', PDO::MYSQL_ATTR_SSL_CERT=>'/path/to/client-cert.pem', PDO::MYSQL_ATTR_SSL_CA    =>'/path/to/ca-cert.pem'));
			// Or
			// $conn->setAttribute(PDO::MYSQL_ATTR_SSL_KEY =>'/path/to/client-key.pem');
			// $conn->setAttribute(PDO::MYSQL_ATTR_SSL_CERT=>'/path/to/client-cert.pem');
			// $conn->setAttribute(PDO::MYSQL_ATTR_SSL_CA    =>'/path/to/ca-cert.pem');
			return $conn;
		}catch(Exception $e){
			$this->lastError = "Mysql connection error!!!";
			return 0;
		}
		// $rows = $res->fetchAll(PDO::FETCH_ASSOC);
		// $cnt = $res->rowCount();
		// $id = $this->db->lastInsertId();
		// buffered query
		// $stmt = $db->prepare('select * from foo', array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
	}


And in html  header add:

    <meta charset="utf-8">
Or in php:

    header('Content-Type: text/html; charset=utf-8');

And set database and table collation and charset  when creating database:
utf8mb4
utf8mb4_unicode_ci

```
