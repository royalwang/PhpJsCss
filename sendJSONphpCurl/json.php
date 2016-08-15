<?php
// server file
// get data from client to string
echo "ok ". serialize(file_get_contents('php://input'));
// to array
echo "ok ". serialize(json_decode(file_get_contents('php://input'), true));  // true in json_decode convert to array
?>
