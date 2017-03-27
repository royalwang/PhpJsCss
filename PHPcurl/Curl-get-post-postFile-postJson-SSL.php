<?php

$url ='https://qflash-fxstar.rhcloud.com';

// GET REQUEST
echo CurlSendGet();

function CurlSendGet($url ='https://fxstar.eu'){
	$curl = curl_init();	
	curl_setopt_array($curl, array(
		CURLOPT_HEADER => 0,
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_BINARYTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_SSL_VERIFYPEER => 0,
	    CURLOPT_FOLLOWLOCATION => 1,
	    CURLOPT_CONNECTTIMEOUT => 0,
	    CURLOPT_TIMEOUT => 60,
	    CURLOPT_COOKIE, 'apiToken=A9',
	    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13'
	));	
	$res = curl_exec($curl);	
	curl_close($curl);
	return $res;
}


// POST REQUEST DATA AND FILES
$dir = dirname(__FILE__);
$data = array("name" => "Heniek", "age" => "125", "rozmiar" => "M", 'file' => '@' . $dir.'\filename.png' ); // file must exists  
$data = array("name" => "Heniek", "age" => "125", "rozmiar" => "M", 'file[]' => '@' . $dir.'\five.jpg' );  // file must exists
// $data = array("name" => "Heniek", "age" => "125", "rozmiar" => "M", 'file[]' => '@' . $_FILES['file']['tmp_name'][0]); 

// Send post data array
echo CurlSendPost($data, $url);

function CurlSendPost($data, $url='https://fxstar.eu'){   	
	$token = "ID888";
	$header = array('Content-Type: multipart/form-data');
	$curl = curl_init();	
	curl_setopt_array($curl, array(
		CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => $data,
		CURLOPT_HEADER => 0,
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_BINARYTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_SSL_VERIFYPEER => 0,
	    CURLOPT_FOLLOWLOCATION => 1,
	    CURLOPT_CONNECTTIMEOUT => 0,
	    CURLOPT_TIMEOUT => 60,
	    CURLOPT_HTTPHEADER => $header,
	    CURLOPT_COOKIE, 'apiToken=' . $token,
	    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13'
	));
	$res = curl_exec($curl);
	curl_close($curl);
	return $res;
}


// POST REQUEST JSON FORMAT
$data = array("name" => "Heniek", "age" => "125", "rozmiar" => "M");   
$data = json_encode($data);                                                                                   

// Send post data Json format
echo CurlSendPostJson($url,$data);

// send curl post                                        
function CurlSendPostJson($url='http://localhost/forex/z/curl-req.php',$datajson){   
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $datajson);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($datajson)));
	//curl_setopt($ch,CURLOPT_HEADER, true); //if you want headers
	return $result = curl_exec($ch);
}

// save request to file
// $fp = fopen("example_homepage.txt", "w");
// curl_setopt($ch, CURLOPT_FILE, $fp);
?>

<?php
// save belove to: curl-req.php
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
