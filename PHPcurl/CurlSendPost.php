<?php
$url = 'http://localhost/forex/z/curl-req.php';

$data = array("name" => "Heniek", "age" => "125", "rozmiar" => "M");  
//$data = json_encode($data);

// Send post data
echo CurlSendPost($url,$data);

function CurlSendPost($url='http://localhost/forex/z/curl-req.php',$data){   	
	$curl = curl_init();
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_SSL_VERIFYPEER => false,
	    CURLOPT_USERAGENT => 'FxStarBrowser',
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => $data
	));
	$res = curl_exec($curl);
	curl_close($curl);
	return $res;
}
?>

<?php
// curl-req.php
// GET JSON CONTENT FROM CURL
$jsonStr = file_get_contents("php://input"); //read the HTTP body.
//echo $json = json_decode($jsonStr);
if (!empty($jsonStr)) {
	echo $jsonStr;
}

// POST DATA FROM CURL
if (empty($jsonStr)) {
	echo serialize($_POST);
}

// GET DATA FROM CURL
if (!empty($_GET)) {
	echo serialize($_GET);
}
?>
