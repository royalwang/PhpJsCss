<?php
// HEADERS
$auth = getallheaders();

$token = end(explode(' ',$auth['Authorization'])); 

// Get POST data
$arr = $_POST;

// Get token
$arr['token'] = $token;

// Show
print_r($arr);
?>
