<?php
function correct_encoding($text) {
    $current_encoding = mb_detect_encoding($text, 'auto');
    $text = iconv($current_encoding, 'UTF-8', $text);
    return $text;
}
ini_set('default_charset', 'UTF-8');
mysql_query("SET NAMES 'utf8'");
$tocochcesz = iconv('WINDOWS-1250', 'UTF-8', $tocomasz);
?>
