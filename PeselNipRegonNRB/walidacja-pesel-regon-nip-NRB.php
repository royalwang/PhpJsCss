<?php
// Walidacja numeru rachunku bankowego, pesel, nip, regon

function pesel($PESEL,$sex="?") {
 if ($PESEL[9] % 2 and $sex=="K") return false;
 else if (!$PESEL[9] % 2 and $sex=="M") return false;
 $w=array(1,3,7,9);
 for ($i=0;$i<=9;$i++)
   $wk=($wk+$PESEL[$i]*$w[$i % 4]) % 10;
 $k = (10-$wk) % 10;
 if ($PESEL[10]==$k) return true;
 else return false;
}

function vpesel($PESEL,$sex="?") {
 if ($PESEL[9] % 2 and $sex=="K") return false;
 else if (!($PESEL[9] % 2) and $sex=="M") return false;
 $w=array(1,3,7,9);
 for ($i=0;$i<=9;$i++)
   $wk=($wk+$PESEL[$i]*$w[$i % 4]) % 10;
 $k = (10-$wk) % 10;
 if ($PESEL[10]==$k) return true;
 else return false;
}

function nip($str)
{
if (strlen($str) != 10)
{
return 0;
}
$arrSteps = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
$intSum=0;
for ($i = 0; $i < 9; $i++)
{
$intSum += $arrSteps[$i] * $str[$i];
}
$int = $intSum % 11;

$intControlNr=($int == 10)?0:$int;
if ($intControlNr == $str[9])
{
return 1;
}
return 0;
}

function nip1($nip) {
if ($nip == '') return false;
$chr_to_replace = array('-', ' '); // get rid of these characters
$nip = str_replace($chr_to_replace, '', $nip);
if (! is_numeric($nip)) return false;
$weights = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
$digits = str_split($nip);
$digits_length = count($digits);
for ($i = 1; $i < $digits_length; $i++) {
if ($digits[0] != $digits[$i]) break;
if ($digits[0] == $digits[$i] && $i == $digits_length - 1) return false;
}//end for
$in_control_number = intval(array_pop($digits));
$sum = 0;
$weights_length = count($weights);
for ($i = 0; $i < $weights_length; $i++) {
$sum += $weights[$i] * intval($digits[$i]);
}//end for
$modulo = $sum % 11;
$control_number = ($modulo == 10) ? 0 : $modulo;
return $in_control_number == $control_number;
}

function regon($str)
{
if (strlen($str) != 9)
{
return false;
}

$arrSteps = array(8, 9, 2, 3, 4, 5, 6, 7);
$intSum=0;
for ($i = 0; $i < 8; $i++)
{
$intSum += $arrSteps[$i] * $str[$i];
}
$int = $intSum % 11;
$intControlNr=($int == 10)?0:$int;
if ($intControlNr == $str[8])
{
return true;
}
return false;
}

function nrb($nrb) {
  if (strlen($nrb)!=26)
   return 0;
  $W = array(1,10,3,30,9,90,27,76,81,34,49,5,50,15,53,45,62,38,89,17,
                   73,51,25,56,75,71,31,19,93,57);

  $nrb .= "2521";
  $nrb = substr($nrb,2).substr($nrb,0,2);
  $Z =0;
  for ($i=0;$i<30;$i++)
    $Z += $nrb[29-$i] * $W[$i];
  if ($Z % 97 == 1)
    return 1;
  else
    return 0;
}// nrb
?>
