<?php
// Znaki utf8
$utf8 = "Zażółć gęślą jaźń Kórka wodna śąćęążźćłęó ";

// zamiana na Windows-1250
$win = iconv("UTF-8","Windows-1250",$utf8);

// Wyświetl poprawnie w przeglądarce
header("Content-Type: text/html; charset=windows-1250");
echo $win;

echo "Zapisuję do pliku w formacie Windows1250";
file_put_contents('windows1250.txt', $win);

/*
// wyświetl w różnym kodowaniu testy
$tab = array("UTF-8", "ASCII", "Windows-1250", "ISO-8859-15", "ISO-8859-1", "ISO-8859-6", "CP1256");
$chain = "";
foreach ($tab as $i)
    {
        foreach ($tab as $j)
        {
            $chain .= " $i$j ".iconv($i, $j, $my_string);
        }
    }

echo $chain;

*/
?> 
