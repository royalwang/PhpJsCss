<?php
// Send public message with image
$dir = dirname(__FILE__);
$data = array("user" => "mindbreaker", "pass" => "pass", "msg" => "Send image", "img[]" => "@".$dir."\curl.png");  

echo CurlSendPostFiles($data);

function CurlSendPostFiles($data, $url='http://qflash.pl/api/sendmessagewall.php'){   	
	$header = array('Content-Type: multipart/form-data');	
	// $token = 'NfxoS9oGjA6MiArPtwg4aR3Cp4ygAbNA2uv6Gg4m';	 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	// curl_setopt($ch, CURLOPT_COOKIE, 'apiToken=' . $token);
	$res = curl_exec($ch);
	curl_close($ch);
	return $res;
}
?>
