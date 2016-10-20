<?php
session_start();
$ranStr = md5(microtime());
$ranStr = substr($ranStr, 0, 6);
$_SESSION['cap_code'] = $ranStr;
$img = "cap_bg".rand(0,3).".jpg";
$newImage = imagecreatefromjpeg($img);
$txtColor = imagecolorallocate($newImage, 0, 0, 0);
imagestring($newImage, 5, 5, 5, $ranStr, $txtColor);
header("Content-type: image/jpeg");
imagejpeg($newImage);

// How to use
// <p class="label">Przepisz tekst z obrazka <img src="captcha.php"/></p>
// <input id="cat1" name="captchacode" class="email" maxlength="20" placeholder="Przepisz tekst z obrazka" style="margin: 5px;"/>
?>


