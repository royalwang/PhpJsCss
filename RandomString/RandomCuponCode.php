<?php
// generate random cupon code with specified width
function RandomCode($len = 5){
	$len = $len * -1;
	return substr(str_shuffle("MNOPQRSTUVWXYZ@1234567890!ABCDEFGHIJKL"), $len);
}
?>
