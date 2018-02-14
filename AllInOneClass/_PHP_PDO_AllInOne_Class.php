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
	public $mysqldb = "moto";

	// Konstruktor
	function __construct() {
		// Get mysql credentials
		$this->mysqlhost = Credentials::$mysqlhost;
		$this->mysqluser = Credentials::$mysqluser;
		$this->mysqlpass = Credentials::$mysqlpass;
		$this->mysqlport = Credentials::$mysqlport;
		$this->mysqldb = Credentials::$mysqldb;

		// Create connection
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

	function getAds($size = 1){		
		try{
			$out = '';
			$size = (int)$size;
			// select
			$r = $this->db->query("SELECT * FROM ads WHERE timeon < NOW() AND timeoff > NOW() AND size = $size AND status = 1 AND active = 1 AND ban = 0 ORDER BY views ASC LIMIT 1");
			// get email,name,id
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);	
			if(!empty($rows)){		
				$out = '<h2> Reklama </h2><a href="'.$rows[0]['link'].'">'.$rows[0]['html'].'</a>';
				// Update wiews
				$aid = (int)$rows[0]['id'];
				$r = $this->db->query("UPDATE ads SET views = views + 1 WHERE id = $aid");				
			}else{
				$out = '<h2> Reklama </h2><a href="/reklama.php"><img src="img/ads.jpg"></a>';
			}	
			return $out;
		}catch(Exception $e){						
			return '';
		}
		return '';
	}

	function getAlias($userid){
		try{			
			$uid = (int)$userid;
			// policz powiadomienia
			$r = $this->db->query("SELECT * FROM users WHERE id = $uid");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			// return $cnt = $r->rowCount();			
			return $rows[0]['username'];
		}catch(Exception $e){						
			return "";
		}
		return "";
	}

	function userExists($username){
		try{			
			$u = htmlentities($username,ENT_QUOTES,'utf-8');			
			$r = $this->db->query("SELECT id FROM users WHERE username = '$u'");
			// $rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			return $cnt = $r->rowCount();			
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function userID($username){
		try{			
			$u = htmlentities($username,ENT_QUOTES,'utf-8');			
			// policz username
			$r = $this->db->query("SELECT id FROM users WHERE username = '$u'");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			return $rows[0]['id'];
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function userProfil($username){
		try{			
			$u = htmlentities($username,ENT_QUOTES,'utf-8');			
			// policz username
			$r = $this->db->query("SELECT id,username,email,sex,points,firstname,lastname,location,www,about,mobile,www,company,c_name,c_address,c_location,c_mobile,c_www,c_about,c_abouthtml FROM users WHERE username = '$u'");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			return $rows[0];
			// return $cnt = $r->rowCount();			
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function getTags($category  = 1, $limit = 50, $rand = 0){
		try{
			$limit = (int)$limit;
			if($rand != 0){
				$r = $this->db->query("SELECT * FROM tags WHERE category = 1 AND active = 1 ORDER BY RAND() LIMIT $limit");
			}else{
				$r = $this->db->query("SELECT * FROM tags WHERE category = 1 AND active = 1 ORDER BY tag LIMIT $limit");
			}
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			// return $cnt = $r->rowCount();			
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function getCategory(){
		try{			
			$r = $this->db->query("SELECT * FROM category WHERE active = 1 ORDER BY id");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			// return $cnt = $r->rowCount();			
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function getCategoryJob(){
		try{
			$r = $this->db->query("SELECT * FROM jobs_cat WHERE active = 1 ORDER BY cid");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			// return $cnt = $r->rowCount();			
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function updateJobViews($jid){
		try{
			$jid = (int)$jid;
			$r = $this->db->query("UPDATE jobs SET views = views + 1 WHERE id = $jid");
			// $rows = $r->fetchAll(PDO::FETCH_ASSOC);
			return $cnt = $r->rowCount();			
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function addJob($title, $html, $email, $mobile, $city, $woj, $umowa = 0, $cat = 1, $type = 0, $paymin = 1, $paymax = 100, $link = '', $days = 7, $firma){
		try{
			$uid = (int)$_SESSION['userid'];
			if($uid > 0){
				$cat = (int)$cat;
				$type = (int)$type;
				$umowa = (int)$umowa;
				$paymin = (int)$paymin;
				$paymax = (int)$paymax;
				$days = (int)$days;
				$title = htmlentities($title,ENT_QUOTES,'utf-8');				
				$html = substr(htmlentities($html,ENT_QUOTES,'utf-8'),0,10000);
				$email = htmlentities($email,ENT_QUOTES,'utf-8');				
				$mobile = htmlentities($mobile,ENT_QUOTES,'utf-8');
				$city = htmlentities($city,ENT_QUOTES,'utf-8');				
				$link = htmlentities($link,ENT_QUOTES,'utf-8');
				$firma = htmlentities($firma,ENT_QUOTES,'utf-8');
				$ip = $this->IP();
				$wojall = '';
				foreach ($woj as $v) {
					$wojall .= '-'.$v.'-'; 
				}
				if($uid > 0){
					$r = $this->db->query("INSERT INTO jobs(uid,cat,type,umowa,firma,title,html,city,woj,paymin,paymax,email,mobile,externallink,ip,days) 
						VALUES ($uid,$cat,$type,$umowa,'$firma','$title','$html','$city','$wojall',$paymin,$paymax,'$email','$mobile','$link','$ip',$days)");
					return $this->db->lastInsertId();
				}
			}
		}catch(Exception $e){
			if ($e->getCode() == '23000'){
				return -1;
			}	
			return 0;
		}
		return 0;
	}

	function updateJob($jid = 0, $title, $html, $email, $mobile, $city, $woj, $umowa = 0, $cat = 1, $type = 0, $paymin = 1, $paymax = 100, $link = '', $days = 7, $firma){
		try{
			$uid = (int)$_SESSION['userid'];
			if($uid > 0){
				$jid = (int)$jid;
				$cat = (int)$cat;
				$type = (int)$type;
				$umowa = (int)$umowa;
				$paymin = (int)$paymin;
				$paymax = (int)$paymax;
				$days = (int)$days;
				$title = htmlentities($title,ENT_QUOTES,'utf-8');				
				$html = substr(htmlentities($html,ENT_QUOTES,'utf-8'),0,10000);
				$email = htmlentities($email,ENT_QUOTES,'utf-8');				
				$mobile = htmlentities($mobile,ENT_QUOTES,'utf-8');
				$city = htmlentities($city,ENT_QUOTES,'utf-8');				
				$link = htmlentities($link,ENT_QUOTES,'utf-8');
				$firma = htmlentities($firma,ENT_QUOTES,'utf-8');
				$ip = $this->IP();
				
				$wojall = '';				
				foreach ($woj as $v) {
					$wojall .= '-'.$v.'-'; 
				}

				$r = $this->db->query("UPDATE jobs SET cat = $cat,type = $type,umowa = $umowa,firma = '$firma',title = '$title',html = '$html',city = '$city',woj = '$woj',paymin = $paymin,paymax = $paymax,email = '$email',mobile = '$mobile' ,externallink = '$link',ip = '$ip',days = $days WHERE id = $jid AND uid = $uid");
				return $r->rowCount();
			}
		}catch(Exception $e){
			if ($e->getCode() == '23000'){
				return -1;
			}	
			return 0;
		}
		return 0;
	}

	// freelancer answer
	function addJobAnswer($jid, $html, $price, $email, $mobile){
		try{
			$jid = (int)$jid;
			$uid = (int)$_SESSION['userid'];
			$price = (float)$price;
			$title = htmlentities($title,ENT_QUOTES,'utf-8');
			$html = htmlentities($html,ENT_QUOTES,'utf-8');
			$email = htmlentities($email,ENT_QUOTES,'utf-8');
			$mobile = htmlentities($mobile,ENT_QUOTES,'utf-8');
			$ip = $this->IP();
			if($uid > 0 && $jid > 0 && $price > 0){
				$r = $this->db->query("INSERT INTO jobs_answers(uid,jid,html,email,mobile,price,ip) VALUES ($uid,$jid,'$html','$email','$mobile',$price,'$ip')");
				return $this->db->lastInsertId();
			}			
		}catch(Exception $e){	
			if ($e->getCode() == '23000'){
				return -1;
			}		
			return 0;
		}
		return 0;
	}
	// Select jobs answers
	function getJobAnswers($jid = 0){
		try{
			$jid = (int)$jid;
			$r = $this->db->query("SELECT * FROM jobs_answers WHERE jid = $jid AND active = 1 AND ban = 0 ORDER BY time");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function getJobUser($jid = 0){
		try{
			$jid = (int)$jid;
			$r = $this->db->query("SELECT uid FROM jobs WHERE id = $jid");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			return $rows[0]['uid'];
		}catch(Exception $e){				
			return 0;
		}
		return 0;
	}

	function getCategoryShopAll(){
		try{
			$subcat = (int)$subcat;
			$r = $this->db->query("SELECT * FROM shop_category WHERE active = 1 ORDER BY subcat ASC, title ASC");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function getCategoryShopMain($subcat = 0){
		try{
			$subcat = (int)$subcat;
			$r = $this->db->query("SELECT * FROM shop_category WHERE subcat = $subcat AND active = 1 ORDER BY title");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function getCategoryShop($subcat = 1){
		try{
			$subcat = (int)$subcat;
			$r = $this->db->query("SELECT * FROM shop_category WHERE subcat = $subcat AND active = 1 ORDER BY title");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function addShopProduct($cat = 0, $subcat = 0, $title = 'ErrorTitle', $price = 0, $pricesale = 0, $about = '', $abouthtml = '', $link = ''){
		try{
			$uid = (int)$_SESSION['userid'];
			if($uid > 0){
				$cat = (int)$cat;
				$subcat = (int)$subcat;
				$price = (float)$price;
				$pricesale = (float)$pricesale;
				$title = htmlentities($title,ENT_QUOTES,'utf-8');
				$about = htmlentities($about,ENT_QUOTES,'utf-8');
				$link = htmlentities($link,ENT_QUOTES,'utf-8');
				$abouthtml = substr(htmlentities($abouthtml,ENT_QUOTES,'utf-8'),0,5000);
				$ip = $this->IP();
				if($uid > 0){
					$r = $this->db->query("INSERT INTO shop_product(uid,cat,subcat,title,about,abouthtml,price,pricesale,ip,externallink) VALUES ($uid,$cat,$subcat,'$title','$about','$abouthtml',$price,$pricesale,'$ip','$link')");
					return $this->db->lastInsertId();
				}
			}
		}catch(Exception $e){
			if ($e->getCode() == '23000'){
				return -1;
			}	
			return 0;
		}
		return 0;
	}

	// update product id content
	function updateShopProduct($pid = 0, $cat = 0, $subcat = 0, $title = 'ErrorTitle', $price = 0, $pricesale = 0, $about = '', $abouthtml = '', $link = ''){
		try{
			$uid = (int)$_SESSION['userid'];
			if($uid > 0){
				$pid = (int)$pid;
				$cat = (int)$cat;
				$subcat = (int)$subcat;
				$price = (float)$price;
				$pricesale = (float)$pricesale;
				$title = htmlentities($title,ENT_QUOTES,'utf-8');
				$about = htmlentities($about,ENT_QUOTES,'utf-8');
				$link = htmlentities($link,ENT_QUOTES,'utf-8');
				$abouthtml = substr(htmlentities($abouthtml,ENT_QUOTES,'utf-8'),0,5000);
				$ip = $this->IP();

				$r = $this->db->query("UPDATE shop_product SET cat = $cat, subcat = $subcat, title = '$title', about = '$about', abouthtml = '$abouthtml', price = $price, pricesale = $pricesale, ip = '$ip', externallink = '$link' WHERE uid = $uid AND id = $pid");
				if($r->rowCount() > 0){
					return $pid;
				}
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	function sendMessage($fid, $tid, $msg){
		try{
			$fid = (int)$fid;
			if($fid > 0){
				$tid = (int)$tid;
				$msg = htmlentities($msg,ENT_QUOTES,'utf-8');				
				$ip = $this->IP();	
				// jeżeli wiadomość istnieje w ostatnich 5 minutach nie wysyłaj
				if($this->isMessageExist($fid, $tid, $msg, 5) > 0){ return -1; }
				$this->addMessageUsers($fid, $tid);
				$r = $this->db->query("INSERT INTO messages(fid,tid,msg,ip) VALUES ($fid,$tid,'$msg','$ip')");
				return $this->db->lastInsertId();
			}			
		}catch(Exception $e){
			if ($e->getCode() == '23000'){
				return -1;
			}	
			return 0;
		}
		return 0;
	}

	// dodaj do listy userów wysyłających wiadomośći
	function addMessageUsers($fid, $tid){
		try{
			$fid = (int)$fid;
			$tid = (int)$tid;
			if($fid > 0 && $tid > 0){
				// dodaj usera do listy				
				$r = $this->db->query("INSERT INTO messages_users(fid,tid) VALUES ($fid,$tid)");
				return $this->db->lastInsertId();
			}			
		}catch(Exception $e){
			if ($e->getCode() == '23000'){
				return -1;
			}	
			return 0;
		}
		return 0;
	}

	// Usuń kontakt
	function delMessageUsers($fid, $tid){
		try{
			$fid = (int)$fid;
			$tid = (int)$tid;
			if($fid > 0 && $tid > 0){
				// dodaj usera do listy				
				$r = $this->db->query("DELETE FROM messages_users WHERE fid = $fid AND tid = $tid");
				return 1;
			}			
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	function searchUsers($user){
		$user = htmlentities($user, ENT_QUOTES, 'utf-8');
		$username = htmlentities($_SESSION['username'], ENT_QUOTES, 'utf-8');
		try{			
			if(!empty($user)){
				$r = $this->db->query("SELECT id,username,firstname,lastname FROM users WHERE (username LIKE '$user%' AND username != '$username') OR (firstname LIKE '$user%' AND username != '$username') OR (lastname LIKE '$user%' AND username != '$username') LIMIT 7");
				$rows = $r->fetchAll(PDO::FETCH_ASSOC);
				$o = '';
				foreach ($rows as $v) {
					$o .= '<a class="addcontact" data-uid="'.$v['id'].'"><img src="media/avatar/'.$v['id'].'.jpg"> <span>@'.$v['username'].' '.$v['firstname'].' '.$v['lastname'].' </span> </a>'; 
				}
				return $o;
			}
		}catch(Exception $e){			
			return "";
		}
		return "";
	}

	function searchUsersProfil($user){
		$user = htmlentities($user, ENT_QUOTES, 'utf-8');
		$username = htmlentities($_SESSION['username'], ENT_QUOTES, 'utf-8');
		try{			
			if(!empty($user)){
				$r = $this->db->query("SELECT id,username,firstname,lastname FROM users WHERE CONCAT_WS(' ',username,firstname,lastname) LIKE '%$user%' LIMIT 7");
				$rows = $r->fetchAll(PDO::FETCH_ASSOC);
				$o = '';
				foreach ($rows as $v) {
					$o .= '<a class="addcontact" href="/user/'.$v['username'].'" target="_balnk"><img src="media/avatar/'.$v['id'].'.jpg"> <span>@'.$v['username'].' '.$v['firstname'].' '.$v['lastname'].' </span> </a>'; 
				}
				return $o;
			}
		}catch(Exception $e){			
			return "";
		}
		return "";
	}

	function isMessageExist($fid, $tid, $msg, $minutes = 5){
		try{
			$fid = (int)$fid;
			if($fid > 0){
				$tid = (int)$tid;
				$minutes = (int)$minutes;
				$msg = htmlentities($msg,ENT_QUOTES,'utf-8');
				$r = $this->db->query("SELECT id FROM messages WHERE fid = $fid AND tid = $tid AND msg = '$msg' AND time > NOW() - INTERVAL $minutes MINUTE");
				return $r->rowCount();
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	function delMessages($mid = 0){
		try{
			$mid = (int)$mid;
			if($mid > 0){
				$uid = (int)$_SESSION['userid'];				
				$r = $this->db->query("UPDATE messages SET factive = 0 WHERE id = $mid AND fid = $uid");
				$r = $this->db->query("UPDATE messages SET tactive = 0 WHERE id = $mid AND tid = $uid");
				return 1;
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	// ustaw wiadomości jako przeczytane dla danego usera
	function seenMessages($fid = 0){
		try{
			$fid = (int)$fid;
			if($fid > 0){
				$uid = (int)$_SESSION['userid'];				
				$r = $this->db->query("UPDATE messages SET seen = 0 WHERE tid = $uid AND fid = $fid");				
				return 1;
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	function cntUnreadMessages(){
		try{
			$uid = (int)$_SESSION['userid'];				
			$r = $this->db->query("SELECT COUNT(*) as cnt FROM messages WHERE seen = 1 AND fid != $uid AND tid = $uid AND tactive = 1");	
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			return $rows[0]['cnt'];
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	function getMessages($fid){
		try{			
			$fid = (int)$fid;
			$tid = (int)$_SESSION['userid'];
			// get question answers			
			$r = $this->db->query("SELECT messages.id,messages.fid,messages.tid,messages.msg,messages.factive,messages.tactive,messages.time,users.username,users.firstname,users.lastname from messages LEFT JOIN users ON messages.fid=users.id WHERE (messages.tid = $tid AND messages.fid = $fid AND tactive = 1) OR (messages.tid = $fid AND messages.fid = $tid AND factive = 1) ORDER By time DESC LIMIT 10");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			$o = '';
			foreach ($rows as $v) {
				if($v['tid'] == $_SESSION['userid'] && $v['tactive'] == 1){
					$o .= '
					<div class="fid">
						<div class="fuser">
							<div class="fuser-small">
								<img src="media/avatar/'.$v['fid'].'.jpg"> <span>'.$v['username'].'</span>
							</div>
						</div>
						<div class="fmsg">
						'.$this->linkify(1,nl2br($v['msg'])).'
						</div>
						<div class="ftime"> <a class="deletemsg" data-delid="'.$v['id'].'"><i class="fa fa-trash" title="Usuń wiadomość"></i></a> '.$v['time'].' </div>
					</div>';
				}

				if($v['fid'] == $_SESSION['userid'] && $v['factive'] == 1){
					$o .= '
					<div class="tid">
						<div class="tuser">
							<div class="tuser-small">
								<img src="media/avatar/'.$v['fid'].'.jpg"> <span>'.$v['username'].' </span>
							</div>
						</div>
						<div class="tmsg">
						'.$this->linkify(1,nl2br($v['msg'])).'
						</div>
						<div class="ttime"> <a class="deletemsg" data-delid="'.$v['id'].'"><i class="fa fa-trash" title="Usuń wiadomość"></i></a> '.$v['time'].' </div>
					</div>';
				}
			}
			return $o;
		}catch(Exception $e){
			return $rows;
		}
	}

	function getMessagesAll($fid){
		try{			
			$fid = (int)$fid;
			$tid = (int)$_SESSION['userid'];
			// get question answers			
			$r = $this->db->query("SELECT messages.id,messages.fid,messages.tid,messages.msg,messages.factive,messages.tactive,messages.time,users.username,users.firstname,users.lastname from messages LEFT JOIN users ON messages.fid=users.id WHERE (messages.tid = $tid AND messages.fid = $fid AND tactive = 1) OR (messages.tid = $fid AND messages.fid = $tid AND factive = 1) ORDER By time DESC");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			$o = '';
			foreach ($rows as $v) {
				if($v['tid'] == $_SESSION['userid'] && $v['tactive'] == 1){
					$o .= '
					<div class="fid">
						<div class="fuser">
							<div class="fuser-small">
								<img src="media/avatar/'.$v['fid'].'.jpg"> <span>'.$v['username'].'</span>
							</div>
						</div>
						<div class="fmsg">
						'.$this->linkify(1,nl2br($v['msg'])).'
						</div>
						<div class="ftime"> <a class="deletemsg" data-delid="'.$v['id'].'"><i class="fa fa-trash" title="Usuń wiadomość"></i></a> '.$v['time'].' </div>
					</div>';
				}

				if($v['fid'] == $_SESSION['userid'] && $v['factive'] == 1){
					$o .= '
					<div class="tid">
						<div class="tuser">
							<div class="tuser-small">
								<img src="media/avatar/'.$v['fid'].'.jpg"> <span>'.$v['username'].' </span>
							</div>
						</div>
						<div class="tmsg">
						'.$this->linkify(1,nl2br($v['msg'])).'
						</div>
						<div class="ttime"> <a class="deletemsg" data-delid="'.$v['id'].'"><i class="fa fa-trash" title="Usuń wiadomość"></i></a> '.$v['time'].' </div>
					</div>';
				}
			}
			return $o;
		}catch(Exception $e){
			return $rows;
		}
	}

	function getMessagesUsers(){
		try{			
			$tid = (int)$_SESSION['userid'];
			// get question answers
			// ,(SELECT COUNT(*) FROM messages WHERE tid = $tid AND fid = $fid AND factive = 1) as notify
			$r = $this->db->query("SELECT messages_users.fid,messages_users.tid,users.username,users.firstname,users.lastname,(SELECT COUNT(*) FROM messages WHERE tid = messages_users.tid AND fid = messages_users.fid AND seen = 1) as notify from messages_users LEFT JOIN users ON messages_users.fid=users.id WHERE messages_users.tid = $tid");
			return $rows = $r->fetchAll(PDO::FETCH_ASSOC);			
		}catch(Exception $e){
			return $rows;
		}
	}

	// get question answers
	function getProductComments($pid){
		try{			
			$pid = (int)$pid;
			// get question answers			
			$r = $this->db->query("SELECT shop_comments.id,shop_comments.uid,shop_comments.pid,shop_comments.txt,users.username from shop_comments LEFT JOIN users ON shop_comments.uid=users.id WHERE shop_comments.pid = $pid AND shop_comments.active = 1 AND shop_comments.ban = 0");
			return $rows = $r->fetchAll(PDO::FETCH_ASSOC);			
		}catch(Exception $e){						
			return $rows;
		}		
	}

	function addProductComment($uid, $pid, $txt){
		try{
			$uid = (int)$uid;
			$pid = (int)$pid;
			$txt = htmlentities($txt,ENT_QUOTES,'utf-8');			
			$ip = $this->IP();
			if($uid > 0){
			$r = $this->db->query("INSERT INTO shop_comments(uid,pid,txt,ip) VALUES ($uid,$pid,'$txt','$ip')");				
				return $this->db->lastInsertId();
			}
		}catch(Exception $e){
			if ($e->getCode() == '23000'){
				return -1;
			}	
			return 0;
		}
		return 0;
	}
	
	function delProductComment($uid, $pid){
		try{
			$uid = (int)$uid;
			$pid = (int)$pid;
			// iff logged userid > 0
			if($uid > 0){
				$r = $this->db->query("DELETE FROM shop_comments WHERE uid = $uid AND id = $pid");
				return $cnt = $r->rowCount();
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	// Check is user can delete comments for product
	function getProductUserId($pid){
		try{
			$pid = (int)$pid;			
			if($pid > 0){
				$r = $this->db->query("SELECT uid FROM shop_product WHERE id = $pid");
				$rows = $r->fetchAll(PDO::FETCH_ASSOC);
				return $rows[0]['uid'];
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	// comment ban (hide users comments)
	function addProductCommentFlag($cid, $pid){
		try{			
			$cid = (int)$cid;
			$pid = (int)$pid;
			if($cid > 0){
				// sprawdzić czy komentarz pid -> owner user == current user
				echo $puserid = $this->getProductUserId($pid);
				if($puserid == $_SESSION['userid']){
					$r = $this->db->query("UPDATE shop_comments SET ban = 1 WHERE id = $cid");
					return $r->rowCount();
				}
			}
		}catch(Exception $e){
			return 0;
		}
		return 0;
	}

	function delShopProduct($pid){
		try{
			$pid = (int)$pid;			
			if($pid > 0){
				$r = $this->db->query("UPDATE shop_product SET active = -1 WHERE id = $pid");
				return $r->rowCount();			
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	function updateShopProductViews($pid){
		try{
			$pid = (int)$pid;			
			if($pid > 0){
				$r = $this->db->query("UPDATE shop_product SET views = views + 1 WHERE id = $pid");
				return $r->rowCount();			
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	// Śledzenie ogladnieć strony produktów
	function addShopActivity($uid = 0, $pid = 0, $type = 0){
		try{
			$uid = (int)$uid;
			$pid = (int)$pid;
			$type = (int)$type;
			$ip = $this->IP();
			if($pid > 0){
				$r = $this->db->query("INSERT INTO shop_activity(uid,pid,type,ip) VALUES($uid,$pid,$type,'$ip')");
				return $this->db->lastInsertId();
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	function getShopProduct($pid){
		try{
			$pid = (int)$pid;			
			if($pid > 0){
				$r = $this->db->query("SELECT shop_product.id,shop_product.uid,shop_product.cat,shop_product.subcat,shop_product.title,shop_product.about,shop_product.abouthtml,shop_product.price,shop_product.pricesale,shop_product.currency,shop_product.votes,shop_product.views,shop_product.externallink,users.username FROM shop_product LEFT JOIN users ON shop_product.uid=users.id WHERE shop_product.id = $pid AND shop_product.active = 1 AND shop_product.ban = 0");
				return $rows = $r->fetchAll(PDO::FETCH_ASSOC);			}
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function getShopProductsRand(){
		try{
			$r = $this->db->query("SELECT shop_product.id,shop_product.uid,shop_product.cat,shop_product.subcat,shop_product.title,shop_product.about,shop_product.abouthtml,shop_product.price,shop_product.pricesale,shop_product.currency,shop_product.votes,shop_product.views,shop_product.externallink,users.username FROM shop_product LEFT JOIN users ON shop_product.uid=users.id WHERE shop_product.id > 0 AND shop_product.active = 1 AND shop_product.ban = 0 ORDER BY RAND() LIMIT 10");
			return $rows = $r->fetchAll(PDO::FETCH_ASSOC);			
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function getShopProducts($cat = 0, $subcat = 0, $uid = 0, $search, $items_per_page = 25, $page = 1){
		try{
			$uid = (int)$uid;
			$cat = (int)$cat;
			$subcat = (int)$subcat;
			$search = htmlentities($search,ENT_QUOTES,'utf-8');

			// count page
			if(!empty($_GET['page'])) {
			    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
			    if(false === $page) {
			        $page = 1;
			    }
			    if($page <= 0){
			    	$page = 1;
			    }
			}
			// build query
			$offset = ($page - 1) * $items_per_page;

			if($uid >= 0){
				$cat1 = 'shop_product.cat != 0 AND';
				if($cat > 0 && $subcat > 0){
					// $cat = 'shop_product.cat = '.$cat.' AND shop_product.cat = '.$subcat.' AND';
					$cat1 = 'shop_product.cat = '.$cat.' AND shop_product.subcat = '.$subcat.' AND';
				}
				if($cat > 0 && $subcat == 0){					
					$cat1 = 'shop_product.cat = '.$cat.' AND';
				}
				if($uid > 0){
					$user = 'shop_product.uid = '.$uid.' AND';
				}
				// $r = $this->db->query("SELECT * FROM questions WHERE tags LIKE '$tag' OR title LIKE '$search' ORDER BY id DESC LIMIT 25");
				if(empty($search)){					
					$r = $this->db->query("SELECT uid FROM shop_product WHERE $cat1 $user active = 1 AND ban = 0");
					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page);
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

					$r = $this->db->query("SELECT shop_product.id,shop_product.uid,shop_product.cat,shop_product.subcat,shop_product.title,shop_product.about,shop_product.abouthtml,shop_product.price,shop_product.pricesale,shop_product.currency,shop_product.votes,shop_product.views,users.username FROM shop_product LEFT JOIN users ON shop_product.uid=users.id WHERE $cat1 $user shop_product.active = 1 AND shop_product.ban = 0  ORDER BY shop_product.ontop DESC,shop_product.ontopid DESC,shop_product.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);					
				}
				if(!empty($search)){					
					$r = $this->db->query("SELECT uid FROM shop_product WHERE $cat1 $user active = 1 AND ban = 0");
					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page);
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}
					// REGEXP '1740|1938|1940'
					$parts = explode(',', $search);
					$search = '';
					foreach ($parts as $o) {
						$search .= $o.'|'; 						
					}
					$search = rtrim($search,"|");
					// $r = $this->db->query("SELECT shop_product.id,shop_product.uid,shop_product.cat,shop_product.subcat,shop_product.title,shop_product.about,shop_product.abouthtml,shop_product.price,shop_product.pricesale,shop_product.currency,shop_product.votes,users.username FROM shop_product LEFT JOIN users ON shop_product.uid=users.id WHERE $cat1 shop_product.active = 1 AND shop_product.ban = 0 AND title LIKE '%$search%' ORDER BY shop_product.ontop DESC,shop_product.ontopid DESC,shop_product.id DESC LIMIT " . $offset . "," . $items_per_page);
					$r = $this->db->query("SELECT shop_product.id,shop_product.uid,shop_product.cat,shop_product.subcat,shop_product.title,shop_product.about,shop_product.abouthtml,shop_product.price,shop_product.pricesale,shop_product.currency,shop_product.votes,users.username FROM shop_product LEFT JOIN users ON shop_product.uid=users.id WHERE $cat1 $user shop_product.active = 1 AND shop_product.ban = 0 AND CONCAT_WS(' ',shop_product.title,shop_product.about) REGEXP '".$search."' ORDER BY shop_product.ontop DESC,shop_product.ontopid DESC,shop_product.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				}				
			}
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	// Delete freelancer job answer
	function delJobAnswer($aid, $uid){
		try{
			$aid = (int)$aid;
			$uid = (int)$uid;
			$r = $this->db->query("DELETE FROM jobs_answers WHERE id = $aid AND uid = $uid");
			return $r->rowCount();
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	function activJob($jid){
		try{			
			$jid = (int)$jid;
			$uid = (int)$_SESSION['userid'];
			if($uid > 0){
				$r = $this->db->query("UPDATE jobs SET active = IF(active>0,0,1) WHERE id = $jid AND uid = $uid");			
				return $r->rowCount();
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	// Zatwierdz odpowiedź na zlecenie freelance
	function okJobAnswer($aid, $jid){
		try{
			$aid = (int)$aid;
			$jid = (int)$jid;
			$uid = (int)$uid;			
			if($_SESSION['userid'] > 0 && $this->getJobUser($jid) == $_SESSION['userid']){	
				$r = $this->db->query("UPDATE jobs_answers SET pay = 0 WHERE jid = $jid");
				$r = $this->db->query("UPDATE jobs_answers SET pay = 1 WHERE id = $aid AND jid = $jid");			
				return $r->rowCount();
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	function getJob($id = 0){
		try{
			$id = (int)$id;
			$r = $this->db->query("SELECT jobs.id,jobs.uid,jobs.cat,jobs.type,jobs.umowa,jobs.firma,jobs.title,jobs.html,jobs.city,jobs.woj,jobs.paymin,jobs.paymax,jobs.email,jobs.mobile,jobs.externallink,jobs.activationtime,jobs.days,jobs.active,jobs.ban,jobs.ontop,jobs.ontopid,jobs.highlight,jobs.views,users.username,(jobs.activationtime + INTERVAL jobs.days DAY) as endtime FROM jobs LEFT JOIN users ON jobs.uid=users.id WHERE jobs.id = $id AND jobs.active = 1 AND jobs.ban = 0 AND (activationtime + INTERVAL jobs.days DAY) > NOW()");
			return $rows = $r->fetchAll(PDO::FETCH_ASSOC);			
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function getJobInactive($id = 0){
		try{
			$id = (int)$id;
			$r = $this->db->query("SELECT jobs.id,jobs.uid,jobs.cat,jobs.type,jobs.umowa,jobs.firma,jobs.title,jobs.html,jobs.city,jobs.woj,jobs.paymin,jobs.paymax,jobs.email,jobs.mobile,jobs.externallink,jobs.activationtime,jobs.days,jobs.active,jobs.ban,jobs.ontop,jobs.ontopid,jobs.highlight,jobs.views,users.username,(jobs.activationtime + INTERVAL jobs.days DAY) as endtime FROM jobs LEFT JOIN users ON jobs.uid=users.id WHERE jobs.id = $id AND jobs.ban = 0 AND (activationtime + INTERVAL jobs.days DAY) > NOW()");
			return $rows = $r->fetchAll(PDO::FETCH_ASSOC);			
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function getJobRand(){
		try{
			$id = (int)$id;
			$r = $this->db->query("SELECT jobs.id,jobs.uid,jobs.cat,jobs.type,jobs.umowa,jobs.firma,jobs.title,jobs.city,jobs.woj,jobs.paymin,jobs.paymax,jobs.email,jobs.mobile,jobs.externallink,jobs.activationtime,jobs.days,jobs.active,jobs.ban,jobs.ontop,jobs.ontopid,jobs.highlight,users.username,(jobs.activationtime + INTERVAL jobs.days DAY) as endtime FROM jobs LEFT JOIN users ON jobs.uid=users.id WHERE jobs.id > 0 AND jobs.active = 1 AND jobs.ban = 0 AND (activationtime + INTERVAL jobs.days DAY) > NOW() ORDER BY RAND() LIMIT 15");
			return $rows = $r->fetchAll(PDO::FETCH_ASSOC);			
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function getJobs($search = '', $category = 0, $type = 0, $umowa = 0, $city = '', $woj = 0, $paymin = 0, $paymax = 0, $items_per_page = 25, $page = 1){
		try{
			//$uid = (int)$uid;
			$category = (int)$category;
			$type = (int)$type;
			$umowa = (int)$umowa;
			$woj = (int)$woj;
			$paymin = (int)$paymin;
			$paymax = (int)$paymax;
			$city = htmlentities($city,ENT_QUOTES,'utf-8');			
			$search = htmlentities($search,ENT_QUOTES,'utf-8');
			$ip = $this->IP();
			// questions(uid,title,html,tags,type,ip)
			
			// count page
			if(!empty($_GET['page'])) {
			    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
			    if(false === $page) {
			        $page = 1;
			    }
			    if($page <= 0){
			    	$page = 1;
			    }
			}
			// build query
			$offset = ($page - 1) * $items_per_page;

			if($uid == 0){
				if($category > 0){
					$cat = 'jobs.cat = '.$category.' AND';
				}
				$t = '';				
				if($type > 0){					
					$t = 'jobs.type = '.$type.' AND';
				}
				$tu = '';
				if($umowa > 0){					
					$tu = 'jobs.umowa = '.$umowa.' AND';
				}
				$tp = '';
				if($paymin > 0){					
					$tp = 'jobs.paymin >= '.$paymin.' AND';
				}
				$tpx = '';
				if($paymax > 0){					
					$tpx = 'jobs.paymax <= '.$paymax.' AND';
				}
				$w = '';				
				if($woj > 0){
					$woj = '%-'.$woj.'-%';			
					$w = "jobs.woj LIKE '$woj' AND";
				}				
				if(empty($search)){
					// AND (activationtime + INTERVAL jobs.days DAY) > NOW()
					$r = $this->db->query("SELECT jobs.id,jobs.uid,jobs.cat,jobs.type,jobs.umowa,jobs.firma,jobs.title,jobs.city,jobs.woj,jobs.paymin,jobs.paymax,jobs.email,jobs.mobile,jobs.externallink,jobs.activationtime,jobs.days,jobs.active,jobs.ban,jobs.ontop,jobs.ontopid,jobs.highlight,users.username FROM jobs LEFT JOIN users ON jobs.uid=users.id WHERE $cat $t $tu $tp $tpx $w jobs.active = 1 AND jobs.ban = 0 AND (activationtime + INTERVAL jobs.days DAY) > NOW() ORDER BY jobs.id DESC");
					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page);
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

					$r = $this->db->query("SELECT jobs.id,jobs.uid,jobs.cat,jobs.type,jobs.umowa,jobs.firma,jobs.title,jobs.city,jobs.woj,jobs.paymin,jobs.paymax,jobs.email,jobs.mobile,jobs.externallink,jobs.activationtime,jobs.days,jobs.active,jobs.ban,jobs.ontop,jobs.ontopid,jobs.highlight,users.username,(jobs.activationtime + INTERVAL jobs.days DAY) as endtime FROM jobs LEFT JOIN users ON jobs.uid=users.id WHERE $cat $t $tu $tp $tpx $w jobs.active = 1 AND jobs.ban = 0 AND (activationtime + INTERVAL jobs.days DAY) > NOW() ORDER BY jobs.ontop DESC,jobs.ontopid DESC,jobs.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				}		
				if(!empty($search)){
					$r = $this->db->query("SELECT jobs.id,jobs.uid,jobs.cat,jobs.type,jobs.umowa,jobs.firma,jobs.title,jobs.city,jobs.woj,jobs.paymin,jobs.paymax,jobs.email,jobs.mobile,jobs.externallink,jobs.activationtime,jobs.days,jobs.active,jobs.ban,jobs.ontop,jobs.ontopid,jobs.highlight,users.username FROM jobs LEFT JOIN users ON jobs.uid=users.id WHERE $cat $t $tu $tp $tpx $w CONCAT_WS(' ',jobs.title,jobs.city,jobs.firma) LIKE '%$search%' AND jobs.active = 1 AND jobs.ban = 0 AND (activationtime + INTERVAL jobs.days DAY) > NOW() ORDER BY jobs.id DESC");

					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page)+1;
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

					$r = $this->db->query("SELECT jobs.id,jobs.uid,jobs.cat,jobs.type,jobs.umowa,jobs.firma,jobs.title,jobs.city,jobs.woj,jobs.paymin,jobs.paymax,jobs.email,jobs.mobile,jobs.externallink,jobs.activationtime,jobs.days,jobs.active,jobs.ban,jobs.ontop,jobs.ontopid,jobs.highlight,users.username,(jobs.activationtime + INTERVAL jobs.days DAY) as endtime FROM jobs LEFT JOIN users ON jobs.uid=users.id WHERE $cat $t $tu $tp $tpx $w CONCAT_WS(' ',jobs.title,jobs.city,jobs.firma) LIKE '%$search%' AND jobs.active = 1 AND jobs.ban = 0 AND (activationtime + INTERVAL jobs.days DAY) > NOW() ORDER BY jobs.ontop DESC,jobs.ontopid DESC,jobs.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				}
			}
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function getJobsUser($uid = 0, $items_per_page = 25, $page = 1){
		try{
			$uid = (int)$uid;
			// count page
			if(!empty($_GET['page'])) {
			    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
			    if(false === $page) {
			        $page = 1;
			    }
			    if($page <= 0){
			    	$page = 1;
			    }
			}
			// build query
			$offset = ($page - 1) * $items_per_page;

			if($uid > 0){				
				// AND (activationtime + INTERVAL jobs.days DAY) > NOW()
				$r = $this->db->query("SELECT jobs.id,jobs.uid,jobs.cat,jobs.type,jobs.umowa,jobs.firma,jobs.title,jobs.city,jobs.woj,jobs.paymin,jobs.paymax,jobs.email,jobs.mobile,jobs.externallink,jobs.activationtime,jobs.days,jobs.active,jobs.ban,jobs.ontop,jobs.ontopid,jobs.highlight,users.username FROM jobs LEFT JOIN users ON jobs.uid=users.id WHERE jobs.uid = $uid AND (activationtime + INTERVAL jobs.days DAY) > NOW() ORDER BY jobs.id DESC");
				$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page);
				if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

				$r = $this->db->query("SELECT jobs.id,jobs.uid,jobs.cat,jobs.type,jobs.umowa,jobs.firma,jobs.title,jobs.city,jobs.woj,jobs.paymin,jobs.paymax,jobs.email,jobs.mobile,jobs.externallink,jobs.activationtime,jobs.days,jobs.active,jobs.ban,jobs.ontop,jobs.ontopid,jobs.highlight,users.username,(jobs.activationtime + INTERVAL jobs.days DAY) as endtime FROM jobs LEFT JOIN users ON jobs.uid=users.id WHERE jobs.uid = $uid AND (activationtime + INTERVAL jobs.days DAY) > NOW() ORDER BY jobs.ontop DESC,jobs.ontopid DESC,jobs.id DESC LIMIT " . $offset . "," . $items_per_page);
				return $rows = $r->fetchAll(PDO::FETCH_ASSOC);								
			}
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function getQuestions($tag, $search, $category = 1, $type = 1, $items_per_page = 25, $page = 1){
		try{
			$uid = (int)$uid;
			$category = (int)$category;
			$type = (int)$type;
			$search = htmlentities($search,ENT_QUOTES,'utf-8');
			$tag = htmlentities($tag,ENT_QUOTES,'utf-8');			
			$ip = $this->IP();
			// questions(uid,title,html,tags,type,ip)
			
			// count page
			if(!empty($_GET['page'])) {
			    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
			    if(false === $page) {
			        $page = 1;
			    }
			    if($page <= 0){
			    	$page = 1;
			    }
			}
			// build query
			$offset = ($page - 1) * $items_per_page;

			if($uid == 0){
				if($category > 0){
					$cat = 'questions.category = '.$category.' AND';
				}
				$t = '';
				if($type == 0){
					$t = 'questions.type IN(1,2,3) AND';					
				}
				if($type > 0){					
					$t = 'questions.type = '.$type.' AND';
				}
				// $r = $this->db->query("SELECT * FROM questions WHERE tags LIKE '$tag' OR title LIKE '$search' ORDER BY id DESC LIMIT 25");
				if(empty($tag) && empty($search)){					
					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat $t questions.active = 1 AND questions.ban = 0 ORDER BY questions.id DESC");
					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page);
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat $t questions.active = 1 AND questions.ban = 0 ORDER BY questions.ontop DESC,questions.ontopid DESC,questions.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				}
				if(!empty($tag) && !empty($search)){
					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat $t (questions.tags LIKE '%$tag%' OR questions.title LIKE '%$search%') AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.id DESC");
					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page);
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat $t (questions.tags LIKE '%$tag%' OR questions.title LIKE '%$search%') AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.ontop DESC,questions.ontopid DESC,questions.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				}
				if(!empty($tag)){
					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat $t questions.tags LIKE '%$tag%' AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.id DESC");
					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page);
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat $t questions.tags LIKE '%$tag%' AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.ontop DESC,questions.ontopid DESC,questions.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				}
				if(!empty($search)){
					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat $t questions.title LIKE '%$search%' AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.id DESC");
					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page)+1;
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE  $cat $t questions.title LIKE '%$search%' AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.ontop DESC,questions.ontopid DESC,questions.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			// get for userid
			if($uid > 0){
				//$r = $this->db->query("SELECT * FROM questions WHERE uid = '$uid' ORDER BY id DESC LIMIT 25");
				// return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				// return $cnt = $r->rowCount();
				// return $this->db->lastInsertId();
			}
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function getUserQuestions($tag, $search, $category = 1, $type = 0, $items_per_page = 25, $page = 1){
		try{
			$uid = $this->userID($_GET['id']);
			$category = (int)$category;
			$type = (int)$type;
			$search = htmlentities($search,ENT_QUOTES,'utf-8');
			$tag = htmlentities($tag,ENT_QUOTES,'utf-8');			
			$ip = $this->IP();
			// questions(uid,title,html,tags,type,ip)
			
			// count page
			if(!empty($_GET['page'])) {
			    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
			    if(false === $page) {
			        $page = 1;
			    }
			    if($page <= 0){
			    	$page = 1;
			    }
			}
			// build query
			$offset = ($page - 1) * $items_per_page;

			if($uid > 0){				
				// get onlly user questions
				$cat = 'questions.category = '.$category.' AND questions.uid = '.$uid.' AND';

				if($type == 0){
					$type = '1,2,3';
				}
				
				// $r = $this->db->query("SELECT * FROM questions WHERE tags LIKE '$tag' OR title LIKE '$search' ORDER BY id DESC LIMIT 25");
				if(empty($tag) && empty($search)){					
					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat questions.type IN(".$type.") AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.id DESC");
					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page);
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat questions.type IN(".$type.") AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.ontop DESC,questions.ontopid DESC,questions.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				}
				if(!empty($tag) && !empty($search)){
					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat questions.type IN(".$type.") AND (questions.tags LIKE '%$tag%' OR questions.title LIKE '%$search%') AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.id DESC");
					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page);
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat questions.type IN(".$type.") AND (questions.tags LIKE '%$tag%' OR questions.title LIKE '%$search%') AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.ontop DESC,questions.ontopid DESC,questions.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				}
				if(!empty($tag)){
					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat questions.type IN(".$type.") AND questions.tags LIKE '%$tag%' AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.id DESC");
					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page);
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat questions.type IN(".$type.") AND questions.tags LIKE '%$tag%' AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.ontop DESC,questions.ontopid DESC,questions.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				}
				if(!empty($search)){
					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE $cat questions.type IN(".$type.") AND questions.title LIKE '%$search%' AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.id DESC");
					$_SESSION['cntpages'] = (int)($r->rowCount() / $items_per_page)+1;
					if($_SESSION['cntpages'] < 1){$_SESSION['cntpages'] = 1;}

					$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE  $cat questions.type IN(".$type.") AND questions.title LIKE '%$search%' AND questions.active = 1 AND questions.ban = 0 ORDER BY questions.ontop DESC,questions.ontopid DESC,questions.id DESC LIMIT " . $offset . "," . $items_per_page);
					return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			// get for userid
			if($uid > 0){
				//$r = $this->db->query("SELECT * FROM questions WHERE uid = '$uid' ORDER BY id DESC LIMIT 25");
				// return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
				// return $cnt = $r->rowCount();
				// return $this->db->lastInsertId();
			}
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function getQuestionsRandom($type = 1, $items_per_page = 15){
		try{
			$uid = (int)$uid;
			$type = (int)$type;
			
			if($uid == 0){
				$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE questions.type = $type AND questions.active = 1 AND questions.ban = 0 ORDER BY RAND() LIMIT " . $items_per_page);
				return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
			}
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function getQuestion($qid = 0){
		try{			
			$qid = (int)$qid;
			
			if($uid == 0){
				$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.html,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,users.username,users.points as upoints,users.location FROM questions LEFT JOIN users ON questions.uid=users.id WHERE questions.id = $qid AND questions.active = 1 AND questions.ban = 0");
				return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
			}
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function getQuestionsComments($qid = 0){
		try{
			$qid = (int)$qid;
			$type = 4; // comments id
			
			if($qid > 0){
				$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.title,questions.html,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,questions.flags,users.username FROM questions LEFT JOIN users ON questions.uid=users.id WHERE questions.qid = $qid AND questions.type = $type AND questions.active = 1 AND questions.ban = 0");
				return $rows = $r->fetchAll(PDO::FETCH_ASSOC);
			}
		}catch(Exception $e){			
			return $rows;
		}
		return $rows;
	}

	function replaceTags($string){
		$allowed1 = array('[h1]' => '<h1>', '[h2]' => '<h2>', '[h3]' => '<h3>', '[code]' => '<code>', '[small]' => '<small>', '[b]' => '<b>', '[info]' => '<info>', '[alert]' => '<alert>', '[success]' => '<success>', '[notice]' => '<notice>', '[p]' => '<p>', '[li]' => '<li>');
		$allowed2 = array('[/h1]' => '</h1>', '[/h2]' => '</h2>', '[/h3]' => '</h3>', '[/code]' => '</code>', '[/small]' => '</small>', '[/b]' => '</b>', '[/info]' => '</info>', '[/alert]' => '</alert>', '[/success]' => '</success>', '[/notice]' => '</notice>', '[/p]' => '</p>', '[/color]' => '</span>', '[/li]' => '</li>');
		
		// preg_match_all('/\[color#[abcdef0123456]+]/im', 'foo[color#335533],adjasdasd [color#44bb55] adasjdasd [color#ff9966] i text [/color]', $matches, PREG_PATTERN_ORDER);
		// print_r($matches);
		preg_match_all('/\[color#[abcdef0123456789]+]/im', $string, $matches, PREG_PATTERN_ORDER);
		foreach ($matches[0] as $v) {
			$d = str_replace(']', '', $v);
			$hex = end(explode("#", $d));
			if(strlen($hex) == 6 || strlen($hex) == 3){
				$replace = '<span style="color: #'.$hex.'">';
				$string = str_replace($v, $replace, $string);
			}			
		}
		foreach ($allowed1 as $k => $v) {
			$string = str_replace($k, $v, $string);
		}
		foreach ($allowed2 as $k => $v) {
			$string = str_replace($k, $v, $string);
		}
		return $string;
	}

	function delQuestionComment($uid, $qid){
		try{
			$uid = (int)$uid;
			$qid = (int)$qid;
			// iff logged userid > 0
			if($uid > 0){
				$r = $this->db->query("UPDATE questions SET active = -1 WHERE uid = $uid AND id = $qid");
				// return $this->db->lastInsertId();
				return $cnt = $r->rowCount();
			}
		}catch(Exception $e){			
			return 0;
		}
		return 0;
	}

	function addQuestion($uid, $title, $html, $tags, $type = 1, $category = 1){
		try{
			$uid = (int)$uid;
			$category = (int)$category;
			$title = htmlentities($title,ENT_QUOTES,'utf-8');
			$html = htmlentities($html,ENT_QUOTES,'utf-8');
			$tags = htmlentities($tags,ENT_QUOTES,'utf-8');
			$type = (int)$type;
			$ip = $this->IP();
			if($uid > 0){
			$r = $this->db->query("INSERT INTO questions(uid,category,title,html,tags,type,ip) VALUES ($uid,$category,'$title','$html','$tags',$type,'$ip')");				
				return $this->db->lastInsertId();
			}
		}catch(Exception $e){
			if ($e->getCode() == '23000'){
				return -1;
			}	
			return 0;
		}
		return 0;
	}

	function addQuestionComment($uid, $title, $html, $tags, $type = 1, $category = 0, $questionid = 0){
		try{
			$uid = (int)$uid;
			$qid = (int)$questionid;
			$category = (int)$category;
			$title = htmlentities($title,ENT_QUOTES,'utf-8');
			$html = htmlentities($html,ENT_QUOTES,'utf-8');
			$tags = htmlentities($tags,ENT_QUOTES,'utf-8');
			$type = (int)$type;
			$ip = $this->IP();
			if($uid > 0){
			$r = $this->db->query("INSERT INTO questions(uid,qid,category,title,html,tags,type,ip) VALUES ($uid,$qid,$category,'$title','$html','$tags',$type,'$ip')");				
				return $this->db->lastInsertId();
			}
		}catch(Exception $e){
			if ($e->getCode() == '23000'){
				return -1;
			}	
			return 0;
		}
		return 0;
	}

	function addQuestionFlag($uid, $qid, $title){
		try{
			$uid = (int)$uid;
			$qid = (int)$qid;
			$title = htmlentities($title,ENT_QUOTES,'utf-8');			
			$ip = $this->IP();
			if($uid > 0){				
				$r = $this->db->query("INSERT INTO flaged(uid,qid,title,ip) VALUES($uid,$qid,'$title','$ip')");								
				$cnt = $this->db->lastInsertId();				
				if($cnt > 0){
					$flags = $this->cntFlags($qid);
					$r = $this->db->query("UPDATE questions SET flags = $flags WHERE id = $qid");
				}
				return $cnt;
			}
		}catch(Exception $e){
			if ($e->getCode() == '23000'){
				return 1;
			}	
			return 0;
		}
		return 0;
	}

	// get question answers
	function getAnswers($qid, $type = 0){
		try{			
			$qid = (int)$qid;
			// get question answers			
			$r = $this->db->query("SELECT questions.id,questions.uid,questions.type,questions.html,questions.tags,questions.points,questions.views,questions.answers,questions.ip,questions.time,questions.active,questions.answered,questions.answerid,questions.ban,users.username,users.points as upoints from questions LEFT JOIN users ON questions.uid=users.id WHERE questions.qid = $qid AND questions.type = $type AND questions.active = 1 AND questions.ban = 0 ORDER BY answered DESC, points DESC");
			return $rows = $r->fetchAll(PDO::FETCH_ASSOC);			
		}catch(Exception $e){						
			return $rows;
		}		
	}

	function cntFlags($qid){
		try{			
			$qid = (int)$qid;
			// update like			
			$r = $this->db->query("SELECT COUNT(*) as cnt FROM flaged WHERE qid = $qid");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			return (int)$rows[0]['cnt'];
		}catch(Exception $e){						
			return 0;
		}		
	}

	// czy uzytkownik juz odpowiedział raz na pytanie
	function userAnsweredQuestion($uid = 0, $qid = 0, $type = 0){
		try{
			$uid = (int)$uid;
			$qid = (int)$qid;
			$type = (int)$type;
			$r = $this->db->query("SELECT id FROM questions WHERE uid = $uid AND qid = $qid AND type = $type AND active = 1");
			return $r->rowCount();
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	// Sledzenie otwieranych stron
	function addActivity($uid, $qid = 0, $pid = 1){
		try{
			$uid = (int)$uid;
			$qid = (int)$qid;
			$pid = (int)$pid;
			$ip = $this->IP();
			if($uid >= 0){
			$r = $this->db->query("INSERT INTO activity(uid,qid,pid,ip) VALUES ($uid, $qid, $pid, '$ip')");
				return $this->db->lastInsertId();
			}
		}catch(Exception $e){
			return 0;
		}
		return 0;
	}

	function addFiles($uid, $name, $path){
		try{
			$uid = (int)$uid;
			$name = htmlentities($name,ENT_QUOTES,'utf-8');
			$path = htmlentities($path,ENT_QUOTES,'utf-8');
			$ip = $this->IP();
			if($uid > 0){
			$r = $this->db->query("INSERT INTO files(uid,name,path,ip) VALUES ($uid, '$name', '$path', '$ip')");
				return $this->db->lastInsertId();
			}
		}catch(Exception $e){
			return 0;
		}
		return 0;
	}

	function addNotifications($uid, $qid, $text){
		try{
			$uid = (int)$uid;
			$qid = (int)$qid;
			$t = htmlentities($text,ENT_QUOTES,'utf-8');			
			if($uid > 0){
			$r = $this->db->query("INSERT INTO notifications(uid,qid,text) VALUES ($uid,$qid,'$t')");
				return $this->db->lastInsertId();
			}
		}catch(Exception $e){
			if ($e->getCode() == '23000'){
				return -1;
			}	
			return 0;
		}
		return 0;
	}

	function getFiles($userid, $items_per_page = 2){
		try{
			// determine page number from $_GET
			$page = 1;
			if(!empty($_GET['page'])) {
			    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
			    if(false === $page) {
			        $page = 1;
			    }
			    if($page <= 0){
			    	$page = 1;
			    }
			}
			// build query
			$offset = ($page - 1) * $items_per_page;

			$uid = (int)$userid;
			// policz powiadomienia
			$r = $this->db->query("SELECT * FROM files WHERE uid = $uid ORDER BY id DESC LIMIT " . $offset . "," . $items_per_page);
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			// return $cnt = $r->rowCount();			
			return $rows;
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function delFiles($userid,$file){
		try{			
			$uid = (int)$userid;
			$file = htmlentities($file, ENT_QUOTES, 'utf-8');
			// policz powiadomienia
			$r = $this->db->query("DELETE FROM files WHERE uid = $uid AND name = '$file'");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			// return $cnt = $r->rowCount();			
			$uploads_dir = 'media/files/'.(int)$_SESSION['userid'];
			if(file_exists($uploads_dir.'/'.htmlentities($file,ENT_QUOTES,'utf-8'))){
				unlink($uploads_dir.'/'.htmlentities($file,ENT_QUOTES,'utf-8'));
			}
			return $rows;
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function userNotifications($userid){
		try{			
			$uid = (int)$userid;
			// policz powiadomienia
			$r = $this->db->query("SELECT COUNT(id) as cnt FROM notifications WHERE uid = $uid");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			// return $cnt = $r->rowCount();			
			return $rows[0]['cnt'];
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}


	function getNotifications($userid, $limit = 10, $active = 1){
		try{			
			$uid = (int)$userid;
			$active = (int)$active;
			// pobierz powiadomienia
			$sql  = "SELECT notifications.id,notifications.uid,notifications.qid,notifications.active,notifications.text,questions.title,questions.qid as answerforquestion FROM notifications LEFT JOIN questions ON notifications.qid=questions.id WHERE notifications.uid = $uid AND notifications.active = $active ORDER BY notifications.id DESC LIMIT $limit";
			$r = $this->db->query($sql);			
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			return $rows;
		}catch(Exception $e){						
			return $rows;
		}
		return $rows;
	}

	function UpdateUser($firstname, $lastname, $sex, $location, $www, $about, $mobile){
		try{
			$email = htmlentities($_SESSION['useremail'],ENT_QUOTES,'utf-8');
			$firstname = htmlentities($firstname,ENT_QUOTES,'utf-8');
			$lastname = htmlentities($lastname,ENT_QUOTES,'utf-8');
			$location = htmlentities($location,ENT_QUOTES,'utf-8');
			$www = htmlentities($www,ENT_QUOTES,'utf-8');
			$mobile = htmlentities($mobile,ENT_QUOTES,'utf-8');
			$about = htmlentities(substr($about,0,505),ENT_QUOTES,'utf-8');
			if($sex > 0){
				$sex = 1;
			}else{
				$sex = 0;
			}
			// send email
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){				
				$_SESSION['userfirstname'] = $_POST['firstname'];
				$_SESSION['userlastname'] = $_POST['lastname'];
				$_SESSION['usersex'] = $_POST['sex'];				
				$_SESSION['userwww'] = $_POST['www'];
				$_SESSION['userabout'] = $_POST['about'];
				$_SESSION['userlocation'] = $_POST['location'];
				$_SESSION['usermobile'] = $_POST['mobile'];

				/*
				$_SESSION['company'] = $_POST['company'];
				$_SESSION['c_name'] = $_POST['c_name'];
				$_SESSION['c_location'] = $_POST['c_location'];
				$_SESSION['c_address'] = $_POST['c_address'];
				$_SESSION['c_mobile'] = $_POST['c_mobile'];
				$_SESSION['c_www'] = $_POST['c_www'];
				$_SESSION['c_nip'] = $_POST['c_nip'];
				*/
				$r = $this->db->query("UPDATE users SET firstname = '$firstname', lastname = '$lastname', sex = $sex, location = '$location', www = '$www', about = '$about', mobile = '$mobile' WHERE email = '$email' AND active = 1 AND ban = 0");
				return $r->rowCount();				
			}			
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function UpdateUserCompany($category = 1, $company = 1, $name, $location, $address, $mobile, $www, $nip, $about, $abouthtml){
		try{
			if($company != 0){
				$company = 1;
			}else{
				$company = 0;
			}
			$name = htmlentities($name,ENT_QUOTES,'utf-8');
			$location = htmlentities($location,ENT_QUOTES,'utf-8');
			$address = htmlentities($address,ENT_QUOTES,'utf-8');
			$mobile = htmlentities($mobile,ENT_QUOTES,'utf-8');
			$www = htmlentities($www,ENT_QUOTES,'utf-8');			
			$nip = htmlentities($nip,ENT_QUOTES,'utf-8');
			$about = htmlentities($about,ENT_QUOTES,'utf-8');
			$abouthtml = htmlentities($abouthtml,ENT_QUOTES,'utf-8');
			$uid = (int)$_SESSION['userid'];
			$category = (int)$category;
						
			// $_SESSION['company'] = $_POST['company'];
			$_SESSION['company'] = $company;
			$_SESSION['c_category'] = $category;
			$_SESSION['c_name'] = $name;
			$_SESSION['c_location'] = $location;
			$_SESSION['c_address'] = $address;
			$_SESSION['c_mobile'] = $mobile;
			$_SESSION['c_www'] = $www;
			$_SESSION['c_nip'] = $nip;
			$_SESSION['c_about'] = $about;
			$_SESSION['c_abouthtml'] = $abouthtml;
			
			$r = $this->db->query("UPDATE users SET company = $company, c_category = $category, c_name = '$name',  c_location = '$location', c_address = '$address', c_mobile = '$mobile', c_www = '$www', c_nip = '$nip', c_about = '$about', c_abouthtml = '$abouthtml' WHERE id = $uid AND active = 1 AND ban = 0");
			return $r->rowCount();				
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function Login($email, $pass){
		try{
			if(!empty($_POST['login'])){
				if(!empty($email) && !empty($pass)) {
					$email = htmlentities($email,ENT_QUOTES,'utf-8');
					$pass = md5($pass);
					// select
					$r = $this->db->query("SELECT id,email,username,firstname,lastname,sex,location,www,about,points,ban,company,c_name,c_location,c_address,c_mobile,c_www,c_nip FROM users WHERE email = '$email' AND pass = '$pass' AND active = 1 AND ban != 2");
					// get email,name,id
					$rows = $r->fetchAll(PDO::FETCH_ASSOC);
					// cnt
					$cnt = $r->rowCount();
					if($cnt > 0 && $rows[0]['id'] > 0){
						// Set in session
						$_SESSION['userid'] = (int)$rows[0]['id'];
						$_SESSION['useremail'] = $rows[0]['email'];
						$_SESSION['username'] = $rows[0]['username'];
						$_SESSION['userfirstname'] = $rows[0]['firstname'];
						$_SESSION['userlastname'] = $rows[0]['lastname'];
						$_SESSION['usersex'] = (int)$rows[0]['sex'];
						$_SESSION['userlocation'] = $rows[0]['location'];
						$_SESSION['userwww'] = $rows[0]['www'];
						$_SESSION['userabout'] = $rows[0]['about'];
						$_SESSION['userpoints'] = (int)$rows[0]['points'];
						$_SESSION['userban'] = (int)$rows[0]['ban'];
						// company
						$_SESSION['company'] = $rows[0]['company'];
						$_SESSION['c_name'] = $rows[0]['c_name'];
						$_SESSION['c_location'] = $rows[0]['c_location'];
						$_SESSION['c_address'] = $rows[0]['c_address'];
						$_SESSION['c_mobile'] = $rows[0]['c_mobile'];
						$_SESSION['c_about'] = $rows[0]['c_about'];
						$_SESSION['c_abouthtml'] = $rows[0]['c_abouthtml'];
						$_SESSION['c_www'] = $rows[0]['c_www'];
						$_SESSION['c_nip'] = $rows[0]['c_nip'];
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
			$name = preg_replace('/[^A-Za-z0-9-]/', '', $name);
			$email = htmlentities($email,ENT_QUOTES,'utf-8');
			$pass = md5($pass);
			$ip = htmlentities($ip,ENT_QUOTES,'utf-8');
			// if valid email
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				// $code = $this->getActivateCode($email);
				$code = rand(123456,999999);
				$ok = $this->AktywacjaNewslettera($email, $code);
				if($ok == 1){
					$r = $this->db->query("INSERT INTO users(email,pass,username,ip,active,code,role) VALUES ('$email','$pass','$name','$ip',0,'$code',1)");
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
			$p = md5($pass);
			// send email
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$ok = $this->sendEmail($mailbox, $pass);
				if($ok == 1){				
					$r = $this->db->query("UPDATE users SET pass = '$p' WHERE email = '$mailbox' AND active = 1 AND ban = 0");
					return $r->rowCount();
				}
			}			
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function NewPassword($email, $oldpass, $newpass1, $newpass2){
		try{
			if($newpass1 == $newpass2){
				$mailbox = htmlentities($email,ENT_QUOTES,'utf-8');
				$p1 = md5($oldpass);
				$p2 = md5($newpass1);
				// send email
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$r = $this->db->query("UPDATE users SET pass = '$p2' WHERE email = '$mailbox' AND pass = '$p1' AND active = 1 AND ban = 0");
					return $r->rowCount();				
				}	
			}		
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function ActivateUser($email,$code){
		try{
			$code = htmlentities($code,ENT_QUOTES,'utf-8');
			$email = htmlentities($email,ENT_QUOTES,'utf-8');
			$r = $this->db->query("UPDATE users SET active = 1, code = 0 WHERE email = '$email' AND code = '$code' AND ban = 0");
			return $r->rowCount();			
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	// Zaznacz odpowiedź jako poprawną
	function setAnswered($uid, $qid, $aid, $auid){
		try{			
			$uid = (int)$uid;
			$qid = (int)$qid;
			$aid = (int)$aid;
			$auid = (int)$auid;

			$r = $this->db->query("SELECT answerid FROM questions WHERE id = $qid AND answered = 1");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			$id = (int)$rows[0]['answerid'];
			if($id == $aid){
				$r = $this->db->query("UPDATE questions SET answered = 0, answerid = 0 WHERE qid = $qid AND type = 0");
				$r = $this->db->query("UPDATE questions SET answered = 0, answerid = 0 WHERE id = $qid AND type != 0");
			}else{
				$r = $this->db->query("UPDATE questions SET answered = 0, answerid = 0 WHERE qid = $qid AND type = 0");
				$r = $this->db->query("UPDATE questions SET answered = 1, answerid = $aid WHERE id = $qid AND type != 0");
				$r = $this->db->query("UPDATE questions SET answered = 1, answerid = $qid WHERE id = $aid AND type = 0");
			}

			/*
			$r = $this->db->query("SELECT answerid FROM questions WHERE id = $qid AND answered = 1");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);			
			$id = (int)$rows[0]['answerid'];
			if($id == 0){				
				$r = $this->db->query("UPDATE questions SET answered = 1, answerid = $aid WHERE id = $qid AND uid = $uid AND type = 0");
			}else{
				$r = $this->db->query("UPDATE questions SET answered = 0, answerid = 0 WHERE id = $qid AND type = 0");
			}
			*/
			return 1;
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	// Dodaj lub odejmij punkty za poprawną odpowiedź
	function addPointsAnswered($uid, $aid){
		// Insert to points

		// cntPoints for user

		// update points for user		
	}
	// Odejmij punkty doświadczenia
	function removePointsAnswered($uid, $aid){
		// update to points = 0 for $aid

		// cntPoints for user

		// update points for user
	}


	function delAnswer($uid, $qid){
		try{
			$uid = (int)$uid;
			$qid = (int)$qid;			
			if($uid > 0){
				$r = $this->db->query("UPDATE questions SET active = -1 WHERE id = $qid AND uid = $uid");
				return $r->rowCount();
			}
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function likeComment($uid, $qid){
		try{
			$uid = (int)$uid; // comment user id
			$qid = (int)$qid; // question id
			$fuid = (int)$_SESSION['userid'];			
			$ip = $this->IP();

			// update like on comments		
			$r = $this->db->query("SELECT id FROM points WHERE uid = $uid AND qid = $qid AND points = 1 AND type = 4 AND active = 1");
			if($r->rowCount() > 0){
				$r = $this->db->query("INSERT INTO points(uid,qid,type,fuid,points,ip) VALUES($uid,$qid,4,$fuid,1,'$ip') ON DUPLICATE KEY UPDATE points = IF(points>0,0,1)");
				$r = $this->db->query("UPDATE users SET points = points-1 WHERE id = $uid");
			}else{
				$r = $this->db->query("INSERT INTO points(uid,qid,type,fuid,points,ip) VALUES($uid,$qid,4,$fuid,1,'$ip') ON DUPLICATE KEY UPDATE points = IF(points>0,0,1)");
				$r = $this->db->query("UPDATE users SET points = points+1 WHERE id = $uid");
			}
			$cntcomment = $this->cntComment($qid);
			$r = $this->db->query("UPDATE questions SET points = $cntcomment WHERE id = $qid AND active = 1");
			// $r->rowCount();
			return $cntcomment;
			// return $r->rowCount();					
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function likeQuestion($uid, $qid){
		$points = 0;
		try{
			$uid = (int)$uid;
			$qid = (int)$qid;
			$fuid = (int)$_SESSION['userid'];			
			$ip = $this->IP();

			// update like	
			$r = $this->db->query("SELECT id FROM points WHERE uid = $uid AND qid = $qid AND points = 1 AND type = 1 AND active = 1");
			if($r->rowCount() == 0){
				$r = $this->db->query("INSERT INTO points(uid,qid,type,fuid,points,ip) VALUES($uid,$qid,1,$fuid,1,'$ip') ON DUPLICATE KEY UPDATE points = 1");
				$points = $this->cntPoints($qid);				
				$r = $this->db->query("UPDATE questions SET points = $points WHERE id = $qid");
				$r = $this->db->query("UPDATE users SET points = points+1 WHERE id = $uid");
			}else{
				$points = $this->cntPoints($qid);				
				$r = $this->db->query("UPDATE questions SET points = $points WHERE id = $qid");
			}
			$points = $this->getPoints($qid);	
			return $points;
			// return $r->rowCount();					
		}catch(Exception $e){						
			return $points;
		}
		return $points;
	}

	function unlikeQuestion($uid, $qid){
		$points = 0;
		try{
			$uid = (int)$uid;
			$qid = (int)$qid;
			$fuid = (int)$_SESSION['userid'];		
			$ip = $this->IP();

			// update like			
			$r = $this->db->query("SELECT id FROM points WHERE uid = $uid AND qid = $qid AND points = -1 AND type = 1 AND active = 1");
			if($r->rowCount() == 0){
				$r = $this->db->query("INSERT INTO points(uid,qid,type,fuid,points,ip) VALUES($uid,$qid,1,$fuid,1,'$ip') ON DUPLICATE KEY UPDATE points = -1");				
				$p = $this->cntPoints($qid);				
				$r = $this->db->query("UPDATE questions SET points = $p WHERE id = $qid");
				$r = $this->db->query("UPDATE users SET points = points-1 WHERE id = $uid");
			}else{
				echo $points = $this->cntPoints($qid);				
				$r = $this->db->query("UPDATE questions SET points = $points WHERE id = $qid");
			}
			$points = $this->getPoints($qid);			
			return $points;
			// return $r->rowCount();					
		}catch(Exception $e){						
			return $points;
		}
		return $points;
	}

	// pobierz punkty
	function getPoints($qid){
		try{			
			$qid = (int)$qid;			

			// update like			
			$r = $this->db->query("SELECT points FROM questions WHERE id = $qid AND active = 1");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			// return $r->rowCount();					
			return $rows[0]['points'];
		}catch(Exception $e){						
			return 0;
		}		
	}

	// policz punkty
	function cntPoints($qid, $type = 1){
		try{			
			$qid = (int)$qid;			

			// update like			
			$r = $this->db->query("SELECT SUM(points) as cnt FROM points WHERE qid = $qid AND active = 1");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);
			// return $r->rowCount();
			return $rows[0]['cnt'];
		}catch(Exception $e){						
			return 0;
		}		
	}


	function updateQuestionViews($qid){
		try{			
			$qid = (int)$qid;
			// user display page question single
			$this->addActivity((int)$_SESSION['userid'], $qid, 2);
			// update views + 1
			$r = $this->db->query("UPDATE questions SET views = views+1 WHERE id = $qid");			
			return $r->rowCount();					
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}	

	function updateQuestion($uid, $html, $qid, $title = ''){
		if(empty($title)){$title = microtime();}
		try{
			$uid = (int)$uid;			
			$qid = (int)$qid;
			$html = htmlentities($html,ENT_QUOTES,'utf-8');
			// update question content		
			if($uid > 0){
				$r = $this->db->query("UPDATE questions SET html = '$html' WHERE id = $qid AND uid = $uid");			
				return $r->rowCount();
			}
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	function updateAnswer($uid, $html, $qid, $title = ''){
		if(empty($title)){$title = microtime();}
		try{
			$uid = (int)$uid;			
			$qid = (int)$qid;
			$html = htmlentities($html,ENT_QUOTES,'utf-8');
			$title = htmlentities($title,ENT_QUOTES,'utf-8');
			// update question content		
			if($uid > 0){
				$r = $this->db->query("UPDATE questions SET title = '$title', html = '$html' WHERE id = $qid AND uid = $uid");			
				return $r->rowCount();
			}
		}catch(Exception $e){						
			return 0;
		}
		return 0;
	}

	// policz komentarze dla qid
	function cntComment($qid){
		try{			
			$qid = (int)$qid;			

			// update like			
			$r = $this->db->query("SELECT SUM(points) as cnt FROM points WHERE qid = $qid AND type = 4");
			$rows = $r->fetchAll(PDO::FETCH_ASSOC);				
			// return $r->rowCount();					
			return (int)$rows[0]['cnt'];
		}catch(Exception $e){						
			return 0;
		}		
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
	function AktywacjaNewslettera($email, $code, $domena = 'qflash.pl') {
		$subject = 'Aktywacja newslettera Qflash.pl'; 
		$from_user = "Qflash.pl";
		$from_email = "no-reply@".$domena;   	
   		$msg = 'Witaj na '.$domena.'! <br> Link aktywujący bezpłatne konto <a href="https://'.$domena.'/activate.php?code='.$code.'&email='.$email.'"> Potwierdź adres e-mail </a> <br> Pozdrawiamy <br> Qflash.pl';
   		ini_set("sendmail_from", $from_email);
      	$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
      	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
      	$headers = "From: $from_user <$from_email>" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n" . "Reply-to: <$from_email>" . "\r\n";
      	$o = mail($email, $subject, $msg, $headers, "-f ".$from_email);
      	if (!empty($o)) {
      		return $o;
      	}
    	return 0;
   	}

   	function AktywacjaNewslettera_utf8($email, $code, $domena = 'qflash.pl', $from_user = "Qflash aktywacja", $from_email = "noreply@qflash.pl", $subject = 'Witaj na Qflash.pl - Potwierdź swój adres e-mail'){
		ini_set("sendmail_from", "noreply@qflash.pl");		
	      	$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
	      	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";      	
	      	$headers = "Return-Path: <$from_email>"."\r\n"."From: $from_user <$from_email>" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n" . "Reply-to: <$from_email>" . "\r\n";
	      	$msg = 'Witaj na '.$domena.'! <br> Twój link aktywacyjny <a href="https://'.$domena.'/activate.php?code='.$code.'&email='.$email.'"> Aktywuj adres email </a> <br> Pozdrawiamy <br> Qflash.pl';
	    	return mail($email, $subject, $msg , $headers, "-f ".$from_email);
	}

   	function sendEmail($email, $code) {
		$subject = 'Zmiana hasła na qflash.pl'; 
		$from_user = "Qflash.pl";
		$from_email = "no-reply@qflash.pl";   	
   		$msg = 'Dzień dobry! <br> Twoje nowe hasło: '.$code.' <br> Pozdrawiamy <br> Qflash.pl';
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

	function convertPHPSizeToBytes($sSize)
	{	    
	    $sSuffix = strtoupper(substr($sSize,strlen($sSize)-1));
	    if (!in_array($sSuffix,array('P','T','G','M','K'))){
	        return (int)$sSize;  
	    } 
	    $iValue = substr($sSize, 0, -1);
	    switch ($sSuffix) {
	        case 'P':
	            $iValue *= 1024;
	            // Fallthrough intended
	        case 'T':
	            $iValue *= 1024;
	            // Fallthrough intended
	        case 'G':
	            $iValue *= 1024;
	            // Fallthrough intended
	        case 'M':
	            $iValue *= 1024;
	            // Fallthrough intended
	        case 'K':
	            $iValue *= 1024;
	            break;
	    }
	    return (int)$iValue;
	}      

	function getMaximumFileUploadSize($inbytes = 0)  
	{  
		if($inbytes == 1){
	    	// return min($this->convertPHPSizeToBytes(ini_get('post_max_size')), $this->convertPHPSizeToBytes(ini_get('upload_max_filesize')));
	    	return $this->convertPHPSizeToBytes(ini_get('upload_max_filesize'));
		}else{
	    	// return min(ini_get('post_max_size'), ini_get('upload_max_filesize'));  
	    	return ini_get('upload_max_filesize');  
		}
	}

	function closeTags($html)
	{
	  #put all opened tags into an array
	  preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
	  $openedtags = $result[1];
	  #put all closed tags into an array
	  preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
	  $closedtags = $result[1];
	  $len_opened = count ( $openedtags );
	  # all tags are closed
	  if( count ( $closedtags ) == $len_opened )
	  {
	  return $html;
	  }
	  $openedtags = array_reverse ( $openedtags );
	  # close tags
	  for( $i = 0; $i < $len_opened; $i++ )
	  {
	      if ( !in_array ( $openedtags[$i], $closedtags ) )
	      {
	      $html .= "</" . $openedtags[$i] . ">";
	      }
	      else
	      {
	      unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
	      }
	  }
	  return $html;
	}

	function plainUrlToLink($txt_content,$target="_blank") {       
	    $regex = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,6}(\/\S*)+?/";
	    if(preg_match($regex, $txt_content, $matches)) {
	       return preg_replace($regex, '<a href="'.$matches[0].'">'.$matches[0].'</a>', $txt_content);
	    } 
	    else {
	       return $txt_content;
	    }
	}

	// $pattern = '/(?<!")https?:\/\/(.*?)\.(jpg|png|gif)(?!")(\?\w+=\w+)?/i';

	public function linkify($showimg = 1, $value, $protocols = array('http', 'mail', 'https'), array $attributes = array('target' => '_blank'))
    {    	
        // Link attributes
        $attr = '';
        foreach ($attributes as $key => $val) {
            $attr = ' ' . $key . '="' . htmlentities($val) . '"';
        }
        
        $links = array();
        
        // Extract existing links and tags
        $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);
        
        // Extract text links for each protocol
        foreach ((array)$protocols as $protocol) {
            switch ($protocol) {
                case 'http':
                case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', 
                	function ($match) use ($protocol, &$links, $attr, $showimg) { 
                		if ($match[1]){
                			$protocol = $match[1]; $link = $match[2] ?: $match[3]; 
                			// Youtube
                  			if($showimg == 1){                  				
	                			if(strpos($link, 'youtube.com')>0 || strpos($link, 'youtu.be')>0){							    	
							    	$link = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/'.end(explode('=', $link)).'?rel=0&showinfo=0&color=orange&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>';
							    	return '<' . array_push($links, $link) . '></a>';
	                			}
                				if(strpos($link, '.png')>0 || strpos($link, '.ico')>0 || strpos($link, '.jpg')>0 || strpos($link, '.jpeg')>0 || strpos($link, '.gif')>0 || strpos($link, '.bmp')>0){
                					return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" class=\"htmllink\"><img src=\"$protocol://$link\" class=\"htmlimg\">") . '></a>';
                				}
                			}                			
                			return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" class=\"htmllink\">$link</a>") . '>';                			
                		}                			
                }, $value); break;
                case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\" class=\"htmllink\">{$match[1]}</a>") . '>'; }, $value); break;
                case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\" class=\"htmllink\">{$match[0]}</a>") . '>'; }, $value); break;
                default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\" class=\"htmllink\">{$match[1]}</a>") . '>'; }, $value); break;
            }
        }
        
        // Insert all link
        return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);
    }

	function convertYoutube($string) {	    
	    if(strpos($string, 'youtu')){
	    	$id = end(explode('=', $string));
	    }    	
    	return '<iframe width="100%" height="315" src="https://www.youtube.com/embed/'.$id.'?rel=0&showinfo=0&color=orange&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>';
	}

	function userToLink($txt){
		return preg_replace('/(?<=^|\s)@([a-z0-9_]+)/i', '<a href="/user/$1" target="_balnk" class="userlink">@$1</a>', $txt);
	}

	function strip_javascript($filter, $allowed=0){
		if($allowed == 0) // 1 href=...
		$filter = preg_replace('/href=([\'"]).*?javascript:.*?\\1/i', "'", $filter);
		if($allowed == 0) // 2 <script....
		$filter = preg_replace("/<script.*?>.*?<\/script>/i", "", $filter);
		if($allowed == 0) // 4 <tag on.... ---- useful for onlick or onload
		$filter = preg_replace("/<(.*)?\son.+?=\s*?(['\"]).*?\\2/i", "<$1", $filter);
		return $filter;
	}

	function cleanEvilTags($data) {
		$data = preg_replace("/<\?/i", "&lt;?",$data);
		$data = preg_replace("/\?>/i", "?&gt;",$data);
		$data = preg_replace('/(on.*)=/', 'error=', $data);
	  	$data = preg_replace("/javascript/i", "j&#097;v&#097;script",$data);
	  	$data = preg_replace("/alert/i", "&#097;lert",$data);
	  	$data = preg_replace("/about:/i", "&#097;bout:",$data);
		$data = preg_replace("/onmouseover/i", "&#111;nmouseover",$data);
		$data = preg_replace("/onmouseout/i", "&#111;nmouseout",$data);
		$data = preg_replace("/onclick/i", "&#111;nclick",$data);
		$data = preg_replace("/onchange/i", "&#111;nchange",$data);
		$data = preg_replace("/onload/i", "&#111;nload",$data);
		$data = preg_replace("/onkeydown/i", "&#111;nkeydown",$data);
		$data = preg_replace("/onkeyup/i", "&#111;nkeyup",$data);
		$data = preg_replace("/onsubmit/i", "&#111;nsubmit",$data);		
		$data = preg_replace("/<body/i", "&lt;body",$data);
		$data = preg_replace("/<html/i", "&lt;html",$data);
		$data = preg_replace("/<head/i", "&lt;head",$data);
		$data = preg_replace("/<meta/i", "&lt;head",$data);
		$data = preg_replace("/<link/i", "&lt;link",$data);
		$data = preg_replace("/<style/i", "&lt;style",$data);
		$data = preg_replace("/<form/i", "&lt;form",$data);
		$data = preg_replace("/<input/i", "&lt;input",$data);
		$data = preg_replace("/<select/i", "&lt;select",$data);
		$data = preg_replace("/<button/i", "&lt;button",$data);	  
		$data = preg_replace("/<textarea/i", "&lt;textarea",$data);	  	  
		$data = preg_replace("/document\./i", "&#100;ocument.",$data);	  
		return $data = preg_replace("/<script/i", "&lt;&#115;cript",$data);	  
	  // return strip_tags(trim($data));
	}

	function days($datetime = "2018-02-20 15:55:55"){
		$now = time();
		$date = strtotime($datetime);
		$datediff = $date - $now;
		return round($datediff / (60 * 60 * 24));
	}
}
