<?php
function correct_encoding($text) {
    $current_encoding = mb_detect_encoding($text, 'auto');
    $text = iconv($current_encoding, 'UTF-8', $text);
    return $text;
}
// kodowanie utf-8 z db plik php
ini_set('default_charset', 'UTF-8');
mysql_query("SET NAMES 'utf8'");

// utf-8
$tocomasz = "Zażółć gęślą jaźń Kórka wodna śąćęążźćłęó ";
$tocochcesz = iconv('WINDOWS-1250', 'UTF-8', $tocomasz);

echo "Zapisuję do pliku w formacie Windows1250";
file_put_contents('windows1250.txt', $tocochcesz);
?>
