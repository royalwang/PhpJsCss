<?php
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

// PDO
function Conn(){
$connection = new PDO('mysql:host=localhost;dbname=NAMEDB;mysql:charset=utf8mb4', 'root', 'toor');
// don't cache query
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// show warning text
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// throw error exception
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// don't colose connecion on script end
$connection->setAttribute(PDO::ATTR_PERSISTENT, false);
// set utf for connection
$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
return $connection;
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


function status($id=0, $uid=0, $status = 1, $db = 0){
	// 1 - powiadomienie polubiono profil, 2 - dodano komentarz, 3 - polubiono post, 4 - wspomniano o tobie
	if ($id != 0 && $uid != 0 && $status >= 0 && $status < 10) {
		$q = "INSERT INTO notify(id,uid,status) VALUES('$id','$uid','$status')";
		$sth = $db->exec($q);
		return 1;
	}
	return 0;
};

function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe  width=\"100%\" height=\"auto\" src=\"//www.youtube.com/embed/$2\" allowfullscreen frameborder=\"0\"></iframe>",
        $string
    );
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

  function closetags ( $html )
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
  
?>
