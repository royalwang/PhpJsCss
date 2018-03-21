<?php 
// from form-data
print_r($_POST);
print_r($_FILES);
// from json
echo file_get_contents('php://input');
?>