<?php
/* All rights reserved fxstar.eu */
error_reporting('E_ALL');
ini_set("default_charset", "UTF-8");
ini_set("date.timezone", "Europe/Warsaw");

//ini_set("display_errors", 1);
//mb_internal_encoding('UTF-8');
//mb_http_output('UTF-8');
//iconv_set_encoding("internal_encoding", "UTF-8");
//iconv_set_encoding("output_encoding", "UTF-8");

// random password
function randomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


// PDO
require('core/pdo.php');

// GET POST DATA
$err = 0;
$tmp_pass = randomPassword(10);

if (isset($_POST['add'])) {
$e = htmlentities($_POST['email'], ENT_QUOTES, 'utf-8');
$p = md5($tmp_pass);

if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
	$error = "Podaj poprawny adres email";
	$err = 1;
}

// INSERT INTO user(user) VALUES (N'శ్రీనివాస్ తామాడా'), (N'新概念英语第');
try { 
//CONNECT
$db = Conn();

	if ($err == 0) {		
		$res = $db->exec("UPDATE user SET pass = '$p' WHERE email = '$e'");
		if(mail($e, "Zmiana hasła ".date('Y-m-d H:i:s', time()), "Witaj! Twoje nowe hasło: " + $tmp_pass)){
			$error = "Hasło zostało wysłane na podany adres email";
		}else{
			$error = "Coś poszło nie tak. Spróbuj ponownie.";
		}
	}
} catch (PDOException $e) {
    if ($e->getCode() == '2A000')
        echo "Syntax Error: ".$e->getMessage();
} 

}

?>

<?php require('header.php'); ?>

<div class="main">
<form method="post" action="">
<label>Resetuj hasło</label>
<div style="height: auto; width: 100%; float: left; color: #f23; padding-left: 10px; padding: 5px;"><?php echo $error; ?></div>
	<input type="text" name="email" placeholder="Podaj adres e-mail" autocomplete="false">
	<input type="submit" name="add" value="Wyślij nowe hasło" class="btn animated flipInX">
	<p><a href="login.php" class="link">Masz już konto? Zaloguj się!</a></p>
</form>
</div>


</body>
</html>
