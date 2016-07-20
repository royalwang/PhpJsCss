<?php
function hashtag($str = '', $postid ,$PDO = 'PDO connection', $pl = '1'){		
  if($pl == '1'){
	  // hashtag z polskimi literami
	  preg_match_all("/#[^\s]*/i", $str, $tagall);
	}else{
    // hashtag bez polskich liter
	  preg_match_all("/#(\w+[0-9-_a-zA-Z]\w+)/", $str, $tagall);	
	}
	
	// zamień hastagi na linki
	foreach (array_unique($tagall[0]) as $v) {
	  $out .= str_replace($v, '<a class="hashtag" href="//hashtag.php?hash='.$v.'" >'.$v.'</a>', $str);
	}
	echo $out;
	
	// zapisz hashtagi do bazy danych
	foreach (array_unique($tagall[0]) as $v) {
		$q = "INSERT INTO hashtag(hashtag,post) VALUES('$v','$postid')";		
		echo $sth = $PDO->exec($q);
	}
}
?>
