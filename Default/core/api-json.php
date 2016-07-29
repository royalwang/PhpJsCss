<?php
header('Content-Type: application/json;charset=utf-8;');
$noerror = array(
    'error' => '0',
    'msg' => 'ERR_OK'    
);
$error = array(
    'error' => '1',
    'msg' => 'ERR_KEY_PASSWORD_ALLOWEDIP'    
);
$errorfile = array(
    'error' => '1',
    'msg' => 'ERR_FILE_MAX_2MB'    
);
$errormime = array(
    'error' => '1',
    'msg' => 'ERR_FILE_MIME_IMAGE'    
);
$errortyp= array(
    'error' => '1',
    'msg' => 'ERR_TYPE'    
);

$msg = json_decode(file_get_contents('php://input'), true);  // true in json_decode convert to array

$keyhash = htmlentities($msg['appkey'], ENT_QUOTES, 'utf-8');
$pass = md5($msg['pass']); 
$txt = htmlentities($msg['msg'], ENT_QUOTES, 'utf-8');
$img = htmlentities($msg['img'], ENT_QUOTES, 'utf-8');
$typ = (int)$msg['typ']; 

// if image correct
if (!empty($img)) {
	$filesize = (int)(strlen($img) * 3 / 4);
	$imagemime = getimagesizefromstring(file_get_contents($img));

	$imagemime['mime'] = strtolower($imagemime['mime']);
	if ($imagemime['mime'] != 'image/png' && $imagemime['mime'] != 'image/jpg' && $imagemime['mime'] != 'image/gif' && $imagemime['mime'] != 'image/jpeg') {
		echo json_encode($errormime);
		die();
	}
	// if file biger than 3MB
	if ($filesize > 2001000) {
		echo json_encode($errorfile);
		die();
	}
}

//echo json_encode($error);
// get json string
//echo "ok ". serialize(file_get_contents('php://input'));
// to object
// echo serialize(json_decode(file_get_contents('php://input'), true));  // true in json_decode convert to array
?>
