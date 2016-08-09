<?php
/**
* image resize function
* @param  $file - file name to resize
* @param  $maxwidth - new image width
*/

function resizeImage($file = 'image.png', $maxwidth = 1366){
  error_reporting(0);  
  $image_info = getimagesize($file);
  $image_width = $image_info[0];
  $image_height = $image_info[1];
  $ratio = $image_width / $maxwidth;
  $info = getimagesize($file);

  if ($image_width > $maxwidth) {
    // GoGoGo
    $newwidth = $maxwidth;
    $newheight = (int)($image_height / $ratio);
      
    if ($info['mime'] == 'image/jpg') {    
      $thumb = imagecreatetruecolor($newwidth, $newheight);
      $source = imagecreatefrompng($file);
      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
      imagejpeg($thumb,$file,90);
    }
    
    if ($info['mime'] == 'image/png') {
      echo "PNG";
      $im = imagecreatefrompng($file);
      $im_dest = imagecreatetruecolor($newwidth, $newheight);
      imagealphablending($im_dest, false);
      imagecopyresampled($im_dest, $im, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
      imagesavealpha($im_dest, true);
      imagepng($im_dest, $file, 9);
    }

    if ($info['mime'] == 'image/gif') {
      $im = imagecreatefromgif($file);
      $im_dest = imagecreatetruecolor($newwidth, $newheight);
      imagealphablending($im_dest, false);
      imagecopyresampled($im_dest, $im, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
      imagesavealpha($im_dest, true);
      imagegif($im_dest, $file);
    }
  }
}

// how resize image
// resizeImage('D:\tmp\11.png', 1366);
// or local folder
// resizeImage('tmp/11.png', 1366);

?>

