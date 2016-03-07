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
