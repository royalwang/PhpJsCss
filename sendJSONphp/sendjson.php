<?php
echo "Send data to server";
//The JSON data.
$jsonData = array(
    'username' => 'MyUsername',
    'password' => 'MyPassword'
);

function sendJson($jsonData){
//API Url
$url = 'localhost/notex/core/json.php';

//Initiate cURL.
$ch = curl_init($url);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8;', 'Content-Length: ' . strlen($jsonDataEncoded))); 

//Execute the request
$result = curl_exec($ch);
return $result;
}

// get json file from get request
// $json = file_get_contents('http://somesite.com/getjson.php');
// in javascript
// // Parse result to JavaScript object
//  var data=JSON.parse(XMLHttp.responseText);

echo sendJson($jsonData);
?>
