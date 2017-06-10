  <?php
  // How to prevent Sql Injection
  
  // clear sql injection from post and get requests
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
  
  // secure int numeric
  $id = (int)$_POST['number];
  
	// PDO database connection
	function Conn($user = 'root', $pass = 'toor', $db = 'default', $host = 'localhost'){
		$c = new PDO('mysql:host='.$host.';dbname='.$db.';mysql:charset=utf8', $user, $pass);
		// don't cache query
		$c->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		// show warning text
		$c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		// throw error exception
		$c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// don't colose connecion on script end
		$c->setAttribute(PDO::ATTR_PERSISTENT, false);
		// set utf8 for connecton
		$c->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
		return $c;
	}

	function GroupID($cid, $search){
    //  only int
		$id = (int)$id;		
    // if you dont use Clear function first
    $search = htmlentities($search, ENT_QUOTES, 'UTF-8');
		try{
			$r = $this->db->query("SELECT * FROM sms_gr WHERE id = $id AND status = 1 ORDER BY id DESC LIMIT 1");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			if ($r->rowCount() > 0) {
				return $rows[0]['id'];
			}else{
				return 0;
			}
		}catch(Exception $e){
			return -1;
		}
	}
  ?>
  
  // Mysql database create
	SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
	SET time_zone = "+00:00";
	SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8';
	CREATE DATABASE IF NOT EXISTS `NAMEDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
	USE `NAMEDB`;

	// mysql database
	DROP TABLE IF EXISTS `event`;
	CREATE TABLE IF NOT EXISTS `event` (
	  `id` bigint(11) NOT NULL AUTO_INCREMENT,
	  `userid` bigint(11) NOT NULL,
	  `type` int(11) NOT NULL DEFAULT '1',	  
	  `time` int(11) NOT NULL DEFAULT '0',	  
	  `ukey` varchar(250) DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `uKey` (`userid`,`type`)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
  
