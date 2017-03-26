<?php
$url = 'http://localhost/forex/z/curl-req.php';
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
?>

<?php
$url = 'http://localhost/forex/z/curl-req.php';
$data = array("name" => "Heniek", "age" => "125", "rozmiar" => "M");  
// Send post data array
echo CurlSendPost($url,$data);
function CurlSendPost($url='http://localhost/forex/z/curl-req.php',$data){   	
	$curl = curl_init();
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_USERAGENT => 'FxStarBrowser',
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => $data
	));
	// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/html; charset=utf-8'));
	// curl_setopt($ch,CURLOPT_HEADER, true); //if you want headers
	$res = curl_exec($curl);
	curl_close($curl);
	return $res;
}
?>



<?php
$url = 'http://localhost/forex/z/curl-req.php?name=Heniek&age=100000';
// Curl get method
echo CurlSendGet($url);
function CurlSendGet($url ='http://localhost/forex/z/curl-req.php?name=Heniek&age=100000'){
	$curl = curl_init();	
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_USERAGENT => 'FxStarBrowser'
	));	
	// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/html; charset=utf-8'));
	// curl_setopt($ch,CURLOPT_HEADER, true); //if you want headers
	$res = curl_exec($curl);	
	curl_close($curl);
	return $res;
}
?>


<?php
// SEND CURL POST DATA ARRAY
 $jsonData = array(
    'user' => 'Username',
    'pass' => 'Password'
); 
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
//API Url
$url = 'http://localhost/forex/z/curl-req.php';
 //Initiate cURL.
$ch = curl_init($url);
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1); 
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded); 
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  
//Execute the request
$result = curl_exec($ch);
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
