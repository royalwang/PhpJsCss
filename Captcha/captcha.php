<!-- register  file
Use like (in signup file): 
create jpg file 60x30 px for captcha picture:
cap_bg.jpg
captcha code located in $_SESSION['cap_code']
-->
<img src="captcha.php"/></p>
<input name="captchacode" maxlength="20" placeholder="captcha code" style="margin: 5px;"/>

<!-- captcha.php file -->
<?php
/* captcha.php */
session_start();
$ranStr = md5(microtime());
$ranStr = substr($ranStr, 0, 6);
$_SESSION['cap_code'] = $ranStr;
$img = "cap_bg.jpg";
$newImage = imagecreatefromjpeg($img);
$txtColor = imagecolorallocate($newImage, 0, 0, 0);
imagestring($newImage, 5, 5, 5, $ranStr, $txtColor);
header("Content-type: image/jpeg");
imagejpeg($newImage);
?>
