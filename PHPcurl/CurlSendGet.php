<?php
$url = 'http://localhost/forex/z/curl-req.php';

echo CurlSendPost($url);

function CurlSendGet($url ='http://localhost/forex/z/curl-req.php?item1=value&item2=value2'){
	$curl = curl_init();	
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_SSL_VERIFYPEER => false,
	    CURLOPT_USERAGENT => 'FxStarBrowser'
	));	
	$res = curl_exec($curl);	
	curl_close($curl);
	return $res;
}
?>
