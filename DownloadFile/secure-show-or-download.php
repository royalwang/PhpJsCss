<?php
// Secure download with session variable
// session_start();
// if(empty($_SESSION['allow'])){
//   echo "Download not allowed!";
//   die();
// }

function showImage($name){
	$file = stripslashes(htmlentities($name,ENT_QUOTES));
	$path  = 'files/'.$file;
	$mime = mime_content_type($path);
    $types = [ 'gif'=> 'image/gif', 'png'=> 'image/png', 'jpeg'=> 'image/jpeg', 'jpg'=> 'image/jpeg', 'jpg'=> 'text/plain', 'pdf' => 'application/pdf'];
    // if allowed type
    if(in_array($mime, $types)){	    
        if(file_exists($path)){
            header('Content-type: '.$mime);
            header("Content-Length: " . filesize($path));
            //echo file_get_contents($path);           
            readfile($path);
        }	    
	}
}

function download($file){
	$file = stripslashes(htmlentities($file,ENT_QUOTES));
	echo $file  = 'files/'.$file;
	if (file_exists($file)) {		
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="'.basename($file).'"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    readfile($file);
	    exit;
	}	
}

// Show image
// download.php?f=file.jpg&show=1

// download file
// download.php?f=file.zip

if (!empty($_GET['show'])){
	showImage($_GET['f']);
}else{
	download($_GET['f']);
}
?>
