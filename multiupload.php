<?php
if (isset($_POST['add'])) {
	echo '<pre>';
	//print_r($_FILES);
	$postid = (int)$_POST['postid'];

	mkdir("../galeria/".$postid);


	foreach ($_FILES['files']['type'] as $key => $value) {
		if(($value == "image/png") || ($value == "image/jpg") || ($value == "image/gif") || ($value == "image/jpeg")){
			//echo $value.$_FILES['files']['name'][$key];
			echo $tmp = $_FILES['files']['tmp_name'][$key];
			echo $name = $_FILES['files']['name'][$key];			
			$temporary = explode(".", $_FILES["files"]["name"][$key]);
			$ext = end($temporary);
			move_uploaded_file($tmp, "../galeria/".$postid."/".md5(microtime()).".".$ext);
		}		
	}
	echo '</pre>';
	echo $postid;
}
?>
<form method="post" action="" enctype="multipart/form-data">
<p class="toptitle"><i class="fa fa-paper-plane"></i> Aktywne news(y) - wyświetlane</p>
<h6><?php  echo $error; ?></h6>

<?php
$userid = $_SESSION['userid'];

$res = mysql_query("SELECT id,title from news WHERE active = 1 AND userid = '$userid' ORDER BY time DESC");
echo '<select name="postid">';
while ($row = mysql_fetch_assoc($res)) {
echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
}
echo '</select>';
?>

<input type="file" name="files[]" multiple>
<input type="submit" value="Dodaj zdjęcia" name="add">
</form>


<?php
/* 
// upload foto profil 11_fxstarusser.ext short version
if (isset($_FILES)) {
  $uploads_dir = 'media/';
  $allowed = array('gif','jpg','jpeg','png');
  foreach ($_FILES["file"]["error"] as $key => $error) {
      if ($error == UPLOAD_ERR_OK) {
          $tmp_name = $_FILES["file"]["tmp_name"][$key];
          $name = $_FILES["file"]["name"][$key];
          $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
          if (in_array($ext, $allowed)) {              
            $name = $id."_fxstaruser".".".$ext;
            // delete old photos
            unlink('media/'.$id."_fxstaruser".".jpg");
            unlink('media/'.$id."_fxstaruser".".jpeg");
            unlink('media/'.$id."_fxstaruser".".gif");
            unlink('media/'.$id."_fxstaruser".".png");

            move_uploaded_file($tmp_name, "$uploads_dir".$name);
          }          
      }else{
        $error = "Dozwolony format plików: jpg, jpeg, png, gif";
      }
  }
}


// show images from folder if exist
function isUser($id){
  $p = 'media/fxstaruser.png';

  if (file_exists('media/'.$id.'_fxstaruser.gif')) {
    $p = 'media/'.$id.'_fxstaruser.gif'; 
  }
  if (file_exists('media/'.$id.'_fxstaruser.png')) {
    $p = 'media/'.$id.'_fxstaruser.png'; 
  }
  if (file_exists('media/'.$id.'_fxstaruser.jpeg')) {
    $p = 'media/'.$id.'_fxstaruser.jpeg';  
  }
  if (file_exists('media/'.$id.'_fxstaruser.jpg')) {
    $p = 'media/'.$id.'_fxstaruser.jpg'; 
  } 
  return $p;
}

*/
?>
