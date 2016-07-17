<?php
// resize file if width > 1366 px

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

?>
