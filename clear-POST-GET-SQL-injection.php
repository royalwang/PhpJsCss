<?php
function Clear(){
	foreach ($_GET as $key => $val) { 
	    if (is_string($val)) { 
	        $_GET[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
	    } else if (is_array($val)) { 
	        $_GET[$key] = Clear($val); 
	    } 
	} 
	foreach ($_POST as $key => $val) { 
	    if (is_string($val)) { 
	        $_POST[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
	    } else if (is_array($val)) { 
	        $_POST[$key] = Clear($val); 
	    } 
	} 
}

// use before insert data to mysql query, but only once in php file on top !!!
Clear();

// Secure mysql injection and then insert in mysql query or use php pdo class for insert data to mysql database
$email = $_POST['email'];
$pass = md5($_POST['pass']);
$q = "SELECT * from table_user where email = '$email' AND pass = '$pass'"; 
if (mysql_num_rows(mysql_query($q)) == 1) {
    $info = mysql_fetch_row(mysql_query($q)); 
    print_r($info);
}
?>
