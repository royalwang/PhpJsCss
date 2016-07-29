if(isset($_FILES['file']))
{
$allowed= array('jpg','jpeg','png','gif');
$type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if (in_array(strtolower($type), $allowed) && $_FILES['file']['size'] < 20001000) {
  $data = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
  $base64 = 'data:image/' . $type . ';base64,' . $data;
}
} // $_FILES

// IMPORTANT !!! save in database field -> BLOB !!!!!
// and display
// <img src="'.$base64.'">
