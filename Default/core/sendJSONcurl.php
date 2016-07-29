<?php
error_reporting(0);
header('Content-Type: text/html;charset=utf-8;');

function imageTobase64($path = '../img/2m.jpg'){
    if (file_exists($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return $base64img = 'data:image/'.$type.';base64,' . base64_encode($data);  
        //return $base64img = base64_encode($data); 
    }else{
        return '';
    }
}

$base64img = imageTobase64('img/app1.jpg');

//The JSON data.
// typ: 1 - success, 2 - warning, 3- error, 4-alert 
$msg = array(
    'appkey' => 'Username',
    'pass' => 'Password',
    'msg' => 'Wiadomość tekstowa',
    'img' => $base64img,
    'typ' => '1'
);


function sendJSON($jsonData, $url = 'localhost/notex/api/api-json.php'){
$options = array(
    CURLOPT_RETURNTRANSFER => true,   // return web page
    CURLOPT_HEADER         => false,  // don't return headers
    CURLOPT_FOLLOWLOCATION => true,   // follow redirects
    CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
    CURLOPT_ENCODING       => "",     // handle compressed
    CURLOPT_USERAGENT      => "notex-client", // name of client
    CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
    CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
    CURLOPT_TIMEOUT        => 120,    // time-out on response
); 	
$ch = curl_init($url);
$jsonDataEncoded = json_encode($jsonData);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // force ssl
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // if hostname == CN cert field
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8;', 'Content-Length: ' . strlen($jsonDataEncoded))); 
curl_setopt_array($ch, $options);

$result = curl_exec($ch);

if(curl_errno($ch)){echo 'Curl error: ' . curl_error($ch);}

curl_close($ch);
return $result;
}

echo $res = sendJson($msg);
$j = json_decode($res, true);
echo "error " . $j['error'];
//print_r($j);

// get json file from get request
// $json = file_get_contents('http://somesite.com/getjson.php');
// in javascript
// // Parse result to JavaScript object
//  var data=JSON.parse(XMLHttp.responseText);
?>
