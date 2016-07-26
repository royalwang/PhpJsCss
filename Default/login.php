<?php
/* All rights reserved fxstar.eu */
session_start();
error_reporting('E_ALL');
ini_set("default_charset", "UTF-8");

if ($_SESSION['loged'] == 1) {
  header('Location: index.php');
}

require('core/pdo.php');

if (isset($_POST['add'])) {

$db = Conn();

$_POST['user'] = preg_replace("/[^A-Za-z0-9-_@]/",'', $_POST['user']);
$u = htmlentities($_POST['user'], ENT_QUOTES, 'utf-8');
$p = md5($_POST['pass']);

if (strlen($u) < 2 || strlen($_POST['pass']) < 3) {	
	$error = "Wypełnij wszystkie pola formularza !";
	$err = 1;
}

try { 
if ($err == 0) {	
	$sth = $db->prepare("SELECT * FROM user WHERE user = '$u' AND pass = '$p' AND active = '1'");
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	print_r($rows);
	if ($sth->rowCount() == 1) {
		$error = "Jesteś zalogowany";
		$_SESSION['loged'] = 1;
		$_SESSION['id1'] = $rows[0]['id'];
		$_SESSION['user1'] = $rows[0]['user'];
		$_SESSION['name1'] = $rows[0]['name'];
		$_SESSION['email'] = $rows[0]['email'];
		header('Location: index.php');
	}else{
		$error = "Błędny login lub hasło";
	}
}


} catch (PDOException $e) {
    if ($e->getCode() == '2A000')
        echo "Syntax Error: ".$e->getMessage();
} 

}

require('header.php');
?>
<body>

<form method="post" action="">
<label>Zaloguj się</label>
<div style="height: auto; width: 100%; float: left; color: #f23; padding-left: 10px; padding: 5px;"><?php echo $error; ?></div>
	<input type="text" name="user" placeholder="NazwaUżytkownika" autocomplete="false">		
	<input type="password" name="pass" placeholder="Hasło (min. 8 znaków)" autocomplete="false">	
	<input type="submit" name="add" value="Wejście" class="btn animated flipInX">
	<p><a href="register.php" class="link">Zarejestruj się!</a> <a href="pass.php" class="link-right">Nie pamietasz hasła?</a></p>
</form>

</body>
</html>
