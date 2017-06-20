<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 1);
ini_set("default_charset", "UTF-8");

date_default_timezone_set('Europe/Warsaw');

// ini_set('session.cookie_httponly',1);
// ini_set('session.use_only_cookies',1);
// ini_set('session.cookie_secure',0);
// ini_set('session.cookie_lifetime', 0);
// ini_set('session.gc_maxlifetime', '1440');
// ini_set('session.cookie_domain','domain.loc');
// ini_set('session.cookie_path', '/');

// load config mysql data
require('config.php');

// sent email like
ini_set("sendmail_from", $sendmail_from);

// max upload file size
ini_set('post_max_size', '200M');
ini_set('upload_max_filesize', '200M');

/*
* Default function
*/
class Sun
{
	
	public $db;

	function __construct()
	{
			// db connection
		$this->db = $this->Conn();

		// clear POST and GET
		$this->Clear();
	}

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

	// dodaj wiadomość
	function AddKontaktMessage($imie,$email,$mobile,$opis){
		global $sunemail;
		$id = 0;
		$time = time();
		if ($this->validEmail($email)) {
			$r = $this->db->query("INSERT INTO kontakt_messages(imie,email,mobile,opis,time) VALUES('$imie','$email','$mobile','$opis',$time)");
			$id = $this->db->lastInsertId();
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

	function mail($to, $from, $subject, $msg, $name)
   	{
   		ini_set("sendmail_from", $from);
      	$name = "=?UTF-8?B?".base64_encode($name)."?=";
      	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";      	
      	$headers = "From: $name <$from>" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n" . "Reply-to: <$from>" . "\r\n";
    	return mail($to, $subject, $msg , $headers);
   	}

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

	function getUrl(){
		$d = $_SERVER['HTTP_HOST'].pathinfo($_SERVER['REQUEST_URI'],PATHINFO_DIRNAME);	
		return $d;
	}

	function randomPassword($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}	

	function logDB(){
	    // create database first
	    // CREATE TABLE IF NOT EXISTS `logs` (`link` text, `ip` text) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	    $log = $_SERVER['HTTP_HOST']." ".$_SERVER['REQUEST_URI'];
	    $ip = $_SERVER['REMOTE_ADDR'];
	    $log = htmlentities($log,ENT_QUOTES, 'utf-8');
	    mysql_query("CREATE TABLE IF NOT EXISTS `logs` (`link` text, `ip` text) ENGINE=MyISAM DEFAULT CHARSET=utf8");
	    mysql_query("INSERT INTO logs(link,ip) VALUE('$log','$ip')");    
	}

	function logrequest($pathdir = "_logs"){    
	    if(!is_dir($pathdir)){
	    mkdir($pathdir, 0700, true);
	    }
	    $file = $pathdir.'/log-UTC'.date('Y-m-d-h', time()).'.txt';
	    file_put_contents($file, time()." ".$_SERVER['REMOTE_ADDR']." ".$_SERVER['REQUEST_URI']."\r\n", FILE_APPEND | LOCK_EX);
	}


	function Youtube($string) {
	    return preg_replace(
	        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
	        "<iframe width=\"100%\" height=\"auto\" src=\"//www.youtube.com/embed/$2\" allowfullscreen frameborder=\"0\"></iframe>",
	        $string
	    );
	}

	// cut hastags and insert to database with pdo connection
	function hashtag($str = '', $postid ,$PDO = 'PDO connection'){		
		//preg_match_all("/#(\w+[0-9-_a-zA-Z]\w+)/", $str, $tagall);	
		preg_match_all("/#[^\s]*/i", $str, $tag);	
		foreach (array_unique($tag[0]) as $v) {
			$v = strtolower($v);
			$q = "INSERT INTO hashtag(hashtag,post) VALUES('$v','$postid')";		
			echo $sth = $PDO->exec($q);
		}
	}	

	function Vimeo($string) {	
		//extract the ID
		preg_match('/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',$string,$matches);
		//the ID of the Vimeo URL: 71673549 
		$id = $matches[2];	
		//set a custom width and height
		$width = '100%';
		$height = '';		
		return '<iframe src="http://player.vimeo.com/video/'.$id.'?title=1&byline=1&portrait=0&badge=1&color=ff0000" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	}

	function resizeImage($file = 'image.png', $maxwidth = 1366){
	  error_reporting(0);  
	  $image_info = getimagesize($file);
	  $image_width = $image_info[0];
	  $image_height = $image_info[1];
	  $ratio = $image_width / $maxwidth;
	  $info = getimagesize($file);
	  if ($image_width > $maxwidth) {
	    // GoGoGo
	    $newwidth = $maxwidth;
	    $newheight = (int)($image_height / $ratio);
	    if ($info['mime'] == 'image/jpeg') {    
	      $thumb = imagecreatetruecolor($newwidth, $newheight);
	      $source = imagecreatefromjpeg($file);
	      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
	      echo imagejpeg($thumb,$file,90);
	    }   
	     if ($info['mime'] == 'image/jpg') {    
	      $thumb = imagecreatetruecolor($newwidth, $newheight);
	      $source = imagecreatefromjpeg($file);
	      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
	      echo imagejpeg($thumb,$file,90);
	    }   
	    if ($info['mime'] == 'image/png') {
	      $im = imagecreatefrompng($file);
	      $im_dest = imagecreatetruecolor($newwidth, $newheight);
	      imagealphablending($im_dest, false);
	      imagecopyresampled($im_dest, $im, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
	      imagesavealpha($im_dest, true);
	      imagepng($im_dest, $file, 9);
	    }
	    if ($info['mime'] == 'image/gif') {
	      $im = imagecreatefromgif($file);
	      $im_dest = imagecreatetruecolor($newwidth, $newheight);
	      imagealphablending($im_dest, false);
	      imagecopyresampled($im_dest, $im, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
	      imagesavealpha($im_dest, true);
	      imagegif($im_dest, $file);
	    }
	  }
	}	

	function thumb($src, $dest, $desired_width = 500) {
		/* read the source image */
		$source_image = imagecreatefromjpeg($src);
		$width = imagesx($source_image);
		$height = imagesy($source_image);		
		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($desired_width / $width));		
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);		
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);		
		/* create the physical thumbnail image to its destination */
		imagejpeg($virtual_image, $dest);
	}	

	function convertImage($originalImage, $outputImage, $quality)
	{
	    $exploded = explode('.',$originalImage);
	    $ext = $exploded[count($exploded) - 1]; 
	    if (preg_match('/jpg|jpeg/i',$ext))
	        $imageTmp=imagecreatefromjpeg($originalImage);
	    else if (preg_match('/png/i',$ext))
	        $imageTmp=imagecreatefrompng($originalImage);
	    else if (preg_match('/gif/i',$ext))
	        $imageTmp=imagecreatefromgif($originalImage);
	    else if (preg_match('/bmp/i',$ext))
	        $imageTmp=imagecreatefrombmp($originalImage);
	    else
	        return 0;
	    // quality is a value from 0 (worst) to 100 (best)
	    imagejpeg($imageTmp, $outputImage, $quality);
	    imagedestroy($imageTmp);
	    return 1;
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

	function replace_url_img($content){
		$urls = "";
		// get all urls images links clear tekst no tags
		preg_match_all("/\b(?:(?:https?|ftp|ftps):\/\/|\s\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$content,$urls);
		foreach ($urls[0] as $url) {
		// file extension
		$ext = pathinfo($url,PATHINFO_EXTENSION);
		if (strpos($url, 'embed') > 0 || strpos($url, 'vimeo') > 0 || strpos($url, 'youtube') > 0 || strpos($url, 'youtu') > 0) {
		   // do nothing embed url embed urls like youtube
		}else if ($ext == 'jpg' || $ext == 'gif' || $ext == 'png' || $ext == 'jpeg') {
		    //$out = preg_replace('#(https?://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<img src="$1.$2" alt="$1.$2" style="color: #09c" />', $url);   
		    //$e = end(explode('/', $url));
		    //$dir = pathinfo($url, PATHINFO_DIRNAME);
		    //$name = pathinfo($url, PATHINFO_BASENAME);
		    //$path = $dir."/".$name;
		    //$a = '<a class="img-out" href="'.$path.'" target="_blank"><img src="'.$path.'" alt="'.$path.'"></a>';
		    //$content = str_replace($path, $a, $content);
		}else {
		    $out = preg_replace('|([\w\d]*)\s?(https?://([\d\w\.-]+\.[\w\.]{2,6})[^\s\]\[\<\>]*/?)|i', '$1 <a href="$2" target="_blank" class="link-out">$0</a>', $url);
		    $content = str_replace($url, $out, $content);
		}
		}
		return $content;
	}

	function closetags ( $html ){
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

	function curl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);	     
		curl_setopt($ch, CURLOPT_HEADER, 0);	     
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);    
		curl_setopt($ch, CURLOPT_COOKIE, 'apiToken=' . $token);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		$output = curl_exec($ch);	    
		curl_close($ch);	    
		return $output;
	}	

	function CurlSendPostJson($url='http://localhost/curl-req.php',$datajson){   
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $datajson);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($datajson)));
		curl_setopt($ch, CURLOPT_COOKIE, 'apiToken=' . $token);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');		
		//curl_setopt($ch,CURLOPT_HEADER, true); //if you want headers
		return $result = curl_exec($ch);
	}		
}


// Create class object
$sun = new Sun();
// dodaj wiadomość i wyslij powiadomienie
echo $sun->AddKontaktMessage("Bax","email@email.com","+48000000000","Hello from kontakt form");

echo "OK";
?>
