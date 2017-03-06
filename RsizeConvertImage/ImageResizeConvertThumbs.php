<?php
function convertImage($originalImage, $outputImage, $quality)
{
    // jpg, png, gif or bmp?
    $exploded = explode('.',$originalImage);
    $ext = $exploded[count($exploded) - 1]; 
    if (preg_match('/jpg|jpeg/i',$ext))
        $imageTmp=imagecreatefromjpeg($originalImage);
    else if (preg_match('/png/i',$ext))
        $imageTmp=imagecreatefrompng($originalImage);
    else if (preg_match('/gif/i',$ext))
        $imageTmp=imagecreatefromgif($originalImage);
    else if (preg_match('/bmp/i',$ext))
        $imageTmp=imagecreatefrombmp($originalImage);
    else
        return 0;
    // quality is a value from 0 (worst) to 100 (best)
    imagejpeg($imageTmp, $outputImage, $quality);
    imagedestroy($imageTmp);
    return 1;
}
?>

<?php
// create thumbnail
function thumb($src, $dest, $desired_width = 400) {
    /* read the source image */
    $source_image = imagecreatefromjpeg($src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);
    
    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));
    
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    
    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
    
    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $dest);
}
?>


<?php
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
    if ($info['mime'] == 'image/jpeg') {    
      $thumb = imagecreatetruecolor($newwidth, $newheight);
      $source = imagecreatefromjpeg($file);
      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
      echo imagejpeg($thumb,$file,90);
    }   
     if ($info['mime'] == 'image/jpg') {    
      $thumb = imagecreatetruecolor($newwidth, $newheight);
      $source = imagecreatefromjpeg($file);
      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
      echo imagejpeg($thumb,$file,90);
    }   
    if ($info['mime'] == 'image/png') {
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
resizeImage('D:\tmp\11.png', 1366);
// or local folder
resizeImage('tmp/11.png', 1366);
?>

<?php
// resize with aspect ratio
function resizeRatio($file){
  $image_info = getimagesize($file);
  $image_width = $image_info[0];
  $image_height = $image_info[1];
  $ratio = $image_width / 1366;
  if ($image_width > 1366) {
      // Load
      $newwidth = 1366;
      $newheight = (int)($image_height / $ratio);
      $thumb = imagecreatetruecolor($newwidth, $newheight);
      $source = imagecreatefromjpeg($file);
      // Resize
      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $image_width, $image_height);
      // Output
      imagejpeg($thumb,$file,80);
  }
}
?>
