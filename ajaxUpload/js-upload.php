<?php
echo serialize($_FILES);
?>

<?php
/*
//multiple files
foreach ($_FILES["file"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["file"]["tmp_name"][$key];
        $name = $_FILES["file"]["name"][$key];
        move_uploaded_file($tmp_name, $_SESSION['path']."/$name");
    }
}
*/
?>

<?php
/* 
// upload file
$uploads_dir = '/uploads';
foreach ($_FILES["file"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["file"]["tmp_name"][$key];
        $name = $_FILES["file"]["name"][$key];
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
    }
}
*/
?>

