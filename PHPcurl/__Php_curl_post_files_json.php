<?php
// Send POST request with files
$file1 = realpath('ads/ads0.jpg');
$file2 = realpath('ads/ads1.jpg');
// Single file
// $data = array('name' => 'Alexia', 'address' => 'Usa', 'age' => 21, 'file' => '@'.$file1);
// Multiple files
$data = array('name' => 'Alexia', 'address' => 'Usa', 'age' => 21, 'file[0]' => '@'.$file1, 'file[1]' => '@'.$file2);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost/_curl-post.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false); // !!!! required as of PHP 5.6.0 for files !!!
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-GB; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // 1, 2
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
$res1 = curl_exec($ch);

// Send json POST
$data = array("name" => "Markos", "age" => "21");
$data_string = json_encode($data);

$ch = curl_init('http://localhost/_curl-post.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-GB; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // 1, 2
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
$res2 = curl_exec($ch);

// GET request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.example.com?q=jabadoo");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res3 = curl_exec($ch);

echo "<pre>";
echo $res1;
echo $res2;
echo $res3;
