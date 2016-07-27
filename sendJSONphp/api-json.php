<?php
header('Content-Type: application/json;charset=utf-8;');
$error = array(
    'error' => '0'    
);
//echo json_encode($error);

// get json string
echo "ok ". serialize(file_get_contents('php://input'));
// to object
//echo "ok ". serialize(json_decode(file_get_contents('php://input'), true));  // true in json_decode convert to array
?>
