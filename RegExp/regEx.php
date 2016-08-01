<?php
// www.fxstar.eu

// email address
$email = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

// string with pl
$string = "/^[A-Za-z0-9 .!?-,@#ąęćńźżśółĄĘŚŹŻĆŃÓŁ]+$/";

// username with @username
$username = "/\@[A-Za-z0-9_]+/i";

//hashtags
$hashtag = "/#[^\s]*/i";


// Examples 
// zamien wszystkie username-i na urle (chenge username to URL)
preg_match_all("/\@[A-Za-z0-9_]+/i", $content, $tag);  
foreach (array_unique($tag[0]) as $v) {
  $content = str_replace($v, '<a class="username-color" target="_blank" href="'.substr($v,1).'" >'.$v.'</a>', $content);        
}


$tag = '';
// zamien wszystkie hashtag-i na urle (hashtag to url)
preg_match_all("/#[^\s]*/i", $content, $tag);  
foreach (array_unique($tag[0]) as $v) {
  $content = str_replace($v, '<a class="hashtag-color" target="_blank" href="hashtag.php?tag='.substr($v,1).'" >'.$v.'</a>', $content);        
}

// close open tags in string
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

// change youtube links to url
function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe  width=\"100%\" height=\"200\" src=\"//www.youtube.com/embed/$2\" allowfullscreen frameborder=\"0\"></iframe>",
        $string
    );
}

// url to links
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

?>
