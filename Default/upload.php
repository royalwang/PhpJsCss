<?php
session_start();
error_reporting(0);
require('pdo.php');
$db = Conn();
header('Content-type: text/html; charset=utf-8');

$ip = $_SERVER['REMOTE_ADDR'];
if ($_SESSION['login'] != 1 && $_SESSION['ip'] != $ip) {
	header('Location: index.php');
}

if (!empty($_GET['id'])) {
	$id = (int)$_GET['id'];
	$st = $db->query("UPDATE images SET active = '0' WHERE id = '$id' AND adminid = '0'");	
	$st = $db->query("SELECT name FROM images WHERE adminid = '0' AND id = '$id'");
	$rows = $st->fetchALL(PDO::FETCH_ASSOC);
	unlink($rows[0]['name']);
}

if (isset($_POST['add'])) {	
	$uploads_dir = 'media/images';
		foreach ($_FILES["file"]["error"] as $key => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		    	$ext =  pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION);
		    	if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png' && $ext != 'jpeg' && $ext != 'zip' && $ext != 'pdf' && $ext != 'txt' && $ext != 'doc' && $ext != 'tar') {
						$error = "Tylko pliki: <br> jpg, gif, png, zip, pdf, doc, txt, tar";
				}else{			    		
			        $tmp_name = $_FILES["file"]["tmp_name"][$key];
			        // basename() may prevent filesystem traversal attacks;
			        // further validation/sanitation of the filename may be appropriate
			        $name = basename($_FILES["file"]["name"][$key]);
			        $file = $uploads_dir."/".time().$name;
			        chmod($uploads_dir, 0766);
			        move_uploaded_file($tmp_name, $file);
			        $error = "Plik wysłany";
			        $st = $db->query("INSERT INTO images(name) VALUES('$file')");
					if (file_exists($file)) {
					// resize max width 1366
			        resizeImage($file, 1366);
					}
		    	}
		    }else{
		    	$error = "Coś nie tak.";
		    }
		}				
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Dodaj pliki do szablonów</title>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php require('menu.php'); ?>
<form class="animated swing" id="login" method="POST" action="" enctype="multipart/form-data">
<label>Dodaj zdjęcia, pliki</label>
<p class="error"><?php echo $error; ?></p>
	<input type="file" name="file[]" multiple="true">
	<input type="submit" name="add" value="Dodaj zdjęcie" id="sendbtn">
</form>

<div class="lista" style="background: #fff;">
	<?php
	function pagine($table= 'images', $perpage = 25){
		if(empty($_GET['page'])){$page = 1;}else{$page = (int)$_GET['page'];}
		$pagenext = $page +1;
		$pageprev = $page -1;
		if ($pageprev < 0){$pageprev = 1;}
		$offset = ($page - 1) * $perpage;
		$sql = "SELECT * FROM ".$table." WHERE active = '1' AND adminid = '0' ORDER BY id DESC LIMIT " . $offset . "," . $perpage;
		global $db; // get pdo connection Conn()
		$st = $db->query($sql);
		$row = $st->fetchAll(PDO::FETCH_ASSOC);

		echo '<p class="pagine"><a class="pagelink" href="?page='.$pageprev.'"> Poprzednia</a>';
		echo '<a class="pagelink"> '.$page.' </a>';
		echo '<a class="pagelink" href="?page='.$pagenext.'"> Nastepna</a></p>';
		return $row;
	}

	$rows = pagine();
	//$st = $db->query("SELECT * FROM campaning WHERE adminid = '0' AND active = '1'");
	//$rows = $st->fetchALL(PDO::FETCH_ASSOC);

	echo '<div class="tg-wrap" style="background: #66c666">
	<table id="tg-RsPwC" class="tg">
	  <tr style="background: #eee; color: #444">    <th class="tg1">ID</th>    <th class="tg1">Link (w szablonie z https:// lub http://)</th>  <th class="tg1">Miniaturka</th>  <th class="tg1">Data dodania</th>    <th class="tg1">Ustawienia</th>  </tr>';	
		foreach ($rows as $v) {			
			$host = $_SERVER['HTTP_HOST']."/";
			$link = $v['name'];
			$size = getimagesize($link);
			$size = $size[0].'/'.$size[1].'px';
			$img = '<a href="'.$link.'" target="_blank"><img src="'.$link.'" width="50" height="50"></a> <br>'.$size;
		if (file_exists($link)) {
			  echo '<tr>    <td class="tg1">'.$v['id'].'</td>    <td class="tg1"> '.$host.'login/'.$link.'</td> <td class="tg1" style="text-align: center;">'.$img.'</td>   <td class="tg1">'.$v['time'].'</td>    <td class="tg1">
					<a class="abtn" href="?id='.$v['id'].'" title="Usuń"> <i class="fa fa-trash"></i></a> 
			  </td>  </tr>';
				}		
		}
		echo 	'</table></div>';

	?>
</div>

<div class="lista" style="background: #eee; border: 0px;">
<?php
	//$st = $db->query("SELECT * FROM campaning WHERE adminid = '0' AND active = '1'");
	//$rows = $st->fetchALL(PDO::FETCH_ASSOC);
/*
// get from folder
$files = glob("media/*.{jpg,png,gif}", GLOB_BRACE);
usort($files, function($a, $b) {
    return filemtime($a) < filemtime($b);
});
foreach ($files as $key => $value) {
	echo '<a href="'.$value.'" target="_blank" style="padding: 10px; color: #000; margin: 3px; text-decoration: none; overflow: hidden; float: left;"> <img src="'.$value.'" width="70" height="70"><br> Zobacz link</a>';
}
*/
?>
</div>
</body>
</html>
