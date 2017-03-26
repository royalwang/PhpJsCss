<?php
// curl-req.php
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
