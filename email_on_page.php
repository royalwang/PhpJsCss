<?php
error_reporting('E_ALL');

// emaile po jednym w linii
$in = 'email.txt';
// plik 2
$out = 'emailall.txt';
file_put_contents($out, '');

// strona www
$html = file_get_contents('https://fxstar.eu');

// otwórz plik
$handle = @fopen($in, "r");
if ($handle) {
   // pobieraj linijka po linijce
    while (($buffer = fgets($handle, 4096)) !== false) {    	
        //jeżeli adres email poprawny
	if (!filter_var(trim($buffer), FILTER_VALIDATE_EMAIL) === false) {
		// wyświetl email i do nowej linj w przeglądarce
		if (strpos($html, trim($buffer)) !== false) {
		    echo 'Istnieje na stronie ' . $buffer."<br>";
		    //dodaj do pliku emailall.txt
		    file_put_contents($out, $buffer, FILE_APPEND | LOCK_EX);
		}
        }        
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}
?>
