<?php
if ($_FILES['myfile']['error'] !== UPLOAD_ERR_OK) {
   die("Upload failed with error code " . $_FILES['myfile']['error']);
}

$opts = array(
    'http'=>array(
        'method'=>"POST",
        'content'=> file_get_contents($_FILES['myfile']['tmp_name']),
        'header'=>"Content-Type: image/png\r\n"               
    )
);

$context = stream_context_create($opts);
file_get_contents( "http://local.host/catcher.php", false, $context);
?>
