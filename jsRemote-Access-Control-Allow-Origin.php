<?php
//header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/json;charset=utf-8");
// allow use js from another host
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, *");
error_reporting('E_ALL');

?>
