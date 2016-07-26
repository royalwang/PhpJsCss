<?php
session_start();
/* All rights reserved fxstar.eu */
error_reporting('E_ALL');
ini_set("default_charset", "UTF-8");

if ($_SESSION['loged'] == 1) {
  header('Location: index.php');
}

//ini_set("display_errors", 1);

// PDO
require('core/pdo.php');

if (isset($_POST['add'])) {
// GET POST DATA
$_POST['user'] = preg_replace("/[^A-Za-z0-9-_]/",'', $_POST['user'])."@";
$err = 0;
$u = htmlentities($_POST['user'], ENT_QUOTES, 'utf-8');
$e = htmlentities($_POST['email'], ENT_QUOTES, 'utf-8');
$p = md5($_POST['pass']);
$dd = (int)$_POST['dd'];
if (strlen($dd) == 1) {
	$dd = '0'.$dd;
}
$mm = (int)$_POST['mm'];
if (strlen($mm) == 1) {
	$mm = '0'.$mm;
}
$yy = (int)$_POST['yy'];

// 1 men 0 women
$sex = (int)$_POST['sex'];

// timestamp
$dofb = (int)strtotime($dd.'-'.$mm.'-'.$yy);

if (strlen($u) < 2 || strlen($e) < 2 || strlen($_POST['pass']) < 8) {	
	$error = "Wypełnij wszystkie pola formularza";
	$err = 1;
}else if(!filter_var($e, FILTER_VALIDATE_EMAIL)) {
	$error = "Podaj poprawny adres email";
	$err = 1;
}


// INSERT TO MYSQL
// INSERT INTO user(user) VALUES (N'శ్రీనివాస్ తామాడా'), (N'新概念英语第');
try { 
//CONNECT
$db = Conn();

	if ($err == 0 && $_SESSION['registred'] != 1) {		
		$ip = $_SERVER['REMOTE_ADDR'];
		$res = $db->exec("INSERT INTO user(user,email,pass,ip,dofb,sex) VALUES(N'$u','$e','$p','$ip',$dofb,'$sex')");
		$_SESSION['registred'] = $res;
		$error = "Nowy użytkownik został dodany. Możesz się zalogować.";		
	}else{		
		$res1 = $db->query("SELECT * FROM user WHERE user='$u'");
		if ($res1->rowCount()) {
			$error = "Użytkownik już istnieje. Zaloguj się.";
		}else{
			$error = "Coś poszło nie tak, zrestartuj przeglądarkę";
		}
	}
} catch (PDOException $e) {
    if ($e->getCode() == '2A000')
        echo "Syntax Error: ".$e->getMessage();
} 
// ERORORS
// print_r($db->errorInfo());
// echo "\nPDO::errorCode(): ", $db->errorCode();

// OR LONG VERSION prepare and bind
//$sth = $db->prepare("INSERT INTO example (firstname, lastname, email) VALUES (?, ?, ?)");
//$sth->bind_param("sss", $name, $pass, $email);
//$name ="jon"; $pass="pass"; $email = "email@email.ooo";
//$sth->execute();
// OR
//$sth->bindParam(1, $name, PDO::PARAM_STR, 4000); 
//$sth->bindParam(2, $pass, PDO::PARAM_PARAM_INT , 21); 
//$sth->bindParam(3, $email, PDO::PARAM_BOOL, 4000); 
//$sth->execute();

// GET FROM MYSQL
//$sth = $db->prepare("SELECT * FROM user");
//$sth->execute();
// PDO::FETCH_ASSOC PDO::FETCH_NUM PDO::FETCH_OBJ PDO::FETCH_BOTH
//$rows = $sth->fetchAll(PDO::FETCH_ASSOC);

// count num rows
//$sth->rowCount();

// DISPLAY IN BROWSER
//print_r($rows);
}
?>
<?php require('header.php'); ?>


<form method="post" action="">
<label>Zarejestruj</label>
<div style="height: auto; width: 100%; float: left; color: #f23; padding-left: 10px; padding: 5px;"><?php echo $error; ?></div>
	<input type="text" name="user" maxlength="50" placeholder="Nazwa użytkownika (litery i cyfry max 50 znaków)" value="<?php echo str_replace('@','',$_POST['user']); ?>">
	<input type="text" name="email" maxlength="200" placeholder="Adres e-mail" autocomplete="false" value="<?php echo $_POST['email']; ?>">
	<input type="password" name="pass" placeholder="Hasło (min. 8 znaków)" autocomplete="false">
	<p style="padding: 5px; color: #ff5500">Dzień urodzin <span style="float: right; margin-right: 10px;"> Płeć </span></p>
	<ul class="dofb">
		<select name="dd">			
			<?php for ($i=1; $i < 32; $i++) { 
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
			?>
		</select>
		<select name="mm">			
			<?php for ($i=1; $i < 13; $i++) { 
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
			?>
		</select>
		<select name="yy">			
			<?php for ($i=2015; $i > 1911; $i--) { 
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
			?>
		</select>	
		<select name="sex" style="float: right; margin-right: 10px;">
			<option value="1">Mężczyzna</option>
			<option value="0">Kobieta</option>			
		</select>
	</ul>
	<input type="submit" name="add" value="Zarejestruj" class="btn animated flipInX">
	<p><a href="login.php" class="link">Masz już konto? Zaloguj się!</a></p>
</form>



</body>
</html>
