<?php
function curl_get_contents($url) {
// Initiate the curl session
$ch = curl_init();
// Set the URL
curl_setopt($ch, CURLOPT_URL, $url);
// Removes the headers from the output
curl_setopt($ch, CURLOPT_HEADER, 0);
// Return the output instead of displaying it directly
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//Set the content type to 'Content-Type: application/json' or 'Content-Type: text/html; charset=utf-8'
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  
// Execute the curl session
$output = curl_exec($ch);
// Close the curl session
curl_close($ch);
// Return the output as a variable
return $output;
}

// use 
echo $output = curl_get_contents('http://fxstar.eu/');
?>
<?php
// SEND CURL POST DATA
 $jsonData = array(
    'username' => 'MyUsername',
    'password' => 'MyPassword'
); 
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
//API Url
$url = 'http://example.com/api/JSON/create';
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
