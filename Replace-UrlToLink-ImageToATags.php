<?php
// php zamiana adresów url na linki i url obrazków na tagi preg_replace, preg-match
$content = 'Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. 
            Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. 
            Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text.
            https://www.fxstar.eu/img/a1.jpg http://www.fxstar.eu/img/a1.jpg https://www.fxstar.eu/img/a1.txt http://www.fxstar.eu/img/a1.txt
            <iframe width="" height="" src="https://www.youtube.com/embed/TzynBXNP5pA" frameborder="0" allowfullscreen style="max-width: 100%; margin: 5px; float: left;"></iframe>
            długi text. Super długi text. Super długi http://www.fxstar.eu/img/a2.jpg hello@fxstar.eu
            text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. Super długi text. 
            ';
              
              
              
function replace_url_img($content){
  $urls = "";
  // get all urls images links clear tekst no tags
  preg_match_all("/\b(?:(?:https?|ftp|ftps):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$content,$urls);
  foreach ($urls[0] as $url) {
    // file extension
    $ext = pathinfo($url,PATHINFO_EXTENSION);
    if (strpos($url, 'embed') > 0) {
       // do nothing embed url embed urls like youtube
    }else if ($ext == 'jpg' || $ext == 'gif' || $ext == 'png' || $ext == 'jpeg') {
        $out = preg_replace('#(https?://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<img src="$1.$2" alt="$1.$2" style="color: #09c" />', $url);
        $content = str_replace($url, $out, $content);
    }else {
        $out = preg_replace('|([\w\d]*)\s?(https?://([\d\w\.-]+\.[\w\.]{2,6})[^\s\]\[\<\>]*/?)|i', '$1 <a href="$2" style="color: #09c">$3</a>', $url);
        $content = str_replace($url, $out, $content);
    }
  }
  return $content;
}

// or
function replace_url_img($content){
  $urls = "";
  // get all urls images links clear tekst no tags
  preg_match_all("/\b(?:(?:https?|ftp|ftps):\/\/|\s\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$content,$urls);
  foreach ($urls[0] as $url) {
    // file extension
    $ext = pathinfo($url,PATHINFO_EXTENSION);
    if (strpos($url, 'embed') > 0 || strpos($url, 'vimeo') > 0 || strpos($url, 'youtube') > 0) {
       // do nothing embed url embed urls like youtube
    }else if ($ext == 'jpg' || $ext == 'gif' || $ext == 'png' || $ext == 'jpeg') {
        //$out = preg_replace('#(https?://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<img src="$1.$2" alt="$1.$2" style="color: #09c" />', $url);   
        //$e = end(explode('/', $url));
        $dir = pathinfo($url, PATHINFO_DIRNAME);
        $name = pathinfo($url, PATHINFO_BASENAME);
        $path = $dir."/".$name;
        $a = '<img src="'.$path.'" alt="'.$path.'" style="color: #09c">';
        $content = str_replace($path, $a, $content);
    }else {
        $out = preg_replace('|([\w\d]*)\s?(https?://([\d\w\.-]+\.[\w\.]{2,6})[^\s\]\[\<\>]*/?)|i', '$1 <a href="$2" style="color: #09c">$3</a>', $url);
        $content = str_replace($url, $out, $content);
    }
  }
  return $content;
}

// use it
echo replace_url_img($content);


// img to a tag http and https
// $content = preg_replace('#(https?://[^\s]+(?=\.(jpe?g|png|gif)))(\.(jpe?g|png|gif))#i', '<img src="$1.$2" alt="$1.$2" style="color: #09c" />', $content);

// to links http and https urls
// $content = preg_replace('|([\w\d]*)\s?(https?://([\d\w\.-]+\.[\w\.]{2,6})[^\s\]\[\<\>]*/?)|i', '$1 <a href="$2" style="color: #09c">$3</a>', $content);

?>
